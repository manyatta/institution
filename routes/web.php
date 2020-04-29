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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//**Super Admin Routes */
//route for the super admin's home page
Route::namespace('SuperAdmin')->prefix('superadmin')
->name('super_admin.')->middleware('can:super-admin')
->group(function(){
    Route::resource('/home','HomeController');
});
//resourcefulll route for the super admin to manage admins and employers
Route::namespace('SuperAdmin')->prefix('superadmin')->name('super_admin.')->middleware('can:super-admin')->group(function(){
    Route::resource('/users','UsersController');
});
//Resourceful route for the super admin to create institutions, schemas and schema tables
Route::namespace('SuperAdmin')->prefix('superadmin')->name('super_admin.')->middleware('can:super-admin')->group(function(){
    Route::resource('/institutions','SchemasController');
});
//**Super Admin Routes */


//**Institution Admin Routes */
//route for the admin's home page
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin')->group(function(){
    Route::resource('/home','HomeController');
});
//**Institution Admin Routes */


//**Employer Routes */
//route for the admin's home page
Route::namespace('Employer')->prefix('employer')->name('employer.')->middleware('can:employer')->group(function(){
    Route::resource('/home','HomeController');
});
//**Employer Routes */


//**Alumni Routes */
//route for the admin's home page
Route::namespace('Alumni')->prefix('alumni')->name('alumni.')->middleware('can:alumni')->group(function(){
    Route::resource('/home','HomeController');
});
//**Alumni Routes */