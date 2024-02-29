@extends('dashboard')

@section('judul_content')
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
@endsection

@section('content')
    <div class="p-6 bg-white border-b border-gray-200">
        @foreach ($pendaftaran as $daftar)

            {{-- Bagde --}}
            @if ($daftar->proposal->status == 'Proses')
                <!-- Warning -->
                <span
                    class="inline-flex items-center justify-center rounded-full bg-amber-100 px-2.5 py-0.5 text-amber-700">
                    <p class="whitespace-nowrap text-sm">Proses</p>
                </span>
            @else
                @if ($daftar->proposal->status == 'Diterima')
                    <!-- Success -->
                    <span
                        class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                        <p class="whitespace-nowrap text-sm">Success</p>
                    </span>
                @endif
                <!-- Error -->
                <span class="inline-flex items-center justify-center rounded-full bg-red-100 px-2.5 py-0.5 text-red-700">
                    <p class="whitespace-nowrap text-sm">DiTolak</p>
                </span>
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
                            {{ date('d M Y', strtotime($daftar->proposal->created_at) )}}
                        </div>
                    </div>
                </div>

                {{-- Step --}}
                <div class=" mt-2 sm:mt-0">
                    <h2 class="sr-only">Steps</h2>

                    <div>
                        <ol class="flex items-center gap-2 text-xs font-medium text-gray-500 sm:gap-4">

                            @if ($daftar->kelompok->nama_kelompok == NULL )    
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
                            @if ($anggota <=3 )    
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

                            <li class="flex items-center justify-center gap-2 text-blue-600">
                                <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 3 </span>

                                <span> Proposal </span>
                            </li>
                        </ol>
                    </div>
                </div>

                {{-- Button --}}
                <div class="mt-5 flex lg:ml-4 lg:mt-0">
                    <span class="mr-3 block">
                        <a href="{{ route('model-bisnis') }}">
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

                    <span class="sm:ml-3">
                        <button type="button"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                    clip-rule="evenodd" />
                            </svg>
                            Publish
                        </button>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
