<?php

class Database{

    public $conn;
    private string $local = 'localhost';
    private string $db = 'crudatendimento';
    private string $user = 'root';
    private string $password = '';
    private $table;

    function __construct($table = null){
        $this->table = $table;
        $this->conecta();

    }

    public function conecta(){
        try{
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $err){
            die("Connection Failed". $err->getMessage());
        }
    }

    public function execute($query, $binds = []){

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        }catch(PDOException $err){
            die('Connection Failed'. $err->getMessage());
        }
    }
}