<?php

namespace app\controller;

use app\model\Pessoa as Pessoa;
use app\model\Filho as Filho;

require_once '../model/Pessoa.php';
require_once '../model/Filho.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (isset($data['pessoas']) && is_array($data['pessoas'])) {
        foreach ($data['pessoas'] as $pessoa_data) {
            $pessoa = new Pessoa();
            $pessoa->setNome($pessoa_data['nome']);
            $pessoa->gravar();

            if ($pessoa->gravar()) {
                if (isset($pessoa_data['filhos'])) {
                    foreach ($pessoa_data['filhos'] as $filho_data) {
                        $filho = new Filho();
                        $filho->setNome($filho_data);
                        $filho->setIdPessoa($pessoa->getId()); 
                        $filho->gravar();
                    }
                }
            }
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
    }
}
