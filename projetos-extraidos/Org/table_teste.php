<?php include 'autoload.php'; ?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Org</title>
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
                            <li><a href="./" title="Clique para voltar">Org</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="hero-unit">
                <br/><h1>Table_teste</h1>
                <div class="subheader"> 
                <hr/>
                <a href="#modal_table_teste" role="button" class="btn btn-success" data-toggle="modal">Adicionar Novo</a>
                    <hr/>
        <!-- Modal -->
<div id="modal_table_teste" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add Novo</h3>
  </div>
  <div class="modal-body"><form action="modelos/model.table_teste.php" id="form_table_teste" method="POST">
<div class="row-fluid"> <label><b>NOME:</b></label>
 <input name="nome" autofocus="" required="" type="text" class="span12" />
 <label><b>TAB_3:</b></label>
 <input name="tab_3" required="" type="text" class="span12" />
 <label><b>TAB_4:</b></label>
 <input name="tab_4" required="" type="text" class="span12" />
 <label><b>TAB_5:</b></label>
 <input name="tab_5" required="" type="text" class="span12" />
<input type="hidden" name="acao" value="inserir" /></div></form><br/></div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <button class="btn btn-primary" form="form_table_teste">Salvar mudanças</button>
  </div>
</div><table class="table"><tr><th>ID:</th>
<th>NOME:</th>
<th>TAB_3:</th>
<th>TAB_4:</th><th>TAB_5:</th><th>#</th></tr>
                        <?php
                        $table_teste = new table_teste($connection);

                        $f = $table_teste->getDados(); while ($row = $f->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr id="linha_<?php echo $row->tab_id?>"><td><?php echo $row->tab_id?></td>
<td><?php echo $row->tab_nome?></td>
<td><?php echo $row->tab_tab_3?></td>
<td><?php echo $row->tab_tab_4?></td><td><?php echo $row->tab_tab_5?></td><td style="text-align: right;"><button class="btn btn-editar btn-success">
                                    <i class="icon-edit"></i></button>
                                <button class="btn btn-danger btn-excluir-registro" data-id="<?php echo $row->tab_id?>"><i class="icon-trash"></i></button></td>
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
$("#form_table_teste").ajaxForm({
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
			$('.btn-excluir-registro').click(function(){
            var _id = $(this).attr('data-id');
            if(confirm('Deseja realmente excluir este registro?')){
            $('#linha_'+_id).remove();
            $.post('modelos/model.table_teste.php',{acao:'excluir',id:_id},function(_result){
            if(_result=='1'){
                alert('Registro excluído com sucesso!');
            }else{
                alert('Houve um erro ao tentar exluir este registro.'+
'Código do erro:'+_result);
            }
            });
            }
            });
</script></body>
</html>