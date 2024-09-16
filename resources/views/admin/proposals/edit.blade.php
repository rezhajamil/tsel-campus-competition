@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detail Proposal') }}
    </h2>
@endsection

@section('content')
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6 grid grid-cols-2">
            <div class="w-full h-full">
                <div class="pb-4">
                    <span class="font-batik text-red-500">Nama Kelompok</span>
                    <p class="text-2xl font-semibold">{{ $proposal->kelompok->nama_kelompok }}</p>
                </div>
                <div class="pb-4">
                    <span class="font-batik text-red-500">Anggota Kelompok</span>
                    @foreach ($peserta as $anggota)
                        <div class="py-1">
                            <p class="text-lg font-semibold">{{ $anggota->npsn }} - {{ $anggota->nama_lengkap }} <span
                                    class="text-sm font-light">({{ $anggota->jabatan }})</span> </p>
                        </div>
                    @endforeach
                </div>
                <div class="w-full h-full flex item-center">
                    <div class="w-full h-full">
                        <div class="pb-4">
                            <span class="font-batik text-red-500">Judul Proposal</span>
                            <p class="text-2xl font-semibold">{{ $proposal->judul_proposal }}</p>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500">Ide Bisnis</span>
                            <p class="text-2xl font-semibold">{{ $proposal->ide_bisnis }}</p>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500 mb-2">Bisnis Model Canvas</span>
                            <div class="py-2">
                                <a href="{{ asset('storage/model_bisnis_canvas/' . $proposal->model_bisnis_canvas) }}"
                                    target="_blank"
                                    class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->model_bisnis_canvas }}</a>
                            </div>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500">Laba Rugi</span>
                            <p class="text-2xl font-semibold">{{ $proposal->deskripsi_laba_rugi }}</p>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500 mb-2">File Laba Rugi</span>
                            <div class="py-2">
                                <a href="{{ asset('storage/file_laba_rugi/' . $proposal->file_laba_rugi) }}" target="_blank"
                                    class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->file_laba_rugi }}</a>
                            </div>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500">Pemasaran</span>
                            <p class="text-2xl font-semibold">{{ $proposal->deskripsi_pemasaran }}</p>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500 mb-2">File Pemasaran</span>
                            <div class="py-2">
                                <a href="{{ asset('storage/file_pemasaran/' . $proposal->file_pemasaran) }}" target="_blank"
                                    class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->file_pemasaran }}</a>
                            </div>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500">Maintenance</span>
                            <p class="text-2xl font-semibold">{{ $proposal->deskripsi_maintenance }}</p>
                        </div>
                        <div class="pb-4">
                            <span class="font-batik text-red-500 mb-2">File Maintenance</span>
                            <div class="py-2">
                                <a href="{{ asset('storage/file_maintenance/' . $proposal->file_maintenance) }}"
                                    target="_blank"
                                    class="p-2 border border-red-500 text-red-500 font-semibold rounded-lg">{{ $proposal->file_maintenance }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-full">
                        @php
                            $isIncomplete = empty($proposal->ide_bisnis) || empty($proposal->model_bisnis_canvas) || empty($proposal->deskripsi_laba_rugi) || empty($proposal->file_laba_rugi) || empty($proposal->deskripsi_pemasaran) || empty($proposal->file_pemasaran) || empty($proposal->deskripsi_maintenance) || empty($proposal->file_maintenance);
                        @endphp

                        @if(!$isIncomplete)
                            <form action="" method="post" id="penilaian">
                                <div class="flex flex-col items-center">
                                    <div class="pb-4">
                                        <span class="font-batik text-red-500">Masukan Nilai</span>
                                    </div>
                                    <div class="mt-14">
                                        @for ($i = 0; $i < 8; $i++)
                                            <div class="pb-8">
                                                <input type="text" class="w-20 rounded-xl border-red-500 penilaian-input" name="nilai[]">
                                            </div>
                                        @endfor
                                    </div>
                                    <div>
                                        <button type="button" class="px-4 py-1 rounded-lg bg-red-600 hover:bg-red-300" id="calculate-average">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p class="text-red-500">Data proposal tidak lengkap. Penilaian belum bisa diinput.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="mt-8 text-2xl">
                    {{ $proposal->judul_proposal }}
                </div>

                <form action="{{ route('admin.proposals.updateStatus', $proposal->proposal_id) }}" method="POST" class="mt-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="status" class="block font-medium text-sm text-gray-700">Status Proposal</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ $pendaftaran->status != 'Revision' ? 'disabled' : '' }}>
                            <option value="Approved" {{ $pendaftaran->status == 'Approved' ? 'selected' : '' }}>Diterima</option>
                            <option value="Revision" {{ $pendaftaran->status == 'Revision' ? 'selected' : '' }}>Revisi</option>
                            <option value="Rejected" {{ $pendaftaran->status == 'Rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mt-6">
                        <label for="comment" class="block font-medium text-sm text-gray-700">Komentar</label>
                        <textarea name="comment" id="comment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $pendaftaran->komentar }}</textarea>
                    </div>

                    <!-- Inputan Hidden untuk Nilai -->
                    <input type="hidden" name="nilai" id="nilai" value="{{ $pendaftaran->nilai }}">

                    <div class="mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(!$isIncomplete && empty($pendaftaran->nilai))
        <script>
            document.getElementById('calculate-average').addEventListener('click', function() {
                var inputs = document.querySelectorAll('.penilaian-input');
                var total = 0;
                var count = 0;

                inputs.forEach(function(input) {
                    var value = parseFloat(input.value);
                    if (!isNaN(value)) {
                        total += value;
                        count++;
                    }
                });

                if (count === 0) {
                    return;
                }

                var average = total / count;
                document.getElementById('nilai').value = average.toFixed(2);

                var status = document.getElementById('status');
                var comment = document.getElementById('comment');

                if (average > 80) {
                    status.value = 'Approved';
                    comment.value = 'Selamat proposal anda diterima dengan nilai rata-rata ' + average.toFixed(2);
                } else if (average > 75) {
                    status.value = 'Revision';
                    comment.value = 'Proposal anda memerlukan revisi dengan nilai rata-rata ' + average.toFixed(2);
                } else {
                    status.value = 'Rejected';
                    comment.value = 'Proposal anda ditolak dengan nilai rata-rata ' + average.toFixed(2);
                }

                // Optional: Submit the form if desired
                // document.getElementById('penilaian').submit();
            });

             // Menyembunyikan seluruh formulir jika status sudah ditetapkan
        document.addEventListener('DOMContentLoaded', function() {
            var status = '{{ $pendaftaran->status }}';
            var penilaianForm = document.getElementById('penilaian');
            var submitButton = document.getElementById('calculate-average');

            if (status === 'Approved' || status === 'Rejected') {
                // Menyembunyikan formulir penilaian
                penilaianForm.style.display = 'none';
                
                // Menyembunyikan tombol submit jika ada
                if (submitButton) {
                    submitButton.style.display = 'none';
                }

                // Menampilkan nilai yang sudah ada jika perlu
                var nilaiElements = document.querySelectorAll('.nilai-element');
                nilaiElements.forEach(function(element) {
                    element.style.display = 'block'; // Atur display sesuai kebutuhan
                });
            }
        });
        </script>
    @endif
@endsection
