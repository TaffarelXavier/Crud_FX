<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$tab_3 = val_input::sani_string('tab_3');

	//Instância da classe:
	$tabelaTeste = new TabelaTeste($connection);
switch ($acao) {    case 'inserir':
echo $tabelaTeste->salvarDados($nome,$tab_3) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $tabelaTeste->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
