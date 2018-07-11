<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class gridboxControllergridbox extends JControllerForm
{
    public function getModel($name = 'gridbox', $prefix = 'gridboxModel', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}

    public function login()
    {
        $input = JFactory::getApplication()->input;
        $login = $input->get('ba_login', '', 'string');
        $password = $input->get('ba_password', '', 'string');
        $credentials = array('username' => $login, 'password' => $password);
        $msg = '';
        if (!JFactory::getApplication()->login($credentials)) {
            $msg = JText::_('LOGIN_ERROR');
        }
        echo $msg;
        exit;
    }

    public function createPage()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $id = $model->createPage();

        echo $id;
        exit;
    }

    public function getSession()
    {
        $session = JFactory::getSession();
        echo new JResponseJson($session->getState());
        exit;
    }

    public function save($key = NULL, $urlVar = NULL)
    {
        
    }
}