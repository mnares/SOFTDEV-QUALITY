<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die; 

jimport('joomla.application.component.modeladmin');

class gridboxModelCategory extends JModelList
{
    public function getTable($type = 'Categories', $prefix = 'gridboxTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function orderCategories()
    {
        $data = json_decode($_POST['data']);
        foreach ($data as $value) {
            $db = JFactory::getDbo();
            $db->updateObject('#__gridbox_categories', $value, 'id');
        }
    }

    public function pageMoveTo()
    {
        $obj = json_decode($_POST['category_id']);
        $obj->page_category = $obj->id;
        $obj->id = $_POST['context-item'];
        $db = JFactory::getDbo();
        $db->updateObject('#__gridbox_pages', $obj, 'id');
    }

    public function updateCategory()
    {
        $obj = new stdClass();
        $obj->title = $_POST['category_title'];
        $obj->alias = $_POST['category_alias'];
        $obj->id = $_POST['category-id'];
        $db = JFactory::getDbo();
        if (empty($obj->alias)) {
            $obj->alias = $obj->title;
        }
        if (isset($_POST['category_publish'])) {
            $query = $db->getQuery(true)
                ->select('published')
                ->from('#__gridbox_categories')
                ->where('id = '.$_POST['category_parent']);
            $db->setQuery($query);
            $result = $db->loadResult();
            if ($result == 0 && $_POST['category_parent'] != 0) {
                $obj->published = 0;
            } else {
                $obj->published = 1;
            }
        } else {
            $obj->published = 0;
        }
        $obj->alias = gridboxHelper::getAlias($obj->alias, '#__gridbox_categories', $obj->id);
        $obj->access = $_POST['category_access'];
        $obj->language = $_POST['category_language'];
        $obj->description = $_POST['category_description'];
        $obj->image = $_POST['category_intro_image'];
        $obj->meta_title = $_POST['category_meta_title'];
        $obj->meta_description = $_POST['category_meta_description'];
        $obj->meta_keywords = $_POST['category_meta_keywords'];
        
        $db->updateObject('#__gridbox_categories', $obj, 'id');
        if ($obj->published == 0) {
            $this->checkChilds($obj->id);
        }
    }

    public function checkChilds($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_categories')
            ->where('`parent` = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();
        if (isset($obj->id)) {
            $obj->published = 0;
            $db->updateObject('#__gridbox_categories', $obj, 'id');
            $this->checkChilds($obj->id);
        }
    }

    public function removeCategory()
    {
        $obj = $_POST['context-item'];
        $obj = json_decode($obj);
        $pages = $this->getPages($obj);
        $db = JFactory::getDbo();
        foreach ($pages as $page) {
            $obj = new stdClass();
            $obj->id = $page;
            $obj->published = 0;
            $obj->page_category = 'trashed';
            $db->updateObject('#__gridbox_pages', $obj, 'id');
        }
    }

    public function getPages($item, $array = array())
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_pages')
            ->where('`page_category` = '.$item->id);
        $db->setQuery($query);
        $values = $db->loadColumn();
        foreach ($values as $value) {
            $array[] = $value;
        }
        if (!empty($item->child)) {
            foreach ($item->child as $child) {
                $array = $this->getPages($child, $array);
            }
        }
        $query = $db->getQuery(true);
        $query->delete('#__gridbox_categories')
            ->where('`id` = '. $item->id);
        $db->setQuery($query)
            ->execute();
        return $array;
    }

    protected function getListQuery()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title, id')
            ->from('#__gridbox_categories')
            ->where('published = 1')
            ->where('app_id = '.$_GET['id'])
            ->order($db->escape('order_list DESC'));
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->quote('%' . $db->escape($search, true) . '%', false);
            $query->where('title LIKE ' . $search);
        }

        return $query;
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.state');
        return parent::getStoreId($id);
    }
    
    protected function populateState($ordering = null, $direction = null)
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $published = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
        $this->setState('filter.state', $published);
        parent::populateState('id', 'desc');
    }

    public function getItems()
    {
        $store = $this->getStoreId();
        $app = JFactory::getApplication();
        if (isset($this->cache[$store]))
        {
            return $this->cache[$store];
        }
        $query = $this->_getListQuery();
        try
        {
            $items = $this->_getList($query, 0, 0);
            $search = $this->getState('filter.search');
            if (empty($search) || strpos('root', $search) !== false) {
                $obj = new stdClass();
                $obj->title = JText::_('ROOT');
                $obj->id = 0;
                $items[] = $obj;
                $items = array_reverse($items);
            }

        }
        catch (RuntimeException $e)
        {
            $this->setError($e->getMessage());
            return false;
        }
        $this->cache[$store] = $items;

        return $this->cache[$store];
    }

    public function moveTo()
    {
        $obj = json_decode($_POST['category_id']);
        $obj->parent = $obj->id;
        $obj->id = $_POST['context-item'];
        $db = JFactory::getDbo();
        $db->updateObject('#__gridbox_categories', $obj, 'id');
        $query = $db->getQuery(true)
            ->update('#__gridbox_pages')
            ->where('page_category = '.$obj->id)
            ->set('app_id = '.$obj->app_id);
        $db->setQuery($query)
            ->execute();
    }

    public function createCat()
    {
        $title = $_POST['category_name'];
        $blog = $_POST['blog'];
        $parent = $_POST['parent_id'];
        $order = $_POST['category_order_list'];
        $alias = gridboxHelper::getAlias($title, '#__gridbox_categories');
        $table = $this->getTable();
        $table->bind(array('title' => $title, 'alias' => $alias, 'access' => 1, 'app_id' => $blog,
            'parent' => $parent, 'order_list' => $order));
        $table->store();

        return $table->id;
    }

    public function duplicate()
    {
        $id = $_POST['context-item'];
        $table = $this->getTable();
        $table->load($id);
        $table->id = 0;
        $table->title = $this->getNewTitle($table->title);
        $table->alias = $this->getNewAlias($table->alias);
        $table->alias = gridboxHelper::getAlias($table->alias, '#__gridbox_categories');
        $table->store();

        return $table->id;
    }

    protected function getNewTitle($title)
    {
        $table = $this->getTable();
        while ($table->load(array('title' => $title)))
        {
            $title = JString::increment($title);
        }

        return $title;
    }

    protected function getNewAlias($alias)
    {
        $table = $this->getTable();
        while ($table->load(array('alias' => $alias)))
        {
            $alias = JString::increment($alias);
        }

        return $alias;
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option . '.gridbox', 'gridbox', array('control' => 'jform', 'load_data' => $loadData)
        );
        
        if (empty($form)) {
            return false;
        }
 
        return $form;
    }
}