{{-- Step --}}
@foreach ($proposal as $data)
        
<div class="bg-white px-10 py-8  mx-5 rounded-lg">
    <div id="accordion-collapse" data-accordion="collapse">
        <h2 id="accordion-collapse-heading-1">
            <button type="button"
                class="{{ count($pesertaList)<=3 ? 'bg-red-200 text-red-700' : 'bg-emerald-200 text-emerald-700' }} flex items-center justify-between w-full p-5 font-medium border rounded-t-xl  "
                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                aria-controls="accordion-collapse-body-1">
                <span>Anggota Kelompok?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class="p-5 border border-b-0 border-gray-200 ">
                <p class="mb-2 text-gray-500 ">
                    Jumlah Anggota Kelompok minimal 3 dan maksimal 5</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-2">
            <button type="button"
                class="{{ $data->ide_bisnis == NULL && $data->bisnis_model_canvas == NULL ? 'bg-red-200 text-red-700' : 'bg-emerald-200 text-emerald-700' }} flex items-center justify-between w-full p-5 font-medium border  "
                data-accordion-target="#accordion-collapse-body-2" aria-expanded="true"
                aria-controls="accordion-collapse-body-2">
                <span>Ide Bisnis?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
            <div class="p-5 border border-b-0 border-gray-200 ">
                <p class="mb-2 text-gray-500 ">
                    Masukkan Ide Bisnis Kelompok mu</p>
                <p class="mb-2 text-gray-500 ">
                    Masukkan File File dari Bisnis Model Canvas Kelompok mu</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-3">
            <button type="button"
                class="{{ $data->deskripsi_laba_rugi == NULL && $data->file_laba_rugi == NULL ? 'bg-red-200 text-red-700' : 'bg-emerald-200 text-emerald-700' }} flex items-center justify-between w-full p-5 font-medium border  "
                data-accordion-target="#accordion-collapse-body-3" aria-expanded="true"
                aria-controls="accordion-collapse-body-3">
                <span>Laba Rugi?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
            <div class="p-5 border border-b-0 border-gray-200 ">
                <p class="mb-2 text-gray-500 ">
                    Dekripsikan Bagaimana Untuk Laba Rugi nya dari ide bisnis Kelompok mu</p>
                <p class="mb-2 text-gray-500 ">
                    Masukkan File dari Laba Rugi Kelompok mu</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-4">
            <button type="button"
                class="{{ $data->deksripsi_pemasaran == NULL && $data->file_pemasaran == NULL ? 'bg-red-200 text-red-700' : 'bg-emerald-200 text-emerald-700' }} flex items-center justify-between w-full p-5 font-medium border"
                data-accordion-target="#accordion-collapse-body-4" aria-expanded="true"
                aria-controls="accordion-collapse-body-4">
                <span>Pemasaran?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-4" class="hidden" aria-labelledby="accordion-collapse-heading-4">
            <div class="p-5 border border-b-0 border-gray-200 ">
                <p class="mb-2 text-gray-500 ">
                    Dekripsikan Bagaimana Untuk Pemasaran dari ide bisnis Kelompok mu</p>
                <p class="mb-2 text-gray-500 ">
                    Masukkan File dari Pemasaran Kelompok mu</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-5">
            <button type="button"
                class="{{ $data->deskripsi_maintenance == NULL && $data->file_maintenance == NULL ? 'bg-red-200 text-red-700' : 'bg-emerald-200 text-emerald-700' }} flex items-center justify-between w-full p-5 font-medium border"
                data-accordion-target="#accordion-collapse-body-5" aria-expanded="true"
                aria-controls="accordion-collapse-body-5">
                <span>Maintenance?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-5" class="hidden" aria-labelledby="accordion-collapse-heading-5">
            <div class="p-5 border border-b-0 border-gray-200 ">
                <p class="mb-2 text-gray-500 ">
                    Dekripsikan Bagaimana Untuk Maintenance dari ide bisnis Kelompok mu</p>
                <p class="mb-2 text-gray-500 ">
                    Masukkan File dari Maintenance Kelompok mu</p>
            </div>
        </div>
    </div>
</div>
@endforeach
