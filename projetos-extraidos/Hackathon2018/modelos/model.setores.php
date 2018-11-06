<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$codigo = val_input::sani_string('codigo');
	$nome_setor = val_input::sani_string('nome_setor');
	$funcionario_id = val_input::sani_string('funcionario_id');
	$observacoes = val_input::sani_string('observacoes');

	//Instância da classe:
	$Setores = new Setores($connection);
switch ($acao) {    case 'inserir':
echo $Setores->salvarDados($codigo,$nome_setor,$funcionario_id,$observacoes) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Setores->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
