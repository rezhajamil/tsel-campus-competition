<x-app-layout>
    <nav class="bg-red-600 sm:block hidden">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-white hover:underline" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('data-diri') }}" class="text-white hover:underline">Data Diri</a>
                    </li>
                    <li>
                        <a href="{{ route('my_project') }}" class="text-white hover:underline">Project</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class=" flex flex-col gap-4 sm:grid sm:grid-flow-row-dense sm:grid-cols-3 sm:grid-rows-2 py-4">

        {{-- Team --}}
        <div class="sm:col-span-2 sm:grid sm:grid-flow-row sm:grid-rows-4 sm:px-10 mx-5 gap4 sm:gap-2">

            {{-- judul --}}
            <div class="flex justify-between items-center border-b-2 px-5 py-2">
                @if ($pesertaList->isEmpty())
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('My Team') }}
                    </h1>
                    <a href="{{ route('anggota.add') }}">
                        <button type="button"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Member
                        </button>
                    </a>
                @else
                    @if (count($pesertaList) <= 4)
                        <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                            {{ $pesertaList[0]->nama_kelompok }} Team</h1>
                        <a href="{{ route('anggota.add') }}">
                            <button type="button"
                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Add Member
                            </button>
                        </a>
                    @else
                        <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                            {{ $pesertaList[0]->nama_kelompok }} Team</h1>
                    @endif
                @endif
            </div>

            {{-- Project --}}
            <div
                class=" sm:row-span-3 flex items-start sm:items-center sm:justify-start justify-center flex-col bg-white rounded-b-lg px-5 ">
                @if ($pesertaList->isEmpty())
                    <p class="font-sans text-red-500">
                        {{ __('Silahkan Tambah Anggota Tim') }}
                    </p>
                @else
                    @foreach ($pesertaList as $peserta)
                        <ul role="list" class="divide-y divide-gray-100">
                            <li class="flex justify-between sm:max-w-screen-md sm:w-screen py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    {{-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt=""> --}}
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">
                                            {{ $peserta->nama_lengkap }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                            {{ $peserta->nim }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">{{ $peserta->jabatan }}</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">{{ $peserta->email }}</p>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif

            </div>
        </div>
        @include('layouts.step')
        {{-- Tab --}}
        @foreach ($pendaftarans as $daftar)
            @if ($daftar->proposal->status == 'Proses')
                <div class="px-5 sm:ml-10 mt-5 col-span-3">
                    <div class="border-b-2 px-5 py-2">
                        <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                            {{ $daftar->proposal->judul_proposal }}
                        </h1>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-flow-row grid-row-2">
                        <div>
                            <div class="sm:hidden sm:w-screen w-74">

                                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">Menu Project<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                
                                <!-- Dropdown menu -->
                                <div id="dropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a href="{{ route('ide-bisnis') }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ide
                                                Bisnis</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('laba-rugi') }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Laba
                                                Rugi</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pemasaran') }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pemasaran</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('maintenance') }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maintenance</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex gap-6">
                                        <a href="{{ route('ide-bisnis') }}"
                                            class="shrink-0 {{ request()->routeIs('ide-bisnis') ? 'rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600' : 'border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700' }} ">
                                            Ide Bisnis
                                        </a>

                                        <a href="{{ route('laba-rugi') }}"
                                            class="shrink-0 {{ request()->routeIs('laba-rugi') ? 'rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600' : 'border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700' }} ">
                                            Laba Rugi
                                        </a>

                                        <a href="{{ route('pemasaran') }}"
                                            class="shrink-0 {{ request()->routeIs('pemasaran') ? 'rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600' : 'border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700' }} ">
                                            Pemasaran
                                        </a>

                                        <a href="{{ route('maintenance') }}"
                                            class="shrink-0 {{ request()->routeIs('maintenance') ? 'rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600' : 'border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700' }} ">
                                            Maintenance
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="h-fit w-full border mt-5">
                            <div>
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="px-5 sm:ml-10 mt-5 col-span-3">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-flow-row grid-row-2">
                        <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                            <dl class="-my-3 divide-y divide-gray-100 text-sm">
                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">Judul Proposal</dt>
                                    <dd class="text-gray-700 sm:col-span-2 uppercase">{{ $daftar->proposal->judul_proposal }}</dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">Ide Bisnis</dt>
                                    <dd class="text-gray-700 sm:col-span-2 uppercase">{{ $daftar->proposal->ide_bisnis }}</dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">File Bisnis Model Canvas</dt>
                                    <dd class="text-gray-700 sm:col-span-2">
                                        <a
                                            href="{{ asset('storage/model_bisnis_canvas/' . $daftar->proposal->model_bisnis_canvas) }}">
                                            <button type="button"
                                                class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-5 me-2 -ms-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                {{ $daftar->proposal->model_bisnis_canvas }}
                                            </button></a>
                                    </dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">Deskripsi Laba Rugi</dt>
                                    <dd class="text-gray-700 sm:col-span-2">{{ $daftar->proposal->deskripsi_laba_rugi }}</dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">File Laba Rugi</dt>
                                    <dd class="text-gray-700 sm:col-span-2">
                                        <a href="{{ asset('storage/file_laba_rugi/' . $daftar->proposal->file_laba_rugi) }}">
                                            <button type="button"
                                                class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-5 me-2 -ms-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                {{ $daftar->proposal->file_laba_rugi }}
                                            </button></a>
                                    </dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">Deskripsi Pemasaran</dt>
                                    <dd class="text-gray-700 sm:col-span-2">{{ $daftar->proposal->deskripsi_pemasaran }}</dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">File Pemasaran</dt>
                                    <dd class="text-gray-700 sm:col-span-2">
                                        <a href="{{ asset('storage/file_pemasaran/' . $daftar->proposal->file_pemasaran) }}">
                                            <button type="button"
                                                class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-5 me-2 -ms-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                {{ $daftar->proposal->file_pemasaran }}
                                            </button></a>
                                    </dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">Deskripsi Maintenance</dt>
                                    <dd class="text-gray-700 sm:col-span-2">{{ $daftar->proposal->deskripsi_maintenance }}</dd>
                                </div>

                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dt class="font-medium text-gray-900">File Maintenance</dt>
                                    <dd class="text-gray-700 sm:col-span-2">
                                        <a href="{{ asset('storage/file_maintenance/' . $daftar->proposal->file_maintenance) }}"><button
                                                type="button"
                                                class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  me-2 mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-5 me-2 -ms-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                {{ $daftar->proposal->file_maintenance }}
                                            </button></a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </section>
</x-app-layout>
