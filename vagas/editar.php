<?php

require_once __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

// OBRIGA O USUÁRIO A LOGAR COM SUA CONTA
Login::requireLogin();

// VALIDAÇÃO DO ID 
if(!isset($_GET['id']) or !is_numeric($_GET['id'])) 
{
    header('location: index.php?status=error');
    exit;
}

// CONSULTA A VAGA 
$obVaga = Vaga::getVaga($_GET['id']);

// VALIDAÇÃO DA VAGA
if(!$obVaga instanceof Vaga)
{
    header('location: index.php?status=error');
    exit;
}

// VALIDAÇÃO DO POST 
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'] ))
{
    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];
    $obVaga->atualizar();
    
    header('location: index.php?status=success');
    exit; # <-- impede que o script continue. 
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario.php';
include __DIR__.'/Includes/footer.php';
/*  echo "<pre>" ; print_r(); echo "</pre>"; exit; */
