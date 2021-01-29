<?php

namespace App\DAO\MySQL\GerenciadorLojas;

use App\Models\MySQL\GerenciadorLojas\ProdutoModel;

class ProdutosDAO extends Conexao
{
    public function __construct()
    {
        //como o construtor só é chamado ao instaciar uma classe e Conexao é abstract, tem que chamar assim:
        parent::__construct();
    }

    public function getAllProdutos(): array
    {
        $produtos = $this->pdo->query('SELECT * FROM produtos;')->fetchAll(\PDO::FETCH_ASSOC);
        return $produtos;
    }

    public function insertProdutos(ProdutoModel $produto): void
    {
        $statement = $this->pdo->prepare('INSERT INTO produtos VALUES (null, :loja_id, :nome, :preco, :quantidade);');

        $statement->execute([
            'loja_id' => $produto->getLoja_id(),
            'nome' => $produto->getNome(),
            'preco' => $produto->getPreco(),
            'quantidade' => $produto->getQuantidade()
        ]);
    }

    public function updateProdutos(ProdutoModel $produto)
    {
        $statement = $this->pdo->prepare('UPDATE produtos 
            SET loja_id = :loja_id, nome = :nome,preco = :preco, quantidade = :quantidade
            WHERE id = :id;');

        $statement->execute([
            'loja_id' => $produto->getLoja_id(),
            'nome' => $produto->getNome(),
            'preco' => $produto->getPreco(),
            'quantidade' => $produto->getQuantidade(),
            'id' => $produto->getId()
        ]);
    }

    public function deleteProdutos(int $id) 
    {
        $statement = $this->pdo->prepare('DELETE FROM produtos
            WHERE id = :id;');

        $statement->execute([
            'id' => $id
        ]);
    }
}
