<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario
{
    public $id;

    public $nome;

    public $email;

    // HASH DA SENHA DO USUÁRIO
    public $senha;


    // RESPONSÁVEL POR CADASTRAR UM NOVO USUÁRIO NO BANCO
    public function cadastrar()
    {
        // DATABASE
        $obDatabase = new Database('usuarios');

        // INSERE UM NOVO USUÁRIO
        $this->id = $obDatabase->insert([
            'nome'  => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
        // SUCESSO
        return true;
    }

    // RETORNA UMA INSTÂNCIA DE USUÁRIO COM BASE EM SEU E-MAIL
    public static function getUsuarioEmail($email)
    {
        return(new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }
}

