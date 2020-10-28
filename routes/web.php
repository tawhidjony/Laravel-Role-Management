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

/* Route::get('/w', function () {
    return view('welcome');
}); */

/* Front End Route */
Route::get('/', function (){ return view('welcome');})->name('/');

/* Backend Route */
Auth::routes();
Route::group(['middleware' => ['auth']], function() {

    Route::get('/update-password', 'ProfileController@changePasswordForm')->name('edit-password');
    Route::put('/update-password', 'ProfileController@updatePassword');
    Route::get('/profile/{id}', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update/{id}', 'ProfileController@update')->name('profile.update');

    Route::group(['prefix' => 'admin', 'middleware' => ['check_permission']], function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::resource('/roles','RoleController');
        Route::resource('/users','UserController');
    });
});
