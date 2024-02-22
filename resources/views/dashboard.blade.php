<x-app-layout>

    <section class="grid grid-flow-row-dense sm:grid-cols-4 py-8">
        <div id="menu" class="flex justify-end">
            <div class="hidden sm:block max-w-full w-80 col-start-1 col-end-2 sm:px-6 lg:px-8">
                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm bg-white">
                    <div class="grid grid-flow-row gap-3 flex justify-center px-3 py-5">
                        <h1 class=" font-bold text-2xl">MENU</h1>
                        <button id="dashboard-btn" class="text-sm flex justify-start items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </button>
                        <button id="data-btn" class="text-sm flex justify-start items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                            </svg>
                            Data Diri
                        </button>
                        <button id="project-btn" class="text-sm flex justify-start items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>
                            Project
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:col-span-3 max-w-7xl mx-3 sm:px-6 lg:px-8">
            <div class="flow-root rounded-lg border border-gray-100 py-3 px-5 shadow-sm bg-red-200">
                <div class="mt-1 flex sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6 justify-between items-center">
                    <div>
                        <p class="mt-2 text-sm text-gray-500">Selamat Datang,</p>
                        <h1 class="font-bold text-xl">{{ Auth::user()->name }}</h1>
                    </div>
                    <div>
                        <a href="">
                            <button type="button"
                                class="inline-flex items-center rounded-full bg-white px-3 py-2 text-sm font-semibold text-indigo-600 border-2 border-indigo-600 shadow-sm hover:bg-indigo-600 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Edit
                            </button>
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

    @section('scripts')
        @parent <!-- Menambahkan script bawaan dari layout app.blade.php -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Memuat jQuery -->
        <script>
            // Menambahkan pendengar acara click untuk setiap tombol
            $(document).ready(function() {
                $('#dashboard-btn').click(function() {
                    loadPage('dashboard-user');
                });

                $('#data-btn').click(function() {
                    // Implementasi untuk tombol Data Diri
                });

                $('#project-btn').click(function() {
                    loadPage('myproject');
                });
            });

            // Fungsi loadPage
            function loadPage(page) {
                $.ajax({
                    url: `/${page}`,
                    method: 'GET',
                    success: function(data) {
                        $('#dynamic-content').html(data);
                        // Set judul
                        $('#judul').html(page.charAt(0).toUpperCase() + page.slice(
                        1)); // Mengubah huruf pertama menjadi besar
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>