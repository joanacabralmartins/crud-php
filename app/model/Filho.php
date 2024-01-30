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
            $conn = Connection::connection();

            $stmt = $conn->prepare('INSERT INTO filho (pessoa_id, nome) VALUES (:pessoa_id, :nome)');

            $stmt->bindParam(':pessoa_id', $this->pessoa_id);
            $stmt->bindParam(':nome', $this->nome);

            $stmt->execute();

            $this->id = $conn->lastInsertId();

            return true;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function ler()
    {
        try {
            $pdo = Connection::connection();

            $stmt = $pdo->query('SELECT * FROM filho');
            $filhos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $filhos;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return [];
        }
    }
}
