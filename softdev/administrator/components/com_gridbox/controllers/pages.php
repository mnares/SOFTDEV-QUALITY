<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class gridboxControllerPages extends JControllerAdmin
{
    public function getModel($name = 'gridbox', $prefix = 'gridboxModel', $config = array())
    {
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }

    public function orderPages()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->orderPages();
        exit();
    }

    public function orderApps()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->orderApps();
        exit();
    }

    public function addLanguage()
    {
        gridboxHelper::checkUserEditLevel();
        $url = $_POST['url'];
        $name = explode('/', $url);
        $name = end($name);
        $config = JFactory::getConfig();
        $path = $config->get('tmp_path') . '/'. $name;
        $name = explode('.', $name);
        $data = base64_decode($_POST['zip']);
        $file = fopen($path, "w+");
        fputs($file, $data);
        fclose($file);
        JArchive::extract($path, $config->get('tmp_path') . '/' .$name[0]);
        $installer = JInstaller::getInstance();
        $result = $installer->install($config->get('tmp_path') . '/'. $name[0]);
        JFile::delete($path);
        JFolder::delete( $config->get('tmp_path') . '/' .$name[0]);
        echo JText::_('SUCCESS_INSTALL');
        exit;
    }    

    public function setFilters()
    {
        gridboxHelper::checkUserEditLevel();
        $view = $_POST['view'];
        $model = $this->getModel($view);
        $model->setFilters();
        exit;
    }

    public function checkBlogsTour()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->checkBlogsTour();
    }

    public function checkSidebarTour()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->checkSidebarTour();
    }

    public function addTrash()
    {
        gridboxHelper::checkUserEditLevel();
        $pks = $this->input->getVar('cid', array(), 'post', 'array');
        $model = $this->getModel();
        $model->trash($pks);
        gridboxHelper::ajaxReload($this->text_prefix . '_N_ITEMS_TRASHED');
    }

    public function contextTrash()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $array = array();
        $array[] = $id;
        $model = $this->getModel();
        $model->trash($array);
        gridboxHelper::ajaxReload($this->text_prefix . '_N_ITEMS_TRASHED');
    }

    public function getAppLicense()
    {
        gridboxHelper::checkUserEditLevel();
        $expire = $_POST['expires'];
        gridboxHelper::setAppLicense($expire);
        gridboxHelper::ajaxReload('SUCCESS_INSTALL');
    }

    public function addPlugins()
    {
        gridboxHelper::checkUserEditLevel();
        $data = json_decode($_POST['plugins']);
        $db = JFactory::getDbo();
        foreach ($data as $group) {
            foreach ($group as $plugin) {
                $db->insertObject('#__gridbox_plugins', $plugin);
            }
        }
    }

    public function applySingle()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->applySingle();
    }

    public function deleteApp()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->deleteApp();
        $this->setRedirect('index.php?option=com_gridbox');
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_DELETED');
    }

    public function duplicateApp()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->duplicateApp();
        
        gridboxHelper::ajaxReload('GRIDBOX_DUPLICATED');
    }

    public function addApp()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->addApp();
    }

    public function publish()
    {
        gridboxHelper::checkUserEditLevel();
        $task = $this->getTask();
        if ($task != 'unpublish') {
            $value = 1;
            $text = $this->text_prefix . '_N_ITEMS_PUBLISHED';
        } else {
            $value = 0;
            $text = $this->text_prefix . '_N_ITEMS_UNPUBLISHED';
        }
        $cid = JFactory::getApplication()->input->get('cid', array(), 'array');
        $model = $this->getModel();
        $model->publish($cid, $value);
        gridboxHelper::ajaxReload($text);
    }

    public function checkRate()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->checkRate();
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
    
    public function duplicate()
    {
        gridboxHelper::checkUserEditLevel();
        $pks = $this->input->getVar('cid', array(), 'post', 'array');
        $model = $this->getModel();
        $model->duplicate($pks);
        gridboxHelper::ajaxReload('GRIDBOX_DUPLICATED');
    }
    
    public function updateGridbox()
    {
        gridboxHelper::checkUserEditLevel();
        $config = JFactory::getConfig();
        $path = $config->get('tmp_path') . '/pkg_Gridbox.zip';
        $data = file_get_contents('php://input');
        $data = base64_decode($data);
        $file = fopen($path, "w+");
        fputs($file, $data);
        fclose($file);
        JArchive::extract($path, $config->get('tmp_path') . '/pkg_Gridbox');
        $installer = JInstaller::getInstance();
        $result = $installer->update($config->get('tmp_path') . '/pkg_Gridbox');
        JFile::delete($path);
        JFolder::delete( $config->get('tmp_path') . '/pkg_Gridbox' );
        $result = true;
        $verion = gridboxHelper::aboutUs();
        if ($result) {
            echo new JResponseJson($result, $verion->version);
        } else {
            echo new JResponseJson($result, '', true);
        }
        jexit();
    }
    
    public function exportXML()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->exportXML();
    }
    
    public function download()
    {
        gridboxHelper::checkUserEditLevel();
        $file = $_GET['file'];
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }    
}