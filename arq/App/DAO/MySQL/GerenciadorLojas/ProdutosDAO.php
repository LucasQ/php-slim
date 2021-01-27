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
}
