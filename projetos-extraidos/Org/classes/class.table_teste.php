<?php

class Table_teste {

    private $conexao = null;
    
    private $table_name = 'table_teste';

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
	public function salvarDados($nome,$tab_3,$tab_4,$tab_5){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`tab_id`,`tab_nome`,`tab_tab_3`,`tab_tab_4`,`tab_tab_5`)VALUES(NULL,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome,PDO::PARAM_INT);
$sth->bindParam(2,$tab_3,PDO::PARAM_STR);
$sth->bindParam(3,$tab_4,PDO::PARAM_STR);
$sth->bindParam(4,$tab_5,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE tab_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}