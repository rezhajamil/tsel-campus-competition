{{-- TimeLine --}}
<div class="bg-white px-10 rounded-lg">
    {{-- judul --}}
    <div class="flex justify-center items-center border-b-2 my-5">
        <h1 class="font-batik text-lg">{{ __('Timeline') }}</h1>
    </div>
    <!-- Progress bar -->
    <div class="row-span-3 px-10 pb-10">
        <ol class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400 mt-3">
            @foreach ($timelines as $timeline)
                @php
                    // Hitung perbedaan waktu relatif
                    $diffForHumans = Carbon\Carbon::parse($timeline->waktu)->diffForHumans();
                @endphp
                @if ($timeline->status == 'Belum mulai')
                    <li class="mb-10 ms-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -start-4 ring-4 ring-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-8 text-grey-500">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <h3 class="font-medium leading-tight">{{ $timeline->nama }}</h3>
                        <p class="text-sm">{{ $diffForHumans }}</p>
                    </li>
                @else
                    @if ($timeline->status == 'Mulai')
                        <li class="mb-10 ms-6">
                            <span
                                class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -start-4 ring-4 ring-blue-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-8 text-blue-500">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <h3 class="font-medium leading-tight text-blue-600">{{ $timeline->nama }}</h3>
                            <p class="text-sm text-blue-400">{{ $diffForHumans }}</p>
                        </li>
                    @else
                        @if ($timeline->status == 'Selesai')
                            <li class="mb-10 ms-6">
                                <span
                                    class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -start-4 ring-4 ring-emerald-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-8 text-emerald-500">
                                        <path fill-rule="evenodd"
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <h3 class="font-medium leading-tight text-emerald-600">{{ $timeline->nama }}</h3>
                                <p class="text-sm text-emerald-400">{{ $diffForHumans }}</p>
                            </li>
                        @else
                            @if ($timeline->status == 'Perpanjang')
                                <li class="mb-10 ms-6">
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -start-4 ring-4 ring-orange-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-8 text-orange-500">
                                            <path fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <h3 class="font-medium leading-tight text-orange-600">{{ $timeline->nama }}</h3>
                                    <p class="text-sm text-orange-400">{{ $diffForHumans }}</p>
                                </li>
                            @endif
                        @endif
                    @endif

                @endif
            @endforeach
        </ol>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua elemen dengan class text-sm
        var timeElements = document.querySelectorAll('.text-sm');

        // Loop melalui setiap elemen dan format waktu relatif
        timeElements.forEach(function(element) {
            var timestamp = element.textContent.trim();
            var diffForHumans = moment(timestamp).fromNow();
            element.textContent = diffForHumans;
        });
    });
</script>
