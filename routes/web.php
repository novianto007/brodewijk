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

$router->get('/ping', fn() => 'Pong');

$router->group(['prefix' => 'customer/api'], function () use ($router) {
    $router->post("/register", "AuthController@register");
    $router->post("/login", "AuthController@login");
    $router->get("/profile", "CustomerController@profile");
    $router->get("/fabric/{categorySlug}", "FabricController@getAll");
 });

 $router->post("/upload/{id}", "FabricColorController@upload");