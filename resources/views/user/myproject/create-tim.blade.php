<x-app-layout>
    
    <div class="px-10 pt-4 flex gap-4 items-center">
        <a href="">
            <button class="p-1 rounded-full border-2 border-red-500 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                  </svg>                  
            </button>
        </a>
        <h1 class="font-bold text-lg">{{ __('Add Team') }}</h1>
    </div>
    
    <div class="bg-white overflow-hidden m-6 shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200">
            @foreach ($pesertaList as $peserta)
                @if ($peserta->jabatan == 'Ketua')
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('create_anggota') }}">
                        @csrf
                        <div>
                            <div>
                                <div>
                                    <x-input id="user_id" class="hidden" type="text" name="user_id"
                                        value="{{ auth()->user()->user_id }}"></x-input>
                                </div>
                                <div class="grid grid-flow-col grid-cols-3 gap-3">
                                    <div>
                                        <x-label for="npsn" :value="__('NPSN')"></x-label>
                                        <x-input value="{{ $peserta->npsn }}" id="npsn" name="npsn"
                                            class=" block mt-1 w-full" type="text"></x-input>
                                    </div>
                                    <div class=" col-span-2">
                                        <x-label for="nim" :value="__('NIM')"></x-label>
                                        <x-input id="nim" class=" block mt-1 w-full" type="text" name="nim"
                                            required></x-input>
                                    </div>
                                </div>
                                
                                <div>
                                    <x-label for="nama_lengkap" :value="__('Nama Lengkap')"></x-label>
                                    <x-input id="nama_lengkap" class=" block mt-1 w-full" type="text"
                                        name="nama_lengkap"></x-input>
                                </div>
                                <div>
                                    <x-label for="nama_kelompok" :value="__('Nama Kelompok')"></x-label>
                                    <x-input id="nama_kelompok" class=" block mt-1 w-full" type="text"
                                        name="nama_kelompok" value="{{ $peserta->nama_kelompok }}"></x-input>
                                </div>
                                <div>
                                    <x-label for="nomor_wa" :value="__('Nomor Whatsapp')"></x-label>
                                    <x-input id="nomor_wa" class=" block mt-1 w-full" type="text" name="nomor_wa"
                                        required></x-input>
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')"></x-label>
                                    <x-input id="email" class=" block mt-1 w-full" type="email" name="email"
                                        required></x-input>
                                </div>
                                <div>
                                    <x-label for="kemampuan_deskripsi" :value="__('Deksripsikan Kemampuan')"></x-label>
                                    <x-input id="kemampuan_deskripsi" class=" block mt-1 w-full" type="text"
                                        name="kemampuan_deskripsi"></x-input>
                                </div>
                                <div>
                                    <x-label for="jabatan" :value="__('Posisi')"></x-label>
                                    <x-input id="jabatan" class=" block mt-1 w-full" type="text" name="jabatan"></x-input>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Simpan') }}
                            </x-button>
                        </div>
    
                    </form>
                @endif
            @endforeach
    
        </div>
    </div>
</x-app-layout>



