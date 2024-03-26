<div class=" mt-2 sm:mt-0">
    <h2 class="sr-only">Steps</h2>

    <div>
        <ol class="flex items-center gap-2 text-xs font-medium text-gray-500 sm:gap-4">

            @if ($daftar->kelompok->nama_kelompok == null)
                <li class="flex items-center justify-center gap-2 text-blue-600">
                    <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 1
                    </span>

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
            @if ($anggota <= 2)
                <li class="flex items-center justify-center gap-2 text-blue-600">
                    <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 2
                    </span>

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
                    <span class="size-6 rounded bg-blue-50 text-center text-[10px]/6 font-bold"> 3
                    </span>

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