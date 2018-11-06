<?php
include '../autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo APP_NAME; ?> | Builder</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="CRUD_TX Framework para PHP - Construtor de Aplicações" />
        <meta name="author" content="Taffarel" />
        <!-- Lê styles -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../styles/builder.min.css" rel="stylesheet" />
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="../bootstrap/fontawesome/css/all.min.css" rel="stylesheet" />
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a title="<?php echo APP_NAME; ?>"><?php echo APP_NAME; ?></a></li>
                            <li><a href="../" title="Clique para voltar">Voltar</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="hero-unit">
                <div class="row-fluid">
                    <h1 style="display:block;text-align:center;"><?php echo APP_NAME; ?></h1>
                </div>
            </div>
            <div class="hero-unit">
                <div class="subheader">
                    <div class="row-fluid">
                        <div class="span6">
                            <h2><i class="fas fa-angle-right"></i>O <b><?php echo APP_NAME; ?></b> irá criar:</h2>
                            <ol type="1">
                                <li>Uma <b>Tabela</b> para cada formulário;</li>
                                <li>Um <b>Modelo</b> para cada tabela;</li>
                                <li>Uma <b>Classe</b> para cada tabela;</li>
                                <li>Uma <b>View PHP</b> com o mesmo nome da tabela.</li>
                            </ol>  
                        </div>
                        <div class="span6">
                            <h3><i class="fas fa-angle-right"></i>Todo em Boostrap e JQuery</h3>
                            <label class="text-info"><h2>Nome do projeto:</h2></label>
                            <input type="text" class="span10" required="" style="font-size:25px;padding:25px 25px !important;"
                                   id="nome_do_projeto" name="nome_do_projeto" autofocus="" form="form_analisar" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-unit">
                <form action="builder/" method="post" class="form-horizontal">
                    <fieldset>
                        <h2>Nova Tabela</h2>
                        <?php
                        $host = val_input::sani_string('host');
                        $port = val_input::sani_string('port');
                        $type = val_input::sani_string('type');
                        $schema = val_input::sani_string('schema');
                        $username = val_input::sani_string('username');
                        $password = val_input::sani_string('password');
                        ?>
                        <pre>
    
                        </pre>
                      
                        <div id="hostPortContainer" class="control-group">
                            <table>
                                <tr>
                                    <td>
                                        <label for="host" class=""><b>Nome da Tabela:</b></label>
                                        <input type="text" id="nome_da_tabela" name="host" placeholder="Nome da Tabela" /> 
                                    </td>
                                    <td>
                                        <label class=""><b>Quantidade de Linhas:</b></label>
                                        <input type="number" min="1" id="quantidade_de_linhas" name="name" 
                                               value="5" placeholder="Quantidade de linhas" />
                                    </td>
                                    <td>
                                        <label class=""><b>Prefixo das Colunas:</b></label>
                                        <input type="text" id="prefixo_das_colunas" name="name" value="col_"
                                               placeholder="Quantidade de linhas" />
                                        <button class="btn btn-info" type="button" 
                                                id="btn_adicionar_tabela">Adicionar <i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>

                            </table>
                            <hr />
                            <div class="row-fluid">
                                <button class="btn btn-info btn-large btn-criar-projeto" form="form_analisar">Criar Projeto
                                    <i class="fas fa-save"></i>
                                </button>
                                <a href="../" title="Clique para ir à tela inicial" class="btn btn-info btn-large">Voltar</a>
                            </div>
                        </div>
                    </fieldset>
                </form> 
            </div>

            <form action="../modelos/analyze.php" method="POST" id="form_analisar">
                <div id="saida"></div>
                <!--<button class="btn btn-info btn-large btn-criar-projeto" form="form_analisar">Criar Projeto
                <i class="fas fa-save"></i></button>-->
            </form>
            <div id="resultado_request"></div>
            <hr>

            <div><small><?php echo APP_NAME . VERSAO_EVTX_SYSTEM; ?> &copy; 2018 <a href=""></a></small>
                Desenvolvido por <strong><?php echo DESENVOLVEDOR; ?></strong>
            </div>

        </div> <!-- /container -->

        <script src="../scripts/jquery-1.10.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../scripts/jquery.form.js"></script>
        <script src="../scripts/app/app.min.js"></script>
    </body>
</html>