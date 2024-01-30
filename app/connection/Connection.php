<?php

namespace app\connection;

use PDO;

class Connection
{
    private static $pdo = null;
    public static function connection()
    {
        if (static::$pdo) {
            return static::$pdo;
        }

        try {
            $str_conn = 'mysql:host=localhost;dbname=rte';
            static::$pdo = new PDO($str_conn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ]);
            return static::$pdo;
        } catch (\PDOException $e) {
            echo 'Erro: '.$e->getMessage();
        }
    }
}
