<?php
defined('_JEXEC') or die;
jimport('joomla.factory');
class CadastroClienteHelperUtilitarios
{
	public function messagemPOPUP($mensagem)
    {
		$html =str_replace("%mensagem%",$mensagem, Jtext::_('COM_CONTRATOCLIENTE_MESSAGE_POPUP'));
		return $html;
	}

	public function redireciona($RetornoMensagem, $view = null)
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


	public function criarSessao($nome, $valor)
	{
		try {
			$session = JFactory::getSession();
			$session->set($nome, $valor);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function deletarSessao($sessao){
		try {
			$session = JFactory::getSession();
			$session->clear($sessao);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function verificarSessao($sessao){
		try {
			$session = JFactory::getSession();
			return $session->has($sessao);
		} catch (Exception $e) {
			return false;
		}
	}

	public function pegarSessao($sessao){
		try {
			$session = JFactory::getSession();
			return $session->get($sessao);
		} catch (Exception $e) {
			return false;	
		}
	}

	public static function decodeCharset($dados, $type=1)
	{
		switch ($type) {
			case '1':return iconv('UTF-8//TRANSLIT','ISO-8859-1',  $dados);break;
			case '2':return iconv('ISO-8859-1','UTF-8//TRANSLIT',  $dados);break;
			case '3':return iconv('CP850','UTF-8//TRANSLIT',  $dados);break;
			case '4':return iconv('UTF-8//TRANSLIT', 'CP850', $dados);break;
			default: return false ;break;
		}
	}

	public function criarVariavel($var , $value)
	{
		JRequest::setVar($var , $value);
	}

	public function paramatroComponente($parametro)
	{
		$app = JFactory::getApplication();
		$params = $app->getParams();
		return $params->get($parametro);
	}

	public function paramatroOutroComponente($component ,$parametro)
	{
		return JComponentHelper::getParams($component )->get($parametro);
	}

	public function parametroModulo($modulo)
	{
		$module = JModuleHelper::getModule($modulo);
		$headLineParams = new JRegistry($module->params);
		return (int) $headLineParams['count'];
	}

	public function parametroPlugin($tipo, $nome)
	{
		$plugin = JPluginHelper::getPlugin($tipo, $nome);
		if ($plugin)
		{
    		$pluginParams = new JRegistry($plugin->params);
    		return $pluginParams->get('catids');
		}
	}

	public function parametroMenu($parametro)
	{
		$app = JFactory::getApplication();
		$currentMenuItem = $app->getMenu()->getActive();
		$params = $currentMenuItem->params;
		return $params->get($parametro);
	}

	public function parametroMenuPorId($parametro , $itemId)
	{
		$app = JFactory::getApplication();
		$menuItem = $app->getMenu()->getItem($itemId);
		$params = $menuItem->params;
		return $params->get($parametro);
	}

	public function parametroMenuPorIdCarregado($parametro)
	{
		$app = JFactory::getApplication();
		$input  = JFactory::getApplication()->input;
		$itemId = $input->get->get('Itemid', '0', 'INT');
		$menuItem = $app->getMenu()->getItem($itemId);
		$params = $menuItem->params;
		return $params->get($parametro);
	}

	public function varivelPost()
	{
		$jinput = JFactory::getApplication()->input;
		$foo = $jinput->post->get('varname', 'default_value', 'filter');
	}

	public function varivelGET()
	{
		//filtros INT INTEGER UINT
		$jinput = JFactory::getApplication()->input;
		$foo = $jinput->get('varname', 'default_value', 'filter');
	}

	public function variavelServer(){
		$jinput = JFactory::getApplication()->input;
		$foo = $jinput->server->get('varname', 'default_value', 'filter');
	}

	public function variavelJson(){
		$jinput = JFactory::getApplication()->input;
		$json = $jinput->json->get('varname');
	}

	public function variavelSetting()
	{
		$jinput = JFactory::getApplication()->input;
		$jinput->set('varname', 'varivel');
	}

	public function varivaelFile()
	{
		$jinput = JFactory::getApplication()->input;
		$files = $jinput->files->get('jform1');
	}

	public function variavelCMD()
	{
		$jinput = JFactory::getApplication()->input;
		$foo = $jinput->get('varname', 'default_value', 'filter');
	}

	public function formatarData($formato, $data)
	{
		return date($formato, strtotime(str_replace('-','/', $data)));
	}


	public function EnviarEmail($email, $messagem, $subject)
	{
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$body   = SELF::templateEmail($messagem);
		$recipient = array($email);

		$sender = array(
		    $config->get( 'mailfrom' ),
		    $config->get( 'fromname' )
		);
		$mailer->setSender($sender);
		$mailer->addRecipient($recipient);
		$mailer->setSubject($subject);
		$mailer->isHTML(true);
		$mailer->setBody($body);
		//$mailer->addAttachment(JPATH_COMPONENT.'/assets/document.pdf');
		$send = $mailer->Send();
		if ( $send !== true ) {
		   	return true;
		} else {
		    return false;
		}
	}

	private function templateEmail($msg){
		return str_replace("%msg%", $msg, Jtext::_('COM_CADASTROCLIENTE_LABEL_MESSAGEM_EMAILTEMPLATE'));
	}


	public function filtroarray()
	{



		}


	}



/*	INT
    INTEGER
    // Only use the first integer value
    preg_match('/-?[0-9]+/', (string) $source, $matches);
    $result = @ (int) $matches[0];
    UINT
    // Only use the first integer value
    preg_match('/-?[0-9]+/', (string) $source, $matches);
    $result = @ abs((int) $matches[0]);
    FLOAT
    DOUBLE
    // Only use the first floating point value
    preg_match('/-?[0-9]+(\.[0-9]+)?/', (string) $source, $matches);
    $result = @ (float) $matches[0];
    BOOL
    BOOLEAN
    $result = (bool) $source;
    WORD
    // Only allow characters a-z, and underscores
    $result = (string) preg_replace('/[^A-Z_]/i', '', $source);
    ALNUM
    // Allow a-z and 0-9 only
    $result = (string) preg_replace('/[^A-Z0-9]/i', '', $source);
    CMD
    // Allow a-z, 0-9, underscore, dot, dash. Also remove leading dots from result.
    $result = (string) preg_replace('/[^A-Z0-9_\.-]/i', '', $source);
    $result = ltrim($result, '.');
    BASE64
    // Allow a-z, 0-9, slash, plus, equals.
    $result = (string) preg_replace('/[^A-Z0-9\/+=]/i', '', $source);
    STRING
    // Converts the input to a plain text string; strips all tags / attributes.
    $result = (string) $this->_remove($this->_decode((string) $source));
    HTML
    // Converts the input to a string; strips all HTML tags / attributes.
    $result = (string) $this->_remove($this->_decode((string) $source));
    ARRAY
    // Attempts to convert the input to an array.
    $result = (array) $source;
    PATH
    // Converts the input into a string and validates it as a path. (e.g. path/to/file.png or path/to/dir)
    // Note: Does NOT accept absolute paths, or paths ending in a trailing slash.
    // For a visual representation of the pattern matching used, see http://www.regexper.com/#^[A-Za-z0-9_-]%2B[A-Za-z0-9_\.-]*%28[\\\\\%2F][A-Za-z0-9_-]%2B[A-Za-z0-9_\.-]*%29*%24
    // Will return null if the input was invalid.
    $pattern = '/^[A-Za-z0-9_-]+[A-Za-z0-9_\.-]*([\\\\\/][A-Za-z0-9_-]+[A-Za-z0-9_\.-]*)*$/';
    preg_match($pattern, (string) $source, $matches);
    $result = @ (string) $matches[0];
    RAW
    // The raw input. No sanitation provided.
    $result = $source;
    USERNAME
    // Strips all invalid username characters.
    $result = (string) preg_replace('/[\x00-\x1F\x7F<>"\'%&]/', '', $source)";
    */
/*Protecting Against CSRF Attacks
Joomla! attempts to protect againt CSRF by inserting a random string called a token into each POST form and each GET query string that is able to modify something in the Joomla! system. This random string provides protection because not only does the compromised site need to know the URL of the target site and a valid request format for the target site, it also must know the random string which changes for each session and each user.

The Joomla! Framework makes it easy for you to include such protection in your components as well. This is simple to implement in both POST and GET requests.

POST Request
POST requests are submitted in HTML using forms. In order to add the token to your form, add the following line inside your form:

<?php echo JHtml::_( 'form.token' ); ?>
This will output something like the following:

<input type="hidden" name="1234567890abcdef1234567890abcdef" value="1" />


GET Request
GET requests are submitted in HTML using query strings. In order to add the token to your query string, use a URL like:

<?php
echo JRoute::_( 'index.php?option=com_example&controller=object1&task=save&'. JSession::getFormToken() .'=1' );
?>
This will generate a URL with the token in the query string.



Checking the Token
Once you have included the token in your form or in your query string, you must check the token before your script carries out the request. This is done with the following line:

JSession::checkToken() or die( 'Invalid Token' );
If the request is coming from the query string, you must specify this. The code then becomes:

JSession::checkToken( 'get' ) or die( 'Invalid Token' );
Recommended Security Procedures

defined('_JEXEC') or die;
class HobodiController extends JController
{
        function delete()
        {
                $itemid = JRequest::getVar('itemid');
                $session = JFactory::getSession();
                $basket = $session->get('basket');
                if(isset($itemid) && count($basket['items']) - 1  >= $itemid) {
                        $basket['items'][$itemid] = false;
                        unset ($basket['items'][$itemid]);
                        $basket['items'] = array_values($basket['items']);
                        $session->clear('basket');
                        $session->set('basket', $basket);
                }
                $redirect = JRoute::_('index.php?Itemid=261',false);
                $msg = 'Saved successfully';
                sleep(1);
                header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');
                header("HTTP/1.1 200 OK");
                $this->setRedirect($redirect);
        }
}

has de senha

		// Generate the new password hash.
		$salt		= JUserHelper::genRandomPassword(32);
		$crypted	= JUserHelper::getCryptedPassword($data['password1'], $salt);
		$password	= $crypted.':'.$salt;

What is a CSRF Attack?
A Cross Site Request Forgery (CSRF) attack relies on the trust a website has for a user to execute unauthorized requests and or transactions. For example, say a user is logged into their Joomla! websites' administrator interface in one tab and is browsing a compromised site in another tab. A simple CSRF attack can be launched simply by tampering with IMG elements in some browsers so that they point to something like

http://some/joomla/site/administrator/index2.php?option=com_users&task=delete...
When the user browses the compromised site, that image will be requested and because the user is currently logged in to the administrator interface of her Joomla! site, the forged request will be positively authenticated and executed. To prevent simple CSRF attacks like the one above, request tokens have been added to all forms in the front-end and back-end Joomla! interfaces. The tokens are randomized strings that are used to authenticate that the request being made is coming from a valid form and a valid session. This simple measure is very effective at preventing a large percentage of potential CSRF attacks, however, due to the nature of CSRF they are extremely difficult, if not impossible, to secure against completely.

Protecting Against CSRF Attacks
Joomla! attempts to protect againt CSRF by inserting a random string called a token into each POST form and each GET query string that is able to modify something in the Joomla! system. This random string provides protection because not only does the compromised site need to know the URL of the target site and a valid request format for the target site, it also must know the random string which changes for each session and each user.

The Joomla! Framework makes it easy for you to include such protection in your components as well. This is simple to implement in both POST and GET requests.

POST Request
POST requests are submitted in HTML using forms. In order to add the token to your form, add the following line inside your form:

<?php echo JHtml::_( 'form.token' ); ?>
This will output something like the following:

<input type="hidden" name="1234567890abcdef1234567890abcdef" value="1" />


GET Request
GET requests are submitted in HTML using query strings. In order to add the token to your query string, use a URL like:

<?php
echo JRoute::_( 'index.php?option=com_example&controller=object1&task=save&'. JSession::getFormToken() .'=1' );
?>
This will generate a URL with the token in the query string.



Checking the Token
Once you have included the token in your form or in your query string, you must check the token before your script carries out the request. This is done with the following line:

JSession::checkToken() or die( 'Invalid Token' );
If the request is coming from the query string, you must specify this. The code then becomes:

JSession::checkToken( 'get' ) or die( 'Invalid Token' );
Recommended Security Procedures
While these methods help to prevent against these types of attacks, it is important to realize that as a system administrator, there are good security practices to follow which will prevent a site from being compromised.

Don't browse other sites in the same browser while you are logged into your site.
Log out from your site after you are done.
Don't stay logged into your site while you are not doing anything.
Ensure that the address in the browser bar matches the address of your site.
By practicing these safe surfing habits you will eliminate most threats to your web site.

CADASTROCLIENTE_MENSAGEM_RS001_CPF="O CPF/CNPJ informado não consta no nosso cadastro"
CADASTROCLIENTE_MENSAGEM_RS001_="%cpfcnpj% e a senha que você digitou
não coincidem"
CADASTROCLIENTE_MENSAGEM_RS002_="“Não existe cliente cadastrado
com o endereço de e-mail informado"
CADASTROCLIENTE_MENSAGEM_RS003_="A senha informada não atende os critérios mínimos de segurança. Não é permitido repetições sequenciais ou menos de 6 dígitos"
CADASTROCLIENTE_MENSAGEM_RS003_="A senha informada não confere"
CADASTROCLIENTE_MENSAGEM_RS003_="Senha alterada com sucesso"
CADASTROCLIENTE_MENSAGEM_RS003_="Este link é inválido ou expirou! Por
favor faça uma nova solicitação"
CADASTROCLIENTE_MENSAGEM_RS004_="“O campo <x> é de preenchimento
obrigatório."
CADASTROCLIENTE_MENSAGEM_RS004_="O CPF informado já possui acesso ao sistema"
CADASTROCLIENTE_MENSAGEM_RS004_="O e-mail informado é inválido"
CADASTROCLIENTE_MENSAGEM_RS004_=""
CAD


ASTROCLIENTE_MENSAGEM_RS001_=""

Using JInput
To use JInput you must first create the object by using this code:

$jinput = JFactory::getApplication()->input;
Getting Values
To get a value from JInput, you can use:

$foo = $jinput->get('varname', 'default_value', 'filter');
The filter defaults to cmd.

Info non-talk.png General Information
The code fragments in the following list show the implementation of the filters (assuming the value you want to retrieve is stored in $source). You do not need them to use JInput; all you need for using JInput is the code shown above.
Available filters are:

INT
INTEGER
// Only use the first integer value
preg_match('/-?[0-9]+/', (string) $source, $matches);
$result = @ (int) $matches[0];
UINT
// Only use the first integer value
preg_match('/-?[0-9]+/', (string) $source, $matches);
$result = @ abs((int) $matches[0]);
FLOAT
DOUBLE
// Only use the first floating point value
preg_match('/-?[0-9]+(\.[0-9]+)?/', (string) $source, $matches);
$result = @ (float) $matches[0];
BOOL
BOOLEAN
$result = (bool) $source;
WORD
// Only allow characters a-z, and underscores
$result = (string) preg_replace('/[^A-Z_]/i', '', $source);
ALNUM
// Allow a-z and 0-9 only
$result = (string) preg_replace('/[^A-Z0-9]/i', '', $source);
CMD
// Allow a-z, 0-9, underscore, dot, dash. Also remove leading dots from result.
$result = (string) preg_replace('/[^A-Z0-9_\.-]/i', '', $source);
$result = ltrim($result, '.');
BASE64
// Allow a-z, 0-9, slash, plus, equals.
$result = (string) preg_replace('/[^A-Z0-9\/+=]/i', '', $source);
STRING
// Converts the input to a plain text string; strips all tags / attributes.
$result = (string) $this->_remove($this->_decode((string) $source));
HTML
// Converts the input to a string; strips all HTML tags / attributes.
$result = (string) $this->_remove($this->_decode((string) $source));
ARRAY
// Attempts to convert the input to an array.
$result = (array) $source;
PATH
// Converts the input into a string and validates it as a path. (e.g. path/to/file.png or path/to/dir)
// Note: Does NOT accept absolute paths, or paths ending in a trailing slash.
// For a visual representation of the pattern matching used, see http://www.regexper.com/#^[A-Za-z0-9_-]%2B[A-Za-z0-9_\.-]*%28[\\\\\%2F][A-Za-z0-9_-]%2B[A-Za-z0-9_\.-]*%29*%24
// Will return null if the input was invalid.
$pattern = '/^[A-Za-z0-9_-]+[A-Za-z0-9_\.-]*([\\\\\/][A-Za-z0-9_-]+[A-Za-z0-9_\.-]*)*$/';
preg_match($pattern, (string) $source, $matches);
$result = @ (string) $matches[0];
RAW
// The raw input. No sanitation provided.
$result = $source;
USERNAME
// Strips all invalid username characters.
$result = (string) preg_replace('/[\x00-\x1F\x7F<>"\'%&]/', '', $source)
Alternatively instead of adding the filter you can use the JInput type specific methods:

// Instead of:
$input->get('name', '', 'STR');
// you can use:
$input->getString('name', '');

// Instead of:
$input->get('memberId', 0, 'INT');
// you can use:
$input->getInt('memberId', 0);
To retrieve an object, you can use:

$foo = $jinput->get('varname', null, null);
Getting Multiple Values
To retrieve a number of values you can use the getArray() method:

$fooValues = $jinput->getArray(array('var1' => '', 'var2' => '', 'var3' => ''));
or, if you want to determine the data to get step by step:

$fooArray = array();
$fooArray['var1'] = '';
$fooArray['var2'] = '';
$fooArray['var3'] = '';
$fooValues = $jinput->getArray($fooArray);
The $fooValues will be an array that consists of the same keys as used in $fooArray, but with values attached.

You can also specify different filters for each of the inputs:

$fooValues = $jinput->getArray(array(
    'var1' => 'int',
    'var2' => 'float',
    'var3' => 'word'
));
You can also nest arrays to get more complicated hierarchies of values:

$fooValues = $jinput->getArray(array(
    'jform' => array(
        'title' => 'string',
        'quantity' => 'int',
        'state' => 'int'
    )
));
Getting Values from a Specific Super Global
$foo = $jinput->get->get('varname', 'default_value', 'filter');
$foo = $jinput->post->get('varname', 'default_value', 'filter');
$foo = $jinput->server->get('varname', 'default_value', 'filter');
Getting JSON string from request
NB! Available since Joomla! Platform 12.1

$json = $jinput->json->get('varname');
Setting Values
To set a value via JInput, you can use:

$jinput->set('varname', $foo);
Retrieving File Data
The format that PHP returns file data in for arrays can at times be awkward, especially when dealing with arrays of files. JInputFiles provides a convenient interface for making life a little easier, grouping the data by file.

Suppose you have a form like:

<form action="<?php echo JRoute::_('index.php?option=com_example&task=file.submit'); ?>" enctype="multipart/form-data" method="post">
	<input type="file" name="jform1[test][]" />
	<input type="file" name="jform1[test][]" />
	<input type="submit" value="submit" />
</form>
Normally, PHP would put these in an array called $_FILES that looked like:

Array
(
    [jform1] => Array
        (
            [name] => Array
                (
                    [test] => Array
                        (
                            [0] => youtube_icon.png
                            [1] => Younger_Son_2.jpg
                        )

                )

            [type] => Array
                (
                    [test] => Array
                        (
                            [0] => image/png
                            [1] => image/jpeg
                        )

                )

            [tmp_name] => Array
                (
                    [test] => Array
                        (
                            [0] => /tmp/phpXoIpSD
                            [1] => /tmp/phpWDE7ye
                        )

                )

            [error] => Array
                (
                    [test] => Array
                        (
                            [0] => 0
                            [1] => 0
                        )

                )

            [size] => Array
                (
                    [test] => Array
                        (
                            [0] => 34409
                            [1] => 99529
                        )

                )

        )

)
JInputFiles produces a result that is cleaner and easier to work with:

$files = $input->files->get('jform1');
$files then becomes:

Array
(
    [test] => Array
        (
            [0] => Array
                (
                    [name] => youtube_icon.png
                    [type] => image/png
                    [tmp_name] => /tmp/phpXoIpSD
                    [error] => 0
                    [size] => 34409
                )

            [1] => Array
                (
                    [name] => Younger_Son_2.jpg
                    [type] => image/jpeg
                    [tmp_name] => /tmp/phpWDE7ye
                    [error] => 0
                    [size] => 99529
                )

        )

)
In this way, the data from each file element is consolidated into a single array and can be indexed in a more straightforward manner.

Background
This is based on an email discussion: Framework List 23 July 2011

The idea behind JInput is to abstract out the input source to allow code to be reused in different applications and in different contexts. What I mean by this is that you could have a controller that grabs data from an input source. Instead of always getting it from the request (i.e. get and post variables), you get it from JInput. So say for instance you have a MVC triad in your component that is meant to get data from the browser as a client (a typical web application). Now suppose you want to reuse that same code but interface with it using JSON. Instead of rewriting your triad, you just extend JInput and have it grab it data from a parsed json object and perform any translation that you need to perform.

The plan is to have JApplication instantiate JInput in its constructor. Then in your code you get the input object from the application and get your input from there. It will be a public property in Japplication so that it can be swapped out of that is appropriate.

We get the added benefit that we get rid of the static JRequest which makes a whole bunch the code a whole lot easier to test because you can inject mock inputs directly instead of trying to fudge with hackish dependencies.

The end result will be that your code will get the input object from the application (we will probably add something to JController at some point to make it more convenient to use there as well).

Once you have your JInput object, you use it fairly in a fairly similar manner to how JRequest is used: $input->get('varname', 'default_value', 'filter');

Where filter is a filter that is supported by JFilterInput. JInput::clean proxies to JFilter. We'll have to tweak JFilter a little bit so that it is more extensible. It defaults to cmd so that developers have to be intentional about things if they want to have more lenient filtering.

There is also a getArray method that allows you to specify an array of key and filter pairs so that you can get a whole array of filtered input.

If you want to get data from a specific super global array, you can do $input->get->get(...) or $input->post->get(...).

JApplication is deprecated, Use JApplicationCms instead unless specified otherwise. JRequest is deprecated but will remain in the CMS through the 3.x series at a minimum. As such, it is easiest to still use JRequest with CMS applications. In the future get the JInput object from the application instead.

Argument	Data type	Description	Default
$pathonly	boolean	If true, then only the path to the Joomla site is returned; otherwise the scheme, host and port are prepended to the path. Note that when false (default), the URI returned has a trailing "/", but when true the trailing "/" is omitted.	false
$path	string	Path to override the actual path. Since this is held statically, it will affect all subsequent calls to this method.
Example
In this example, the Joomla root URI is shown with both values of the $pathonly argument. A new path is also applied and it should be noted that it affects subsequent calls to this method.

echo 'Joomla root URI is ' . JURI::root() . "\n";
echo 'Joomla root URI (path only) is ' . JURI::root( true ) . "\n";
echo 'Joomla root URI (path specified) is ' . JURI::root( false, '/a-different-path' ) . "\n";
echo 'Joomla root URI (path only) (path specified) is ' . JURI::root( true, '/a-different-path' ) . "\n";
echo "\n";
echo 'Joomla root URI is ' . JURI::root() . "\n";
echo 'Joomla root URI (path only) is ' . JURI::root( true ) . "\n";
will output

Joomla root URI is http://localhost/joomla15svn10812/
Joomla root URI (path only) is /joomla15svn10812
Joomla root URI (path specified) is http://localhost/a-different-path/
Joomla root URI (path only) (path specified) is /a-different-path

Joomla root URI is http://localhost/a-different-path/
Joomla root URI (path only) is /a-different-path
*/
