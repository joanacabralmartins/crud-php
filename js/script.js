let pessoas = [];

const botaoIncluir = document.getElementById("btnIncluir");

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
        let row = `
            <tr>
                <td>${pessoa.nome}</td>
                <td>
                    <button class="btn btn-danger" onclick="removerPessoa(${index})">Remover Pessoa</button>
                </td>
            </tr>`;

        if (pessoa.filhos.length > 0) {
            pessoa.filhos.forEach(filho => {
                const filhoRow = `
                    <tr>
                        <td>${filho}</td>
                        <td>
                            <button class="btn btn-danger" onclick="removerFilho(${index}, '${filho}')">Remover Filho</button>
                        </td>
                    </tr>`;
                row += filhoRow;
            });
        }
    
        const adicionarFilho = `
            <tr>
                <td colspan="2">
                    <button class="btn btn-secondary" onclick="adicionarFilho(${index})">Adicionar Filho</button>
                </td>
            </tr>`;
        
        row += adicionarFilho;
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

        atualizarTabelaPessoas();
        atualizarDadosJSON();
    }
}

function removerPessoa(index) {
    pessoas.splice(index, 1);
    atualizarTabelaPessoas();
    atualizarDadosJSON();  
}

function removerFilho(pessoaIndex, filhoNome) {
    const pessoaSelecionada = pessoas[pessoaIndex];
    const filhoIndex = pessoaSelecionada.filhos.indexOf(filhoNome);

    if (filhoIndex !== -1) {
        pessoaSelecionada.filhos.splice(filhoIndex, 1);
        atualizarTabelaPessoas();
        atualizarDadosJSON();
    }
}

$(document).ready(function () {
    $('#btnGravar').on('click', function () {
        const jsonData = JSON.stringify({ pessoas: pessoas });
        console.log(jsonData);
        $.ajax({
            url: 'app/controller/Controller.php',
            method: 'POST',
            data: jsonData,
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

botaoIncluir.addEventListener('click', () => {
    adicionarPessoa();
})