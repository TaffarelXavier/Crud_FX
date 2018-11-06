<?php include 'autoload.php'; ?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>SimaStock</title>
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
                            <li><a href="./" title="Clique para voltar">SimaStock</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="hero-unit">
                <br/><h1>Cliente</h1>
                <div class="subheader"> 
                <hr/>
                <a href="#modal_Cliente" role="button" class="btn btn-success" data-toggle="modal">Adicionar Novo</a>
                    <hr/>
        <!-- Modal -->
<div id="modal_Cliente" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add Novo</h3>
  </div>
  <div class="modal-body"><form action="modelos/model.cliente.php" id="form_Cliente" method="POST">
<div class="row-fluid"> <label><b>CPF_CNPJ:</b></label>
 <input name="cpf_cnpj" autofocus="" required="" type="text" class="span12" />
 <label><b>RG:</b></label>
 <input name="rg" required="" type="text" class="span12" />
 <label><b>DATA_NASCIMENTO:</b></label>
 <input name="data_nascimento" required="" type="text" class="span12" />
 <label><b>NOME_FANTASIA:</b></label>
 <input name="nome_fantasia" required="" type="text" class="span12" />
 <label><b>RAZACAO_SOCIAL:</b></label>
 <input name="razacao_social" required="" type="text" class="span12" />
 <label><b>RESPONSAVEL:</b></label>
 <input name="responsavel" required="" type="text" class="span12" />
 <label><b>SITUACAO:</b></label>
 <input name="situacao" required="" type="text" class="span12" />
 <label><b>INSCRICAO_ESTADUAL:</b></label>
 <input name="inscricao_estadual" required="" type="text" class="span12" />
 <label><b>INSCRICAO_MUNICIAPL:</b></label>
 <input name="inscricao_municiapl" required="" type="text" class="span12" />
 <label><b>INSCRICAO_SUFRAMA:</b></label>
 <input name="inscricao_suframa" required="" type="text" class="span12" />
 <label><b>OBSERVACOES:</b></label>
 <input name="observacoes" required="" type="text" class="span12" />
 <label><b>TIPO_CONTRIBUINTE:</b></label>
 <input name="tipo_contribuinte" required="" type="text" class="span12" />
 <label><b>TIPO_DE_PESSOA:</b></label>
 <input name="tipo_de_pessoa" required="" type="text" class="span12" />
<input type="hidden" name="acao" value="inserir" /></div></form><br/></div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <button class="btn btn-primary" form="form_Cliente">Salvar mudanças</button>
  </div>
</div><table class="table"><tr><th>ID:</th>
<th>CPF_CNPJ:</th>
<th>RG:</th>
<th>DATA_NASCIMENTO:</th>
<th>NOME_FANTASIA:</th>
<th>RAZACAO_SOCIAL:</th>
<th>RESPONSAVEL:</th>
<th>SITUACAO:</th>
<th>INSCRICAO_ESTADUAL:</th>
<th>INSCRICAO_MUNICIAPL:</th>
<th>INSCRICAO_SUFRAMA:</th>
<th>OBSERVACOES:</th>
<th>TIPO_CONTRIBUINTE:</th><th>TIPO_DE_PESSOA:</th><th>#</th></tr>
                        <?php
                        $Cliente = new Cliente($connection);

                        $f = $Cliente->getDados(); while ($row = $f->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr id="linha_<?php echo $row->cli_id?>"><td><?php echo $row->cli_id?></td>
<td><?php echo $row->cli_cpf_cnpj?></td>
<td><?php echo $row->cli_rg?></td>
<td><?php echo $row->cli_data_nascimento?></td>
<td><?php echo $row->cli_nome_fantasia?></td>
<td><?php echo $row->cli_razacao_social?></td>
<td><?php echo $row->cli_responsavel?></td>
<td><?php echo $row->cli_situacao?></td>
<td><?php echo $row->cli_inscricao_estadual?></td>
<td><?php echo $row->cli_inscricao_municiapl?></td>
<td><?php echo $row->cli_inscricao_suframa?></td>
<td><?php echo $row->cli_observacoes?></td>
<td><?php echo $row->cli_tipo_contribuinte?></td><td><?php echo $row->cli_tipo_de_pessoa?></td><td style="text-align: right;"><button class="btn btn-editar btn-success">
                                    <i class="icon-edit"></i></button>
                                <button class="btn btn-danger btn-excluir-registro" data-id="<?php echo $row->cli_id?>"><i class="icon-trash"></i></button></td>
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
$("#form_Cliente").ajaxForm({
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
            $.post('modelos/model.Cliente.php',{acao:'excluir',id:_id},function(_result){
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