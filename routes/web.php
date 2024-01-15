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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create',function(){
    $user = User::findOrFail(1);
    $role =  new Role(['name'=>'Author']);

    $user->roles()->save($role);
    });


Route::get('/read',function(){

    $user =  User::findOrFail(1);

    // dd($user->roles->first()->name);

    foreach($user->roles as $role){
        return dd($role);
    }


});

Route::get('/update',function(){
    $user = User::findorFail(1);
    if($user->has('roles')){
        foreach($user->roles as $role){
            if($role->name == 'Administrator')
            {
                $role->name = 'administrator';
                $role->save();
            }
        }
    }
});

Route::get('/delete',function(){

    $user = User::findOrFail(1);

    foreach($user->roles as $role){
        $role->where('id',2)->delete();
    }

    // $user->roles()->delete();
});

Route::get('/attach',function(){

    $user = User::findOrFail(2);

    $user->roles()->attach(4);
    
});