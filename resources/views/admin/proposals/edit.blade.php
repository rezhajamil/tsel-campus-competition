<!-- resources/views/admin/proposals/edit.blade.php -->
@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detail Proposal') }}
    </h2>
@endsection

@section('content') 
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.proposals.update', $proposal->id_proposal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="judul_proposal" class="block text-gray-700 text-sm font-bold mb-2">Judul Proposal:</label>
                    <input type="text" name="judul_proposal" id="judul_proposal" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('judul_proposal', $proposal->judul_proposal) }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="ide_bisnis" class="block text-gray-700 text-sm font-bold mb-2">Ide Bisnis:</label>
                    <textarea name="ide_bisnis" id="ide_bisnis" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                        required>{{ old('ide_bisnis', $proposal->ide_bisnis) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="model_bisnis_canvas" class="block text-gray-700 text-sm font-bold mb-2">Model Bisnis Canvas:</label>
                    <textarea name="model_bisnis_canvas" id="model_bisnis_canvas" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                        required>{{ old('model_bisnis_canvas', $proposal->model_bisnis_canvas) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="deskripsi_laba_rugi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Laba Rugi:</label>
                    <textarea name="deskripsi_laba_rugi" id="deskripsi_laba_rugi" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                        required>{{ old('deskripsi_laba_rugi', $proposal->deskripsi_laba_rugi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="file_laba_rugi" class="block text-gray-700 text-sm font-bold mb-2">File Laba Rugi:</label>
                    <input type="file" name="file_laba_rugi" id="file_laba_rugi" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    @if ($proposal->file_laba_rugi)
                        <a href="{{ asset('storage/' . $proposal->file_laba_rugi) }}" target="_blank">{{ $proposal->file_laba_rugi }}</a>
                    @else
                        <span class="text-gray-500">No file uploaded</span>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="deskripsi_pemasaran" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Pemasaran:</label>
                    <textarea name="deskripsi_pemasaran" id="deskripsi_pemasaran" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                        required>{{ old('deskripsi_pemasaran', $proposal->deskripsi_pemasaran) }}</textarea>
                </div>


                <div class="mb-4">
                    <label for="file_pemasaran" class="block text-gray-700 text-sm font-bold mb-2">File Pemasaran:</label>
                    <input type="file" name="file_pemasaran" id="file_pemasaran" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    @if ($proposal->file_pemasaran)
                        <a href="{{ asset('storage/' . $proposal->file_pemasaran) }}" target="_blank">{{ $proposal->file_pemasaran }}</a>
                    @else
                        <span class="text-gray-500">No file uploaded</span>
                    @endif
                </div>

                

                <div class="mb-4">
                    <label for="deskripsi_maintenance" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Maintenance:</label>
                    <textarea name="deskripsi_maintenance" id="deskripsi_maintenance" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                        required>{{ old('deskripsi_maintenance', $proposal->deskripsi_maintenance) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="file_maintenance" class="block text-gray-700 text-sm font-bold mb-2">File Maintenance:</label>
                    <input type="file" name="file_maintenance" id="file_maintenance" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    @if ($proposal->file_maintenance)
                        <a href="{{ asset('storage/' . $proposal->file_maintenance) }}" target="_blank">{{ $proposal->file_maintenance }}</a>
                    @else
                        <span class="text-gray-500">No file uploaded</span>
                    @endif
                </div>


                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.proposals.index') }}"
                        class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
