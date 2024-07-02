<!-- resources/views/admin/proposals/edit.blade.php -->
@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detail Proposal') }}
    </h2>
@endsection

@section('content')
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6 grid grid-cols-2">
            <div class="w-full h-full">
                <div class="pb-4">
                    <span class="font-batik text-red-500">Nama Kelompok</span>
                    <p class="text-2xl font-semibold">{{ $proposal->kelompok->nama_kelompok }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500">Anggota Kelompok</span>
                    @foreach ($peserta as $anggota)
                        <div class="py-1">
                            <p class="text-lg font-semibold">{{ $anggota->npsn }} - {{ $anggota->nama_lengkap }} <span class="text-sm font-light">({{ $anggota->jabatan }})</span> </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full h-full">
                <div class="pb-4">
                    <span class="font-batik text-red-500">Judul Proposal</span>
                    <p class="text-2xl font-semibold">{{ $proposal->judul_proposal }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500">Ide Bisnis</span>
                    <p class="text-2xl font-semibold">{{ $proposal->ide_bisnis }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500 mb-2">Bisnis Model Canvas</span>
                    <div class="py-2">
                        <a href="{{ asset('storage/' . $proposal->model_bisnis_canvas) }}" target="_blank"
                            class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->model_bisnis_canvas }}</a>
                    </div>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500">Laba Rugi</span>
                    <p class="text-2xl font-semibold">{{ $proposal->deskripsi_laba_rugi }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500 mb-2">File Laba Rugi</span>
                    <div class="py-2">
                        <a href="{{ asset('storage/' . $proposal->file_laba_rugi) }}" target="_blank"
                            class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->file_laba_rugi }}</a>
                    </div>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500">Pemasaran</span>
                    <p class="text-2xl font-semibold">{{ $proposal->deskripsi_pemasaran }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500 mb-2">File Pemasaran</span>
                    <div class="py-2">
                        <a href="{{ asset('storage/' . $proposal->file_pemasaran) }}" target="_blank"
                            class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->file_pemasaran }}</a>
                    </div>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500">Maintenance</span>
                    <p class="text-2xl font-semibold">{{ $proposal->deskripsi_maintenance }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500 mb-2">File Maintenance</span>
                    <div class="py-2">
                        <a href="{{ asset('storage/' . $proposal->file_maintenance) }}" target="_blank"
                            class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->file_maintenance }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
