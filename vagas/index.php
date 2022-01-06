<?php
/* A pasta composer.json é responsável por configurar as classes dentro do projeto.
   Usado apenas para configurar o autoload. */

require_once __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Db\Pagination;
use \App\Session\Login;

// OBRIGA O USUÁRIO A LOGAR COM SUA CONTA
Login::requireLogin();

// BUSCA 
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING); # <-- Método responsavel por validar as pesquisas, impede sql injection atraves do  FILTER_SANITIZE_STRING.

// FILTRO DE STATUS
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING); # <-- Faz a validação do status.
$filtroStatus = in_array($filtroStatus, ['Y','N']) ? $filtroStatus : '';   # <-- Retorna somente true ou false, impedindo injetar outros valores.


// CONDIÇÕES SQL 
$condicoes = [
   strlen($busca) ? 'titulo LIKE "%'.str_replace(' ', '%', $busca).'%" ' : null, # <-- Variavel de busca, onde ele procura o valor.
   strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'" ' : null                 # <-- % significa que pode haver qualquer palavra antes ou depois da variavel.
];

// REMOVE POSIÇÕES VAZIAS
$condicoes = array_filter($condicoes);

// CLÁUSULA WHERE  
$where = implode(' AND ',$condicoes); # <-- O função implode pode transformar arrays em strings. 
                                      # <-- AND é o operador dos arrays, ele vai definir as conexões das buscas.

// QUANTIDADE TOTAL DE VAGAS
$quantidadeVagas = Vaga::getQuantidadeVagas($where);

// PAGINAÇÃO
$obPagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);

// OBTÉM AS VAGAS
$vagas = Vaga::getVagas($where, null, $obPagination->getLimit());

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/listagem.php';
include __DIR__.'/Includes/footer.php'; 
/* echo "<pre>" ; print_r(); echo "</pre>"; exit; */