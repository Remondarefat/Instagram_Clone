<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    

    <form method="POST" action="{{ route('login') }}" class="p-5 border-solid border-2 ">
        @csrf
        <div  class=" p-5">
            <img src="{{asset('info.svg')}}" >
        </div>
        <!-- Email Address -->
        <div class="mt-5">
            <!-- <x-input-label for="email" :value="__('Email')" /> -->
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Phone number ,username or email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <!-- <x-input-label for="password" :value="__('Password')" /> -->

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 bg-gray-100" name="remember" placeholder="Password">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-4">
            
            <button class="bg-[#0ea5e9] hover:bg-blue-600 text-white font-bold py-2 px-20 block w-full rounded-md  fs-md  ">
                {{ __('Sign in') }}
            </button>
                <div class="or-container p-3">
                    <span class="or-word text-light fw-bold">OR</span>
                </div>
                
                <x-primary-button class="ms-3">
                    <a  href="{{route('auth.socialite.redirect', ['provider' => 'facebook'])}}">Facebook</a>
                </x-primary-button>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class=" text-md mt-5 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </div>
    </form>
    <div class=" border-solid border-2 mt-3 p-5 text-center ">
        Don't have an account? <span class="text-red">registration</span>
    </div>
</x-guest-layout>
