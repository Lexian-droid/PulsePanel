<?php

use App\Livewire\Pages\Analytics;
use App\Livewire\Pages\ComponentsShowcase;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\RoleEditor;
use App\Livewire\Pages\Settings;
use App\Livewire\Pages\Tables;
use App\Livewire\Pages\Teams;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/dashboard/analytics', Analytics::class)->name('dashboard.analytics');
    Route::get('/dashboard/tables', Tables::class)->name('dashboard.tables');
    Route::get('/dashboard/components', ComponentsShowcase::class)->name('dashboard.components');
    Route::get('/dashboard/settings', Settings::class)->name('dashboard.settings');

    Route::get('/dashboard/roles', RoleEditor::class)
        ->name('dashboard.roles')
        ->can('manage users');

    if (config('pulsepanel.features.teams')) {
        Route::get('/dashboard/teams', Teams::class)->name('dashboard.teams');
    }
});
