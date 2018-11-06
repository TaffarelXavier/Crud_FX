<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$descricao = val_input::sani_string('descricao');
	$codigo_interno = val_input::sani_string('codigo_interno');
	$codigo_barras = val_input::sani_string('codigo_barras');
	$habilitar_nota_fiscal = val_input::sani_string('habilitar_nota_fiscal');

	//Instância da classe:
	$Produtos = new Produtos($connection);
switch ($acao) {    case 'inserir':
echo $Produtos->salvarDados($descricao,$codigo_interno,$codigo_barras,$habilitar_nota_fiscal) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Produtos->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
