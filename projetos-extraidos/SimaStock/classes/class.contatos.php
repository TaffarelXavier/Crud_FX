<?php

class Contatos {

    private $conexao = null;
    
    private $table_name = 'contatos';

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
	public function salvarDados($tel_cel_cont,$tel_comercial_con,$email_contato,$cel2,$cliente_id){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`con_id`,`con_tel_cel_cont`,`con_tel_comercial_con`,`con_email_contato`,`con_cel2`,`con_cliente_id`)VALUES(NULL,?,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$tel_cel_cont,PDO::PARAM_INT);
$sth->bindParam(2,$tel_comercial_con,PDO::PARAM_STR);
$sth->bindParam(3,$email_contato,PDO::PARAM_STR);
$sth->bindParam(4,$cel2,PDO::PARAM_STR);
$sth->bindParam(5,$cliente_id,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE con_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}