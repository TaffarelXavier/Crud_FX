<?php

class Cliente {

    private $conexao = null;
    
    private $table_name = 'cliente';

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
	public function salvarDados($cpf_cnpj,$rg,$data_nascimento,$nome_fantasia,$razacao_social,$responsavel,$situacao,$inscricao_estadual,$inscricao_municiapl,$inscricao_suframa,$observacoes,$tipo_contribuinte,$tipo_de_pessoa){
try{

	$sql = 'INSERT INTO '.$this->table_name.'(`cli_id`,`cli_cpf_cnpj`,`cli_rg`,`cli_data_nascimento`,`cli_nome_fantasia`,`cli_razacao_social`,`cli_responsavel`,`cli_situacao`,`cli_inscricao_estadual`,`cli_inscricao_municiapl`,`cli_inscricao_suframa`,`cli_observacoes`,`cli_tipo_contribuinte`,`cli_tipo_de_pessoa`)VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1,$cpf_cnpj,PDO::PARAM_INT);
$sth->bindParam(2,$rg,PDO::PARAM_STR);
$sth->bindParam(3,$data_nascimento,PDO::PARAM_STR);
$sth->bindParam(4,$nome_fantasia,PDO::PARAM_STR);
$sth->bindParam(5,$razacao_social,PDO::PARAM_STR);
$sth->bindParam(6,$responsavel,PDO::PARAM_STR);
$sth->bindParam(7,$situacao,PDO::PARAM_STR);
$sth->bindParam(8,$inscricao_estadual,PDO::PARAM_STR);
$sth->bindParam(9,$inscricao_municiapl,PDO::PARAM_STR);
$sth->bindParam(10,$inscricao_suframa,PDO::PARAM_STR);
$sth->bindParam(11,$observacoes,PDO::PARAM_STR);
$sth->bindParam(12,$tipo_contribuinte,PDO::PARAM_STR);
$sth->bindParam(13,$tipo_de_pessoa,PDO::PARAM_STR);
$sth->execute();
return $sth->rowCount();

} catch (Exception $exc) { echo $exc->getMessage();}}
	public function excluir_por_id($id){
try{

	$sql = 'DELETE FROM '.$this->table_name.' WHERE cli_id = ?;';
$sth = $this->conexao->prepare($sql);
$sth->bindParam(1, $id, PDO::PARAM_INT);
$sth->execute();
return (int) $sth->rowCount();
} catch (Exception $exc) {
 echo $exc->getMessage();
}
}}