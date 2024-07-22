<x-app-layout>

    <div class="px-10 pt-4 flex gap-4 items-center">
        <a href="">
            <button class="p-1 rounded-full border-2 border-red-500 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
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
                    <form method="POST" action="{{ route('create_anggota') }}" enctype="multipart/form-data">
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
                                            class=" block mt-1 w-full" type="text" readonly></x-input>
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
                                        name="nama_kelompok" value="{{ $peserta->nama_kelompok }}" readonly></x-input>
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
                                    <x-label for="jabatan" :value="__('Posisi')"></x-label>
                                    <x-input id="jabatan" class=" block mt-1 w-full" type="text"
                                        name="jabatan"></x-input>
                                </div>
                                <!-- KTM -->
                                <div class="my-4">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center w-full max-w-full p-5 mx-auto mt-2 text-center bg-white border-2 border-red-600 border-dashed cursor-pointer rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <h2 class="mt-1 font-medium tracking-wide text-gray-700">Kartu Tanda Mahasiswa
                                        </h2>
                                        <p class="mt-2 text-xs tracking-wide text-gray-500">Format JPG </p>
                                        <input id="dropzone-file" type="file" class="hidden" name="ktm"
                                            accept="image/jpeg, image/jpg" />
                                    </label>
                                    <p id="file-name" class="mt-2 text-sm tracking-wide text-gray-500"></p>
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

<script>
    document.getElementById('dropzone-file').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file-name').textContent = "Selected file: " + fileName;
    });
</script>
