<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class gridboxViewTextEditor extends JViewLegacy
{
    public $form;
    public $jce;

    public function display ($tpl = null)
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return;
        }
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $this->form = $this->get('Form');
        $this->jce = $this->get('Jce');
        $doc = JFactory::getDocument();
        if (!empty($this->jce) && $this->jce * 1 === 1) {
            $doc->addScriptDeclaration('var Joomla = {};');
        }
        $doc->addStyleSheet('//fonts.googleapis.com/css?family=Roboto:300,400,500,700');
        $doc->addStyleSheet(JURI::root().'components/com_gridbox/assets/css/ba-style.css');
        $doc->setTitle('Gridbox Editor');
        parent::display($tpl);
    }
}