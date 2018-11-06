<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$nome = val_input::sani_string('nome');
	$sexo = val_input::sani_string('sexo');
	$sobrenome = val_input::sani_string('sobrenome');
	$idade = val_input::sani_string('idade');

	//Instância da classe:
	$pessoa = new Pessoa($connection);
switch ($acao) {    case 'inserir':
echo $pessoa->salvarDados($nome,$sexo,$sobrenome,$idade) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $pessoa->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
