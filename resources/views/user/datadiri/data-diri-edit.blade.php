@extends('dashboard')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Diri Edit') }}
    </h2>
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            @foreach ($datadiri as $data)
                @if ($data->user_id == auth()->user()->user_id)
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('data-diri.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div>
                                <div class="grid grid-flow-col items-center grid-cols-3 gap-3">
                                    <div>
                                        <x-label for="kode_kampus" :value="__('Kode Kampus')" />
                                        <div class="relative mt-1">
                                            <x-input id="kode_kampus" type="text" name="npsn"
                                                placeholder="Masukkan Kode Kampus Anda" class="w-full" autocomplete="off"
                                                value="{{ $data->npsn }}" />
                                            <ul id="school-list"
                                                class="absolute z-10 border border-red-600 mt-1 bg-white w-full max-h-60 overflow-y-auto hidden">
                                                <!-- List items will be injected here -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <x-label for="nim" :value="__('NIM')"></x-label>
                                        <x-input id="nim" class=" block mt-1 w-full" type="text" name="nim"
                                            value="{{ $data->nim }}" required></x-input>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <x-label for="name" :value="__('Nama Lengkap')"></x-label>
                                    <x-input id="name" class=" block mt-1 w-full" type="text" name="name"
                                        value="{{ $data->name }}"></x-input>
                                </div>
                                <div class="mt-3">
                                    <x-label for="telp" :value="__('Nomor Whatsapp')"></x-label>
                                    <x-input id="telp" class=" block mt-1 w-full" type="text" name="telp"
                                        value="{{ $data->telp }}" required></x-input>
                                </div>
                                <div class="mt-3">
                                    <x-label for="email" :value="__('Email')"></x-label>
                                    @if (Auth::user()->email_verified_at)
                                        <x-input id="email" class=" block mt-1 w-full" type="email" name="email"
                                            value="{{ $data->email }}" disabled></x-input>
                                    @else
                                        <x-input id="email" class=" block mt-1 w-full" type="email" name="email"
                                            value="{{ $data->email }}"></x-input>
                                    @endif
                                </div>
                                <div class="my-4">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center w-full max-w-full p-5 mx-auto mt-2 text-center bg-white border-2 border-red-600 border-dashed cursor-pointer rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <h2 class="mt-1 font-medium tracking-wide text-gray-700">Kartu Tanda Mahasiswa</h2>
                                        <p class="mt-2 text-xs tracking-wide text-gray-500">Format JPG </p>
                                        <input id="dropzone-file" type="file" class="hidden" name="ktm"
                                            accept="image/jpeg, image/jpg" value="{{ $data->ktm }}"/>
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
@endsection

@section('script')
    <script>
        document.getElementById('dropzone-file').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('file-name').textContent = "Selected file: " + fileName;
        });
        let currentPage = 1;
        let query = '';

        document.getElementById('kode_kampus').addEventListener('focus', function() {
            query = this.value;
            currentPage = 1;
            fetchSchools(query, currentPage);
        });

        document.getElementById('kode_kampus').addEventListener('input', function() {
            query = this.value;
            currentPage = 1;
            fetchSchools(query, currentPage);
        });

        document.getElementById('school-list').addEventListener('scroll', function() {
            if (this.scrollTop + this.clientHeight >= this.scrollHeight) {
                currentPage++;
                fetchSchools(query, currentPage);
            }
        });

        function fetchSchools(query, page) {
            fetch(`/schools?query=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    var schoolList = document.getElementById('school-list');
                    if (page === 1) {
                        schoolList.innerHTML = '';
                    }
                    if (data.data.length > 0) {
                        data.data.forEach(function(school) {
                            var li = document.createElement('li');
                            li.textContent = school.NAMA_SEKOLAH + ' - ' + school.NPSN;
                            li.classList.add('p-2', 'cursor-pointer', 'hover:bg-red-100');
                            li.addEventListener('click', function() {
                                document.getElementById('kode_kampus').value = school.NPSN;
                                schoolList.innerHTML = '';
                                schoolList.classList.add('hidden');
                            });
                            schoolList.appendChild(li);
                        });
                        schoolList.classList.remove('hidden');
                    } else {
                        schoolList.classList.add('hidden');
                    }
                });
        }
    </script>
@endsection
