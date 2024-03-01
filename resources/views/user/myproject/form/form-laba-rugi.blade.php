@extends('user.myproject.model-bisnis')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200">
            @foreach ($proposal as $data)
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('laba-rugi.input',['id_proposal' => $data->id_proposal]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-label for="deskripsi_laba_rugi" :value="__('Deskripsi Laba Rugi')"></x-label>
                        @if ($data->deskripsi_laba_rugi == null)
                            <x-input id="deskripsi_laba_rugi" class=" block mt-1 w-full" type="text" name="deskripsi_laba_rugi"></x-input>
                        @else
                            <x-input id="deskripsi_laba_rugi" class=" block mt-1 w-full" type="text" name="deskripsi_laba_rugi"
                                value="{{ $data->deskripsi_laba_rugi }}"></x-input>
                        @endif
                    </div>
                    <div class="col-span-2 mt-3">
                        <x-label for="file_laba_rugi" :value="__('Laba Rugi File')"></x-label>
                        @if ($data->file_laba_rugi == null)
                            <x-input id="file_laba_rugi"
                                class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3"
                                type="file" name="file_laba_rugi" accept="application/pdf"></x-input>
                        @else
                            <x-input id="file_laba_rugi"
                                class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3"
                                type="file" name="file_laba_rugi"
                                value="{{ $data->file_laba_rugi }}"></x-input>
                                <a href="{{ asset('storage/file_laba_rugi/' . $data->file_laba_rugi) }}" class="font-bold">Download {{ $data->file_laba_rugi }}</a>
                        @endif
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('Simpan') }}
                        </x-button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection
