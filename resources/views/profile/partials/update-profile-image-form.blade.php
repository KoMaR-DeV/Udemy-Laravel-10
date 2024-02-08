<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Image
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your profile image
        </p>
    </header>

    <img src="{{ asset('storage/' . $user->image?->path) }}" alt="profile image">

    <form action="{{ route('profile.image') }}" method="post" class="p-4" enctype="multipart/form-data">
        @csrf
        
        <label class="block mb-4">
            <span class="sr-only">Choose File</span>
            <input type="file" name="image"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
            <x-input-error class="mt-2" :messages="$errors->get('image')"/>
        </label>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'image-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    Saved</p>
            @endif
        </div>
    </form>
</section>
