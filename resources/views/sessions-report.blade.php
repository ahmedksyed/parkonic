<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions Report - Parking Solutions</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1400px;
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
            margin-right: 10px;
        }

        .btn-export {
            background: #28a745;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .status-active {
            color: #28a745;
            font-weight: 600;
        }

        .status-closed {
            color: #6c757d;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
            gap: 10px;
        }

        .pagination button {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .pagination button.active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .export-section {
            margin-bottom: 20px;
            text-align: right;
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

        /* Export button loading state */
        .btn-export:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .export-loading {
            display: none;
        }

        .btn-export.loading .export-text {
            display: none;
        }

        .btn-export.loading .export-loading {
            display: inline;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('sessions.report') }}">Sessions Report</a>
        </nav>

        <h1>Parking Sessions Report</h1>

        <!-- Filters Section -->
        <div class="filters">
            <form method="GET" action="{{ route('sessions.report') }}">
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
                    <div class="filter-group">
                        <div class="button-group">
                            <button type="submit" class="btn">Apply Filters</button>
                            <button type="button" class="btn btn-export" onclick="exportToCSV()" id="exportBtn">
                                <span class="export-text">Export CSV</span>
                                <span class="export-loading" style="display: none;">Exporting...</span>
                            </button>
                            <button type="button" class="btn" style="background: #6c757d;"
                                onclick="clearFilters()">Clear Filters</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Export Section -->
        <div class="export-section">
            Showing {{ $sessions->firstItem() }} - {{ $sessions->lastItem() }} of {{ $sessions->total() }} sessions
        </div>

        <!-- Sessions Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Location</th>
                        <th>Building</th>
                        <th>Entry Point</th>
                        <th>Exit Point</th>
                        <th>Vehicle Plate</th>
                        <th>Status</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->in_time->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $session->out_time ? $session->out_time->format('Y-m-d H:i:s') : '-' }}</td>
                            <td>{{ $session->location->name }}</td>
                            <td>{{ $session->building->name }}</td>
                            <td>{{ $session->entryAccessPoint->name }}</td>
                            <td>{{ $session->exitAccessPoint->name ?? '-' }}</td>
                            <td>{{ $session->vehicle->full_plate }}</td>
                            <td>
                                @if ($session->status == 1)
                                    <span class="status-active">Active</span>
                                @else
                                    <span class="status-closed">Closed</span>
                                @endif
                            </td>
                            <td>{{ $session->duration ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $sessions->links() }}
        </div>
    </div>

    <script>
        function exportToCSV() {
            // Show loading indicator
            const exportButton = document.querySelector('.btn-export');
            const originalText = exportButton.innerHTML;
            exportButton.innerHTML = '<span>Exporting...</span>';
            exportButton.disabled = true;

            try {
                // Get current filter parameters
                const urlParams = new URLSearchParams(window.location.search);

                // Build export URL with current filters
                let exportUrl = '{{ route('sessions.export') }}';
                if (urlParams.toString()) {
                    exportUrl += '?' + urlParams.toString();
                }

                // Create a temporary link to trigger download
                const link = document.createElement('a');
                link.href = exportUrl;
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Show success message
                setTimeout(() => {
                    alert('CSV export started! Your download should begin shortly.');
                }, 500);

            } catch (error) {
                console.error('Export error:', error);
                alert('Error exporting CSV: ' + error.message);
            } finally {
                // Restore button state
                setTimeout(() => {
                    exportButton.innerHTML = originalText;
                    exportButton.disabled = false;
                }, 2000);
            }
        }

        // Alternative method using fetch API
        async function exportToCSVFetch() {
            const exportButton = document.querySelector('.btn-export');
            const originalText = exportButton.innerHTML;

            try {
                exportButton.innerHTML = '<span>Exporting...</span>';
                exportButton.disabled = true;

                // Get current filter parameters
                const urlParams = new URLSearchParams(window.location.search);
                let exportUrl = '{{ route('sessions.export') }}';
                if (urlParams.toString()) {
                    exportUrl += '?' + urlParams.toString();
                }

                // Use fetch to get the CSV data
                const response = await fetch(exportUrl);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                // Create blob and download
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;

                // Get filename from Content-Disposition header or use default
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'parking_sessions.csv';
                if (contentDisposition) {
                    const filenameMatch = contentDisposition.match(/filename="(.+)"/);
                    if (filenameMatch) {
                        filename = filenameMatch[1];
                    }
                }

                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                window.URL.revokeObjectURL(url);

                alert('CSV exported successfully!');

            } catch (error) {
                console.error('Export error:', error);
                alert('Error exporting CSV: ' + error.message);
            } finally {
                exportButton.innerHTML = originalText;
                exportButton.disabled = false;
            }
        }
    </script>
</body>

</html>
