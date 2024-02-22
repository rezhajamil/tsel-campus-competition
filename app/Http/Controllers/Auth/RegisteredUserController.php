<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Mengambil kode prefix untuk operator Telkomsel dari tabel kode_prefix_operator
        $telkomselPrefixes = DB::table('kode_prefix_operator')
            ->where('operator', 'Telkomsel')
            ->pluck('kode_prefix');

        if ($telkomselPrefixes->isEmpty()) {
            abort(500, 'Tidak ada kode prefix untuk operator Telkomsel.');
        }

        // Validasi nomor telepon dengan menggunakan kode prefix Telkomsel
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
                    $length = strlen($value);
                    if (!$validPrefix || $length < 10 || $length > 13) {
                        $fail('Nomor telepon harus Telkomsel dan memiliki panjang karakter antara 11 hingga 13 digit');
                    }
                },
            ],
        ], [
            'telp.regex' => 'Nomor telepon harus dimulai dengan salah satu kode awalan Telkomsel: ' . $telkomselPrefixes->implode(', '),
        ]);


        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Peserta', // Peran default 'peserta'
        ]);

        // Panggil event Registered untuk menandakan bahwa user telah terdaftar
        event(new Registered($user));

        // Autentikasi user yang baru terdaftar
        Auth::login($user);

        // Redirect ke home setelah berhasil terdaftar
        return redirect(RouteServiceProvider::HOME);
    }
}
