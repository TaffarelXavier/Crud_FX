<?php

class Hackathon {

    private $conexao = null;
    
    private $table_name = 'hackathon';

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
	public function salvarDados($nome,$hac_3,$hac_4,$hac_5,$hac_6){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`hac_id`,`hac_nome`,`hac_hac_3`,`hac_hac_4`,`hac_hac_5`,`hac_hac_6`)VALUES(NULL,?,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome,PDO::PARAM_INT);
$sth->bindParam(2,$hac_3,PDO::PARAM_STR);
$sth->bindParam(3,$hac_4,PDO::PARAM_STR);
$sth->bindParam(4,$hac_5,PDO::PARAM_STR);
$sth->bindParam(5,$hac_6,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE hac_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}