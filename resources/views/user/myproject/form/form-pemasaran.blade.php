@extends('user.myproject.model-bisnis')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200">
            @foreach ($proposal as $data)
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('pemasaran.input',['id_proposal' => $data->id_proposal]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-label for="deskripsi_pemasaran" :value="__('Deskripsi Pemasaran')"></x-label>
                        @if ($data->deskripsi_pemasaran == null)
                            <x-input id="deskripsi_pemasaran" class=" block mt-1 w-full" type="text" name="deskripsi_pemasaran"></x-input>
                        @else
                            <x-input id="deskripsi_pemasaran" class=" block mt-1 w-full" type="text" name="deskripsi_pemasaran"
                                value="{{ $data->deskripsi_pemasaran }}"></x-input>
                        @endif
                    </div>
                    <div class="col-span-2 mt-3">
                        <x-label for="file_pemasaran" :value="__('Pemasaran File')"></x-label>
                        @if ($data->file_pemasaran == null)
                            <x-input id="file_pemasaran"
                                class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3"
                                type="file" name="file_pemasaran" accept="application/pdf"></x-input>
                        @else
                            <x-input id="file_pemasaran"
                                class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3"
                                type="file" name="file_pemasaran"
                                value="{{ $data->file_pemasaran }}"></x-input>
                                <a href="{{ asset('storage/file_pemasaran/' . $data->file_pemasaran) }}" class="font-bold">Download {{ $data->file_pemasaran }}</a>
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
