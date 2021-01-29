<?php

namespace App\Controllers;

use App\DAO\MySQL\GerenciadorLojas\TokensDAO;
use App\DAO\MySQL\GerenciadorLojas\UsuariosDAO;
use App\Models\MySQL\GerenciadorLojas\TokenModel;
use DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;
use \Firebase\JWT\JWT;

class AuthController
{
    public function login(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();
        $usuarioDAO = new UsuariosDAO();

        $usuario = $usuarioDAO->getUserByEmail($data['email']);

        if(is_null($usuario))
            return $res->withStatus(401);

        if(!password_verify($data['senha'], $usuario->getSenha()))
            return $res->withStatus(401);

        $expiredAt = (new \DateTime())->modify('+2 days')->format('Y-m-d H:i:s');

        $tokenPayload = [
            'sub' => $usuario->getId(),
            'name' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'expired_at' => $expiredAt
        ];
        $refreshTokenPayload = [
            'email' => $usuario->getEmail()
        ];
        
        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setToken($token)
            ->setRefresh_token($refreshToken)
            ->setExpired_at($expiredAt)
            ->setUsuarios_id($usuario->getId());

        $tokenDAO = new TokensDAO();
        $tokenDAO->createToken($tokenModel);

        $res = $res->withJson([
            'token' => $token,
            'refresh_token' => $refreshToken
        ]);

        return $res;
    }
}