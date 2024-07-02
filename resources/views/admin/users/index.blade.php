@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('USER') }}
    </h2>
@endsection

@section('content')
    <div class="p-8">
        <div class="mb-4">
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="flex items-center">
                    <input type="text" name="search"
                        class="w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Search users by name, email, NPSN, or NIM..." value="{{ request('search') }}">
                    <button type="submit"
                        class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NPSN
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Telephone</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->npsn }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->telp }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($users->isEmpty())
            <p class="text-gray-500 text-center mt-4">No users found.</p>
        @endif
    </div>
@endsection
