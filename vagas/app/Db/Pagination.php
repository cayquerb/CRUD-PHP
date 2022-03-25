<?php

namespace App\Db;

class Pagination
{
    // LIMITE DE CADASTROS POR PÁGINA
    private $limit;

    // QUANTIDADE TOTAL DE RESULTADOS DO BANCO
    private $results;

    // QUANTIDADE DE PÁGINAS
    private $pages;

    //PÁGINA ATUAL
    private $currentPage;


    public function __construct($results, $currentPage = 1, $limit = 10) # <-- Valida a quantida de paginas e se o limite delas é maior que 0.
    {
        $this->results     = $results;
        $this->limit       = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1; 
        $this->calculate();
    }

       private  function calculate()
    {
         // CALCULA O NUMERO DE PÁGINAS
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

         // VERIFICAÇÃO SE A PÁGINA ATUAL NÃO EXECEDE O LIMITE DEFINIDO
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    // RETORNA A CLÁUSULA LIMITE DA SQL
    public function getLimit()
    {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset. ',' .$this->limit;
    }

    // RETORNA AS OPÇÕES DE PÁGINAS DISPONIVEIS
    public function getPages()
    {
        // NÃO RETORNA PÁGINA
        if($this->pages === 1) 
        return [];

        // PÁGINAS
        $paginas = [];
        for ($i=1; $i <= $this->pages ; $i++) { 
            $paginas[] = [
                'pagina' => $i,
                'atual'  => $i == $this->currentPage
            ];
        }
        return $paginas;
    }
}

