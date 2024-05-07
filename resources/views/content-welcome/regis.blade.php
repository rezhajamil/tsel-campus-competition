<div class="w-full h-fit p-10 bg-white">
    <div class="flex justify-center">
        <h1 class="font-bold font-batik text-4xl text-red-600">Daftarkan Akun Ketua</h1>
    </div>
    <div class="flex justify-center">
        <p class="text-black">Isilah Data Diri Yang Sesuai Dan Pastikan Data Tersebut Benar.</p>
    </div>
    <div class="flex justify-center mt-5">
        <div class="sm:w-1/2 w-full">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-red-600">NPSN</span>
                            </div>
                            <label
                                class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                                <box-icon name='school' type='solid' color='#f30303'></box-icon>
                                <input id="npsn" type="text" name="npsn" placeholder="NPSN" class="grow"  />
                            </label>
                            <div class="label">
                                <button onclick="openModal(event)" class="label-text-alt text-red-600">Cari Kampus</button>
                            </div>
                        </label>
                    </div>
                    <div>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-red-600">NIM</span>
                            </div>
                            <label
                                class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                                <box-icon name='graduation' type='solid' color='#f30303'></box-icon>
                                <input type="nim" name="nim" placeholder="NIM" class="grow" required />
                            </label>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-red-600">Nama Lengkap</span>
                        </div>
                        <label
                            class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                            <box-icon name='user' type='solid' color='#f30303'></box-icon>
                            <input type="text" name="nama" class="grow" placeholder="Nama Lengkap" required />
                        </label>
                    </label>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-red-600">Nomor Whatsapp</span>
                        </div>
                        <label
                            class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                            <box-icon type='solid' name='phone' color='#f30303'></box-icon>
                            <input type="text" name="telp" class="grow" placeholder="08............" required />
                        </label>
                    </label>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-red-600">Email</span>
                        </div>
                        <label
                            class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                            <box-icon name='envelope' type='solid' color='#f30303'></box-icon>
                            <input type="email" name="email" placeholder="@gmail.com" class="grow" required />
                        </label>
                    </label>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-red-600">Password</span>
                        </div>
                        <label
                            class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                            <box-icon name='lock-alt' type='solid' color='#f30303'></box-icon>
                            <input type="password" name="password" placeholder="***********" class="grow" required />
                        </label>
                    </label>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-red-600">Konfirmasi Password</span>
                        </div>
                        <label
                            class="input input-bordered border-red-600 w-sm bg-white text-red-600 flex items-center gap-2">
                            <box-icon name='lock-alt' type='solid' color='#f30303'></box-icon>
                            <input type="password" name="confirm" placeholder="***********" class="grow" />
                        </label>
                    </label>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn bg-red-600 border-none text-white">Daftar Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="myModal"
class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-orange-400 bg-opacity-50 hidden">
<div class="bg-white rounded shadow-lg w-3/4 h-fit">
    <div
        class="relative px-4 py-2 flex bg-blue justify-center items-center h-14 font-batik text-red-600 text-lg rounded">
        <h3>Cari Kampus</h3>
        <button onclick="closeModal(event)" class="absolute top-3 right-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="flex justify-center py-2 px-3">
        <x-input id="searchInput" type="text"
            class="form-input w-full h-10 rounded border text-sm border-grey-300"
            placeholder="Ketik Nama Kampus"></x-input>
    </div>
    <div class="m-3 overflow-y-auto max-h-80" id="kampusList">
    </div>
</div>
</div>