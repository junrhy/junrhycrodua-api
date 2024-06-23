<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AccountAuthController extends Controller
{
    use AuthenticatesUsers;

    public function username() {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('account.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('account')->attempt($credentials)) {
            return redirect()->intended('/account/dashboard');
        }

        return back()->withErrors(['account_id' => 'Invalid credentials'])->onlyInput('account_id');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/account/login');
    }
}
