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
                    <form method="POST" action="{{ route('data-diri.update') }}">
                        @csrf
                        <div>
                            <div>
                                <div class="grid grid-flow-col grid-cols-3 gap-3">
                                    <div>
                                        <x-label for="npsn" :value="__('NPSN')"></x-label>
                                        <x-input id="npsn" name="npsn" class=" block mt-1 w-full" type="text"
                                             required></x-input>
                                            <div>
                                                <button onclick="openModal(event)" class="text-red-600" >Cari Kampus</button>
                                            </div>
                                    </div>
                                    <div class="col-span-2">
                                        <x-label for="nim" :value="__('NIM')"></x-label>
                                        <x-input id="nim" class=" block mt-1 w-full" type="text" name="nim"
                                            required></x-input>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <x-label for="name" :value="__('Nama Lengkap')"></x-label>
                                    <x-input id="name" class=" block mt-1 w-full" type="text"
                                        name="name" value="{{ $data->name }}"></x-input>
                                </div>
                                <div class="mt-3">
                                    <x-label for="telp" :value="__('Nomor Whatsapp')"></x-label>
                                    <x-input id="telp" class=" block mt-1 w-full" type="text" name="telp"
                                    value="{{ $data->telp }}" required></x-input>
                                </div>
                                <div class="mt-3">
                                    <x-label for="email" :value="__('Email')"></x-label>
                                    <x-input id="email" class=" block mt-1 w-full" type="email" name="email"
                                    value="{{ $data->email }}" required></x-input>
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
@endsection

@section('script')
    <script>
        function openModal(event) {
            document.getElementById("myModal").classList.remove('hidden');
            event.preventDefault();
        }

        function closeModal(event) {
            document.getElementById("myModal").classList.add('hidden');
            event.preventDefault();
        }

        function searchKampus(keyword) {
            $.ajax({
                url: "{{ route('get-kampus-by-keyword') }}",
                type: "GET",
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    var kampusList = response.kampusList;
                    var kampusDiv = $('#kampusList');
                    kampusDiv.empty();

                    kampusList.forEach(function(kampus) {
                        var kampusItem = $(
                            '<div class="h-fit px-2 py-1 mb-2 border rounded flex flex-col kampus-item" data-npsn="' +
                            kampus.NPSN + '">');
                        kampusItem.append('<p class="text-xs border-b">' + kampus.NAMA_SEKOLAH +
                            '</p>');
                        kampusItem.append('<p class="text-xs">NPSN: ' + kampus.NPSN + '</p>');
                        kampusDiv.append(kampusItem);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $(document).ready(function() {
            $('#searchInput').on('keypress', function(e) {
                console.log(e.keyCode);
                if (e.keyCode == 13) {
                    var keyword = $(this).val();
                    searchKampus(keyword);
                }
            });
        });


        $(document).ready(function() {
            $('#kampusList').on('click', '.kampus-item', function() {
                var npsn = $(this).attr('data-npsn');
                var namaSekolah = $(this).find('p:first')
                    .text(); // Menggunakan find untuk mencari elemen pertama
                $('#npsn').val(npsn);
                $('#searchInput').val(namaSekolah);
                closeModal(event); // Memanggil fungsi closeModal
            });
        });
    </script>
@endsection
