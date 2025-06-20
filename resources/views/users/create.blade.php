<x-layouts.app>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('User Create') }}</h1>
    </div>

    <div class="mb-4 flex justify-end items-end">
        <a href="{{ route('users') }}"
           class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-1 px-3 rounded">
            Back
        </a>
    </div>

    <div class="max-w-2xl mx-auto overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <form method="POST" action="{{ route('users.create') }}">
            @csrf

            <!-- Full Name Input -->
            <div class="mb-4">
                <x-forms.input
                    label="Full Name"
                    name="name"
                    type="text"
                    placeholder="{{ __('Full Name') }}"
                />
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <x-forms.input
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="your@email.com"
                />
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <x-forms.input
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="••••••••"
                />
            </div>

            <!-- Confirm Password Input -->
            <div class="mb-6">
                <x-forms.input
                    label="Confirm Password"
                    name="password_confirmation"
                    type="password"
                    placeholder="••••••••"
                />
            </div>

            <!-- Register Button -->
            <div>
                <x-button type="primary" class="w-full">
                    {{ __('Create Account') }}
                </x-button>
            </div>
        </form>
    </div>
</x-layouts.app>
