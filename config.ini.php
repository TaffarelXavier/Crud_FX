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

define('APP_NAME', 'CRUD_TX');
/* Nome da Empresa desenvolvedora */
define('DESENVOLVEDOR', 'Taffarel Xavier');
/* Url do sítio da empresa desenvolvedora */
define('DESENVOLVEDOR_URL', '');

define('_SERVIDOR_', $_SERVER['HTTP_HOST']);

define('SERVER_NOME', $_SERVER['SERVER_NAME']);

define('NEO_DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

//Temporiamente...
if (SERVER_NOME == 'ltai-edu-br.umbler.net') {
    header('location: //' . _SERVIDOR_ . '/' . NEO_HOSTNAME . '/login');
}

//Configurações da parte de Desenvolvimento
switch ($_SERVER['SERVER_NAME']) {
    case 'localhost':
        define('_DOMINIO_', 'http://localhost/' . NEO_HOSTNAME . '/');
        break;
    case 'ava':
        define('_DOMINIO_', 'http://ava/' . NEO_HOSTNAME . '/');
        break;
    case _SERVIDOR_: //Nome do servidor
        define('_DOMINIO_', '//' . _SERVIDOR_ . '/' . NEO_HOSTNAME . '/');
        break;
    default : //Nome do servidor
        define('_DOMINIO_', '//' . SERVER_NOME . DIRECTORY_SEPARATOR);
        break;
}

//===============================================================+
//                  CONFIGURAÇÕES DE PÁGINAS                     |
//===============================================================+

define('CONTATO_WHATSAPP', '63999948823');

//===============================================================+
//                 CONFIGURAÇÕES DE SEGURANÇA                   |
//===============================================================+

define('_BR_', '<br/>');

//Para segurança do Sistema
define('KEY_SECURITY', '1cc6TuGPAASdN0/Ot++kffHkgkU/S8kPkVDE8mw6xT0=');

define('NEO_WRITE_FILE_HTACCES', $_SERVER['DOCUMENT_ROOT']);

/* O ID do Administrador | Não permite algumas funções nestes IDs, como por exemplo, desativá-los. */

$IDS_DEFINE_ARRAY = array(36, 59, 58);

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
        define('DB_PASSWORD', 'chkdsk');
        break;
    case 'rsvtelecom.com.br':
        define('DB_HOST', '');
        /** MySQL database username */
        define('DB_USER', '');
        /** The name of the database for WordPress */
        define('DB_NAME', '');
        /** MySQL database password */
        define('DB_PASSWORD', '');
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