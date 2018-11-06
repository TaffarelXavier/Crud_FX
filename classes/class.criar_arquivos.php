<?php

/**
 * Description of class
 *
 * @author Taffarel Xavier <taffarel_deus@hotmail.com>
 */
class Criar_Arquivos {

    //A tabela do banco
    private static $tabela = '';
    //O index do array vindo da requisição POST
    private static $key = 0;
    //O (Array/Matriz) método POST
    private static $array = [];
    //
    private static $nome_do_projeto = [];
    //
    private static $matriz_tabelas = [];
    
    private static $prefixos = [];

    /**
     * 
     * @param type $table
     * @param type $key
     * @param type $nomeProjeto
     * @param type $array
     */
    public function __construct($table, $key, $nomeProjeto, $array = []) {
        self::$matriz_tabelas = $array['col'][$key];
        self::$prefixos = $array['prefixo'][$key];
        self::$tabela = $table;
        self::$key = $key;
        self::$nome_do_projeto = $nomeProjeto;
        self::$array = $array;
    }

    /**
     * 
     * @param type $nomeDaClasse
     * @param type $tabela
     * @param type $key
     * @param type $prefixoDaColuna
     * @param type $array
     * @return string
     */
    public static function criarClasse($nomeDaClasse, $tabela, $key, $prefixoDaColuna, $array = []) {

        $codigo = '<?php' . PHP_EOL
                . PHP_EOL . 'class ' . ucfirst($nomeDaClasse) . ' {

    private $conexao = null;
    
    private $table_name = \'' . $tabela . '\';

    public function __construct($connection) {
        $this->conexao = $connection;
    }

    public function getDados() {
        try {
            $sth = $this->conexao->prepare(\'SELECT * FROM \'.$this->table_name);
            $sth->execute();
            return $sth;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }';
        $codigo .= self::insert($key, $prefixoDaColuna, $array);
        $codigo .= self::delete();
        $codigo .= '}';

        return $codigo;
    }

    /**
     * 
     * @param type $tipo
     */
    public static function substituirDadosSQL($tipo) {
        switch ($tipo) {
            case 'INT':
                return 'PDO::PARAM_INT';
            case 'TEXT':
            case 'VARCHAR':
                return 'PDO::PARAM_STR';
            default:
                return 'PDO::PARAM_STR';
        }
    }

    /**
     * 
     * @param type $key
     * @param type $prefixoDaColuna
     * @param type $array
     * @return string
     */
    public static function insert($key, $prefixoDaColuna, $array = []) {

        $arr = $array['col'][$key];

        $codigo = PHP_EOL . "\t" . 'public function salvarDados(';

        $total = count($arr);

        foreach ($arr as $i => $v) {
            if ($i > 1 && $i < ($total)) {
                $codigo .= '$' . strtolower($arr[$i]['nome']) . ',';
            }
        }
        //Última linha
        $codigo .= '$' . strtolower($arr[($total)]['nome']) . '){' . PHP_EOL;

        $codigo .= 'try{' . PHP_EOL;

        $codigo .= PHP_EOL . "\t" . '$sql = \'INSERT INTO \'.' . '$this->table_name.\'(';

        //Colunas
        foreach ($arr as $i => $v) {
            if ($i > 0 && $i < ($total)) {
                $codigo .= '`' . $prefixoDaColuna . strtolower($arr[$i]['nome']) . '`,';
            }
        }
        $codigo .= '`' . $prefixoDaColuna . strtolower($arr[($total)]['nome']) . '`';

        $codigo .= ')VALUES(';
//Fetch? Exclui o ID
        foreach ($arr as $i => $v) {
            if ($i == 1) {
                $codigo .= 'NULL,';
            } else if ($i > 1 && $i < ($total)) {
                $codigo .= '?,';
            }
        }

        $codigo .= '?';

        $codigo .= ')\';' . PHP_EOL . '$sth = $this->conexao->prepare($sql);' . PHP_EOL;

//bindParam  Exclui o ID
        $incr = 0;
        foreach ($arr as $i => $v) {

            if ($i > 1) {
                $incr++;
                $codigo .= '$sth->bindParam(' . $incr . ',$' . strtolower($arr[$i]['nome']) . ','
                        . self::substituirDadosSQL($arr[($i - 1)]['tipo']) . '' . ');' . PHP_EOL;
            }
        }

        $codigo .= '$sth->execute();' . PHP_EOL;
        $codigo .= 'return $sth->rowCount();' . PHP_EOL . PHP_EOL;
        $codigo .= '} catch (Exception $exc) {';
        $codigo .= ' echo $exc->getMessage();';
        $codigo .= '}';

        $codigo .= '}'; //Fim da função

        return $codigo;
    }

    public static function update($param) {
        
    }

    /**
     * 
     * @return string
     */
    public static function delete() {
        $id = self::$matriz_tabelas;
        $prefixo = self::$prefixos;
        $codigo = PHP_EOL . "\t" . 'public function excluir_por_id($' . $id[1]['nome'] . '){';
        $codigo .= PHP_EOL . 'try{' . PHP_EOL;
        $codigo .= PHP_EOL . "\t" . '$sql = \'DELETE FROM \'.' . '$this->table_name.\' WHERE ' .
                $prefixo['prefix'] . $id[1]['nome'] . ' = ?;\';';
        $codigo .= PHP_EOL . '$sth = $this->conexao->prepare($sql);';
        $codigo .= PHP_EOL . '$sth->bindParam(1, $' . $id[1]['nome'] . ', PDO::PARAM_INT);';
        $codigo .= PHP_EOL . '$sth->execute();';
        $codigo .= PHP_EOL . 'return (int) $sth->rowCount();';
        $codigo .= PHP_EOL . '} catch (Exception $exc) {';
        $codigo .= PHP_EOL . ' echo $exc->getMessage();';
        $codigo .= PHP_EOL . '}';
        $codigo .= PHP_EOL . '}';
        return $codigo;
    }

    /**
     * 
     * @param type $nomeDoProjeto
     * @return string
     */
    public static function header($nomeDoProjeto) {
        $codigo = '<?php include \'autoload.php\'; ?>';
        $codigo .= '<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>' . ucfirst($nomeDoProjeto) . '</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="CRUD_TX Framework para PHP - Construtor de Aplicações" />
        <meta name="author" content="Taffarel" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <!--<link href="bootstrap/css/font-awesome.css" rel="stylesheet" />-->
    </head>';
        return $codigo;
    }
    /**
     * 
     * @param type $tabela
     * @param type $key
     * @param type $prefixoDaColuna
     * @param type $array
     * @return string
     */
    public static function body($tabela, $key, $prefixoDaColuna, $array = []) {

        $arr = $array['col'][$key];

        $codigo = '<div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="./" title="Clique para voltar">' . ucfirst(self::$nome_do_projeto) . '</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="hero-unit">
                <br/><h1>' . ucfirst($tabela) . '</h1>
                <div class="subheader"> 
                <hr/>
                <a href="#modal_' . $tabela . '" role="button" class="btn btn-success" data-toggle="modal">Adicionar Novo</a>
                    <hr/>
        <!-- Modal -->
<div id="modal_' . $tabela . '" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add Novo</h3>
  </div>
  <div class="modal-body">';
        //FORMULÁRIO:Para adicionar um registro
        $codigo .= '<form action="modelos/model.' . strtolower($tabela) . '.php" id="form_' . $tabela . '" method="POST">' . PHP_EOL;
        $codigo .= '<div class="row-fluid">';
        foreach ($arr as $i => $v) {
            if ($i > 1) { //REMOVE O CAMPO DE ID
                if ($i == 2) { //Colocar o autofocus
                    $codigo .= ' <label><b>' . strtoupper($arr[$i]['nome']) . ':</b></label>' . PHP_EOL;
                    $codigo .= ' <input name="' . strtolower($arr[$i]['nome']) . '" autofocus="" required="" type="text" class="span12" />' . PHP_EOL;
                } else {
                    $codigo .= ' <label><b>' . strtoupper($arr[$i]['nome']) . ':</b></label>' . PHP_EOL;
                    $codigo .= ' <input name="' . strtolower($arr[$i]['nome']) . '" required="" type="text" class="span12" />' . PHP_EOL;
                }
            }
        }
        $codigo .= '<input type="hidden" name="acao" value="inserir" />';
        $codigo .= '</div>';
        $codigo .= '</form><br/>';

        $codigo .= '</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <button class="btn btn-primary" form="form_' . $tabela . '">Salvar mudanças</button>
  </div>
</div>';
        $codigo .= '<table class="table"><tr>';
//Add as colunas
        foreach ($arr as $i => $v) {
            if ($i == 1) {
                $codigo .= '<th>' . strtoupper($arr[$i]['nome']) . ':</th>' . PHP_EOL;
            } else if ($i < (count($arr) - 1)) {
                $codigo .= '<th>' . strtoupper($arr[$i]['nome']) . ':</th>' . PHP_EOL;
            } else {
                $codigo .= '<th>' . strtoupper($arr[$i]['nome']) . ':</th>';
            }
        }
        $codigo .= '<th>#</th>';

        $codigo .= '</tr>
                        <?php
                        $' . $tabela . ' = new ' . $tabela . '($connection);

                        $f = $' . $tabela . '->getDados();';

        $codigo .= ' while ($row = $f->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr id="linha_<?php echo $row->' . $prefixoDaColuna . $arr[1]['nome'] . '?>">';
//Add as linhas
        $id_autoincrmento = 0;

        foreach ($arr as $i => $v) {
            if ($i == 1) {
                $codigo .= '<td><?php echo $row->' . $prefixoDaColuna . $arr[$i]['nome'] . '?></td>' . PHP_EOL;
                $id_autoincrmento = '<?php echo $row->' . $prefixoDaColuna . $arr[$i]['nome'] . '?>';
            } else if ($i < (count($arr) - 1)) {
                $codigo .= '<td><?php echo $row->' . $prefixoDaColuna . $arr[$i]['nome'] . '?></td>' . PHP_EOL;
            } else {
                $codigo .= '<td><?php echo $row->' . $prefixoDaColuna . $arr[$i]['nome'] . '?></td>';
            }
        }
        $codigo .= '<td style="text-align: right;"><button class="btn btn-editar btn-success">
                                    <i class="icon-edit"></i></button>
                                <button class="btn btn-danger btn-excluir-registro" data-id="' . $id_autoincrmento . '">'
                . '<i class="icon-trash"></i></button></td>';

        $codigo .= '
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            
            <hr>';

        return $codigo;
    }
  /**
     * 
     * @return string
     */
    public static function footer() {
        $codigo = '<footer class="muted">
                <div><small><?php echo APP_NAME . VERSAO_EVTX_SYSTEM; ?> &copy; </small></div>
            </footer>
        </div>

        <script src="scripts/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="scripts/jquery.form.js"></script>';
        $codigo .= self::jQuery(self::$tabela);

        $codigo .= '</body>
</html>';

        return $codigo;
    }

    /**
     * 
     * @param type $nomeDoProjeto
     * @param type $key
     * @param type $tabela
     * @param type $array
     * @return type
     */
    public static function writeFile($nomeDoProjeto, $key, $prefixoDaColuna, $tabela, $array = []) {
        $codigo = self::header($nomeDoProjeto);
        $codigo .= self::body($tabela, $key, $prefixoDaColuna, $array);
        $codigo .= self::footer();
        return $codigo;
    }
/**
     * 
     * @param type $tabela
     * @return string
     */
    public static function jQuery($tabela) {

        $codigo = PHP_EOL . '<script>' . PHP_EOL;
        $codigo .= '$("#form_' . $tabela . '").ajaxForm({
                beforeSend: function () {

                },
                success: function (data) {
                    if (data == \'1\') {
                        alert("Operação realizada com sucesso!");'.PHP_EOL;
                       $codigo .=  'window.location.reload();
                    } else {
                        alert("Não foi possível fazer a inserção de dados.\nCódigo do erro:" + data);
                    }
                }
            });' . PHP_EOL;
        $codigo .= "\t\t\t$('.btn-excluir-registro').click(function(){
            var _id = $(this).attr('data-id');
            if(confirm('Deseja realmente excluir este registro?')){
            $('#linha_'+_id).remove();
            $.post('modelos/model." . $tabela . ".php',{acao:'excluir'," . self::$matriz_tabelas[1]['nome'] . ":_id},function(_result){
            if(_result=='1'){
                alert('Registro excluído com sucesso!');
            }else{
                alert('Houve um erro ao tentar exluir este registro.'+\n'Código do erro:'+_result);
            }
            });
            }
            });" . PHP_EOL;
        $codigo .= '</script>';
        return $codigo;
    }
    /**
     * 
     * @param type $nomeDoProjeto
     * @param type $key
     * @param type $array
     * @return string
     */
    public static function criar_index($nomeDoProjeto, $key, $array = []) {
        $codigo = '<?php include \'autoload.php\'; ?>';
        $codigo .= '
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta charset="utf-8">
        <title>' . ucfirst($nomeDoProjeto) . '</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="CRUD_FX Framework for PHP - Application Builder" />
        <meta name="author" content="CRUD_FX" />
        <!-- Le styles -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <!--<link href="bootstrap/css/font-awesome.css" rel="stylesheet" />-->
        <link href="styles/builder.min.css" rel="stylesheet" />
    </head><div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                         <li><a href="./" title="Clique para voltar">' . ucfirst(self::$nome_do_projeto) . '</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">

            <div class="hero-unit">
                <h1>' . ucfirst($nomeDoProjeto) . '</h1><br/>
                <div class="subheader">';

//Abrir as telas
        $total = count($array['table_name']);

        foreach ($array['table_name'] as $key => $value) {
            if ($key == 0) {
                $codigo .= '<a href="' . $value['table'] . '" class="icones">' . ucfirst($value['table']) . '</a>&nbsp|&nbsp;';
            } else if ($key < ($total)) {
                $codigo .= '<a href="' . $value['table'] . '" class="icones">' . ucfirst($value['table']) . '</a>&nbsp|&nbsp';
            } else {
                $codigo .= '<a href="' . $value['table'] . '" class="icones">' . ucfirst($value['table']) . '</a>';
            }
        }

        $codigo .= '</div>
            </div>
            
            <hr><footer class="muted">
                <div><small><?php echo APP_NAME; ?> &copy; </small></div>
            </footer>

        </div>

        <!--<script src="scripts/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>-->
    </body>
</html>';
        return $codigo;
    }

    /**
     * 
     * @param type $key
     * @param type $table
     * @param type $array
     * @return string
     */
    public static function salvar_modelo($key, $table, $array = []) {

        $arr = $array['col'][$key];

        $codigo = '<?php

if ($_SERVER[\'REQUEST_METHOD\'] == \'POST\') {

    ' . "\t" . 'include \'../autoload.php\';' . PHP_EOL . PHP_EOL;

        $codigo .= '$acao=val_input::sani_string(\'acao\');' . PHP_EOL . PHP_EOL;

        //
        foreach ($arr as $i => $v) {
            $col = strtolower($arr[$i]['nome']);
            if ($i > 1) {
                $codigo .= "\t" . '$' . $col . ' = val_input::sani_string(\'' . $col . '\');' . PHP_EOL;
            }
        }
        $codigo .= PHP_EOL;
        //Instância da classe:
        $codigo .= "\t" . '//Instância da classe:' . PHP_EOL;
        $codigo .= "\t" . '$' . $table . ' = new ' . ucfirst($table) . '($connection);' . PHP_EOL;

        $codigo .= 'switch ($acao) {';
        $codigo .= '    case \'inserir\':' . PHP_EOL;
        ;

        $codigo .= 'echo $' . $table . '->salvarDados(';

        $total = count($arr);

        foreach ($arr as $i => $v) {
            if ($i > 1 && $i < ($total)) {
                $codigo .= '$' . strtolower($arr[$i]['nome']) . ',';
            }
        }
        //Última linha
        $codigo .= '$' . strtolower($arr[($total)]['nome']) . ') > 0 ? \'1\':\'0\';' . PHP_EOL;
        $codigo .= '      break;';
        $codigo .= '   case \'excluir\':' . PHP_EOL;
        $codigo .= '$' . $arr[(1)]['nome'] . '= val_input::val_int(\'' . $arr[(1)]['nome'] . '\');' . PHP_EOL;
        $codigo .= '     echo $' . $table . '->excluir_por_id($' . $arr[(1)]['nome'] . ') > 0 ? \'1\' : \'0\';';
        $codigo .= '      break;';

        $codigo .= '}';

        $codigo .= '}' . PHP_EOL;

        return $codigo;
    }

}
