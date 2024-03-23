<div>
    <div class="hidden sm:block max-w-full w-full col-start-1 col-end-2 sm:px-6 lg:px-8">
        <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm bg-white">
            <nav class="grid grid-flow-row grid-rows-4 px-3 py-5 max-h-screen min-h-full">
                <div class=" row-span-3 px-3 py-5 relative">
                    <div>
                        <div class="font-medium text-base text-gray-800 uppercase ">{{ Auth::user()->name }}</div>
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
                
                <div class="relative ">
                    <div class="absolute inset-x-0 bottom-0 ">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                class="text-red-600 font-bold border-2 border-red-600 hover:bg-red-600 hover:text-white rounded-md text-sm flex justify-center p-2">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                    
                </div>
            </nav>
        </div>
    </div>
</div>