<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App;
$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("../src/views/");

$app->get('/', function (Request $request, Response $response) {
    $response = $this->view->render($response, "login/login.phtml");

    return $response;
});

$app->run();
