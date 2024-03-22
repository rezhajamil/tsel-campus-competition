<x-app-layout>

    <section class="grid grid-flow-row-dense sm:grid-cols-5 py-8">

        <div>
            <div class="hidden sm:block max-w-full w-fit col-start-1 col-end-2 sm:px-6 lg:px-8">
                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm bg-white">
                    <nav class="grid grid-flow-row grid-rows-8 px-3 py-5 h-screen">
                        <div class=" row-span-7 px-3 py-5">
                            <div>
                                <div class="font-medium text-base text-gray-800 uppercase">{{ Auth::user()->name }}
                                </div>
                                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                            <h1 class=" font-bold text-2xl border-b-2 border-indigo-900">MENU</h1>
                            <a href="{{ route('dashboard-admin2') }}"
                                class="text-sm flex justify-start items-center mt-5 {{ request()->routeIs('dashboard') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                Dashboard</a>

                            <a href="{{ route('admin.users.index') }}"
                                class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('admin.users.index') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                                Users
                            </a>
                            <a href="{{ route('admin.Pesertas.index') }}"
                                class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('admin.Pesertas.index') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                                Peserta</a>
                            <a href="{{ route('admin.proposals.index') }}"
                                class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('admin.proposals.index') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="512" height="512"
                                    class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <g id="_01_align_center" data-name="01 align center">
                                        <path
                                            d="M5,19H9.414L23.057,5.357a3.125,3.125,0,0,0,0-4.414,3.194,3.194,0,0,0-4.414,0L5,14.586Zm2-3.586L20.057,2.357a1.148,1.148,0,0,1,1.586,0,1.123,1.123,0,0,1,0,1.586L8.586,17H7Z" />
                                    </g>
                                </svg>
                                Proposal</a>

                                <a href="{{ route('admin.timelines.index') }}" class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('admin.timelines.index') ? 'text-indigo-900 font-bold' : '' }}">
                                    <!-- Ganti dengan ikon SVG yang baru -->
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-1.5 h-5 w-5">
                                        <g id="SVGRepo_iconCarrier">
                                            <!-- Ganti path dengan path ikon SVG yang baru -->
                                            <path d="M12 9V13L14.5 15.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3.5 4.5L7.50002 2" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.5 4.5L16.5 2" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.5 5.20404C8.82378 4.43827 10.3607 4 12 4C16.9706 4 21 8.02944 21 13C21 17.9706 16.9706 22 12 22C7.02944 22 3 17.9706 3 13C3 11.3607 3.43827 9.82378 4.20404 8.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                        </g>
                                    </svg>
                                    Time line
                                </a>


                        </div>

                        <div class="">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                    class="text-red-600 font-bold border-2 border-red-600 hover:bg-red-600 hover:text-white rounded-md text-sm flex justify-center p-2">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        {{-- TimeLine --}}



        <div class=" sm:col-span-4 max-w-7xl mx-3 sm:px-6 lg:px-8">
            <div class="flow-root border-b-2 border-indigo-900 py-3 px-5 shadow-sm">
                <div class="mt-1 flex sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6 justify-between items-center">
                    <div>
                        <p class="mt-2 text-sm text-gray-500">Selamat Datang,</p>
                        <h1 class="font-bold text-xl uppercase">{{ Auth::user()->name }}</h1>
                    </div>
                </div>
            </div>

            <div id="judul" class="flex justify-between my-3 px-3">
                @yield('judul_content')
            </div>

            <div id="dynamic-content" class="bg-white border overflow-hidden shadow-sm sm:rounded-lg">
                @yield('content')
            </div>
        </div>
    </section>

    @yield('script')
</x-app-layout>
