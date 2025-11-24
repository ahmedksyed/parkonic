<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Solutions - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .filters {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 15px;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
            max-width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        select,
        input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .date-picker-wrapper {
            position: relative;
            width: 100%;
        }

        select,
        input,
        .date-picker {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background: white;
            cursor: pointer;
            position: relative;
            padding-right: 40px;
            background: linear-gradient(90deg, #fff 0%, #fff 85%, transparent 85%);
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }


        /* Custom calendar icon indicator */
        .date-picker-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .date-picker-wrapper::after {
            content: '📅';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 16px;
            z-index: 1;
        }

        .date-picker:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .date-picker:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
            outline: none;
        }

        /* Ensure the entire field is clickable in WebKit browsers */
        .date-picker::-webkit-calendar-picker-indicator {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            opacity: 0;
        }

        .date-picker::-webkit-datetime-edit-fields-wrapper {
            pointer-events: none;
        }

        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .kpi-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .kpi-value {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
            margin: 10px 0;
        }

        .kpi-label {
            color: #666;
            font-size: 0.9em;
        }

        .charts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            margin-top: 0;
            margin-bottom: 15px;
            color: #333;
            font-size: 1.2em;
        }

        @media (max-width: 768px) {
            .charts {
                grid-template-columns: 1fr;
            }
        }

        nav {
            background: #343a40;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 8px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-right: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('sessions.report') }}">Sessions Report</a>
        </nav>

        <h1>Parking Solutions Dashboard</h1>

        <!-- Filters Section -->
        <div class="filters">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="from_date">From Date</label>
                        <div class="date-picker-wrapper">
                            <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}"
                                class="date-picker">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label for="to_date">To Date</label>
                        <div class="date-picker-wrapper">
                            <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}"
                                class="date-picker">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label for="location_id">Location</label>
                        <select id="location_id" name="location_id">
                            <option value="">All Locations</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="building_id">Building</label>
                        <select id="building_id" name="building_id">
                            <option value="">All Buildings</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}"
                                    {{ request('building_id') == $building->id ? 'selected' : '' }}>
                                    {{ $building->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div class="filter-group" style="align-self: flex-end;">
                        <button type="submit" class="btn">Apply Filters</button>
                        <button type="button" class="btn" style="background: #6c757d;"
                            onclick="clearFilters()">Clear Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- KPI Cards -->
        <div class="kpi-cards">
            <div class="kpi-card">
                <div class="kpi-label">Total Active Sessions</div>
                <div class="kpi-value">{{ $totalActiveSessions }}</div>
                <div class="kpi-subtext">Currently parked vehicles</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Total Closed Sessions</div>
                <div class="kpi-value">{{ $totalClosedSessions }}</div>
                <div class="kpi-subtext">In selected period</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Avg Parking Duration</div>
                <div class="kpi-value">
                    @if ($avgDuration > 0)
                        @php
                            $hours = floor($avgDuration / 60);
                            $minutes = $avgDuration % 60;
                        @endphp
                        {{ $hours }}h {{ $minutes }}m
                    @else
                        N/A
                    @endif
                </div>
                <div class="kpi-subtext">For closed sessions</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Top Vehicle</div>
                <div class="kpi-value">
                    @if ($topVehicle)
                        {{ $topVehicle->plate_code }} {{ $topVehicle->plate_number }}
                    @else
                        N/A
                    @endif
                </div>
                <div class="kpi-subtext">
                    @if ($topVehicle)
                        {{ $topVehicle->session_count }} sessions
                    @else
                        No data
                    @endif
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="charts">
            <div class="chart-container">
                <h3 class="chart-title">Sessions per Hour of Day</h3>
                <canvas id="sessionsPerHourChart"></canvas>
            </div>
            <div class="chart-container">
                <h3 class="chart-title">Sessions by Building</h3>
                <canvas id="sessionsByBuildingChart"></canvas>
            </div>
            <div class="chart-container">
                <h3 class="chart-title">Access Point Flow</h3>
                <canvas id="accessPointFlowChart"></canvas>
            </div>
            <div class="chart-container">
                <h3 class="chart-title">Daily Sessions Trend</h3>
                <canvas id="dailySessionsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        function clearFilters() {
            // Get all form inputs
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, select');

            // Clear all inputs
            inputs.forEach(input => {
                if (input.type === 'text' || input.type === 'date') {
                    input.value = '';
                } else if (input.type === 'select-one') {
                    input.selectedIndex = 0; // Reset to first option
                }
            });

            // Optionally submit the form after clearing
            form.submit();
        }
        // Sessions per Hour Chart - Fixed version
        const sessionsPerHourData = {
            labels: Array.from({
                length: 24
            }, (_, i) => i.toString().padStart(2, '0') + ':00'),
            datasets: [{
                label: 'Sessions Started',
                data: [
                    @for ($i = 0; $i < 24; $i++)
                        {{ $sessionsPerHour[$i] ?? 0 }}{{ $i < 23 ? ',' : '' }}
                    @endfor
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Sessions by Building Chart
        const sessionsByBuildingData = {
            labels: {!! json_encode(array_keys($sessionsByBuilding)) !!},
            datasets: [{
                label: 'Sessions',
                data: {!! json_encode(array_values($sessionsByBuilding)) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(199, 199, 199, 0.8)',
                    'rgba(83, 102, 255, 0.8)'
                ],
                borderWidth: 1
            }]
        };

        // Access Point Flow Chart
        const accessPointLabels = {!! json_encode(array_merge(array_keys($accessPointFlow['entry']), array_keys($accessPointFlow['exit']))) !!};
        const accessPointData = {!! json_encode(array_merge(array_values($accessPointFlow['entry']), array_values($accessPointFlow['exit']))) !!};
        const accessPointColors = [
            @foreach (array_keys($accessPointFlow['entry']) as $entry)
                'rgba(54, 162, 235, 0.8)',
            @endforeach
            @foreach (array_keys($accessPointFlow['exit']) as $exit)
                'rgba(255, 99, 132, 0.8)',
            @endforeach
        ];

        const accessPointFlowData = {
            labels: accessPointLabels,
            datasets: [{
                label: 'Entry/Exit Count',
                data: accessPointData,
                backgroundColor: accessPointColors,
                borderWidth: 1
            }]
        };

        // Daily Sessions Chart
        const dailySessionsData = {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Active Sessions',
                data: [
                    {{ $dailySessions['active']['Monday'] ?? 0 }},
                    {{ $dailySessions['active']['Tuesday'] ?? 0 }},
                    {{ $dailySessions['active']['Wednesday'] ?? 0 }},
                    {{ $dailySessions['active']['Thursday'] ?? 0 }},
                    {{ $dailySessions['active']['Friday'] ?? 0 }},
                    {{ $dailySessions['active']['Saturday'] ?? 0 }},
                    {{ $dailySessions['active']['Sunday'] ?? 0 }}
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Closed Sessions',
                data: [
                    {{ $dailySessions['closed']['Monday'] ?? 0 }},
                    {{ $dailySessions['closed']['Tuesday'] ?? 0 }},
                    {{ $dailySessions['closed']['Wednesday'] ?? 0 }},
                    {{ $dailySessions['closed']['Thursday'] ?? 0 }},
                    {{ $dailySessions['closed']['Friday'] ?? 0 }},
                    {{ $dailySessions['closed']['Saturday'] ?? 0 }},
                    {{ $dailySessions['closed']['Sunday'] ?? 0 }}
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Sessions per Hour Chart
            new Chart(document.getElementById('sessionsPerHourChart'), {
                type: 'bar',
                data: sessionsPerHourData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Sessions'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Hour of Day'
                            }
                        }
                    }
                }
            });

            // Sessions by Building Chart
            new Chart(document.getElementById('sessionsByBuildingChart'), {
                type: 'pie',
                data: sessionsByBuildingData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Access Point Flow Chart
            new Chart(document.getElementById('accessPointFlowChart'), {
                type: 'bar',
                data: accessPointFlowData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Vehicles'
                            }
                        }
                    }
                }
            });

            // Daily Sessions Chart
            new Chart(document.getElementById('dailySessionsChart'), {
                type: 'line',
                data: dailySessionsData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Sessions'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
