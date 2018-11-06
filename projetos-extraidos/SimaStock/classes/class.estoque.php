<?php

class Estoque {

    private $conexao = null;
    
    private $table_name = 'estoque';

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
	public function salvarDados($estoque_minimo,$estoque_maximo,$quant_atual){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`est_id`,`est_estoque_minimo`,`est_estoque_maximo`,`est_quant_atual`)VALUES(NULL,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$estoque_minimo,PDO::PARAM_INT);
$sth->bindParam(2,$estoque_maximo,PDO::PARAM_INT);
$sth->bindParam(3,$quant_atual,PDO::PARAM_INT);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE est_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}