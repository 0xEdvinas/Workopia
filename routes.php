<?php

$router->get('/', 'HomeController@index');

$router->get('/listings', 'ListingController@index');
$router->get('/listings/{id}', 'ListingController@show');
$router->get('/listings/create', 'ListingController@create');
$router->post('/listings', 'ListingController@store');
$router->delete('/listings/{id}', 'ListingController@destroy');
