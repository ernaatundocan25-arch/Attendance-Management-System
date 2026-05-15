<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="p-6 bg-blue-50 border border-blue-100 rounded-lg text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ \App\Models\User::where('role', 'student')->count() }}</div>
                        <div class="text-sm text-blue-500 uppercase tracking-wider font-semibold">Students</div>
                    </div>
                    <div class="p-6 bg-green-50 border border-green-100 rounded-lg text-center">
                        <div class="text-3xl font-bold text-green-600">{{ \App\Models\SchoolClass::count() }}</div>
                        <div class="text-sm text-green-500 uppercase tracking-wider font-semibold">Classes</div>
                    </div>
                    <div class="p-6 bg-purple-50 border border-purple-100 rounded-lg text-center">
                        <div class="text-3xl font-bold text-purple-600">{{ \App\Models\Attendance::whereDate('date', today())->count() }}</div>
                        <div class="text-sm text-purple-500 uppercase tracking-wider font-semibold">Today's Attendance</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border rounded-lg p-6 hover:bg-gray-50 transition">
                        <h3 class="text-lg font-bold mb-2">Manage Students</h3>
                        <p class="text-gray-600 mb-4">Add, edit, or remove students from the system.</p>
                        <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Go to Students
                        </a>
                    </div>
                    <div class="border rounded-lg p-6 hover:bg-gray-50 transition">
                        <h3 class="text-lg font-bold mb-2">Manage Classes</h3>
                        <p class="text-gray-600 mb-4">Create classes and assign students to sections.</p>
                        <a href="{{ route('admin.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Go to Classes
                        </a>
                    </div>
                    <div class="border rounded-lg p-6 hover:bg-gray-50 transition">
                        <h3 class="text-lg font-bold mb-2">Mark Attendance</h3>
                        <p class="text-gray-600 mb-4">Record daily attendance for any class.</p>
                        <a href="{{ route('admin.attendance.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Mark Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
