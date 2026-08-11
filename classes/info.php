<?php
require_once "conexao.php";

class info{
private $idf;
private $itemi;
private $datalanca;
private $descricao;

public function __construct($idf = 0,$itemi = 0, $datalanca = '',$descricao = ''){
    $this->idf = $idf;
    $this->itemi = $itemi;
    $this->datalanca = $datalanca;
    $this->descricao = $descricao;
}

public function getidf(){
    return $this->idf;
}
public function getitemi(){
    return $this->itemi;
}
public function getdatalanca(){
    return $this->datalanca;
}
public function getdescricao(){
    return $this->descricao;
}
public function setidf($idf){
    $this->idf = $idf;
}
public function setitemi($itemi){
    $this->itemi = $itemi;
}
public function setdatalanca($datalanca){
    $this->datalanca = $datalanca;
}
public function setdescricao($descricao){
    $this->descricao = $descricao;
}


public function salvar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "INSERT INTO info(itemi,datalanca,descricao) 
                VALUES (:itemi,:datalanca,:descricao)";

        $stmt = $ligar->prepare($sql);

        $stmt->bindParam(':itemi',$this->itemi);
        $stmt->bindParam(':datalanca',$this->datalanca);
        $stmt->bindParam(':descricao',$this->descricao);

        $stmt->execute();
        } catch (PDOException $e){
            echo "Erro de cadastro:".$e->getMessage()." por favor, tente novamente.";
        }

    }
    public function listar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "SELECT * 
                FROM info i
                INNER JOIN itens it
                ON i.itemi = it.idi; ";

        $stmt = $ligar->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erro de exibição:".$e->getMessage()." por favor, tente novamente.";
        }
    }
    public function atualizar($idf,$datalanca, $descricao){
        try{
        $conexao = new conexao();
        $arranque = $conexao->getconexao();

        $sql = "UPDATE info
                SET datalanca = :datalanca,
                    descricao = :descricao
                WHERE idf=:idf"
                    ;

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':idf', $idf);
        $stmt->bindParam(':datalanca', $datalanca);
        $stmt->bindParam(':descricao', $descricao);

        return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro de atualização:".$e->getMessage()." por favor, tente novamente.";
        }
    }

    public function excluir($idf){
        try{
         $conexao = new conexao();
        $arranque = $conexao->getconexao();

        $sql = "DELETE FROM info
                WHERE idf = :idf";

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':idf', $idf);

        return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro de exclusão:".$e->getMessage()." por favor, tente novamente.";
        }
    }



}

?>