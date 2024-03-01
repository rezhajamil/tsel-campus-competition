<x-app-layout>
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Create
                        </button>
                    </a>
                @else
                    @if (count($pesertaList) <=4)
                        <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                            {{ $pesertaList[0]->nama_kelompok }} Team</h1>
                        <a href="{{ route('anggota.add') }}">
                            <button type="button"
                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Create
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
                                            {{ $peserta->npsn }}</p>
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
        {{-- Step --}}
        <div class="bg-white px-10 py-8  mx-5 rounded-lg">

            <ol class="">
                <li>
                    <div class="w-full p-4 text-green-700 border border-green-300 rounded-lg bg-green-50 dark:bg-white dark:border-green-800 dark:text-green-400"
                        role="alert">
                        <div class="flex items-center justify-between">
                            <span class="sr-only">User info</span>
                            <h3 class="font-medium">1. User info</h3>
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        </div>
                    </div>
                </li>

            </ol>

        </div>

        {{-- Tab --}}
        @foreach ($proposal as $data)
            <div class="px-5 sm:ml-10 mt-5 col-span-3">
                <div class="border-b-2 px-5 py-2">
                    <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                        {{ $data->judul_proposal }}
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
                        <div></div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app-layout>
