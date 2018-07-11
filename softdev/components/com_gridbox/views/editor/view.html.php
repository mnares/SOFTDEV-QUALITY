<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxViewEditor extends JViewLegacy
{

    public $app;
    public $apps;
    public $category;
    public $categories;
    public $item;
    public $themes;
    public $access;
    public $plugins;
    public $blocks;
    public $blocksIcon;
    public $languages;
    public $menutypes;
    public $mapsKey;
    public $website;
    public $tags;
    public $edit_type;
    public $pageTags;
    public $breakpoints;
    public $categoryList;

    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        $app = JFactory::getApplication();
        $input = $app->input;
        if (!isset($_GET['id']) || !$this->item) {
            return JError::raiseError(404, JText::_('NOT_FOUND'));
        }
        $version = gridboxHelper::getVersion();
        $this->app = $input->get('app_id', 0, 'int');
        $this->category = $input->get('category', '', 'string');
        $this->edit_type = $input->get('edit_type', '', 'string');
        $doc = JFactory::getDocument();
        $doc->setTitle('Gridbox Editor');
        $doc->addStyleSheet(JURI::root() . 'components/com_gridbox/assets/css/ba-style.css?'.$version);
        $doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
        $doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
        $doc->setMetaData('cache-control', 'no-cache', true);
        $doc->setMetaData('expires', '0', true);
        $doc->setMetaData('pragma', 'no-cache', true);
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox') || empty($this->item->title)) {
            $this->setLayout('login');
            $this->themes = $this->get('Themes');
            parent::display($tpl);
            return;
        }
        if ($this->edit_type == '') {
            $this->app = $this->item->app_id;
            $this->category = $this->item->page_category;
        } else {
            $this->app = 0;
            $this->category = '';
            $this->item->app_type = '';
        }
        $this->website = $this->get('Website');
        $this->access = gridboxHelper::getAccess();
        $this->languages = gridboxHelper::getLanguages();
        $this->menutypes = $this->get('Menus');
        $this->plugins = $this->get('Plugins');
        $this->blocks = $this->get('Blocks');
        $this->blocksIcon = array('cover' => 'zmdi zmdi-tv-list', 'about-us' => 'zmdi zmdi-info',
            'services' => 'zmdi zmdi-cutlery', 'description' => 'zmdi zmdi-assignment',
            'steps' => 'zmdi zmdi-format-list-numbered', 'schedule' => 'zmdi zmdi-calendar-note',
            'features' => 'zmdi zmdi-check-circle', 'pricing-table' => 'zmdi zmdi-mall',
            'pricing-list' => 'zmdi zmdi-money', 'testimonials' => 'zmdi zmdi-comment-more',
            'team' => 'zmdi zmdi-account-circle', 'counters' => 'zmdi zmdi-chart-donut',
            'faq' => 'zmdi zmdi-help', 'call-to-action' => 'zmdi zmdi-mouse');
        if ($this->item->app_type == 'blog' && isset($this->plugins['blog'])) {
            $obj = new stdClass();
            $obj->title = 'ba-post-tags';
            $obj->image = 'flaticon-bookmark-1';
            $obj->type = 'blog';
            $obj->joomla_constant = 'POST_TAGS';
            $this->plugins['blog']['ba-post-tags'] = $obj;
            $obj = new stdClass();
            $obj->title = 'ba-related-posts';
            $obj->image = 'flaticon-share-2';
            $obj->type = 'blog';
            $obj->joomla_constant = 'RELATED_POSTS';
            $this->plugins['blog']['ba-related-posts'] = $obj;
            $obj = new stdClass();
            $obj->title = 'ba-post-navigation';
            $obj->image = 'flaticon-sign-1';
            $obj->type = 'blog';
            $obj->joomla_constant = 'POST_NAVIGATION';
            $this->plugins['blog']['ba-post-navigation'] = $obj;
        }
        if (isset($this->plugins['blog'])) {
            usort($this->plugins['blog'], function($a, $b){
                if ($a->title == $b->title) {
                    return 0;
                }
                return ($a->title < $b->title) ? -1 : 1;
            });
        }
        $fonts = $this->get('Fonts');
        //$defaultElementsStyle = gridboxHelper::getDefaultElementsStyle();
        $doc->addScriptDeclaration('var fontsLibrary = '.$fonts.';');
        $doc->addScriptDeclaration("var JUri = '".JUri::root()."';");
        //$doc->addScriptDeclaration('var defaultElementsStyle = '.$defaultElementsStyle.';');
        $this->mapsKey = gridboxHelper::getMapsKey();
        $doc->addScript(JURI::root() . 'components/com_gridbox/assets/js/ba-editor.js');
        $this->tags = $this->get('Tags');
        $this->pageTags = $this->get('PageTags');
        $this->apps = $this->get('Apps');
        $this->categories = $this->get('Categories');
        $this->categoryList = array();
        if (isset ($this->item->app_id) && !empty($this->item->app_id)) {
            foreach ($this->categories as $category) {
                if ($category->app_id == $this->item->app_id) {
                    $this->categoryList[$category->id] = $category;
                }
            }
        }
        $this->breakpoints = gridboxHelper::$breakpoints;

        parent::display($tpl);
    }
}