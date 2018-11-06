<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');

	//Instância da classe:
	$Setor = new Setor($connection);
switch ($acao) {    case 'inserir':
echo $Setor->salvarDados($nome) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Setor->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
