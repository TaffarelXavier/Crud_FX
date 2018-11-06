<?php

include '../autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $Funcoes = new Funcoes($connection);
    
    $table = strtolower(val_input::sani_string('tabela'));
    //
    echo $Funcoes->tabelaExiste($table) == true ? '1' : '0';
}
else{
    print_r('Erro');
}