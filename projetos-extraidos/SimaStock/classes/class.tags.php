<?php

class Tags {

    private $conexao = null;
    
    private $table_name = 'tags';

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
	public function salvarDados($codigo_tag,$descricao,$data_de_cadastro){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`tag_id`,`tag_codigo_tag`,`tag_descricao`,`tag_data_de_cadastro`)VALUES(NULL,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$codigo_tag,PDO::PARAM_INT);
$sth->bindParam(2,$descricao,PDO::PARAM_STR);
$sth->bindParam(3,$data_de_cadastro,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE tag_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}