<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require '../vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

require_once '../config/settings.php';

$router = require  '../App/setl.php';


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);
$router->get('/', 'App\Controllers\FrontController::index');
$router->get('/posts', 'App\Controllers\FrontController::showAllPosts');
$router->get('/post/{id}', 'App\Controllers\FrontController::showPost');

$router->get('/login', 'App\Controllers\AuthController::showLoginForm');
$router->post('/login', 'App\Controllers\AuthController::login');
$router->get('/logout', 'App\Controllers\AuthController::logout');

$router->get('/admin', 'App\Controllers\AdminController::index');
$response = $router->dispatch($request);
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);


/*
session_start();

if (!isset($_SESSION['user_email'])) {
header('Location: /templates/partials/login.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Основной сайт</title></head>
<body>

    <?php include_once('templates/partials/navigation.php');?>

    <div class="container">




        <div class="header">

            <?php include_once('templates/partials/header.php');?>
        </div>
        <div class="container">
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        </div>
        <div class="section">
            <?php include_once('templates/partials/sections.php');?>
        </div>
    </div>
    <?php include_once('templates/partials/footer.php');?>
</body>
</html>

-*/