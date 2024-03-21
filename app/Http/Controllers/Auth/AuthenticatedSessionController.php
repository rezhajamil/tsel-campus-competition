<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request using phone number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function create()
     {
         return view('auth.login');
     }

    public function loginByPhone(Request $request)
    {
        $request->validate([
            'telp' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user using phone number and password
        if (Auth::attempt(['telp' => $request->telp, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect user based on their role
            return $this->redirectBasedOnRole();
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors([
            'telp' => 'Nomor telepon atau kata sandi salah.',
        ])->withInput($request->only('telp', 'remember'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'telp' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user using email and password
        if (Auth::attempt(['telp' => $request->telp, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect user based on their role
            return $this->redirectBasedOnRole();
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors([
            'telp' => 'Nomor telepon atau kata sandi salah.',
        ])->withInput($request->only('telp', 'remember'));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect user based on their role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnRole()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard-admin');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
