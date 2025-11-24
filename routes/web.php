<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', [ReportController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
Route::get('/reports/sessions', [ReportController::class, 'sessionsReport'])->name('sessions.report');
Route::get('/reports/sessions/export', [ReportController::class, 'exportSessions'])->name('sessions.export');