<?php

namespace app\model;

use app\connection\Connection;
use PDO;

require_once '../connection/Connection.php';

class Filho
{
    public $id;

    public $pessoa_id;

    public $nome;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getIdPessoa()
    {
        return $this->pessoa_id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setIdPessoa($pessoa_id)
    {
        $this->pessoa_id = $pessoa_id;
    }

    public function gravar()
    {
        try {
            $pdo = Connection::connection();

            $stmt = $pdo->prepare('INSERT INTO filho (pessoa_id, nome) VALUES (:pessoa_id, :nome)');

            $stmt->bindParam(':pessoa_id', $this->pessoa_id);
            $stmt->bindParam(':nome', $this->nome);

            $stmt->execute();

            $this->id = $pdo->lastInsertId();

            return true;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function lerPorPessoaId($pessoa_id)
    {
        try {
            $pdo = Connection::connection();

            $stmt = $pdo->prepare('SELECT * FROM filho WHERE pessoa_id = :pessoa_id');
            $stmt->bindParam(':pessoa_id', $pessoa_id, PDO::PARAM_INT);
    
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return [];
        }
    }

    public function limparTabela()
    {
        try {
            $pdo = Connection::connection();
            $pdo->exec('DELETE FROM filho');

            $pdo->exec('ALTER TABLE filho AUTO_INCREMENT = 1');

            return true;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
}
