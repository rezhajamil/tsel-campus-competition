@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create Timeline') }}
    </h2>
@endsection

@section('content')
    <div class="mt-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 bg-white sm:p-6">
            <form action="{{ route('admin.timelines.store') }}" method="POST">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" autocomplete="off" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mt-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>

                <div class="mt-4">
                    <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu</label>
                    <input type="datetime-local" name="waktu" id="waktu" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mt-4">
                    <label for="mulai" class="block text-sm font-medium text-gray-700">Mulai</label>
                    <input type="datetime-local" name="mulai" id="mulai" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mt-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="Belum mulai">Belum Mulai</option>
                        <option value="Mulai">Mulai</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Perpanjang">Perpanjang</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Timeline
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
