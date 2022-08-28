<x-guest-layout>
    <h3 class="text-center mb-4">Register</h3>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <x-auth-card>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />

                        <x-input id="name" class="" type="text" name="name" :value="old('name')" required
                            autofocus />
                    </div>

                    <!-- Username -->
                    <div class="mt-4">
                        <x-label for="username" :value="__('Username')" />

                        <x-input id="username" class="" type="text" name="username" :value="old('username')"
                            required />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="" type="email" name="email" :value="old('email')"
                            required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="" type="password" name="password_confirmation"
                            required />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a class="text-muted" href="{{ route('login') }}"
                            style="margin-right: 15px; margin-top: 15px;">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </div>
</x-guest-layout>
