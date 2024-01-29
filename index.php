<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste RTE</title>
</head>
<body>
    <div>
        <button>Gravar</button>
        <button>Ler</button>
    </div>

    <div>
        <label for="nome">Nome</label>
        <input type="text" id="nome" />
        <button>Incluir</button>
    </div>

    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="5">Pessoas</th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
    </div>

    <div>
        <button onclick="adicionarFilho()">Adicionar Filhos</button>
        <ul id="filhos"></ul>
    </div>

    <div>
        <pre id="jsonOutput"></pre>
    </div>

    <script src="script.js"></script>
</body>
</html>
