<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmModal extends Component
{
    public bool $show = false;
    public string $title = 'Are you sure?';
    public string $message = 'This action cannot be undone.';
    public string $confirmText = 'Confirm';
    public string $cancelText = 'Cancel';

    protected $listeners = ['openConfirmModal' => 'open'];

    public function open(string $title = '', string $message = ''): void
    {
        if ($title) $this->title = $title;
        if ($message) $this->message = $message;
        $this->show = true;
    }

    public function confirm(): void
    {
        $this->dispatch('confirmed');
        $this->show = false;
    }

    public function cancel(): void
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.confirm-modal');
    }
}
