<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxModelMenu extends JModelItem
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
            ->where('`client_id` = 0')
            ->where('module = '.$db->quote('mod_menu'));
        if (isset($_COOKIE["modules_search"]) && !empty($_COOKIE["menu_search"])) {
            $query->where('title LIKE '.$db->quote('%'.$db->escape($_COOKIE["menu_search"], true).'%'));
        }
        $orderCol = 'id';
        $orderDirn = 'desc';
        if (isset($_COOKIE["menu_ordering"])) {
            $orderCol = $_COOKIE["menu_ordering"];
        }
        if (isset($_COOKIE["menu_direction"])) {
            $orderDirn = $_COOKIE["menu_direction"];
        }
        $query->order($db->escape($orderCol . ' ' . $orderDirn));
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }
}