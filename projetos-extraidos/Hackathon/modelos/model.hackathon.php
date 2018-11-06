<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$hac_3 = val_input::sani_string('hac_3');
	$hac_4 = val_input::sani_string('hac_4');
	$hac_5 = val_input::sani_string('hac_5');
	$hac_6 = val_input::sani_string('hac_6');

	//Instância da classe:
	$hackathon = new Hackathon($connection);
switch ($acao) {    case 'inserir':
echo $hackathon->salvarDados($nome,$hac_3,$hac_4,$hac_5,$hac_6) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $hackathon->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
