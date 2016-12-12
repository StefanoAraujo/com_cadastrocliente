<?php
defined('_JEXEC') or die;
class CadastroClienteHelperMSSQLService
{

   	public static function getConnection($sqlQuery){
   		try {
			$con = array("user" => 'PUBLICO',"pass" => '13LAGELEKIBTG2221',"db" => 'AgenciaVirtual',"host" => '192.168.103.7',);
			$pdo = new PDO("dblib:host=".$con['host'].";dbname=".$con['db'].";charset=UTF-8;", $con['user'], $con['pass']); 
	   		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        	$stmt = $pdo->prepare("$sqlQuery");
        	$stmt->execute();
	    	$row = array();
	    	$row2 = array();
	     	while ( $row1 = $stmt->fetch( PDO::FETCH_OBJ ) ){ //FETCH_ASSOC FETCH_OBJ
   				$row[] = $row1;
			}
			return SELF::retorno($row);
		} catch ( PDOException $e ) {
			return SELF::retorno($e->getMessage(),false);
		} 
	}

	private function retorno($conteudo,$booleano=true)
	{
		$retorno = new stdclass();
		$retorno->sucesso = $booleano;
		if($booleano ===true)
		{
			$retorno->conteudo = $conteudo;
		} else
		{
			$retorno->descricaoErro =  $conteudo;
		}
		return $retorno;
	}

	public static function decodeCharset($dados, $type=1){
		switch ($type) {
			case '1':return iconv('UTF-8//TRANSLIT','ISO-8859-1',  $dados);break;
			case '2':return iconv('ISO-8859-1','UTF-8//TRANSLIT',  $dados);break;
			case '3':return iconv('CP850','UTF-8//TRANSLIT',  $dados);break;
			case '4':return iconv('UTF-8//TRANSLIT', 'CP850', $dados);break;
			default: return false ;break;
		}
	}

	public function inserir($tabela = null, $queryObjects = null)
	{
		$int = 0;
		$campo = "";
		$valor = "";
		foreach ($queryObjects as $key => $value) {
			$campo .= ($int == 0) ? $key : ",". $key;
			$valor .= ($int == 0) ? ((is_int($value) OR $value == null )? $value : "'".$value."'") : ",". ((is_int($value) OR $value == null )? $value : "'".$value."'");
			$int ++;
		}
		$valor = str_replace(",,", ",null,", $valor);
		ECHO $sqlQuery = "INSERT INTO ".Jtext::_($tabela)." ( ".Jtext::_($campo)." ) VALUES ( ".Jtext::_($valor)." )"  ;
		return SELF::getConnection($sqlQuery);
	}
}