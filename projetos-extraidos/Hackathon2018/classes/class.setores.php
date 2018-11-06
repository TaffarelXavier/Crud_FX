<?php

class Setores {

    private $conexao = null;
    
    private $table_name = 'setores';

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
	public function salvarDados($codigo,$nome_setor,$funcionario_id,$observacoes){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`set_id`,`set_codigo`,`set_nome_setor`,`set_funcionario_id`,`set_observacoes`)VALUES(NULL,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$codigo,PDO::PARAM_INT);
$sth->bindParam(2,$nome_setor,PDO::PARAM_STR);
$sth->bindParam(3,$funcionario_id,PDO::PARAM_STR);
$sth->bindParam(4,$observacoes,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE set_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}