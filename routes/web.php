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
$router->group(['middleware' => 'BasicAuth'], function() use ($router){
    $router->get('/get-items', 'ItemsController@getAll');
    $router->post('/item', 'ItemsController@store');
    $router->put('/item/{id}', 'ItemsController@update');
    $router->delete('/item/{id}', 'ItemsController@destroy');
});

