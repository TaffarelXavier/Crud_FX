<?php
include 'autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title><?php echo APP_NAME; ?> | Builder</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="CRUD_TX Framework para PHP - Construtor de Aplicações" />
        <meta name="author" content="Taffarel" />
        <!-- Le styles -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="styles/builder.min.css" rel="stylesheet" />
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="bootstrap/css/font-awesome.css" rel="stylesheet" />
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="hero-unit">
                <div class="subheader" style="text-align: center;">
                    <h1><?php echo APP_NAME; ?> </h1>
                    <hr style="border:0px; border-top:1px solid #ccc;">
                    <div>
                        <h3 class="slogan">O <?php echo APP_NAME; ?> irá analisar seu esquema e gerar um aplicativo incrível.</h3>
                        <?php
                        
                        ?>
                    </div>
                </div>
            </div>

            <form action="builder/" method="post" class="form-horizontal">
                <fieldset class="well">
                    <div class="row-fluid">
                        <div id="hostPortContainer" class="control-group">
                            <div class="controls inline-inputs">
                                Digite suas informações de conexão do MySQL no formulário abaixo.
                            </div>
                        </div>
                    </div>
                    <div id="hostPortContainer" class="control-group">
                        <label class="control-label" for="host">MySQL Host : Porta</label>
                        <div class="controls inline-inputs">
                            <input type="text" class="span2" id="host" name="host"  placeholder="example: localhost" /> :
                            <input type="text" class="span1" id="port" name="port" value="3306" />
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div id="schemaContainer" class="control-group">
                        <label class="control-label" for="schema">MySQL Driver</label>
                        <div class="controls inline-inputs">
                            <select name="type" id="type">
                                <option value="MySQL_PDO">PDO</option>
                            </select>
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div id="schemaContainer" class="control-group">
                        <label class="control-label" for="schema">Schema Name</label>
                        <div class="controls inline-inputs">
                            <input type="text" class="span3" id="schema" name="schema" placeholder="exemplo: mydatabase" />
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div id="usernameContainer" class="control-group">
                        <label class="control-label" for="username">MySQL Nome de Usuário:</label>
                        <div class="controls inline-inputs">
                            <input type="text" class="span3" id="username" name="username" placeholder="" />
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div id="passwordContainer" class="control-group">
                        <label class="control-label" for="password">MySQL senha:</label>
                        <div class="controls inline-inputs">
                            <input type="password" class="span3" id="password" name="password" placeholder="" />
                            <span class="help-inline"></span>
                        </div>
                    </div>
                    <div id="passwordContainer" class="control-group">
                        <div class="controls inline-inputs">
                            <button type="submit" class="btn btn-info btn-large" >Avançar &raquo;</button>
                        </div>
                    </div>
                </fieldset>

            </form>

            <hr>

            <footer class="muted">
                <div><small><?php echo APP_NAME . VERSAO_EVTX_SYSTEM; ?> &copy; 2018 <a href=""></a></small>
                    Desenvolvido por <strong><?php echo DESENVOLVEDOR; ?></strong>
                </div>
            </footer>

        </div> <!-- /container -->

        <script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


    </body>
</html>