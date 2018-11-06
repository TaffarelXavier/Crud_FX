<?php
include '../autoload.php';
//
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Caminho onde as classes serão salvas.
    $caminho_class = '../classes';

    //Caminho onde os modelos serão salvas.
    $caminho_modelo = '../modelos';

    $sql = '';

    //NOME DO PROJETO
    $nomeDoProjeto = val_input::sani_string('nome_do_projeto');

    if ($_POST['table_name']) {
        ?>
        <div class="alert alert-block alert-success fade in">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <a href="#myModalProjetoCriado" role="button" class="btn" data-toggle="modal">Abrir Modal de Criação</a><br/>
            <?php
            $Compactar = new Compactar($nomeDoProjeto);

            //GERAR O SQL PARA O BANCO DE DADOS MYSQL
            foreach ($_POST['table_name'] as $key => $diam) {

                $Criar_Arquivos = new Criar_Arquivos($diam['table'], $key,$nomeDoProjeto, $_POST);

                $sql .= 'CREATE TABLE IF NOT EXISTS ' . $diam['table'] . '(';

                $file_name = strtolower($diam['table']) . '.php';

                $prefixoDaColuna = $_POST['prefixo'][$key]['prefix'];

                $arr = $_POST['col'][$key];
                
                //Salvar Modelo
                $Compactar->salvar_arquivo('modelos/model.' . $file_name, Criar_Arquivos::salvar_modelo($key, $diam['table'], $_POST));
                //Salvar Classe
                $Compactar->salvar_arquivo('classes/class.' . $file_name, Criar_Arquivos::criarClasse($diam['table'], strtolower($diam['table']), $key, $prefixoDaColuna, $_POST));

                $Compactar->salvar_arquivo($file_name, Criar_Arquivos::writeFile($nomeDoProjeto, $key, $prefixoDaColuna, $diam['table'], $_POST));

                $Compactar->salvar_arquivo('index.php', Criar_Arquivos::criar_index($nomeDoProjeto, $key, $_POST));
                
                $Compactar->salvar_arquivo('config.ini.php', Arquivo_Configuracao::criar('1', $nomeDoProjeto, 'Desenvolvedor', DB_HOST, DB_USER, DB_PASSWORD, DB_NAME));
                
                foreach ($arr as $i => $v) {

                    if ($i == 1) {
                        $sql .= '`' . $prefixoDaColuna . $arr[$i]['nome'] . '` ' . $arr[$i]['tipo'] . ' NOT NULL AUTO_INCREMENT, ';
                    } else if ($i > 1 && $i < (count($arr))) {
                        $sql .= '`' . $prefixoDaColuna . $arr[$i]['nome'] . '` ' . $arr[$i]['tipo'] . '(' . $arr[$i]['quantidade'] . '), ';
                    }
                }

                $sql .= '`' . $prefixoDaColuna . $arr[count($arr)]['nome'] . '` ' . $arr[count($arr)]['tipo'] . '(' . $arr[count($arr)]['quantidade'] . '), ';
                $sql .= 'PRIMARY KEY (`' . $prefixoDaColuna . $arr[1]['nome'] . '`)';

                $sql .= ') ENGINE = InnoDB;' . PHP_EOL;
            }
            try {
                $Compactar->salvar_arquivo($nomeDoProjeto . '.sql', $sql);
                $connection->query($sql);
            } catch (PDOException $exc) {
                echo '<b class="text-error">Houve um erro ao tentar criar a tabela:<br/>'
                . '<span class="text-warning">' . $exc->getMessage() . '</span></b>';
            }
            ?>
        </div>
        <?php
        //Caminho onde os arquivos serão extraídos.
        $caminho_extract = '../projetos-extraidos';

        //Extrair
        if ($Compactar->open($Compactar::$nome_do_projeto . '.zip') === TRUE) {
            $Compactar->extractTo($caminho_extract);
            ?>
            <!-- Modal -->
            <div id="myModalProjetoCriado" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 style="text-align: center;">Projeto Builder</h3>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="row-fluid">
                            <div class="alert text-center" style="text-align: center;">
                                <h2>Projeto Criado com suceso!</h2>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <a href="<?php echo $caminho_extract . '\\' . $nomeDoProjeto; ?>" class="btn btn-large btn-success span6" 
                               style="padding-top:15px;padding-bottom:15px;font-size:14px;"
                               target="_blank">
                                Abrir <?php echo $nomeDoProjeto; ?>
                            </a> 
                            <a href="<?php echo '../modelos\\' . $nomeDoProjeto . '.zip'; ?>" class="btn btn-large btn-info span6" 
                               style="padding-top:15px;padding-bottom:15px;font-size:14px;"
                               target="_blank" download="<?php echo $nomeDoProjeto . '.zip'; ?>">
                                Download <?php echo $nomeDoProjeto; ?>
                            </a> 
                        </div>
                        <hr style="border:0px; border-top:1px solid #ccc;">
                        <div class="row-fluid">
                            <textarea name="nome" style="max-width: 100%;" rows="5" class="span12"><?php print $sql; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
                    </div>
                </div>
            </div>
            <script>
                $('#myModalProjetoCriado').modal('show');
            </script>
            <?php
        } else {
            echo '<br/>Houve uma falha na criação do projeto.';
        }
        //Fecha o ponteiro
        $Compactar->close();
    }
}