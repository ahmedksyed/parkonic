<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingSession;
use App\Models\Location;
use App\Models\Building;
use App\Models\VehicleMaster;
use App\Models\AccessPoint;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        // KPI Calculations
        $totalActiveSessions = ParkingSession::where('status', 1)->count();

        $closedSessionsQuery = clone $query;
        $totalClosedSessions = $closedSessionsQuery->where('status', 2)->count();

        $avgDurationQuery = clone $query;
        $avgDuration = $avgDurationQuery->where('status', 2)
            ->whereNotNull('out_time')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, in_time, out_time)) as avg_duration')
            ->first()->avg_duration ?? 0;

        // Top Vehicle query
        $topVehicleQuery = clone $query;
        $topVehicle = $topVehicleQuery->where('status', 2)
            ->join('vehicle_masters', 'parking_sessions.vehicle_master_id', '=', 'vehicle_masters.id')
            ->select(
                'vehicle_masters.id',
                'vehicle_masters.plate_code',
                'vehicle_masters.plate_number',
                'vehicle_masters.emirates',
                DB::raw('COUNT(*) as session_count')
            )
            ->groupBy(
                'vehicle_masters.id',
                'vehicle_masters.plate_code',
                'vehicle_masters.plate_number',
                'vehicle_masters.emirates'
            )
            ->orderByDesc('session_count')
            ->first();

        // Chart Data
        $sessionsPerHour = $this->getSessionsPerHour($request);
        $sessionsByBuilding = $this->getSessionsByBuilding($request);
        $accessPointFlow = $this->getAccessPointFlow($request);
        $dailySessions = $this->getDailySessions($request);

        $locations = Location::all();
        $buildings = Building::all();

        return view('dashboard', compact(
            'totalActiveSessions',
            'totalClosedSessions',
            'avgDuration',
            'topVehicle',
            'sessionsPerHour',
            'sessionsByBuilding',
            'accessPointFlow',
            'dailySessions',
            'locations',
            'buildings'
        ));
    }

    public function sessionsReport(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        $sessions = $query->with([
            'location',
            'building',
            'entryAccessPoint',
            'exitAccessPoint',
            'vehicle'
        ])->orderBy('in_time', 'desc')->paginate(25);

        $locations = Location::all();
        $buildings = Building::all();

        return view('sessions-report', compact('sessions', 'locations', 'buildings'));
    }

    private function buildFilterQuery(Request $request)
    {
        $query = ParkingSession::query();

        // Date range filter
        if ($request->filled('from_date')) {
            $query->whereDate('in_time', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('in_time', '<=', $request->to_date);
        }

        // Location filter
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Building filter
        if ($request->filled('building_id')) {
            $query->where('building_id', $request->building_id);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    private function getSessionsPerHour(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        $results = $query->selectRaw('HOUR(in_time) as hour, COUNT(*) as count')
            ->groupBy(DB::raw('HOUR(in_time)'))
            ->orderBy('hour')
            ->get();

        // Create array with all hours (0-23) and default to 0
        $hoursData = [];
        for ($i = 0; $i < 24; $i++) {
            $hoursData[$i] = 0;
        }

        // Fill with actual data
        foreach ($results as $result) {
            $hoursData[$result->hour] = $result->count;
        }

        return $hoursData;
    }

    private function getSessionsByBuilding(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        $results = $query->join('buildings', 'parking_sessions.building_id', '=', 'buildings.id')
            ->select('buildings.id', 'buildings.name', DB::raw('COUNT(*) as count'))
            ->groupBy('buildings.id', 'buildings.name')
            ->get();

        $buildingData = [];
        foreach ($results as $result) {
            $buildingData[$result->name] = $result->count;
        }

        return $buildingData;
    }

    private function getAccessPointFlow(Request $request)
    {
        // Use separate queries for entry and exit points
        $entryData = [];
        $exitData = [];

        // Get all access points
        $entryPoints = AccessPoint::where('is_exit', 0)->get();
        $exitPoints = AccessPoint::where('is_exit', 1)->get();

        // Count entry sessions for each entry point with filters
        foreach ($entryPoints as $point) {
            $query = $this->buildFilterQuery($request);
            $count = $query->where('entry_access_point_id', $point->id)->count();
            $entryData[$point->name] = $count;
        }

        // Count exit sessions for each exit point with filters
        foreach ($exitPoints as $point) {
            $query = $this->buildFilterQuery($request);
            $count = $query->where('exit_access_point_id', $point->id)
                ->whereNotNull('exit_access_point_id')
                ->count();
            $exitData[$point->name] = $count;
        }

        return [
            'entry' => $entryData,
            'exit' => $exitData
        ];
    }

    private function getDailySessions(Request $request)
    {
        // Create separate queries for active and closed sessions
        $activeQuery = $this->buildFilterQuery($request);
        $closedQuery = $this->buildFilterQuery($request);

        // Active sessions by day
        $activeSessions = $activeQuery->where('status', 1)
            ->selectRaw('DAYNAME(in_time) as day, COUNT(*) as count')
            ->groupBy(DB::raw('DAYNAME(in_time)'))
            ->get();

        // Closed sessions by day
        $closedSessions = $closedQuery->where('status', 2)
            ->selectRaw('DAYNAME(in_time) as day, COUNT(*) as count')
            ->groupBy(DB::raw('DAYNAME(in_time)'))
            ->get();

        // Create arrays with all days and default to 0
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $activeData = [];
        $closedData = [];

        foreach ($days as $day) {
            $activeData[$day] = 0;
            $closedData[$day] = 0;
        }

        // Fill with actual data
        foreach ($activeSessions as $session) {
            if (isset($activeData[$session->day])) {
                $activeData[$session->day] = $session->count;
            }
        }

        foreach ($closedSessions as $session) {
            if (isset($closedData[$session->day])) {
                $closedData[$session->day] = $session->count;
            }
        }

        return [
            'active' => $activeData,
            'closed' => $closedData
        ];
    }

    // Alternative method to disable strict mode temporarily (quick fix)
    public function dashboardWithStrictFix(Request $request)
    {
        // Disable strict mode for this query
        config(['database.connections.mysql.strict' => false]);
        DB::reconnect();

        $result = $this->dashboard($request);

        // Re-enable strict mode
        config(['database.connections.mysql.strict' => true]);
        DB::reconnect();

        return $result;
    }

    public function exportSessions(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        $sessions = $query->with([
            'location',
            'building',
            'entryAccessPoint',
            'exitAccessPoint',
            'vehicle'
        ])->orderBy('in_time', 'desc')->get();

        $fileName = 'parking_sessions_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($sessions) {
            $handle = fopen('php://output', 'w');

            // Add BOM for UTF-8 to support special characters in Excel
            fwrite($handle, "\xEF\xBB\xBF");

            // CSV headers
            fputcsv($handle, [
                'ID',
                'In Time',
                'Out Time',
                'Location',
                'Building',
                'Entry Access Point',
                'Exit Access Point',
                'Vehicle Plate Code',
                'Vehicle Plate Number',
                'Emirates',
                'Status',
                'Duration (Minutes)',
                'Parking Duration'
            ]);

            // CSV data rows
            foreach ($sessions as $session) {
                $durationMinutes = null;
                $durationFormatted = 'N/A';

                if ($session->out_time && $session->status == 2) {
                    $durationMinutes = $session->out_time->diffInMinutes($session->in_time);
                    $hours = floor($durationMinutes / 60);
                    $minutes = $durationMinutes % 60;
                    $durationFormatted = $hours . 'h ' . $minutes . 'm';
                }

                fputcsv($handle, [
                    $session->id,
                    $session->in_time->format('Y-m-d H:i:s'),
                    $session->out_time ? $session->out_time->format('Y-m-d H:i:s') : 'Active',
                    $session->location->name,
                    $session->building->name,
                    $session->entryAccessPoint->name,
                    $session->exitAccessPoint->name ?? 'N/A',
                    $session->vehicle->plate_code,
                    $session->vehicle->plate_number,
                    $session->vehicle->emirates,
                    $session->status == 1 ? 'Active' : 'Closed',
                    $durationMinutes,
                    $durationFormatted
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
