<?php

namespace App\Models\MySQL\GerenciadorLojas;

final class LojaModel
{
    private int $id;
    private string $nome;
    private string $telefone;
    private string $endereco;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id): LojaModel
    {
        $this->id = $id;
        
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome(string $nome): LojaModel
    {
        $this->nome = $nome;
        
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): LojaModel
    {
        $this->telefone = $telefone;

        return $this;
    }


    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): LojaModel
    {
        $this->endereco = $endereco;

        return $this;
    }
}
