<x-content-container>
    <x-page-header subtitle="Manage your teams and team members.">
        Teams
    </x-page-header>

    @if($teams->isEmpty())
    <x-empty-state>
        <x-slot:title>No teams yet</x-slot:title>
        <x-slot:description>You're not a member of any teams. Teams can be created to organize users, projects, and resources.</x-slot:description>
    </x-empty-state>
    @else
    <x-grid cols="3">
        @foreach($teams as $team)
        <x-card>
            <div class="space-y-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $team->name }}</h3>
                @if($team->description)
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $team->description }}</p>
                @endif
                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $team->users_count }} {{ Str::plural('member', $team->users_count) }}</p>
            </div>
        </x-card>
        @endforeach
    </x-grid>
    @endif
</x-content-container>