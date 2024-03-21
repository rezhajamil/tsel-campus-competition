<x-app-layout>

    <section class="grid grid-flow-row-dense sm:grid-cols-5 py-8">

        @include('layouts.menu')

        @include('layouts.timeline')


        <div class=" sm:col-span-3 max-w-7xl mx-3 sm:px-6 lg:px-8">
            <div class="flow-root border-b-2 border-indigo-900 py-3 px-5 shadow-sm">
                <div class="mt-1 flex sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6 justify-between items-center">
                    <div>
                        <p class="mt-2 text-sm text-gray-500">Selamat Datang,</p>
                        <h1 class="font-bold text-xl uppercase">{{ Auth::user()->name }}</h1>
                    </div>
                    <div>
                        <a href="{{ route('data-diri-edit') }}">
                            <button type="button"
                                class="inline-flex items-center rounded-full bg-white px-3 py-2 text-sm font-semibold text-red-600 border-2 border-red-600 shadow-sm hover:bg-red-600 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                Edit</button>
                        </a>
                    </div>
                </div>
            </div>

            <div id="judul" class="flex justify-between my-3 px-3">
                @yield('judul_content')
            </div>

            <div id="dynamic-content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @yield('content')
            </div>
        </div>
    </section>

    @yield('script')
</x-app-layout>
