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

Route::get('/update', function () {
    $user = User::findOrFail(1);

    if($user->has('roles')){
        foreach($user->roles as $role){
            if($role->name == 'administrator'){
                $role->name = 'Admin';
                $role->save();
            }
        }
    }
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);

    foreach($user->roles as $role){
        $role->whereId(2)->delete();
    }
});

// Creates a record of attachment for a role to a user in role_user table
Route::get('/attach', function () {
    $user = User::findOrFail(1);

    $user->roles()->attach(2);
});

// Removes record of attachment to user, if no number is provided removes all roles from role_user table
Route::get('/detach', function () {
    $user = User::findOrFail(1);

    $user->roles()->detach(3);
});

// Adds given argument to the user's record in the role_user table
// Previous roles must be included to be kept, or they will be replaced by the new role
Route::get('/sync', function () {
    $user = User::findOrFail(1);

    $user->roles()->sync([2,3]);
});