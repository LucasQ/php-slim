<?php

use App\Controllers\LojaController;
use App\Controllers\ProdutoController;

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

$app->run();
