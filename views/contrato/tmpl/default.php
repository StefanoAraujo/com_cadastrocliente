<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
$var = $this->getModel()->ListarCadastroCliente();
$var = $this->getModel()->ListarCadastroClienteSemArquivo();
$conteudo = $this->getModel()->getConteudo();
?>
<div class="container">
	<div class="row-fluid">
		<div class="span12" style="padding:20px">
			<h3><?php echo $conteudo->title; ?></h3>
			<p><?php echo $conteudo->introtext; ?></p>
		</div>
	</div>	
	<div class="row-fluid">
		<div class="span2">
		</div>
		<div class="span10">
			<fieldset>
				<legend>Filtro para Pesquisa</legend>
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span4"><label>Número de CadastroCliente</label><input type="text" id="buscaCadastroCliente" /></div>
						<div class="span4"><label>Ano do CadastroCliente</label><select id="buscaAno">
					  <?php echo $this->getModel()->getCadastroClienteAnoCadastroCliente(); ?>
					</select></div>
						<div class="span4"><label>Empresa Contratada</label><select id="buscaEmpresa">
						<?php echo $this->getModel()->getCadastroClienteEmpresaCadastroCliente(); ?>
					</select></div>
					</div>
					<div class="row-fluid">
						<div class="span4"><label>CNPJ da Contratada</label><input type="text" id="buscaCNPJ" /></div>
						<div class="span4"><label>Número do Processo</label><input type="text" id="buscaProcesso" /></div>
						<div class="span4"></div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
</div>
<div id="lista"></div>