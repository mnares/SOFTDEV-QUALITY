<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class gridboxViewBlogs extends JViewLegacy
{
    protected $items;
    protected $blog;
    protected $pagination;
    protected $state;
    protected $about;
    protected $themes;
    protected $catList = array();
    protected $categories;
    protected $category;
    protected $tags;
    protected $count;
    protected $access = array();
    protected $languages = array();
    protected $apps;
    protected $root = 'active';
    
    public function display($tpl = null) 
    {
        if (isset($_GET['layout']) && $_GET['layout'] == 'modal') {
            $this->setLayout('modal');
            $this->items = $this->get('Items');
            $this->state = $this->get('State');
        } else {
            $this->apps = gridboxHelper::getApps();
            foreach ($this->apps as $key => $app) {
                if ($app->id == $_GET['id']) {
                    $this->blog = $app;
                    break;
                }
            }
            if (isset($_GET['category'])) {
                $this->category = $_GET['category'];
            } else {
                $this->category = '';
            }
            $this->getCategories();
            $this->categoryList = $this->getCategoryList();
            $this->items = $this->get('Items');
            $this->items = $this->getThemeName($this->items);
            $this->count = count($this->items);
            $this->getCategoryName();
            $this->pagination = $this->get('Pagination');
            $this->state = $this->get('State');
            $this->themes = $this->get('Themes');
            $this->addToolBar();
            $this->tags = gridboxHelper::getTags();
            $this->getAccess();
            $this->getLanguages();
            foreach ($this->items as &$item) {
                $item->order_up = true;
                $item->order_dn = true;
            }
        }
        $this->about = gridboxHelper::aboutUs();
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_gridbox/assets/css/ba-admin.css?'.$this->about->version);
        $doc->addScript('https://www.balbooa.com/updates/gridbox/gridboxApi/admin/gridboxApi.js');
        
        parent::display($tpl);
    }

    public function drawCategoryList($items)
    {
        $str = '<ul>';
        $catUrl = 'index.php?option=com_gridbox&view=blogs&id='.$this->blog->id.'&category=';

        foreach ($items as $key => $item) {
            $str .= '<li class="ba-category '.$item->active;
            if (isset($_COOKIE['blog'.$this->blog->id.'id'.$item->id])) {
                $str .= ' visible-branch';
            }
            if (!$item->published) {
                $str .= ' ba-unpublish';
            }
            $str .= '" data-id="'.$item->id;
            $str .= '"><a href="'.$catUrl.$item->id.'">';
            $str .= '<label><i class="zmdi zmdi-folder"></i></label><span>'.$item->title.'</span>';
            $str .= '<input type="hidden" value="'.htmlspecialchars(json_encode($item), ENT_QUOTES).'"></a>';
            if (count($item->child) > 0) {
                $str .= '<i class="zmdi zmdi-chevron-right ba-icon-md"></i>';
                $str .= $this->drawCategoryList($item->child);
            }
            $str .= '<i class="zmdi zmdi-apps sorting-handle ba-icon-md"></i>';
            $str .= '</li>';
        }
        $str .= '</ul>';

        return $str;
    }

    protected function getCategoryList()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title, id')
            ->from('#__gridbox_categories')
            ->where('`app_id` = '.$this->blog->id)
            ->order('order_list ASC');
        $db->setQuery($query);
        $categories = $db->loadObjectList();

        return $categories;
    }

    protected function getCategories()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__gridbox_categories')
            ->where('`app_id` = '.$this->blog->id)
            ->where('`parent` = 0')
            ->order('order_list ASC');
        $db->setQuery($query);
        $this->categories = $db->loadObjectList();
        foreach ($this->categories as $value) {
            if ($value->id == $this->category) {
                $value->active = ' active';
                $this->root = '';
            } else {
                $value->active = '';
            }
            $value->child = $this->getAllChild($value);
        }
    }

    protected function getAllChild($parent)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_categories')
            ->where('`app_id` = '.$this->blog->id)
            ->where('`parent` = '.$parent->id);
        $db->setQuery($query);
        $items = $db->loadObjectList();
        $visible = '';
        foreach ($items as $key => $value) {
            if ($value->id == $this->category) {
                $value->active = 'active';
                $this->root = '';
            } else {
                $value->active = '';
            }
            $value->child = $this->getAllChild($value);
        }

        return $items;
    }

    protected function getCategoryName()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title, app_id')
            ->from('#__gridbox_categories');
        $db->setQuery($query);
        $array = $db->loadObjectList();
        foreach ($array as $value) {
            $this->catList[$value->id] = $value->title;
        }
    }

    protected function getAccess()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title')
            ->from('#__viewlevels')
            ->order($db->quoteName('ordering') . ' ASC')
            ->order($db->quoteName('title') . ' ASC');
        $db->setQuery($query);
        $array = $db->loadObjectList();
        foreach ($array as $value) {
            $this->access[$value->id] = $value->title;
        }
    }

    protected function getLanguages()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('lang_code, title')
            ->from('#__languages')
            ->where('published >= 0')
            ->order('title');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        $this->languages['*'] = JText::_('JALL');
        foreach ($items as $key => $value) {
            $this->languages[$value->lang_code] = $value->title;
        }
    }
    
    protected function getThemeName($items)
    {
        $db = JFactory::getDbo();
        foreach ($items as $item) {
            $query = $db->getQuery(true);
            $query->select('`title`')
                ->from('#__template_styles')
                ->where('`id` = '.$db->quote($item->theme));
            $db->setQuery($query);
            $item->themeName = $db->loadResult();
            $query = $db->getQuery(true);
            $query->select('`title`')
                ->from('#__gridbox_categories')
                ->where('`id` = '.$db->quote($item->page_category));
            $db->setQuery($query);
            $item->category = $db->loadResult();
            $item->app_type = $this->blog->type;
        }
        
        return $items;
    }
    
    protected function addToolBar ()
    {
        if (JFactory::getUser()->authorise('core.duplicate', 'com_gridbox')) {
            JToolBarHelper::custom('blogs.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
        }
        if (JFactory::getUser()->authorise('core.edit.state', 'com_gridbox')) {
            JToolbarHelper::publish('blogs.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish('blogs.unpublish', 'JTOOLBAR_UNPUBLISH', true);
        }
        JToolBarHelper::custom('', 'settings.png', 'settings.png', 'SETTINGS', false);
        JToolBarHelper::custom('', 'download.png', 'download.png', 'EXPORT', false);
        if (JFactory::getUser()->authorise('core.delete', 'com_gridbox')) {
            JToolBarHelper::custom('blogs.addTrash', 'trash.png', 'trash.png', 'JTOOLBAR_TRASH', true);
            JToolBarHelper::custom('', 'delete.png', 'delete.png', 'DELETE_APP', false);
        }
    }
    
    protected function getSortFields()
    {
        return array(
            'published' => JText::_('JSTATUS'),
            'title' => JText::_('JGLOBAL_TITLE'),
            'order_list' => JText::_('CUSTOM'),
            'page_category' => JText::_('CATEGORY'),
            'theme' => JText::_('THEME'),
            'created' => JText::_('DATE'),
            'hits' => JText::_('JGLOBAL_HITS'),
            'id' => JText::_('JGRID_HEADING_ID')
        );
    }

    public static function preferences()
    {
        $uri = (string) JUri::getInstance();
        $return = urlencode(base64_encode($uri));
        $url = 'index.php?option=com_config&amp;view=component&amp;component=com_gridbox&amp;path=&amp;return=' .$return;
        
        return $url;
    }
}