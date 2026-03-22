<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Teams', 'breadcrumbs' => ['Teams' => null]])]
class Teams extends Component
{
    public function render(): View
    {
        $teams = auth()->user()->teams()->withCount('users')->get();

        return view('dashboard.teams', compact('teams'));
    }
}
