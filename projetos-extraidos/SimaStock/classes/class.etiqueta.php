<?php

class Etiqueta {

    private $conexao = null;
    
    private $table_name = 'etiqueta';

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
	public function salvarDados($data_etiqueta,$horario_etiqueta){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`eti_id`,`eti_data_etiqueta`,`eti_horario_etiqueta`)VALUES(NULL,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$data_etiqueta,PDO::PARAM_INT);
$sth->bindParam(2,$horario_etiqueta,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE eti_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}