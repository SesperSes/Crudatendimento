<?php

require_once './App/DB/Database.php';
require_once './App/Classes/Servico.php';
require_once './App/Classes/Usuario.php';

class Atendimento {

    private $pdo;
    private $table_name = "atendimentos";

    public int $id_atendimento;
    public int $id_usuario;
    public int $id_servico;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function cadastrar() {
        try {
            $query = "SELECT id_usuario FROM usuarios WHERE cpf = :cpf";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([":cpf" => $this->cpf]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $this->id_usuario = $user['id_usuario'];

                $sql_code = "INSERT INTO " . $this->table_name . " (id_usuario, id_servico) VALUES (:id_usuario, :id_servico)";
                $stmt = $this->pdo->prepare($sql_code);
                $stmt->bindParam(":id_usuario", $this->id_usuario);
                $stmt->bindParam(":id_servico", $this->id_servico);

                return $stmt->execute();
            } else {
                echo "Usuário não encontrado!";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar atendimento: " . $e->getMessage();
            return false;
        }
    }

    public function buscar($where = null, $order = null, $limit = null) {
        $res = $this->pdo->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        return $res;
    }

    public function buscar_por_id($id_atendimento) {
        $obj = $this->pdo->select('id_atendimento = ' . $id_atendimento)->fetchObject(self::class);
        return $obj;
    }
}