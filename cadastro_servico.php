<?php

require_once "./App/DB/Database.php";
require_once "./App/Classes/Servico.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();

    $servico = new Servico($database->conn);
    $servico->nome = $_POST['nome_servico'];

    $res_servico = $servico->cadastrar();
    if ($res_servico) {
        echo "<script>
            alert('Serviço cadastrado com sucesso!');
            window.location.href = './listas.php';
        </script>";
    } else {
        echo "<script>alert('Erro ao cadastrar Serviço!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Serviços</title>
</head>
<body>
    <nav class="barra_de_navegacao">
        <div class="titulo_principal">
            <h1> Crud atendimento </h1>
            <button><a href="./index.php">Voltar</a></button>
        </div>
    </nav>

    <div class="cadastro_de_servicos">
        <div class="area_cadastros">
            <h2>Cadastro de Serviços</h2>
            <form method="post">
                <div>
                    <label for="nome_servico">Nome:</label>
                    <input type="text" name="nome_servico" id="nome_servico" placeholder="Digite nome do serviço...">
                </div>
                <div>
                    <button type="submit" name="cadastrar">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>