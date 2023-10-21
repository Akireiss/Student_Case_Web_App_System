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
        if(Auth::user()->role == '1'){
            return redirect('admin/dashboard');
        }
        elseif(Auth::user()->role == '2'){
            return redirect('adviser/dashboard');
        } elseif(Auth::user()->role == '0'){
            return redirect('home');
        }else{
            return redirect('home');
        }
    }
}
