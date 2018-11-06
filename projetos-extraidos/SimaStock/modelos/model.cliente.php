<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$cpf_cnpj = val_input::sani_string('cpf_cnpj');
	$rg = val_input::sani_string('rg');
	$data_nascimento = val_input::sani_string('data_nascimento');
	$nome_fantasia = val_input::sani_string('nome_fantasia');
	$razacao_social = val_input::sani_string('razacao_social');
	$responsavel = val_input::sani_string('responsavel');
	$situacao = val_input::sani_string('situacao');
	$inscricao_estadual = val_input::sani_string('inscricao_estadual');
	$inscricao_municiapl = val_input::sani_string('inscricao_municiapl');
	$inscricao_suframa = val_input::sani_string('inscricao_suframa');
	$observacoes = val_input::sani_string('observacoes');
	$tipo_contribuinte = val_input::sani_string('tipo_contribuinte');
	$tipo_de_pessoa = val_input::sani_string('tipo_de_pessoa');

	//Instância da classe:
	$Cliente = new Cliente($connection);
switch ($acao) {    case 'inserir':
echo $Cliente->salvarDados($cpf_cnpj,$rg,$data_nascimento,$nome_fantasia,$razacao_social,$responsavel,$situacao,$inscricao_estadual,$inscricao_municiapl,$inscricao_suframa,$observacoes,$tipo_contribuinte,$tipo_de_pessoa) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Cliente->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
