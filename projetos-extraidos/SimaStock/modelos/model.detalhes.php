<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$peso = val_input::sani_string('peso');
	$altura = val_input::sani_string('altura');
	$largura = val_input::sani_string('largura');
	$data_validade = val_input::sani_string('data_validade');
	$descricao = val_input::sani_string('descricao');

	//Instância da classe:
	$Detalhes = new Detalhes($connection);
switch ($acao) {    case 'inserir':
echo $Detalhes->salvarDados($peso,$altura,$largura,$data_validade,$descricao) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Detalhes->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
