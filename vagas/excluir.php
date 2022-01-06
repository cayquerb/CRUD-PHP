<?php

require_once __DIR__.'/vendor/autoload.php';

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
if(isset($_POST['excluir']))
{
    $obVaga->excluir();
    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/confirmar-exclusao.php';
include __DIR__.'/Includes/footer.php';
