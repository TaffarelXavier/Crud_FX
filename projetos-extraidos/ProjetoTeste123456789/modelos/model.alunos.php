<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$alu_3 = val_input::sani_string('alu_3');
	$alu_4 = val_input::sani_string('alu_4');
	$alu_5 = val_input::sani_string('alu_5');

	//Instância da classe:
	$alunos = new Alunos($connection);
switch ($acao) {    case 'inserir':
echo $alunos->salvarDados($nome,$alu_3,$alu_4,$alu_5) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $alunos->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
