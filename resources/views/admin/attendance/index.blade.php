<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Record New Attendance Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-indigo-500">
                <div class="max-w-md mx-auto">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 text-center uppercase tracking-widest">Record New Attendance</h3>
                    <p class="text-xs text-gray-500 mb-6 text-center italic">Select a class and date to begin.</p>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.attendance.create') }}" method="GET">
                        <div class="mb-4">
                            <x-input-label for="class_id" :value="__('Select Class')" />
                            <select name="class_id" id="class_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" required>
                                <option value="">-- Choose Class --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="date" :value="__('Select Date')" />
                            <x-text-input id="date" class="block mt-1 w-full text-sm" type="date" name="date" :value="date('Y-m-d')" required />
                        </div>

                        <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 shadow-md">
                            {{ __('Continue to Mark Attendance') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <!-- Attendance History Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b bg-gray-50 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Attendance History / Filter</h3>
                    
                    <form action="{{ route('admin.attendance.index') }}" method="GET" class="flex flex-wrap gap-2">
                        <select name="filter_class" class="text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Classes</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('filter_class') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                        <input type="date" name="filter_date" value="{{ request('filter_date') }}" class="text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-primary-button class="px-3 py-1 text-[10px]">Filter</x-primary-button>
                        @if(request('filter_class') || request('filter_date'))
                            <a href="{{ route('admin.attendance.index') }}" class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 text-[10px] font-bold uppercase rounded-md hover:bg-gray-300">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Class Name</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($sessions as $session)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $session->schoolClass->name }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.attendance.create', ['class_id' => $session->class_id, 'date' => $session->date]) }}" class="text-indigo-600 hover:text-indigo-900 font-black text-xs uppercase tracking-widest">
                                            View / Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500 italic">
                                        No attendance records found.
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
