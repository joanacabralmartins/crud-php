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
        $pessoa = new Pessoa();
        $filho = new Filho();

        $pessoa->limparTabela();
        $filho->limparTabela();
        
        foreach ($data['pessoas'] as $pessoa_data) {
            $pessoa->setNome($pessoa_data['nome']);

            if ($pessoa->gravar()) {
                if (isset($pessoa_data['filhos'])) {
                    foreach ($pessoa_data['filhos'] as $filho_data) {
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

} elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
    $pessoa = new Pessoa();
    $pessoas_array = $pessoa->ler();

    $data = [];

    foreach ($pessoas_array as $pessoa) {
        $pessoa_data = [
            'nome' => $pessoa['nome'],
            'filhos' => [],
        ];
    
        $filho = new Filho();
        $filhos_array = $filho->lerPorPessoaId($pessoa['id']); 
    
        foreach ($filhos_array as $filho) {
            $pessoa_data['filhos'][] = $filho['nome'];
        }
    
        $data['pessoas'][] = $pessoa_data;
    }

    echo json_encode($data);
}
