<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated()
    {
        $user = Auth::user();

        if ($user->status == '1') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is inactive.');
        }

        if ($user->role == '1') {
            return redirect('admin/dashboard');
        } elseif ($user->role == '2') {
            return redirect('adviser/dashboard');
        } elseif ($user->role == '0') {
            return redirect('home');
        } else {
            return redirect('home');
        }
    }

}
