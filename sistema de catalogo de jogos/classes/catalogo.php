<?php
require_once "conexao.php";

class catalogo{
    private $idc;
    private $itemc;
    private $iduc;

    public function __construct($idc = 0,$itemc = 0,$iduc = 0){
        $this->idc=$idc;
        $this->itemc=$itemc;
        $this->iduc=$iduc;
    }
    public function getidc(){
        return $this->idc;
    }
    public function getitemc(){
        return $this->itemc;
    }
    public function getiduc(){
        return $this->iduc;
    }
    public function setidc($idc){
        $this->idc = $idc;
    }
    public function setitemc($itemc){
        $this->itemc = $itemc;
    }
    public function setiduc($iduc){
        $this->iduc = $iduc;
    }

    public function salvar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "INSERT INTO catalogo(itemc,iduc) 
                VALUES (:itemc,:iduc)";

        $stmt = $ligar->prepare($sql);

        $stmt->bindParam(':itemc',$this->itemc);
        $stmt->bindParam(':iduc',$this->iduc);

        $stmt->execute();
        } catch (PDOException $e){
            echo "Erro de cadastro:".$e->getMessage()." por favor, tente novamente.";
        }

    }
    public function listar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "SELECT catalogo.idc,
                       itens.idi,
                       itens.nomei,
                       itens.tipo,
                       itens.imagem
                FROM catalogo
                INNER JOIN itens
                    ON catalogo.itemc = itens.idi
                WHERE catalogo.iduc = :iduc";

                $stmt = $ligar->prepare($sql);
                $stmt->bindValue(":iduc", $this->iduc);
                $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erro de exibição:".$e->getMessage()." por favor, tente novamente.";
        }
    }


    public function excluir($idc){
        try{
         $conexao = new conexao();
        $arranque = $conexao->getconexao();

        $sql = "DELETE FROM catalogo
                WHERE idc  = :idc";

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':idc', $idc);

        return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro de exclusão:".$e->getMessage()." por favor, tente novamente.";
        }
    }

}

?>