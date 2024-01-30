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
            $pdo = Connection::connection();

            $stmt = $pdo->prepare('INSERT INTO pessoa (nome) VALUES (:nome)');

            $stmt->bindParam(':nome', $this->nome);

            $stmt->execute();

            $this->id = $pdo->lastInsertId();

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

            $stmt = $pdo->query('SELECT * FROM pessoa');
            $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $pessoas;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return [];
        }
    }

    public function limparTabela()
    {
        try {
            $pdo = Connection::connection();
            $pdo->exec('DELETE FROM pessoa');

            $pdo->exec('ALTER TABLE pessoa AUTO_INCREMENT = 1');

            return true;
        } catch (\PDOException $e) {
            echo 'Erro' . $e->getMessage();
            return false;
        }
    }
}
