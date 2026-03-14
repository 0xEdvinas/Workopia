<?php
require '../helpers.php';
require basePath('Router.php');
require basePath('Database.php');

// Instanciate the router
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get request URI and method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);
