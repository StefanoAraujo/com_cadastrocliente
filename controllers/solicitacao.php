d<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');
jimport('joomla.user.helper');
class CadastroClienteControllerConvenio extends JControllerForm
{
	


	public function ()
	{
// 				RS015– Pesquisar solicitações
// Criar a funcionalidade que permite consultar as solicitações de atualização cadastral encaminhada
// para a área responsável da CAESB.
// 1 - Criação: Quando o usuário selecionar a opção “Acompanhar solicitações” localizada no
// protótipo 15, o sistema deve recuperar todas as solicitações que o usuário já finalizou a atualização 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 55 de 73
// 55
// cadastral. As solicitações devem ser apresentadas conforme protótipo 20 e disponibilizar as
// opções abaixo de acordo com a sua situação atual:
//  Aguardando validação: Opção disponível “Visualizar Diagnostico” (RS020);
//  Cadastro Pendente: Opções disponíveis “Ajustar pendencia” e “Visualizar Diagnostico”
// (RS016 ou RS017 e RS020);
//  Cadastro aprovado: Opção disponível “Visualizar Diagnostico” (RS020);
//  Solicitação cancelado: Opção disponível “Visualizar Diagnostico” (RS020);
// 2- Criação: O sistema deve apresentar o filtro de pesquisa “Protocolo” que ao ser preenchido e
// acionado o botão deve ser apresentado na lista somente o registro que contemple o filtro
// informado. Caso não seja localizado nenhum registro, o sistema deve apresentar a mensagem
// “Nenhum registro foi encontrado”.
	}

	public function AjustarPendencia()
	{
// 		RS016– Ajustar pendencia cadastral – Cliente pessoa física
// Criar a funcionalidade que permita realizar ajuste de solicitação cadastral com a situação pendente.
// 1 - Criação: Quando o usuário do tipo “Cliente pessoa física” selecionar a opção “Ajustar
// pendencia” localizada em um dos registros da lista de ‘solicitações de atualização cadastral’
// (protótipo 20), o sistema deve apresentar a tela de ‘ajustar cadastro com pendencia’ conforme
// protótipo 21 e regras abaixo:
//  O sistema deve recuperar do sistema GCOM (tabela ‘preCadastroCliente), a última
// avaliação da solicitação de cadastro ‘pendente’ realizada pelo responsável CAESB;
//  Deve ser apresentado no painel ‘Diagnóstico’ os campos:
// o Situação: Situação atribuída de acordo com a avaliação do responsável Caesb;
// o Justificativa: Justificativa inserida na avaliação cadastral;
//  Os demais campos devem ser apresentados não editáveis, exceto, os campos que não
// estiver marcado como aprovado na avaliação do responsável Caesb:
// o Os campos habilitados poderão ser editados porém só serão salvos ao ser
// acionado o botão “Finalizar”;
// o Para ajustes nos arquivos anexados, o sistema deve apresentar a opção de
// “remover arquivo” e “substituir arquivo” para o anexo que não for aprovado;
// o Disponibilizar a opção “Anexar Arquivos” para que o usuário possa incluir novos
// arquivos;
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 56 de 73
// 56
// o O sistema não deve permitir o download de arquivos anexados.
//  Todas as alterações devem ser salvas ao ser acionado o botão “Finalizar”.
// 2 - Criação: Ao ser acionado o botão “Finalizar”, o sistema deve:
//  Verificar se houve alguma alteração nos campos habilitados para edição, caso haja, deve
// ser aplicado a regra correspondente ao campo alterado (verificar RS013). Caso não tenha
// sido alterado os campos habilitados para edição, o sistema deve apresentar a mensagem
// “Para finalizar os ajustes das pendencias, você deve corrigir todos os campos habilitados
// para edição” e retornar para a tela de ajuste (protótipo 21);
//  Caso o formulário atenda todos os critérios dos campos, deve ser encaminhado a
// solicitação de cadastro para uma reanalise, atribuir a situação “Aguardando validação”
// para a solicitação e apresentar a mensagem “Alteração realizada com sucesso!
// Acompanhe a situação da sua solicitação através da opção ‘Acompanhar solicitações”;
//  O(s) campo(s) que for alterado deve ser marcado(s) em vermelho, com intuito de facilitar
// a reanalise do avaliador Caesb;
//  Os dados devem ser salvos na mesma tabela que houve a recuperação das informações
// (sistema GCOM).
// Observação: É importante frisar que quando o usuário acionar o botão “Finalizar”, o sistema deve
// reencaminhar a solicitação com o ajuste no mesmo protocolo já criado para a solicitação.
	
// 	{
// 		RS017– Ajustar pendencia cadastral – Cliente pessoa jurídica
// Criar a funcionalidade que permita realizar ajuste de solicitação cadastral com a situação pendente.
// 1 - Criação: Quando o usuário do tipo “Cliente pessoa jurídica” selecionar a opção “Ajustar
// pendencia” localizada em um dos registros da lista de ‘solicitações de atualização cadastral’
// (protótipo 20), o sistema deve apresentar a tela de ‘ajustar cadastro com pendencia’ conforme
// protótipo 22 e regras abaixo:
//  O sistema deve recuperar do sistema GCOM (tabela ‘preCadastroCliente’), a última
// avaliação da solicitação de cadastro ‘pendente’ realizada pelo responsável CAESB;
//  Deve ser apresentado no painel ‘Diagnóstico’ os campos:
// o Situação: Situação atribuída de acordo com a avaliação do responsável Caesb;
// o Justificativa: Justificativa inserida na avaliação cadastral;
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 57 de 73
// 57
//  Os demais campos devem ser apresentados não editáveis, exceto, os campos que não
// estiver marcado como aprovado na avaliação do responsável Caesb:
// o Os campos habilitados poderão ser editados porém só serão salvos ao ser
// acionado o botão “Finalizar”;
// o Para ajustes nos arquivos anexados, o sistema deve apresentar a opção de
// “remover arquivo” e “substituir arquivo” para o anexo que não for aprovado;
// o Disponibilizar a opção “Anexar Arquivos” para que o usuário possa incluir novos
// arquivos;
// o O sistema não deve permitir o download de arquivos anexados.
//  Todas as alterações devem ser salvas ao ser acionado o botão “Finalizar”.
// 2 - Criação: Ao ser acionado o botão “Finalizar”, o sistema deve:
//  Verificar se houve alguma alteração nos campos habilitados para edição, caso haja, deve
// ser aplicado a regra correspondente ao campo alterado (verificar RS014). Caso não tenha
// sido alterado os campos habilitados para edição, o sistema deve apresentar a mensagem
// “Para finalizar os ajustes das pendencias, você deve corrigir todos os campos habilitados
// para edição” e retornar para a tela de ajuste (protótipo 22);
//  Caso o formulário atenda todos os critérios dos campos, deve ser encaminhado a
// solicitação de cadastro para uma reanalise, atribuir a situação “Aguardando validação”
// para a solicitação e apresentar a mensagem “Alteração realizada com sucesso!
// Acompanhe a situação da sua solicitação através da opção ‘Acompanhar solicitações”;
//  O(s) campo(s) que for alterado deve ser marcado(s) em vermelho, com intuito de facilitar
// a reanalise do avaliador Caesb;
//  Os dados devem ser salvos na mesma tabela que houve a recuperação das informações
// (sistema GCOM).
// Observação: É importante frisar que quando o usuário acionar o botão “Finalizar”, o sistema deve
// reencaminhar a solicitação com o ajuste no mesmo protocolo já criado para a solicitação.

	}

	public function alterarCadastro()
// RS018 – Alterar cadastro de cliente pessoa física
// Criar a funcionalidade que permite realizar a atualização cadastral de um cliente pessoa física.
// 1 - Criação: Quando o usuário do tipo ‘pessoa física’ selecionar a opção “Atualizar dados
// cadastrais” (protótipo 15), o sistema deve: 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 58 de 73
// 58
//  Verificar se é a primeira solicitação de cadastro do usuário, caso não seja e o usuário já
// possuir um cadastro com a situação “Cadastro Aprovado”, o sistema deve recuperar do
// sistema GCOM os dados cadastrais do usuário e disponibiliza-los para edição. Os dados
// devem ser recuperados da tabela: ‘cliente’;
//  Todos os dados cadastrais poderão ser editados exceto os campos “Tipo de cliente”, “CPF”
// e “Anexos - já existentes”;
//  No painel “Endereço”, o usuário poderá adicionar, editar, visualizar ou inativar um endereço
// já existente:
// o Adicionar: Quando o usuário acionar o botão , o sistema deve apresentar a
// tela de “Cadastro de Endereço” conforme protótipo 25 e regra abaixo:
//  Deve ser apresentado os campos “Tipo de Endereço”, “Pais” e “Cep
// Correios” habilitados, os demais campos devem ser apresentados
// desabilitados;
//  Ao ser selecionada a opção “Outros” no campo “Tipo endereço”, o sistema
// deve apresentara um campo tipo texto para inclusão do tipo do endereço;
//  O usuário deve inserir um número de CEP e clicar no botão realizar a
// busca dos dados do endereço a ser inserido. Verificar RS021;
// o Alterar: Quando o usuário acionar o botão ou selecionar a opção “alterar
// endereço” localizada em um dos registros da lista de endereço, o sistema deve
// apresentar a tela de “Editar Endereço” conforme protótipo 26;
// o Visualizar: Quando o usuário acionar a opção “alterar endereço” localizada em um
// dos registros da lista de endereço, o sistema deve apresentar a tela de “Visualizar
// Endereço” conforme protótipo 27. Os campos apresentados somente para
// visualização (não editáveis);
// o Inativar: Para inativar um endereço o usuário deve acionar a opção que permite
// alterar um endereço e selecionar a opção “Inativo” no campo “Situação do
// endereço”.
//  No painel “Contato”, o usuário poderá adicionar um contato do tipo “Nacional” ou
// “Internacional”, conforme regra abaixo:
// o Nacional: Opção que deve ser apresentado como padrão e ao ser adicionado um
// telefone, o sistema deve inserir o código ‘+55’ ao número de contato adicionado;
// o Internacional: O sistema deve apresentar a lista de seleção “País” (verificar RS023),
// campo de seleção obrigatório para adicionar um contato do tipo ‘internacional’. Ao 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 59 de 73
// 59
// ser adicionado um novo contato, o sistema deve atribuir o código do país
// selecionado ao número de contato inserido;
//  No painel “Anexos”, o sistema só deve apresentar somente a opção “Anexar arquivo”, ou
// seja, o usuário não poderá visualizar ou remover um arquivo já existente em seu cadastro.
//  Caso seja a primeira solicitação de cadastro do usuário, o sistema deve apresentar a
// tela de atualização cadastral conforme descrito na RS010.
// 2 - Criação: Caso o usuário altere as informações do formulário e clicar no botão “Salvar
// Rascunho” o sistema deve:
//  Salvar a solicitação de cadastro na base de dados do sistema “Portal Público (Internet)”
// com a situação “Salvo em rascunho”;
//  Apresentar a mensagem: “O cadastro foi salvo como rascunho, porém não foi enviado para
// validação. Para encaminhar o cadastro para validação, clique no botão “Continuar
// atualização cadastral” preencha todo o formulário e clique no botão “Finalizar Cadastro”;
//  Retornar para a tela inicial e desabilitar o botão “Atualizar dados cadastrais”;
// Observação: Para cadastro salvo como rascunho, os campos do formulário não serão obrigatórios.
// 3 - Criação: Caso o usuário altere as informações do formulário e clicar no botão “Finalizar
// cadastro” o sistema deve executar as seguintes validações:
//  Em todos os campos, deve ser inibida a utilização dos caracteres especiais, exceto os
// campos de Coordenada geográfica(latitude e longitude) e E-mail;
//  Todos os caracteres informados pelo usuário devem ser apresentados e salvos em caixa
// alta (letra maiúscula);
//  O campo “Nome” deve ser obrigatório e possuir ao menos duas palavras com 03 (três)
// caracteres cada.
//  O campo “Nome da mãe” deve sr obrigatório e possuir ao menos duas palavras com 03
// (três) caracteres cada;
//  O campo “Nome para conta” deve ser obrigatório e possuir no máximo 40 caracteres;
//  O campo “Data de nascimento” deve ser obrigatório;
//  No campo “Doc. de Identificação” deve ser bloqueado a repetição de números sequenciais
// independentes da quantidade de dígitos utilizados, ou seja, o sistema não deve permitir a
// sequência de 0 a 9 (crescente e decrescente) e todas as sequencias com os mesmos 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 60 de 73
// 60
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
// 4 - Criação: Quando o sistema identificar que a solicitação de cadastro atende todos os critérios
// descritos no item “3- Criação” dessa RS, o sistema deve:
//  Marcar em vermelho os dados alterados do cadastro existente e encaminhar os dados
// da solicitação para o sistema GCOM e disponibilizá-los para validação de cadastro. Deve
// ser gerado automaticamente um atendimento no sistema GCOM com as seguintes
// características:
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 61 de 73
// 61
// o Atendimento não imediato
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
// opção ‘Acompanhar solicitações. Protocolo da solicitação “<X> ’” e retornar para a tela
// inicial (protótipo 15);
// Observação importante: Ao ser encaminhado os dados da solicitação para validação, o
// sistema deve gravá-los no sistema GCOM (tabela ‘preCadastroCliente’). O registro só deve ser
// apagado da base do Portal Público da Caesb quando ele for aprovado pela área responsável e
// inserido na tabela ‘cliente’ do sistema GCOM.
// RS019 – Alterar cadastro de cliente pessoa jurídica
// Criar a funcionalidade que permite realizar a atualização cadastral de um cliente pessoa jurídica.
// 1 - Criação: Quando o usuário do tipo ‘pessoa jurídica’ selecionar a opção “Atualizar dados
// cadastrais” (protótipo 15), o sistema deve: 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 62 de 73
// 62
//  Verificar se é a primeira solicitação de cadastro do usuário, caso não seja e o usuário já
// possuir um cadastro com a situação “Cadastro Aprovado”, o sistema deve recuperar do
// sistema GCOM os dados cadastrais do usuário e disponibiliza-los para edição. Os dados
// devem ser recuperados da tabela: ‘cliente’;
//  Todos os dados cadastrais poderão ser editados exceto os campos “Tipo de cliente”,
// “CNPJ” e “Anexos - já existentes”;
//  No painel “Endereço”, o usuário poderá adicionar, editar ou inativar um endereço já
// existente:
// o Adicionar: Quando o usuário acionar o botão , o sistema deve apresentar a
// tela de “Cadastro de Endereço” conforme protótipo 25 e regra abaixo:
//  Deve ser apresentado os campos “Tipo de Endereço”, “Pais” e “Cep
// Correios” habilitados, os demais campos devem ser apresentados
// desabilitados;
//  Ao ser selecionada a opção “Outros” no campo “Tipo endereço”, o sistema
// deve apresentara um campo tipo texto para inclusão do tipo do endereço;
//  O usuário deve inserir um número de CEP e clicar no botão realizar a
// busca dos dados do endereço a ser inserido. Verificar RS021;
// o Alterar: Quando o usuário acionar o botão ou selecionar a opção “alterar
// endereço” localizada em um dos registros da lista de endereço, o sistema deve
// apresentar a tela de “Editar Endereço” conforme protótipo 26;
// o Visualizar: Quando o usuário acionar a opção “alterar endereço” localizada em um
// dos registros da lista de endereço, o sistema deve apresentar a tela de “Visualizar
// Endereço” conforme protótipo 27. Os campos apresentados somente para
// visualização (não editáveis);
// o Inativar: Para inativar um endereço o usuário deve acionar a opção que permite
// alterar um endereço e selecionar a opção “Inativo” no campo “Situação do
// endereço”.
//  No painel “Contato”, o usuário poderá adicionar um contato do tipo “Nacional” ou
// “Internacional”, conforme regra abaixo:
// o Nacional: Opção que deve ser apresentado como padrão e ao ser adicionado um
// telefone, o sistema deve inserir o código ‘+55’ ao número de contato adicionado;
// o Internacional: O sistema deve apresentar a lista de seleção “País” (verificar RS023),
// campo de seleção obrigatório para adicionar um contato do tipo ‘internacional’. Ao 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 63 de 73
// 63
// ser adicionado um novo contato, o sistema deve atribuir o código do país
// selecionado ao número de contato inserido;
//  No painel “Anexos”, o sistema só deve apresentar somente a opção “Anexar arquivo”, ou
// seja, o usuário não poderá visualizar ou remover um arquivo já existente em seu cadastro.
// 2 - Criação: Caso o usuário altere as informações do formulário e clicar no botão “Salvar
// Rascunho” o sistema deve:
//  Salvar a solicitação de cadastro na base de dados do sistema “Portal Público (Internet)”
// com a situação “Salvo em rascunho”;
//  Apresentar a mensagem: “O cadastro foi salvo como rascunho, porém não foi enviado para
// validação. Para encaminhar o cadastro para validação, clique no botão “Continuar
// atualização cadastral” preencha todo o formulário e clique no botão “Finalizar Cadastro”;
//  Retornar para a tela inicial e desabilitar o botão “Atualizar dados cadastrais”;
// Observação: Para cadastro salvo como rascunho, os campos do formulário não serão obrigatórios.
// 3 - Criação: Caso o usuário altere as informações do formulário e clicar no botão “Finalizar
// cadastro” o sistema deve executar as seguintes validações:
//  Em todos os campos, deve ser inibida a utilização dos caracteres especiais, exceto os
// campos de Coordenada geográfica (latitude e longitude) e E-mail;
//  Todos os caracteres informados pelo usuário devem ser apresentados e salvos em caixa
// alta (letra maiúscula);
//  O campo “Razão Social” deve ser obrigatório e possuir ao menos duas palavras com 03
// (três) caracteres cada.
//  O campo “Nome Fantasia” deve ser obrigatório;
//  O campo “Inscrição” Estadual” deve permitir apenas números e ser obrigatório;
//  O campo “Nome para conta” deve ser obrigatório e possuir no máximo 40 caracteres;
//  Ao menos um “Endereço” com a situação “Ativo” deve ser informado, caso
// contrário, o sistema deve apresentar a seguinte mensagem “Ao menos um
// endereço “ativo” deve ser informado”;
//  Ao menos um número de “Contato” será obrigatório, caso seja informado mais de um
// número, o usuário só poderá marcar um telefone como contato “Principal” e após ser
// adicionado um contato principal, a check box deve ser apresentada desabilitada. Caso o 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 64 de 73
// 64
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
// 4 - Criação: Quando o sistema identificar que a solicitação de cadastro atende todos os critérios
// descritos no item “3- Criação” dessa RS, o sistema deve:
//  Encaminhar os dados da solicitação para o sistema GCOM e disponibilizá-los para
// validação de cadastro. Deve ser gerado automaticamente um atendimento no sistema
// GCOM com as seguintes características:
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
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 65 de 73
// 65
//  Desabilitar as opções “Atualizar dados cadastrais” e “Continuar atualização cadastral” da
// tela inicial (protótipo 15);
//  Disponibilizar a opção “Acompanhar solicitações” (protótipo 15).
//  Apresentar a mensagem “Seu cadastro foi finalizado com sucesso e encaminhado para
// validação da área responsável. Acompanhe a situação da sua solicitação através da
// opção ‘Acompanhar solicitações. Protocolo da solicitação <X>’” e retornar para a tela
// inicial (protótipo 15);
// Observação importante: Ao ser encaminhado os dados da solicitação para validação, o sistema
// deve gravá-los no sistema GCOM (tabela ‘preCadastroCliente’). O registro só deve ser apagado
// da base do Portal Público da Caesb quando ele for aprovado pela área responsável e inserido na
// tabela ‘cliente’ do sistema GCOM.

	}




	public function pesquisarDiagnostico()
	{
	// 	– Pesquisar diagnósticos para visualizar
	// Criar a funcionalidade que permita visualizar o diagnóstico de um protocolo de solicitação de
	// atualização cadastral.
	// 1 - Criação: Quando o usuário clicar no botão e selecionar a opção “Visualizar diagnóstico”
	// localizado em um dos registros da lista de solicitações (protótipo 20), o sistema deve apresentar
	// os dados da solicitação selecionada conforme protótipo 31 e regras abaixo:
	//  Protocolo: Deve ser recuperado o número de protocolo da solicitação selecionada;
	//  Data/Hora: Deve ser apresentado a data e a hora que foi realizada a solicitação;
	//  Ação executada: Deve ser apresentada a ação executada da seguinte forma:
	// o Encaminhada para validação: Quando o usuário finaliza uma
	// solicitação de atualização cadastral clicando no botão “Finalizar”
	// (RS013, RS014, RS018 ou RS019)
	// o Analise da solicitação: Quando o responsável GCOM realiza a
	// análise da solicitação, o resultado poderá ser satisfatório ou não
	// satisfatório;
	// o Ajuste de pendencia: Quando o usuário realiza o ajuste de uma
	// solicitação com a situação “pendente” e clicar no botão “Finalizar”
	// (RS16 ou RS17).
	//  Situação: Deve ser apresentada a ‘situação atual’ da solicitação que pode
	// ser:
	// Companhia de Saneamento Ambiental do Distrito Federal
	// Assessoria de Tecnologia da Informação - PRT
	// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
	// Página 66 de 73
	// 66
	// o Aguardando validação;
	// o Cadastro pendente;
	// o Cadastro cancelado;
	// o Cadastro aprovado.
	//  Justificativa: Deve ser apresentada a justificativa inserida na análise da
	// solicitação cadastral.

	}


public function pesquisarCep(){
	// RS021 – Pesquisar dados do Endereço na base Correios
	// Criar a funcionalidade que permita realizar uma busca de dados de endereço no sistema Correios.
	// 1 - Criação: Quando o usuário informar um número de CEP e clicar no botão “Pesquisar”
	// localizado no campo “CEP Correios” protótipos 25 e 26 , o sistema deve realizar uma pesquisa no
	// sistema “Correios” para verificação dos dados de endereço que corresponda ao CEP informado.
	// O sistema deve recuperar os seguintes dados:
	//  UF;
	//  Logradouro;
	//  Bairro;
	//  Cidade;
	//  Complemento;
	// 2 - Criação: Quando a pesquisa retornar os dados do endereço, o sistema não deve permitir
	// alterações dos dados recuperados, os demais campos devem ser habilitados para preenchimento
	// do usuário. Caso o CEP informado não esteja cadastrado no sistema Correios, o sistema deve
	// exibir a mensagem “Não existe CEP cadastrado com o número informado”. 
	// RS021 – Pesquisar dados do Endereço na base Correios
	// Criar a funcionalidade que permita realizar uma busca de dados de endereço no sistema Correios.
	// 1 - Criação: Quando o usuário informar um número de CEP e clicar no botão “Pesquisar”
	// localizado no campo “CEP Correios” protótipos 25 e 26 , o sistema deve realizar uma pesquisa no
	// sistema “Correios” para verificação dos dados de endereço que corresponda ao CEP informado.
	// O sistema deve recuperar os seguintes dados:
	//  UF;
	// Logradouro;
	//  Bairro;
	//  Cidade;
	//  Complemento;
	// 2 - Criação: Quando a pesquisa retornar os dados do endereço, o sistema não deve permitir
	// alterações dos dados recuperados, os demais campos devem ser habilitados para preenchimento
	// do usuário. Caso o CEP informado não esteja cadastrado no sistema Correios, o sistema deve
	// exibir a mensagem “Não existe CEP cadastrado com o número informado”. 
}

public function pesquisarPais()
{
// 	– Pesquisar país (lista suspensa)
// Criar a funcionalidade que permite visualizar a lista de países para seleção do usuário.
// 1 - Criação: Quando o usuário selecionar um tipo de contato “Internacional” e clicar no campo
// “País”, o sistema deve recuperar todos os países cadastrados na base de dados e apresentá-los
// para seleção do usuário. O campo deve ser de seleção única e ao ser salvo um contato do tipo
// “internacional”, o sistema deve inserir o ‘código do país’ selecionado no número de contato
// inserido.

}

public function anexarArquivo()
{
// 	RS022 – Anexar arquivo
// Criar a funcionalidade que permite anexar arquivos em uma solicitação de cadastro de pessoa física
// ou jurídica.
// 1 - Criação: Quando o usuário clicar no botão “Anexar arquivo” localizado em um dos protótipos
// (16, 17, 18, 19, 21, 22, 23 e 24), o sistema deve apresentar a tela de upload de arquivo conforme
// protótipo 28 e regra abaixo:
//  O sistema deve permitir arquivo com extensão jpg, png, doc, pdf e xlsx, caso seja
// selecionado um arquivo com a extensão diferente das citadas acima, o sistema deve 
// Companhia de Saneamento Ambiental do Distrito Federal
// Assessoria de Tecnologia da Informação - PRT
// Gerência de Desenvolvimento e Manutenção de Sistemas - PRTD
// Página 67 de 73
// 67
// apresentara mensagem “O arquivo selecionado é inválido. Por favor, selecione um arquivo
// com a extensão jpg, png, doc, pdf ou xlsx”;
//  Deve ser permitido anexar mais de um arquivo;
//  É obrigatório o preenchimento do campo “Descrição” do arquivo.
}








	private function redirecionar($RetornoMensagem, $view = null)
	{
		$application = JFactory::getApplication();
		$url = ($view) ? JRoute::_('index.php?option=com_cadastrocliente&view='.$view): JURI::current();
		$application->redirect($url, $RetornoMensagem, $msgType='message');
	}

	public function detalhe()
	{
		JSession::checkToken('get') or SELF::redirecionar(COM_CONTRATOCLIENTE_MESSAGE_TOKEN);
		$conv = JFactory::getApplication()->input;
        $convenio = $conv->get('convenio',null, 'STRING');
        $conveniado = $conv->get('conveniado',null, 'STRING');
		try {
			$query = "SELECT 		Num_Convenio as 'Convenio', 
									Nome_Conveniado as 'Conveniado', 
									Num_Processo as 'Processo', 
									Unidade_Gestora as 'UnidadeGestora', 
									Objeto as 'Objeto', 
									Perodo_Vigencia_Inicial as 'InicioVigencia', 
									Periodo_Vigencia_Final as 'FinalVigencia', 
									cast(Valor_Contrapartida as varchar)  as 'TotaldaContrapartida', 
									cast(Valor_total_Recursos as varchar)  as 'TotaldosRecursos', 
									cast(Valor_Repasse as varchar)  as 'ValordoRepasse' 
						FROM 		dbo.Tb_ConvenioFinanc 
						WHERE 		Num_Convenio ='$convenio'  
						AND 		Nome_Conveniado='$conveniado'";
        	$conveniado = CadastroClienteHelperMSSQLService::getConnection($query);
        	if($conveniado->sucesso===true)
        	{
        		if(!empty($conveniado->conteudo))
        		{
        			$retorno = array();
        			foreach ($conveniado->conteudo as $key) {
        				$key->Objeto = CadastroClienteHelperMSSQLService::decodeCharset($key->Objeto,3);
        				$retorno[]=$key;
        			}

        			SELF::criarVariavel('convenioDetalhe',$retorno);
        		}
        	}

        	SELF::retornarView('default_detalhe');
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), $view = 'convenio');
		}
	}

	public function retornarView($fileview = 'default', $view = 'convenio', $type = 'html'){
		$view = $this->getView($view, $type);
		$view->setLayout($fileview );
		$view->display();
	}

	public function criarVariavel($var , $value){
		JRequest::setVar($var , $value);
	}
}
