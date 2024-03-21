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
                                    <x-input id="npsn" name="npsn" class=" block mt-1 w-full" type="text"
                                        value="{{ $data->npsn }}" readonly></x-input>
                                </div>
                                <div class="col-span-2">
                                    <x-label for="nim" :value="__('NIM')"></x-label>
                                    <x-input id="nim" class=" block mt-1 w-full" type="text" name="nim"
                                        value="{{ $data->nim }}" readonly></x-input>
                                </div>
                            </div>
                            <div class="mt-3">
                                <x-label for="name" :value="__('Nama Lengkap')"></x-label>
                                <x-input id="name" class=" block mt-1 w-full" type="text" name="name"
                                    value="{{ $data->name }}" readonly></x-input>
                            </div>
                            <div class="mt-3">
                                <x-label for="telp" :value="__('Nomor Whatsapp')"></x-label>
                                <x-input id="telp" class=" block mt-1 w-full" type="text" name="telp"
                                    value="{{ $data->telp }}" readonly></x-input>
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center gap-1">
                                    <x-label for="email" :value="__('Email')"></x-label>
                                    @if (Auth::user()->email_verified_at != NULL)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="green" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    @endif
                                </div>
                                <x-input id="email" class=" block mt-1 w-full" type="email" name="email"
                                    value="{{ $data->email }}" readonly></x-input>
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
