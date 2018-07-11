<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxModelBaforms extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItems()
    {
        $id = gridboxHelper::getComBa('com_baforms');
        if (!$id) {
            return array();
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title')
            ->from('`#__baforms_forms`')
            ->where('`published` = 1');
        if (isset($_COOKIE["baforms_search"]) && !empty($_COOKIE["baforms_search"])) {
            $query->where('title LIKE '.$db->quote('%'.$db->escape($_COOKIE["baforms_search"], true).'%'));
        }
        $orderCol = 'id';
        $orderDirn = 'desc';
        if (isset($_COOKIE["baforms_ordering"])) {
            $orderCol = $_COOKIE["baforms_ordering"];
        }
        if (isset($_COOKIE["baforms_direction"])) {
            $orderDirn = $_COOKIE["baforms_direction"];
        }
        $query->order($db->escape($orderCol . ' ' . $orderDirn));
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }
}