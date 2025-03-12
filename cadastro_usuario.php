<?php

require_once "./App/DB/Database.php";
require_once "./App/Classes/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();

    $usuario = new Usuario($database->conn);
    $usuario->nome_usuario = $_POST['nome_usuario'];
    $usuario->cpf = $_POST['cpf'];
    $usuario->email = $_POST['email'];

    $res_usuario = $usuario->cadastrar();
    if ($res_usuario) {
        echo "<script>
            alert('Usuário cadastrado com sucesso!');
            window.location.href = './listas.php';
        </script>";
    } else {
        echo "<script>alert('Erro ao cadastrar Usuário!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <nav class="barra_de_navegacao">
        <div class="titulo_principal">
            <h1> Crud atendimento </h1>
            <button><a href="./index.php">Voltar</a></button>
        </div>
    </nav>

    <div class="area_dos_cadastros">
        <div class="cadastro_de_usuarios">
            <div class="area_cadastros">
                <h2>Cadastro de Usuários</h2>
                <form method="post">
                    <div>
                        <label for="nome_usuario">Nome:</label>
                        <input type="text" name="nome_usuario" id="nome_usuario" placeholder="Digite seu nome...">
                    </div>
                    <div>
                        <label for="cpf">Cpf:</label>
                        <input type="text" name="cpf" id="cpf" placeholder="Digite seu cpf...">
                    </div>
                    <div>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu email...">
                    </div>
                    <div>
                        <button type="submit" name="cadastrar">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>