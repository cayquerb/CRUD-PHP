<?php

namespace App\Db;

use \PDO;

use \PDOException;

class Database
{

    // HOST DE CONEXÃO COM BANCO DE DADOS
    const HOST = '127.0.0.1';

    // NOME DO BANCO DE DADOS
    const NAME = 'dev_vagas';

    // USUÁRIO DO BANCO DE DADOS
    const USER = 'root';

    // NOME DA TABELA A SER MANIPULADA
    private $table;

    // INSTÂNCIA DE CONEXÃO COM O BANCO DE DADOS (PDO) 
    private $connection;

    // DEFINE A TABELA E INSTANCIA DE CONEXÃO 
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    // CRIA CONEXÃO COM BANCO DE DADOS 
    private function setConnection()
    {
        try
        {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,'');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  # <-- Configuração de PDO caso alguma coisa não sai como esperado no momento da conexão com o banco de dados. 
        }catch(PDOException $e)
        {
            die('ERROR: '.$e->getMessage());
        }
    }

    // EXECUTA QUERIES DENTRO DO BANCO DE DADOS
        public function execute($query, $params = [])
    {
        try
        {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e)
        {
            die('ERROR: '.$e->getMessage());
        }
    }

    // INSERE DADOS NO BANCO DE DADOS (array, field => value)
    public function insert($values)
    {   
        // TRATA OS DADOS DA QUERY
        $fields = array_keys($values);

        // DEFINE AUTOMATICAMENTE O NUMERO DE ARRAYS QUE SERÃO UTILIZADOS
        $binds = array_pad([], count($fields),'?'); # <-- Essa função consegue determinar quantas posições uma variavel ou array podem ter, ou criar novas posições com padrões especificados.

        // MONTA A QUERY 
        $query = ' INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')'; # <-- Validação contra sql injection, o PDO faz umas validação para verificar se os dados inseridos são confiáveis.
        
        // EXECUTA O INSERT
        $this->execute($query, array_values($values));

        // RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
      
    }
    // EXECUTA CONSULTA NO BANCO DE DADOS 
    public  function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // DADOS DA QUERY 
        $where = strlen($where) ? ' WHERE '.$where : ''; # <-- Condições ternarias, onde é verificado o valor da variavel.
        $order = strlen($order) ? ' ORDER BY '.$order : '';
        $limit = strlen($limit) ? ' LIMIT '.$limit : '';

        // MONTA A QUERY 
        $query = ' SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        // EXECUTA A QUERY
        return $this->execute($query);
    }

    // EXECUTA ATUALIZAÇÃO DO BANCO DE DADOS 
    public function update($where, $values)
    {   
        // DADOS DA QUERY
        $fields = array_keys($values);

        // MONTA A QUERY
        $query = ' UPDATE '.$this->table.' SET '.implode(' =?,',$fields). ' =? WHERE '.$where;

        // EXECUTA A QUERY
        $this->execute($query, array_values($values));

        // SUCESSO 
        return true;
    }

    public function delete($where)
    {   
        // MONTA A QUERY
        $query = ' DELETE FROM '.$this->table.' WHERE '.$where;

        // EXECUTA A QUERY
        $this->execute($query);

        // SUCESSO 
        return true;
    }
}