<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome_logradouro = val_input::sani_string('nome_logradouro');
	$cep = val_input::sani_string('cep');
	$numero = val_input::sani_string('numero');
	$complemento = val_input::sani_string('complemento');
	$cidade = val_input::sani_string('cidade');
	$uf = val_input::sani_string('uf');

	//Instância da classe:
	$Endereco = new Endereco($connection);
switch ($acao) {    case 'inserir':
echo $Endereco->salvarDados($nome_logradouro,$cep,$numero,$complemento,$cidade,$uf) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Endereco->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
