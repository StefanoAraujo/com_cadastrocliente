<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
?>
<div class="row-fluid">
	<div class="span12" style="padding-left: 5%;padding-right: 5%;">
		<div class="form-inline">
		  <?php foreach ($this->formulario['filtroprotocolo']->getFieldsets() as $fieldset): ?>
	     	  	<legend><?php echo  JText::_('COM_CADASTROCLIENTE_LABEL_TABLE_SOLICITACAOATUALIZACAO');$fields = $this->formulario['filtroprotocolo']->getFieldset($fieldset->name);?></legend>
	            <?php foreach($fields as $field): ?>
	                <?php if ($field->hidden): ?>
	                    <?php echo $field->input;?>
	                <?php else:?>
                    	<?php echo $field->label; ?>
						<?php echo $field->input;?>
	                <?php endif;?>
	            <?php endforeach;?>
	    	<?php endforeach;?>
		  <button class="btn btn-primary" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12" style="padding-left: 5%;padding-right: 5%; ">
		<table class="table table-striped " style="margin-top: 15px;padding-top: 15px">
			<thead>
				<tr>
					<th colspan="5" style="text-align: center"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_TABLE_REGISTROENCONTRADO'); ?></th>
				<tr>
					<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_TABLE_PROTOCOLO'); ?></th>
					<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_TABLE_DATASOLICITACAO'); ?></th>
					<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_TABLE_DATAAPROVACAO'); ?></th>
					<th><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_TABLE_SITUACAOATUAL'); ?></th>
					<th><?php echo Jtext::_(''); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
					<td>
						<div class="btn-group">
			                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
			                <ul class="dropdown-menu">
								<li><a href="#">ACAO</a></li>
			                </ul>
		              	</div>
					</td>
				</tr>
			</tbody>
			</table>
			<div class="pagination" style="text-align: center">
			  <ul>
			    <li><a href="#"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
			    <li><a href="#">1</a></li>
			    <li><a href="#">2</a></li>
			    <li><a href="#">3</a></li>
			    <li><a href="#">4</a></li>
			    <li><a href="#">5</a></li>
			    <li><a href="#"><i class="fa fa-forward" aria-hidden="true"></i></a></li>
			  </ul>
			</div>
	</div>
</div>
