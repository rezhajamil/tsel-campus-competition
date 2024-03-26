@extends('dashboard-admin')

@section('content')
    {{-- Tambahkan tampilan jumlah pendaftaran, peserta, dan proposal di sini --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Jumlah Pendaftaran</h3>
            <p class="text-gray-700">{{ $jumlah_pendaftaran }}</p>
        </div>
        <div class="bg-white shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Jumlah Peserta</h3>
            <p class="text-gray-700">{{ $jumlah_peserta }}</p>
        </div>
        <div class="bg-white shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Jumlah Proposal (Publish)</h3>
            <p class="text-gray-700">{{ $jumlah_publish }}</p>
        </div>
        <div class="bg-white shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Jumlah Proposal (Proses)</h3>
            <p class="text-gray-700">{{ $jumlah_proses }}</p>
        </div>
    </div>


    @if($pendaftarans->isEmpty())
        <p class="text-gray-500 text-center mt-4">Tidak ada pendaftaran ditemukan.</p>
    @else
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelompok</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proposal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($pendaftarans as $index => $pendaftaran)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $pendaftaran->user->user_id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $pendaftaran->user->name }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.Pesertas.index', ['kelompok' => $pendaftaran->kelompok->nama_kelompok]) }}" class="text-indigo-600 hover:text-indigo-900">{{ $pendaftaran->kelompok->nama_kelompok }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $judul_proposal = str_replace(' ', ' ', $pendaftaran->proposal->judul_proposal);
                                    @endphp
                                    <a href="{{ route('admin.proposals.index', ['search' => $judul_proposal]) }}" class="text-indigo-600 hover:text-indigo-900">{{ $pendaftaran->proposal->judul_proposal }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pendaftaran->komentar }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pendaftaran->status }}</td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.pendaftarans.show', $pendaftaran->id) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                    <a href="{{ route('admin.pendaftarans.edit', $pendaftaran->id) }}" class="text-blue-600 hover:text-blue-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.pendaftarans.destroy', $pendaftaran->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
