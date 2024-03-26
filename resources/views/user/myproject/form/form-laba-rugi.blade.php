@extends('user.myproject.model-bisnis')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200">
            @foreach ($pendaftarans as $daftar)
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('laba-rugi.input', ['id_proposal' => $daftar->proposal->id_proposal]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-label for="deskripsi_laba_rugi" :value="__('Deskripsi Laba Rugi')"></x-label>
                        @if ($daftar->proposal->deskripsi_laba_rugi == null)
                            <input id="deskripsi_laba_rugi" type="hidden" name="deskripsi_laba_rugi">
                            <trix-editor input="deskripsi_laba_rugi"></trix-editor>
                        @else
                            <input id="deskripsi_laba_rugi" type="hidden" name="deskripsi_laba_rugi">
                            <trix-editor input="deskripsi_laba_rugi"></trix-editor>
                        @endif
                    </div>
                    <div class="col-span-2 mt-3">
                        <x-label for="file_laba_rugi" :value="__('Laba Rugi File')"></x-label>
                        @if ($daftar->proposal->file_laba_rugi == null)
                            <x-input id="file_laba_rugi"
                                class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3"
                                type="file" name="file_laba_rugi" accept="application/pdf"></x-input>
                        @else
                            <x-input id="file_laba_rugi"
                                class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3"
                                type="file" name="file_laba_rugi" value="{{ $daftar->proposal->file_laba_rugi }}"></x-input>
                            <a href="{{ asset('storage/model_bisnis_canvas/' . $daftar->proposal->model_bisnis_canvas) }}">
                                <button type="button"
                                    class="mt-3 text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-5 me-2 -ms-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    {{ $daftar->proposal->model_bisnis_canvas }}
                                </button></a>
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
