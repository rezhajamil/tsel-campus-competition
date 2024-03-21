@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Peserta') }}
    </h2>
@endsection

@section('content')
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6">
        <form action="{{ route('admin.Pesertas.update', $peserta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('nama_lengkap', $peserta->nama_lengkap) }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="npsn" class="block text-gray-700 text-sm font-bold mb-2">NPSN:</label>
                    <input type="text" name="npsn" id="npsn" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('npsn', $peserta->npsn) }}" required>
                </div>

                <div class="mb-4">
                    <label for="nim" class="block text-gray-700 text-sm font-bold mb-2">NIM:</label>
                    <input type="text" name="nim" id="nim" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('nim', $peserta->nim) }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('email', $peserta->email) }}" required>
                </div>

                <div class="mb-4">
                    <label for="nomor_wa" class="block text-gray-700 text-sm font-bold mb-2">Nomor WA:</label>
                    <input type="text" name="nomor_wa" id="nomor_wa" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('nomor_wa', $peserta->nomor_wa) }}" required>
                </div>

                <div class="mb-4">
                    <label for="kemampuan_deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Kemampuan Deskripsi:</label>
                    <textarea name="kemampuan_deskripsi" id="kemampuan_deskripsi" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                        required>{{ old('kemampuan_deskripsi', $peserta->kemampuan_deskripsi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="jabatan" class="block text-gray-700 text-sm font-bold mb-2">Jabatan:</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('jabatan', $peserta->jabatan) }}" required>
                </div>

                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.Pesertas.index') }}"
                        class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
