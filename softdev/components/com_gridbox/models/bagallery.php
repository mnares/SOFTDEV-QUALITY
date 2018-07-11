<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxModelBagallery extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItems()
    {
        $id = gridboxHelper::getComBa('com_bagallery');
        if (!$id) {
            return array();
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title')
            ->from('`#__bagallery_galleries`')
            ->where('`published` = 1');
        if (isset($_COOKIE["bagallery_search"]) && !empty($_COOKIE["bagallery_search"])) {
            $query->where('title LIKE '.$db->quote('%'.$db->escape($_COOKIE["bagallery_search"], true).'%'));
        }
        $orderCol = 'id';
        $orderDirn = 'desc';
        if (isset($_COOKIE["bagallery_ordering"])) {
            $orderCol = $_COOKIE["bagallery_ordering"];
        }
        if (isset($_COOKIE["bagallery_direction"])) {
            $orderDirn = $_COOKIE["bagallery_direction"];
        }
        $query->order($db->escape($orderCol . ' ' . $orderDirn));
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }
}