<?php
//MEU
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
/*
Route::get('welcome/{name}', function($name){
	return "Seja bem vindo $name!";
})->where('name','[A-Za-z]+');

//esse de baixo e o de cima tem a mesma assinatura

Route::get('welcome/{name?}', function($name = 'visitante'){
	return "Seja bem vindo $name!";
});

Route::get('hello', function(){
	return "hello Word!";
});

Route::get('/', function () {
    return view('welcome');
});*/

/*Routes sites*/
Route::get('/contato', 'Site\SiteController@contato');
Route::get('/empresa', 'Site\SiteController@empresa');
Route::get('/post', 'Site\SiteController@post');
Route::get('/categoria', 'Site\SiteController@categoria');
Route::get('/', 'Site\SiteController@index');

Route::get('/site', function(){
	return view('home.templates.index');
});

Route::get('/sobre','PagesController@sobre');
/*
Route::get('dashboard', function(){
	return view('dashboard');
});*/

Route::get('/amigos','PagesController@amigos');
/*
Route::get('/','PagesController@index');
*/

//====================================
//* Routas do Painel
//=============================
//grupo de rotas de usuario
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function (){
    //Usuários
    Route::any('/usuarios/pesquisar', 'Painel\UsersController@search')->name('usuarios.search');
    Route::resource('/usuarios', 'Painel\UsersController');

    //Categorias
    Route::any('/categorias/pesquisar', 'Painel\CategoriaController@search')->name('categorias.search');
    Route::resource('/categorias', 'Painel\CategoriaController');

    Route::get('/', 'HomeController@index')->name('home');
});


Route::get('/painel/forms', function (){
    return view ('painel.modulos.forms');
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
