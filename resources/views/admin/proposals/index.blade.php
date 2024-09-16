@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Proposal') }}
    </h2>
@endsection

@section('content')
    <div class="p-8">
        <div class="flex items-center gap-10">
            <div class="mb-4">
                <!-- Search Form -->
                <!-- Modify the action and method as per your requirements -->
                <form action="{{ route('admin.proposals.index') }}" method="GET">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Filter by Judul :</label>
                        <div class="flex items-center">
                            <input type="text" name="search"
                                class="w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Ketikan judul ,nama" value="{{ request('search') }}">
                            <!-- Menambahkan input hidden untuk menyimpan nilai filter kelompok -->
                            <input type="hidden" name="kelompok" value="{{ request('kelompok') }}">
                            <button type="submit"
                                class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="mb-4">
                <!-- Filter Form -->
                <!-- Modify the action and method as per your requirements -->
                <form action="{{ route('admin.proposals.index') }}" method="GET">
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
                            <!-- Menambahkan input hidden untuk menyimpan nilai pencarian -->
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <button type="submit"
                                class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @if ($proposals->isEmpty())
            <p class="text-gray-500 text-center mt-4">No proposals found.</p>
        @else
            <!-- Proposal Table -->
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto" x-data="{ open: false }">
                    <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelompok</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul
                                    Proposal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($proposals as $index => $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->kelompok->nama_kelompok }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->judul_proposal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap relative">
                                        <a href="{{ route('admin.proposals.edit', $proposal->proposal_id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Detail</a>
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
    </div>
@endsection
