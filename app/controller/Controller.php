<?php

namespace app\controller;

use app\model\Pessoa as Pessoa;

require_once '../model/Pessoa.php';

if(isset($_POST['nome'])) {

    $objPessoa = new Pessoa();
    $objPessoa->nome = $_POST['nome'];

    print_r($objPessoa);
}