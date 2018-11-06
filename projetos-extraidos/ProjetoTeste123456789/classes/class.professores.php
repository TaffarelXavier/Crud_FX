<?php

class Professores {

    private $conexao = null;
    
    private $table_name = 'professores';

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
	public function salvarDados($nome,$pro_3,$pro_4,$pro_5){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`pro_id`,`pro_nome`,`pro_pro_3`,`pro_pro_4`,`pro_pro_5`)VALUES(NULL,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome,PDO::PARAM_INT);
$sth->bindParam(2,$pro_3,PDO::PARAM_STR);
$sth->bindParam(3,$pro_4,PDO::PARAM_STR);
$sth->bindParam(4,$pro_5,PDO::PARAM_STR);
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