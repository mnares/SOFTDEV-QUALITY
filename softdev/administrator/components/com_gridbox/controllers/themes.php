<?php
/**
* @package   gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class gridboxControllerThemes extends JControllerAdmin
{
    public function getModel($name = 'theme', $prefix = 'gridboxModel', $config = array())
    {
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }

    public function contextDelete()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $array = array();
        $array[] = $id;
        $model = $this->getModel();
        $this->checkItems($array);
        $model->delete($array);
        gridboxHelper::deleteThemeCss($array);
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_DELETED');
    }

    public function checkItems($cid)
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->checkItems($cid);
    }

    public function contextDuplicate()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $array = array();
        $array[] = $id;
        $model = $this->getModel();
        $model->duplicate($array);
        gridboxHelper::ajaxReload('GRIDBOX_DUPLICATED');
    }
    
    public function delete()
    {
        gridboxHelper::checkUserEditLevel();
        $cid = JFactory::getApplication()->input->get('cid', array(), 'array');
        $model = $this->getModel();
        $flag = true;
        foreach ($cid as $id) {
            $table = $model->getTable();
            $table->load($id);
            if ($table->home * 1 == 1) {
                $flag = false;
            }
        }
        if ($flag) {
            $this->checkItems($cid);
            parent::delete();
            gridboxHelper::deleteThemeCss($cid);
            gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_DELETED');
        } else {
            gridboxHelper::ajaxReload('CANT_DELETE_DEFAULT_THEME');
        }
    }
    
    public function duplicate()
    {
        gridboxHelper::checkUserEditLevel();
        $pks = $this->input->getVar('cid', array(), 'post', 'array');
        $model = $this->getModel();
        $model->duplicate($pks);
        gridboxHelper::ajaxReload('GRIDBOX_DUPLICATED');
    }

    public function addNewTheme($xml)
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->addNewTheme($xml);
    }

    public function uploadTheme()
    {
        gridboxHelper::checkUserEditLevel();
        $msg = 'SUCCESS_UPLOAD';
        $type = '';
        $file = $_GET['file'];
        $ext = strtolower(JFile::getExt($file));
        if ($ext == 'xml') {
            $config = JFactory::getConfig();
            $name = $config->get('tmp_path') . '/' .$file;
            /*file_put_contents(
                $name,
                file_get_contents('php://input')
            );*/
            $input = JFactory::getApplication()->input;
            $userfile = $input->files->get('file', null, 'raw');
            JFile::upload($userfile['tmp_name'], $name, false, true);
            $xml = simplexml_load_file($name);
            $model = $this->getModel();
            $model->addNewTheme($xml);
        } else {
            $type = 'ba-alert';
            $msg = 'UPLOAD_ERROR';
        }
        gridboxHelper::ajaxReload($msg, $type);
    }

    public function downloadTheme()
    {
        gridboxHelper::checkUserEditLevel();
        $data = file_get_contents('php://input');
        $xml = simplexml_load_string($data);
        $model = $this->getModel();
        $model->addNewTheme($xml);
        $msg = 'SUCCESS_UPLOAD';
        gridboxHelper::ajaxReload($msg);
    }

    public function downloadThemeCurl()
    {
        gridboxHelper::checkUserEditLevel();
        $xml = gridboxHelper::getContentsCurl($_POST['url']);
        $model = $this->getModel();
        $model->addNewTheme($xml);
        $msg = 'SUCCESS_UPLOAD';
        gridboxHelper::ajaxReload($msg);
    }
}