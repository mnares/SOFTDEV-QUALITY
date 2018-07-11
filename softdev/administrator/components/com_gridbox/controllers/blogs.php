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

class gridboxControllerBlogs extends JControllerAdmin
{
    public function getModel($name = 'gridbox', $prefix = 'gridboxModel', $config = array()) 
    {
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }

    public function pageMoveTo()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category', $prefix = 'gridboxModel', $config = array());
        $model->pageMoveTo();
        gridboxHelper::ajaxReload('SUCCESS_MOVED');
    }

    public function orderCategories()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category');
        $model->orderCategories();
        exit();
    }

    public function updateCategory()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category', $prefix = 'gridboxModel', $config = array());
        $model->updateCategory();
        gridboxHelper::ajaxReload('JLIB_APPLICATION_SAVE_SUCCESS');
    }

    public function deleteCategory()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category', $prefix = 'gridboxModel', $config = array());
        $model->removeCategory();
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_DELETED');
    }

    public function categoryMoveTo()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category', $prefix = 'gridboxModel', $config = array());
        $model->moveTo();
        gridboxHelper::ajaxReload('SUCCESS_MOVED');
    }

    public function categoryDuplicate()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category', $prefix = 'gridboxModel', $config = array());
        $model->duplicate();
        gridboxHelper::ajaxReload('GRIDBOX_DUPLICATED');
    }

    public function applySettings()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->applySettings();
        gridboxHelper::ajaxReload('JLIB_APPLICATION_SAVE_SUCCESS');
    }

    public function addCategory()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel($name = 'category', $prefix = 'gridboxModel', $config = array());
        $obj = new stdClass();
        $obj->id = $model->createCat();
        $obj->msg = JText::_('ITEM_CREATED');
        $obj = json_encode($obj);
        echo $obj;exit();
    }

    public function publish()
    {
        gridboxHelper::checkUserEditLevel();
        parent::publish();
        $task = $this->getTask();
        if ($task != 'unpublish') {
            $text = $this->text_prefix . '_N_ITEMS_PUBLISHED';
        } else {
            $text = $this->text_prefix . '_N_ITEMS_UNPUBLISHED';
        }
        gridboxHelper::ajaxReload($text);
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
    
    public function contextDuplicate()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $blog = $_POST['blog'];
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
        $blog = $_POST['blog'];
        $model = $this->getModel();
        $model->duplicate($pks);
        gridboxHelper::ajaxReload('gridbox_DUPLICATED');
    }

    public function getTags()
    {
        gridboxHelper::checkUserEditLevel();
        $tags = gridboxHelper::getTags();
        $json = json_encode($tags);
        echo $json;
        exit;
    }
}