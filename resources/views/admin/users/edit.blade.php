<!-- resources/views/admin/users/edit.blade.php -->
@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit User') }}
    </h2>
@endsection

@section('content') 
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('name', $user->name) }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-4">
                    <label for="telp" class="block text-gray-700 text-sm font-bold mb-2">Telephone:</label>
                    <input type="text" name="telp" id="telp" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('telp', $user->telp) }}" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                    <select name="role" id="role"
                        class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="peserta" {{ old('role', $user->role) == 'perserta' ? 'selected' : '' }}>Peserta</option>
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
