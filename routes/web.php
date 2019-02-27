<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/', ['as' => 'vendedor.salvar', 'uses' => 'VendedorController@salvar']);
$router->get('/{id}', 'RedeController@criarArvore');
