@extends('user.myproject.model-bisnis')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200">
            @foreach ($proposal as $data)
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{ route('ide-bisnis.input',['id_proposal' => $data->id_proposal]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-label for="ide_bisnis" :value="__('Ide Bisnis')"></x-label>
                    @if ($data->ide_bisnis == NULL)
                    <x-input id="ide_bisnis" class=" block mt-1 w-full" type="text" name="ide_bisnis" ></x-input>                        
                    @else
                    <x-input id="ide_bisnis" class=" block mt-1 w-full" type="text" name="ide_bisnis" value="{{ $data->ide_bisnis }}" ></x-input>
                    @endif
                </div>
                <div class="col-span-2 mt-3">
                    <x-label for="model_bisnis_canvas" :value="__('Bisnis Model Canvas File')"></x-label>
                    @if ($data->model_bisnis_canvas == NULL)
                    <x-input id="model_bisnis_canvas" class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3" type="file" name="model_bisnis_canvas" accept="application/pdf"></x-input>
                    @else
                    <x-input id="model_bisnis_canvas" class=" block w-fit text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-3" type="file" name="model_bisnis_canvas" accept="application/pdf" value="{{ $data->model_bisnis_canvas }}"></x-input>
                    <a href="{{ asset('storage/model_bisnis_canvas/' . $data->model_bisnis_canvas) }}" class="font-bold">Download {{ $data->model_bisnis_canvas }}</a>

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