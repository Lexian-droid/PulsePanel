@php
$title ??= null;
$breadcrumbs ??= [];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'PulsePanel') }} — {{ config('app.name', 'PulsePanel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="h-full bg-gray-50 font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    <div class="flex h-full" x-data="{ sidebarOpen: false }">
        {{-- Mobile sidebar overlay --}}
        <div x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-black/50 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak>
        </div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 transform bg-sidebar transition-transform duration-200 ease-in-out lg:static lg:translate-x-0">
            <x-sidebar />
        </aside>

        {{-- Main content --}}
        <div class="flex flex-1 flex-col overflow-hidden lg:pl-0">
            <x-topbar />

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if(count($breadcrumbs))
                <x-breadcrumb :items="$breadcrumbs" />
                @endif

                @if(isset($header))
                <x-page-header>{{ $header }}</x-page-header>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>