<?php

namespace App\Models\MySQL\GerenciadorLojas;

final class UsuarioModel
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha($senha): self
    {
        $this->senha = $senha;

        return $this;
    }
}
