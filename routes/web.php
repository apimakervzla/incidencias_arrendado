<?php

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
Auth::routes(['verify' => true]);

App::setLocale("es");
Route::middleware(['middleware' => 'verified'])->group(function(){

    Route::get('/', function () {
        return view('index');
    });
   
    Route::get('/usersall', 'Auth\RegisterController@index')->name('index.users');
    Route::get('/newuser', 'Auth\RegisterController@form')->name('create.users');    
    Route::get('/users/e{user_id}', 'Auth\RegisterController@edit')->name('edit.users');
    Route::post('/users/u{user_id}', 'Auth\RegisterController@update')->name('update.users');    
    Route::get('/users/s{user_id}{id_estado}', 'Auth\RegisterController@status')->name('status.users');

    Route::get('/rolesall', 'Auth\RoleController@index')->name('index.roles');
    Route::get('/roles', 'Auth\RoleController@create')->name('create.roles');
    Route::post('/rolesnew', 'Auth\RoleController@store')->name('store.roles');
    Route::get('/roles/e{role}', 'Auth\RoleController@edit')->name('edit.roles');
    Route::post('/roles/u{role}', 'Auth\RoleController@update')->name('update.roles');
    Route::get('/roles/d{role_id}', 'Auth\RoleController@destroy')->name('destroy.roles');

    Route::get('/auditall', 'Auth\AuditController@index')->name('index.audit');
});

