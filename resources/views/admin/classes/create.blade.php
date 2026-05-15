<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('admin.classes.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Class / Section Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required placeholder="e.g. BSIT 1A" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Create Class') }}</x-primary-button>
                        <a href="{{ route('admin.classes.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline font-semibold">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
