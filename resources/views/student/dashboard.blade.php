<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="p-6 bg-green-50 border border-green-200 rounded-xl text-center">
                        <div class="text-4xl font-black text-green-600">{{ $stats['present'] }}</div>
                        <div class="text-xs text-green-700 uppercase tracking-widest font-bold mt-1">Present</div>
                    </div>
                    <div class="p-6 bg-red-50 border border-red-200 rounded-xl text-center">
                        <div class="text-4xl font-black text-red-600">{{ $stats['absent'] }}</div>
                        <div class="text-xs text-red-700 uppercase tracking-widest font-bold mt-1">Absent</div>
                    </div>
                    <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-xl text-center">
                        <div class="text-4xl font-black text-yellow-600">{{ $stats['late'] }}</div>
                        <div class="text-xs text-yellow-700 uppercase tracking-widest font-bold mt-1">Late</div>
                    </div>
                </div>

                <div class="border rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h3 class="font-bold text-gray-800">My Attendance History</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Class</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($attendances as $attendance)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $attendance->schoolClass->name }}</td>
                                        <td class="px-6 py-4">
                                            @if($attendance->status == 'present')
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase">Present</span>
                                            @elseif($attendance->status == 'absent')
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase">Absent</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold uppercase">Late</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500 italic">
                                            No attendance records found yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
