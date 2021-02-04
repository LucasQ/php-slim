<?php

use App\Controllers\{
    AuthController,
    ExceptionController,
    LojaController,
    ProdutoController
};

use function src\jwtAuth;
use function src\slimConfiguration;

$app = new \Slim\App(slimConfiguration());

// $app->get('/', '\app\controllers\LojaController:getLojas'); // same
$app->get('/loja', LojaController::class . ':getLojas'); // ::class retorna uma string com o caminho completo
$app->post('/loja', LojaController::class . ':insertLojas');
$app->put('/loja', LojaController::class . ':updateLojas');
$app->delete('/loja', LojaController::class . ':deleteLojas');

$app->get('/produto', ProdutoController::class . ':getProdutos');
$app->post('/produto', ProdutoController::class . ':insertProdutos');
$app->put('/produto', ProdutoController::class . ':updateProdutos');
$app->delete('/produto', ProdutoController::class . ':deleteProdutos');

$app->post('/login', AuthController::class . ':login');
$app->post('/refresh_token', AuthController::class . ':refreshToken');
$app->get('/teste', function () {
    echo "ok";
})
    ->add(jwtAuth());// 1º middleware - verifica se o token enviado no header está com a chave secreta correta

$app->get('/exception-test', ExceptionController::class . ':test');

$app->run();
