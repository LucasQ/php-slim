<?php

namespace App\Models\MySQL\GerenciadorLojas;

final class TokenModel
{
    private int $id;
    private int $usuarios_id;
    private string $token;
    private string $refresh_token;
    private string $expired_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsuarios_id(): int
    {
        return $this->usuarios_id;
    }

    public function setUsuarios_id($usuarios_id): TokenModel
    {
        $this->usuarios_id = $usuarios_id;

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken($token): TokenModel
    {
        $this->token = $token;

        return $this;
    }

    public function getRefresh_token(): string
    {
        return $this->refresh_token;
    }

    public function setRefresh_token($refresh_token): TokenModel
    {
        $this->refresh_token = $refresh_token;

        return $this;
    }

    public function getExpired_at(): string
    {
        return $this->expired_at;
    }

    public function setExpired_at($expired_at): TokenModel
    {
        $this->expired_at = $expired_at;

        return $this;
    }
}