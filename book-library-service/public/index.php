<?php

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app = AppFactory::create();

// Middleware can be added here

// Include routes
require __DIR__ . '/../app/Routes/routes.php';

$app->run();