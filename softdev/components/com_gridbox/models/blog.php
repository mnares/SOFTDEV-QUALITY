<?php
/**
* @package   Grifbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
jimport('joomla.filesystem.file');

class gridboxModelBlog extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getCategory()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_categories')
            ->where('id = '.$id);
        $db->setQuery($query);
        $item = $db->loadObject();

        return $item;
    }

    public function getItem($id = null)
    {
        $input = JFactory::getApplication()->input;
        $tag = $input->get('tag', 0, 'int');
        if (!empty($tag)) {
            $table = $this->getTable('tags');
            $table->load($tag);
            $table->hit($tag);
        }
        $db = $this->getDbo();
        $id = $input->get('app', 0, 'int');
        $category = $input->get('id', 0, 'int');
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__gridbox_app')
            ->where('language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')')
            ->where('published = 1')
            ->where('id = ' .$id);
        $db->setQuery($query);
        $item = $db->loadObject();
        if (!$item) {
            return $item;
        }
        if (empty($item->app_layout)) {
            $item->app_layout = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/app.php');
        }
        if (!empty($tag) || $category != 0) {
            $query = $db->getQuery(true)
                ->select('access');
            if (!empty($tag)) {
                $query->from("#__gridbox_tags")
                    ->where('id = '.$tag);
            } else {
                $query->from("#__gridbox_categories")
                    ->where('id = '.$category);
            }
            $query->where('language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')')
                ->where('published = 1');
            $db->setQuery($query);
            $item->access = $db->loadResult();
            if (!$item->access) {
                $item = null;
            }
        }
        
        return $item;
    }
    
    public function getForm()
    {
        $form = JForm::getInstance('gridbox', JPATH_COMPONENT.'/models/forms/gridbox.xml');
        
        return $form;
    }
}
