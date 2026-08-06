<?php

class conexao{
    private $host = 'localhost';
    private $bdnome = 'videogames';
    private $user = 'root';
    private $senha = '';
    private $conn;

    public function __construct(){

    try{
        $dsn = "mysql:host=$this->host;dbname=$this->bdnome";
        $this->conn = new PDO($dsn, $this->user, $this->senha);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
         echo "Erro: " . $e->getMessage();
    }
    }

    public function getconexao()
    {
        return $this->conn;
    }

     public function cutconexao()
    {
        $this->conn = null;
    }
}

?>