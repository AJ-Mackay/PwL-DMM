<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $user = User::find(1);

    $role = new Role(['name'=>'administrator']);

    $user->roles()->save($role);
});

Route::get('/read', function () {
    $user = User::findOrFail(1);

    foreach($user->roles as $role){
        echo $role->name;
    }
});
