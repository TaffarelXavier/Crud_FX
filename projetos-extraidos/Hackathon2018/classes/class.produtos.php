<?php

class Produtos {

    private $conexao = null;
    
    private $table_name = 'produtos';

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
	public function salvarDados($nome_produto,$codigo_interno,$codigo_barras,$habilitar_nota_fiscal,$peso,$largura,$altura,$comprimento,$descricao,$fornecedor_id,$minimo,$maximo,$quant_atual){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`pro_id`,`pro_nome_produto`,`pro_codigo_interno`,`pro_codigo_barras`,`pro_habilitar_nota_fiscal`,`pro_peso`,`pro_largura`,`pro_altura`,`pro_comprimento`,`pro_descricao`,`pro_fornecedor_id`,`pro_minimo`,`pro_maximo`,`pro_quant_atual`)VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$nome_produto,PDO::PARAM_INT);
$sth->bindParam(2,$codigo_interno,PDO::PARAM_STR);
$sth->bindParam(3,$codigo_barras,PDO::PARAM_STR);
$sth->bindParam(4,$habilitar_nota_fiscal,PDO::PARAM_STR);
$sth->bindParam(5,$peso,PDO::PARAM_STR);
$sth->bindParam(6,$largura,PDO::PARAM_STR);
$sth->bindParam(7,$altura,PDO::PARAM_STR);
$sth->bindParam(8,$comprimento,PDO::PARAM_STR);
$sth->bindParam(9,$descricao,PDO::PARAM_STR);
$sth->bindParam(10,$fornecedor_id,PDO::PARAM_STR);
$sth->bindParam(11,$minimo,PDO::PARAM_STR);
$sth->bindParam(12,$maximo,PDO::PARAM_INT);
$sth->bindParam(13,$quant_atual,PDO::PARAM_INT);
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