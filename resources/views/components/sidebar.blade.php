<div class="flex h-full flex-col">
    {{-- Logo --}}
    <div class="flex h-16 items-center px-5 border-b border-white/10">
        <a href="{{ route('dashboard') }}" wire:navigate>
            <x-app-logo />
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        <x-sidebar-section label="Main">
            <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="home">
                Dashboard
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard.analytics') }}" :active="request()->routeIs('dashboard.analytics')" icon="chart">
                Analytics
            </x-sidebar-link>
        </x-sidebar-section>

        <x-sidebar-section label="Content">
            <x-sidebar-link href="{{ route('dashboard.tables') }}" :active="request()->routeIs('dashboard.tables')" icon="table">
                Tables
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard.components') }}" :active="request()->routeIs('dashboard.components')" icon="cube">
                Components
            </x-sidebar-link>
        </x-sidebar-section>

        @can('manage users')
        <x-sidebar-section label="Administration">
            <x-sidebar-link href="{{ route('dashboard.roles') }}" :active="request()->routeIs('dashboard.roles')" icon="cog">
                Role Editor
            </x-sidebar-link>
        </x-sidebar-section>
        @endcan

        @if(config('pulsepanel.features.teams'))
        <x-sidebar-section label="Organization">
            <x-sidebar-link href="{{ route('dashboard.teams') }}" :active="request()->routeIs('dashboard.teams*')" icon="cube">
                Teams
            </x-sidebar-link>
        </x-sidebar-section>
        @endif

        <x-sidebar-section label="Account">
            <x-sidebar-link href="{{ route('dashboard.settings') }}" :active="request()->routeIs('dashboard.settings')" icon="cog">
                Settings
            </x-sidebar-link>
        </x-sidebar-section>
    </nav>

    {{-- Footer --}}
    <div class="border-t border-white/10 px-4 py-3">
        <div class="flex items-center gap-3">
            <x-avatar :name="auth()->user()->name" size="sm" />
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                <p class="truncate text-xs text-gray-400">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</div>