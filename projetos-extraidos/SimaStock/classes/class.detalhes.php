<?php

class Detalhes {

    private $conexao = null;
    
    private $table_name = 'detalhes';

    public function __construct($connection) {
        $this->conexao = $connection;
    }

    public function getDados() {
        try {
            $sth = $this->conexao->prepare('SELECT * FROM '.$this->table_name);
            $sth->execute();
            return $sth;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
	public function salvarDados($peso,$altura,$largura,$data_validade,$descricao){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`det_id`,`det_peso`,`det_altura`,`det_largura`,`det_data_validade`,`det_descricao`)VALUES(NULL,?,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$peso,PDO::PARAM_INT);
$sth->bindParam(2,$altura,PDO::PARAM_STR);
$sth->bindParam(3,$largura,PDO::PARAM_STR);
$sth->bindParam(4,$data_validade,PDO::PARAM_STR);
$sth->bindParam(5,$descricao,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE det_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}