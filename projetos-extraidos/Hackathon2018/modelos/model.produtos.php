<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome_produto = val_input::sani_string('nome_produto');
	$codigo_interno = val_input::sani_string('codigo_interno');
	$codigo_barras = val_input::sani_string('codigo_barras');
	$habilitar_nota_fiscal = val_input::sani_string('habilitar_nota_fiscal');
	$peso = val_input::sani_string('peso');
	$largura = val_input::sani_string('largura');
	$altura = val_input::sani_string('altura');
	$comprimento = val_input::sani_string('comprimento');
	$descricao = val_input::sani_string('descricao');
	$fornecedor_id = val_input::sani_string('fornecedor_id');
	$minimo = val_input::sani_string('minimo');
	$maximo = val_input::sani_string('maximo');
	$quant_atual = val_input::sani_string('quant_atual');

	//Instância da classe:
	$Produtos = new Produtos($connection);
switch ($acao) {    case 'inserir':
echo $Produtos->salvarDados($nome_produto,$codigo_interno,$codigo_barras,$habilitar_nota_fiscal,$peso,$largura,$altura,$comprimento,$descricao,$fornecedor_id,$minimo,$maximo,$quant_atual) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Produtos->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
