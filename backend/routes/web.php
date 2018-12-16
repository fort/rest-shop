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

const RESTSHOP_API = [
	'version' => 1.0,
	'description' => 'Opencart REST API'
];

$router->get('/', function () use ($router) {
	return RESTSHOP_API;
});



$router->group(['prefix' => 'client'], function () use ($router) {
	$router->post('/auth/login', 'AuthController@postLogin');
	$router->group(
		['middleware' => 'auth:client-api'], 
		function() use ($router) {
			$router->get('/me', function() {
				$user = Auth::user();
				return response()->json($user);
			});
		}
	);
});