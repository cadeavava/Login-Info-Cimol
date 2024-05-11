<?php

session_start();

require '../vendor/autoload.php';

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use app\classes\TwigGlobal;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

TwigGlobal::set('is_logged_in', $_SESSION['is_logged_in'] ?? '');
TwigGlobal::set('user', $_SESSION['user_logged_data'] ?? '');

require '../app/helpers/config.php';
require '../app/helpers/redirect.php';
require '../app/routes/site.php';
require '../app/routes/user.php';

$app->map(['GET', 'POST'], '/{routes:.+}', function ($request, $response) {
    $response->getBody()->write('Endereço não existe');
    return $response;
});

$app->run();