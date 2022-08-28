<x-guest-layout>
    <h3 class="text-center mb-4">Login</h3>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <x-auth-card>


                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-label for="username" :value="__('Username')" />

                        <x-input id="username" class="" type="text" name="username" :value="old('username')" required
                            autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label text-sm">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-end mt-4">

                        <x-button class="ml-3">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </div>
</x-guest-layout>
