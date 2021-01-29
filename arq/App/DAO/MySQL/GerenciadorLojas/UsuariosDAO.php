<?php

namespace App\DAO\MySQL\GerenciadorLojas;

use App\Models\MySQL\GerenciadorLojas\UsuarioModel;

class UsuariosDAO extends Conexao
{
    public function __construct()
    {
        //como o construtor só é chamado ao instaciar uma classe e Conexao é abstract, tem que chamar assim:
        parent::__construct();
    }

    public function getUserByEmail(string $email): ?UsuarioModel
    {
        $statement = $this->pdo->prepare('SELECT id, nome, email, senha FROM usuarios
            WHERE email = :email;');
        
        $statement->bindParam('email', $email);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if(count($usuarios) !== 0 ) {
            $usuario = new UsuarioModel();
            $usuario->setId($usuarios[0]['id'])
                ->setEmail($usuarios[0]['email'])
                ->setNome($usuarios[0]['nome'])
                ->setSenha($usuarios[0]['senha']);

            return $usuario;
        } else {
            return null;
        }
    }
}