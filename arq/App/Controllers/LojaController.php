<?php

namespace App\Controllers;

use App\DAO\MySQL\GerenciadorLojas\LojasDAO;
use App\Models\MySQL\GerenciadorLojas\LojaModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Container;
use Slim\Http\Response as Response;

class LojaController
{
    private LojasDAO $lojasDAO;

    public function __construct(Container $container)
    {
        // container que tem todas as dependencias da aplicação
        $this->lojasDAO = $container->offsetGet(LojasDAO::class);
    }

    public function getLojas(Request $req, Response $res, array $args): Response
    {
        $lojas = $this->lojasDAO->getAllLojas();

        $res->getBody()->write(
            json_encode(
                $lojas,
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            )
        );

        return $res
            ->withHeader('Content-Type', 'Application/json')
            ->withStatus(200);
    }

    public function insertLojas(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $loja = new LojaModel();

        $loja->setNome($data['nome'])
            ->setEndereco($data['endereco'])
            ->setTelefone($data['telefone']);

        $this->lojasDAO->insertLoja($loja);

        $res = $res->withJson([
            'message' => 'Loja inserida com sucesso!'
        ]);

        return $res;
    }

    public function updateLojas(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $loja = new LojaModel();

        $loja->setNome($data['nome'])
        ->setEndereco($data['endereco'])
        ->setTelefone($data['telefone'])
        ->setId($data['id']);

        $this->lojasDAO->updateLoja($loja);

        $res = $res->withJson([
            'message' => "Loja {$loja->getNome()} alterada com sucesso!"
        ]);

        return $res;
    }

    public function deleteLojas(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();

        $this->lojasDAO->deleteLoja($data['id']);

        $res = $res->withJson([
            'message' => "Loja id={$data['id']} excluida com sucesso"
        ]);

        return $res;
    }
}
