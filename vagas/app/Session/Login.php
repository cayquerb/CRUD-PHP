<?php

namespace App\Session;

use App\Entity\Usuario;

class Login
{
    // RESPONSAVEL POR INICIAR A SEÇÃO DO USUÁRIO
    private static function init()
    {
        // VERIFICA O STATUS DA SESSÃO
        if (session_status() !== PHP_SESSION_ACTIVE) {
           
            // INICIA A SESSÃO
            session_start();
        }
    }

    // RETORNA OS DADOS DO USUÁRIO LOGADO
    public static function getUsuarioLogado()
    {
        // INICIA A SESSÃO
        self::init();

        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    // RESPONSAVEL POR LOGAR O USUÁRIO
    public static function login($obUsuario)
    {
        // INICIA A SESSÃO
        self::init();

        // SESSÃO DE USUÁRIO 
        $_SESSION['usuario'] = [
            'id'    => $obUsuario->id,
            'nome'  => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        // REDIRECIONA USUÁRIO PARA O INDEX
        header('location: index.php');
        exit;
    }

    // DESLOGA O USUÁRIO
    public static function logout()
    {
        // INICIA A SESSÃO
        self::init();

        // REMOVE SESSÃO DO USUÁRIO
        unset($_SESSION['usuario']);

        // REDIRECIONA PARA O LOGIN INICIAL
        header('location: login.php');
    }

    // RESPONSAVEL POR VERIFICAR SE O CLIENTE ESTA LOGADO
    public static function isLogged()
    {
         // INICIA A SESSÃO
         self::init();

        return isset($_SESSION['usuario']['id']);
    }

    // OBRIGA O USUÁRIO ESTAR LOGADO PARA ACESSAR
    public static function requireLogin()
    {
        if(!self::isLogged()){
            header('location: login.php');
            exit;
        }
    }

    public static function requireLogout()
    {
        if(self::isLogged()){
            header('location: index.php');
            exit;
        }
    }
}