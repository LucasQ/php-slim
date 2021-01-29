<?php

namespace App\Models\MySQL\GerenciadorLojas;

final class ProdutoModel 
{
    private int $id;
    private int $loja_id;
    private string $nome;
    private float $preco;
    private int $quantidade;  

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): ProdutoModel
    {
        $this->id = $id;

        return $this;
    }

    public function getLoja_id()
    {
        return $this->loja_id;
    }

    public function setLoja_id($loja_id): ProdutoModel
    {
        $this->loja_id = $loja_id;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): ProdutoModel
    {
        $this->nome = $nome;

        return $this;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco): ProdutoModel
    {
        $this->preco = $preco;

        return $this;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade): ProdutoModel
    {
        $this->quantidade = $quantidade;

        return $this;
    }
} 