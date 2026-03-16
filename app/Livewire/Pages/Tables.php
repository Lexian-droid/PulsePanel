<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Tables', 'breadcrumbs' => ['Tables' => null]])]
class Tables extends Component
{
    public function render(): View
    {
        return view('dashboard.tables');
    }
}
