<?php

$router->get('/', 'HomeController@index');

$router->get('/listings', 'ListingController@index');
$router->get('/listing', 'ListingController@show');
$router->get('/listings/create', 'ListingController@create');
