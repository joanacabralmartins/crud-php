let pessoas = [];

function adicionarPessoa() {
    const nomeInput = document.getElementById('nome');
    const nome = nomeInput.value.trim();

    if (nome !== '') {
        const pessoa = { nome: nome, filhos: [] };

        pessoas.push(pessoa);

        atualizarTabelaPessoas();
        atualizarDadosJSON();

        nomeInput.value = '';
    }
}

function atualizarTabelaPessoas() {
    const tbody = document.getElementById('tbody');
    tbody.innerHTML = ''; 

    pessoas.forEach((pessoa, index) => {
        const row = `<tr>
                <td>${pessoa.nome}
                <button class="btn btn-info" onclick="adicionarFilho(${index})">Adicionar Filho</button>
                </td>
            </tr>`;
        tbody.innerHTML += row;
    });
}

function atualizarDadosJSON() {
    const jsonOutput = document.getElementById('jsonOutput');
    const jsonObj = { pessoas };
    
    jsonOutput.textContent = JSON.stringify(jsonObj, null, 2);
}

function adicionarFilho(index) {
    const nomeFilho = prompt('Digite o nome do filho:');
    const pessoaSelecionada = pessoas[index];

    if (nomeFilho !== '' && pessoaSelecionada) {
        pessoaSelecionada.filhos.push(nomeFilho);

        atualizarDadosJSON();
    }
}

$(document).ready(function () {
    $('#btnGravar').on('click', function () {
        const jsonData = JSON.stringify({ pessoas: pessoas });
        console.log(jsonData); // Adicione esta linha para imprimir no console
        $.ajax({
            url: 'app/controller/Controller.php',
            method: 'POST',
            data: jsonData,
            contentType: 'application/json', // Adicione esta linha para indicar o tipo de conteúdo
            dataType: 'json',
            success: function (result) {
                alert('Dados gravados com sucesso!');
            },
            error: function () {
                alert('Erro ao gravar os dados.');
            }
        });
    });
});