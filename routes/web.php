<?php

// defaults
use Illuminate\Support\Facades\Route;
Route::redirect('/', 'dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'DashboardController@loadDashboard')->name('dashboard');
