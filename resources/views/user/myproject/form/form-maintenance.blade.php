@extends('user.myproject.model-bisnis')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{ route('create_kelompok') }}" method="post">
                @csrf
                <div>
                    <x-label for="nama_kelompok" :value="__('Nama Kelompok')"></x-label>
                    <x-input id="nama_kelompok" class=" block mt-1 w-full" type="text" name="nama_kelompok"></x-input>
                    <x-input id="user_id" value="{{ auth()->user()->user_id }}" class=" hidden" type="text"
                        name="user_id"></x-input>
                </div>
                <div class="col-span-2 mt-3">
                    <x-label for="judul_proposal" :value="__('Judul Proposal')"></x-label>
                    <x-input id="judul_proposal" class=" block mt-1 w-full" type="text" name="judul_proposal"
                        required></x-input>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Simpan') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection