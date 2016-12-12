<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelContinuarAtualizacaoCadastral extends JModelForm
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

	public function basico($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->basicos = new stdclass();
		$precadastroCliente->basicos->tipoCliente_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->estadoCivil_id =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->cpfcnpj = preg_replace('/\D+/', '', ((isset($dados['']))?$dados['']:null));
		$precadastroCliente->basicos->inscricaoEstadual = preg_replace('/\D+/', '', ((isset($dados['']))?$dados['']:null));
		$precadastroCliente->basicos->nomeClienteConta = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->nome =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->razaoSocial = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->nomeFantasia = (isset($dados['']))?$dados['']:null; 
		$precadastroCliente->basicos->sexo =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->docIdentificacao =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->orgaoEmissor =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->dataNascimento = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->nomeMae =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->nomeConjuge =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->basicos->cpfConjuge = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complementares = new stdclass();
		$precadastroCliente->complementares->email =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complementares->dataCadastro =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complementares->autorizadoDescarteETE = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complementares->bloqueado =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complementares->nomeRepresentante =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complementares->cpfRepresentante = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->Socio = new stdclass();
		$precadastroCliente->Socio->id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->Socio->preCadastroCliente_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->Socio->nome = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->Socio->cpf = preg_replace('/\D+/', '', ((isset($dados['']))?$dados['']:null));
		$precadastroCliente->endereco = new stdclass();
		$precadastroCliente->endereco->tipoEndereco_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->pais_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->uf_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->tipoLogradouro_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->preCadastroclient_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->cep = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->bairro = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->cidade = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->enderecoCompleto = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->complemento = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->numero = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->longitude = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->latitude = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->ativo = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->correspondencia = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->endereco->dataCadastro = (isset($dados['']))?$dados['']:null;
		return $precadastroCliente;
	}

}
