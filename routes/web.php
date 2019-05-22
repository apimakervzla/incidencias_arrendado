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
    
    Route::get('/newuser', 'Auth\RegisterController@form')->name('create.users');
    Route::get('/usersall', 'Auth\RegisterController@index')->name('index.users');
    Route::get('/users/e{user_id}', 'Auth\RegisterController@edit')->name('edit.users');
    Route::post('/users/u{user_id}', 'Auth\RegisterController@update')->name('update.users');    
    Route::get('/users/s{user_id}{status}', 'Auth\RegisterController@status')->name('status.users');

    Route::get('/rolesall', 'Auth\RoleController@index')->name('index.roles');
    Route::get('/roles', 'Auth\RoleController@create')->name('create.roles');
    Route::post('/rolesnew', 'Auth\RoleController@store')->name('store.roles');
    Route::get('/roles/e{role}', 'Auth\RoleController@edit')->name('edit.roles');
    Route::post('/roles/u{role}', 'Auth\RoleController@update')->name('update.roles');
    Route::get('/roles/d{role_id}', 'Auth\RoleController@destroy')->name('destroy.roles');

    Route::get('/auditall', 'Auth\AuditController@index')->name('index.audit');

    //MODULO CONTROL NOVEDADES

    Route::get('/novedadesall', 'Novedades\NovedadesController@index')->name('index.novedades');
    Route::get('/novedades', 'Novedades\NovedadesController@create')->name('create.novedades');
    Route::post('/novedadnew', 'Novedades\NovedadesController@store')->name('store.novedades');
    Route::get('/novedades/{novedad_id}', 'Novedades\NovedadesController@show')->name('show.novedades');       
    
    Route::post('/agentesturnosnew', 'AgentesTurnos\AgentesTurnosController@store')->name('store.agentes_turnos');    

    Route::get('/cierreturnonew', 'Turnos\TurnosController@store')->name('store.turnos');    
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO CONTROL NOVEDADES


    //MODULO INCIDENCIAS

    Route::get('/incidenciasall', 'Incidencias\IncidenciasController@index')->name('index.incidencias');
    Route::get('/incidencias', 'Incidencias\IncidenciasController@create')->name('create.incidencias');
    Route::post('/incidencianew', 'Incidencias\IncidenciasController@store')->name('store.incidencias');
    Route::get('/incidencias/{novedad_id}', 'Incidencias\IncidenciasController@show')->name('show.incidencias');   

    //MODULO lLAVES

    Route::get('/llavesall', 'Llaves\LlavesController@index')->name('index.llaves');
    Route::get('/llaves', 'Llaves\LlavesController@create')->name('create.llaves');
    Route::post('/llavenew', 'Llaves\LlavesController@store')->name('store.llaves');
    Route::get('/llaves/{llave_id}', 'Llaves\LlavesController@show')->name('show.llaves');   
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO INCIDENCIAS


    //MODULO LOST FOUND

    Route::get('/lostfoundall', 'LostFound\LostFoundController@index')->name('index.lostfound');
    Route::get('/lostfound', 'LostFound\LostFoundController@create')->name('create.lostfound');
    Route::post('/lostfoundnew', 'LostFound\LostFoundController@store')->name('store.lostfound');
    Route::get('/lostfound/{novedad_id}', 'LostFound\LostFoundController@show')->name('show.lostfound');   
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO LOST FOUND
});
