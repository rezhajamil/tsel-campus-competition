<x-app-layout>

    <section class="grid grid-flow-row-dense sm:grid-cols-5 py-8">

        <div>
            <div class="hidden sm:block max-w-full w-fit col-start-1 col-end-2 sm:px-6 lg:px-8">
                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm bg-white">
                    <nav class="grid grid-flow-row grid-rows-8 px-3 py-5 h-screen">
                        <div class=" row-span-7 px-3 py-5">
                            <div>
                                <div class="font-medium text-base text-gray-800 uppercase">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                            </div>
                            <h1 class=" font-bold text-2xl border-b-2 border-indigo-900">MENU</h1>
                            <a href="{{ route('dashboard') }}"
                                class="text-sm flex justify-start items-center mt-5 {{ request()->routeIs('dashboard') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                Dashboard</a>
                            <a href="{{ route('data-diri') }}"
                                class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('data-diri') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                                Data Diri</a>
                            <a href="{{ route('my_project') }}"
                                class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('my_project') ? 'text-indigo-900 font-bold' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                </svg>
                                Project</a>
                        </div>
                        
                        <div class="">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                    class="text-red-600 font-bold border border-red-600 rounded-md text-sm flex justify-center p-2">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        {{-- TimeLine --}}
        <div class="bg-white px-10 rounded-lg">
            {{-- judul --}}
            <div class="flex justify-center items-center border-b-2 my-5">
                <h1 class="font-batik text-lg">{{ __('Timeline') }}</h1>
            </div>
            <!-- Progress bar -->
            <div class="row-span-3 px-10 pb-10">
                <ol
                    class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400 mt-3">
                    <li class="mb-10 ms-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900">
                            <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        </span>
                        <h3 class="font-medium leading-tight">Personal Info</h3>
                        <p class="text-sm">Step details here</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                            </svg>
                        </span>
                        <h3 class="font-medium leading-tight">Account Info</h3>
                        <p class="text-sm">Step details here</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path
                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                            </svg>
                        </span>
                        <h3 class="font-medium leading-tight">Review</h3>
                        <p class="text-sm">Step details here</p>
                    </li>
                    <li class="ms-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path
                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z" />
                            </svg>
                        </span>
                        <h3 class="font-medium leading-tight">Confirmation</h3>
                        <p class="text-sm">Step details here</p>
                    </li>
                </ol>
            </div>
        </div>


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
