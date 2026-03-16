<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Components', 'breadcrumbs' => ['Components' => null]])]
class ComponentsShowcase extends Component
{
    public function render(): View
    {
        return view('dashboard.components');
    }
}
