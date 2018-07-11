<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxViewBlog extends JViewLegacy
{
    protected $item;
    protected $category;
    
    public function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id');
        if ($id == '') {
            return JError::raiseError(404, JText::_('NOT_FOUND'));
        }
        $this->item = $this->get('Item');
        if (empty($this->item)) {
            return JError::raiseError(404, JText::_('NOT_FOUND'));
        }
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        if (!in_array($this->item->access, $groups)) {
            JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return;
        }
        $app = $input->get('app');
        $itemId = $input->get('Itemid');
        $menus = JFactory::getApplication()->getMenu('site');
        $attributes = array('link');
        $link = 'index.php?option=com_gridbox&view=blog&app='.$app.'&id='.$id;
        $values = array($link);
        $menuItems = $menus->getItems($attributes, $values);
        $menuFlag = gridboxHelper::checkMenuItems($menuItems, $itemId);
        if (!empty($menuItems) && !empty($itemId) && $menuFlag) {
            $link = JRoute::_('index.php?Itemid='.$menuItems[0]->id);
            header('Location: '.$link);
            exit;
        }
        if (empty($menuItems)) {
            $link = 'index.php?option=com_gridbox&view=blog&app='.$app.'&id=0';
            $values = array($link);
            $menuFlag = gridboxHelper::checkMenuItems($menuItems, $itemId);
            if (!empty($menuItems) && !empty($itemId) && $menuFlag) {
                return JError::raiseError(404, JText::_('NOT_FOUND'));
            }
        }
        $this->setBreadcrumb();
        $this->item->params = gridboxHelper::checkModules($this->item->app_layout, $this->item->app_items);
        $this->category = $this->get('Category');
        $this->prepareDocument();
        parent::display($tpl);
    }

    public function setBreadcrumb()
    {
        $app = JFactory::getApplication();
        $pathway = $app->getPathway();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id');
        if ($id > 0) {
            $array = gridboxHelper::getCategoryBreadcrumb($id);
            $path = array_reverse($array);
            foreach ($path as $key => $value) {
                $pathway->addItem($value['title'], $value['link']);
            }
        }
    }

    public function prepareDocument()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $doc = JFactory::getDocument();
        $doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
        $doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
        $time = $this->item->saved_time;
        if (!empty($time)) {
            $time = '?'.$time;
        }
        $doc->addStyleSheet(JUri::root().'components/com_gridbox/assets/css/storage/app-'.$this->item->id.'.css'.$time);
        gridboxHelper::checkMoreScripts($this->item->params);
        $app = JFactory::getApplication();
        $menus = $app->getMenu();
        $menu = $menus->getActive();
        if (isset($menu) && $menu->query['option'] == 'com_gridbox' && $menu->query['view'] == 'blog'
                && $menu->query['app'] == $this->item->id && $menu->query['id'] == $id) {
            $params  = $menus->getParams($menu->id);
            $title = $params->get('page_title');
            $desc = $params->get('menu-meta_description');
            $keywords = $params->get('menu-meta_keywords');
        } else if (!empty($this->category)) {
            $title = $this->category->meta_title;
            $desc = $this->category->meta_description;
            $keywords = $this->category->meta_keywords;
            if (empty($title)) {
                $title = $this->category->title;
            }
        } else {
            $title = '';
            $desc = '';
            $keywords = '';
        }
        if (empty($title)) {
            $title = $this->item->title;
        }
        $tag = $input->get('tag', '');
        if (!empty($tag)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('title, meta_title, meta_description, meta_keywords')
                ->from('#__gridbox_tags')
                ->where('`id` = '.$tag * 1);
            $db->setQuery($query);
            $obj = $db->loadObject();
            $title = $obj->meta_title;
            $desc = $obj->meta_description;
            $keywords = $obj->meta_keywords;
            if (empty($title)) {
                $title = $obj->title;
            }
        }
        if ($app->get('sitename_pagetitles', 0) == 1) {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        } else if ($app->get('sitename_pagetitles', 0) == 2) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }
        $doc->setTitle($title);
        $doc->setDescription($desc);
        $doc->setMetaData('keywords', $keywords);
    }
}