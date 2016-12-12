<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
class JFormFieldcpfcnpj extends JFormFieldList
{

	protected $type = 'cpfcnpj';
	
	public function getLista(){
			return'<label class="checkbox inline">
			  <input type="checkbox" id="inlineCheckbox1" value="optCPFCNPJ"> COM_CADASTROCLIENTE_LABEL_FORM_CPF
			</label>
			<label class="checkbox inline">
			  <input type="checkbox" id="inlineCheckbox1" value="optCPFCNPJ"> COM_CADASTROCLIENTE_LABEL_FORM_CNPJ
			</label>'	;
	}

	protected function getOptions()
	{
		$options=$this->getLista();
		return $options;
		
	}
}
?>