<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

// use Illuminate\Contracts\Foundation\Application\redirect;

class AuthController extends Controller
{
    protected $table = 'users';

    function login(){
        if(Auth::check()){
            return redirect(route('users'));
        }
        return view('login');
    }

    // login
    function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $currentUser = $user->name;
            Session::put('currentUser', $currentUser);
            $users = User::get();
            return view('users',compact('users'));
        }
        return redirect()->route('login')->with("error", "Login details are not valid");

    }

    // logout
    function logout(){
        Session::flush();
        Auth::logout();
        return view('login');
    }

}