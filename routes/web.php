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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('home.redirect');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);    
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);

    //Welcome Route
    Route::get('/welcome', function(){
        $header ='';
        $sub_header ='';
        return view('welcome',compact('header','sub_header'));
    })->name('welcome');

    //Login Route
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');
    
    //Logout Route
    Route::get('/logout', 'Backend\Auth\LoginController@logout')->name('admin.logout');

    //Permissions Route
    Route::resource('permissions', 'Backend\PermissionsController', ['names' => 'admin.permissions']);

    //Normal Users Form Route
    Route::get('normal_users/create', 'Backend\AdminsController@normal_user_create')->name('admin.normal_users.create');
    Route::post('normal_users', 'Backend\AdminsController@normal_user_store')->name('admin.normal_users.store');
});

