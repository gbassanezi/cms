<?php

use App\Http\Livewire\FrontPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
    'accessrole'
]], function (){

    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pages', function(){
        return view('admin.pages');
    })->name('pages');

    Route::get('navigation-menus', function(){
        return view('admin.navmenus');
    })->name('nav-menus');

    Route::get('users', function(){
        return view('admin.users');
    })->name('users');

    Route::get('user-permissions', function(){
        return view('admin.user-permissions');
    })->name('user-permissions');
});


Route::get('/{urlslug}', FrontPage::class);
Route::get('/', function () {
    return view('welcome');
});
