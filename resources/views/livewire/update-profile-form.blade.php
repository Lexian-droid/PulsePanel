<div class="space-y-8">
    {{-- Profile Information --}}
    <x-card>
        <x-slot:header>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Profile Information</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update your account's profile information and email address.</p>
        </x-slot:header>

        <form wire:submit="updateProfile" class="space-y-4">
            <x-form-field label="Name" :error="$errors->first('name')" required>
                <x-input wire:model="name" />
            </x-form-field>

            <x-form-field label="Email address" :error="$errors->first('email')" required>
                <x-input type="email" wire:model="email" />
            </x-form-field>

            <div class="flex items-center gap-3">
                <x-button type="submit">Save Changes</x-button>
                @if($showProfileSaved)
                <p class="text-sm text-success-600 dark:text-success-500" x-data x-init="setTimeout(() => $wire.set('showProfileSaved', false), 2000)" x-transition>Saved.</p>
                @endif
            </div>
        </form>
    </x-card>

    {{-- Update Password --}}
    <x-card>
        <x-slot:header>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Password</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
        </x-slot:header>

        <form wire:submit="updatePassword" class="space-y-4">
            <x-form-field label="Current Password" :error="$errors->first('current_password')" required>
                <x-input type="password" wire:model="current_password" />
            </x-form-field>

            <x-form-field label="New Password" :error="$errors->first('password')" required>
                <x-input type="password" wire:model="password" />
            </x-form-field>

            <x-form-field label="Confirm Password" required>
                <x-input type="password" wire:model="password_confirmation" />
            </x-form-field>

            <div class="flex items-center gap-3">
                <x-button type="submit">Update Password</x-button>
                @if($showPasswordSaved)
                <p class="text-sm text-success-600 dark:text-success-500" x-data x-init="setTimeout(() => $wire.set('showPasswordSaved', false), 2000)" x-transition>Saved.</p>
                @endif
            </div>
        </form>
    </x-card>
</div>