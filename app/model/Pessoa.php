<?php

namespace app\model;

use app\connection\Connection;
use PDO;

require_once '../connection/Connection.php';

class Pessoa
{
    public $id;

    public $nome;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function gravar()
    {
        try {
            $conn = Connection::connection();

            $stmt = $conn->prepare('INSERT INTO pessoa (nome) VALUES (:nome)');

            $stmt->bindParam(':nome', $this->nome);

            $stmt->execute();

            $this->id = $conn->lastInsertId();

            return true;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
}
