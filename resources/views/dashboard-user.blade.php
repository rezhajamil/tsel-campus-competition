@extends('dashboard')
@section('judul-content')

@endsection

@section('content')
@foreach ($pendaftaran as $daftar)
    
@endforeach
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                  <div class="flex flex-col rounded-lg bg-blue-50 px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Total Project</dt>
          
                    <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ count($pendaftaran) }}</dd>
                  </div>

                  <div class="flex flex-col rounded-lg bg-amber-50 px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Seleksi</dt>
          
                    <dd class="text-4xl font-extrabold text-amber-600 md:text-5xl">{{ $seleksi}}</dd>
                  </div>

                  <div class="flex flex-col rounded-lg bg-emerald-50 px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">DiTerima</dt>
          
                    <dd class="text-4xl font-extrabold text-emerald-600 md:text-5xl">{{ $accepted }}</dd>
                  </div>
          
                  <div class="flex flex-col rounded-lg bg-red-50 px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">DiTolak</dt>
          
                    <dd class="text-4xl font-extrabold text-red-600 md:text-5xl">{{ $decline }}</dd>
                  </div>
                </dl>
            </div>
    </div>
@endsection