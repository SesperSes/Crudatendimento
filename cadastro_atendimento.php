<?php

require_once "./App/DB/Database.php";
require_once "./App/Classes/Servico.php";
require_once "./App/Classes/Atendimento.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();

    $atendimento = new Atendimento($database->conn);
    $atendimento->cpf = $_POST['cpf'];
    $atendimento->id_servico = $_POST['servico'];

    $res_atendimento = $atendimento->cadastrar();
    if ($res_atendimento) {
        echo "<script>
            alert('Atendimento cadastrado com sucesso!');
            window.location.href = './listas.php';
        </script>";
    } else {
        echo "<script>alert('Erro ao cadastrar Atendimento!');</script>";
    }
}


$database = new Database();
$query = "SELECT id_servico, nome_servico FROM servicos";
$stmt = $database->conn->query($query);
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Atendimentos</title>
</head>
<body>
    <nav class="barra_de_navegacao">
        <div class="titulo_principal">
            <h1>Crud atendimento</h1>
            <button><a href="./index.php">Voltar</a></button>
        </div>
    </nav>

    <div class="cadastro_de_atendimentos">
        <div class="area_cadastros">
            <h2>Cadastro de Atendimentos</h2>
            <form method="post">
                <div>
                    <label for="cpf">Cpf do cliente:</label>
                    <input type="text" name="cpf" id="cpf" placeholder="Digite o cpf do cliente...">
                </div>
                <div>
                    <label for="selecao_de_servico">Selecione o Serviço:</label>
                    <select class="form_select" name="servico">
                      <option selected>Selecione um Serviço</option>
                      <?php foreach ($servicos as $servico): ?>
                          <option value="<?= $servico['id_servico']; ?>"><?= $servico['nome_servico']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <button type="submit" name="cadastrar">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

