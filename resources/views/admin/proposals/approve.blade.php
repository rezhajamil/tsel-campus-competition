@extends('dashboard-admin')

@section('judul_content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Approve Proposal') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ $proposal->judul_proposal }}
                    </div>

                    <div class="mt-6 text-gray-500">
                        <p>{{ $proposal->deskripsi_proposal }}</p>
                    </div>

                    <form action="{{ route('admin.proposals.updateStatus', $proposal->id_proposal) }}" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="status" class="block font-medium text-sm text-gray-700">Status Proposal</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Approved">Diterima</option>
                                <option value="Revision">Revisi</option>
                                <option value="Rejected">Ditolak</option>
                            </select>
                        </div>

                        <div class="mt-6">
                            <label for="comment" class="block font-medium text-sm text-gray-700">Komentar</label>
                            <textarea name="comment" id="comment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
