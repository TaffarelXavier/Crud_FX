<?php

class Produtos {

    private $conexao = null;
    
    private $table_name = 'produtos';

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
	public function salvarDados($descricao,$codigo_interno,$codigo_barras,$habilitar_nota_fiscal){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`pro_id`,`pro_descricao`,`pro_codigo_interno`,`pro_codigo_barras`,`pro_habilitar_nota_fiscal`)VALUES(NULL,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$descricao,PDO::PARAM_INT);
$sth->bindParam(2,$codigo_interno,PDO::PARAM_STR);
$sth->bindParam(3,$codigo_barras,PDO::PARAM_STR);
$sth->bindParam(4,$habilitar_nota_fiscal,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE pro_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}