<?php

namespace App\DAO\MySQL\GerenciadorLojas;

use App\Models\MySQL\GerenciadorLojas\LojaModel;

class LojasDAO extends Conexao
{
    public function __construct()
    {
        //como o construtor só é chamado ao instaciar uma classe e Conexao é abstract, tem que chamar assim:
        parent::__construct();
    }

    public function getAllLojas(): array
    {
        $lojas = $this->pdo->query('SELECT * FROM lojas;')->fetchAll(\PDO::FETCH_ASSOC);
        return $lojas;
    }

    public function insertLoja(LojaModel $loja): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO lojas VALUES(null, :nome, :telefone, :endereco);');

        $statement->execute([
            'nome' => $loja->getNome(),
            'telefone' => $loja->getTelefone(),
            'endereco' => $loja->getEndereco()
        ]);
    }

    public function updateLoja(LojaModel $loja)
    {
        $statement = $this->pdo
        ->prepare('UPDATE lojas
                    SET nome = :nome, telefone = :telefone, endereco = :endereco
                    WHERE id = :id;');

        $statement->execute([
            'nome' => $loja->getNome(),
            'telefone' => $loja->getTelefone(),
            'endereco' => $loja->getEndereco(),
            'id' => $loja->getId()
        ]); 
    }

    public function deleteLoja(int $id)
    {
        $statement = $this->pdo
        ->prepare('DELETE FROM lojas
                    WHERE id = :id;');

        $statement->execute([
            'id' => $id
        ]); 
    }
}