<?php

use \App\Session\Login;

// DADOS DO USUÁRIO
$usuarioLogado = Login::getUsuarioLogado();

// DETALHES DO USUÁRIO
$usuario = $usuarioLogado ?
$usuarioLogado['nome']. '<a href="logout.php" class="text-light align-items-end mx-3">Sair</a>' : 
                                  'Visitante <a href="logout.php" class="text-light mx-3">Entrar</a>';           
?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Dev Vagas</title>
  </head>
  <body class="bg-dark text-light">
      <div class="container">
          <div class="jumbotron my-4">
              <h1 class="">Dev Vagas</h1>
              <p class="">Estudo de CRUD com PHP orientado a objetos</p>
              <hr class="border-light my-2">
              <div class="d-flex justify-content-end"><?=$usuario?></div>
          </div>

    

    
 