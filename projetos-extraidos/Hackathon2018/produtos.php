<?php include 'autoload.php'; ?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Hackathon2018</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="CRUD_TX Framework para PHP - Construtor de Aplicações" />
        <meta name="author" content="Taffarel" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <!--<link href="bootstrap/css/font-awesome.css" rel="stylesheet" />-->
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
                        <li><a href="./" title="Clique para voltar">Hackathon2018</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="hero-unit">
            <br/><h1>Produtos</h1>
            <div class="subheader"> 
                <hr/>
                <a href="#modal_Produtos" role="button" class="btn btn-success" data-toggle="modal">Adicionar Novo</a>
                <hr/>
                <!-- Modal -->
                <div id="modal_Produtos" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Add Novo</h3>
                    </div>
                    <div class="modal-body"><form action="modelos/model.produtos.php" id="form_Produtos" method="POST">
                            <div class="row-fluid"> <label><b>NOME_PRODUTO:</b></label>
                                <input name="nome_produto" autofocus="" required="" type="text" class="span12" />
                                <label><b>CODIGO_INTERNO:</b></label>
                                <input name="codigo_interno" required="" type="text" class="span12" />
                                <label><b>CODIGO_BARRAS:</b></label>
                                <input name="codigo_barras" required="" type="text" class="span12" />
                                <label><b>HABILITAR_NOTA_FISCAL:</b></label>
                                <input name="habilitar_nota_fiscal" required="" type="text" class="span12" />
                                <label><b>PESO:</b></label>
                                <input name="peso" required="" type="text" class="span12" />
                                <label><b>LARGURA:</b></label>
                                <input name="largura" required="" type="text" class="span12" />
                                <label><b>ALTURA:</b></label>
                                <input name="altura" required="" type="text" class="span12" />
                                <label><b>COMPRIMENTO:</b></label>
                                <input name="comprimento" required="" type="text" class="span12" />
                                <label><b>DESCRICAO:</b></label>
                                <input name="descricao" required="" type="text" class="span12" />
                                <label><b>FORNECEDOR_ID:</b></label>
                                <input name="fornecedor_id" required="" type="text" class="span12" />
                                <label><b>MINIMO:</b></label>
                                <input name="minimo" required="" type="text" class="span12" />
                                <label><b>MAXIMO:</b></label>
                                <input name="maximo" required="" type="text" class="span12" />
                                <label><b>QUANT_ATUAL:</b></label>
                                <input name="quant_atual" required="" type="text" class="span12" />
                                <input type="hidden" name="acao" value="inserir" /></div></form><br/></div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                        <button class="btn btn-primary" form="form_Produtos">Salvar mudanças</button>
                    </div>
                </div><table class="table"><tr><th>ID:</th>
                        <th>NOME_PRODUTO:</th>
                        <th>CODIGO_INTERNO:</th>
                        <th>CODIGO_BARRAS:</th>
                        <th>HABILITAR_NOTA_FISCAL:</th>
                        <th>PESO:</th>
                        <th>LARGURA:</th>
                        <th>ALTURA:</th>
                        <th>COMPRIMENTO:</th>
                        <th>DESCRICAO:</th>
                        <th>FORNECEDOR_ID:</th>
                        <th>MINIMO:</th>
                        <th>MAXIMO:</th><th>QUANT_ATUAL:</th><th>#</th></tr>
                    <?php
                    $Produtos = new Produtos($connection);

                    $f = $Produtos->getDados();
                    while ($row = $f->fetch(PDO::FETCH_OBJ)) {
                        ?>
                        <tr id="linha_<?php echo $row->pro_id ?>"><td><?php echo $row->pro_id ?></td>
                            <td><?php echo $row->pro_nome_produto ?></td>
                            <td><?php echo $row->pro_codigo_interno ?></td>
                            <td><?php echo $row->pro_codigo_barras ?></td>
                            <td><?php echo $row->pro_habilitar_nota_fiscal ?></td>
                            <td><?php echo $row->pro_peso ?></td>
                            <td><?php echo $row->pro_largura ?></td>
                            <td><?php echo $row->pro_altura ?></td>
                            <td><?php echo $row->pro_comprimento ?></td>
                            <td><?php echo $row->pro_descricao ?></td>
                            <td><?php echo $row->pro_fornecedor_id ?></td>
                            <td><?php echo $row->pro_minimo ?></td>
                            <td><?php echo $row->pro_maximo ?></td><td><?php echo $row->pro_quant_atual ?></td><td style="text-align: right;"><button class="btn btn-editar btn-success">
                                    <i class="icon-edit"></i></button>
                                <button class="btn btn-danger btn-excluir-registro" data-id="<?php echo $row->pro_id ?>"><i class="icon-trash"></i></button></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <hr><footer class="muted">
            <div><small><?php echo APP_NAME . VERSAO_EVTX_SYSTEM; ?> &copy; </small></div>
        </footer>
    </div>

    <script src="scripts/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="scripts/jquery.form.js"></script>
    <script>
        
        
        $("#form_Produtos").ajaxForm({
            beforeSend: function () {
                
            },
            success: function (data) {
                if (data == '1') {
                    alert("Operação realizada com sucesso!");
                    window.location.reload();
                } else {
                    alert("Não foi possível fazer a inserção de dados.\nCódigo do erro:" + data);
                }
            }
        });
        $('.btn-excluir-registro').click(function () {
            var _id = $(this).attr('data-id');
            if (confirm('Deseja realmente excluir este registro?')) {
                $('#linha_' + _id).remove();
                $.post('modelos/model.Produtos.php', {acao: 'excluir', id: _id}, function (_result) {
                    if (_result == '1') {
                        alert('Registro excluído com sucesso!');
                    } else {
                        alert('Houve um erro ao tentar exluir este registro.' +
                                'Código do erro:' + _result);
                    }
                });
            }
        });
    </script></body>
</html>