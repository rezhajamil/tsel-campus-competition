@extends('user.myproject.model-bisnis')

@section('content')
    @foreach ($proposal as $data)
        <div class="px-5 sm:ml-10 mt-5 col-span-3">
            <div class="p-6 bg-white border-b border-gray-200 grid grid-flow-row grid-row-2">
                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Judul Proposal</dt>
                            <dd class="text-gray-700 sm:col-span-2 uppercase">{{ $data->judul_proposal }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Ide Bisnis</dt>
                            <dd class="text-gray-700 sm:col-span-2 uppercase">
                                @if ($data->ide_bisnis == null)
                                    (Kosong)
                                @else
                                    {{ $data->ide_bisnis }}
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">File Bisnis Model Canvas</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->model_bisnis_canvas == null)
                                    (Kosong)
                                @else
                                    <a href="{{ asset('storage/model_bisnis_canvas/' . $data->model_bisnis_canvas) }}">
                                        <button type="button"
                                            class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-5 me-2 -ms-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                            {{ $data->model_bisnis_canvas }}
                                        </button></a>
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Deskripsi Laba Rugi</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->deskripsi_laba_rugi == null)
                                    (Kosong)
                                @else
                                    {{ $data->deskripsi_laba_rugi }}
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">File Laba Rugi</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->file_laba_rugi == null)
                                    (Kosong)
                                @else
                                    <a href="{{ asset('storage/model_bisnis_canvas/' . $data->file_laba_rugi) }}">
                                        <button type="button"
                                            class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-5 me-2 -ms-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                            {{ $data->file_laba_rugi }}
                                        </button></a>
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Deskripsi Pemasaran</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->deskripsi_pemasaran == null)
                                    (Kosong)
                                @else
                                    {{ $data->deskripsi_pemasaran }}
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">File Pemasaran</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->file_pemasaran == null)
                                    (Kosong)
                                @else
                                    <a href="{{ asset('storage/model_bisnis_canvas/' . $data->file_pemasaran) }}">
                                        <button type="button"
                                            class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-5 me-2 -ms-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                            {{ $data->file_pemasaran }}
                                        </button></a>
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Deskripsi Maintenance</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->deskripsi_maintenance == null)
                                    (Kosong)
                                @else
                                    {{ $data->deskripsi_maintenance }}
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">File Maintenance</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @if ($data->file_maintenance == null)
                                    (Kosong)
                                @else
                                    <a href="{{ asset('storage/model_bisnis_canvas/' . $data->file_maintenance) }}">
                                        <button type="button"
                                            class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-5 me-2 -ms-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                            {{ $data->file_maintenance }}
                                        </button></a>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    @endforeach
@endsection
