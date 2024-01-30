<?php

namespace app\controller;

use app\model\Pessoa as Pessoa;

require_once '../model/Pessoa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (isset($data['pessoas']) && is_array($data['pessoas'])) {
        foreach ($data['pessoas'] as $pessoaData) {
            $pessoa = new Pessoa();
            $pessoa->setNome($pessoaData['nome']);
            $pessoa->gravar();
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
    }
}
