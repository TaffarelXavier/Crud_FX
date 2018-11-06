<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome_de_usuario = val_input::sani_string('nome_de_usuario');
	$senha = val_input::sani_string('senha');
	$categoria = val_input::sani_string('categoria');

	//Instância da classe:
	$Usuario = new Usuario($connection);
switch ($acao) {    case 'inserir':
echo $Usuario->salvarDados($nome_de_usuario,$senha,$categoria) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Usuario->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
