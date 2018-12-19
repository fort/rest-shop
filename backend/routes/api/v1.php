<?php

$router->group(['prefix' => 'client'], function () use ($router) {
	$router->post('/auth/login', 'Client\ClientController@login');
	$router->group(
		['middleware' => 'auth:api-client'],
		function() use ($router) {
			$router->get('/me', 'Client\ClientController@me');
		}
	);
});

$router->group(['prefix' => 'admin'], function () use ($router) {
	$router->post('/auth/login', 'Admin\AdminController@login');
	$router->group(
		['middleware' => 'auth:api-admin'],
		function() use ($router) {
			$router->get('/me', function () use ($router) {
				$user = Auth::user();
				return $user;
			});
			$router->get('/me', 'Admin\AdminController@me');
		}
	);
});