<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');
jimport('joomla.user.helper');
class CadastroClienteControllerCadastroCliente extends JControllerForm
{
	private function redireciona($RetornoMensagem, $view = null)
	{

		$application = JFactory::getApplication();
		$url = ($view) ? JRoute::_('index.php?option=com_cadastrocliente&view='.$view): JURI::current();
		$application->redirect($url, $RetornoMensagem, $msgType='message');
	}

	public function download()
	{
		$entrada = JFactory::getApplication()->input;
		$dados = $entrada->get('cadastrocliente', "", 'STRING');
		//var_dump($dados);die();
		$dados = iconv('UTF-8//TRANSLIT','ISO-8859-1',  $dados);
		if($dados!="")
		{
			$params = array("nome"=>$dados);
			$retorno = CadastroClienteHelperWebservice::getService('download', $params);
			if($retorno->retorno->sucesso===true)
			{
				foreach ($retorno->retorno->arquivos as $key) {
					$arquivo = $key->arquivo;
				}
			}
			header('Cache-Control: public'); 
			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename=ARQUIV.PDF');
			echo file_get_contents('data://application/pdf;base64,'. $arquivo);
			die();
		} else {
			SELF::redireciona('CadastroCliente não informado', 'cadastrocliente');
		}
	
	}
	//RS008 – Pesquisar situação cadastral do cliente
	public function verificarSituacaoCadastral()
	{
		// habilitar as funcionalidades (botões) de
		// acordo com a situação do cadastro do usuário, conforme abaixo:
		
		// o Atualizar dados cadastrais: Opção habilitada quando usuário não possuir
		// solicitação de cadastro na situação “Aguardando validação”, “Cadastro pendente”,
		// “Salvo em rascunho”;
		
		// o Continuar atualização cadastral: Opção habilitada quando o usuário possuir uma
		// solicitação de cadastro na situação “Salvo como rascunho”;
		
		// o Acompanhar solicitações: Opção habilitada quando o usuário finalizar a primeira
		// solicitação de cadastro, ou seja, a partir da primeira solicitação o botão sempre
		// será habilitado, possibilitando o usuário ter um histórico de todas as suas
		// solicitações de atualização cadastral;
		
		// o Alterar perfil: A opção deve ser apresentada habilitada.
	}
	//RS009 – Incluir rascunho de solicitação cadastral - Cliente pessoa física
	public function incluirRascunho(){
// 		RS009 – Incluir rascunho de solicitação cadastral - Cliente pessoa física
// Criar a funcionalidade que permite realizar a inclusão de uma solicitação de cadastro de um cliente
// pessoa física.
// 1 - Criação: Quando o usuário do tipo ‘pessoa física’ selecionar a opção “Atualizar dados
// cadastrais” (protótipo 15), o sistema deve:
//  Verificar se é a primeira solicitação de cadastro do usuário, caso seja, o sistema deve
// apresentar a tela de cadastro conforme protótipo 16 e regra abaixo:
// o Os campos “Tipo de cliente” e “CPF” devem ser preenchido automaticamente pelo
// sistema recuperando o CPF do usuário logado;
// o Deve ser apresentada a mensagem “Cliente não cadastrado! Por favor efetuar o
// cadastro”;
// o Quando o usuário selecionar a opção ‘casado’ no campo “Estado civil”, o sistema
// deve apresentar os campos “Cônjuge” e “CPF do cônjuge”;
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 45 de 73
// 45
// o Quando o usuário clicar no botão localizado no painel de “Dados de Endereço”,
// o sistema deve apresentar a tela de cadastro de endereço, conforme protótipo 25
// e as regras abaixo:
//  Deve ser apresentado os campos “Tipo de Endereço”, “Pais” e “Cep
// Correios” habilitados, os demais campos devem ser apresentados
// desabilitados;
//  Ao ser selecionada a opção “Outros” no campo “Tipo endereço”, o sistema
// deve apresentara um campo tipo texto para inclusão do tipo do endereço;
//  O usuário deve inserir um número de CEP e clicar no botão realizar a
// busca dos dados do endereço a ser inserido. Verificar RS021;
//  Caso o usuário inclua mais de um endereço, o sistema deve apresentar o
// primeiro endereço cadastrado no painel de visualização rápida (endereço
// 1), os demais endereços devem ser apresentados na lista de endereços,
// conforme apresentado no protótipo 16 painel “Endereço”.
// o No painel “Contato”, o usuário poderá adicionar um ou mais contatos clicando no
// botão . O contato poderá ser do tipo “Nacional” ou “Internacional”, conforme
// regra abaixo:
//  Nacional: Opção que deve ser apresentado como padrão e ao ser
// adicionado um telefone, o sistema deve inserir o código ‘+55’ ao número de
// contato adicionado. O usuário deve preencher os campos abaixo para
// inserir um contato:
//  Tipo: Lista de seleção única com as opções: Celular comercial,
// Celular Particular, Fax, Fixo Comercial, Fixo Residencial e Recado;
//  Nome: Campo alfabético apresentado quando for selecionada a
// opção “Recado” na lista de seleção “Tipo” telefone;
//  Código de identificação (DDD): Numérico
//  Telefone: Numérico
//  Principal: ‘Check box’ O usuário só poderá marcar um telefone
// como contato “Principal” e após ser adicionado um contato principal,
// a check box deve ser apresentada desabilitada para os demais
// números adicionados.
//  Internacional: Opção que ao ser acionada deve apresentar listados abaixo
// para inclusão de um contato:
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 46 de 73
// 46
//  Tipo: Lista de seleção única com as opções: Celular comercial,
// Celular Particular, Fax, Fixo Comercial, Fixo Residencial e Recado;
//  Nome: Campo alfabético apresentado quando for selecionada a
// opção “Recado” na lista de seleção “Tipo” telefone;
//  País: Lista de seleção única (verificar RS023). O sistema deve
// atribuir o código do país selecionado ao número de contato inserido;
//  Código de identificação (DDI): Numérico
//  Telefone: Numérico
//  Principal: ‘Check box’ O usuário só poderá marcar um telefone como
// contato “Principal” e após ser adicionado um contato principal, a check box
// deve ser apresentada desabilitada para os demais números adicionados;
// o O usuário poderá inserir mais de um contato, os contatos devem ser apresentados
// na lista de telefone (painel Contato). O sistema deve apresentar as opções de
// “Alterar telefone’ e “Remover telefone” na listagem, porém as alterações e remoção
// realizadas deverão ser salvas quando o usuário clicar no botão “Salvar como
// rascunho”;
// o O usuário poderá adicionar mais de um anexo. Verificar RS022.
//  Caso não seja a primeira solicitação de cadastro do usuário, o sistema deve
// apresentar a tela de atualização cadastral conforme descrito na RS015.
// 2 - Criação: Quando o usuário preencher as informações do formulário e clicar no botão “Salvar
// Rascunho” o sistema deve:
//  Salvar a solicitação de cadastro na base de dados do sistema “Portal Público (Internet)”
// com a situação “Salvo em rascunho”;
//  Apresentar a mensagem: “O cadastro foi salvo como rascunho, porém não foi enviado para
// validação. Para encaminhar o cadastro para validação, clique no botão “Continuar
// atualização cadastral” preencha todo o formulário e clique no botão “Finalizar Cadastro”;
//  Retornar para a tela inicial e desabilitar o botão “Atualizar dados cadastrais”;
// Observação: Ao ser salvo um cadastro como rascunho, os campos do formulário não serão
// obrigatórios.

// 		– Incluir rascunho de solicitação cadastral - Cliente pessoa jurídica
// Criar a funcionalidade que permite realizar a inclusão de uma solicitação de cadastro de um cliente
// pessoa jurídica. 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 47 de 73
// 47
// 1 - Criação: Quando o usuário do tipo ‘pessoa jurídica’ selecionar a opção “Atualizar dados
// cadastrais” (protótipo 15), o sistema deve:
//  Verificar se é a primeira solicitação de cadastro do usuário, caso seja, o sistema deve
// apresentar a tela de cadastro conforme protótipo 17 e regra abaixo:
// o Os campos “Tipo de cliente” e “CNPJ” devem ser preenchido automaticamente
// pelo sistema recuperando o CNPJ do usuário logado;
// o Deve ser apresentada a mensagem “Cliente não cadastrado! Por favor efetuar o
// cadastro”;
// o Quando o usuário clicar no botão localizado no painel de “Dados de Endereço”,
// o sistema deve apresentar a tela de cadastro de endereço, conforme protótipo 25
// e as regras abaixo:
//  Deve ser apresentado os campos “Tipo de Endereço”, “Pais” e “Cep
// Correios” habilitados, os demais campos devem ser apresentados
// desabilitados;
//  Ao ser selecionada a opção “Outros” no campo “Tipo endereço”, o sistema
// deve apresentara um campo tipo texto para inclusão do tipo do endereço;
//  O usuário deve inserir um número de CEP e clicar no botão realizar a
// busca dos dados do endereço a ser inserido. Verificar RS021;
//  Caso o usuário inclua mais de um endereço, o sistema deve apresentar o
// primeiro endereço cadastrado no painel de visualização rápida (endereço
// 1), os demais endereços devem ser apresentados na lista de endereços,
// conforme apresentado no protótipo 17 painel “Dados de Endereço”.
// o No painel “Contato”, o usuário poderá adicionar um ou mais contatos clicando no
// botão . O contato poderá ser do tipo “Nacional” ou “Internacional”, conforme
// regra abaixo:
//  Nacional: Opção que deve ser apresentado como padrão e ao ser
// adicionado um telefone, o sistema deve inserir o código ‘+55’ ao número de
// contato adicionado. O usuário deve preencher os campos abaixo para
// inserir um contato:
//  Tipo: Lista de seleção única com as opções: Celular comercial,
// Celular Particular, Fax, Fixo Comercial, Fixo Residencial e Recado;
//  Nome: Campo alfabético apresentado quando for selecionada a
// opção “Recado” na lista de seleção “Tipo” telefone;
//  Código de identificação (DDD): Numérico
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 48 de 73
// 48
//  Telefone: Numérico
//  Principal: ‘Check box’ O usuário só poderá marcar um telefone
// como contato “Principal” e após ser adicionado um contato principal,
// a check box deve ser apresentada desabilitada para os demais
// números adicionados.
//  Internacional: Opção que ao ser acionada deve apresentar listados abaixo
// para inclusão de um contato:
//  Tipo: Lista de seleção única com as opções: Celular comercial,
// Celular Particular, Fax, Fixo Comercial, Fixo Residencial e Recado;
//  Nome: Campo alfabético apresentado quando for selecionada a
// opção “Recado” na lista de seleção “Tipo” telefone;
//  País: Lista de seleção única (verificar RS023). O sistema deve
// atribuir o código do país selecionado ao número de contato inserido;
//  Código de identificação (DDI): Numérico
//  Telefone: Numérico
//  Principal: ‘Check box’ O usuário só poderá marcar um telefone como
// contato “Principal” e após ser adicionado um contato principal, a check box
// deve ser apresentada desabilitada para os demais números adicionados;
// o O usuário poderá inserir mais de um contato, os contatos devem ser apresentados
// na lista de telefone (painel Contato). O sistema deve apresentar as opções de
// “Alterar telefone’ e “Remover telefone” na listagem, porém as alterações e remoção
// realizadas deverão ser salvas quando o usuário clicar no botão “Salvar como
// rascunho”;
// o No painel “Dados Complementares”, o usuário poderá inserir até 5 sócios, não será
// obrigatório a inclusão de um sócio, porém, para inserir um sócio é obrigatório o
// preenchimento dos dois campos “Sócio” e “CPF”, caso o usuário informe somente
// um dos campos, o sistema deve apresentar a mensagem “ O campos <x> é
// obrigatório para a vinculação de um sócio”
// o O usuário poderá adicionar mais de um anexo. Verificar RS022.
//  Caso não seja a primeira solicitação de cadastro do usuário, o sistema deve
// apresentar a tela de atualização cadastral conforme descrito na RS015.
// 2 - Criação: Quando o usuário preencher as informações do formulário e clicar no botão “Salvar
// Rascunho” o sistema deve:
// 		Salvar a solicitação de cadastro na base de dados do sistema “Portal Público (Internet)”
// com a situação “Salvo em rascunho”;
//  Apresentar a mensagem: “O cadastro foi salvo como rascunho, porém não foi enviado para
// validação. Para encaminhar o cadastro para validação, clique no botão “Continuar
// atualização cadastral” preencha todo o formulário e clique no botão “Finalizar Cadastro”;
//  Retornar para a tela inicial e desabilitar o botão “Atualizar dados cadastrais”;
// Observação: Ao ser salvo um cadastro como rascunho, os campos do formulário não serão
// obrigatórios.

	}

// 		RS011 – Alterar rascunho da solicitação cadastral - Cliente pessoa física
// RS012 – Alterar rascunho da solicitação cadastral - Cliente pessoa jurídica
	public function alterarRascunho()
	{
// 		RS011 – Alterar rascunho da solicitação cadastral - Cliente pessoa física
// Criar a funcionalidade que permite alterar um rascunho de uma solicitação de cadastro de um cliente
// pessoa física.
// 1 - Criação: Quando o usuário do tipo ‘pessoa física’ selecionar a opção “Continuar atualização
// cadastral” (protótipo 15), o sistema deve:
//  Recupera a solicitação de cadastro com a situação igual a “Salvo em rascunho”;
//  Apresentar os dados salvos e habilitá-los para edição, exceto os campos “Tipo de cliente”
// e “CPF” não poderão ser editáveis, conforme protótipo 18;
//  Apresentar a mensagem: “Cadastro não finalizado! Por favor continue a atualização
// cadastral”.
// Observação: Após o preenchimento da solicitação de cadastro, o usuário poderá acionar os botões
// “Salvar Rascunho” ou “Finalizar Cadastro”, o sistema deverá executar todas as validações descritas
// nas RSs, conforme abaixo:
// o Botão “Salvar Rascunho” verificar RS009;
// o Botão “Finalizar Cadastro” verificar RS013;
// RS012 – Alterar rascunho da solicitação cadastral - Cliente pessoa jurídica
// Criar a funcionalidade que permite alterar um rascunho de uma solicitação de cadastro de um cliente
// pessoa jurídica.
// 1 - Criação: Quando o usuário do tipo ‘pessoa jurídica’ selecionar a opção “Continuar atualização
// cadastral” (protótipo 15), o sistema deve: 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 50 de 73
// 50
//  Recupera a solicitação de cadastro com a situação igual a “Salvo em rascunho”;
//  Apresentar os dados salvos e habilitá-los para edição, exceto os campos “Tipo de cliente”
// e “CNPJ” não poderão ser editáveis, conforme protótipo 19;
//  Apresentar a mensagem: “Cadastro não finalizado! Por favor continue a atualização
// cadastral”.
// Observação: Após o preenchimento da solicitação de cadastro, o usuário poderá acionar os botões
// “Salvar Rascunho” ou “Finalizar Cadastro”, o sistema deverá executar todas as validações descritas
// em suas respectivas ‘RSs’, conforme abaixo:
// o Botão “Salvar Rascunho” verificar RS010;
// o Botão “Finalizar Cadastro” verificar RS014;

	}

//RS013 – Finalizar solicitação cadastral - Cliente pessoa física

	public function finalizarRascunho()
	{
	// 		RS013 – Finalizar solicitação cadastral - Cliente pessoa física
	// Criar a funcionalidade que permite encaminhar uma solicitação de cadastral de cliente pessoa física
	// para aprovação.
	// 1 - Criação: Quando o usuário do tipo ‘pessoa física’ preencher as informações do formulário de
	// solicitação de cadastro (protótipo 16 e protótipo 18) e acionar o botão “Finalizar cadastro”, o
	// sistema deve executar as seguintes validações:
	//  Em todos os campos, deve ser inibida a utilização dos caracteres especiais, exceto os
	// campos de Coordenada geográfica(latitude e longitude) e E-mail;
	//  Todos os caracteres informados pelo usuário devem ser apresentados e salvos em caixa
	// alta (letra maiúscula);
	//  O campo “Nome” deve ser obrigatório e possuir ao menos duas palavras com 03 (três)
	// caracteres cada.
	//  O campo “Nome da mãe” deve ser obrigatório e possuir ao menos duas palavras com 03
	// (três) caracteres cada;
	//  O campo “Nome para conta” o sistema deve recuperar automaticamente a mesma
	// informação inserida no campo “Nome”, porém, deve ser respeitado o limite máximo de 40
	// caracteres;
	//  O campo “Data de nascimento” deve ser obrigatório;
	//  No campo “Doc. de Identificação” deve ser bloqueado a repetição de números sequenciais
	// independentes da quantidade de dígitos utilizados, ou seja, o sistema não deve permitir a
	// sequência de 0 a 9 (crescente e decrescente) e todas as sequencias com os mesmos 
	// Companhia de Saneamento Ambiental do Distrito Federal
	// Assessoria de Tecnologia da Informação - PRT
	// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
	// Página 51 de 73
	// 51
	// números. Exemplo: RG com <7> dígitos: 1234567 ou 7654321 ou 0000000 – devem ser
	// bloqueados.
	//  O campo Estado civil deve ser obrigatório e obedecer a seguinte regra:
	// o Se o estado civil for “casado” ou “união estável” o campo “CPF” e “Nome”
	// do cônjuge” deve ser obrigatório.
	//  Ao menos um “Endereço” com a situação “Ativo” deve ser informado, caso
	// contrário, o sistema deve apresentar a seguinte mensagem “Ao menos um
	// endereço “ativo” deve ser informado”;
	//  Ao menos um número de “Contato” será obrigatório, caso seja informado mais de um
	// número, o usuário só poderá marcar um telefone como contato “Principal” e após ser
	// adicionado um contato principal, a check box deve ser apresentada desabilitada. Caso o
	// usuário não informe nenhum contato o sistema deve apresentar a mensagem “Ao menos
	// um número para contato deve ser informado”;
	// o No campo “Número” do contato deve ser bloqueado a repetição de números
	// sequenciais, ou seja, o sistema não deve permitir a sequência de 0 a 9 (crescente
	// e decrescente) e todas as sequencias com os mesmos números. Exemplo:
	// 012345678 ou 876543210 ou 000000000.
	//  O usuário deve anexar ao menos um arquivo, caso não seja anexado, deve ser
	// apresentada a mensagem “É obrigatório anexar os arquivos que comprovem a
	// veracidade dos dados cadastrais”;
	//  Os demais campos devem ser de preenchimento obrigatório:
	// o “Documento de Identificação”;
	// o “Órgão Emissor”
	// o Sexo;
	// o Data de nascimento.
	//  Caso algum campo obrigatório não seja preenchido, o sistema deve apresentar a
	// mensagem: “Os campos com asteriscos são de preenchimento obrigatório”.
	// 2 - Criação: Quando o sistema identificar que a solicitação de cadastro atende todos os critérios
	// descritos no item “1- Criação” dessa RS, o sistema deve:
	//  Encaminhar os dados da solicitação para o sistema GCOM e disponibilizá-los para
	// validação de cadastro. Deve ser gerado automaticamente um atendimento no sistema
	// GCOM com as seguintes características:
	// o Atendimento não imediato
	// Companhia de Saneamento Ambiental do Distrito Federal
	// Assessoria de Tecnologia da Informação - PRT
	// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
	// Página 52 de 73
	// 52
	// o Atendimento para = null
	// o Solicitante = Nome do cliente
	// o Carta resposta = não
	// o Contato
	//  Nome: Nome do cliente informado na solicitação cadastral;
	//  Telefone residencial = Telefone principal informado na solicitação
	// cadastral;
	// o O atendimento deve gerar um protocolo no GCOM (utilizando os mesmos
	// critérios do atendimento);
	// o Gerar uma ordem de serviço de “cadastro de cliente” (codServico GTPO = 200).
	// Esta ordem de serviço deve ser encaminhada para o executor “958 – Cadastro
	// de cliente”
	// Observação: O serviço e o executor citados acima devem ser criados.
	//  Atribuir a situação “Aguardando validação” para a solicitação;
	//  Desabilitar as opções “Atualizar dados cadastrais” e “Continuar atualização cadastral” da
	// tela inicial (protótipo 15);
	//  Disponibilizar a opção “Acompanhar solicitações” (protótipo 15);
	//  Apresentar a mensagem “Seu cadastro foi finalizado com sucesso e encaminhado para
	// validação da área responsável. Acompanhe a situação da sua solicitação através da
	// opção ‘Acompanhar solicitações’” e retornar para a tela inicial (protótipo 15);
	// Observação importante: Ao ser encaminhado os dados da solicitação para validação, o
	// sistema deve gravá-los no sistema GCOM (tabela ‘preCadastroCliente’). O registro só deve ser
	// apagado da base do Portal Público da Caesb quando ele for aprovado pela área responsável e
	// inserido na tabela ‘cliente’ do sistema GCOM.
	// RS014 – Finalizar solicitação cadastral - Cliente pessoa jurídica
	// Criar a funcionalidade que permite encaminhar uma solicitação de cadastral de cliente pessoa jurídica
	// para aprovação.
	// 1 - Criação: Quando o usuário do tipo ‘pessoa jurídica’ preencher as informações do formulário
	// de solicitação de cadastro (protótipo 17 e protótipo 19) e acionar o botão “Finalizar cadastro”, o
	// sistema deve executar as seguintes validações:
	// Companhia de Saneamento Ambiental do Distrito Federal
	// Assessoria de Tecnologia da Informação - PRT
	// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
	// Página 53 de 73
	// 53
	//  Em todos os campos, deve ser inibida a utilização dos caracteres especiais, exceto os
	// campos de Coordenada geográfica (latitude e longitude) e E-mail;
	//  Todos os caracteres informados pelo usuário devem ser apresentados e salvos em caixa
	// alta (letra maiúscula);
	//  O campo “Razão Social” deve ser obrigatório e possuir ao menos duas palavras com 03
	// (três) caracteres cada.
	//  O campo “Nome Fantasia” deve ser obrigatório;
	//  O campo” Inscrição Estadual” deve permitir apenas números;
	//  O campo “Nome para conta” deve ser obrigatório e possuir no máximo 40 caracteres;
	//  Ao menos um “Endereço” com a situação “Ativo” deve ser informado, caso
	// contrário, o sistema deve apresentar a seguinte mensagem “Ao menos um
	// endereço “ativo” deve ser informado”;
	//  Ao menos um número de “Contato” será obrigatório, caso seja informado mais de um
	// número, o usuário só poderá marcar um telefone como contato “Principal” e após ser
	// adicionado um contato principal, a check box deve ser apresentada desabilitada. Caso o
	// usuário não informe nenhum contato o sistema deve apresentar a mensagem “Ao menos
	// um número para contato deve ser informado”;
	// o No campo “Número” do contato deve ser bloqueado a repetição de números
	// sequenciais, ou seja, o sistema não deve permitir a sequência de 0 a 9 (crescente
	// e decrescente) e todas as sequencias com os mesmos números. Exemplo:
	// 012345678 ou 876543210 ou 000000000.
	//  O campo “Representante Legal” e “CPF Representante Legal” deve ser de
	// preenchimento obrigatório;
	//  O usuário deve anexar ao menos um arquivo, caso não seja anexado, deve ser
	// apresentada a mensagem “É obrigatório anexar os arquivos que comprovem a
	// veracidade dos dados cadastrais”;
	//  Caso algum campo obrigatório não seja preenchido, o sistema deve apresentar a
	// mensagem: “Os campos com asteriscos são de preenchimento obrigatório”.
	// 2 - Criação: Quando o sistema identificar que a solicitação de cadastro atende todos os critérios
	// descritos no item “1- Criação” dessa RS, o sistema deve:
	//  Encaminhar os dados da solicitação para o sistema GCOM e disponibilizá-los para
	// validação de cadastro. Deve ser gerado automaticamente um atendimento no sistema
	// GCOM com as seguintes características:
	// Companhia de Saneamento Ambiental do Distrito Federal
	// Assessoria de Tecnologia da Informação - PRT
	// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
	// Página 54 de 73
	// 54
	// o Atendimento não imediato
	// o Atendimento para = null
	// o Solicitante = Razão Social
	// o Carta resposta = não
	// o Contato
	//  Nome: Razão Social informada na solicitação cadastral;
	//  Telefone residencial = Telefone principal informado na solicitação
	// cadastral;
	// o O atendimento deve gerar um protocolo no GCOM (utilizando os mesmos
	// critérios do atendimento);
	// o Gerar uma ordem de serviço de “cadastro de cliente” (codServico GTPO = 200).
	// Esta ordem de serviço deve ser encaminhada para o executor “958 – Cadastro
	// de cliente”
	// Observação: O serviço e o executor citados acima devem ser criados.
	//  Atribuir a situação “Aguardando validação” para a solicitação;
	//  Desabilitar as opções “Atualizar dados cadastrais” e “Continuar atualização cadastral” da
	// tela inicial (protótipo 15);
	//  Disponibilizar a opção “Acompanhar solicitações” (protótipo 15).
	//  Apresentar a mensagem “Seu cadastro foi finalizado com sucesso e encaminhado para
	// validação da área responsável. Acompanhe a situação da sua solicitação através da
	// opção ‘Acompanhar solicitações’” e retornar para a tela inicial (protótipo 15);
	// Observação importante: Ao ser encaminhado os dados da solicitação para validação, o
	// sistema deve gravá-los no sistema GCOM (tabela ‘preCadastroCliente’). O registro só deve ser
	// apagado da base do Portal Público da Caesb quando ele for aprovado pela área responsável e
	// inserido na tabela ‘cliente’ do sistema GCOM.

	}


	
}