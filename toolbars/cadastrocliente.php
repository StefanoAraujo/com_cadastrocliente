<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.toolbar');

class CadastroClienteToolbar extends JObject
{
	public function  cadastroClienteToolbar() {
		$perfils = array();
			$perfil = SELF::objetoMenu();
			$perfil->titulo = JText::_('COM_CADASTROCLIENTE_LABEL_BTN_ATUALIZARDADOS');
			$perfil->disable = ""; 
			$perfil->link = JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=acesso.atualizardados&'.JSession::getFormToken() .'=1');
			$perfil->icon = "pencil-square-o";
		$perfils[] =  $perfil; 
			$perfil = SELF::objetoMenu();
			$perfil->titulo = JText::_('COM_CADASTROCLIENTE_LABEL_BTN_CONTINUARATUALIZACAO');
			$perfil->disable = "disable"; 
			$perfil->link = JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=acesso.continuaratualizacao&'.JSession::getFormToken() .'=1');
			$perfil->icon = "share-square-o";
		$perfils[] =  $perfil; 
			$perfil = SELF::objetoMenu();
			$perfil->titulo = JText::_('COM_CADASTROCLIENTE_LABEL_BTN_ACOMPANHARSOLICITACAO');
			$perfil->disable = ""; 
			$perfil->link = JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=acesso.acompanharsolicitacao&'.JSession::getFormToken() .'=1');
			$perfil->icon = "list";
		$perfils[] =  $perfil; 
			$perfil = SELF::objetoMenu();
			$perfil->titulo = JText::_('COM_CADASTROCLIENTE_LABEL_BTN_ALTERARPERFIL');
			$perfil->disable = ""; 
			$perfil->link = JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=acesso.alterarperfil&'.JSession::getFormToken() .'=1');
			$perfil->icon = "users";
		$perfils[] =  $perfil; 
		SELF::MenuaddScript();
		return SELF::MenuTemplate($perfils);
	}

	private function objetoMenu()
	{
		$perfil = new stdclass();
		$perfil->titulo = null;
		$perfil->disable = false;
		$perfil->link = null;
		$perfil->icon = null;
		return $perfil;
	}

	private function MenuTemplate($perfils = array())
	{
		$html = "<div class='row-fluid'>";
		foreach ($perfils as $value) {
			$html .= "<div class='span3'>";
			$html .= '<a href="'.$value->link.'" class="'.$value->disable.'">';
			$html .= '<div class="botao animated pulse">';
			$html .= '<i class="fa fa-'.$value->icon.' fa-5x fa-align-center"></i>';
			$html .= '<span>'.$value->titulo.'</span>';
			$html .= '</div>';
			$html .= '</a>';
			$html .= "</div>";
		}
		$html .= "</div>";
		return $html;
	}

	private function MenuaddScript()
	{
		$doc = JFactory:: getDocument();
		$doc->addStyleDeclaration('
			.botao{
			    background-color: #004877;
			    background: -moz-linear-gradient( top, #1F89CD, #004877 );
			    background: -webkit-gradient( linear, left top, left bottom, color-stop( 0, #1F89CD ), color-stop( 1, #004877 ) );
			    zoom: 1;
			    filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#1F89CD,EndColorStr=#004877);
			    -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#1F89CD,EndColorStr=#004877)";
			    -moz-box-shadow: 3px 3px 10px #888;
			    -webkit-box-shadow: 3px 3px 10px #888;
			    box-shadow: 3px 3px 10px #888;
			    background-color: #004877\9 !important; /* IE6, IE7, IE8, IE9 */
			    +background-color: #004877!important;/* Only works in IE7*/
			    *background-color: #004877!important; /* IE6, IE7 */
			    background-color: #004877\9\0!important;/*Only works in IE9*/
			    _background-color: #004877!important; /* Only works in IE6 */
			    *+background-color: #004877!important; /* Only works in IE7 */
			    background-color: #004877\0!important; /* IE8, IE9 */
			    padding: 20px 15px 20px 15px;
			    margin: 20px 15px 20px 15px;
			    color: #e6e6e6;
			    border-radius: 4px;
			    text-align: center;
			}


			.disable{
			    color: #ffffff;
			    background-color: #517c94!important;
			    cursor: default;
			    background-image: none;
			    opacity: 0.65;
			    filter: alpha(opacity=65);
			    -webkit-box-shadow: none;
			    -moz-box-shadow: none;
			    box-shadow: none;
			    -moz-box-shadow: 3px 3px 10px #888;
			    -webkit-box-shadow: 3px 3px 10px #888;
			    box-shadow: 3px 3px 10px #888;
			    pointer-events: none;
		        opacity: 0.6;
			}

			.disable > .botao{
			    background-color: #517c94!important;
		        opacity: 0.6;
			}



			.botao:hover, .botao:focus, .botao:active {
			    background-color: #004877;
			    background: -moz-linear-gradient( top, #2b9ee8, #004877 );
			    background: -webkit-gradient( linear, left top, left bottom, color-stop( 0, #2b9ee8 ), color-stop( 1, #004877 ) );
			    filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#2b9ee8,EndColorStr=#004877);
			    -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#2b9ee8,EndColorStr=#004877)";
			    -moz-box-shadow: 3px 3px 10px #888;
			    -webkit-box-shadow: 3px 3px 10px #888;
			    box-shadow: 3px 3px 10px #888;
			    background-color: #004877\9 !important; /* IE6, IE7, IE8, IE9 */
			    +background-color: #004877!important;/* Only works in IE7*/
			    *background-color: #004877!important; /* IE6, IE7 */
			    background-color: #004877\9\0!important;/*Only works in IE9*/
			    _background-color: #004877!important; /* Only works in IE6 */
			    *+background-color: #004877!important; /* Only works in IE7 */
			    background-color: #004877\0!important;
			}

			.botao:active {
			    background-color: #004877;
			    background: -moz-linear-gradient( top, #1fcd9b, #004877 );
			    background: -webkit-gradient( linear, left top, left bottom, color-stop( 0, #1fcd9b ), color-stop( 1, #004877 ) );
			    filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#1fcd9b,EndColorStr=#004877);
			    -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#1fcd9b,EndColorStr=#004877)";
			    -moz-box-shadow: 3px 3px 10px #888;
			    -webkit-box-shadow: 3px 3px 10px #888;
			    box-shadow: 3px 3px 10px #888;
			    background-color: #004877\9 !important; /* IE6, IE7, IE8, IE9 */
			    +background-color: #004877!important;/* Only works in IE7*/
			    *background-color: #004877!important; /* IE6, IE7 */
			    background-color: #004877\9\0!important;/*Only works in IE9*/
			    _background-color: #004877!important; /* Only works in IE6 */
			    *+background-color: #004877!important; /* Only works in IE7 */
			    background-color: #004877\0!important;
			}


			.botao i {
			    padding: 0 0 5px 0;
			    margin: 0 auto;
			    vertical-align: bottom;
			    border: none;
			}

			.botao span {
			    display: block;
			    text-align: center;
			}
		'
		);
	}
}

/*

RS008 – Pesquisar situação cadastral do cliente
Criar a funcionalidade que apresente as opções disponíveis para o usuário de acordo com a sua
situação cadastral.
1 - Criação: Quando o usuário efetuar um login válido na área restrita do portal público da CAESB
(RS001), o sistema deve:
 Verificar qual é o CPF ou CNPJ do usuário e habilitar as funcionalidades (botões) de
acordo com a situação do cadastro do usuário, conforme abaixo:
o Atualizar dados cadastrais: Opção habilitada quando usuário não possuir
solicitação de cadastro na situação “Aguardando validação”, “Cadastro pendente”,
“Salvo em rascunho”;
o Continuar atualização cadastral: Opção habilitada quando o usuário possuir uma
solicitação de cadastro na situação “Salvo como rascunho”;
o Acompanhar solicitações: Opção habilitada quando o usuário finalizar a primeira
solicitação de cadastro, ou seja, a partir da primeira solicitação o botão sempre
será habilitado, possibilitando o usuário ter um histórico de todas as suas
solicitações de atualização cadastral;
o Alterar perfil: A opção deve ser apresentada habilitada.


*/