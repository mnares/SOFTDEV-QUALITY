<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class gridboxViewtags extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $single;
    protected $state;
    protected $about;
    protected $count;
    protected $access = array();
    protected $languages = array();
    protected $apps;
    
    public function display($tpl = null) 
    {
        $this->items = $this->get('Items');
        $this->apps = gridboxHelper::getApps();
        foreach ($this->apps as $key => $app) {
            if ($app->id == $_GET['id']) {
                $this->single = $app;
                break;
            }
        }
        $this->count = count($this->items);
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->about = gridboxHelper::aboutUs();
        $this->addToolBar();
        $this->getAccess();
        $this->getLanguages();
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_gridbox/assets/css/ba-admin.css?'.$this->about->version);
        $doc->addScript('https://www.balbooa.com/updates/gridbox/gridboxApi/admin/gridboxApi.js');
        foreach ($this->items as &$item) {
            $item->order_up = true;
            $item->order_dn = true;
        }
        parent::display($tpl);
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
    
    protected function addToolBar ()
    {
        if (JFactory::getUser()->authorise('core.duplicate', 'com_gridbox')) {
            JToolBarHelper::custom('tags.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
        }
        if (JFactory::getUser()->authorise('core.edit.state', 'com_gridbox')) {
            JToolbarHelper::publish('tags.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish('tags.unpublish', 'JTOOLBAR_UNPUBLISH', true);
        }
        if (JFactory::getUser()->authorise('core.delete', 'com_gridbox')) {
            JToolBarHelper::custom('tags.delete', 'delete.png', 'delete.png', 'DELETE', true);
            
        }
    }
    
    protected function getSortFields()
    {
        return array(
            'published' => JText::_('JSTATUS'),
            'title' => JText::_('JGLOBAL_TITLE'),
            'order_list' => JText::_('CUSTOM'),
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