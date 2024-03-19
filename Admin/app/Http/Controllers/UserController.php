<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function delete(User $user){
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
}
