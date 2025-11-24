<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Parking Reports System - README</title>
  <style>
    :root{
      --bg:#f7f8fb; --card:#ffffff; --muted:#6b7280; --accent:#2563eb;
      --mono: Menlo, Monaco, "Courier New", monospace;
    }
    body{font-family:Inter,Segoe UI,Roboto,system-ui,Arial; background:var(--bg); color:#0f172a; margin:0; padding:32px;}
    .container{max-width:980px; margin:0 auto;}
    header{margin-bottom:18px}
    h1{margin:0 0 8px; font-size:28px}
    p.lead{color:var(--muted); margin:0 0 18px}
    .card{background:var(--card); border-radius:10px; padding:20px; box-shadow:0 6px 18px rgba(13,14,22,0.06); margin-bottom:16px}
    h2{font-size:20px; margin:12px 0}
    h3{font-size:16px; margin:10px 0}
    ul{margin:8px 0 12px 20px}
    ol{margin:8px 0 12px 20px}
    pre{background:#0b1220; color:#e6eef8; padding:12px; overflow:auto; border-radius:6px; font-family:var(--mono); font-size:13px}
    code{background:#eef2ff; padding:2px 6px; border-radius:4px; font-family:var(--mono); font-size:90%}
    table{width:100%; border-collapse:collapse; margin:12px 0}
    th,td{padding:8px; border:1px solid #e6e9ef; text-align:left}
    .muted{color:var(--muted)}
    .small{font-size:13px;color:var(--muted)}
    .kbd{background:#111827;color:#fff;padding:2px 6px;border-radius:4px;font-family:var(--mono);font-size:12px}
    a{color:var(--accent); text-decoration:none}
    footer.small{margin-top:18px;text-align:center}
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Parking Reports System</h1>
      <p class="lead">Laravel Application — a comprehensive parking management reporting system with dashboard analytics, session reports, CSV export and Chart.js visualizations.</p>
    </header>

    <section class="card">
      <h2>Project Overview</h2>
      <p>This project is a parking management reporting system built with Laravel that provides dashboard KPIs, session reports, CSV export, and interactive charts for parking solutions companies.</p>

      <h3>Features</h3>
      <ul>
        <li>Dashboard with KPI cards and interactive charts</li>
        <li>Sessions report with filtering and pagination</li>
        <li>CSV export functionality</li>
        <li>Real-time data visualization using Chart.js</li>
        <li>Advanced filtering by date range, location, building, and status</li>
        <li>Responsive design for all devices</li>
      </ul>

      <h3>Technology Stack</h3>
      <ul>
        <li>Laravel 10+</li>
        <li>PHP 8.2+</li>
        <li>MySQL 8.0+</li>
        <li>Chart.js for data visualization</li>
        <li>Bootstrap-compatible responsive design</li>
      </ul>
    </section>

    <section class="card">
      <h2>Prerequisites</h2>
      <ul>
        <li>PHP 8.2 or higher</li>
        <li>Composer 2.0 or higher</li>
        <li>MySQL 8.0 or higher</li>
        <li>Apache/Nginx web server</li>
        <li>Node.js (optional, for frontend assets)</li>
      </ul>

      <h2>Installation Steps</h2>
      <ol>
        <li><strong>Clone the repository</strong>
          <pre><code>git clone &lt;repository-url&gt;
cd parkonic</code></pre>
        </li>
        <li><strong>Install PHP dependencies</strong>
          <pre><code>composer install</code></pre>
        </li>
        <li><strong>Environment configuration</strong><br>
          Copy the env file and configure database:
          <pre><code>cp .env.example .env</code></pre>
          Edit `.env` with DB credentials:
          <pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parking_reports_demo
DB_USERNAME=root
DB_PASSWORD=</code></pre>
        </li>
        <li><strong>Generate application key</strong>
          <pre><code>php artisan key:generate</code></pre>
        </li>
        <li><strong>Database setup</strong><br>
          Create the database and import the SQL:
          <pre><code>-- Create database
CREATE DATABASE parking_reports_demo;

-- Import SQL (example CLI)
mysql -u root -p parking_reports_demo &lt; parking_reports_demo.sql</code></pre>
        </li>
        <li><strong>Configure database strict mode (optional)</strong><br>
          To avoid MySQL GROUP BY / strict issues, either set in `.env`:
          <pre><code>DB_STRICT=false</code></pre>
          Or update `config/database.php` mysql config:
          <pre><code>'mysql' =&gt; [
    // ...
    'strict' =&gt; false,
],</code></pre>
        </li>
        <li><strong>Application setup — clear caches</strong>
          <pre><code>php artisan config:clear
php artisan cache:clear
php artisan view:clear</code></pre>
        </li>
        <li><strong>Start development server</strong>
          <pre><code>php artisan serve</code></pre>
          <p class="small">App available at: <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a></p>
        </li>
      </ol>
    </section>

    <section class="card">
      <h2>Application Structure</h2>

      <h3>Models</h3>
      <ul>
        <li><code>ParkingSession</code> — main parking sessions model</li>
        <li><code>Location</code> — parking locations</li>
        <li><code>Building</code> — building information</li>
        <li><code>AccessPoint</code> — entry/exit points</li>
        <li><code>VehicleMaster</code> — vehicle plate and emirates data</li>
      </ul>

      <h3>Controllers</h3>
      <ul>
        <li><code>ReportController</code> — handles dashboard and reporting functionality</li>
      </ul>

      <h3>Views</h3>
      <ul>
        <li><code>dashboard.blade.php</code> — main dashboard with charts and KPIs</li>
        <li><code>sessions-report.blade.php</code> — detailed sessions report table</li>
      </ul>

      <h3>Routes</h3>
      <ul>
        <li><code>/</code> or <code>/dashboard</code> — main dashboard</li>
        <li><code>/reports/sessions</code> — sessions report</li>
        <li><code>/reports/sessions/export</code> — CSV export endpoint</li>
      </ul>

      <h3>Database Schema (main tables)</h3>
      <ul>
        <li><code>parking_sessions</code> — core session data with timestamps and status</li>
        <li><code>locations</code></li>
        <li><code>buildings</code></li>
        <li><code>access_points</code></li>
        <li><code>vehicle_masters</code></li>
      </ul>
    </section>

    <section class="card">
      <h2>Key Features Implementation</h2>

      <h3>Dashboard KPIs</h3>
      <ul>
        <li><strong>Total Active Sessions</strong> — count where <code>status = 1</code></li>
        <li><strong>Total Closed Sessions</strong> — count where <code>status = 2</code> in date range</li>
        <li><strong>Average Parking Duration</strong> — average for closed sessions</li>
        <li><strong>Top Vehicle</strong> — vehicle with most sessions in filtered period</li>
      </ul>

      <h3>Charts (Chart.js)</h3>
      <ul>
        <li>Sessions per Hour — bar chart</li>
        <li>Sessions by Building — pie/doughnut chart</li>
        <li>Access Point Flow — bar chart</li>
        <li>Daily Sessions Trend — line chart</li>
      </ul>

      <h3>Filters</h3>
      <ul>
        <li>Date Range (From/To)</li>
        <li>Location (dropdown)</li>
        <li>Building (dropdown)</li>
        <li>Status (Active / Closed / All)</li>
      </ul>
    </section>

    <section class="card">
      <h2>Usage Instructions</h2>
      <h3>Access</h3>
      <ul>
        <li>Dashboard: <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a></li>
        <li>Sessions Report: <a href="http://127.0.0.1:8000/reports/sessions">/reports/sessions</a></li>
      </ul>

      <h3>Using Filters</h3>
      <ul>
        <li><strong>Date Range:</strong> defaults to last 7 days</li>
        <li><strong>Location / Building:</strong> choose specific or view all</li>
        <li><strong>Status:</strong> Active, Closed or All</li>
        <li>Click <strong>Apply Filters</strong> to update; <strong>Clear Filters</strong> to reset</li>
      </ul>

      <h3>Exporting Data (CSV)</h3>
      <ol>
        <li>Go to Sessions Report</li>
        <li>Apply filters</li>
        <li>Click <strong>Export CSV</strong> — file downloads with filtered data</li>
      </ol>
    </section>

    <section class="card">
      <h2>API Endpoints</h2>
      <table>
        <thead>
          <tr><th>Method</th><th>Endpoint</th><th>Purpose</th></tr>
        </thead>
        <tbody>
          <tr><td>GET</td><td>/</td><td>Dashboard view</td></tr>
          <tr><td>GET</td><td>/dashboard</td><td>Dashboard view</td></tr>
          <tr><td>GET</td><td>/reports/sessions</td><td>Sessions report (paginated)</td></tr>
          <tr><td>GET</td><td>/reports/sessions/export</td><td>CSV export of filtered sessions</td></tr>
        </tbody>
      </table>
    </section>

    <section class="card">
      <h2>Assumptions &amp; Design Decisions</h2>
      <h3>Filter Logic</h3>
      <ul>
        <li>Date range applied to <code>in_time</code> for both active and closed sessions</li>
        <li>Active sessions are shown regardless of date filters</li>
        <li>Closed sessions are filtered by date range</li>
        <li>Average duration calculated only for closed sessions with valid <code>out_time</code></li>
      </ul>

      <h3>Performance Considerations</h3>
      <ul>
        <li>Database-side aggregation for charts and KPIs</li>
        <li>Eager loading to prevent N+1 queries</li>
        <li>Pagination for sessions (default 25 per page)</li>
        <li>Indexes on filtering / grouping columns</li>
      </ul>
    </section>

    <section class="card">
      <h2>Troubleshooting</h2>
      <h3>Common Issues &amp; Solutions</h3>
      <ul>
        <li><strong>MySQL Group By Error:</strong> Set <code>DB_STRICT=false</code> in `.env`</li>
        <li><strong>Calendar popup not working:</strong> Ensure datepicker CSS/JS are loaded</li>
        <li><strong>CSV export not working:</strong> Verify export route exists and is accessible</li>
        <li><strong>Charts not displaying:</strong> Check browser console for JS errors and that Chart.js is loaded</li>
      </ul>

      <h3>Error Resolution</h3>
      <ul>
        <li>Clear caches after changes: <code>php artisan config:clear</code>, etc.</li>
        <li>Check DB connection in `.env`</li>
        <li>Verify file permissions for <code>storage</code> and <code>bootstrap/cache</code></li>
      </ul>
    </section>

    <section class="card">
      <h2>Development Notes</h2>
      <ul>
        <li>Uses Eloquent ORM with relationships</li>
        <li>Efficient DB queries with aggregation</li>
        <li>Responsive design compatible with mobile</li>
        <li>Chart.js integration for visualization</li>
        <li>CSV export uses streaming for large datasets</li>
      </ul>
    </section>

    <section class="card">
      <h2>Support</h2>
      <p class="small">For technical support check:</p>
      <ul>
        <li><code>storage/logs/laravel.log</code></li>
        <li>Browser console for JavaScript errors</li>
        <li>Database connection in <code>.env</code></li>
        <li>Apache/Nginx error logs</li>
      </ul>
    </section>

    <section class="card">
      <h2>License</h2>
      <p>This project was developed as part of a parking solutions company assignment.</p>
    </section>

    <footer class="small">Generated README HTML — Parking Reports System</footer>
  </div>
</body>
</html>
