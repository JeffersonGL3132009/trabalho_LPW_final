<?php
require_once "conexao.php";

class itens{
    private $id;
    private $nome;
    private $tipo;
    private $nota;
    private $analise;
    private $erro;

    public function __construct($id = 0, $nome = '', $tipo = '', $nota = null, $analise = ''){
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->nota = $nota;
        $this->analise = $analise;
    }

    public function getid(){ return $this->id; }
    public function getnome(){ return $this->nome; }
    public function gettipo(){ return $this->tipo; }
    public function getnota(){ return $this->nota; }
    public function getanalise(){ return $this->analise; }
    public function getErro(){ return $this->erro; }

    public function salvar(){
        try{
            $conexao = new conexao();
            $ligar = $conexao->getconexao();

            $sql = "INSERT INTO itens(nomei, tipo, nota, analise)
                    VALUES (:nome, :tipo, :nota, :analise)";

            $stmt = $ligar->prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':nota', $this->nota);
            $stmt->bindParam(':analise', $this->analise);

            return $stmt->execute();
        } catch (PDOException $e){
            $this->erro = $e->getMessage();
            return false;
        }
    }

    public function listar(){
        try{
            $conexao = new conexao();
            $ligar = $conexao->getconexao();

            $sql = "SELECT * FROM itens ORDER BY idi DESC";
            $stmt = $ligar->query($sql);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            $this->erro = $e->getMessage();
            return [];
        }
    }

    public function buscarPorId($id){
        try{
            $conexao = new conexao();
            $ligar = $conexao->getconexao();

            $sql = "SELECT * FROM itens WHERE idi = :id";
            $stmt = $ligar->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            $this->erro = $e->getMessage();
            return false;
        }
    }

    public function atualizar($id, $nome, $tipo, $nota, $analise){
        try{
            $conexao = new conexao();
            $ligar = $conexao->getconexao();

            $sql = "UPDATE itens
                    SET nomei = :nome, tipo = :tipo, nota = :nota, analise = :analise
                    WHERE idi = :id";

            $stmt = $ligar->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':nota', $nota);
            $stmt->bindParam(':analise', $analise);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e){
            $this->erro = $e->getMessage();
            return false;
        }
    }

    public function excluir($id){
        try{
            $conexao = new conexao();
            $ligar = $conexao->getconexao();

            $sql = "DELETE FROM itens WHERE idi = :id";
            $stmt = $ligar->prepare($sql);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e){
            $this->erro = $e->getMessage();
            return false;
        }
    }
}
