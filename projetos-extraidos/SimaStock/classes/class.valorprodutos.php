<?php

class ValorProdutos {

    private $conexao = null;
    
    private $table_name = 'valorprodutos';

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
	public function salvarDados($valor_custo,$despesas_acessorias,$outras_despesas){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`val_id`,`val_valor_custo`,`val_despesas_acessorias`,`val_outras_despesas`)VALUES(NULL,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$valor_custo,PDO::PARAM_INT);
$sth->bindParam(2,$despesas_acessorias,PDO::PARAM_STR);
$sth->bindParam(3,$outras_despesas,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE val_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}