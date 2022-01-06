<?php

require_once __DIR__.'/vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Usuario;

// OBRIGA O USUÁRIO A NÃO ESTAR LOGADO COM SUA CONTA
Login::requireLogout();

// ALERTA DOS USUÁRIOS
$alertaLogin = '';
$alertaCadastro = '';

// VALIDAÇÃO DO POST
if(isset($_POST['acao']))
{
    switch ($_POST['acao']) 
    {
        case 'logar':

            // BUSCA USUÁRIO POR E-MAIL
            $obUsuario = Usuario::getUsuarioEmail($_POST['email']);
            if (!$obUsuario instanceOf Usuario || !password_verify($_POST['senha'], $obUsuario->senha)) 
            {
                // VALIDA INTÂNCIA E A SENHA
                $alertaLogin = 'E-mail ou senha inválidos';
                break;
            }

            // LOGA O USUÁRIO 
            Login::login($obUsuario);

            break;
        
        case 'cadastrar':

            // VALIDAÇÃO DE CAMPOS OBRIGATÓRIOS
            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])) 
            {
                // BUSCA POR E-MAIL
                $obUsuario = Usuario::getUsuarioEmail($_POST['email']);

                if($obUsuario instanceof Usuario)
                {
                    $alertaCadastro = 'O E-mail digitado já é utilizado por outro usuário';
                    break;
                }

                // NOVO USUÁRIO
                $obUsuario = new Usuario;
                $obUsuario->nome  = $_POST['nome'] ;
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); # <-- Permiter criptografar a senha com uma hash aliatória
                $obUsuario->cadastrar();

                // LOGA O USUÁRIO 
                Login::login($obUsuario);
            }

        break;
    }
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario-login.php';
include __DIR__.'/Includes/footer.php';
/*  echo "<pre>" ; print_r(); echo "</pre>"; exit; */
