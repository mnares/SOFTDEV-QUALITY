<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.path');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
use Joomla\Registry\Registry;

class gridboxModelTags extends JModelList
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'title', 'published', 'state', 'hits', 'order_list'
            );
        }
        parent::__construct($config);
    }

    public function updateTags()
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
            $obj->published = 1;
        } else {
            $obj->published = 0;
        }
        $obj->alias = gridboxHelper::getAlias($obj->alias, '#__gridbox_tags', $obj->id);
        $obj->access = $_POST['category_access'];
        $obj->language = $_POST['category_language'];
        $obj->description = $_POST['category_description'];
        $obj->image = $_POST['category_intro_image'];
        $obj->meta_title = $_POST['category_meta_title'];
        $obj->meta_description = $_POST['category_meta_description'];
        $obj->meta_keywords = $_POST['category_meta_keywords'];
        $db->updateObject('#__gridbox_tags', $obj, 'id');
    }

    public function addTag($title)
    {
        $db = JFactory::getDbo();
        $obj = new stdClass();
        $obj->id = 0;
        $obj->title = $title;
        $obj->alias = gridboxHelper::getAlias($title, '#__gridbox_tags');
        $db->insertObject('#__gridbox_tags', $obj);
    }

    public function duplicate($pks)
    {
        $db = JFactory::getDbo();
        foreach ($pks as $pk) {
            $query = $db->getQuery(true)
                ->select('*')
                ->from('#__gridbox_tags')
                ->where('id = '.$pk);
            $db->setQuery($query);
            $obj = $db->loadObject();
            $obj->id = 0;
            $obj->hits = 0;
            $obj->published = 0;
            $obj->title = $this->getNewTitle($obj->title);
            $obj->alias = gridboxHelper::getAlias($obj->alias, '#__gridbox_tags');
            $db->insertObject('#__gridbox_tags', $obj);
        }
    }

    public function getNewTitle($title)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_tags')
            ->where('`title` = ' .$db->Quote($title));
        $db->setQuery($query);
        $id = $db->loadResult();
        if (!empty($id)) {
            $title = JString::increment($title);
            $title = $this->getNewTitle($title);
        }
        
        return $title;
    }

    public function publish($cid, $value)
    {
        $db = JFactory::getDbo();
        foreach ($cid as $id) {
            $obj = new stdClass();
            $obj->id = $id * 1;
            $obj->published = $value * 1;
            $db->updateObject('#__gridbox_tags', $obj, 'id');
        }
    }

    public function delete($cid)
    {
        $db = JFactory::getDbo();
        foreach ($cid as $id) {
            $query = $db->getQuery(true)
                ->delete('#__gridbox_tags')
                ->where('id = '.$id);
            $db->setQuery($query)
                ->execute();
            $query = $db->getQuery(true)
                ->delete('#__gridbox_tags_map')
                ->where('tag_id = '.$id);
            $db->setQuery($query)
                ->execute();
        }
    }

    public function setGridboxFilters()
    {
        $app = JFactory::getApplication();
        $ordering = $app->getUserStateFromRequest($this->context . '.ordercol', 'filter_order', null);
        $direction = $app->getUserStateFromRequest($this->context . '.orderdirn', 'filter_order_Dir', null);
        gridboxHelper::setGridboxFilters($ordering, $direction, $this->context);
    }

    public function getGridboxFilters()
    {
        $array = gridboxHelper::getGridboxFilters($this->context);
        if (!empty($array)) {
            foreach ($array as $obj) {
                $name = str_replace($this->context.'.', '', $obj->name);
                $this->setState($name, $obj->value);
            }
        }
    }

    public function setFilters()
    {
        $this->setGridboxFilters();
        $this::populateState();
    }
    
    protected function getListQuery()
    {
        $this->getGridboxFilters();
        $app = JFactory::getApplication();
        $id = $_GET['id'];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__gridbox_tags')
            ->where('`order_list` = 0');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        if (!empty($items)) {
            $query = $db->getQuery(true)
                ->select('MAX(order_list) as max, COUNT(id) as count')
                ->from('#__gridbox_tags')
                ->where('`order_list` <> 0');
            $db->setQuery($query);
            $obj = $db->loadObject();
            if ($obj->count == 0) {
                $obj->max = 0;
            }
            foreach ($items as $value) {
                $value->order_list = ++$obj->max;
                $db->updateObject('#__gridbox_tags', $value, 'id');
            }
        }
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_tags');
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->quote('%' . $db->escape($search, true) . '%', false);
            $query->where('title LIKE ' . $search);
        }
        $published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('published = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(published IN (0, 1))');
		}
        $orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'desc');
		if ($orderCol == 'ordering') {
			$orderCol = 'title ' . $orderDirn . ', ordering';
		}
		$query->order($db->escape($orderCol . ' ' . $orderDirn));
        
        return $query;
    }

    public function getItems()
    {
        $store = $this->getStoreId();
        $app = JFactory::getApplication();
        if (isset($this->cache[$store])) {
            return $this->cache[$store];
        }
        $query = $this->_getListQuery();
        try
        {
            $items = $this->_getList($query, $this->getStart(), $this->getState('list.limit'));
        }
        catch (RuntimeException $e)
        {
            $this->setError($e->getMessage());
            return false;
        }
        $db = JFactory::getDbo();
        foreach ($items as $tag) {
            $query = $db->getQuery(true)
                ->select('COUNT(*)')
                ->from('#__gridbox_tags_map')
                ->where('tag_id = '.$tag->id);
            $db->setQuery($query);
            $tag->count = $db->loadResult();
        }
        $this->cache[$store] = $items;

        return $this->cache[$store];
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
}