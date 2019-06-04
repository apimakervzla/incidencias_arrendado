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
    
    Route::get('/newuser', 'Auth\RegisterController@form')->name('create.users')->middleware('verified');
    Route::get('/usersall', 'Auth\RegisterController@index')->name('index.users')->middleware('verified');
    Route::get('/users/e{user_id}', 'Auth\RegisterController@edit')->name('edit.users')->middleware('verified');
    Route::post('/users/u{user_id}', 'Auth\RegisterController@update')->name('update.users')->middleware('verified');    
    Route::get('/users/s{user_id}{status}', 'Auth\RegisterController@status')->name('status.users')->middleware('verified');

    Route::get('/rolesall', 'Auth\RoleController@index')->name('index.roles')->middleware('verified');
    Route::get('/roles', 'Auth\RoleController@create')->name('create.roles')->middleware('verified');
    Route::post('/rolesnew', 'Auth\RoleController@store')->name('store.roles')->middleware('verified');
    Route::get('/roles/e{role}', 'Auth\RoleController@edit')->name('edit.roles')->middleware('verified');
    Route::post('/roles/u{role}', 'Auth\RoleController@update')->name('update.roles')->middleware('verified');    

    Route::get('/auditall', 'Auth\AuditController@index')->name('index.audit');

    //MODULO NOTIFICACIONES CORREO 
    Route::get('/notificacionescorreoall', 'NotificacionesCorreo\NotificacionesCorreoController@index')->name('index.notificacionescorreo');
    Route::get('/notificacionescorreo', 'NotificacionesCorreo\NotificacionesCorreoController@create')->name('create.notificacionescorreo')->middleware('verified');
    Route::post('/notificacionescorreonew', 'NotificacionesCorreo\NotificacionesCorreoController@store')->name('store.notificacionescorreo')->middleware('verified');
    //Route::get('/tiposllaves/{tipo_llave_id}', 'TiposLLaves\NotificacionesCorreoController@show')->name('show.tiposllaves');   
    Route::get('/notificacionescorreo/{id}', 'NotificacionesCorreo\NotificacionesCorreoController@edit')->name('edit.notificacionescorreo');   
    Route::post('/notificacionescorreo/u{id}', 'NotificacionesCorreo\NotificacionesCorreoController@update')->name('update.notificacionescorreo')->middleware('verified');;   
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO NOTIFICACIONES CORREO 



    //MODULO TIPOS LLAVES

    Route::get('/tiposllavesall', 'TiposLLaves\TiposLlavesController@index')->name('index.tiposllaves');
    Route::get('/tiposllaves', 'TiposLLaves\TiposLlavesController@create')->name('create.tiposllaves')->middleware('verified');
    Route::post('/tiposllavesnew', 'TiposLLaves\TiposLlavesController@store')->name('store.tiposllaves')->middleware('verified');
    //Route::get('/tiposllaves/{tipo_llave_id}', 'TiposLLaves\TiposLlavesController@show')->name('show.tiposllaves');   
    Route::get('/tiposllaves/{id}', 'TiposLLaves\TiposLlavesController@edit')->name('edit.tiposllaves');   
    Route::post('/tiposllaves/u{id}', 'TiposLLaves\TiposLlavesController@update')->name('update.tiposllaves')->middleware('verified');;   
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO TIPOS LLAVES




    //MODULO TBLPISOS
    Route::get('/tblpisosall', 'TblPisos\TblPisosController@index')->name('index.tblpisos');
    Route::get('/tblpisos', 'TblPisos\TblPisosController@create')->name('create.tblpisos')->middleware('verified');
    Route::post('/tblpisosnew', 'TblPisos\TblPisosController@store')->name('store.tblpisos')->middleware('verified');    
    Route::get('/tblpisos/{id}', 'TblPisos\TblPisosController@edit')->name('edit.tblpisos');   
    Route::post('/tblpisos/u{id}', 'TblPisos\TblPisosController@update')->name('update.tblpisos')->middleware('verified');
    //FIN MODULO TBLPISOS

    //MODULO TBLLUGARES
    Route::get('/tbllugaresall', 'TblLugares\TblLugaresController@index')->name('index.tbllugares');
    Route::get('/tbllugares', 'TblLugares\TblLugaresController@create')->name('create.tbllugares')->middleware('verified');
    Route::post('/tbllugaresnew', 'TblLugares\TblLugaresController@store')->name('store.tbllugares')->middleware('verified');    
    Route::get('/tbllugares/{id}', 'TblLugares\TblLugaresController@edit')->name('edit.tbllugares');   
    Route::post('/tbllugares/u{id}', 'TblLugares\TblLugaresController@update')->name('update.tbllugares')->middleware('verified');
    //FIN MODULO TBLLUGARES

    //MODULO TblPisosLugares
    Route::get('/tblpisoslugaresall', 'TblPisosLugares\TblPisosLugaresController@index')->name('index.tblpisoslugares');
    Route::get('/tblpisoslugares', 'TblPisosLugares\TblPisosLugaresController@create')->name('create.tblpisoslugares')->middleware('verified');
    Route::post('/tblpisoslugaresnew', 'TblPisosLugares\TblPisosLugaresController@store')->name('store.tblpisoslugares')->middleware('verified');    
    Route::get('/tblpisoslugares/{id}', 'TblPisosLugares\TblPisosLugaresController@edit')->name('edit.tblpisoslugares');   
    Route::post('/tblpisoslugares/u{id}', 'TblPisosLugares\TblPisosLugaresController@update')->name('update.tblpisoslugares')->middleware('verified');
    //FIN MODULO TblPisosLugares

    //MODULO TblPisosLugaresTiposLlaves
    Route::get('/tblpisoslugarestiposllavesall', 'TblPisosLugaresTiposLlaves\TblPisosLugaresTiposLlavesController@index')->name('index.tblpisoslugarestiposllaves');
    Route::get('/tblpisoslugarestiposllaves', 'TblPisosLugaresTiposLlaves\TblPisosLugaresTiposLlavesController@create')->name('create.tblpisoslugarestiposllaves')->middleware('verified');
    Route::post('/tblpisoslugarestiposllavesnew', 'TblPisosLugaresTiposLlaves\TblPisosLugaresTiposLlavesController@store')->name('store.tblpisoslugarestiposllaves')->middleware('verified');    
    Route::get('/tblpisoslugarestiposllaves/{id}/{tipo_llave_id}', 'TblPisosLugaresTiposLlaves\TblPisosLugaresTiposLlavesController@edit')->name('edit.tblpisoslugarestiposllaves');   
    Route::post('/tblpisoslugarestiposllaves/u{id}', 'TblPisosLugaresTiposLlaves\TblPisosLugaresTiposLlavesController@update')->name('update.tblpisoslugarestiposllaves')->middleware('verified');
    //FIN MODULO TblPisosLugaresTiposLlaves

    //MODULO TblTiposTurnos
    Route::get('/tbltiposturnossall', 'TblTiposTurnos\TblTiposTurnosController@index')->name('index.tbltiposturnos');
    Route::get('/tbltiposturnos', 'TblTiposTurnos\TblTiposTurnosController@create')->name('create.tbltiposturnos')->middleware('verified');
    Route::post('/tbltiposturnosnew', 'TblTiposTurnos\TblTiposTurnosController@store')->name('store.tbltiposturnos')->middleware('verified');    
    Route::get('/tbltiposturnos/{id}', 'TblTiposTurnos\TblTiposTurnosController@edit')->name('edit.tbltiposturnos');   
    Route::post('/tbltiposturnos/u{id}', 'TblTiposTurnos\TblTiposTurnosController@update')->name('update.tbltiposturnos')->middleware('verified');
    //FIN MODULO TblTiposTurnos




    //MODULO CONTROL NOVEDADES

    Route::get('/novedadesall', 'Novedades\NovedadesController@index')->name('index.novedades');
    Route::get('/novedades', 'Novedades\NovedadesController@create')->name('create.novedades')->middleware('verified');
    Route::post('/novedadnew', 'Novedades\NovedadesController@store')->name('store.novedades')->middleware('verified');
    Route::get('/novedades/{novedad_id}', 'Novedades\NovedadesController@show')->name('show.novedades');       
    
    Route::post('/agentesturnosnew', 'AgentesTurnos\AgentesTurnosController@store')->name('store.agentes_turnos')->middleware('verified');    

    Route::get('/cierreturnonew', 'Turnos\TurnosController@store')->name('store.turnos')->middleware('verified');    
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO CONTROL NOVEDADES


    //MODULO INCIDENCIAS

    Route::get('/incidenciasall', 'Incidencias\IncidenciasController@index')->name('index.incidencias');
    Route::get('/incidencias', 'Incidencias\IncidenciasController@create')->name('create.incidencias')->middleware('verified');
    Route::post('/incidencianew', 'Incidencias\IncidenciasController@store')->name('store.incidencias')->middleware('verified');
    Route::get('/incidencias/{novedad_id}', 'Incidencias\IncidenciasController@show')->name('show.incidencias');   

    //MODULO lLAVES
    
    Route::get('/llavesall', 'Llaves\LlavesController@index')->name('index.llaves');
    Route::get('/llaves', 'Llaves\LlavesController@create')->name('create.llaves')->middleware('verified');
    Route::get('/llaves/tl{role_user_id_permisado}', 'Llaves\LlavesController@combo')->name('combo.llaves'); 
    Route::post('/llavenew', 'Llaves\LlavesController@store')->name('store.llaves')->middleware('verified');
    Route::get('/llaves/s{tipo_llave_id}', 'Llaves\LlavesController@status')->name('status.llaves')->middleware('verified'); 
    Route::get('/llaves/{llave_id}', 'Llaves\LlavesController@show')->name('show.llaves');  
    
    




    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO INCIDENCIAS


    //MODULO LOST FOUND

    Route::get('/lostfoundall', 'LostFound\LostFoundController@index')->name('index.lostfound');
    Route::get('/lostfound', 'LostFound\LostFoundController@create')->name('create.lostfound')->middleware('verified');
    Route::post('/lostfoundnew', 'LostFound\LostFoundController@store')->name('store.lostfound')->middleware('verified');
    Route::get('/lostfound/{novedad_id}', 'LostFound\LostFoundController@show')->name('show.lostfound');   
    
    // Route::get('/hola', function () {
    //     return view('ControlNovedades.create');
    // });

    //FIN MODULO LOST FOUND

    
});
