<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class gridboxViewTrashed extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $state;
    protected $about;
    protected $apps;
    
    public function display($tpl = null) 
    {
        $this->items = $this->get('Items');
        $this->apps = gridboxHelper::getApps();
        $this->items = $this->getThemeName($this->items);
        $this->pagination = $this->get('Pagination');        
        $this->state = $this->get('State');
        $this->about = gridboxHelper::aboutUs();
        $this->addToolBar();
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_gridbox/assets/css/ba-admin.css?'.$this->about->version);
        $doc->addScript('https://www.balbooa.com/updates/gridbox/gridboxApi/admin/gridboxApi.js');
        foreach ($this->items as &$item) {
            $item->order_up = true;
            $item->order_dn = true;
        }
        parent::display($tpl);
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
            if ($item->app_id == 0) {
                $item->app_name = JText::_('SINGLE_PAGES');
                $item->app_type = 'single';
            } else {
                $query = $db->getQuery(true);
                $query->select('title, type')
                    ->from('#__gridbox_app')
                    ->where('`id` = '.$db->quote($item->app_id));
                $db->setQuery($query);
                $result = $db->loadObject();
                $item->app_type = $result->type;
                $item->app_name = $result->title;
            }
        }
        
        return $items;
    }
    
    protected function addToolBar ()
    {
        if (JFactory::getUser()->authorise('core.delete', 'com_gridbox')) {
            JToolBarHelper::deleteList('', 'trashed.delete');
        }
    }
    
    protected function getSortFields()
    {
        return array(
            'title' => JText::_('JGLOBAL_TITLE'),
            'theme' => JText::_('THEME'),
            'app_id' => JText::_('APP'),
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