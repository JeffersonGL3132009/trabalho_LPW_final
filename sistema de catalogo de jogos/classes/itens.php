<?php
require_once "conexao.php";
class itens{
private $id;
private $nome;
private $tipo;
private $imagem;

public function __construct($id =0,$nome = '',$tipo = '',$imagem = '' ){
    $this->id = $id;
    $this->nome = $nome;
    $this->tipo = $tipo;
    $this->imagem = $imagem;
}

public function getid(){
    return $this->id;
}
public function getnome(){
    return $this->nome;
}
public function gettipo(){
    return $this->tipo;
}
public function getimagem(){
    return $this->imagem;
}
public function setid($id){
    $this->id = $id;
}
public function setnome($nome){
    $this->nome = $nome;
}
public function settipo($tipo){
    $this->tipo = $tipo;
}
public function setimagem($imagem){
    $this->imagem = $imagem;
}

 public function salvar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "INSERT INTO itens(nomei,tipo,imagem) 
                VALUES (:nome,:tipo,:imagem)";

        $stmt = $ligar->prepare($sql);

        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':email',$this->tipo);
        $stmt->bindParam(':senha',$this->imagem);

        $stmt->execute();
        } catch (PDOException $e){
            echo "Erro de cadastro:".$e->getMessage()." por favor, tente novamente.";
        }

    }
    public function listar(){
        try{
        $conexao = new conexao();
        $ligar = $conexao->getconexao();

        $sql = "SELECT * FROM itens";

        $stmt = $ligar->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erro de exibição:".$e->getMessage()." por favor, tente novamente.";
        }
    }

    public function atualizar($id, $nome, $tipo, $imagem){
        try{
        $conexao = new conexao();
        $arranque = $conexao->getconexao();

        $sql = "UPDATE usuario
                SET nomei = :nome,
                    tipo = :tipo,
                    imagem = :imagem
                WHERE idi = :id";

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':imagem', $imagem);
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

        $sql = "DELETE FROM itens
                WHERE idi = :id";

        $stmt = $arranque->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro de exclusão:".$e->getMessage()." por favor, tente novamente.";
        }
    }

}

?>