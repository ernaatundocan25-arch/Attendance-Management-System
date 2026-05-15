<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Classes & Sections') }}
            </h2>
            <a href="{{ route('admin.classes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                + Create New Class
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Filter -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.classes.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-grow">
                        <x-text-input name="search" type="text" class="w-full" placeholder="Search by class name..." :value="request('search')" />
                    </div>
                    <x-primary-button>
                        {{ __('Search') }}
                    </x-primary-button>
                    @if(request('search'))
                        <a href="{{ route('admin.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition">
                            {{ __('Clear') }}
                        </a>
                    @endif
                </form>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                                <th class="px-6 py-3">Class Name</th>
                                <th class="px-6 py-3">Total Students</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($classes as $class)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $class->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $class->students_count }} Students</td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('admin.classes.edit', $class) }}" class="text-blue-600 hover:text-blue-900 font-semibold text-sm">Edit / Assign</a>
                                        <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500 italic">
                                        No classes found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
