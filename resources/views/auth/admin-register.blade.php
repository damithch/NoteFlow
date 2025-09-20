<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Admin Registration</h2>
        <p class="text-sm text-gray-600 mt-2">Create an administrator account with full system privileges</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Admin Registration Code -->
        <div class="mt-4">
            <x-input-label for="admin_code" :value="__('Admin Registration Code')" />
            <x-text-input id="admin_code" class="block mt-1 w-full"
                            type="password"
                            name="admin_code"
                            required 
                            placeholder="Enter the admin registration code" />
            <x-input-error :messages="$errors->get('admin_code')" class="mt-2" />
            <p class="text-sm text-gray-600 mt-1">⚠️ You need a valid admin code to create an admin account.</p>
        </div>

        <!-- Admin Privileges Notice -->
        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <h4 class="font-semibold text-yellow-800 mb-2">🔑 Admin Account Privileges</h4>
            <ul class="text-sm text-yellow-700 space-y-1">
                <li>• View and manage all users' notes</li>
                <li>• Access system statistics and analytics</li>
                <li>• Full administrative dashboard access</li>
                <li>• User management capabilities</li>
            </ul>
        </div>

        <div class="flex items-center justify-between mt-6">
            <div class="flex flex-col space-y-2">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('Register as regular user') }}
                </a>
            </div>

            <x-primary-button class="ms-4">
                {{ __('Create Admin Account') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <h4 class="font-semibold text-blue-800 mb-2">💡 Testing Information</h4>
        <p class="text-sm text-blue-700">
            For demo purposes, you can use the admin code: <code class="bg-blue-100 px-2 py-1 rounded">ADMIN2025</code>
        </p>
    </div>
</x-guest-layout>