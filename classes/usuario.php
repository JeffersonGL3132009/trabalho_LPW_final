<?php
require_once "conexao.php";

class usuario{
    private $id;
    private $nome;
    private $senha;
    private $email;

    public function __construct($id = 0,$nome = '',$email = '',$senha = ''){
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha; 
        $this->email = $email; 
    }

    public function getId(){
    return $this->id;
    }
    public function getnome(){
        return $this->nome;
    }
    public function getsenha(){
        return $this->senha;
    }
    public function getemail(){
        return $this->email;
    }
    public function setId($id){
    $this->id = $id;
    }
    public function setnome($nome){
        $this->nome = $nome;
    }
    public function setsenha($senha){
        $this->senha = $senha;
    }
    public function setemail($email){
        $this->email = $email;
    }

    public function salvar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "INSERT INTO usuario(nomeu,emailu,senhau) 
                VALUES (:nome,:email,:senha)";

        $stmt = $ligar->prepare($sql);

        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':senha',$this->senha);

        $stmt->execute();
        } catch (PDOException $e){
            echo "Erro de cadastro:".$e->getMessage()." por favor, tente novamente.";
        }

    }
    public function listar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "SELECT * FROM usuario";

        $stmt = $ligar->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erro de exibição:".$e->getMessage()." por favor, tente novamente.";
        }
    }

    public function atualizar($id, $nome, $email, $senha){
        try{
        $conexao = new conexao();
        $arranque = $conexao->getconexao();

        $sql = "UPDATE usuario
                SET nomeu = :nome,
                    emailu = :email,
                    senhau = :senha
                WHERE idu = :id";

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro de atualização:".$e->getMessage()." por favor, tente novamente.";
        }
    }

    public function excluir($id){
        try{
         $conexao = new conexao();
        $arranque = $conexao->getconexao();

        $sql = "DELETE FROM usuario
                WHERE idu = :id";

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro de exclusão:".$e->getMessage()." por favor, tente novamente.";
        }
    }

}



?>