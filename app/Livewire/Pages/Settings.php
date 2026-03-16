<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Settings', 'breadcrumbs' => ['Settings' => null]])]
class Settings extends Component
{
    public function render(): View
    {
        return view('dashboard.settings');
    }
}
