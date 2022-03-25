<?php

require_once __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar livro');

use \App\Entity\Livro;
use \App\Session\Login;

// OBRIGA O USUÁRIO A LOGAR COM SUA CONTA
Login::requireLogin();

// VALIDAÇÃO DO ID 
if(!isset($_GET['id']) or !is_numeric($_GET['id'])) 
{
    header('location: index.php?status=error');
    exit;
}

// CONSULTA O LIVRO 
$obLivro = Livro::getLivro($_GET['id']);

// VALIDAÇÃO DO LIVRO
if(!$obLivro instanceof Livro)
{
    header('location: index.php?status=error');
    exit;
}

// VALIDAÇÃO DO POST 
if(isset(
    $_POST['codigo'], 
    $_POST['titulo'], 
    $_POST['autor'],
    $_POST['sinopse'],  
    $_POST['ativo'], 
    $_POST['isbn'], 
    $_POST['valor'], 
    ))
{
    $obLivro->codigo      = $_POST['codigo'];
    $obLivro->titulo      = $_POST['titulo'];
    $obLivro->autor       = $_POST['autor'];
    $obLivro->sinopse     = $_POST['sinopse'];
    $obLivro->ativo       = $_POST['ativo'];
    $obLivro->isbn        = $_POST['isbn'];
    $obLivro->valor       = $_POST['valor'];
    $obLivro->atualizar();
    
    header('location: index.php?status=success');
    exit; # <-- impede que o script continue. 
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario.php';
include __DIR__.'/Includes/footer.php';
/*  echo "<pre>" ; print_r(); echo "</pre>"; exit; */
