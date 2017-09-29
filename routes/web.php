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

$router->get('/', ['as' => 'home', function () use ($router) {
//    return view('home');
    $environment = app()->environment();
    return $environment;
}]);

$router->get('domains/{id}', ['uses' => 'DomainsController@showItem', 'as' => 'showItemDomain']);

$router->get('domains', ['uses' => 'DomainsController@showAll', 'as' => 'showAllDomains']);

$router->post('domains', ['uses' => 'DomainsController@store', 'as' => 'storeDomain']);
