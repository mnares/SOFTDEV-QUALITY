<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_gridbox')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('gridboxHelper', dirname(__FILE__) . '/helpers/gridbox.php');
gridboxHelper::prepareGridbox();
JHtml::addIncludePath(dirname(__FILE__) . '/helpers/html');
$controller = JControllerLegacy::getInstance('gridbox');
$controller->execute(JFactory::getApplication()->input->getCmd('task', 'display'));
$controller->redirect();