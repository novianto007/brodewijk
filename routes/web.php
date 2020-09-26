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

$router->get('/ping', function () {
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
    $router->get("/promo/verify-code/{promoCode}", "PromoController@verifyCode");
    $router->post("/placeorder", "OrderController@placeOrder");
});

$router->get("/payment/finish", "PaymentController@finish");
$router->post("/payment/notification", "PaymentController@notification");

$router->group(['prefix' => 'admin/api'], function () use ($router) {
    $router->post("/login", "Admin\AuthController@login");
    
    $router->group(['middleware' => 'auth:users'], function () use ($router) {
        $router->get("/fabric-types", "Admin\FabricTypeController@getAll");
        $router->post("/fabric-type", "Admin\FabricTypeController@store");
        $router->delete("/fabric-type/{id}", "Admin\FabricTypeController@destroy");

        $router->get("/fabric", "Admin\FabricController@getAll");
        $router->post("/fabric", "Admin\FabricController@store");
        $router->delete("/fabric/{id}", "Admin\FabricController@destroy");

        $router->get("/fabric-color", "Admin\FabricColorController@getAll");
        $router->post("/fabric-color", "Admin\FabricColorController@store");
        $router->delete("/fabric-color/{id}", "Admin\FabricColorController@destroy");
        $router->post("/fabric-color/upload/{id}", "Admin\FabricColorController@upload");

        $router->get("/feature", "Admin\FeatureController@getAll");
        $router->post("/feature", "Admin\FeatureController@store");
        $router->delete("/feature/{id}", "Admin\FeatureController@destroy");

        $router->get("/feature-option", "Admin\FeatureOptionController@getAll");
        $router->post("/feature-option", "Admin\FeatureOptionController@store");
        $router->delete("/feature-option/{id}", "Admin\FeatureOptionController@destroy");
    });
});
