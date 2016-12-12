<?php
defined('_JEXEC') or die('Acesso Restrito!');
jimport('joomla.filter.output');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
$conveniado = JRequest::getVar('conveniado');
$conveniadoNome = JRequest::getVar('conveniadoNome');
JRequest::setVar('artigo' , JFactory::getApplication()->input->get('artigo', "", 'STRING'));
$cont = 0;
?>
<div class="row-fluid">
	<div class="span12" style="padding:20px">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Convênio</th>
					<th>Objeto</th>
				</tr>
			</thead>
			<tbody>
				
					<?php foreach ($conveniado as $key) {
						$cont ++;
						echo "<tr>";
						echo "<td><a href='".JRoute::_('index.php?option=com_cadastrocliente&view=convenio&task=convenio.detalhe&convenio='.$key->Convenio.'&'. JSession::getFormToken() .'=1&conveniado='.$conveniadoNome )."'>".$key->Convenio."<a></td>";
						echo "<td>".$key->Objeto."</td>";
						echo "</tr>";
					} ?>
			</tbody>
		</table>
		Total de Registros encontrados: <?php 	echo $cont ?>	
	</div>
</div>
