<?php
namespace app\routes;

use app\controllers\User;

require '../app/middlewares/logged.php';

$app->get('/user/create', User::class . ':create')->add($logged); //só pra teste, remover depois
$app->get('/posts', User::class . ':create')->add($logged);
