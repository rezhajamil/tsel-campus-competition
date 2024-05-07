<div class="hero min-h-screen"
    style="background-image: url(https://th.bing.com/th/id/OIP.to4sk2-s8BtH848mub21yAHaE8?rs=1&pid=ImgDetMain);">
    <div class="hero-overlay bg-opacity-80"></div>
    <div class="hero-content text-neutral-content grid grid-cols-1 sm:grid-cols-2 w-full">
        <div class="flex justify-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold text-white">Hello there</h1>
                <p class="mb-5 text-white">Selamat Datang di <span class="font-bold font-batik text-xl text-red-600">By.u
                        Goes To Campus</span><br>Sebuah Platform Event Proposal UMKM Bagi Para Mahasiswa </p>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}">
                            <button class="btn bg-red-600 border-none text-white">Dashboard</button>
                        </a>
                    @else
                    <a href="{{ route('register') }}">
                        <button class="btn bg-red-600 border-none text-white">Get Started</button>
                    </a>    
                    @endauth
                @endif
            </div>
        </div>
        <div class="flex justify-end">
            <div class="card w-96 bg-white bg-opacity-60 shadow-xl">
                <div class="card-body text-red-600">
                    <h2 class="card-title text-4xl font-bold">Login</h2>
                    <p>Silahkan Login Menggunakan Akun Yang Sudah terdaftar</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text text-red-600">Nomor Telepon</span>
                                </div>
                                <input type="text" name="telp" placeholder="Nomor Telkomsel"
                                    class="input input-bordered w-full max-w-xs bg-white text-red-600" required />
                                <div class="label">
                                    <span class="label-text-alt text-red-600">Note: Masukkan Nomor Telepon Telkomsel</span>
                                </div>
                            </label>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text text-red-600">Password</span>
                                </div>
                                <input type="password" name="password" placeholder="Password"
                                    class="input input-bordered w-full max-w-xs bg-white text-red-600"
                                    autocomplete="current-password" required />
                            </label>
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <div class="card-actions justify-end">
                            <button type="submit" class="btn bg-red-600 border-none text-white">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
