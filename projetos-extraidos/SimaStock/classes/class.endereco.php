<?php

class Endereco {

    private $conexao = null;
    
    private $table_name = 'endereco';

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
	public function salvarDados($nome_logradouro,$cep,$numero,$complemento,$cidade,$uf){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`end_id`,`end_nome_logradouro`,`end_cep`,`end_numero`,`end_complemento`,`end_cidade`,`end_uf`)VALUES(NULL,?,?,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome_logradouro,PDO::PARAM_INT);
$sth->bindParam(2,$cep,PDO::PARAM_STR);
$sth->bindParam(3,$numero,PDO::PARAM_STR);
$sth->bindParam(4,$complemento,PDO::PARAM_STR);
$sth->bindParam(5,$cidade,PDO::PARAM_STR);
$sth->bindParam(6,$uf,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE end_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}