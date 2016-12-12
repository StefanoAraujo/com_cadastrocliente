<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
//echo "Hello World from /views/abc/tmpl/default.php";




// We assume that the whatver you do was a success.
$response = array("success" => true);
// You can also return something like:
$response = array("success" => false, "error"=> "Could not find ...");

// Get the document object.
$document = JFactory::getDocument();

// Set the MIME type for JSON output.
$document->setMimeEncoding('application/json');

// Change the suggested filename.
//JResponse::setHeader('Content-Disposition','attachment;filename="result.json"');

echo json_encode($this->busca_cep("72543405"));


echo '@START@' . json_encode($this->validate_email("beingsane@teste.com")) . '@END@';



