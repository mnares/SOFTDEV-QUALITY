<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxModelPages extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getPages()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('b.id, b.title, b.published')
            ->from('`#__gridbox_pages` AS b')
            ->select('t.title as theme')
            ->leftJoin('`#__template_styles` AS t  ON ' .$db->quoteName('b.theme'). ' = ' . $db->quoteName('t.id'));
        $query = $this->getCondition($query);
        $orderCol = 'id';
        $orderDirn = 'desc';
        if (isset($_COOKIE["pages_ordering"])) {
            $orderCol = $_COOKIE["pages_ordering"];
        }
        if (isset($_COOKIE["pages_direction"])) {
            $orderDirn = $_COOKIE["pages_direction"];
        }
        $query->order($db->escape($orderCol . ' ' . $orderDirn));
        $limit = 20;
        $start = 0;
        if (isset($_COOKIE["pages_limit"])) {
            $limit = $_COOKIE["pages_limit"] * 1;
        }
        if (isset($_COOKIE["pages_start"]) && $_COOKIE["pages_start"] != 0) {
            $start = $_COOKIE["pages_start"] * 1 + $limit - 1;
        }
        $db->setQuery($query, $start, $limit);
        $items = $db->loadObjectList();
        if (isset($_GET['type']) && $_GET['type'] == 'system') {
            foreach ($items as $key => $item) {
                $item->published = 1;
            }
        }
        
        return $items;
    }

    public function getPageCount()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('count(b.id)')
            ->from('`#__gridbox_pages` AS b');
        $query = $this->getCondition($query);
        $db->setQuery($query);
        $count = $db->loadResult();
        $limit = 20;
        if (isset($_COOKIE["pages_limit"])) {
            $limit = $_COOKIE["pages_limit"] * 1;
        }
        if ($limit == 0) {
            $count = 0;
        } else {
            $count = ceil($count / $limit) - 1;
        }
        
        return $count;
    }

    public function getCondition($query)
    {
        $db = JFactory::getDbo();
        $app = 0;
        if (isset($_GET['app'])) {
            $app = $_GET['app'];
        }
        $query->where('b.app_id = '.$db->quote($app))
            ->where('b.page_category <> '.$db->quote('trashed'));
        if (isset($_COOKIE["pages_search"]) && !empty($_COOKIE["pages_search"])) {
            $query->where('b.title LIKE '.$db->quote('%'.$db->escape($_COOKIE["pages_search"], true).'%'));
        }
        if (isset($_GET['category'])) {
            $query->where('b.page_category = '.$db->quote($db->escape($_GET['category'], true)));
        }
        if (isset($_COOKIE["pages_status"]) && $_COOKIE["pages_status"] != '') {
            $query->where('b.published = '.$db->quote($db->escape($_COOKIE["pages_status"], true)));
        }
        if (isset($_GET['type']) && $_GET['type'] == 'system') {
            $query = $db->getQuery(true)
                ->select('b.id, b.title')
                ->from('`#__gridbox_system_pages` AS b')
                ->select('t.title as theme')
                ->leftJoin('`#__template_styles` AS t  ON ' .$db->quoteName('b.theme'). ' = ' . $db->quoteName('t.id'));
        }

        return $query;
    }

    public function getApps()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title, type')
            ->from('#__gridbox_app')
            ->where('type <> '.$db->quote('tags'))
            ->order('order_list ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $key => $item) {
            $item->categories = $this->getCategories($item->id);
        }

        return $items;
    }

    protected function getCategories($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title')
            ->from('#__gridbox_categories')
            ->where('`app_id` = '.$id)
            ->where('`parent` = 0')
            ->order('order_list ASC');
        $db->setQuery($query);
        $categories = $db->loadObjectList();
        foreach ($categories as $value) {
            $value->child = $this->getAllChild($value);
        }

        return $categories;
    }

    protected function getAllChild($parent)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title')
            ->from('#__gridbox_categories')
            ->where('`parent` = '.$parent->id);
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $key => $value) {
            $value->child = $this->getAllChild($value);
        }

        return $items;
    }
}