<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Attendance: ') }} {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 font-medium">Date: {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</p>
            </div>
            <a href="{{ route('admin.attendance.index') }}" class="text-gray-600 hover:text-gray-900 font-bold uppercase text-xs tracking-widest">
                &larr; Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.attendance.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $class->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                                    <th class="px-6 py-4">Student Name</th>
                                    <th class="px-6 py-4 text-center">Present</th>
                                    <th class="px-6 py-4 text-center">Absent</th>
                                    <th class="px-6 py-4 text-center">Late</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($class->students as $student)
                                    @php
                                        $status = $existingRecords->get($student->id)->status ?? 'present';
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium">{{ $student->name }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="present" {{ $status == 'present' ? 'checked' : '' }} class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300">
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="absent" {{ $status == 'absent' ? 'checked' : '' }} class="w-5 h-5 text-red-600 focus:ring-red-500 border-gray-300">
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="late" {{ $status == 'late' ? 'checked' : '' }} class="w-5 h-5 text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                                            No students assigned to this class.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($class->students->count() > 0)
                        <div class="bg-gray-50 px-6 py-4 border-t flex justify-end">
                            <x-primary-button class="px-8 py-3">
                                {{ __('Save Attendance Records') }}
                            </x-primary-button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
