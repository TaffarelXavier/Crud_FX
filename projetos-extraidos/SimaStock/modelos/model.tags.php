<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$codigo_tag = val_input::sani_string('codigo_tag');
	$descricao = val_input::sani_string('descricao');
	$data_de_cadastro = val_input::sani_string('data_de_cadastro');

	//Instância da classe:
	$Tags = new Tags($connection);
switch ($acao) {    case 'inserir':
echo $Tags->salvarDados($codigo_tag,$descricao,$data_de_cadastro) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Tags->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
