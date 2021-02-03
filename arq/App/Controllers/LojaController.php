<?php

namespace App\Controllers;

use App\DAO\MySQL\GerenciadorLojas\LojasDAO;
use App\Models\MySQL\GerenciadorLojas\LojaModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response as Response;

class LojaController
{
    public function getLojas(Request $req, Response $res, array $args): Response
    {
        $lojasDAO = new LojasDAO();

        $lojas = $lojasDAO->getAllLojas();
        $res = $res->withJson($lojas);

        return $res;
    }

    public function insertLojas(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $lojasDAO = new LojasDAO();
        $loja = new LojaModel();

        $loja->setNome($data['nome'])
            ->setEndereco($data['endereco'])
            ->setTelefone($data['telefone']);

        $lojasDAO->insertLoja($loja);

        $res = $res->withJson([
            'message' => 'Loja inserida com sucesso!'
        ]);

        return $res;
    }

    public function updateLojas(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $lojasDAO = new LojasDAO();
        $loja = new LojaModel();

        $loja->setNome($data['nome'])
        ->setEndereco($data['endereco'])
        ->setTelefone($data['telefone'])
        ->setId($data['id']);

        $lojasDAO->updateLoja($loja);

        $res = $res->withJson([
            'message' => "Loja {$loja->getNome()} alterada com sucesso!"
        ]);

        return $res;
    }

    public function deleteLojas(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $lojasDAO = new LojasDAO();

        $lojasDAO->deleteLoja($data['id']);

        $res = $res->withJson([
            'message' => "Loja id={$data['id']} excluida com sucesso"
        ]);

        return $res;
    }
}
