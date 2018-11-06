<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$data_etiqueta = val_input::sani_string('data_etiqueta');
	$horario_etiqueta = val_input::sani_string('horario_etiqueta');

	//Instância da classe:
	$Etiqueta = new Etiqueta($connection);
switch ($acao) {    case 'inserir':
echo $Etiqueta->salvarDados($data_etiqueta,$horario_etiqueta) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Etiqueta->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
