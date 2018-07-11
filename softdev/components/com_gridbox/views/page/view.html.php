<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxViewPage extends JViewLegacy
{
    protected $item;
    protected $pageLayout;
    
    public function display($tpl = null)
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        if (empty($id)) {
            return JError::raiseError(404, JText::_('NOT_FOUND'));
        }
        $this->item = $this->get('Item');
        if (empty($this->item) || $this->item->page_category == 'trashed') {
            return JError::raiseError(404, JText::_('NOT_FOUND'));
        }
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        if (!in_array($this->item->page_access, $groups)) {
            JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return;
        }
        $itemId = $input->get('Itemid');
        $menus = JFactory::getApplication()->getMenu('site');
        $attributes = array('link');
        $link = 'index.php?option=com_gridbox&view=page&id='.$id;
        $values = array($link);
        $menuItems = $menus->getItems($attributes, $values);
        $menuFlag = gridboxHelper::checkMenuItems($menuItems, $itemId);
        if (!empty($menuItems) && !empty($itemId) && $menuFlag) {
            $link = JRoute::_('index.php?Itemid='.$menuItems[0]->id);
            header('Location: '.$link);
            exit;
        }
        if (!empty($this->item->page_category) && $menuFlag) {
            $link = 'index.php?option=com_gridbox&view=blog&app='.$this->item->app_id.'&id='.$this->item->page_category;
            $values = array($link);
            $menuItems = $menus->getItems($attributes, $values);
            if (empty($menuItems)) {
                $link = 'index.php?option=com_gridbox&view=blog&app='.$this->item->app_id.'&id=0';
                $values = array($link);
                $menuItems = $menus->getItems($attributes, $values);
            }
            $menuFlag = gridboxHelper::checkMenuItems($menuItems, $itemId);
            if (!empty($menuItems) && !empty($itemId) && $menuFlag) {
                return JError::raiseError(404, JText::_('NOT_FOUND'));
            }
        }
        $this->get('Hits');
        $this->setBreadcrumb();
        $this->item->params = gridboxHelper::checkModules($this->item->params, $this->item->style);
        $this->prepareDocument();
        parent::display($tpl);
    }

    public function setBreadcrumb()
    {
        $app = JFactory::getApplication();
        $pathway = $app->getPathway();
        $id = $this->item->page_category;
        if ($id > 0) {
            $array = gridboxHelper::getCategoryBreadcrumb($id);
            $path = array_reverse($array);
            $path[] = array('title' => $this->item->title, 'link' => '');
            foreach ($path as $key => $value) {
                $pathway->addItem($value['title'], $value['link']);
            }
        }
    }

    public function prepareDocument()
    {
        $doc = JFactory::getDocument();
        $doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
        $doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
        $time = $this->item->saved_time;
        if (!empty($time)) {
            $time = '?'.$time;
        }
        $doc->addStyleSheet(JUri::root().'components/com_gridbox/assets/css/storage/style-'.$this->item->id.'.css'.$time);
        gridboxHelper::checkMoreScripts($this->item->params);
        $app = JFactory::getApplication();
        $menus = $app->getMenu();
        $menu = $menus->getActive();
        $title = $this->item->meta_title;
        if (empty($title)) {
            $title = $this->item->title;
        }
        $desc = $this->item->meta_description;
        $keywords = $this->item->meta_keywords;
        if (isset($menu) && $menu->query['view'] == 'page') {
            $params  = $menus->getParams($menu->id);
            $page_title = $params->get('page_title');
            $page_desc = $params->get('menu-meta_description');
            $page_key = $params->get('menu-meta_keywords');
        } else {
            $page_title = '';
            $page_desc = '';
            $page_key = '';
        }
        if (!empty($page_title)) {
            $title = $page_title;
        }
        if (!empty($page_desc)) {
            $desc = $page_desc;
        }
        if (!empty($page_key)) {
            $keywords = $page_key;
        }
        $app = JFactory::getApplication();
        if ($app->get('sitename_pagetitles', 0) == 1) {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        } else if ($app->get('sitename_pagetitles', 0) == 2) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }
        $doc->setTitle($title);
        $doc->setDescription($desc);
        $doc->setMetaData('keywords', $keywords);
        if ($this->item->app_type == 'blog') {
            $this->pageLayout = $this->get('PageLayout');
            $doc->addStyleSheet(JUri::root().'components/com_gridbox/assets/css/storage/post-'.$this->item->app_id.'.css'.$time);
            $this->setLayout('blog');
            $pageItems = $this->get('pageItems');
            $this->pageLayout = gridboxHelper::checkModules($this->pageLayout, $pageItems);
            gridboxHelper::checkMoreScripts($this->pageLayout);
        }
    }
}