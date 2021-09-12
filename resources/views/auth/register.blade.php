<x-guest-layout>
    <x-auth-card>


        <!-- Validation Errors -->

        <form method="POST" action="{{ route('register') }}" class="w-75 mx-auto">
            @csrf

            <div class="row">
                <!-- Name -->
                <div class="col-md-6">
                    <div class="mt-4">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                            autofocus />

                        @error('name')
                            <span class="h6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Email Address -->
                <div class="col-md-6">
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required />
                        @error('email')
                            <span class="h6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="col-md-6">
                    <!-- Phone Address -->
                    <div class="mt-4">
                        <x-label for="phone" :value="__('Phone')" />

                        <x-input id="phone" class="form-control" type="number" name="phone" :value="old('phone')"
                            required />

                        @error('phone')
                            <span class="h6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>



                <div class="col-md-6">

                    <!-- Address Address -->
                    <div class="mt-4">
                        <x-label for="address" :value="__('Address')" />

                        <x-input id="address" class="form-control" type="text" name="address" :value="old('address')"
                            required />

                        @error('address')
                            <span class="h6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />

                        @error('password')
                            <span class="h6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>



                <div class="col-md-6">

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required />
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
