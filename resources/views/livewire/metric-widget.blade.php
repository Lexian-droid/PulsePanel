<div @if($refreshInterval> 0) wire:poll.{{ $refreshInterval }}s @endif>
    <x-stat-card :label="$label" :value="$value" :change="$change" :changeType="$changeType" :icon="$icon" />
</div>