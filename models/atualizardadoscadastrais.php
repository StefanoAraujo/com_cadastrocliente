<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelAtualizarDadosCadastrais extends JModelForm
{
	private function redirecionar($RetornoMensagem, $view = null)
	{

		$application = JFactory::getApplication();
		$url = ($view) ? JRoute::_('index.php?option=com_cadastrocliente&view='.$view): JURI::current();
		$application->redirect($url, $RetornoMensagem, $msgType='message');
	}

	// tipo: erro, sucesso, informacao
	private function criarAlerta($menssagem, $tipo=informacao)
	{
		switch ($tipo) {
			case 'erro':$tipo = "error";break;
			case 'sucesso':$tipo = "success";break;
			default:$tipo = "info";break;
		}
		return "<div class='alert alert-".$tipo."'>".$menssagem."<div>";
	}

	private function criarExececao($erro)
	{
		throw new Exception(SELF::criarAlerta(Jtext::_($erro), "erro"));
	}
	public function getForm($data = array(), $loadData = true)
	{

	}

	public function getFormulario($string)
	{
		$formulario = $this->loadForm("com_cadastrocliente".$string, $string, array('control' => $string, 'load_data' => true));
		if (empty($formulario)) {
			return false;
		}
		return $formulario;
	}

	public function formularioEndereco()
	{
		$formulario = $this->loadForm("com_cadastroclientedadosenderecopf", "dadosenderecopf", array('control' => "dadosenderecopf", 'load_data' => true));
		if (empty($formulario)) {
			return false;
		}
		$entrada = JFactory::getApplication()->input;
       // $dados = $entrada->post->get("id","", 'INT');
        $dados = $entrada->get->get("id","", 'INT');
		$sqlQuery = "SELECT * FROM telefonePreCadastroCliente WHERE id=".$dados;
		$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($sqlQuery); 
		   	if ($soapcliente->sucesso==true) {
		   		var_dump($soapcliente->conteudo[0]);
		   		$formulario->setValue('tipoTelefone_id', null, $soapcliente->conteudo[0]->tipoTelefone_id);
				$formulario->setValue('pais_id', null, $soapcliente->conteudo[0]->pais_id);
				$formulario->setValue('preCadastroCliente_id', null, $soapcliente->conteudo[0]->preCadastroCliente_id);
				$formulario->setValue('nome', null, $soapcliente->conteudo[0]->nome);
				$formulario->setValue('ddd', null, $soapcliente->conteudo[0]->ddd);
				$formulario->setValue('numero', null, $soapcliente->conteudo[0]->numero);
				$formulario->setValue('ramal', null, $soapcliente->conteudo[0]->ramal);
				$formulario->setValue('principal', null, $soapcliente->conteudo[0]->principal);
				$formulario->setValue('nacional', null, $soapcliente->conteudo[0]->nacional);
	   		}
	   		else{
	   			return false;
	   		}
		?>
		<div id="EditarEndereco" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EditarEnderecoLabel" aria-hidden="true">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        <h3 id="EditarEnderecoLabel"><?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_EDICAOENDERECO'); ?></h3>
	    </div>
	    <div class="modal-body">
	        <div class="form-horizontal">
	            <fieldset>
	                <?php foreach ($formulario->getFieldsets() as $fieldset): ?>
	                    <?php $fields = $formulario->getFieldset($fieldset->name);?>
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
		<?php 
		die();
	}

	public function formularioContato()
	{
		$formulario = $this->loadForm("com_cadastroclientedadoscontato", "dadoscontato", array('control' => "dadoscontato", 'load_data' => true));
		if (empty($formulario)) {
			return false;
		}
		$entrada = JFactory::getApplication()->input;
       // $dados = $entrada->post->get("id","", 'INT');
        $dados = $entrada->get->get("id","", 'INT');
		$sqlQuery = "SELECT * FROM telefonePreCadastroCliente WHERE id=".$dados;
		$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($sqlQuery); 
		   	if ($soapcliente->sucesso==true) {
		   		$formulario->setValue('tipoTelefone_id', null, $soapcliente->conteudo[0]->tipoTelefone_id);
				$formulario->setValue('pais_id', null, $soapcliente->conteudo[0]->pais_id);
				$formulario->setValue('preCadastroCliente_id', null, $soapcliente->conteudo[0]->preCadastroCliente_id);
				$formulario->setValue('nome', null, $soapcliente->conteudo[0]->nome);
				$formulario->setValue('ddd', null, $soapcliente->conteudo[0]->ddd);
				$formulario->setValue('numero', null, $soapcliente->conteudo[0]->numero);
				$formulario->setValue('ramal', null, $soapcliente->conteudo[0]->ramal);
				$formulario->setValue('principal', null, $soapcliente->conteudo[0]->principal);
				$formulario->setValue('nacional', null, $soapcliente->conteudo[0]->nacional);
	   		}
	   		else{
	   			return false;
	   		}
		?>
		<fieldset>
            <?php foreach ($formulario->getFieldsets() as $fieldset): ?>
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#atualizaCadastro" href="#dadosbasicos">
                        <?php echo  JText::_($fieldset->label);$fields = $formulario->getFieldset($fieldset->name);?>
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
		<?php 
		die();
	}

	public function basicoInicial($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->tipoCliente_id = (isset($dados['cpfcnpj']) and strlen($dados['cpfcnpj'])==11)?1:2;
		$precadastroCliente->cpfcnpj = preg_replace('/\D+/', '', ((isset($dados['cpfcnpj']))?$dados['cpfcnpj']:null));
		return $precadastroCliente;
	}

	public function basico($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->tipoCliente_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->estadoCivil_id =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->cpfcnpj = preg_replace('/\D+/', '', ((isset($dados['']))?$dados['']:null));
		$precadastroCliente->inscricaoEstadual = preg_replace('/\D+/', '', ((isset($dados['']))?$dados['']:null));
		$precadastroCliente->nomeClienteConta = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->nome =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->razaoSocial = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->nomeFantasia = (isset($dados['']))?$dados['']:null; 
		$precadastroCliente->sexo =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->docIdentificacao =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->orgaoEmissor =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->dataNascimento = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->nomeMae =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->nomeConjuge =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->cpfConjuge = (isset($dados['']))?$dados['']:null;
		return $precadastroCliente;
	}

		public function complementar($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->email =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->dataCadastro =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->autorizadoDescarteETE = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->bloqueado =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->nomeRepresentante =  (isset($dados['']))?$dados['']:null;
		$precadastroCliente->cpfRepresentante = (isset($dados['']))?$dados['']:null;
		return $precadastroCliente;
	}

	public function socio($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->preCadastroCliente_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->nome = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->cpf = preg_replace('/\D+/', '', ((isset($dados['']))?$dados['']:null));
		return $precadastroCliente;
	}

	public function endereco($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->tipoEndereco_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->pais_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->uf_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->tipoLogradouro_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->preCadastroclient_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->cep = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->bairro = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->cidade = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->enderecoCompleto = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->complemento = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->numero = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->longitude = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->latitude = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->ativo = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->correspondencia = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->dataCadastro = (isset($dados['']))?$dados['']:null;
		return $precadastroCliente;
	}

	public function arquivo($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$precadastroCliente = new stdclass();
		$precadastroCliente->arquivoGCOM_id = (isset($dados['']))?$dados['']:null;
		$precadastroCliente->precadastroCliente_id= (isset($dados['']))?$dados['']:null;
		return $precadastroCliente;
	}

/**
Consultas Cadastro complementar
*/

	public function incluirCadastroBasicoInicial()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query="INSERT INTO preCadastroCliente
					            (tipoCliente_id
					            ,cpfcnpj
					    VALUES
					            (".$setObjeto->tipoCliente_id."
					            ,'".$setObjeto->Scpfcnpj."')";
			//tem que ser na hora da senha
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}


/**
Consultas Cadastro complementar
*/

	public function alterarCadastroBasico()
	{
		try {
			$setObjeto = SELF::basico("senha");
			$query="
				UPDATE preCadastroCliente
				   SET estadoCivil_id = ".$setObjeto->estadoCivil_id."
				      ,inscricaoEstadual = '".$setObjeto->inscricaoEstadual."'
				      ,nomeClienteConta = '".$setObjeto->nomeClienteConta."'
				      ,nome = '".$setObjeto->nome."'
				      ,azaoSocial = '".$setObjeto->azaoSocial."'
				      ,nomeFantasia = '".$setObjeto->nomeFantasia."'
				      ,sexo = '".$setObjeto->sexo."'
				      ,docIdentificacao = '".$setObjeto->docIdentificacao."'
				      ,orgaoEmissor = '".$setObjeto->orgaoEmissor."'
				      ,dataNascimento = '".$setObjeto->dataNascimento."'
				      ,nomeMae = '".$setObjeto->nomeMae."'
				      ,nomeConjuge = '".$setObjeto->nomeConjuge."'
				      ,cpfConjuge = '".$setObjeto->cpfConjuge."'
				WHERE cpfcnpj = '".$setObjeto->cpfcnpj."''
			";

		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}


/**
Consultas Cadastro complementar
*/
	public function alterarCadastroComplementar()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query="
				UPDATE preCadastroCliente
				   SET email = '".$setObjeto->email."'
				      ,dataCadastro = '".$setObjeto->dataCadastro."'
				      ,autorizadoDescarteETE = '".$setObjeto->autorizadoDescarteETE."'
				      ,bloqueado = '".$setObjeto->bloqueado."'
				      ,nomeRepresentante = '".$setObjeto->nomeRepresentante."'
				      ,cpfRepresentante = '".$setObjeto->cpfRepresentante."'
				 WHERE cpfcnpj='".$setObjeto->cpfcnpj."'
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}


/**
Consultas Cadastro socio
*/

	public function exibirCadastroSocio()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query ="
				SELECT id
				      ,preCadastroCliente_id
				      ,nome
				      ,cpf
				  FROM preCadastroClienteSocio
				  WHERE cpfcnpj = '".$setObjeto->cpfcnpj."'
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function alterarCadastroSocio()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query ="
				UPDATE preCadastroClienteSocio
				   SET preCadastroCliente_id = '".$setObjeto->preCadastroCliente_id."'
				      ,nome = '".$setObjeto->nome."'
				      ,cpf = '".$setObjeto->cpf."'
				 WHERE id = '".$setObjeto->id."'
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function excluirCadastroSocio()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query ="
				DELETE FROM preCadastroClienteSocio
				      WHERE id = '".$setObjeto->id."'
				";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function incluirCadastroSocio()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query ="
			INSERT INTO preCadastroClienteSocio
			           (preCadastroCliente_id
			           ,nome
			           ,cpf)
			     VALUES
			           ('".$setObjeto->preCadastroCliente_id."'
			           ,'".$setObjeto->nome."'
			           ,'".$setObjeto->cpf."'
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}


/**
Consultas Cadastro endereco
*/

	public function exibirCadastroEndereco()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query ="
			SELECT tipoEndereco_id 
			      ,pais_id 
			      ,uf_id
			      ,tipoLogradouro_id
			      ,cep
			      ,bairro
			      ,cidade
			      ,enderecoCompleto
			      ,complemento
			      ,numero
			      ,longitude
			      ,latitude
			      ,ativo
			      ,correspondencia
			      ,dataCadastro
			FROM enderecoPreCadastroCliente
			 WHERE preCadastroCliente_id = ".$setObjeto->preCadastroCliente_id."";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function alterarCadastroEndereco()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query ="
			UPDATE enderecoPreCadastroCliente
			   SET tipoEndereco_id = ".$setObjeto->tipoEndereco_id."
			      ,pais_id = ".$setObjeto->pais_id."
			      ,uf_id = ".$setObjeto->uf_id."
			      ,tipoLogradouro_id = ".$setObjeto->tipoLogradouro_id."
			      ,cep = ".$setObjeto->cep."
			      ,bairro = ".$setObjeto->bairro."
			      ,cidade = ".$setObjeto->cidade."
			      ,enderecoCompleto = ".$setObjeto->enderecoCompleto."
			      ,complemento =".$setObjeto->complemento."
			      ,numero = ".$setObjeto->numero."
			      ,longitude = ".$setObjeto->longitude."
			      ,latitude = ".$setObjeto->latitude."
			      ,ativo = ".$setObjeto->ativo."
			      ,correspondencia = ".$setObjeto->correspondencia."
			      ,dataCadastro = ".$setObjeto->dataCadastro."
			 WHERE preCadastroCliente_id = ".$setObjeto->preCadastroCliente_id;
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function incluirCadastroEndereco()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			$query = "
			INSERT INTO enderecoPreCadastroCliente
			           (tipoEndereco_id
			           ,pais_id
			           ,uf_id
			           ,tipoLogradouro_id
			           ,preCadastroCliente_id
			           ,cep
			           ,bairro
			           ,cidade
			           ,complemento
			           ,numero
			           ,longitude
			           ,latitude
			           ,ativo
			           ,correspondencia
			           ,dataCadastro)
			     VALUES
			           (".$setObjeto->tipoEndereco_id."
			           ,".$setObjeto->pais_id."
			           ,".$setObjeto->uf_id."
			           ,".$setObjeto->tipoLogradouro_id."
			           ,".$setObjeto->preCadastroCliente_id."
			           ,".$setObjeto->cep."
			           ,".$setObjeto->bairro."
			           ,".$setObjeto->cidade."
			           ,".$setObjeto->complemento."
			           ,".$setObjeto->numero."
			           ,".$setObjeto->longitude."
			           ,".$setObjeto->latitude."
			           ,".$setObjeto->ativo."
			           ,".$setObjeto->correspondencia."
			           ,".$setObjeto->dataCadastro.")
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

/**
Consultas Cadastro Arquivo
*/
	public function exibirCadastroArquivo()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			//consulta banco de dados
			//consulta webservice para buscar arquivos no gcom;
			$query = "
			SELECT id
			      ,arquivoGCOM_id
			      ,preCadastroCliente_id
			  FROM preCadastroClienteArquivo
			 WHERE preCadastroCliente_id
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function inserirCadastroArquivo()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			//fazer up load para webservice do gcom;
			//salvar id na tabela internet
			$query ="
			INSERT INTO preCadastroClienteArquivo
			           (arquivoGCOM_id
			           ,preCadastroCliente_id)
			     VALUES
			           (".$setObjeto->arquivoGCOM_id."
			           ,".$setObjeto->preCadastroCliente_id."
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function excluirCadastroArquivo()
	{
		try {
			$setObjeto = SELF::basicoInicial("senha");
			//exclui fisicamente sem excluir gcom;
			$query ="
			INSERT INTO preCadastroClienteArquivo
			           (arquivoGCOM_id
			           ,preCadastroCliente_id)
			     VALUES
			           (".$setObjeto->arquivoGCOM_id."
			           ,".$setObjeto->preCadastroCliente_id."
			";
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function uploadCadastroArquivo()
	{
		//executa o upload
		//salva arquivo na tabela inserirCadastroArquivo()

	}

	/*
Finalizar cadastro
	**/
	public function finalizarCadastro()
	{

	}
}
