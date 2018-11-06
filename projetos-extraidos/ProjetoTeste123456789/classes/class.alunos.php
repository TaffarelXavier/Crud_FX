<?php

class Alunos {

    private $conexao = null;
    
    private $table_name = 'alunos';

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
	public function salvarDados($nome,$alu_3,$alu_4,$alu_5){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`alu_id`,`alu_nome`,`alu_alu_3`,`alu_alu_4`,`alu_alu_5`)VALUES(NULL,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome,PDO::PARAM_INT);
$sth->bindParam(2,$alu_3,PDO::PARAM_STR);
$sth->bindParam(3,$alu_4,PDO::PARAM_STR);
$sth->bindParam(4,$alu_5,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE alu_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}