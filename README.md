<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Reports System - Documentation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .documentation {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .section {
            margin-bottom: 40px;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 5px solid #3498db;
        }

        .section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8em;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .section h3 {
            color: #3498db;
            margin: 25px 0 15px 0;
            font-size: 1.4em;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .feature-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-top: 4px solid #3498db;
        }

        .feature-card h4 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
        }

        .tech-item {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9em;
            font-weight: 500;
        }

        .prerequisites {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .prereq-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .prereq-item strong {
            color: #3498db;
            display: block;
            margin-bottom: 5px;
        }

        .code-block {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            line-height: 1.4;
        }

        .code-block .comment {
            color: #7f8c8d;
        }

        .code-block .keyword {
            color: #e74c3c;
        }

        .code-block .string {
            color: #27ae60;
        }

        .code-block .function {
            color: #3498db;
        }

        .step {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 4px solid #27ae60;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .step-number {
            background: #27ae60;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }

        .structure-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .structure-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-top: 3px solid #e74c3c;
        }

        .structure-item h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .kpi-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .kpi-number {
            font-size: 1.5em;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .troubleshooting {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .issue {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 3px solid #e74c3c;
        }

        .solution {
            background: #d4edda;
            padding: 10px 15px;
            margin-top: 10px;
            border-radius: 5px;
            border-left: 3px solid #28a745;
        }

        .note {
            background: #d1ecf1;
            border-left: 5px solid #17a2b8;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 2em;
            }
            
            .section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="documentation">
            <div class="header">
                <h1>Parking Reports System</h1>
                <p>Laravel Application - Complete Documentation</p>
            </div>

            <div class="content">
                <!-- Project Overview -->
                <div class="section">
                    <h2>Project Overview</h2>
                    <p>A comprehensive parking management reporting system built with Laravel that provides dashboard analytics, session reports, and data visualization for parking solutions companies.</p>
                </div>

                <!-- Features -->
                <div class="section">
                    <h2>Features</h2>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <h4>Interactive Dashboard</h4>
                            <p>Real-time KPI cards and interactive charts for data visualization</p>
                        </div>
                        <div class="feature-card">
                            <h4>Sessions Report</h4>
                            <p>Detailed reporting with advanced filtering and pagination</p>
                        </div>
                        <div class="feature-card">
                            <h4>CSV Export</h4>
                            <p>Export filtered data to CSV format for external analysis</p>
                        </div>
                        <div class="feature-card">
                            <h4>Advanced Filtering</h4>
                            <p>Filter by date range, location, building, and session status</p>
                        </div>
                        <div class="feature-card">
                            <h4>Responsive Design</h4>
                            <p>Fully responsive interface that works on all devices</p>
                        </div>
                        <div class="feature-card">
                            <h4>Real-time Analytics</h4>
                            <p>Live data visualization using Chart.js library</p>
                        </div>
                    </div>
                </div>

                <!-- Technology Stack -->
                <div class="section">
                    <h2>Technology Stack</h2>
                    <div class="tech-stack">
                        <div class="tech-item">Laravel 10+</div>
                        <div class="tech-item">PHP 8.2+</div>
                        <div class="tech-item">MySQL 8.0+</div>
                        <div class="tech-item">Chart.js</div>
                        <div class="tech-item">Bootstrap CSS</div>
                        <div class="tech-item">JavaScript</div>
                    </div>
                </div>

                <!-- Prerequisites -->
                <div class="section">
                    <h2>Prerequisites</h2>
                    <div class="prerequisites">
                        <div class="prereq-item">
                            <strong>PHP 8.2+</strong>
                            <span>Server-side scripting</span>
                        </div>
                        <div class="prereq-item">
                            <strong>Composer 2.0+</strong>
                            <span>Dependency management</span>
                        </div>
                        <div class="prereq-item">
                            <strong>MySQL 8.0+</strong>
                            <span>Database system</span>
                        </div>
                        <div class="prereq-item">
                            <strong>Apache/Nginx</strong>
                            <span>Web server</span>
                        </div>
                        <div class="prereq-item">
                            <strong>Node.js</strong>
                            <span>Optional for assets</span>
                        </div>
                    </div>
                </div>

                <!-- Installation Steps -->
                <div class="section">
                    <h2>Installation Steps</h2>
                    
                    <div class="step">
                        <span class="step-number">1</span>
                        <strong>Clone the Repository</strong>
                        <div class="code-block">
<span class="comment"># Clone the project repository</span><br>
<span class="function">git clone</span> &lt;repository-url&gt;<br>
<span class="function">cd</span> parkonic
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">2</span>
                        <strong>Install PHP Dependencies</strong>
                        <div class="code-block">
<span class="comment"># Install Composer dependencies</span><br>
composer install
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">3</span>
                        <strong>Environment Configuration</strong>
                        <div class="code-block">
<span class="comment"># Copy environment file</span><br>
<span class="function">cp</span> .env.example .env<br><br>
<span class="comment"># Edit .env file with your database credentials:</span><br>
<span class="keyword">DB_CONNECTION</span>=mysql<br>
<span class="keyword">DB_HOST</span>=127.0.0.1<br>
<span class="keyword">DB_PORT</span>=3306<br>
<span class="keyword">DB_DATABASE</span>=parking_reports_demo<br>
<span class="keyword">DB_USERNAME</span>=root<br>
<span class="keyword">DB_PASSWORD</span>=
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">4</span>
                        <strong>Generate Application Key</strong>
                        <div class="code-block">
<span class="comment"># Generate Laravel application key</span><br>
php artisan key:generate
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">5</span>
                        <strong>Database Setup</strong>
                        <div class="code-block">
<span class="comment"># Create database in MySQL</span><br>
<span class="function">CREATE DATABASE</span> parking_reports_demo;<br><br>
<span class="comment"># Import the provided SQL file</span><br>
mysql -u root -p parking_reports_demo &lt; parking_reports_demo.sql
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">6</span>
                        <strong>Configure Database Strict Mode</strong>
                        <div class="code-block">
<span class="comment"># Add to .env file to avoid MySQL strict mode issues</span><br>
<span class="keyword">DB_STRICT</span>=false
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">7</span>
                        <strong>Application Setup</strong>
                        <div class="code-block">
<span class="comment"># Clear configuration cache</span><br>
php artisan config:clear<br><br>
<span class="comment"># Clear application cache</span><br>
php artisan cache:clear<br><br>
<span class="comment"># Clear view cache</span><br>
php artisan view:clear
                        </div>
                    </div>

                    <div class="step">
                        <span class="step-number">8</span>
                        <strong>Start Development Server</strong>
                        <div class="code-block">
<span class="comment"># Start Laravel development server</span><br>
php artisan serve<br><br>
<span class="comment"># Application will be available at:</span><br>
http://127.0.0.1:8000
                        </div>
                    </div>
                </div>

                <!-- Application Structure -->
                <div class="section">
                    <h2>Application Structure</h2>
                    <div class="structure-grid">
                        <div class="structure-item">
                            <h4>Models</h4>
                            <p>ParkingSession<br>Location<br>Building<br>AccessPoint<br>VehicleMaster</p>
                        </div>
                        <div class="structure-item">
                            <h4>Controllers</h4>
                            <p>ReportController</p>
                        </div>
                        <div class="structure-item">
                            <h4>Views</h4>
                            <p>dashboard.blade.php<br>sessions-report.blade.php</p>
                        </div>
                        <div class="structure-item">
                            <h4>Routes</h4>
                            <p>/dashboard<br>/reports/sessions<br>/reports/sessions/export</p>
                        </div>
                    </div>
                </div>

                <!-- Database Schema -->
                <div class="section">
                    <h2>Database Schema</h2>
                    <p>The system uses the following main tables:</p>
                    <ul style="margin: 15px 0 15px 20px;">
                        <li><strong>parking_sessions</strong> - Core session data with timestamps and status</li>
                        <li><strong>locations</strong> - Parking location names</li>
                        <li><strong>buildings</strong> - Building information</li>
                        <li><strong>access_points</strong> - Entry and exit gates</li>
                        <li><strong>vehicle_masters</strong> - Vehicle plate and emirates data</li>
                    </ul>
                </div>

                <!-- Key Features Implementation -->
                <div class="section">
                    <h2>Key Features Implementation</h2>
                    
                    <h3>Dashboard KPIs</h3>
                    <div class="kpi-grid">
                        <div class="kpi-item">
                            <div class="kpi-number">1</div>
                            <strong>Total Active Sessions</strong>
                            <p>Count of sessions with status = 1</p>
                        </div>
                        <div class="kpi-item">
                            <div class="kpi-number">2</div>
                            <strong>Total Closed Sessions</strong>
                            <p>Count of sessions with status = 2 in date range</p>
                        </div>
                        <div class="kpi-item">
                            <div class="kpi-number">3</div>
                            <strong>Average Parking Duration</strong>
                            <p>Average time for closed sessions</p>
                        </div>
                        <div class="kpi-item">
                            <div class="kpi-number">4</div>
                            <strong>Top Vehicle</strong>
                            <p>Vehicle with most sessions in filtered period</p>
                        </div>
                    </div>

                    <h3>Charts</h3>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <h4>Sessions per Hour</h4>
                            <p>Bar chart showing hourly distribution</p>
                        </div>
                        <div class="feature-card">
                            <h4>Sessions by Building</h4>
                            <p>Pie chart showing building distribution</p>
                        </div>
                        <div class="feature-card">
                            <h4>Access Point Flow</h4>
                            <p>Bar chart showing entry/exit traffic</p>
                        </div>
                        <div class="feature-card">
                            <h4>Daily Sessions Trend</h4>
                            <p>Line chart showing daily activity</p>
                        </div>
                    </div>

                    <h3>Filters</h3>
                    <div class="tech-stack">
                        <div class="tech-item">Date Range</div>
                        <div class="tech-item">Location</div>
                        <div class="tech-item">Building</div>
                        <div class="tech-item">Status</div>
                    </div>
                </div>

                <!-- Usage Instructions -->
                <div class="section">
                    <h2>Usage Instructions</h2>
                    
                    <h3>Accessing the Application</h3>
                    <div class="step">
                        <strong>Dashboard</strong>
                        <p>Navigate to: <code>http://127.0.0.1:8000</code></p>
                    </div>
                    <div class="step">
                        <strong>Sessions Report</strong>
                        <p>Click "Sessions Report" in navigation or go to: <code>http://127.0.0.1:8000/reports/sessions</code></p>
                    </div>

                    <h3>Using Filters</h3>
                    <ol style="margin-left: 20px;">
                        <li><strong>Date Range</strong>: Select From and To dates (defaults to last 7 days)</li>
                        <li><strong>Location</strong>: Filter by specific location or view all</li>
                        <li><strong>Building</strong>: Filter by specific building or view all</li>
                        <li><strong>Status</strong>: Filter by Active, Closed, or All sessions</li>
                        <li><strong>Apply Filters</strong>: Click "Apply Filters" to update data</li>
                        <li><strong>Clear Filters</strong>: Click "Clear Filters" to reset all filters</li>
                    </ol>

                    <h3>Exporting Data</h3>
                    <ol style="margin-left: 20px;">
                        <li>Navigate to Sessions Report page</li>
                        <li>Apply desired filters</li>
                        <li>Click "Export CSV" button</li>
                        <li>File will download with current filtered data</li>
                    </ol>
                </div>

                <!-- API Endpoints -->
                <div class="section">
                    <h2>API Endpoints</h2>
                    <div class="code-block">
<span class="comment"># Dashboard views</span><br>
<span class="function">GET</span> /<br>
<span class="function">GET</span> /dashboard<br><br>
<span class="comment"># Sessions report with pagination</span><br>
<span class="function">GET</span> /reports/sessions<br><br>
<span class="comment"># CSV export of filtered sessions</span><br>
<span class="function">GET</span> /reports/sessions/export
                    </div>
                </div>

                <!-- Assumptions & Design Decisions -->
                <div class="section">
                    <h2>Assumptions & Design Decisions</h2>
                    
                    <h3>Filter Logic</h3>
                    <ul style="margin: 15px 0 15px 20px;">
                        <li><strong>Date Range</strong>: Applied to in_time field for both Active and Closed sessions</li>
                        <li><strong>Active Sessions</strong>: Show all active sessions regardless of date filters</li>
                        <li><strong>Closed Sessions</strong>: Only show sessions within date range filters</li>
                        <li><strong>Average Duration</strong>: Calculated only for closed sessions with valid out_time</li>
                    </ul>

                    <h3>Performance Considerations</h3>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <h4>Database-side Aggregation</h4>
                            <p>Charts and KPIs use efficient SQL queries</p>
                        </div>
                        <div class="feature-card">
                            <h4>Eager Loading</h4>
                            <p>Prevents N+1 query problems</p>
                        </div>
                        <div class="feature-card">
                            <h4>Pagination</h4>
                            <p>Sessions report shows 25 records per page</p>
                        </div>
                        <div class="feature-card">
                            <h4>Efficient Grouping</h4>
                            <p>Proper indexing for GROUP BY queries</p>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting -->
                <div class="section">
                    <h2>Troubleshooting</h2>
                    
                    <div class="troubleshooting">
                        <h3>Common Issues</h3>
                        
                        <div class="issue">
                            <strong>MySQL Group By Error</strong>
                            <div class="solution">
                                <strong>Solution:</strong> Set DB_STRICT=false in .env file
                            </div>
                        </div>
                        
                        <div class="issue">
                            <strong>Calendar Popup Not Working</strong>
                            <div class="solution">
                                <strong>Solution:</strong> Use the enhanced date picker CSS and JavaScript provided
                            </div>
                        </div>
                        
                        <div class="issue">
                            <strong>CSV Export Not Working</strong>
                            <div class="solution">
                                <strong>Solution:</strong> Ensure the export route is properly defined and accessible
                            </div>
                        </div>
                        
                        <div class="issue">
                            <strong>Charts Not Displaying</strong>
                            <div class="solution">
                                <strong>Solution:</strong> Check browser console for JavaScript errors, ensure Chart.js is loaded
                            </div>
                        </div>
                    </div>

                    <h3>Error Resolution</h3>
                    <ul style="margin: 15px 0 15px 20px;">
                        <li><strong>Clear caches</strong> after configuration changes</li>
                        <li><strong>Check database connections</strong> in .env file</li>
                        <li><strong>Verify file permissions</strong> for storage and bootstrap/cache directories</li>
                        <li><strong>Check browser console</strong> for frontend issues</li>
                    </ul>
                </div>

                <!-- Development Notes -->
                <div class="section">
                    <h2>Development Notes</h2>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <h4>Eloquent ORM</h4>
                            <p>Uses proper relationships between models</p>
                        </div>
                        <div class="feature-card">
                            <h4>Efficient Queries</h4>
                            <p>Database-side aggregation for performance</p>
                        </div>
                        <div class="feature-card">
                            <h4>Responsive Design</h4>
                            <p>Compatible with mobile devices and tablets</p>
                        </div>
                        <div class="feature-card">
                            <h4>Chart.js Integration</h4>
                            <p>Interactive data visualization</p>
                        </div>
                        <div class="feature-card">
                            <h4>CSV Export</h4>
                            <p>Streaming for large datasets</p>
                        </div>
                        <div class="feature-card">
                            <h4>Modern UI/UX</h4>
                            <p>Clean and intuitive user interface</p>
                        </div>
                    </div>
                </div>

                <!-- Support -->
                <div class="section">
                    <h2>Support</h2>
                    <p>For technical support or issues with the application, check the following:</p>
                    <ol style="margin: 15px 0 15px 20px;">
                        <li>Laravel logs in <code>storage/logs/laravel.log</code></li>
                        <li>Browser console for JavaScript errors</li>
                        <li>Database connection settings in <code>.env</code> file</li>
                        <li>Apache/Nginx error logs for server issues</li>
                    </ol>
                </div>

                <!-- License -->
                <div class="section">
                    <h2>License</h2>
                    <p>This project is developed as part of a parking solutions company assignment.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>