<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://www.telkomsel.com/sites/default/files/mainlogo-2022-rev.png" alt="Telkomsel"
                    class="w-32">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <x-label for="kode_kampus" :value="__('Kode Kampus')" />
                <div class="relative">
                    <x-input id="kode_kampus" type="text" name="kode_kampus" placeholder="Masukkan Kode Kampus Anda"
                        class="w-full" autocomplete="off" :value="old('kode_kampus')" />
                    <ul id="school-list"
                        class="absolute z-10 border border-red-600 mt-1 bg-white w-full max-h-60 overflow-y-auto hidden">
                        <!-- List items will be injected here -->
                    </ul>
                </div>
            </div>

            <!-- NIM -->
            <div>
                <x-label for="nim" :value="__('NIM')" />
                <x-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')"
                    required autofocus />
            </div>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
            </div>

            <!-- Telp -->
            <div class="mt-4">
                <x-label for="telp" :value="__('Telkomsel Number')" />
                <x-input id="telp" class="block mt-1 w-full" type="text" name="telp" :value="old('telp')"
                    required placeholder="Format 08" />
                <p id="telp-error" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- KTM -->
            <div class="my-4">
                <label for="dropzone-file"
                    class="flex flex-col items-center w-full max-w-full p-5 mx-auto mt-2 text-center bg-white border-2 border-red-600 border-dashed cursor-pointer rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <h2 class="mt-1 font-medium tracking-wide text-gray-700">Kartu Tanda Mahasiswa</h2>
                    <p class="mt-2 text-xs tracking-wide text-gray-500">Format JPG </p>
                    <input id="dropzone-file" type="file" class="hidden" name="ktm"
                        accept="image/jpeg, image/jpg" />
                </label>
                <p id="file-name" class="mt-2 text-sm tracking-wide text-gray-500"></p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

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
    let telkomselPrefixes = [];

    // Ambil kode prefix Telkomsel dari server
    fetch('/api/telkomsel-prefixes')
        .then(response => response.json())
        .then(data => {
            telkomselPrefixes = data;
        })
        .catch(error => console.error('Error fetching Telkomsel prefixes:', error));

    document.getElementById('telp').addEventListener('input', function() {
        const telpInput = this.value;
        const errorElement = document.getElementById('telp-error');

        if (isValidTelkomselNumber(telpInput)) {
            errorElement.classList.add('hidden');
        } else {
            errorElement.textContent = 'Nomor telepon harus Telkomsel dan memiliki panjang antara 11 hingga 13 digit.';
            errorElement.classList.remove('hidden');
        }
    });

    function isValidTelkomselNumber(number) {
        // Hapus semua karakter non-digit
        const cleanedNumber = number.replace(/\D/g, '');
        
        // Periksa panjang nomor
        if (cleanedNumber.length < 11 || cleanedNumber.length > 13) {
            return false;
        }

        // Periksa apakah nomor dimulai dengan salah satu prefix Telkomsel
        return telkomselPrefixes.some(prefix => cleanedNumber.startsWith(prefix));
    }
</script>
