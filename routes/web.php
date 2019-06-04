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
    
    Route::post('/sigturnoigusuper', 'Auth\RegisterController@logoutsigturnoigusuper')->name('logout.sigturnoigusuper')->middleware('verified');
    Route::post('/turnodifsuper', 'Auth\RegisterController@logoutturnodifsuper')->name('logout.turnodifsuper')->middleware('verified');
    Route::post('/turnocerrado', 'Auth\RegisterController@logoutturnocerrado')->name('logout.turnocerrado')->middleware('verified');
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
