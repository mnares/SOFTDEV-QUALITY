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
jimport('joomla.filter.output');

class gridboxControllerTrashed extends JControllerAdmin
{
    public function getModel($name = 'gridbox', $prefix = 'gridboxModel', $config = array()) 
    {
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }

    public function getCategories()
    {
        gridboxHelper::checkUserEditLevel();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title, type')
            ->from('#__gridbox_app')
            ->order($db->escape('order_list ASC'));
        $db->setQuery($query);
        $obj = new stdClass();
        $obj->id = 0;
        $obj->title = JText::_('SINGLE_PAGES');
        $obj->type = 'single';
        $items = array($obj);
        $apps = $db->loadObjectList();
        $items = array_merge($items, $apps);
        foreach ($items as $item) {
            $query = $db->getQuery(true)
                ->select('id, title')
                ->from('#__gridbox_categories')
                ->where('parent = 0')
                ->where('app_id = ' .$item->id);
            $db->setQuery($query);
            $item->categories = $db->loadObjectList();
            foreach ($item->categories as $value) {
                $value->child = $this->getAllChild($value, $item->id);
            }
        }
        $result = json_encode($items);
        echo $result;
        exit;
    }

    protected function getAllChild($parent, $id)
    {
        gridboxHelper::checkUserEditLevel();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_categories')
            ->where('`app_id` = '.$id)
            ->where('`parent` = '.$parent->id);
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $key => $value) {
            $value->child = $this->getAllChild($value, $id);
        }

        return $items;
    }

    public function contextDelete()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $array = array();
        $array[] = $id;
        $model = $this->getModel();
        $model->delete($array);
        gridboxHelper::deleteTagsLink($array);
        gridboxHelper::deletePageCss($array);
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_DELETED');
    }

    public function delete()
    {
        gridboxHelper::checkUserEditLevel();
        parent::delete();
        $cid = JFactory::getApplication()->input->get('cid', array(), 'array');
        gridboxHelper::deletePageCss($cid);
        gridboxHelper::deleteTagsLink($cid);
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_DELETED');
    }

    public function restoreSingle()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $category = $_POST['category_id'];
        $model = $this->getModel();
        $model->moveSingle($id, $category);
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_RESTORED');
    }

    public function restoreBlog()
    {
        gridboxHelper::checkUserEditLevel();
        $id = $_POST['context-item'];
        $category = $_POST['category_id'];
        $model = $this->getModel($name = 'blogs', $prefix = 'gridboxModel', $config = array());
        $model->restore($id, $category);
        gridboxHelper::ajaxReload('COM_GRIDBOX_N_ITEMS_RESTORED');
    }
}