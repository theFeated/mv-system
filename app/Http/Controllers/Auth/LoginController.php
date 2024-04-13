<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('home.admin');
            } elseif (auth()->user()->role == 'editor') {
                return redirect()->route('home.editor');
            } else {
                return redirect()->route('home.user');
            }
        }

        return redirect()->route("login")->with("error", "Incorrect email or password");
    }
}
