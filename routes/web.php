<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'PostController@index')->name('home');

Route::get('/login', function () {
    if (auth()->user()) {
        auth()->logout();
    }
    return view('login');
})->name('login');

Route::get('/registration', function () {
    if (auth()->user()) {
        auth()->logout();
    }
   return view('registration');
})->name('registration');

Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('/registration', 'AuthController@registration')->name('registration');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/verifyEmail', 'AuthController@verifyEmail')->name('verifyEmail');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::prefix('post')->as('post.')->group(function () {
        Route::get('/edit/{id}', 'PostController@edit')->name('edit');
        Route::post('/update/{id}', 'PostController@update')->name('update');
        Route::get('/delete/{id}', 'PostController@delete')->name('delete');
    });
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('/users', 'UserController@index')->name('users');
    });
    Route::post('/upload/{id}', 'UserController@upload')->name('upload');
    Route::get('/profile', 'UserController@profile')->name('profile');
});
