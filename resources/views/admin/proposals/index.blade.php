@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Proposal') }}
    </h2>
@endsection

@section('content')
<div class="mb-4">
    <!-- Search Form -->
    <!-- Modify the action and method as per your requirements -->
    <form action="{{ route('admin.proposals.index') }}" method="GET">
        <div class="flex items-center">
            <input type="text" name="search" class="w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ketikan judul ,nama" value="{{ request('search') }}">
            <!-- Menambahkan input hidden untuk menyimpan nilai filter kelompok -->
            <input type="hidden" name="kelompok" value="{{ request('kelompok') }}">
            <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Search
            </button>
        </div>
    </form>
</div>

    <div class="mb-4">
        <!-- Filter Form -->
        <!-- Modify the action and method as per your requirements -->
        <form action="{{ route('admin.proposals.index') }}" method="GET">
            <div class="mb-4">
                <label for="kelompok" class="block text-gray-700 text-sm font-bold mb-2">Filter by Kelompok:</label>
                <select name="kelompok" id="kelompok" class="form-select rounded-md shadow-sm mt-1 block w-full">
                    <option value="" {{ !request('kelompok') ? 'selected' : '' }}>All Kelompok</option>
                    <!-- Isi pilihan dengan kelompok-kelompok yang ada -->
                    @isset($kelompoks)
                        @foreach($kelompoks as $kelompok)
                            <option value="{{ $kelompok->nama_kelompok }}" {{ request('kelompok') == $kelompok->nama_kelompok ? 'selected' : '' }}>{{ $kelompok->nama_kelompok }}</option>
                        @endforeach
                    @endisset
                </select>
                <!-- Menambahkan input hidden untuk menyimpan nilai pencarian -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            </div>
        </form>
    </div>


    @if($proposals->isEmpty())
        <p class="text-gray-500 text-center mt-4">No proposals found.</p>
    @else
        <!-- Proposal Table -->
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelompok</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Proposal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ide Bisnis</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model Bisnis Canvas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Laba Rugi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Laba Rugi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Pemasaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Pemasaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Maintenance</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Maintenance</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approvefal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($proposals as $index => $proposal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->kelompok->nama_kelompok }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->judul_proposal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->ide_bisnis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ asset('storage/model_bisnis_canvas/' . $proposal->model_bisnis_canvas) }}" method="GET" class="inline">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">{{ $proposal->model_bisnis_canvas }}</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->deskripsi_laba_rugi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ asset('storage/file_laba_rugi/' . $proposal->file_laba_rugi) }}" method="GET" class="inline">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">{{ $proposal->file_laba_rugi }}</button>
                                    </form>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->deskripsi_pemasaran }}</td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ asset('storage/file_pemasaran/' . $proposal->file_pemasaran) }}" method="GET" class="inline">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">{{ $proposal->file_pemasaran }}</button>
                                    </form>
                                </td>



                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->deskripsi_maintenance }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ asset('storage/file_maintenance/' . $proposal->file_maintenance) }}" method="GET" class="inline">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">{{ $proposal->file_maintenance }}</button>
                                    </form>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->updated_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.proposals.edit', $proposal->id_proposal) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    {{-- <form action="{{ route('admin.proposals.destroy', $proposal->id_proposal) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form> --}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.proposals.approve', $proposal->id_proposal) }}" class="text-green-600 hover:text-green-900 ml-2">Approval</a>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $proposals->appends(request()->except('page'))->links() }}
        </div>
    @endif
@endsection
