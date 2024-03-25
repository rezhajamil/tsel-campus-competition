<x-app-layout>
    <x-card-email>
        <x-slot name="logo">
            <a href="/">
                <img src="https://www.telkomsel.com/sites/default/files/mainlogo-2022-rev.png" alt="Telkomsel" class=" w-32">
            </a>
        </x-slot>

        <div class="mb-4 text-md text-gray-600">
            {{ __('Terima Kasih Sudah Mendaftar, Harap Lakukan Verifikasi Alamat Email Terlebih Dahulu Dengan Cara Menekan Tombol Yang sudah Dikirimkan pada Email mu. Jika Tidak Menerima Email Verifikasi Silahkan Klik Tombol Di Bawah Ini') }}
        </div>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Catatan: Pastikan Email Yang Anda Gunakan Adalah email Yang Aktif') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Link Verifikasi Terbaru Sudah Dikirimkan Ke Alamat Email mu') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Kirim Ulang Verifikasi Email') }}
                    </x-button>
                </div>
            </form>

        </div>
    </x-card-email>
</x-app-layout>
