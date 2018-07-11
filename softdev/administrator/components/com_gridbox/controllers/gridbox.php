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

class gridboxControllerGridbox extends JControllerForm
{
    public function getModel($name = 'gridbox', $prefix = 'gridboxModel', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}
    
    public function save($key = null, $urlVar = null)
    {
        gridboxHelper::checkUserEditLevel();
        $data = $this->input->post->get('jform', array(), 'array');
        $model = $this->getModel();
        $table = $model->getTable();
        $url = $table->getKeyName();
        parent::save($key = $data['id'], $urlVar = $url);
    }

    public function edit($key = null, $urlVar = null )
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            $this->setRedirect('index.php?option=com_gridbox', JText::_('JERROR_ALERTNOAUTHOR'), 'error');
            return false;
        }
        $cid = $this->input->post->get('cid', array(), 'array');
        if (empty($cid)) {
            $cid[0] = $this->input->get('id');
        }
        $user = JFactory::getUser();
        $session = JFactory::getSession();
        $url = JUri::root(). 'index.php?option=com_gridbox&view=editor&tmpl=component&name=';
        $url .= urlencode($user->username).'&id=' .$cid[0];
        $this->setRedirect($url);
    }

    public function getSession()
    {
        $session = JFactory::getSession();
        echo new JResponseJson($session->getState());
        exit;
    }
    
    public function updateTags()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->updateTags();
    }

    public function getPageTags()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->getPageTags();
    }

    public function updateParams()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->updateParams();
    }
}