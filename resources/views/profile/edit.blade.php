<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit profile') }}
        </h1>
    </x-slot>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="border border-gray-200-dark p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl flex items-center justify-between">
                <div class="flex-shrink-0">
                    <div class="mt-1 relative rounded-full overflow-hidden bg-gray-100 h-14 w-14">
                        <img id="preview-image" src="{{ Auth::user()->profile_photo_url }}" alt="Profile Picture" class="h-full w-full object-cover" />
                        <input type="file" name="avatar" id="avatar" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ Auth::user()->username }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->fullname }}</span>
                    </div>
                </div>
                <label for="avatar" class="bg-blue-500 text-white px-3 py-1 rounded-md cursor-pointer">Change photo</label>
            </div>
        </div>

        <div>
            <label for="website" class="block text-xl font-medium text-black dark:text-gray-700">Website</label>
            <input type="text" name="website" id="website" placeholder="Website" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-gray-600">Editing your links is only available on mobile. Visit the Instagram app and edit your profile to change the websites<br> in your bio.</p>
        </div>

        <div>
            <label for="bio" class="block text-xl font-medium text-black dark:text-gray-700">Bio</label>
            <div class="flex items-center">
                <input type="text" name="bio" id="bio" placeholder="Bio" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <p id="wordCount" class="ml-2 text-sm text-gray-500 dark:text-gray-400">0/150</p>
            </div>
        </div>

        <div>
            <label for="gender" class="block text-xl font-medium text-black dark:text-gray-700">Gender</label>
            <select name="gender" id="gender" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="female">Female</option>
                <option value="male">Male</option>
                <option value="prefer_not_to_say">Prefer not to say</option>
            </select>
            <p class="mt-2 text-sm text-gray-600">This won’t be part of your public profile.</p>
        </div>


        </div>
    </div>
    <div class="flex items-center justify-end mr-10 mb-10">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-20 rounded-md">
            {{ __('Submit') }}
        </button>
    </div>
    </form>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    // JavaScript to handle file upload and preview
    const avatarInput = document.getElementById('avatar');
    const previewImage = document.getElementById('preview-image');
    avatarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImage.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    const bioInput = document.getElementById('bio');
    const wordCount = document.getElementById('wordCount');

    bioInput.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(Boolean);
        const wordCountValue = words.length;

        if (wordCountValue > 150) {
            // Trim excess words if more than 150
            this.value = this.value.trim().split(/\s+/).slice(0, 150).join(' ');
        }

        wordCount.textContent = `${wordCountValue}/150`;
    });
</script>
