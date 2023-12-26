<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class WellcomeController extends Controller
{//esse controller é apenas para gerenciar as páginas de inicio

    public function dash()
    {
        $user=User::find(Auth::id());
        return view('dash.dash',['user'=>$user]);
    }

    public function index()
    {
        return view('index');
    }


    public function auth()
    {
        return view('auth.auth');
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }    

}
