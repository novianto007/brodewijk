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

$router->get('/ping', function (){ 
    return 'pong';
});

$router->group(['prefix' => 'customer/api'], function () use ($router) {
    $router->post("/register", "AuthController@register");
    $router->post("/login", "AuthController@login");
    $router->get("/profile", "CustomerController@profile");
    $router->get("/fabric/{categorySlug}[/{productSlug}]", "FabricController@getAll");
    $router->get("/feature/{categorySlug}[/{productSlug}]", "FabricController@getFeature");
    $router->get("/measurement", "MeasurementController@getAll");
    $router->post("/add-to-cart", "OrderController@addToCart");
});

$router->post("/upload/{id}", "FabricColorController@upload");
$router->post("/fabric-type", "FabricTypeController@store");
$router->post("/fabric", "FabricController@store");
$router->post("/fabric-color", "FabricColorController@store");
