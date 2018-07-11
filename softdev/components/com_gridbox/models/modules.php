<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxModelModules extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItems()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title, position, module')
            ->from('`#__modules`')
            ->where('`published` = 1')
            ->where('`client_id` = 0');
        if (isset($_COOKIE["modules_search"]) && !empty($_COOKIE["modules_search"])) {
            $query->where('title LIKE '.$db->quote('%'.$db->escape($_COOKIE["modules_search"], true).'%'));
        }
        if (isset($_COOKIE["modules_type"]) && !empty($_COOKIE["modules_type"])) {
            $query->where('module = '.$db->quote($db->escape($_COOKIE["modules_type"], true)));
        }
        if (isset($_COOKIE["modules_position"]) && !empty($_COOKIE["modules_position"])) {
            $query->where('position = '.$db->quote($db->escape($_COOKIE["modules_position"], true)));
        }
        $orderCol = 'id';
        $orderDirn = 'desc';
        if (isset($_COOKIE["modules_ordering"])) {
            $orderCol = $_COOKIE["modules_ordering"];
        }
        if (isset($_COOKIE["modules_direction"])) {
            $orderDirn = $_COOKIE["modules_direction"];
        }
        $query->order($db->escape($orderCol . ' ' . $orderDirn));
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }

    public function getFilters()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('position, module')
            ->from('`#__modules`')
            ->where('`published` = 1')
            ->where('`client_id` = 0');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }
}