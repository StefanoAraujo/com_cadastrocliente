	public function getListaInscritosAprovadosPorEventoExportarXLS($id,$login)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.*, d.evento, e.nome as instituicao, date_format(datainscricao,"%d/%m/%Y") AS datainscricao ');
		$query->from('#__agenciaevento_evento_inscricao as a');
		$query->join('INNER', $db->quoteName('#__agenciaevento_usuario_evento', 'b') . ' ON (' . $db->quoteName('b.idevento') . ' = ' . $db->quoteName('a.idevento'). ')');
		$query->join('INNER', $db->quoteName('#__agenciaevento_usuario', 'c') . ' ON (' . $db->quoteName('c.id') . ' = ' . $db->quoteName('b.idusuario'). ')');
		$query->join('INNER', $db->quoteName('#__agenciaevento_evento', 'd') . ' ON (' . $db->quoteName('d.id') . ' = ' . $db->quoteName('a.idevento'). ')');
		$query->join('INNER', $db->quoteName('#__agenciaevento_inscricao_instituicao', 'e') . ' ON (' . $db->quoteName('e.id') . ' = ' . $db->quoteName('a.idinstituicao'). ')');
		$query->where("a.situacao= 1 and a.idevento=$id and c.logincaesb = '$login'");
		$query->order('a.nomeCompleto ASC');
		$db->setQuery($query);
		$retorno = $db->loadObjectList();
		JLoader::register('AgencieventoHelper', JPATH_SITE . DS . 'components\com_agenciaevento\helpers' . DS . 'agenciaevento.php');
		$excel = new AgencieventoHelper;
		$excel->ExcelWriter(JPATH_SITE . DS . 'components\com_agenciaevento\assets\tmp' . DS .'seminario.xls');
		if($excel==false){
		    echo $excel->error;
		}
		$myArr=array('Nome','Instituição','Email','Telefone Fixo', 'Telefone Celular','Data de Inscrição');
		$excel->writeLine($myArr);
		foreach ($retorno as $table) {
			$myArr = array($table->nomeCompleto,$table->instituicao,$table->email,$table->telefonefixo,$table->telefonecelular,$table->datainscricao);
			$excel->writeLine($myArr);
			$novoNome = $table->evento;
		}
		$excel->close();

		$arquivoNome='seminario.xls';
		$arquivoLocal= JPATH_SITE . DS . 'components\com_agenciaevento\assets\tmp' . DS .'seminario.xls';
		if (!file_exists($arquivoLocal)) {
		exit;
		}
		$novoNome = 'seminario_'.$novoNome.'.xls';
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="'.$novoNome.'"');
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($arquivoLocal));
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');
		readfile($arquivoLocal);exit;
		header("Location:index.php");
		exit;
	}