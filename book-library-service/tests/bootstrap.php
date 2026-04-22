<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new \Slim\App(require __DIR__ . '/../config/settings.php');

require __DIR__ . '/../app/Routes/routes.php';

return $app;