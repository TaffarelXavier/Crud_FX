<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$estado = val_input::sani_string('estado');

	//Instância da classe:
	$Status = new Status($connection);
switch ($acao) {    case 'inserir':
echo $Status->salvarDados($estado) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Status->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
