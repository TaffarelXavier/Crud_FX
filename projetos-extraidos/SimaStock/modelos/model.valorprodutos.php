<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$valor_custo = val_input::sani_string('valor_custo');
	$despesas_acessorias = val_input::sani_string('despesas_acessorias');
	$outras_despesas = val_input::sani_string('outras_despesas');

	//Instância da classe:
	$ValorProdutos = new ValorProdutos($connection);
switch ($acao) {    case 'inserir':
echo $ValorProdutos->salvarDados($valor_custo,$despesas_acessorias,$outras_despesas) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $ValorProdutos->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
