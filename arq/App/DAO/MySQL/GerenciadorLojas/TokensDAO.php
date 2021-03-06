<?php

namespace App\DAO\MySQL\GerenciadorLojas;

use App\Models\MySQL\GerenciadorLojas\TokenModel;

class TokensDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createToken(TokenModel $token)
    {
        $statement = $this->pdo->prepare('INSERT INTO tokens(token, refresh_token, expired_at, usuarios_id)
            VALUES (:token, :refresh_token, :expired_at, :usuarios_id);');

        $statement->execute([
            'token' => $token->getToken(),
            'refresh_token' => $token->getRefresh_token(),
            'expired_at' => $token->getExpired_at(),
            'usuarios_id' => $token->getUsuarios_id()
        ]);
    }

    public function verifyRefreshToken(string $refreshToken): bool
    {
        $statement = $this->pdo->prepare('SELECT id FROM tokens
            WHERE refresh_token = :refresh_token;');

        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();

        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return count($tokens) === 0 ? false : true;
    }

    public function inactivateToken(string $refreshToken)
    {
        $statement = $this->pdo->prepare('UPDATE tokens SET active = 0 
            WHERE refresh_token = :refresh_token;');

        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
    }
}
