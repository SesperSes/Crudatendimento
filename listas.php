<?php

require_once "./App/DB/Database.php";

$database = new Database();

$query_usuarios = "SELECT id_usuario, nome_usuario, cpf, email FROM usuarios";
$stmt_usuarios = $database->conn->query($query_usuarios);
$usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);

$query_servicos = "SELECT id_servico, nome_servico FROM servicos";
$stmt_servicos = $database->conn->query($query_servicos);
$servicos = $stmt_servicos->fetchAll(PDO::FETCH_ASSOC);

$query_atendimentos = "SELECT a.id_atendimento, u.cpf, s.nome_servico FROM atendimentos a INNER JOIN usuarios u ON a.id_usuario = u.id_usuario INNER JOIN servicos s ON a.id_servico = s.id_servico";
$stmt_atendimentos = $database->conn->query($query_atendimentos);
$atendimentos = $stmt_atendimentos->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Geral</title>
</head>
<body>
    <div>
        <h2>Lista de Usuários</h2>
        <div>
            <button><a href="./index.php">Voltar</a></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cpf</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id_usuario']; ?></td>
                        <td><?= $usuario['nome_usuario']; ?></td>
                        <td><?= $usuario['email']; ?></td>
                        <td><?= $usuario['cpf']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div>
        <h2>Lista de Serviços</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicos as $servico): ?>
                    <tr>
                        <td><?= $servico['id_servico']; ?></td>
                        <td><?= $servico['nome_servico']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div>
        <h2>Lista de Atendimentos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cpf do Cliente</th>
                    <th>Nome do Serviço</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($atendimentos as $atendimento): ?>
                    <tr>
                        <td><?= $atendimento['id_atendimento']; ?></td>
                        <td><?= $atendimento['cpf']; ?></td>
                        <td><?= $atendimento['nome_servico']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
