<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
class JFormFieldCliente extends JFormField {

    protected $type = 'cliente';


	public function getLista(){
		$retorno =  array();
		$query =   "SELECT 	id, descricao 
					FROM 		tipoCliente 
                    WHERE id <> 3
                    ORDER BY 	descricao ASC";
		$ano =	CadastroClienteHelperMSSQLService::getConnection($query);   
		if($ano->sucesso===true)
		{

			$ano = $ano->conteudo;
			$return = array();
			foreach ($ano as $key) 
			{
				$return[]= JHtml::_('select.option', $key->id, iconv('CP850','UTF-8//TRANSLIT',  $key->descricao));
			}
			return $return ;
		}
	}


    protected function getInput() {

        $options = $this->getLista();
        $html = array();

        $class = !empty($this->class) ? ' class="radio ' . $this->class . '"' : ' class="radio"';

        $html[] = '<fieldset id="' . $this->id . '"' . $class. ' >';

        foreach ($options as $i => $option)
        {
            $checked = ((string) $option->value == (string) $this->value) ? ' checked="checked"' : '';
            $class = !empty($option->class) ? ' class="' . $option->class . '"' : '';

            $onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';
            $onchange = !empty($option->onchange) ? ' onchange="' . $option->onchange . '"' : '';

            $html[] = '<input type="radio" id="' . $this->id . $i . '" name="' . $this->name . '" value="'
                . htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $onclick
                . $onchange . ' />';

            $html[] = '<label for="' . $this->id . $i . '"' . $class . ' >'
                . JText::alt($option->text, preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)) . '</label>';

        }

        $html[] = '</fieldset>';

        return implode($html);
    }
}