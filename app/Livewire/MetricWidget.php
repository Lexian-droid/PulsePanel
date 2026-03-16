<?php

namespace App\Livewire;

use Livewire\Component;

class MetricWidget extends Component
{
    public string $label;
    public string $value;
    public string $change;
    public string $changeType = 'up';
    public string $icon = '';
    public int $refreshInterval = 0;

    public function render()
    {
        return view('livewire.metric-widget');
    }
}
