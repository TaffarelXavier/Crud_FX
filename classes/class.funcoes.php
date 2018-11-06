<?php

class Funcoes {

    private $conexao = null;

    public function __construct($connection) {
        $this->conexao = $connection;
    }

    /**
     * 
     * @param type $dbname <p>O banco de dados, onde terei que consultar a tabela</p>
     * @param type $table_name <p>A tabela</p>
     */
    private function isTableExist($dbname, $table_name) {
        try {
            $sth = $this->conexao->query("SHOW TABLES IN " . $dbname . " LIKE '" . $table_name . "';");
            $sth->execute();
            return $sth->rowCount() > 0 ? true : false;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * 
     * @param type $table
     * @return type
     */
    public function tabelaExiste($table) {
        $query = $this->conexao->query('SHOW TABLES');
        return in_array($table, $query->fetchAll(PDO::FETCH_COLUMN));
    }

}