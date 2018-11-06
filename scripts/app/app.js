var _IdDaTabela = 0;

var tabelas = [];

delete tabelas[0];

var _tabelaExiste = false;

function addTabel() {

    if (_tabelaExiste == false) {

        _IdDaTabela++;
        //
        var nomeDaTabela = $('#nome_da_tabela').val().trim();

        //Se o campo do nome da tabela estiver em branco.
        if (nomeDaTabela == '') {
            $('#nome_da_tabela').focus();
            alert('Insira o nome da tabela corretamente.');
            return false;
        }

        //Verifica se a tabela já existe.
        if (jQuery.inArray(nomeDaTabela, tabelas) >= 0) {
            $('#nome_da_tabela').focus();
            alert('A tabela ' + nomeDaTabela + ' já existe.');
            return false;
        }

        tabelas[_IdDaTabela] = nomeDaTabela;

        $('#nome_da_tabela').val('').focus();

        //
        var quantidadeDeLinhas = $('#quantidade_de_linhas').val();
        //
        var prefixoDasColunas = $('#prefixo_das_colunas').val();
        //
        var saida = $('#saida');
        //
        var codigo = '<div id="tabela_' + nomeDaTabela + '_' + _IdDaTabela + '"><hr/>';
        //Cabeçalho
        codigo += '<table id="tab-cabecalho-' + _IdDaTabela + '">';
        codigo += '<tr><td><b>Nome da Tabela:</b><input name="table_name[' + _IdDaTabela + '][table]" id="tabela_' + nomeDaTabela + '" required="" type="text" class="nome-tabela" value="' + nomeDaTabela + '"/></td>';
        codigo += '<td><b>Prefixo das Colunas:</b><input name="prefixo[' + _IdDaTabela + '][prefix]" required="" type="text" value="' + prefixoDasColunas + '"/></td></tr>';
        codigo += '</table>';
        codigo += '<br/>';
        //Início da tabela
        codigo += '<table id="tab-corpo-' + _IdDaTabela + '" class="table table-borded tabela-crud-tx">';
        codigo += '<thead>';
        codigo += '<tr>';
        codigo += '<th>ORDEM</th>';
        codigo += '<th>NOME DA COLUNA</th>';
        codigo += '<th>TIPO</th>';
        codigo += '<th>QUANT.</th>';
        codigo += '<th>NULO</th>';
        codigo += '<th>AUTOINCREMENT</th>';
        codigo += '<th>PRIMARY</th>';
        codigo += '<th>#</th>';
        codigo += '</thead>';
        codigo += '<tbody id="tab_' + _IdDaTabela + '">';

        /**
         * 
         * @param {type} _totDeTabela
         * @param {type} incremento
         * @returns {String}
         */
        function tipos(_totDeTabela, incremento) {

            var codigo = '<select name="col[' + _totDeTabela + '][' + incremento + '][tipo]" required="" class="coluna2">';
            if (incremento == 1) {
                codigo += '<option value="INT" selected>INT</option>';
                codigo += '<option value="VARCHAR">VARCHAR</option>';
                codigo += '<option value="TEXT">TEXT</option>';
            } else {
                codigo += '<option value="INT">INT</option>';
                codigo += '<option value="VARCHAR" selected>VARCHAR</option>';
                codigo += '<option value="TEXT">TEXT</option>';
            }
            codigo += '</select>';
            return codigo;
        }

        function isNulo() {
            return '<select class="span1">'
                    + '<option value="TRUE">TRUE</option>'
                    + '<option value="FALSE">FALSE</option>'
                    + '</select>';
        }
        function isAutoincremet() {
            return '<select class="span1">'
                    + '<option value="TRUE">TRUE</option>'
                    + '<option value="FALSE">FALSE</option>'
                    + '</select>';
        }
        function isPrimary() {
            return '<select class="span1">'
                    + '<option value="TRUE">TRUE</option>'
                    + '<option value="FALSE">FALSE</option>'
                    + '</select>';
        }

        /**
         * 
         * @param {type} idDaTabela <p>O Id da tabela.</p>
         * @param {type} nomeDaTabela <p>O nome da tabela</p>
         * @returns {String}
         */
        function Funcoes(idDaTabela, nomeDaTabela)
        {
            return '<div>'
                    + '<button class="btn btn-success add-linha" type="button" '
                    + 'data-tabela-id="' + idDaTabela + '" data-nome-tabela="' + nomeDaTabela + '">Add</button>'
                    + '<button class="btn btn-danger excluir-tabela" id="btn_excluir_tabela_' + nomeDaTabela + '"'
                    + 'data-tabela-id="' + idDaTabela + '" data-nome-tabela="' + nomeDaTabela + '" type="button">Excluir</button>'
                    + '<!--<button class="btn btn-success arrumar-tabela" id="btn_arrumar_tabela_' + nomeDaTabela + '"'
                    + 'data-tabela-id="' + idDaTabela + '" data-nome-tabela="' + nomeDaTabela + '" type="button">Arrumar</button>-->'
                    + '</div>';
        }

        /**
         * 
         * @param {type} idTabela
         * @param {type} incremento
         * @param {type} valores
         * @returns {String}
         */
        function addMuitasLinhas(idTabela, incremento, valores) {
            var index = (incremento + 1);

            codigo += '<tr id="linha_' + index + '">';
            codigo += '<td class="index-codigo coluna0">' + index + '</td>';
            codigo += '<td><input name="col[' + idTabela + '][' + index + '][nome]" value="' + valores + '"\n\
        required="" type="text" class="coluna1" /></td>';
            codigo += '<td>' + tipos(idTabela, (index)) + '</td>';
            if (index == 1) {
                codigo += '<td><input type="number" min="1" value="11" name="col[' + idTabela + '][' + index + '][quantidade]" class="span1 coluna3" /></td>';
            } else {
                codigo += '<td><input type="number" min="1" value="255" name="col[' + idTabela + '][' + index + '][quantidade]" class="span1 coluna3" /></td>';
            }
            codigo += '<td>' + isNulo() + '</td>';
            codigo += '<td>' + isAutoincremet() + '</td>';
            codigo += '<td>' + isPrimary() + '</td>';
            codigo += '<td><button class="btn btn-mini btn-danger" id="btn_excluir_linha' + idTabela + '_' + index + '" type="button">x</button></td>';
            codigo += '</tr>';
            return codigo;
        }

        /**
         * 
         * @param {type} _idIncrementalDaTabela
         * @returns {undefined}
         */
        function getMaxIdTabela(_idIncrementalDaTabela) {

            var yourArray = [];

            $("#tab-corpo-" + _idIncrementalDaTabela + " .index-codigo").each(function () {
                if (($.trim($(this).text()).length > 0)) {
                    yourArray.push($(this).text());
                }
            });

            return Math.max.apply(null, yourArray);
        }
        /**
         * 
         * @param {type} idTabela
         * @returns {String}
         */
        function setAddLinha(idTabela) {

            var index = getMaxIdTabela(idTabela) + 1;

            var codigo = '<tr id="linha_' + index + '">';
            codigo += '<td class="index-codigo coluna0">' + index + '</td>';
            codigo += '<td><input name="col[' + idTabela + '][' + index + '][nome]" value="' + index + '" type="text" class="coluna1" /></td>';
            codigo += '<td>' + tipos(idTabela, index) + '</td>';
            codigo += '<td><input type="number" min="1" value="255" name="col[' + idTabela + '][' + index + '][quantidade]" class="span1 coluna3" /></td>';
            codigo += '<td>' + isNulo() + '</td>';
            codigo += '<td>' + isAutoincremet() + '</td>';
            codigo += '<td>' + isPrimary() + '</td>';
            codigo += '<td><button class="btn btn-mini btn-danger" id="btn_excluir_linha' + idTabela + '_' + index + '" type="button">x</button></td>';
            codigo += '</tr>';
            return codigo;
        }

        //Adiciona as linhas com o laço de repetição FOR.
        for (_i = 0; _i < quantidadeDeLinhas; _i++) {
            if (_i == 0) {
                addMuitasLinhas(_IdDaTabela, _i, 'id');
            } else if (_i == 1) {
                addMuitasLinhas(_IdDaTabela, _i, 'nome');
            } else {
                addMuitasLinhas(_IdDaTabela, _i, prefixoDasColunas + (_i + 1));
            }
            var _ii = (_i + 1);
            codigo += "<script id='script_" + _IdDaTabela + '_' + _ii + "'>$('#btn_excluir_linha" + _IdDaTabela + '_' + _ii + "').click(function () {if (confirm('Deseja realmente excluir este registro?')){$('#linha_' + " + _ii + ").remove();$('#script_" + _IdDaTabela + '_' + _ii + "').remove();";
            codigo += "var _idTabela =" + _IdDaTabela + ";";
            codigo += "var __col0 = $('#tab-corpo-' + _idTabela).find('.coluna0');";
            codigo += "var __col1 = $('#tab-corpo-' + _idTabela).find('.coluna1');";
            codigo += "var __col2 = $('#tab-corpo-' + _idTabela).find('.coluna2');";
            codigo += "var __col3 = $('#tab-corpo-' + _idTabela).find('.coluna3');";
            codigo += "var _totalDeLinhas = $('#tab-corpo-' + _idTabela + ' tr').length - 1;";
            codigo += "for (var i = 0; i < _totalDeLinhas; i++) {";
            codigo += "var _index = (i + 1);";
            codigo += "$(__col0[i]).text(_index);";
            codigo += "$(__col1[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][nome]'});";
            codigo += "$(__col2[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][tipo]'});";
            codigo += "$(__col3[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][quantidade]'});";
            codigo += '}';
            codigo += "}});";

            codigo += "</script>";
        }

        codigo += '</table>';
        codigo += Funcoes(_IdDaTabela, nomeDaTabela);
        codigo += '<hr style="border:0px; border-top:1px solid #ccc;">';
//Script para clicar
        codigo += '<script id="myIdTaffarel_' + _IdDaTabela + '">';
        codigo += "$('#btn_excluir_tabela_" + nomeDaTabela + "').click(function () {";
        codigo += "var __idTabela = $(this).attr('data-tabela-id');";
        codigo += "var __nomeDaTabela = $(this).attr('data-nome-tabela');";
        codigo += "if (confirm('Deseja realmente excluir esta tabela?')) {";
        codigo += "tabelas.splice(tabelas.indexOf('" + nomeDaTabela + "'), 1 );";
        codigo += "_IdDaTabela--;";
        codigo += "$('#tabela_' + __nomeDaTabela + '_' + __idTabela).remove();";
        codigo += "}";
        codigo += "});";
//Arruma os índexes das colunas
        codigo += '$("#btn_arrumar_tabela_' + nomeDaTabela + '").click(function () {';
        codigo += "var _idTabela = $(this).attr('data-tabela-id');";
        codigo += "var __col0 = $('#tab-corpo-' + _idTabela).find('.coluna0');";
        codigo += "var __col1 = $('#tab-corpo-' + _idTabela).find('.coluna1');";
        codigo += "var __col2 = $('#tab-corpo-' + _idTabela).find('.coluna2');";
        codigo += "var __col3 = $('#tab-corpo-' + _idTabela).find('.coluna3');";
        codigo += "var _totalDeLinhas = $('#tab-corpo-' + _idTabela + ' tr').length - 1;";
        codigo += "for (var i = 0; i < _totalDeLinhas; i++) {";
        codigo += "var _index = (i + 1);";
        codigo += "$(__col0[i]).text(_index);";
        codigo += "$(__col1[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][nome]'});";
        codigo += "$(__col2[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][tipo]'});";
        codigo += "$(__col3[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][quantidade]'});";
        codigo += '}';
        codigo += '});';

        codigo += '</script>';

        codigo += '</div>';

        saida.append(codigo);

        $('.add-linha').click(function () {

            var _idTabela = $(this).attr('data-tabela-id');

            var _tBody = $('#tab_' + _idTabela);

            var index = getMaxIdTabela(_idTabela) + 1;

            var _codigo = "<script>$('#btn_excluir_linha" + _idTabela + '_' + index + "').click(function () {if (confirm('Deseja realmente excluir este registro?')){$('#linha_' + " + index + ").remove();}});</script>";

            _tBody.append(setAddLinha(_idTabela) + _codigo);

            var __col0 = $('#tab-corpo-' + _idTabela).find('.coluna0');
            var __col1 = $('#tab-corpo-' + _idTabela).find('.coluna1');
            var __col2 = $('#tab-corpo-' + _idTabela).find('.coluna2');
            var __col3 = $('#tab-corpo-' + _idTabela).find('.coluna3');
            var _totalDeLinhas = $('#tab-corpo-' + _idTabela + ' tr').length - 1;
            for (var i = 0; i < _totalDeLinhas; i++) {
                var _index = (i + 1);
                $(__col0[i]).text(_index);
                $(__col1[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][nome]'});
                $(__col2[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][tipo]'});
                $(__col3[i]).attr({name: 'col[' + _idTabela + '][' + _index + '][quantidade]'});
            }
        });

        $('.coluna1').click(function () {
            this.select();
        });
    }
} //--Fim addTabela

$("#btn_adicionar_tabela").click(function () {
    verificarSeTabelaExiste();
});

/**
 * <p>VERIFICA SE A TABELA DIGITA JÁ EXISTE.</p>
 * @returns {_tabelaExiste|Boolean}
 */
function verificarSeTabelaExiste() {
    var _this = $('#nome_da_tabela');
    $.post("../modelos/acoes.php", {
        tabela: _this.val().trim()
    }, function (data) {
        if (data == '1') {
            _tabelaExiste = true;
            _this.select();
            alert('A tabela ' + _this.val().trim() + ' já existe.');
            _this.val('');
        } else {
            addTabel();
        }
    });
    return _tabelaExiste;
}
//Add prefixo do nome da tabela.

$('#nome_da_tabela').keyup(function (ev) {
    var _thisValue = this.value.trim();
    $('#prefixo_das_colunas').val(_thisValue.substring(3, 0).toLowerCase() + '_');
    _tabelaExiste = false;
    if (ev.keyCode == 13) {
        verificarSeTabelaExiste();
    }
});




/**
 * 
 */
$('#nome_do_projeto').keyup(function (ev) {
    var _thisValor = this.value.trim();
    if (ev.keyCode == 13) {
        if (_thisValor === '') {
            alert('Preencha corretamente o nome do projeto.');
            return false;
        }
        $('#nome_da_tabela').focus();
    }
});



/**
 * <p>Reorganiza todos os índexes das tabelas</p>
 * @returns {undefined}
 */
function organizarTabela() {

    var tabelas = document.getElementsByClassName('tabela-crud-tx');

    for (var _i = 0; _i < tabelas.length; _i++) {

        var _rows = tabelas[_i].tBodies[0].rows;

        var _idTabela = tabelas[_i].tBodies[0].id.split('_');

        var _totalRows = _rows.length;

        for (var _x = 0; _x < _totalRows; _x++) {

            var _index = (_x + 1);

            $(_rows[_x].cells[0]).text(_index);
            $(_rows[_x].cells[1]).find('.coluna1').attr({name: 'col[' + _idTabela[1] + '][' + _index + '][nome]'});
            $(_rows[_x].cells[2]).find('.coluna2').attr({name: 'col[' + _idTabela[1] + '][' + _index + '][tipo]'});
            $(_rows[_x].cells[3]).find('.coluna3').attr({name: 'col[' + _idTabela[1] + '][' + _index + '][quantidade]'});
        }

    }
}

$(this).on('mousemove', function () {
    organizarTabela();
});

var btnCriarProjeto = $('.btn-criar-projeto');


//Enviado a requisição
$("#form_analisar").ajaxForm({
    beforeSend: function () {

        organizarTabela();
        btnCriarProjeto.attr('disabled', true).html('Salvando, aguarde, por favor...');
    },
    uploadProgress: function (event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
    },
    success: function (data) {
        $('#resultado_request').html(data);
        btnCriarProjeto.attr('disabled', false).html('<i class="fas fa-save"></i> Criar Projeto');
    },
    complete: function (xhr) {
        /*status.html(xhr.responseText);*/
    }
});