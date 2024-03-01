@extends('dashboard')

@section('judul_content')
    @if (auth()->user()->npsn != null && auth()->user()->nim != null)
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Project') }}
        </h2>
        @if ($pendaftaran->isEmpty())
            <a href="{{ route('nama_kelompok') }}">
                <button type="button"
                    class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-white hover:text-red-600 hover:border-red-600 hover:border focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create
                </button>
            </a>
        @endif
    @else
        <div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
            <div class="flex items-center gap-2 text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                        clip-rule="evenodd" />
                </svg>

                <strong class="block font-medium"> Silahkan Lengkapi Data Diri Terlebih Dahulu!! </strong>
            </div>
        </div>
    @endif
@endsection

@section('content')
    @foreach ($pendaftaran as $daftar)
        <div class="p-6 bg-white border-b border-gray-200">
            {{-- Bagde status seleksi --}}
            @if ($daftar->status == 'Proses')
                <!-- common -->
                <span class="inline-flex items-center justify-center rounded-full bg-gray-100 px-2.5 py-0.5 text-gray-700">
                    <p class="whitespace-nowrap text-sm">Proses</p>
                </span>
            @else
                @if ($daftar->status == 'Seleksi')
                    <!-- Warning -->
                    <span
                        class="inline-flex items-center justify-center rounded-full bg-amber-100 px-2.5 py-0.5 text-amber-700">
                        <p class="whitespace-nowrap text-sm">Dalam Penilaian</p>
                    </span>
                @else
                    @if ($daftar->status == 'Diterima')
                        <!-- Success -->
                        <span
                            class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                            <p class="whitespace-nowrap text-sm">Diterima</p>
                        </span>
                    @else
                        @if ($daftar->status == 'Ditolak')
                            <span
                                class="inline-flex items-center justify-center rounded-full bg-red-100 px-2.5 py-0.5 text-red-700">
                                <p class="whitespace-nowrap text-sm">DiTolak</p>
                            </span>
                        @endif
                    @endif
                @endif
            @endif
            {{-- Bagde Pengerjaan --}}
            @if ($daftar->proposal->status == 'Proses')
                <!-- Warning -->
                <span class="inline-flex items-center justify-center rounded-full bg-gray-100 px-2.5 py-0.5 text-gray-700">
                    <p class="whitespace-nowrap text-sm">Proses Pengerjaan</p>
                </span>
            @else
                @if ($daftar->proposal->status == 'Publish')
                    <!-- Success -->
                    <span
                        class="inline-flex items-center justify-center rounded-full bg-blue-100 px-2.5 py-0.5 text-blue-700">
                        <p class="whitespace-nowrap text-sm">Success</p>
                    </span>
                @endif
            @endif

            {{-- Header --}}
            <div class="lg:flex lg:items-center lg:justify-between mt-2">

                <div class="min-w-0 flex-1">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight uppercase">
                        {{ $daftar->proposal->judul_proposal }}</h2>
                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M6 3.75A2.75 2.75 0 018.75 1h2.5A2.75 2.75 0 0114 3.75v.443c.572.055 1.14.122 1.706.2C17.053 4.582 18 5.75 18 7.07v3.469c0 1.126-.694 2.191-1.83 2.54-1.952.599-4.024.921-6.17.921s-4.219-.322-6.17-.921C2.694 12.73 2 11.665 2 10.539V7.07c0-1.321.947-2.489 2.294-2.676A41.047 41.047 0 016 4.193V3.75zm6.5 0v.325a41.622 41.622 0 00-5 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25zM10 10a1 1 0 00-1 1v.01a1 1 0 001 1h.01a1 1 0 001-1V11a1 1 0 00-1-1H10z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M3 15.055v-.684c.126.053.255.1.39.142 2.092.642 4.313.987 6.61.987 2.297 0 4.518-.345 6.61-.987.135-.041.264-.089.39-.142v.684c0 1.347-.985 2.53-2.363 2.686a41.454 41.454 0 01-9.274 0C3.985 17.585 3 16.402 3 15.055z" />
                            </svg>
                            {{ $daftar->kelompok->nama_kelompok }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ date('d M Y', strtotime($daftar->proposal->created_at)) }}
                        </div>
                    </div>
                </div>

                {{-- Step --}}
                <div class=" mt-2 sm:mt-0">
                    <h2 class="sr-only">Steps</h2>

                    <div>
                        <ol class="flex items-center gap-2 text-xs font-medium text-gray-500 sm:gap-4">

                            @if ($daftar->kelompok->nama_kelompok == null)
                                <li class="flex items-center justify-center gap-2 text-blue-600">
                                    <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 1 </span>

                                    <span> Kelompok </span>
                                </li>
                            @else
                                <li class="flex items-center justify-center gap-2 text-green-600">
                                    <span class="rounded bg-green-50 p-1.5 text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span> Kelompok </span>
                                </li>
                            @endif

                            {{-- anggota --}}
                            @if ($anggota <= 3)
                                <li class="flex items-center justify-center gap-2 text-blue-600">
                                    <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 2 </span>

                                    <span> Anggota </span>
                                </li>
                            @else
                                <li class="flex items-center justify-center gap-2 text-green-600">
                                    <span class="rounded bg-green-50 p-1.5 text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span> Anggota </span>
                                </li>
                            @endif

                            {{-- proposal --}}
                            @if ($adaKolomKosong)
                                <li class="flex items-center justify-center gap-2 text-blue-600">
                                    <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 3 </span>

                                    <span> Proposal </span>
                                </li>
                            @else
                                <li class="flex items-center justify-center gap-2 text-green-600">
                                    <span class="rounded bg-green-50 p-1.5 text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span> Proposal </span>
                                </li>
                            @endif

                        </ol>
                    </div>
                </div>

                {{-- Button --}}
                <div class="mt-5 flex lg:ml-4 lg:mt-0">
                    <span class="mr-3 block">
                        <a href="{{ route('model-bisnis', ['id_proposal' => $daftar->proposal_id]) }}">
                            <button type="button"
                                class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path
                                        d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
                                    <path
                                        d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
                                </svg>
                                View
                            </button>
                        </a>
                    </span>
                    @if ($daftar->proposal->status == 'Publish')
                        <span class="sm:ml-3">
                            <button type="button" disabled
                                class="inline-flex items-center rounded-md bg-emerald-300 px-3 py-2 text-sm font-semibold text-gray-500 cursor-not-allowed shadow-sm">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                                Publish
                            </button>
                        </span>
                    @else
                        @if ($adaKolomKosong && $daftar->kelompok->nama_kelompok == null && $anggota >= 3 || $anggota <=5)
                            <span class="sm:ml-3">
                                <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Publish
                                </button>
                            </span>
                        @else
                            <span class="sm:ml-3">
                                <button type="button" disabled
                                    class="inline-flex items-center rounded-md bg-gray-300 px-3 py-2 text-sm font-semibold text-gray-500 cursor-not-allowed shadow-sm">
                                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Publish
                                </button>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
    @endforeach

    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Kamu Yakin Mau mempublish
                        nya?</h3>
                    <form action="">
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                    </form>

                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 mt-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
