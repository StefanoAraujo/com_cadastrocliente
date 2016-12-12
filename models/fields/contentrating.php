<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.helper');
jimport('joomla.model.classes.pais');
JFormHelper::loadFieldClass('list');
class JFormFieldContentRating extends JFormField {

    protected $type = 'ContentRating';

    protected function getInput() {

        $options = array(
            JHtml::_('select.option', 'Y', 'TV-Y'),
            JHtml::_('select.option', 'Y7', 'TV-Y7'),
            JHtml::_('select.option', 'G', 'TV-G'),
            JHtml::_('select.option', 'PG', 'TV-PG'),
            JHtml::_('select.option', '14', 'TV-14'),
            JHtml::_('select.option', 'MA', 'TV-MA')
        );

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
?>