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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/produtosShow', 'ProdutosController@indexShow')->name('indexProdutosShow')->middleware('auth');
Route::get('/produtosCreate' , 'ProdutosController@indexCreate')->name('indexProdutoCreate')->middleware('auth');

Route::post('/cadastrouProduto' , 'ProdutosController@create')->name('createProduto')->middleware('auth');
Route::get('/mostraProdutos', 'ProdutosController@mostra')->name('mostraProduto')->middleware('auth');

// rotas para botoes em baixo das rotas
Route::get('/mostraProdutosComida', 'ProdutosController@mostraComida')->name('mostraComida')->middleware('auth');
Route::get('/mostraProdutosMoveis', 'ProdutosController@mostraMoveis')->name('mostraMoveis')->middleware('auth');
Route::get('/mostraProdutosBebidas', 'ProdutosController@mostraBebidas')->name('mostraBebidas')->middleware('auth');


Route::post('/alteraProduto/{id}', 'ProdutosController@update')->name('updateProduto')->middleware('auth');
Route::post('/deleteProduto/{id}', 'ProdutosController@delete')->name('deleteProduto')->middleware('auth');

Route::post('checkbox' , 'ProdutosController@pegaCheck')->name('pegaCheck');
