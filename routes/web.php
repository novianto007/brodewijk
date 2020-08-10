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
    $router->get("/fabric/{categorySlug}[/{productSlug}]", "ProductController@getFabrics");
    $router->get("/feature/{categorySlug}[/{productSlug}]", "ProductController@getFeatures");
    $router->get("/measurement", "MeasurementController@getAll");
    $router->post("/add-to-cart", "CartController@addToCart");
    $router->post("/add-measurement/{id}", "CartController@addMeasurement");
    $router->get("/get-cart", "CartController@getCart");
    $router->get("/provinces", "AddressController@getProvinces");
    $router->get("/cities/{provinceId}", "AddressController@getCities");
    $router->get("/districts/{cityId}", "AddressController@getDistricts");
    $router->post("/address", "AddressController@store");
    $router->get("/address", "AddressController@getAll");
});

$router->group(['prefix' => 'admin/api'], function () use ($router) {
    $router->post("/login", "Admin\AuthController@login");
});

$router->post("/upload/{id}", "FabricColorController@upload");
$router->post("/fabric-type", "FabricTypeController@store");
$router->post("/fabric", "FabricController@store");
$router->post("/fabric-color", "FabricColorController@store");
