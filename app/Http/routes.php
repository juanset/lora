<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Ensayando el logueo

Route::get('/raimlog', [
    'uses' => 'LogController@login',
    'as'	=> 'raimlog'
]);

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function ()
    {
        return view('user.index');

    });

});

Route::resource('log','LogController');
Route::get('/log', [
    'uses' => 'LogController@login',
    'as'	=> 'log'
]);

Route::resource('store','UsersController');
Route::get('/store', [
    'uses' => 'UsersController@store',
    'as'	=> 'store'
]);

Route::get('/flogin', [
    'uses' => 'UsersController@flogin',
    'as'	=> 'flogin'
]);

Route::get('/fregistry', [
    'uses' => 'UsersController@fregistry',
    'as'	=> 'fregistry'
]);

Route::post('/registry', [
    'uses' => 'UsersController@registry',
    'as'	=> 'registry'
]);

//Ruta para eliminación de objetos de aprendizaje.
Route::get('destroy/{id}',
    [
        'uses' => 'Ar_ScenesController@destroy',
        'as' => 'destroy'
    ]);


/*Route::group(['prefix' => 'admin'], function ()
{
    Route::resource('users','UsersController');

});*/

Route::group(['prefix' => 'admin'], function ()
{
    Route::resource('scenes','Ar_ScenesController');
    Route::get('/scenes', [
        'uses' => 'Ar_ScenesController@index',
        'as'	=> 'scenes'
    ]);

    Route::get('scenes/{id}/visualize/{marker?}',
        [
            'uses' => 'ObjectsController@visualize',
            'as' => 'admin.scenes.visualize'
        ]);

});

//Ruta que dirige al controlador para la edición del objeto de aprendizaje
Route::get('edit/{scene_id}',
    [
        'uses'=>'ObjectsController@edit',
        'as'=>'edit'
    ]);


Route::get('misoas',
[
   'uses'=>'Ar_ScenesController@oas',
    'as'=>'misoas'
]);


Route::get('admin/scenes/create',
    [
        'uses'=>'Ar_ScenesController@create',
        'as'=>'admin.scenes.create'
    ]);


Route::post('upload',
    [
        'uses' => 'Ar_ScenesController@upload',
        'as' => 'upload'
    ]);

Route::get('upload',
    [
        'uses' => 'Ar_ScenesController@upload',
        'as' => 'upload'
    ]);

Route::post('reupload',
    [
        'uses' => 'Ar_ScenesController@reupload',
        'as' => 'reupload'
    ]);


//Ruta que dirige al controlador para guardar la escena.
Route::post('save',
    [
        'uses' => 'Ar_ScenesController@save',
        'as' => 'save'
    ]);

//Ruta para el guardado del formulario de edición.
Route::post('resave',
    [
        'uses' => 'Ar_ScenesController@resave',
        'as' => 'resave'
    ]);

Route::get('save',
    [
        'uses'=>'Ar_ScenesController@save',
        'as'=>'save'
    ]);

Route::post('access',
    [
        'uses' => 'UsersController@login',
        'as' => 'access'
    ]);



//Rutas de mao sama


Route::group(['middleware' => ['web','auth','administrador'],'prefix' => 'Admin'],function(){

    Route::get('/', function ()
    {

        //return view('user.login');
    });


    Route::resource('Rol','RolController');
    Route::get('Rol/{id}/delete',[
        'uses' 	=> 'RolController@delete',
        'as'	=> 'Admin.Rol.delete'
    ]);

    Route::resource('User','UserController');
    Route::get('User/{id}/delete',[
        'uses' 	=> 'UserController@delete',
        'as'	=> 'Admin.User.delete'
    ]);

    Route::get('User',[
        'uses' 	=> 'UserController@index',
        'as'	=> 'Admin.User.index'
    ]);

    Route::resource('Aplication','AplicationController');
    Route::get('Aplication/{id}/delete',[
        'uses' 	=> 'AplicationController@delete',
        'as'	=> 'Admin.Aplication.delete'
    ]);

    Route::resource('Table','TableController');
    Route::get('Table/{id}/delete',[
        'uses' 	=> 'TableController@delete',
        'as'	=> 'Admin.Table.delete'
    ]);

    Route::get('Table/index',[
        'uses' 	=> 'TableController@index',
        'as'	=> 'Admin.Table.index'
    ]);

    Route::resource('Option','OptionController');
    Route::get('Option/{id}/delete',[
        'uses' 	=> 'OptionController@delete',
        'as'	=> 'Admin.Option.delete'
    ]);

    Route::resource('TypeField','TypeFieldController');
    Route::get('TypeField/{id}/delete',[
        'uses' 	=> 'TypeFieldController@delete',
        'as'	=> 'Admin.TypeField.delete'
    ]);

    Route::resource('FieldTable','FieldTableController');
    Route::get('FieldTable/{id}/delete',[
        'uses' 	=> 'FieldTableController@delete',
        'as'	=> 'Admin.FieldTable.delete'
    ]);
    Route::resource('FieldUser','FieldUserController');
    Route::get('FieldUser/{id}/delete',[
        'uses' 	=> 'FieldUserController@delete',
        'as'	=> 'Admin.FieldUser.delete'
    ]);
    Route::get('FieldUser/{id}/EditApps',[
        'uses' 	=> 'FieldUserController@editApps',
        'as'	=> 'Admin.FieldUser.EditApps'
    ]);
    Route::POST('FieldUser/updateAll',[
        'uses' 	=> 'FieldUserController@updateAll',
        'as'	=> 'Admin.FieldUser.UpdateAll'
    ]);
    Route::POST('FieldUser/data',[
        'uses' 	=> 'FieldUserController@data',
        'as'	=> 'Admin.FieldUser.data'
    ]);





});




Route::group(['middleware' => ['web','auth','creador'],'prefix' => 'Creador'],function(){

    Route::get('/',[
        'uses' 	=> 'CreadorController@index',
        'as'	=> 'Creador.index'
    ]);
    Route::get('/{id_user}',[
        'uses' 	=> 'CreadorController@show',
        'as'	=> 'Creador.show'
    ]);
    Route::get('/{FieldUser}/edit',[
        'uses' 	=> 'CreadorController@edit',
        'as'	=> 'Creador.edit'
    ]);
    Route::put('/{user}',[
        'uses' 	=> 'CreadorController@update',
        'as'	=> 'Creador.update'
    ]);
    Route::get('/{id}/EditApps',[
        'uses' 	=> 'CreadorController@editApps',
        'as'	=> 'Creador.EditApps'
    ]);
    Route::POST('/updateAll',[
        'uses' 	=> 'CreadorController@updateAll',
        'as'	=> 'Creador.UpdateAll'
    ]);
    //Route::patch($uri, $callback);
    //Route::delete($uri, $callback);


});
Route::group(['middleware' => ['web','auth','estudiante'],'prefix' => 'Estudiante' ],function(){

    Route::get('/listAplications',[
        'uses' 	=> 'EstudianteController@IndexAplication',
        'as'	=> 'Estudiante.listAplications'
    ]);

    Route::get('/{id_user}',[
        'uses' 	=> 'EstudianteController@show',
        'as'	=> 'Estudiante.show'
    ]);

    Route::get('/',[
        'uses' 	=> 'EstudianteController@index',
        'as'	=> 'Estudiante.index'
    ]);

    Route::get('/{FieldUser}/edit',[
        'uses' 	=> 'EstudianteController@edit',
        'as'	=> 'Estudiante.edit'
    ]);
    Route::put('/{user}',[
        'uses' 	=> 'EstudianteController@update',
        'as'	=> 'Estudiante.update'
    ]);
    Route::get('/{id}/EditApps',[
        'uses' 	=> 'EstudianteController@editApps',
        'as'	=> 'Estudiante.EditApps'
    ]);
    Route::POST('/updateAll',[
        'uses' 	=> 'EstudianteController@updateAll',
        'as'	=> 'Estudiante.UpdateAll'
    ]);




});

Route::group(['prefix' => 'Public'],function(){

    Route::get('/',[
        'uses' 	=> 'PublicController@index',
        'as'	=> 'Public.index'
    ]);

    Route::get('/objectives',[
        'uses' 	=> 'PublicController@objectives',
        'as'	=> 'Public.objectives'
    ]);

    Route::get('/advisers',[
        'uses' 	=> 'PublicController@advisers',
        'as'	=> 'Public.advisers'
    ]);

    Route::get('/reporting',[
        'uses' 	=> 'PublicController@reporting',
        'as'	=> 'Public.reporting'
    ]);

    Route::get('/publications',[
        'uses' 	=> 'PublicController@publications',
        'as'	=> 'Public.publications'
    ]);

    Route::get('/others',[
        'uses' 	=> 'PublicController@others',
        'as'	=> 'Public.others'
    ]);

    Route::get('/searchOa/{id_user?}',[
        'uses' 	=> 'PublicController@searchOa',
        'as'	=> 'Public.searchOa'
    ]);

    Route::get('/listAplications',[
        'uses' 	=> 'PublicController@IndexAplication',
        'as'	=> 'Public.listAplications'
    ]);

    Route::get('/Register',[
        'uses' 	=> 'PublicController@register',
        'as'	=> 'Public.Register'
    ]);
    Route::post('/store',[
        'uses' 	=> 'PublicController@store',
        'as'	=> 'Public.store'
    ]);
    Route::get('/create',[
        'uses' 	=> 'PublicController@create',
        'as'	=> 'Public.create'
    ]);
    Route::get('/{id_user}',[
        'uses' 	=> 'PublicController@show',
        'as'	=> 'Public.show'
    ]);
    Route::post('/storeAll',[
        'uses' 	=> 'PublicController@storeAll',
        'as'	=> 'Public.storeAll'
    ]);
});



Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
