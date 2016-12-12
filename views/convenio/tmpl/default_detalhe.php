<?php
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
$convenioDetalhe = JRequest::getVar('convenioDetalhe');
$cont = 0;
?>

<div class="row-fluid">
	<div class="span12" style="padding:20px">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Convênio</th>
					<th>Conveniado</th>
					<th>Processo</th>
					<th>Unidade Gestora</th>
					<th>Objeto</th>
					<th>Início Vigência</th>
					<th>Final Vigência</th>
					<th>Total da Contrapartida</th>
					<th>Total dos Recursos</th>
					<th>Valor do Repasse</th>
				</tr>
			</thead>
			<tbody>
				
					<?php foreach ($convenioDetalhe as $key) {
						$cont ++;	
						echo "<tr>";
						echo "<td>".$key->Convenio."</td>";
						echo "<td>".$key->Conveniado."</td>";
						echo "<td>".$key->Processo."</td>";
						echo "<td>".$key->UnidadeGestora."</td>";
						echo "<td>".$key->Objeto."</td>";
						echo "<td>".$key->InicioVigencia."</td>";
						echo "<td>".$key->FinalVigencia."</td>";
						echo "<td>".number_format($key->TotaldaContrapartida,2,",",".")."</td>";
						echo "<td>".number_format($key->TotaldosRecursos,2,",",".")."</td>";
						echo "<td>".number_format($key->ValordoRepasse,2,",",".")."</td>";
						echo "</tr>";
					} ?>
			</tbody>
		</table>
		Total de Registros encontrados: <?php 	echo $cont ?>	
	</div>
</div>