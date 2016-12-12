<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
?>
<style type="text/css">
    #cadastro .control-group{
        margin-bottom: 0px;
    }
    .accordion-heading{
        background-color: #eeeeee;
    }

    .collapse.in {
        height: auto;  /* this style already exists in bootstrap.css */
        overflow: visible;  /* this one doesn't. Add it! */

    }
    .panel-group .panel
    {
        overflow: visible;
    }

    .table.table-striped {
        border-collapse:separate;
        border: solid #eeeeee 1px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        margin-top: 15px;
    }

   .table.table-striped > thead
    {
        border-collapse:separate;
        color: whitesmoke;
        background-color: #004877;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .table.table-striped > thead > tr > th
    {
        padding-top:20px;
    }

    .btn-group.open .dropdown-menu {
        display: block;
        margin-top: 1px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #004877;
    }

    .btn-group.open .dropdown-menu > li >  a:hover {
        color: #FFF !important;
        text-decoration: none !important;
        background: #0088cc !important;
    }


</style>
<div class="row-fluid">
    <div class="span12" style="padding: 5%">
        <form action="" id="cadastro" method="post" class="form-validate form-horizontal">
            <div class="accordion" id="atualizaCadastro">
                <div class="accordion-group">
                    <fieldset>
                        <?php foreach ($this->formulario['dadosbasicospf']->getFieldsets() as $fieldset): ?>
                            <div class="accordion-heading">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#atualizaCadastro" href="#dadosbasicos">
                                    <?php echo  JText::_($fieldset->label);$fields = $this->formulario['dadosbasicospf']->getFieldset($fieldset->name);?>
                                </a>
                            </div>
                            <div id="dadosbasicos" class="accordion-body collapse" style="height: 0px;">
                                <div class="accordion-inner">
                                    <?php foreach($fields as $field): ?>
                                        <div class="control-group">
                                            <?php if ($field->hidden): ?>
                                                <div class="controls">
                                                    <?php echo $field->input;?>
                                                </div>
                                            <?php else:?>
                                                <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                                                <div class="controls">
                                                    <?php echo $field->input;?>
                                                    <span class="help-block" style="margin-bottom: 15px"></span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </fieldset>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#atualizaCadastro" href="#dadosendereco">
                            <?php echo  JText::_('COM_CADASTROCLIENTE_LABEL_FORM_DADOSENDERECO'); ?>
                        </a>
                    </div>
                    <div id="dadosendereco" class="accordion-body collapse" style="height: 0px;">
                        <div class="accordion-inner">
                            <style>
                                .bordaCadastro
                                {
                                    margin: 15px;
                                    border: 1px solid #e5e5e5;
                                    -webkit-border-radius: 4px;
                                    -moz-border-radius: 4px;
                                    border-radius: 4px;
                                }
                                .bordaCadastroHead
                                {
                                    border-bottom: 0;
                                    padding: 5px 10px 5px 10px;
                                    background-color: #eeeeee;
                                }

                                .bordaCadastroCorpo
                                {
                                    padding: 15px;
                                }

                                .bordaCadastroCorpo>div>table>tbody>tr>th
                                {
                                    padding: 5px;
                                    text-align: right;
                                }
                                .bordaCadastroCorpo>div>table>tbody>tr>td
                                {
                                    padding: 5px;
                                }
                            </style>
                            <div style="text-align: right;    padding-right: 15px;"><a href="#cadastrarEndereco" id="btncadend" role="button" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus fa-3" aria-hidden="true"></i><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_NOVOENDERECO'); ?></a></div>
                            <div class="bordaCadastro">

                                <div class="bordaCadastroHead">Endereco 01</div>
                                <div class="bordaCadastroCorpo" id="loadEndereco1">
                                </div>
                            </div>
                            <table class="table table-striped " >
                                <thead>
                                <tr>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_TIPOENDERECO'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_CEP_CORREIOS'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_LOGRADOURO'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_CIDADE'); ?></th>
                                    <th><?php echo Jtext::_(''); ?></th>
                                </tr>
                                </thead>
                                <tbody id="loadEndereco">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#atualizaCadastro" href="#dadoscontato">
                            <?php echo  JText::_('COM_CADASTROCLIENTE_LABEL_FORM_CONTATO'); ?>
                        </a>
                    </div>
                    <div id="dadoscontato" class="accordion-body collapse" style="height: 0px;">
                        <div class="accordion-inner">
                            <div style="text-align: right;padding-right: 15px"><a href="#cadastrarContato" role="button" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus fa-3" aria-hidden="true"></i><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_NOVOCONTATO'); ?></a></div>
                            <table class="table table-striped ">
                                <thead>
                                <tr>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_NOME'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_TIPO'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_TELEFONE'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_PRINCIPAL'); ?></th>
                                    <th><?php echo Jtext::_(''); ?></th>
                                </tr>
                                </thead>
                                <tbody id="loadcontato">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#atualizaCadastro" href="#dadoscomplementarespf">
                            <?php echo  JText::_('COM_CADASTROCLIENTE_LABEL_FORM_DADOSCOMPLEMENTARES'); ?>
                        </a>
                    </div>
                    <div id="dadoscomplementarespf" class="accordion-body collapse" style="height: 0px;">
                        <div class="accordion-inner">
                            <fieldset>
                                <?php foreach ($this->formulario['dadoscomplementarespf']->getFieldsets() as $fieldset): ?>
                                    <?php $fields = $this->formulario['dadoscomplementarespf']->getFieldset($fieldset->name);?>
                                    <?php foreach($fields as $field): ?>
                                        <div class="control-group">
                                            <?php if ($field->hidden): ?>
                                                <div class="controls">
                                                    <?php echo $field->input;?>
                                                </div>
                                            <?php else:?>
                                                <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                                                <div class="controls">
                                                    <?php echo $field->input;?>
                                                    <span class="help-block" style="margin-bottom: 15px"></span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#atualizaCadastro" href="#dadosanexo">
                            <?php echo  JText::_('COM_CADASTROCLIENTE_LABEL_FORM_ANEXOS'); ?>
                        </a>
                    </div>
                    <div id="dadosanexo" class="accordion-body collapse" style="height: 0px;">
                        <div class="accordion-inner">
                            <a href="#cadastrarAnexo" role="button" class="btn btn-primary" data-toggle="modal"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_BTN_ANEXAR'); ?></a>
                            <table class="table table-striped " >
                                <thead>
                                <tr>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_ARQUIVO'); ?></th>
                                    <th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_DESCRICAO'); ?></th>
                                    <th><?php echo Jtext::_(''); ?></th>
                                </tr>
                                </thead>
                                <tbody id="loadArquivo"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_NENHUMARQUIVO'); ?>
                                </tbody>
                            </table>
                            <?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_ARQUIVOANEXO'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align: center">
                <?php echo JHtml::_( 'form.token' ); ?>
                <input type="hidden" name="task" value='cadastrocliente.atualizar'>
                <input type="submit" name="rascunho" class="btn btn-primary" value="<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_BTN_SALVAR_RASCUNHO'); ?>">
                <input type="submit" name="finalizar" class="btn btn-primary" value="<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_BTN_FINALIZAR_CADASTRO'); ?>">
        </form>
    </div>
</div>


<div id="cadastrarEndereco" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="cadastrarEnderecoLabel" aria-hidden="true">
    <form action="" id="enderecoform" method="post" class="form-validate form-horizontal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="cadastrarEnderecoLabel"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_CADASTROENDERECO'); ?></h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal">

                <fieldset>
                    <?php foreach ($this->formulario['dadosenderecopf']->getFieldsets() as $fieldset): ?>
                        <?php $fields = $this->formulario['dadosenderecopf']->getFieldset($fieldset->name);?>
                        <?php foreach($fields as $field): ?>
                            <div class="control-group">
                                <?php if ($field->hidden): ?>
                                    <div class="controls">
                                        <?php echo $field->input;?>
                                    </div>
                                <?php else:?>
                                    <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                                    <div class="controls">
                                        <?php echo $field->input;?>
                                        <span class="help-block" style="margin-bottom: 15px"></span>
                                    </div>
                                <?php endif;?>
                            </div>
                        <?php endforeach;?>
                    <?php endforeach;?>
                    <?php echo JHtml::_( 'form.token' ); ?>
                    <input type="hidden" name="task" value='cadastrocliente.incluirEndereco'>
                </fieldset>

        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="submit" class="btn btn-primary"><?php echo Jtext::_("COM_CADASTROCLIENTE_LABEL_BTN_SALVAR"); ?></button>
    </div>
    </form>
</div>
<script type="text/javascript">
    var endereco = jQuery.noConflict();
    endereco(document).ready(function(){
        endereco('#enderecoform').submit(function(){
            var dados = endereco( this ).serialize();
            endereco.ajax({
                type: "POST",
                url: "",
                beforeSend: function(){
                    endereco('#submit').attr('disabled', 'true');
                },
                data: dados,
                success: function( data )
                {
                    alert( data );
                    //funcao atualiza lista de endereco

                },
                complete: function(){
                    endereco("#cadastrarEndereco").modal('hide');
                    endereco('#enderecoform')[0].reset();
                    endereco('#submit').removeAttr('disabled');
                    endereco('#loadEndereco').listarEndereco();
                    endereco('#loadEndereco1').exibirEndereco();
                }
            });

            return false;
        });
    });
</script>

<div id="EditarEndereco" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EditarEnderecoLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="EditarEnderecoLabel"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_EDICAOENDERECO'); ?></h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal">
            <fieldset>
                <?php foreach ($this->formulario['dadosenderecopf']->getFieldsets() as $fieldset): ?>
                    <?php $fields = $this->formulario['dadosenderecopf']->getFieldset($fieldset->name);?>
                    <?php foreach($fields as $field): ?>
                        <div class="control-group">
                            <?php if ($field->hidden): ?>
                                <div class="controls">
                                    <?php echo $field->input;?>
                                </div>
                            <?php else:?>
                                <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                                <div class="controls">
                                    <?php echo $field->input;?>
                                    <span class="help-block" style="margin-bottom: 15px"></span>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                <?php endforeach;?>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>


<div id="VisualizarEndereco" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="VisualizarEnderecoLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="VisualizarEnderecoLabel"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_VISUALIZACAOENDERECO'); ?></h3>
    </div>
    <div class="modal-body">
        <fieldset>
            <?php foreach ($this->formulario['dadosenderecopf']->getFieldsets() as $fieldset): ?>
                <?php $fields = $this->formulario['dadosenderecopf']->getFieldset($fieldset->name);?>
                <?php foreach($fields as $field): ?>
                    <div class="control-group">
                        <?php if ($field->hidden): ?>
                            <div class="controls">
                                <?php echo $field->input;?>
                            </div>
                        <?php else:?>
                            <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                            <div class="controls">
                                <?php echo $field->input;?>
                                <span class="help-block" style="margin-bottom: 15px"></span>
                            </div>
                        <?php endif;?>
                    </div>
                <?php endforeach;?>
            <?php endforeach;?>
        </fieldset>
    </div>
</div>



<div id="cadastrarAnexo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="cadastrarAnexoLabel" aria-hidden="true">
    <form action="" id="cadastrarAnexoform" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="cadastrarAnexoLabel"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_BTN_CADASTRARANEXO'); ?></h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal">
            <fieldset>
                <?php foreach ($this->formulario['anexo']->getFieldsets() as $fieldset): ?>
                    <?php $fields = $this->formulario['anexo']->getFieldset($fieldset->name);?>
                    <?php foreach($fields as $field): ?>
                        <div class="control-group">
                            <?php if ($field->hidden): ?>
                                <div class="controls">
                                    <?php echo $field->input;?>
                                </div>
                            <?php else:?>
                                <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                                <div class="controls">
                                    <?php echo $field->input;?>
                                    <span class="help-block" style="margin-bottom: 15px"></span>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                <?php endforeach;?>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <?php echo JHtml::_( 'form.token' ); ?>
        <input type="hidden" name="task" value='cadastrocliente.cadastrarAnexo'>
        <button type="submit" id="submitArquivo" class="btn btn-primary"><?php echo Jtext::_("COM_CADASTROCLIENTE_LABEL_BTN_SALVAR"); ?></button>
    </div>
    </form>
</div>
<script type="text/javascript">
    var endereco = jQuery.noConflict();
    endereco(document).ready(function(){
        endereco('#cadastrarAnexoform').submit(function(){
            var dados;
            var contentType = "application/x-www-form-urlencoded";
            var processData = true;
            if (endereco(this).attr('enctype') == 'multipart/form-data') {
                dados = new FormData(endereco('#cadastrarAnexoform').get(0));//seleciona classe form-horizontal adicionada na tag form do html
                contentType = false;
                processData = false;
            } else {
                dados = endereco(this).serialize();
            }
            endereco.ajax({
                type: "POST",
                data: dados,
                url: "",
                contentType: contentType,
                processData: processData,
                beforeSend: function(){
                    endereco('#submitArquivo').attr('disabled', 'true');
                },
                success: function( data )
                {

                    alert( "Arquivo salvo com sucesso1" );
                },
                complete: function(){
                    endereco("#cadastrarAnexo").modal('hide');
                    endereco('#cadastrarAnexoform')[0].reset();
                    endereco('#submitArquivo').removeAttr('disabled');
                    endereco('#loadArquivo').listarArquivo();
                }
            });

            return false;
        });
    });
</script>

<div id="cadastrarContato" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="cadastrarContatoLabel" aria-hidden="true">
    <form action="" id="contatoform" method="post" class="form-validate form-horizontal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="cadastrarContatoLabel"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_BTN_CADASTRARACONTATO'); ?></h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal">
            <fieldset>
                <?php foreach ($this->formulario['dadoscontato']->getFieldsets() as $fieldset): ?>
                    <?php $fields = $this->formulario['dadoscontato']->getFieldset($fieldset->name);?>
                    <?php foreach($fields as $field): ?>
                        <div class="control-group">
                            <?php if ($field->hidden): ?>
                                <div class="controls">
                                    <?php echo $field->input;?>
                                </div>
                            <?php else:?>
                                <?php echo str_replace("class", "class='control-label'", $field->label) ?>
                                <div class="controls">
                                    <?php echo $field->input;?>
                                    <span class="help-block" style="margin-bottom: 15px"></span>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                <?php endforeach;?>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <?php echo JHtml::_( 'form.token' ); ?>
        <input type="hidden" name="task" value='cadastrocliente.incluirContato'>
        <button type="submit" id="submitcontato" class="btn btn-primary"><?php echo Jtext::_("COM_CADASTROCLIENTE_LABEL_BTN_SALVAR"); ?></button>
    </div>
    </form>
</div>
<script type="text/javascript">
    var contato = jQuery.noConflict();
    contato(document).ready(function(){
        contato('#contatoform').submit(function(){
            var dados = contato( this ).serialize();
            contato.ajax({
                type: "POST",
                url: "",
                beforeSend: function(){
                    contato('#submitcontato').attr('disabled', 'true');
                },
                data: dados,
                success: function( data )
                {
                    alert( data );

                },
                complete: function(){
                    contato("#cadastrarContato").modal('hide');
                    contato('#contatoform')[0].reset();
                    contato('#submitcontato').removeAttr('disabled');
                    contato('#loadcontato').listarContato();
                }
            });

            return false;
        });
    });
</script>


<script>
    var acesso = jQuery.noConflict();
    acesso.fn.extend({
        exibirEndereco: function () {
            return this.each(function () {
                retornoPrincipalEndereco = "";
                acesso.ajax({
                    type: "POST",
                    url: "",
                    beforeSend: function(){
                    },
                    data: {
                        task:"cadastrocliente.listarPrincipalEndereco",
                        '<?php echo JSession::getFormToken()	 ?>': 1,
                    },
                    dataType: "json",
                    async : false,
                    success: function( data )
                    {
                       // console.log(data);
                        retornoPrincipalEndereco += "<div class='pull-right'><a href='#EditarEndereco' role='button' class='btn "+data.conteudo.tipoEndereco_id+"' data-toggle='modal'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>";
                        retornoPrincipalEndereco += "<div>";
                        retornoPrincipalEndereco += "<table >";
                        // acesso.each(data.conteudo, function(i, item) {
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_TIPOENDERECO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.tipoEndereco_id+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_PAIS') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.pais_id+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_CEP') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.cep+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_LOGRADOURO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.tipoLogradouro_id+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_LOGRADOURO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.enderecoCompleto+" "+data.conteudo.numero+" "+data.conteudo.cidade+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_COMPLEMENTO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.complemento+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_BAIRRO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.bairro+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_LOCALIDADE_UF') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.uf_id+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_COORD_GEOGRAFICA') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.latitude+" "+data.conteudo.longitude+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_SITUACAOENDERECO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.ativo+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_SITUACAOENDERECO') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.id+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        retornoPrincipalEndereco += "<tr>";
                        retornoPrincipalEndereco += "<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_CORRESPONDENCIA') ?></th>";
                        retornoPrincipalEndereco += "<td>"+data.conteudo.correspondencia+"</td>";
                        retornoPrincipalEndereco += "</tr>";
                        // });
                        retornoPrincipalEndereco += "</table>";
                        retornoPrincipalEndereco += "</div>";



                    },
                    complete: function(){
                    }
                });
                acesso(this).html("");
                acesso(this).html("Carregando dados...");
                acesso(this).html(retornoPrincipalEndereco);
            });
        },
        listarEndereco: function () {
            return this.each(function () {
                retornoEndereco = "";
                acesso.ajax({
                    type: "POST",
                    url: "",
                    beforeSend: function(){
                    },
                    data: {
                        task:"cadastrocliente.listarEndereco",
                        '<?php echo JSession::getFormToken()	 ?>': 1,
                    },
                    dataType: "json",
                    async : false,
                    success: function( data )
                    {
                        //console.log(data);
                        acesso.each(data.conteudo, function(i, item) {
                            retornoEndereco += "<tr>";
                            retornoEndereco += "<td>"+data.conteudo[i].tipoEndereco_id+"</td>";
                            retornoEndereco += "<td>"+data.conteudo[i].cep+"</td>";
                            retornoEndereco += "<td>"+data.conteudo[i].enderecoCompleto+" "+ data.conteudo[i].enderecoCompleto+" "+ data.conteudo[i].numero+" "+ data.conteudo[i].complemento+"</td>";
                            retornoEndereco += "<td>"+data.conteudo[i].cidade+"</td>";
                            retornoEndereco += "<th>";
                            retornoEndereco += "<div class='btn-group'>";
                            retornoEndereco += "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>";
                            retornoEndereco += "<ul class='dropdown-menu'>";
                            retornoEndereco += "<li><a href='#' class='excluirEndereco' data-exclusao='"+data.conteudo[i].id+"'>Alterar</a>";
                            retornoEndereco += "</li>";
                            retornoEndereco += "<li><a href='#' class='excluirEndereco' data-exclusao='"+data.conteudo[i].id+"'>Excluir</a></li>";
                            retornoEndereco += "</ul>";
                            retornoEndereco += "</div>";
                            retornoEndereco += "</th>";
                            retornoEndereco += "</tr>";

                        });
                    },
                    complete: function(){
                    }
                });
                acesso(this).html("");
                acesso(this).html("Carregando dados...");
                acesso(this).html(retornoEndereco);
            });
        },
        listarContato: function () {
            return this.each(function () {
                retornoContato = "";
                acesso.ajax({
                    type: "POST",
                    url: "",
                    beforeSend: function(){
                    },
                    data: {
                        task:"cadastrocliente.listarContato",
                        '<?php echo JSession::getFormToken()	 ?>': 1,
                    },
                    dataType: "json",
                    async : false,
                    success: function( data )
                    {
                        //console.log(data);
                        acesso.each(data.conteudo, function(i, item) {
                            retornoContato += "<tr>";
                            retornoContato += "<td>"+data.conteudo[i].nome+"</td>";
                            retornoContato += "<td>"+data.conteudo[i].tipoTelefone_id+"</td>";
                            retornoContato += "<td>"+data.conteudo[i].ddd+""+data.conteudo[i].numero+"</td>";
                            retornoContato += "<td>"+data.conteudo[i].principal+"</td>";
                            retornoContato += "<th>";
                            retornoContato += "<div class='btn-group'>";
                            retornoContato += "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>";
                            retornoContato += "<ul class='dropdown-menu'>";
                            retornoContato += "<li><a href='#' class='excluirContato' data-exclusao='"+data.conteudo[i].id+"'>Alterar</a></li>";
                            retornoContato += "<li><a href='#' class='excluirContato' data-exclusao='"+data.conteudo[i].id+"'>Excluir</a></li>";
                            retornoContato += "</ul>";
                            retornoContato += "</div>";
                            retornoContato += "</th>";
                            retornoContato += "</tr>";
                        });
                    },
                    complete: function(){
                    }
                });
                acesso(this).html("");
                acesso(this).html("Carregando dados...");
                acesso(this).html(retornoContato);
            });
        },
        listarArquivo: function () {
                return this.each(function () {
                    retornoArquivo = "";
                    acesso.ajax({
                        type: "POST",
                        url: "",
                        beforeSend: function(){
                        },
                        data: {
                            task:"cadastrocliente.listarAnexo",
                            '<?php echo JSession::getFormToken()	 ?>': 1,
                        },
                        dataType: "json",
                        async : false,
                        success: function( data )
                        {
                            acesso.each(data.conteudo, function(i, item) {
                                retornoArquivo += "<tr>";
                                retornoArquivo += "<td>"+data.conteudo[i].arquivoGCOM_id+"</td>";
                                retornoArquivo += "<td>"+data.conteudo[i].preCadastroCliente_id+"</td>";
                                retornoContato += "<th>";
                                retornoContato += "<div class='btn-group'>";
                                retornoContato += "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>";
                                retornoContato += "<ul class='dropdown-menu'>";
                                retornoContato += "<li><a href='#' class='excluirAnexo' data-exclusao='"+data.conteudo[i].id+"'>Alterar</a></li>";
                                retornoContato += "<li><a href='#' class='excluirAnexo' data-exclusao='"+data.conteudo[i].id+"'>Excluir</a></li>";
                                retornoContato += "</ul>";
                                retornoContato += "</div>";
                                retornoContato += "</th>";
                                retornoArquivo += "</tr>";

                            });
                        },
                        complete: function(){
                        }
                    });
                    acesso(this).html("");
                    acesso(this).html("Carregando dados...");
                    acesso(this).html(retornoArquivo);
                });
            },
    });
</script>

<script>
    var loadpage = jQuery.noConflict();
    loadpage(document).ready(function() {
        loadpage('#dadosbasicos').collapse('show');
        loadpage('#dadosendereco').collapse('show');
        loadpage('#dadoscontato').collapse('show');
        loadpage('#dadoscomplementarespf').collapse('show');
        loadpage('#dadosanexo').collapse('show');
        loadpage('#loadEndereco').listarEndereco();
        loadpage('#loadcontato').listarContato();
        loadpage('#loadArquivo').listarArquivo();
        loadpage('#loadEndereco1').exibirEndereco();
    });
</script>

<script>
    var acesso = jQuery.noConflict();
    acesso(document).ready(function(){
        acesso(document).on('click', '.excluirEndereco', function(){
            var id = acesso(this).data('exclusao');
            acesso.ajax({
                type: "POST",
                url: "",
                beforeSend: function(){
                },
                data: {
                    id: id,
                    task:"cadastrocliente.excluirEndereco",
                    '<?php echo JSession::getFormToken()	 ?>': 1,
                },
                dataType: "json",
                async : false,
                success: function( data )
                {
                   // console.log(data);
                },
                complete: function(){
                    acesso('#loadEndereco').listarEndereco();
                    acesso('#loadEndereco1').exibirEndereco();
                }
            });
        });
    });
    acesso(document).ready(function(){
        acesso(document).on('click', '.excluirContato', function(){
            var id = acesso(this).data('exclusao');
            acesso.ajax({
                type: "POST",
                url: "",
                beforeSend: function(){
                },
                data: {
                    id: id,
                    task:"cadastrocliente.excluirContato",
                    '<?php echo JSession::getFormToken()	 ?>': 1,
                },
                dataType: "json",
                async : false,
                success: function( data )
                {
                  //  console.log(data);
                },
                complete: function(){
                    acesso('#loadcontato').listarContato();
                }
            });
        });
    });
    acesso(document).ready(function(){
        acesso(document).on('click', '.excluirAnexo', function(){
            var id = acesso(this).data('exclusao');
            acesso.ajax({
                type: "POST",
                url: "",
                beforeSend: function(){
                },
                data: {
                    id: id,
                    task:"cadastrocliente.excluirAnexo",
                    '<?php echo JSession::getFormToken()	 ?>': 1,
                },
                dataType: "json",
                async : false,
                success: function( data )
                {
                    //  console.log(data);
                },
                complete: function(){
                    acesso('#loadArquivo').listarArquivo();
                }
            });
        });
    });
</script>
</div>