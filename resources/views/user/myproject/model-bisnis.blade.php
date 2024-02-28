<x-app-layout>
    <section class=" flex flex-col gap-4 sm:grid sm:grid-flow-row-dense sm:grid-cols-3 sm:grid-rows-2 py-4">

        {{-- Team --}}
        <div class="sm:col-span-2 sm:grid sm:grid-flow-row sm:grid-rows-4 sm:px-10 mx-5 gap4 sm:gap-2">

            {{-- judul --}}
            <div class="flex justify-between items-center border-b-2 px-5 py-2">
                @if ($pesertaList->isEmpty())
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('My Team') }}
                    </h1>
                    <a href="{{ route('create_anggota') }}">
                        <button type="button"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Create
                        </button>
                    </a>
                @else
                    @if (count($pesertaList) <= 5)
                        <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                            {{ $pesertaList[0]->nama_kelompok }} Team</h1>
                        <a href="{{ route('create.index') }}">
                            <button type="button"
                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Create
                            </button>
                        </a>
                    @else
                        <h1 class="font-batik text-md sm:text-lg text-gray-800 leading-tight uppercase">
                            {{ $pesertaList[0]->nama_kelompok }} Team</h1>
                    @endif
                @endif
            </div>

            {{-- Project --}}
            <div
                class=" sm:row-span-3 flex items-start sm:items-center sm:justify-start justify-center flex-col bg-white rounded-b-lg px-5 ">
                @if ($pesertaList->isEmpty())
                    <p class="font-sans text-red-500">
                        {{ __('Silahkan Tambah Anggota Tim') }}
                    </p>
                @else
                    @foreach ($pesertaList as $peserta)
                        <ul role="list" class="divide-y divide-gray-100">
                            <li class="flex justify-between sm:max-w-screen-md sm:w-screen py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    {{-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt=""> --}}
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">
                                            {{ $peserta->nama_lengkap }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                            {{ $peserta->npsn }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">{{ $peserta->jabatan }}</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">{{ $peserta->email }}</p>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif

            </div>
        </div>

        {{-- TimeLine --}}
        <div class="bg-white grid grid-flow-row grid-rows-4 px-10 mx-5 gap-2 rounded-lg">
            {{-- judul --}}
            <div class="flex justify-center items-center border-b-2">
                <h1 class="font-batik text-lg">{{ __('Timeline') }}</h1>
            </div>
            <!-- Progress bar -->
            <div class=" row-span-3 px-10 pb-10">
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

        {{-- Tab --}}
        <div class="px-5 sm:ml-10 mt-5 col-span-3">
            <div class="p-6 bg-white border-b border-gray-200">
                <div>
                    <div class="sm:hidden sm:w-screen w-80">
                        <label for="Tab" class="sr-only">Tab</label>

                        <select id="Tab" class="w-full mr-5 rounded-md border-gray-200">
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
    </section>
</x-app-layout>
