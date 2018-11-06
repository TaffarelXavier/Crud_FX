<?php

class Usuario {

    private $conexao = null;
    
    private $table_name = 'usuario';

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
	public function salvarDados($nome_de_usuario,$senha,$categoria){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`usu_id`,`usu_nome_de_usuario`,`usu_senha`,`usu_categoria`)VALUES(NULL,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome_de_usuario,PDO::PARAM_INT);
$sth->bindParam(2,$senha,PDO::PARAM_STR);
$sth->bindParam(3,$categoria,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE usu_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}