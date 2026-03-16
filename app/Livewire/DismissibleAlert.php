<?php

namespace App\Livewire;

use Livewire\Component;

class DismissibleAlert extends Component
{
    public string $type = 'info';
    public string $message = '';
    public bool $visible = true;

    public function dismiss(): void
    {
        $this->visible = false;
    }

    public function render()
    {
        return view('livewire.dismissible-alert');
    }
}
