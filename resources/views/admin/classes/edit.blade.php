<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Class & Assign Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('admin.classes.update', $class) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-8">
                        <x-input-label for="name" :value="__('Class Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $class->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-8 bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Assign Students to this Class</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-4">Select students to include in this section.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 max-h-96 overflow-y-auto pr-2">
                            @forelse($students as $student)
                                <label class="flex items-center p-3 bg-white border rounded-lg cursor-pointer hover:border-indigo-400 transition">
                                    <input type="checkbox" name="students[]" value="{{ $student->id }}" 
                                        {{ in_array($student->id, $assignedStudents) ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm font-medium text-gray-700">{{ $student->name }}</span>
                                </label>
                            @empty
                                <div class="col-span-full py-6 text-center text-gray-500 italic">No students registered yet.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update Class & Assignments') }}</x-primary-button>
                        <a href="{{ route('admin.classes.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline font-semibold">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
