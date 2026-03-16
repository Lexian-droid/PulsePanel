<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PulsePanel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex h-full flex-col items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 font-sans text-gray-900 antialiased dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
    <div class="text-center">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-600 shadow-lg shadow-primary-500/25">
            <svg class="h-9 w-9 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
        </div>

        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ config('app.name', 'PulsePanel') }}</h1>
        <p class="mx-auto mt-3 max-w-md text-lg text-gray-500 dark:text-gray-400">
            A clean, reusable Laravel dashboard starter template built with Blade, Livewire, and Tailwind CSS.
        </p>

        <div class="mt-8 flex items-center justify-center gap-4">
            <a href="{{ route('login') }}"
               class="inline-flex items-center rounded-lg bg-primary-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                Sign In
            </a>
            <a href="{{ route('login') }}"
               class="inline-flex items-center rounded-lg bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-300 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700">
                Go to Dashboard
            </a>
        </div>
    </div>

    <div class="fixed bottom-8 text-center text-xs text-gray-400 dark:text-gray-600">
        Built with Laravel, Livewire, and Tailwind CSS
    </div>
</body>
</html>
