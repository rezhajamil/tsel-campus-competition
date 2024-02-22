<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->name }}
        </h2>
    </x-slot>

    <div class="py-12 grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
        <div class="h-fit rounded-lg bg-white lg:col-span-2 px-6 py-3 md:px-5 lg:px-8 mx-5">
            <h1>{{ __('My Team') }}</h1>
            <ul role="list" class="divide-y divide-gray-100">
                <li class="flex justify-between py-5 max-w-4xl">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900">Leslie Alexander</p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                leslie.alexander@example.com</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-gray-900">Co-Founder / CEO</p>
                        <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h
                                ago</time></p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="h-fit w-fit rounded-lg bg-white mx-5 px-6 py-3 md:px-5 lg:px-8 flex flex-col justify-center">
            <h1 class="font-batik text-lg">{{ __('Timeline') }}</h1>


            <ol class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400 mt-3">
                <li class="mb-10 ms-6">
                    <span
                        class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900">
                        <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
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
    <div class=" max-w-screen min-h-screen mx-2 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div>
                    <div class="sm:hidden">
                        <label for="Tab" class="sr-only">Tab</label>

                        <select id="Tab" class="w-full rounded-md border-gray-200">
                            <option>Settings</option>
                            <option>Messages</option>
                            <option>Archive</option>
                            <option select>Notifications</option>
                        </select>
                    </div>

                    <div class="hidden sm:block">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex gap-6">
                                <a href="#"
                                    class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                                    Settings
                                </a>

                                <a href="#"
                                    class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                                    Messages
                                </a>

                                <a href="#"
                                    class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                                    Archive
                                </a>

                                <a href="#"
                                    class="shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600">
                                    Notifications
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
