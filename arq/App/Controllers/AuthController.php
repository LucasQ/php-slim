<?php

namespace App\Controllers;

use App\DAO\MySQL\GerenciadorLojas\TokensDAO;
use App\DAO\MySQL\GerenciadorLojas\UsuariosDAO;
use App\Models\MySQL\GerenciadorLojas\TokenModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response as Response;
use Firebase\JWT\JWT;

class AuthController
{
    public function login(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();
        $usuarioDAO = new UsuariosDAO();

        $usuario = $usuarioDAO->getUserByEmail($data['email']);

        if (is_null($usuario)) {
            return $res->withStatus(401);
        }

        if (!password_verify($data['senha'], $usuario->getSenha())) {
            return $res->withStatus(401);
        }

        $expiredAt = (new \DateTime())->modify('+2 days')->format('Y-m-d H:i:s');

        $tokenPayload = [
            'sub' => $usuario->getId(),
            'name' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'exp' => (new \DateTime($expiredAt))->getTimestamp()
            //biblioteca do jwt já verifica se a data está expirada por timestamp (exp)
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

    public function refreshToken(Request $req, Response $res, array $args): Response
    {
        $data = $req->getParsedBody();
        $refreshToken = $data['refresh_token'];
        $tokensDAO = new TokensDAO();

        $tokenDecoded = JWT::decode(
            $refreshToken,
            getenv('JWT_SECRET_KEY'),
            ['HS256']
        );

        $existRefreshToken = $tokensDAO->verifyRefreshToken($refreshToken);

        if (!$existRefreshToken) { // 1º - verifica se o token existe no banco
            return $res->withStatus(401);
        }

        $usuarioDAO = new UsuariosDAO();
        $usuario = $usuarioDAO->getUserByEmail($tokenDecoded->email);

        if (is_null($usuario)) { // 2º - verifica se o usuario existe e pega os dados deles
            return $res->withStatus(401);
        }

        $tokensDAO->inactivateToken($refreshToken);

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
            $tokenDAO->createToken($tokenModel); // 3º - gera o token, o refresh token e salva no banco

            $res = $res->withJson([
                'token' => $token,
                'refresh_token' => $refreshToken
            ]);
            // retorna o toke e o refresh_token
            return $res;
    }
}
