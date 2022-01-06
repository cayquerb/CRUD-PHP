<?php

namespace App\Entity;

use App\Db\Database;

use \PDO;

class Vaga
{
 // IDENTIFICADOR UNICO DA VAGA (int)
 public $id;
 
 // TITULO DA VAGA (string)
 public $titulo;

 // DESCRIÇÃO DA VAGA (pode conter HTML) (string)
 public $descricao;

 // STATUS DA VAGA (string Y/N) 
 public $ativo;

 // DATA DA PUBLICAÇÃO DA VAGA (string) 
 public $data;

 // CADASTRA UMA NOVA VAGA (boolean) 
 public function cadastrar()
 {
    // DEFINE A VAGA
    $this->data = date('Y-m-d H:i:s');

    // INSERE A VAGA NO BANCO DE DADOS
    $obDatabase = new Database('vagas');

    $this->id = $obDatabase->insert([
      'titulo'    => $this->titulo,
      'descricao' => $this->descricao,
      'ativo'     => $this->ativo,
      'data'      => $this->data
    ]);

    // SUCESSO
    return true;
 }

 // ATUALIZA VAGA NO BANCO DE DADOS 
 public function atualizar()
 {
   return (new Database('vagas'))->update(' id = '.$this->id,[
     'titulo'    => $this->titulo,
     'descricao' => $this->descricao,
     'ativo'     => $this->ativo,
     'data'      => $this->data
   ]);
 }

 public function excluir()
 { 
   return (new Database('vagas'))->delete(' id = '.$this->id);
 }

 // OBTÉM AS VAGAS DO BANCO DE DADOS
 public static function getVagas($where = null, $order = null, $limit = null)
 {
    return (new Database('vagas'))->select($where, $order, $limit) 
                                  ->fetchAll(PDO::FETCH_CLASS, self::class); # <--Essa método do PDO(FETCH_CLASS) permite que todo retorno seja tranformado em um array.
 }

  // OBTÉM A QUANTIDADE DE VAGAS NO BANCO DE DADOS
 public static function getQuantidadeVagas($where = null)
 {
    return (new Database('vagas'))->select($where, null, null, 'COUNT(*) as qtd') 
                                  ->fetchObject()
                                  ->qtd; # <--Essa método permite retornar os objetos de um array. 
 }

 // BUSCA VAGA PELO ID
 public static function getVaga($id)
 {
   return (new Database('vagas'))->select(' id = '.$id)
                                 ->fetchObject(self::class);                          
 }
};
/* echo "<pre>" ; print_r(); echo "</pre>"; exit; */
