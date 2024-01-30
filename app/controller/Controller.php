<?php

namespace app\controller;

use app\model\Pessoa as Pessoa;

require_once '../model/Pessoa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    
    echo json_encode(['success' => true]);
}