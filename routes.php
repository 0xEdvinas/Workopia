<?php

$router->get('/', 'HomeController@index');

$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->post('/listings', 'ListingController@store');
$router->get('/listings/edit/{id}', 'ListingController@edit');
$router->get('/listings/{id}', 'ListingController@show');
$router->delete('/listings/{id}', 'ListingController@destroy');
$router->put('/listings/{id}', 'ListingController@update');

$router->get('/auth/register', 'UserController@create');
$router->get('/auth/login', 'UserController@login');
