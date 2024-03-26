<div>
    <div class="hidden sm:block max-w-full w-full col-start-1 col-end-2 sm:px-6 lg:px-8">
        <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm bg-white">
            <nav class="grid grid-flow-row grid-rows-4 px-3 py-5 max-h-screen min-h-full">
                <div class=" row-span-3 px-3 py-5 relative">
                    <div>
                        <div class="font-medium text-base text-gray-800 uppercase ">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="flex justify-between border-b-2 border-indigo-900">
                        <h1 class=" font-bold text-2xl">MENU</h1>
                        <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                            class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none  "
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 14 20">
                                <path
                                    d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                            </svg>

                            <div
                                class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 ">
                            </div>
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div id="dropdownNotification"
                        class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow "
                        aria-labelledby="dropdownNotificationButton">
                        <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 ">
                            Notifications
                        </div>
                        <div class="divide-y divide-gray-100 ">
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('notif.list') }}" class="flex px-4 py-3 hover:bg-gray-100 ">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full ">
                                            <svg class="w-2 h-2 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 18 18">
                                                <path
                                                    d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                                                <path
                                                    d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full ps-3">
                                        <div class="text-gray-900 text-md mb-1.5 ">{{ $notification->data['title'] }}
                                        </div>
                                        <span class="text-sm text-black ">{{ $notification->data['message'] }}</span>
                                        <div class="text-xs text-blue-600 ">{{ $notification->created_at }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <a href="#"
                            class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 ">
                            <div class="inline-flex items-center ">
                                <svg class="w-4 h-4 me-2 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                    <path
                                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                </svg>
                                View all
                            </div>
                        </a>
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="text-sm flex justify-start items-center mt-5 {{ request()->routeIs('dashboard') ? 'text-indigo-900 font-bold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard</a>
                    <a href="{{ route('data-diri') }}"
                        class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('data-diri') ? 'text-indigo-900 font-bold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                        Data Diri</a>
                    <a href="{{ route('my_project') }}"
                        class="text-sm flex justify-start items-center mt-3 {{ request()->routeIs('my_project') ? 'text-indigo-900 font-bold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
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
