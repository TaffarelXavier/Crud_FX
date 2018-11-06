<?php 

//===============================================================+
//==============ARQUIVO DE CONFIGURAÇÃO DO SISTEMA===============|
//===============================================================+
//===============================================================+
//                      CONFIGURAÇÕES GLOBAIS                    |
//===============================================================+

//Define a timezone para Araguaina
date_default_timezone_set('America/Araguaina');
/* A versão 1.0 indica que é a última versão válida. */
define('VERSAO_EVTX_SYSTEM', '1');

define('APP_NAME', 'Hackathon2018');
/* Nome da Empresa desenvolvedora */
define('DESENVOLVEDOR','Desenvolvedor');
/* Url do sítio da empresa desenvolvedora */;
define('DESENVOLVEDOR_URL', '');

define('_SERVIDOR_', $_SERVER['HTTP_HOST']);

define('SERVER_NOME', $_SERVER['SERVER_NAME']);

define('NEO_DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

//===============================================================+
//                 CONFIGURAÇÕES DO BANCO DE DADOS               |
//===============================================================+
switch (SERVER_NOME) {
case 'localhost':
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** MySQL database username */
define('DB_USER', 'root');
/** The name of the database for WordPress */
define('DB_NAME', 'testedb');
/** MySQL database password */
define('DB_PASSWORD','chkdsk');
break;
}

if (class_exists('Conexao')) {

//===============================================================+
//                 CONFIGURAÇÕES DE CONEXÃO                      |
//===============================================================+

$connection = Conexao::conn();
} else {
header('location:../');
}
