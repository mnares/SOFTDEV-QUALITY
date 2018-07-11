<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/


defined('_JEXEC') or die;

use Joomla\Registry\Registry;
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

class PlgFinderGridbox extends FinderIndexerAdapter
{
    protected $context = 'Gridbox';
    protected $extension = 'com_gridbox';
    protected $layout = 'page';
    protected $type_title = 'Page';
    protected $table = '#__gridbox_pages';
    protected $autoloadLanguage = true;

    protected function setup()
    {
        return true;
    }

    protected function getHref($id)
    {
        $url = 'index.php?option=com_gridbox&view=page&id='.$id;
        $app = JFactory::getApplication();
        $menus = $app->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        foreach ($items as $item) {
            if (isset($item->query) && isset($item->query['view'])) {
                if ($item->query['view'] == 'page' && $item->query['id'] == $id) {
                    $url .= '&Itemid=' . $item->id;
                    break;
                }
            }
        }        
        return $url;
    }

    protected function index(FinderIndexerResult $item, $format = 'html')
    {
        $item->setLanguage();
        if (JComponentHelper::isEnabled($this->extension) == false) {
            return;
        }
        $registry = new Registry;
        $registry->loadString($item->metadata);
        $item->metadata = $registry;
        $item->publish_start_date = $item->start_date;
        $item->summary = strip_tags($item->body);
        $item->body = FinderIndexerHelper::prepareContent($item->body, '');

        $item->url = $this->getUrl($item->id, $this->extension, $this->layout);
        $item->route = $this->getHref($item->id);
        $item->path = FinderIndexerHelper::getContentPath($item->route);
        $title = $this->getItemMenuTitle($item->url);
        if (!empty($title) && $this->params->get('use_menu_title', true)) {
            $item->title = $title;
        }

        $item->addInstruction(FinderIndexer::META_CONTEXT, 'meta_title');
        $item->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
        $item->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
        $item->state = $this->translateState($item->state, $item->cat_state);
        FinderIndexerHelper::getContentExtras($item);
        $this->indexer->index($item);
    }

    protected function getListQuery($query = null)
    {
        $db = JFactory::getDbo();

        $query = $query instanceof JDatabaseQuery ? $query : $db->getQuery(true)
            ->select('a.id, a.title, a.page_alias AS alias, a.params AS body')
            ->select('a.published AS state, a.created AS start_date')
            ->select('a.meta_title, a.meta_description AS metadesc, a.meta_keywords AS metakey, a.page_access AS access')
            ->where('`language` in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')')
            ->from('#__gridbox_pages AS a');

        return $query;
    }
}
