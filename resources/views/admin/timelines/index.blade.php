@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Timeline') }}
    </h2>
@endsection

@section('content')
    <div class="mb-4">
        <form action="{{ route('admin.timelines.index') }}" method="GET">
            <div class="flex items-center">
                <input type="text" name="search" class="w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ketikan nama atau deskripsi" value="{{ request('search') }}">
                <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Search
                </button>
            </div>
        </form>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.timelines.create') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create Timeline
        </a>
    </div>

    @if($timelines->isEmpty())
        <p class="text-gray-500 text-center mt-4">No timelines found.</p>
    @else
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> <!-- Added Actions Column -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($timelines as $index => $timeline)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $timeline->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $timeline->deskripsi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $timeline->waktu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $timeline->mulai }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $timeline->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.timelines.edit', $timeline->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.timelines.destroy', $timeline->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $timelines->appends(request()->except('page'))->links() }}
        </div>
    @endif
@endsection
