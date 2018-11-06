<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$tab_3 = val_input::sani_string('tab_3');
	$tab_4 = val_input::sani_string('tab_4');
	$tab_5 = val_input::sani_string('tab_5');

	//Instância da classe:
	$tablea3 = new Tablea3($connection);
switch ($acao) {    case 'inserir':
echo $tablea3->salvarDados($nome,$tab_3,$tab_4,$tab_5) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $tablea3->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
