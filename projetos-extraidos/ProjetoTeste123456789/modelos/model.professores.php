<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$pro_3 = val_input::sani_string('pro_3');
	$pro_4 = val_input::sani_string('pro_4');
	$pro_5 = val_input::sani_string('pro_5');

	//Instância da classe:
	$professores = new Professores($connection);
switch ($acao) {    case 'inserir':
echo $professores->salvarDados($nome,$pro_3,$pro_4,$pro_5) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $professores->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
