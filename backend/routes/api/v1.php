<?php

$router->group(['prefix' => 'client'], function () use ($router) {
	$router->post('/auth/login', 'Client\AccountController@login');
	$router->group(
		['middleware' => 'auth:api-client'],
		function() use ($router) {
			$router->get('/me', 'Client\AccountController@me');
		}
	);
});

$router->group(['prefix' => 'admin'], function () use ($router) {
	$router->post('/auth/login', 'Admin\AccountController@login');
	$router->group(
		['middleware' => 'auth:api-admin'],
		function() use ($router) {
			$router->get('/me', function () use ($router) {
				$user = Auth::user();
				return $user;
			});
			$router->get('/me', 'Admin\AccountController@me');
		}
	);
});