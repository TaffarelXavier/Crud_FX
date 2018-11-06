<?php

class Arquivo_Configuracao {

    /**
     * 
     * @param type $versao
     * @param type $nome_projeto
     * @param type $desenvolvedor
     * @param type $host
     * @param type $username
     * @param type $password
     * @param type $dbname
     * @return string
     */
    public static function criar($versao, $nome_projeto, $desenvolvedor, $host, $username, $password, $dbname) {
        $codigo = "<?php ". PHP_EOL.PHP_EOL;
        $codigo .= "//===============================================================+". PHP_EOL;
        $codigo .= '//==============ARQUIVO DE CONFIGURAÇÃO DO SISTEMA===============|'. PHP_EOL;
        $codigo .= '//===============================================================+'. PHP_EOL;
        $codigo .= '//===============================================================+'. PHP_EOL;
        $codigo .= '//                      CONFIGURAÇÕES GLOBAIS                    |'. PHP_EOL;
        $codigo .= '//===============================================================+'. PHP_EOL. PHP_EOL;
        $codigo .= '//Define a timezone para Araguaina'. PHP_EOL;
        $codigo .= 'date_default_timezone_set(\'America/Araguaina\');' . PHP_EOL;

        $codigo .= '/* A versão 1.0 indica que é a última versão válida. */' . PHP_EOL;
        $codigo .= 'define(\'VERSAO_EVTX_SYSTEM\', \'' . $versao . '\');' . PHP_EOL . PHP_EOL;

        $codigo .= 'define(\'APP_NAME\', ' ."'". $nome_projeto ."'". ');' . PHP_EOL;
        $codigo .= '/* Nome da Empresa desenvolvedora */' . PHP_EOL;
        $codigo .= 'define(\'DESENVOLVEDOR\',' ."'". $desenvolvedor ."'". ');' . PHP_EOL;
        $codigo .= '/* Url do sítio da empresa desenvolvedora */;' . PHP_EOL;
        $codigo .= 'define(\'DESENVOLVEDOR_URL\', \'\');' . PHP_EOL . PHP_EOL;

        $codigo .= 'define(\'_SERVIDOR_\', $_SERVER[\'HTTP_HOST\']);' . PHP_EOL . PHP_EOL;

        $codigo .= 'define(\'SERVER_NOME\', $_SERVER[\'SERVER_NAME\']);' . PHP_EOL . PHP_EOL;

        $codigo .= 'define(\'NEO_DOCUMENT_ROOT\', $_SERVER[\'DOCUMENT_ROOT\']);' . PHP_EOL . PHP_EOL;

        $codigo .= '//===============================================================+' . PHP_EOL;
        $codigo .= '//                 CONFIGURAÇÕES DO BANCO DE DADOS               |' . PHP_EOL;
        $codigo .= '//===============================================================+' . PHP_EOL;
        $codigo .= 'switch (SERVER_NOME) {' . PHP_EOL;
        $codigo .= 'case \'localhost\':' . PHP_EOL;
        $codigo .= '/** MySQL hostname */' . PHP_EOL;
        $codigo .= 'define(\'DB_HOST\', ' ."'". $host ."'". ');' . PHP_EOL;
        $codigo .= '/** MySQL database username */' . PHP_EOL;
        $codigo .= 'define(\'DB_USER\', ' ."'". $username ."'". ');' . PHP_EOL;
        $codigo .= '/** The name of the database for WordPress */' . PHP_EOL;
        $codigo .= 'define(\'DB_NAME\', ' ."'". $dbname ."'". ');' . PHP_EOL;
        $codigo .= '/** MySQL database password */' . PHP_EOL;
        $codigo .= 'define(\'DB_PASSWORD\',' ."'". $password ."'". ');' . PHP_EOL;
        $codigo .= 'break;' . PHP_EOL;
        $codigo .= '}' . PHP_EOL . PHP_EOL;

        $codigo .= 'if (class_exists(\'Conexao\')) {' . PHP_EOL . PHP_EOL;

        $codigo .= '//===============================================================+' . PHP_EOL;
        $codigo .= '//                 CONFIGURAÇÕES DE CONEXÃO                      |' . PHP_EOL;
        $codigo .= '//===============================================================+' . PHP_EOL . PHP_EOL;

        $codigo .= '$connection = Conexao::conn();' . PHP_EOL;
        $codigo .= '} else {' . PHP_EOL;
        $codigo .= 'header(\'location:../\');' . PHP_EOL;
        $codigo .= '}' . PHP_EOL;
        return $codigo;
    }

}
