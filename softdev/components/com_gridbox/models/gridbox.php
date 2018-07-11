<?php
/**
* @package   Grifbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
jimport('joomla.filesystem.file');

class gridboxModelGridbox extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getAppLayout()
    {
        $db = JFactory::getDbo();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $query = $db->getQuery(true)
            ->select('app_layout')
            ->from('`#__gridbox_app` AS b')
            ->where('id = ' .$id);
        $db->setQuery($query);
        $item = $db->loadResult();
        if (empty($item)) {
            $item = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/app.php');
        }
        
        return $item;
    }

    public function getAppItems()
    {
        $db = JFactory::getDbo();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $query = $db->getQuery(true)
            ->select('app_items')
            ->from('`#__gridbox_app` AS b')
            ->where('id = ' .$id);
        $db->setQuery($query);
        $item = $db->loadResult();
        if (empty($item)) {
            $item = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/app.json');
        }
        
        return $item;
    }

    public function getPageLayout()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('b.id')
            ->from('`#__gridbox_pages` AS b')
            ->where('b.id = ' .$id)
            ->select('a.page_layout')
            ->leftJoin('`#__gridbox_app` AS a'
                . ' ON '
                . $db->quoteName('b.app_id')
                . ' = ' 
                . $db->quoteName('a.id')
            );
        $db->setQuery($query);
        $item = $db->loadObject();
        if (empty($item->page_layout)) {
            $item->page_layout = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/default.php');
        }
        
        return $item->page_layout;
    }

    public function getPageItems()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('b.id')
            ->from('`#__gridbox_pages` AS b')
            ->where('b.id = ' .$id)
            ->select('a.page_items')
            ->leftJoin('`#__gridbox_app` AS a'
                . ' ON '
                . $db->quoteName('b.app_id')
                . ' = ' 
                . $db->quoteName('a.id')
            );
        $db->setQuery($query);
        $item = $db->loadObject();
        if (empty($item->page_items)) {
            $item->page_items = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/default.json');
        }
        
        return $item->page_items;
    }
    
    public function createPage()
    {
        $type = '';
        $db = JFactory::getDbo();
        $input = JFactory::getApplication()->input;
        $app_id = $input->get('app_id', 0, 'int');
        $title = $input->get('ba-title', '', 'string');
        if ($app_id != 0) {
            $query = $db->getQuery(true)
                ->select('type')
                ->from('#__gridbox_app')
                ->where('id = '.$app_id);
            $db->setQuery($query);
            $type = $db->loadResult();
        }
        $theme = $input->get('page_theme', 0, 'int');
        $table = $this->getTable();
        $title = strip_tags($title);
        $alias = $title;
        $alias = gridboxHelper::getAlias($alias, '#__gridbox_pages', 'page_alias');
        $nowDate = date("Y-m-d H:i:s");
        $count = '12';
        $span = explode('+', $count);
        $count = count($span);
        $obj = new stdClass();
        $obj->items = new stdClass();
        if ($type == 'blog') {
            $obj->html = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/post.php');
        } else {
            $now = strtotime(date('Y-m-d G:i:s')) * 10;
            include JPATH_ROOT.'/components/com_gridbox/views/layout/section.php';
            $obj->html = $out;
        }
        $table->bind(array('title' => $title, 'page_alias' => $alias, 'page_category' => $_POST['category'],
            'params' => $obj->html, 'style' => json_encode($obj->items),
            'app_id' => $app_id, 'theme' => $theme, 'created' => $nowDate));
        $table->store();

        return $table->id;
    }
    
    public function getItem($id = null)
    {
        $input = JFactory::getApplication()->input;
        $db = $this->getDbo();
        $edit_type = $input->get('edit_type', '', 'string');
        $id = $input->get('id', 0, 'int');
        $query = $db->getQuery(true);
        if ($edit_type == 'blog') {
            $query->select('b.id, b.title, b.alias, b.theme, b.type, b.saved_time')
                ->from('`#__gridbox_app` AS b')
                ->where('b.id = ' .$id)
                ->select('t.title as ThemeTitle')
                ->leftJoin('`#__template_styles` AS t'
                    . ' ON '
                    . $db->quoteName('b.theme')
                    . ' = ' 
                    . $db->quoteName('t.id')
                );
        } else if (empty($edit_type)) {
            $query->select('b.*')
                ->from('`#__gridbox_pages` AS b')
                ->where('b.id = ' .$id)
                ->select('a.type as app_type')
                ->leftJoin('`#__gridbox_app` AS a'
                    . ' ON '
                    . $db->quoteName('b.app_id')
                    . ' = ' 
                    . $db->quoteName('a.id')
                )
                ->select('c.title AS category_title')
                ->leftJoin('`#__gridbox_categories` AS c'
                    . ' ON '
                    . $db->quoteName('b.page_category')
                    . ' = ' 
                    . $db->quoteName('c.id')
                );
        } else if ($edit_type == 'system') {
            $query->select('*')
                ->from('#__gridbox_system_pages')
                ->where('id = '.$id);
        }
        $db->setQuery($query);
        $item = $db->loadObject();
        
        return $item;
    }

    public function getSystemLayout()
    {
        $input = JFactory::getApplication()->input;
        $db = $this->getDbo();
        $id = $input->get('id', 0, 'int');
        $query = $db->getQuery(true)
            ->select('type')
            ->from('#__gridbox_system_pages')
            ->where('id = '.$id);
        $db->setQuery($query);
        $type = $db->loadResult();
        $item = new stdClass();
        $item->html = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/system/'.$type.'.php');
        $item->items = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/system/'.$type.'.json');
        
        return $item;
    }
    
    public function getForm()
    {
        $form = JForm::getInstance('gridbox', JPATH_COMPONENT.'/models/forms/gridbox.xml');
        
        return $form;
    }
}
