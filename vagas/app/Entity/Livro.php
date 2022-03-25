<?php

namespace App\Entity;

use App\Db\Database;

use \PDO;

class Livro
{
 // IDENTIFICADOR UNICO DO LIVRO (int)
 public $id;
 
 // CÓDIGO DO LIVRO
 public $codigo;

 // TITULO DO LIVRO (string)
 public $titulo;

 // AUTOR DO LIVRO (string)
 public $autor;

 // DESCRIÇÃO DO LIVRO (pode conter HTML) (string)
 public $sinopse;

 // CAPA DO LIVRO 
 public $ativo;

 // CÓDIGO ISBN DO LIVRO
 public $isbn;

 // VALOR DO LIVRO
 public $valor;

 // DATA DA PUBLICAÇÃO DO LIVRO (string) 
 public $data;

 // CADASTRA UM NOVO LIVRO (boolean) 
 public function cadastrar()
 {
    // DEFINE A DATA
    $this->data = date('Y-m-d H:i:s');

    // INSERE UM LIVRO NO BANCO DE DADOS
    $obDatabase = new Database('storeBook');

    $this->id = $obDatabase->insert([
      'codigo'    => $this->codigo,
      'titulo'    => $this->titulo,
      'autor'     => $this->autor,
      'sinopse'   => $this->sinopse,
      'ativo'     => $this->ativo,
      'isbn'      => $this->isbn,
      'valor'     => $this->valor,
    ]);

    // SUCESSO
    return true;
 }

 // ATUALIZA O LIVRO NO BANCO DE DADOS 
 public function atualizar()
 {
   return (new Database('storeBook'))->update(' id = '.$this->id,[
    'codigo'    => $this->codigo,
    'titulo'    => $this->titulo,
    'autor'     => $this->autor,
    'sinopse'   => $this->sinopse,
    'ativo'     => $this->ativo,
    'isbn'      => $this->isbn,
    'valor'     => $this->valor,
   ]);
  
 }

 public function excluir()
 { 
   return (new Database('storeBook'))->delete(' id = '.$this->id);
 }

 // OBTÉM OS LIVROS DO BANCO DE DADOS
 public static function getLivros($where = null, $order = null, $limit = null)
 {
    return (new Database('storeBook'))->select($where, $order, $limit) 
                                  ->fetchAll(PDO::FETCH_CLASS, self::class); # <--Essa método do PDO(FETCH_CLASS) permite que todo retorno seja tranformado em um array.
 }

  // OBTÉM A QUANTIDADE DE LIVROS NO BANCO DE DADOS
 public static function getQuantidadeLivros($where = null)
 {
    return (new Database('storeBook'))->select($where, null, null, 'COUNT(*) as qtd') 
                                  ->fetchObject()
                                  ->qtd; # <--Essa método permite retornar os objetos de um array. 
 }

 // BUSCA LIVRO PELO ID
 public static function getLivro($id)
 {
   return (new Database('storeBook'))->select(' id = '.$id)
                                 ->fetchObject(self::class);                          
 }
};
/* echo "<pre>" ; print_r(); echo "</pre>"; exit; */
