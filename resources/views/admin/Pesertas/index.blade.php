@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Peserta') }}
    </h2>
@endsection

@section('content')
    <div class="p-8">
        <div class="flex items-center gap-10">
            <div class="mb-4">
                <form action="{{ route('admin.Pesertas.index') }}" method="GET">
                    <div class="mb-4">
                        <label for="kelompok" class="block text-gray-700 text-sm font-bold mb-2">Search :</label>
                        <div class="flex items-center">
                            <input type="text" name="search"
                                class="w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Search by name, NPSN, or NIM..." value="{{ request('search') }}">
                            <button type="submit"
                                class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="mb-4">
                <form action="{{ route('admin.Pesertas.index') }}" method="GET">
                    <div class="mb-4">
                        <label for="kelompok" class="block text-gray-700 text-sm font-bold mb-2">Filter by Kelompok:</label>
                        <div class="flex items-center">
                            <select name="kelompok" id="kelompok"
                                class="form-select rounded-md shadow-sm mt-1 block w-60 px-4 py-2">
                                <option value="" {{ !request('kelompok') ? 'selected' : '' }}>All Kelompok</option>
                                <!-- Isi pilihan dengan kelompok-kelompok yang ada -->
                                @isset($kelompoks)
                                    @foreach ($kelompoks as $kelompok)
                                        <option value="{{ $kelompok->nama_kelompok }}"
                                            {{ request('kelompok') == $kelompok->nama_kelompok ? 'selected' : '' }}>
                                            {{ $kelompok->nama_kelompok }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <button type="submit"
                                class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if ($pesertas->isEmpty())
            <p class="text-gray-500 text-center mt-4">No pesertas found.</p>
        @else
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Lengkap</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NPSN</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelompok</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor WA</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jabatan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($pesertas as $index => $peserta)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->nama_lengkap }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->npsn }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->nama_kelompok }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->nomor_wa }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $peserta->jabatan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.Pesertas.edit', $peserta->id_peserta) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('admin.Pesertas.destroy', $peserta->id_peserta) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $pesertas->appends(request()->except('page'))->links() }}
            </div>
        @endif
    </div>
@endsection
