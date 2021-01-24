<?php

// GITHUB COMMITS https://github.com/codeeasy-dev/apis-rest-com-php-7-e-slim-framework/commits/master

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "vendor/autoload.php";

$app = new \Slim\App();

$app->get('/produtos[/{nome}]', function (Request $req, Response $res, array $args) {
    $limit = $req->getQueryParams()['limit'] ?? 0;
    // $limit = $_GET['limit'];

    $nome = $args['nome'] ?? "não identificado";

    return $res->getBody()->write("{$limit} {$nome}");
});

$app->post('/produto', function (Request $req, Response $res, array $args) {
    $data = $req->getParsedBody();
    $nome = $data['nome'] ?? "não identificado";

    return $res->getBody()->write("Produto {$nome}");
});

$app->put('/produto', function (Request $req, Response $res, array $args) {
    $data = $req->getParsedBody();
    $nome = $data['nome'] ?? "não identificado";

    return $res->getBody()->write("Produto {$nome}");
});

$app->delete('/produto', function (Request $req, Response $res, array $args) {
    $data = $req->getParsedBody();
    $nome = $data['nome'] ?? "não identificado";

    return $res->getBody()->write("Produto {$nome}");
});

$app->run();
