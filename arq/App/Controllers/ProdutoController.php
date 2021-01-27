<?php

namespace App\Controllers;

use App\DAO\MySQL\GerenciadorLojas\ProdutosDAO;
use App\Models\MySQL\GerenciadorLojas\ProdutoModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

class ProdutoController
{
    public function getProdutos(Request $req, Response $res, array $args): Response
    {
        $produtosDAO = new ProdutosDAO();
        $produtos = $produtosDAO->getAllProdutos();
        $res = $res->withJson($produtos);
        return $res;
    }
    public function insertProdutos(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $produtosDAO = new ProdutosDAO();
        $produtoModel = new ProdutoModel();

        $produtoModel->setLoja_id($data['loja_id'])
            ->setNome($data['nome'])
            ->setPreco($data['preco'])
            ->setQuantidade($data['quantidade']);
        
        $produtosDAO->insertProdutos($produtoModel);

        $res = $res->withJson([
            'message' => 'Produto inserido com sucesso!'
        ]);
        
        return $res;
    }

    public function updateProdutos(Request $req, Response $res, array $args): Response
    {
        return $res;
    }

    public function deleteProdutos(Request $req, Response $res, array $args): Response
    {
        return $res;
    }
}
