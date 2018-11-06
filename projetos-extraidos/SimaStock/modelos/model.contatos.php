<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include '../autoload.php';

$acao=val_input::sani_string('acao');

	$tel_cel_cont = val_input::sani_string('tel_cel_cont');
	$tel_comercial_con = val_input::sani_string('tel_comercial_con');
	$email_contato = val_input::sani_string('email_contato');
	$cel2 = val_input::sani_string('cel2');
	$cliente_id = val_input::sani_string('cliente_id');

	//Instância da classe:
	$Contatos = new Contatos($connection);
switch ($acao) {    case 'inserir':
echo $Contatos->salvarDados($tel_cel_cont,$tel_comercial_con,$email_contato,$cel2,$cliente_id) > 0 ? '1':'0';
      break;   case 'excluir':
$id= val_input::val_int('id');
     echo $Contatos->excluir_por_id($id) > 0 ? '1' : '0';      break;}}
