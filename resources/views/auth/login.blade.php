<x-layouts.guest>
    <x-slot:title>Login</x-slot:title>

    <div class="w-full max-w-sm">
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-primary-600">
                <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Sign in to {{ config('app.name') }}</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter your credentials to access the dashboard.</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10">
            @if($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-danger-50 p-3 text-sm text-red-800 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <x-form-field label="Email address" required>
                    <x-input type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
                </x-form-field>

                <x-form-field label="Password" required>
                    <x-input type="password" name="password" required placeholder="••••••••" />
                </x-form-field>

                <div class="flex items-center justify-between">
                    <x-checkbox name="remember" label="Remember me" />
                </div>

                <x-button type="submit" class="w-full">
                    Sign In
                </x-button>
            </form>
        </div>
    </div>
</x-layouts.guest>