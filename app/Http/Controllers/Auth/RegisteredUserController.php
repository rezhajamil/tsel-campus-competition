<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validasi request data
        $request->validate([
            'kode_kampus' => ['required', 'string', 'max:20'],
            'nim' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telp' => ['required', 'string', 'min:11', 'max:13'],
            'ktm' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        // Ambil kode prefix untuk operator Telkomsel dari tabel kode_prefix_operator
        $telkomselPrefixes = DB::table('kode_prefix_operator')
            ->where('operator', 'Telkomsel')
            ->pluck('kode_prefix');

        if ($telkomselPrefixes->isEmpty()) {
            abort(500, 'Tidak ada kode prefix untuk operator Telkomsel.');
        }

        // Validasi nomor telepon dengan kode prefix Telkomsel
        $request->validate([
            'telp' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($telkomselPrefixes) {
                    $validPrefix = false;
                    foreach ($telkomselPrefixes as $prefix) {
                        if (strpos($value, $prefix) === 0) {
                            $validPrefix = true;
                            break;
                        }
                    }
                    if (!$validPrefix || strlen($value) < 11 || strlen($value) > 13) {
                        $fail('Nomor telepon harus Telkomsel dan memiliki panjang karakter antara 11 hingga 13 digit');
                    }
                },
            ],
        ], [
            'telp.regex' => 'Nomor telepon harus dimulai dengan salah satu kode awalan Telkomsel: ' . $telkomselPrefixes->implode(', '),
        ]);

        // Simpan file KTM dengan nama baru
        $ktmFilename = $request->name . '_KTM.' . $request->file('ktm')->extension();
        $ktmPath = $request->file('ktm')->storeAs('ktm', $ktmFilename, 'public');

        // Buat user baru
        // Membuat instance baru dari Peserta
        $user = new User;
        $user->npsn = $request->kode_kampus; // Menyimpan npsn
        $user->nim = $request->nim;
        $user->name = $request->name;
        $user->telp = $request->telp;
        $user->email = $request->email;
        $user->ktm = $ktmPath; // Simpan path file ktm
        $user->password = Hash::make($request->password);
        $user->role = 'Peserta';

        // Menyimpan data peserta ke database
        
        $user->save();

        // Panggil event Registered untuk menandakan bahwa user telah terdaftar
        event(new Registered($user));

        // Autentikasi user yang baru terdaftar
        Auth::login($user);

        // Redirect ke halaman berdasarkan peran
        return $this->redirectBasedOnRole();
    }

    protected function redirectBasedOnRole()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard-admin');
        } elseif (Auth::user()->role === 'Peserta') {
            return redirect()->route('dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
