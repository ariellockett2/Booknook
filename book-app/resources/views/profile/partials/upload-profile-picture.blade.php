<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Upload Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Choose a clear profile picture to personalize your account.') }}
        </p>
    </header>

    <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div> 
            <x-input-label for="profile_picture" :value="__('Upload Profile Picture')" />
            <x-text-input
                id="profile_picture"
                type="file"
                name="profile_picture"
                class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                @error('profile_picture') border-red-500 @enderror"
            />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Upload') }}</x-primary-button>

            @if (session('status') === 'profile-picture-uploaded')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"></p>
            @endif
        </div>
    </form>
</section>
