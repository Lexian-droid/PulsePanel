<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Pages\Dashboard::class)->name('dashboard');
    Route::get('/dashboard/analytics', \App\Livewire\Pages\Analytics::class)->name('dashboard.analytics');
    Route::get('/dashboard/tables', \App\Livewire\Pages\Tables::class)->name('dashboard.tables');
    Route::get('/dashboard/components', \App\Livewire\Pages\ComponentsShowcase::class)->name('dashboard.components');
    Route::get('/dashboard/settings', \App\Livewire\Pages\Settings::class)->name('dashboard.settings');
});
