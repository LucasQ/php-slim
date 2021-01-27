<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "vendor/autoload.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);

$app = new \Slim\App($c);

$middleware01 = function (Request $req, Response $res, $next) {
    $res->getBody()->write("DENTRO DO MIDDLEWARE 01<br>");
    $res = $next($req, $res);
    $res->getBody()->write("<br>DENTRO DO MIDDLEWARE 02");

    return $res;
};

$app->get('/produtos[/{nome}]', function (Request $req, Response $res, array $args) {
    $limit = $req->getQueryParams()['limit'] ?? 0;
    // $limit = $_GET['limit'];

    $nome = $args['nome'] ?? "não identificado";

    return $res->getBody()->write("{$limit} {$nome}");
})->add($middleware01);

//agrupando endpoints com middleware
// $app->group('/produtos', function () use ($app) {
//     $app->get('/', null);
//     $app->get('/asdaw', null);
// })->add($middleware01);

$app->run();
