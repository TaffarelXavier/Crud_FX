<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$pes_3 = val_input::sani_string('pes_3');
	$pes_4 = val_input::sani_string('pes_4');
	$pes_5 = val_input::sani_string('pes_5');

	//Instância da classe:
	$pessoa = new Pessoa($connection);
switch ($acao) {    case 'inserir':
echo $pessoa->salvarDados($nome,$pes_3,$pes_4,$pes_5) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $pessoa->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
