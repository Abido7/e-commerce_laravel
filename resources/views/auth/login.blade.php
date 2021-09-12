<x-guest-layout>
    <x-auth-card>


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-2" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('login') }}" class="w-50 mx-auto">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                    autofocus />
                @error('email')
                    <span class="h6 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="form-control" type="password" name="password" required
                    autocomplete="current-password" />
                @error('password')
                    <span class="h6 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="d-flex align-items-center">
                    <input id="remember_me" type="checkbox" class="mx-1 check-box" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
