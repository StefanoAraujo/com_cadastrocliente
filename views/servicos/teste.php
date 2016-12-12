<?php
$diretorio = "tmpl";
$arquivos = new RecursiveDirectoryIterator(new RecursiveDirectoryIterator($diretorio));
foreach ($arquivos as $arquivo) {
	 if($arquivo->isDot()) {
	 	echo 'Arquivo oculto: ('.$arquivo->getFilename().') <br>';
	 }
	 if($arquivo->isDir()) {
	 	echo 'Este é um diretório: ('.$arquivo->getFilename().') <br>';
	 }
	 	echo 'Nome do arquivo: '.$arquivo->getFilename().'<br>'; //exibe o nome do arquivo
	 	echo 'Caminho completo: '.$arquivo->getPathname().'<br>'; //exibe o nome e caminho completo do arquivo
	 	echo '<hr>';
}
