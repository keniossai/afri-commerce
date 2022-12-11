{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


    <div class="login-popup">
        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
            <ul class="nav nav-tabs text-uppercase" role="tablist">
                <li class="nav-item">
                    <a href="#sign-in" class="nav-link active">Sign In</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="sign-in">
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Username or email address *</label>
                            <input type="email" class="form-control" name="email" id="email" required autofocus :value="old('email')">
                        </div>
                        <div class="form-group mb-0">
                            <label>Password *</label>
                            <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password">
                        </div>
                        <div class="form-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                            <a href="{{route('password.request')}}">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </form>
                </div>
            </div>
            <p class="text-center">Sign in with social account</p>
            <div class="social-icons social-icon-border-color d-flex justify-content-center">
                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                <a href="#" class="social-icon social-google fab fa-google"></a>
            </div>
        </div>
    </div>

