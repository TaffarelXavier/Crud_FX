<?php

class Pessoa {

    private $conexao = null;
    private $table_name = 'pessoa';

    public function __construct($connection) {
        $this->conexao = $connection;
    }

    public function getDados() {
        try {
            $sth = $this->conexao->prepare('SELECT * FROM ' . $this->table_name);
            $sth->execute();
            return $sth;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function salvarDados($nome, $sexo, $sobrenome, $idade) {
        try {

            $sql = 'INSERT INTO ' . $this->table_name . '(`pes_id`,`pes_nome`,`pes_sexo`,`pes_sobrenome`,`pes_idade`)VALUES(NULL,?,?,?,?)';
            $sth = $this->conexao->prepare($sql);
            $sth->bindParam(1, $nome, PDO::PARAM_INT);
            $sth->bindParam(2, $sexo, PDO::PARAM_STR);
            $sth->bindParam(3, $sobrenome, PDO::PARAM_STR);
            $sth->bindParam(4, $idade, PDO::PARAM_STR);
            $sth->execute();
            return $sth->rowCount();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir_por_id($id) {
        try {

            $sql = 'DELETE FROM ' . $this->table_name . ' WHERE pes_id = ?;';
            $sth = $this->conexao->prepare($sql);
            $sth->bindParam(1, $id, PDO::PARAM_INT);
            $sth->execute();
            return (int) $sth->rowCount();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}
