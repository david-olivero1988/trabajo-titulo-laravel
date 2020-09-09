<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

//Route::get('/home', 'Auth\AuthController@getLogin');

/****************************inicio login, recuperacion clave******************************************************/

Route::get('salir', [
    'uses' => 'Auth\AuthController@getLogout',
    'as' => 'logout',
]);

Route::get('password', 'Auth\PasswordController@getEmail');

Route::post('password_email', 'Auth\PasswordController@postEmails');
Route::get('recuperar_clave', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::get('/cambiar_clave', function () {
    return view('login.cambiar_clave');
});

/*****************************fin login, recuperacion clave******************************************************/

Route::group(['middleware' => ['verToken']], function () {

});

Route::group(['middleware' => ['web']], function () {

    Route::get('envia_notificacion', 'EnvioNotificacionController@envioNotificacion'); #####pruebas
    Route::get('guarda_notificacion', 'EnvioNotificacionController@index'); #####pruebas

    Route::auth();


    Route::get('/', function () {
        if (!Auth::check()) {
            return view('auth.login');
        } else {
            return redirect()->action('ListadoCampaniasController@index');
        }

    });

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/home', 'HomeController@index');

        /************inicio campañas y universo*************************************/
        Route::get('listado_campanas', 'ListadoCampaniasController@index');

        Route::get('filtro', 'CampaniaController@filtro');

        Route::get('exportar', 'CampaniaController@getExcel');

        Route::get('estado', 'CampaniaController@estado');

        Route::get('eliminar', 'CampaniaController@eliminar');
        Route::get('probar', 'CampaniaController@eliminar');

        Route::get('notificaciones', 'NotificacionesController@index');

        Route::get('notificaciones_calendar', 'LoginController@index'); ###api google calendar

        Route::resource('nuevo_universo', 'NuevoUniversoController');

        Route::post('universo_manual', 'NuevoUniversoController@universoManual');

        Route::post('elimina_universo_manual', 'NuevoUniversoController@eliminaManual');

        Route::resource('nueva_campana', 'CampaniaController');

        Route::post('editar_campana/{id}', 'CampaniaController@editar');

        /**************************fin campañas y universo************************************************/

        /*******************************Usuarios***********************************************/

        Route::resource('administrador_usuarios', 'AdministradorUsuarioController');

        Route::get('filtro_usuarios', 'AdministradorUsuarioController@filtros');

        Route::resource('cuenta', 'CuentaController');

        Route::get('configuracion_general', 'ConfiguracionGeneralController@index');

        Route::post('configuracion_general/store', 'ConfiguracionGeneralController@store');

        /*******************************Fin Usuarios********************************************/

        /*******************************Trazabilidad********************************************/

        Route::get('listado_notificaciones', 'TrazabilidadController@index');

        Route::get('filtro_listado_notificaciones', 'TrazabilidadController@filtro');

        Route::get('exportar_notificaciones', 'TrazabilidadController@exportar');

        Route::get('detalle/{id}', 'TrazabilidadController@detalle');

        Route::get('listado_individual', 'TrazabilidadIndividualController@index');

        Route::get('filtro_listado_individual', 'TrazabilidadIndividualController@filtro');

        Route::get('exportar_listado_individual', 'TrazabilidadIndividualController@exportar');

        /******************************Fin Trazabilidad********************************************/

    });

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */
