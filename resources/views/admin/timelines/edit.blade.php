@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('admin.timelines.index') }}">{{ __('Timeline') }}</a> > <span class="font-normal">{{ __('Edit Timeline') }}</span>
    </h2>
@endsection

@section('content')
    <div class="mt-6 bg-white shadow-md rounded-md">
        <form action="{{ route('admin.timelines.update', $timeline->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div>
                <label for="nama" class="block">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-input rounded-md w-full" value="{{ $timeline->nama }}">
            </div>
            <div class="mt-4">
                <label for="deskripsi" class="block">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-textarea rounded-md w-full p-2" rows="4">{{ $timeline->deskripsi }}</textarea>
            </div>
            <div class="mt-4">
                <label for="waktu" class="block">Waktu:</label>
                <input type="datetime-local" name="waktu" id="waktu" class="form-input rounded-md w-full" value="{{ $timeline->waktu->format('Y-m-d\TH:i') }}">
            </div>
            <div class="mt-4">
                <label for="status" class="block">Status:</label>
                <select name="status" id="status" class="form-select rounded-md w-full p-2">
                    <option value="Belum Mulai" {{ $timeline->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                    <option value="Mulai" {{ $timeline->status == 'Mulai' ? 'selected' : '' }}>Mulai</option>
                    <option value="Selesai" {{ $timeline->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Perpanjang" {{ $timeline->status == 'Perpanjang' ? 'selected' : '' }}>Perpanjang</option>
                </select>
            </div>
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Update Timeline</button>
            </div>
        </form>
    </div>
@endsection
