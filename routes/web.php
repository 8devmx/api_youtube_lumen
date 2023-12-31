<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('/auth/login', [
    'uses' => 'AuthController@authenticate'
]);

$router->group(
    ['middleware' => 'jwt.auth'],
    function () use ($router) {
        $router->get('/users', 'UserController@index');
        $router->get('/users/{id}', 'UserController@show');
        $router->delete('/users/{id}', 'UserController@destroy');
        $router->put('/users/{id}', 'UserController@update');
        $router->post('/users', 'UserController@store');

        $router->get('/categories', 'CategoryController@index');
        $router->get('/categories/{id}', 'CategoryController@show');
        $router->delete('/categories/{id}', 'CategoryController@destroy');
        $router->post('/categories', 'CategoryController@store');
        $router->put('/categories/{id}', 'CategoryController@update');

        $router->get('/expenses', 'ExpenseController@index');
        $router->get('/expenses/{id}', 'ExpenseController@show');
        $router->delete('/expenses/{id}', 'ExpenseController@destroy');
        $router->post('/expenses', 'ExpenseController@store');
        $router->put('/expenses/{id}', 'ExpenseController@update');
    }
);
