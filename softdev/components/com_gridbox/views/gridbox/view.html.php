<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxViewgridbox extends JViewLegacy
{
    protected $item;
    protected $app;
    protected $category;
    protected $custom;
    protected $layout;
    protected $edit_type;
    
    public function display($tpl = null)
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return;
        }
        $app = JFactory::getApplication();
        $input = $app->input;
        $this->layout = '';
        $this->edit_type = $input->get('edit_type', '');
        if (isset($_GET['layout'])) {
            $this->layout = $_GET['layout'];
        }
        if (!isset($_GET['id'])) {
            return JError::raiseError(404, JText::_('NOT_FOUND'));
        }
        if (isset($_GET['app_id'])) {
            $this->app = $_GET['app_id'];
        } else {
            $this->app = 0;
        }
        if (isset($_GET['category'])) {
            $this->category = $_GET['category'];
        } else {
            $this->category = '';
        }
        $doc = JFactory::getDocument();
        $doc->setTitle('Gridbox Editor');
        $doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
        $doc->addStyleSheet(JURI::root() . 'components/com_gridbox/assets/css/ba-style.css');
        $this->item = $this->get('Item');
        $time = $this->item->saved_time;
        if (!empty($time)) {
            $time = '?'.$time;
        }
        if ($this->edit_type == '') {
            $doc->addStyleSheet(JUri::root().'components/com_gridbox/assets/css/storage/style-'.$this->item->id.'.css'.$time);
        } else if ($this->edit_type == 'blog') {
            $this->item->app_type = '';
            $this->item->params = $this->get('AppLayout');
            $this->item->style = $this->get('AppItems');
            $doc->addStyleSheet(JUri::root().'components/com_gridbox/assets/css/storage/app-'.$this->item->id.'.css'.$time);
        } else if ($this->edit_type == 'system') {
            $this->item->app_type = '';
            if (empty($this->item->html)) {
                $system = $this->get('SystemLayout');
                $this->item->html = $system->html;
                $this->item->items = $system->items;
            }
            $this->item->options = json_decode($this->item->page_options);
            if (($this->item->type == '404' && $this->item->options->enable_header != 1) || $this->item->type == 'offline') {
                $doc->addStyleDeclaration('header.header, footer.footer {display:none;}');
            }
            $doc->addScriptDeclaration('var systemType = "'.$this->item->type.'"');
            $type = str_replace('404', 'error', $this->item->type);
            $doc->addStyleSheet(JUri::root().'templates/gridbox/css/storage/'.$type.'.css'.$time);
            $this->item->params = $this->item->html;
            $this->item->style = $this->item->items;
        }
        $this->item->params = gridboxHelper::checkModules($this->item->params, $this->item->style);
        $doc->setMetaData('cache-control', 'no-cache', true);
        $doc->setMetaData('expires', '0', true);
        $doc->setMetaData('pragma', 'no-cache', true);
        $this->reeadCssFile();
        if ($this->item->app_type == 'blog' && empty($this->layout)) {
            $this->pageLayout = $this->get('PageLayout');
            $pageItems = $this->get('pageItems');
            $this->pageLayout = gridboxHelper::checkModules($this->pageLayout, $pageItems);
            $doc->addStyleSheet(JUri::root().'components/com_gridbox/assets/css/storage/post-'.$this->item->app_id.'.css'.$time);
            $this->setLayout('blog');
        }
        if (!empty($this->layout)) {
            $this->setLayout($this->layout);
        }
        
        parent::display($tpl);
    }

    protected function reeadCssFile()
    {
        jimport('joomla.filesystem.file');
        $this->custom = new stdClass();
        $id = $this->item->theme;
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$id.'.css';
        if (JFile::exists($file)) {
            $this->custom->code = JFile::read($file);
        } else {
            $this->custom->code = '';
        }
        $file = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$id.'.js';
        if (JFile::exists($file)) {
            $this->custom->js = JFile::read($file);
        } else {
            $this->custom->js = '';
        }
    }
}