<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$estoque_minimo = val_input::sani_string('estoque_minimo');
	$estoque_maximo = val_input::sani_string('estoque_maximo');
	$quant_atual = val_input::sani_string('quant_atual');

	//Instância da classe:
	$Estoque = new Estoque($connection);
switch ($acao) {    case 'inserir':
echo $Estoque->salvarDados($estoque_minimo,$estoque_maximo,$quant_atual) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Estoque->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
