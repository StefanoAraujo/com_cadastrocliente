<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelPesquisarDiagnostico extends JModelForm
{
	public function getForm($data = array(), $loadData = true)
	{

	}

	public function getFormulario($string)
	{
		$formulario = $this->loadForm("com_cadastrocliente.$string", "$string", array('control' => '$string', 'load_data' => true));
		if (empty($formulario)) {
			return false;
		}
		return $formulario;
	}

	public function selecionar(){

		$query =  "SELECT 	*  FROM login Where 	cpfcnpj= , senha = ";
		//echo "teste";
	
	}

	static function inserir(){

		$query =  "SELECT 	*  FROM login Where 	cpfcnpj= , senha = ";
	
	}

	static function alterar(){

		$query =  'UPDATE login
		   SET cpfCnpj = ""
		      ,inscricaoEstadual = ""
		      ,nome = ""
		      ,dataNascimento] = ""
		      ,email = ""
		      ,senha = ""
		      ,dataCadastro = ""
		 WHERE id = ""';
	
	}

}
