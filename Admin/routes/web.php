<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class,'login'])->name('login');

Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//audit routes
Route::group(['middleware' => 'auth'], function(){

    Route::get('/dashboard', function () {
        return view('admin');
    });
    Route::get('/users', function () {
        $users = User::get();
        return view('users',compact('users'));
    })->name('users');
    Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.destroy');
});
