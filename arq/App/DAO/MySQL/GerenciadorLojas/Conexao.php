<?php

namespace App\DAO\MySQL\GerenciadorLojas;

abstract class Conexao
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = getenv('GERENCIADOR_LOJAS_MYSQL_HOST');
        $port = getenv('GERENCIADOR_LOJAS_MYSQL_PORT');
        $user = getenv('GERENCIADOR_LOJAS_MYSQL_USER');
        $pass = getenv('GERENCIADOR_LOJAS_MYSQL_PASSWORD');
        $dbname = getenv('GERENCIADOR_LOJAS_MYSQL_DBNAME');

        $dns = "mysql:host={$host};dbname={$dbname};port={$port}";

        $this->pdo = new \PDO($dns, $user, $pass);

        // lançar exceções em caso de erro
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}
