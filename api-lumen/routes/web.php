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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('cars', 'CarsController@getAll');
    
    $router->get('car/{id}', 'CarsController@get');
    
    $router->post('car', 'CarsController@store');
    
    $router->put('car/{id}', 'CarsController@update');
    
    $router->delete('car/{id}', 'CarsController@destroy');
});

