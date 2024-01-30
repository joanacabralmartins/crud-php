<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Teste RTE</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <button id="btnGravar" class="btn btn-primary mr-2">Gravar</button>
                <button id="btnLer" class="btn btn-secondary">Ler</button>

                <div class="mt-2">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome">
                    <button class="btn btn-success" onclick="adicionarPessoa()">Incluir</button>
                </div>

                <div class="mt-4">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Pessoas</th>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <pre id="jsonOutput">{
    "pessoas": [] 
}
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>
