@extends('dashboard')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Diri') }}
    </h2>
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            @foreach ($datadiri as $data)
                @if ($data->user_id == auth()->user()->user_id)
                        <div>
                            <div>
                                <div class="grid grid-flow-col grid-cols-3 gap-3">
                                    <div>
                                        <x-label for="npsn" :value="__('NPSN')"></x-label>
                                        <x-input id="npsn" name="npsn" class=" block mt-1 w-full" type="text" value="{{ $data->npsn }}"
                                             disabled></x-input>
                                    </div>
                                    <div class="col-span-2">
                                        <x-label for="nim" :value="__('NIM')"></x-label>
                                        <x-input id="nim" class=" block mt-1 w-full" type="text" name="nim" value="{{ $data->nim }}"
                                            disabled></x-input>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <x-label for="name" :value="__('Nama Lengkap')"></x-label>
                                    <x-input id="name" class=" block mt-1 w-full" type="text"
                                        name="name" value="{{ $data->name }}" disabled></x-input>
                                </div>
                                <div class="mt-3">
                                    <x-label for="telp" :value="__('Nomor Whatsapp')"></x-label>
                                    <x-input id="telp" class=" block mt-1 w-full" type="text" name="telp"
                                    value="{{ $data->telp }}" disabled></x-input>
                                </div>
                                <div class="mt-3">
                                    <x-label for="email" :value="__('Email')"></x-label>
                                    <x-input id="email" class=" block mt-1 w-full" type="email" name="email"
                                    value="{{ $data->email }}" disabled></x-input>
                                </div>
                            </div>
                        </div>
                @endif
            @endforeach

        </div>
    </div>
    <div id="myModal"
        class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-orange-400 bg-opacity-50 hidden">
        <div class="bg-white rounded shadow-lg w-3/4 h-fit">
            <div
                class="relative px-4 py-2 flex bg-blue justify-center items-center h-14 font-batik text-red-600 text-lg rounded">
                <h3>Cari Kampus</h3>
                <button onclick="closeModal(event)" class="absolute top-3 right-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex justify-center py-2 px-3">
                <x-input id="searchInput" type="text"
                    class="form-input w-full h-10 rounded border text-sm border-grey-300"
                    placeholder="Ketik Nama Kampus"></x-input>
            </div>
            <div class="m-3 overflow-y-auto max-h-80" id="kampusList">
            </div>
        </div>
    </div>
@endsection

