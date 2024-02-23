<x-guest-layout>
    <div class="flex justify-center items-center h-screen bg-gray-50">
        <div class="max-w-md w-full">
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold text-gray-900">Instagram</h1>
                <p class="mt-2 text-sm text-gray-600">Sign up to see photos and videos from your friends.</p>
            </div>
            <form class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Phone -->
                <div class="mb-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Full Name -->
                <div class="mb-4">
                    <x-input-label for="fullname" :value="__('Fullname')" />
                    <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required autocomplete="fullname" />
                    <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="new-password" pla/>
                    <span id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-blue-500 hover:text-blue-600">
                        Show
                    </span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="text-sm text-gray-600 mb-6">
                    <p>People who use our service may have uploaded your contact information to Instagram. <a href="https://www.facebook.com/help/instagram/261704639352628?hl=en" class="text-blue-500">Learn More</a>.</p>
                </div>

                <div class="text-sm text-gray-600 mb-6">
                    <p>By signing up, you agree to our <a href="https://help.instagram.com/581066165581870/?locale=en_US&hl=en" class="text-blue-500">Terms</a>, <a href="https://www.facebook.com/privacy/policy?hl=en" class="text-blue-500">Privacy Policy</a>, and <a href="https://privacycenter.instagram.com/policies/cookies/" class="text-blue-500">Cookies Policy</a>.</p>
                </div>

                <div class="flex items-center justify-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-20 rounded-md">
                        {{ __('Sign Up') }}
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">Have an account? <a href="{{ route('login') }}" class="text-blue-500">Log in</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        const passwordInput = document.getElementById("password");
        const toggleText = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleText.textContent = "Hide";
        } else {
            passwordInput.type = "password";
            toggleText.textContent = "Show";
        }
    });
</script>
