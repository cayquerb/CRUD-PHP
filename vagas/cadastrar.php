<?php

require_once __DIR__.'/vendor/autoload.php'; 

define('TITLE', 'Cadastrar vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

// OBRIGA O USUÁRIO A LOGAR COM SUA CONTA
Login::requireLogin();

// INSTÂNCIA DE VAGA
$obVaga = new Vaga;

// VALIDAÇÃO DO POST 
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo']))
 {
    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];
    $obVaga->cadastrar();

    header('location: index.php?status=success');
    exit; # <-- impede que o script continue. 
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario.php';
include __DIR__.'/Includes/footer.php';

/*  echo "<pre>" ; print_r(); echo "</pre>"; exit; */
