<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die; 

jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.file');

class gridboxModelgridbox extends JModelAdmin
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function orderPages()
    {
        $cid = $_POST['cid'];
        $order = $_POST['order'];
        $db = JFactory::getDbo();
        $table = '#__gridbox_pages';
        if ($_POST['type'] == 'tags') {
            $table = '#__gridbox_tags';
        }
        foreach ($cid as $key => $id) {
            $obj = new stdClass();
            $obj->id = $id;
            $obj->order_list = $order[$key];
            $db->updateObject($table, $obj, 'id');
        }
    }

    public function orderApps()
    {
        $data = json_decode($_POST['data']);
        $db = JFactory::getDbo();
        foreach ($data as $value) {
            $db->updateObject('#__gridbox_app', $value, 'id');
        }
    }

    public function exportXML()
    {
        $db = JFactory::getDbo();
        $export = $_POST['export_data'];
        $export = json_decode($export);
        $themes = array();
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $root = $doc->createElement('gridbox');
        $root = $doc->appendChild($root);
        $pages = $doc->createElement('pages');
        $pages = $root->appendChild($pages);
        $themeElement = $doc->createElement('themes');
        $themeElement = $root->appendChild($themeElement);
        $libElement = $doc->createElement('libraries');
        $libElement = $root->appendChild($libElement);
        $menuElement = $doc->createElement('mainmenu');
        $menuElement = $root->appendChild($menuElement);
        $com_baforms = $doc->createElement('com_baforms');
        $com_baforms = $root->appendChild($com_baforms);
        $params = array();
        $library = array();
        $main_menu = array();
        $forms = array();
        $pagesList = array();
        if ($export->type == 'gridbox') {
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__gridbox_pages')
                ->where('app_id = 0')
                ->where('page_category <> '.$db->quote('trashed'));
            $db->setQuery($query);
            $obj = $db->loadObjectList();
            foreach ($obj as $object) {
                $pagesList[] = $object->id;
            }
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__gridbox_app')
                ->where('type <> '.$db->quote('tags'));
            $db->setQuery($query);
            $obj = $db->loadObjectList();
            foreach ($obj as $object) {
                $export->id[] = $object->id;
            }
            $export->type = 'app';
        }
        if ($export->type == 'app') {
            $apps = $doc->createElement('apps');
            $apps = $root->appendChild($apps);
            $categories = $doc->createElement('categories');
            $categories = $root->appendChild($categories);
            $tags = $doc->createElement('tags');
            $tags = $root->appendChild($tags);
            foreach ($export->id as $id) {
                $query = $db->getQuery(true)
                    ->select('a.*')
                    ->from('#__gridbox_app AS a')
                    ->where('a.id = '.$id)
                    ->select('t.title AS themeTitle, t.params as themeParams')
                    ->leftJoin('`#__template_styles` AS t'
                        . ' ON '
                        . $db->quoteName('a.theme')
                        . ' = ' 
                        . $db->quoteName('t.id')
                    );
                $db->setQuery($query);
                $app = $db->loadObject();
                $obj = new stdClass();
                $obj->title = $app->themeTitle;
                $obj->params = $app->themeParams;
                unset($app->themeTitle);
                unset($app->themeParams);
                $params[$app->theme] = $obj;
                $themes[] = $app->theme;
                $library = gridboxHelper::getGlobal($app->page_layout, $library);
                $forms = gridboxHelper::getBaforms($app->page_layout, $forms);
                if ($export->menu) {
                    $main_menu = gridboxHelper::getMainMenu($app->page_layout, $main_menu);
                }
                $library = gridboxHelper::getGlobal($app->app_layout, $library);
                $forms = gridboxHelper::getBaforms($app->app_layout, $forms);
                if ($export->menu) {
                    $main_menu = gridboxHelper::getMainMenu($app->app_layout, $main_menu);
                }
                $child = $doc->createElement('app');
                $child = $apps->appendChild($child);
                $data = json_encode($app);
                $data = $doc->createTextNode($data);
                $child->appendChild($data);
                $query = $db->getQuery(true)
                    ->select('*')
                    ->from('#__gridbox_categories')
                    ->where('app_id = '.$id);
                $db->setQuery($query);
                $cats = $db->loadObjectList();
                foreach ($cats as $cat) {
                    $child = $doc->createElement('category');
                    $child = $categories->appendChild($child);
                    $data = json_encode($cat);
                    $data = $doc->createTextNode($data);
                    $child->appendChild($data);
                }
                $query = $db->getQuery(true)
                    ->select('id')
                    ->from('#__gridbox_pages')
                    ->where('app_id = '.$id)
                    ->where('page_category <> '.$db->quote('trashed'));
                $db->setQuery($query);
                $result = $db->loadObjectList();
                foreach ($result as $value) {
                    $query = $db->getQuery(true)
                        ->select('m.page_id, m.tag_id')
                        ->from('#__gridbox_tags_map AS m')
                        ->where('m.page_id = '.$value->id)
                        ->select('t.*')
                        ->leftJoin('`#__gridbox_tags` AS t'
                            . ' ON '
                            . $db->quoteName('m.tag_id')
                            . ' = ' 
                            . $db->quoteName('t.id')
                        );
                    $db->setQuery($query);
                    $pTags = $db->loadObjectList();
                    foreach ($pTags as $tag) {
                        $tag->hits = 0;
                        $child = $doc->createElement('tag');
                        $child = $tags->appendChild($child);
                        $data = json_encode($tag);
                        $data = $doc->createTextNode($data);
                        $child->appendChild($data);
                    }
                    $pagesList[] = $value->id;
                }
            }
        }
        if ($export->type != 'pages') {
            $export->id = $pagesList;
        }
        foreach ($export->id as $id) {
            $query = $db->getQuery(true)
                ->select('*')
                ->from('`#__gridbox_pages`')
                ->where('`id` = '.$id);
            $db->setQuery($query);
            $table = $db->loadObject();
            $table->hits = 0;
            if (!in_array($table->theme, $themes)) {
                $query = $db->getQuery(true);
                $query->select('params, title')
                    ->from('`#__template_styles`')
                    ->where('`id` = ' .$db->Quote($table->theme));
                $db->setQuery($query);
                $params[$table->theme] = $db->loadObject();
                $themes[] = $table->theme;
            }
            $library = gridboxHelper::getGlobal($table->params, $library);
            $forms = gridboxHelper::getBaforms($table->params, $forms);
            if ($export->menu) {
                $main_menu = gridboxHelper::getMainMenu($table->params, $main_menu);
            }
            $page = $doc->createElement('page');
            $page = $pages->appendChild($page);
            $data = json_encode($table);
            $data = $doc->createTextNode($data);
            $page->appendChild($data);
        }
        foreach ($params as $key => $param) {
            $library = gridboxHelper::getGlobal($param->params, $library);
            if ($export->menu) {
                $main_menu = gridboxHelper::getMainMenu($param->params, $main_menu);
            }
            $forms = gridboxHelper::getBaforms($param->params, $forms);
            $file = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$key.'.css';
            if (JFile::exists($file)) {
                $customCss = JFile::read($file);
            } else {
                $customCss = '';
            }
            $file = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$key.'.js';
            if (JFile::exists($file)) {
                $customJs = JFile::read($file);
            } else {
                $customJs = '';
            }
            $theme = $doc->createElement('theme');
            $theme = $themeElement->appendChild($theme);
            $title = $doc->createElement('id');
            $title = $theme->appendChild($title);
            $data = $doc->createTextNode($key);
            $data = $title->appendChild($data);
            $title = $doc->createElement('title');
            $title = $theme->appendChild($title);
            $data = $doc->createTextNode($param->title);
            $data = $title->appendChild($data);
            $title = $doc->createElement('params');
            $title = $theme->appendChild($title);
            $data = $doc->createTextNode($param->params);
            $data = $title->appendChild($data);
            $title = $doc->createElement('css');
            $title = $theme->appendChild($title);
            $data = $doc->createTextNode($customCss);
            $data = $title->appendChild($data);
            $title = $doc->createElement('js');
            $title = $theme->appendChild($title);
            $data = $doc->createTextNode($customJs);
            $data = $title->appendChild($data);
        }
        foreach ($library as $key => $lib) {
            $theme = $doc->createElement('library');
            $theme = $libElement->appendChild($theme);
            $value = json_encode($lib);
            $data = $doc->createTextNode($value);
            $data = $theme->appendChild($data);
        }
        if ($export->menu) {
            foreach ($main_menu as $value) {
                $theme = $doc->createElement('main_menu');
                $theme = $menuElement->appendChild($theme);
                foreach ($value as $key => $menu) {
                    $menu = json_encode($menu);
                    $title = $doc->createElement($key);
                    $title = $theme->appendChild($title);
                    $data = $doc->createTextNode($menu);
                    $data = $title->appendChild($data);
                }
            }
        }
        foreach ($forms as $value) {
            $theme = $doc->createElement('baform');
            $theme = $com_baforms->appendChild($theme);
            foreach ($value as $key => $form) {
                $form = json_encode($form);
                $title = $doc->createElement($key);
                $title = $theme->appendChild($title);
                $data = $doc->createTextNode($form);
                $data = $title->appendChild($data);
            }
        }
        $config = JFactory::getConfig();
        $file =  $config->get('tmp_path') . '/gridbox.xml';
        $bytes = $doc->save($file);
        if ($bytes) {
            echo new JResponseJson(true, $file);
        } else {
            echo new JResponseJson(false, '', true);
        }
        jexit();
    }

    public function applySingle()
    {
        $db = JFactory::getDbo();
        $obj = new stdClass();
        $obj->title = $_POST['single_title'];
        $obj->id = $_POST['blog'];
        $db->updateObject('#__gridbox_app', $obj, 'id');
        gridboxHelper::ajaxReload('JLIB_APPLICATION_SAVE_SUCCESS');
    }

    public function checkSidebarTour()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`, `id`')
            ->from('`#__gridbox_api`')
            ->where('`service` = '.$db->Quote('sidebar_tour'));
        $db->setQuery($query);
        $result = $db->loadObject();
        if (!isset($result->key)) {
            $result = new stdClass();
            $result->key = 'true';
            $obj = new stdClass();
            $obj->service = 'sidebar_tour';
            $obj->key = 'false';
            $db->insertObject('#__gridbox_api', $obj);
        }
        echo $result->key;
        exit;
    }

    public function addApp()
    {
        $db = JFactory::getDbo();
        $obj = new stdClass();
        $obj->title = $_POST['app_name'];
        $obj->order_list = $_POST['app_order_list'];
        $obj->alias = gridboxHelper::getAlias($obj->title, '#__gridbox_app');
        $obj->type = $_POST['app_type'];
        $obj->theme = gridboxHelper::getTemplate();
        $db->insertObject('#__gridbox_app', $obj);
        $obj = new stdClass();
        $id = $db->insertid();
        $obj->className = 'view-'.str_replace('blog', 'blogs', $_POST['app_type']);
        $obj->url = JUri::root().'administrator/index.php?option=com_gridbox&view=';
        $obj->url .= str_replace('blog', 'blogs', $_POST['app_type']).'&id='.$id;
        $obj->msg = JText::_('ITEM_CREATED');
        $obj = json_encode($obj);
        echo $obj;
        exit();
    }

    public function checkRate()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`, `id`')
            ->from('`#__gridbox_api`')
            ->where('`service` = '.$db->Quote('rate_gridbox'));
        $db->setQuery($query);
        $result = $db->loadObject();
        if (empty($result)) {
            $result = 'false';
            $query = $db->getQuery(true);
            $obj = new stdClass();
            $obj->service = 'rate_gridbox';
            $obj->key = strtotime('+3 days');
            $db->insertObject('#__gridbox_api', $obj);
        } else if ($result->key != 'false') {
            $now = strtotime(date('Y-m-d G:i:s'));
            if ($now - $result->key >= 0) {
                $obj = new stdClass();
                $obj->id = $result->id;
                $obj->key = 'false';
                JFactory::getDbo()->updateObject('#__gridbox_api', $obj, 'id');
                $result = 'true';
            } else {
                $result = 'false';
            }
        } else {
            $result = 'false';
        }
        echo $result;
        exit;
    }

    public function getCategories($app, $parent)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_categories')
            ->where('app_id = '.$app)
            ->where('parent = '.$parent);
        $db->setQuery($query);
        $categories = $db->loadObjectList();
        foreach ($categories as $category) {
            $category->childs = $this->getCategories($app, $category->id);
        }

        return $categories;
    }

    public function duplicateCaterories($categories, $id, $newId, $parent)
    {
        $db = JFactory::getDbo();
        foreach ($categories as $category) {
            $category->app_id = $newId;
            $catId = $category->id;
            $childs = $category->childs;
            $category->alias = gridboxHelper::getAlias($category->alias, '#__gridbox_categories');
            $category->parent = $parent;
            unset($category->id);
            unset($category->childs);
            $db->insertObject('#__gridbox_categories', $category);
            $newCatId = $db->insertid();
            $query = $db->getQuery(true)
                ->select('*')
                ->from('#__gridbox_pages')
                ->where('app_id = '.$id)
                ->where('page_category = '.$catId);
            $db->setQuery($query);
            $pages = $db->loadObjectList();
            foreach ($pages as $page) {
                $page->page_category = $newCatId;
                $page->app_id = $newId;
                $page->hits = 0;
                $page->page_alias = gridboxHelper::getNewPageAlias($page->page_alias, '');
                $pageId = $page->id;
                unset($page->id);
                $db->insertObject('#__gridbox_pages', $page);
                $newPageId = $db->insertid();
                $query = $db->getQuery(true)
                    ->select('*')
                    ->from('#__gridbox_tags_map')
                    ->where('page_id = '.$pageId);
                $db->setQuery($query);
                $tags = $db->loadObjectList();
                foreach ($tags as $tag) {
                    $tag->page_id = $newPageId;
                    unset($tag->id);
                    $db->insertObject('#__gridbox_tags_map', $tag);
                }
            }
            $this->duplicateCaterories($childs, $id, $newId, $newCatId);
        }
    }

    public function duplicateApp()
    {
        $id = $_POST['blog'];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_app')
            ->where('id = '.$id);
        $db->setQuery($query);
        $app = $db->loadObject();
        $table = $this->getTable('app');
        $title = $app->title;
        while ($table->load(array('title' => $title)))
        {
            $title = JString::increment($title);
        }
        $app->title = $title;
        $app->alias = gridboxHelper::getAlias($app->alias, '#__gridbox_app');
        unset($app->id);
        $db->insertObject('#__gridbox_app', $app);
        $newId = $db->insertid();
        $categories = $this->getCategories($id, 0);
        $this->duplicateCaterories($categories, $id, $newId, 0);
    }

    public function deleteApp()
    {
        $id = $_POST['blog'];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->delete('#__gridbox_app')
            ->where('`id` = '. $id);
        $db->setQuery($query)
            ->execute();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__gridbox_pages')
            ->where('`app_id` = '. $id);
        $db->setQuery($query);
        $pages = $db->loadObjectList();
        $array = array();
        foreach ($pages as $value) {
            $array[] = $value->id;
        }
        gridboxHelper::deleteTagsLink($array);
        gridboxHelper::deletePageCss($array);
        $query = $db->getQuery(true)
            ->delete('#__gridbox_pages')
            ->where('`app_id` = '. $id);
        $db->setQuery($query)
            ->execute();
        $query = $db->getQuery(true)
            ->delete('#__gridbox_categories')
            ->where('`app_id` = '. $id);
        $db->setQuery($query)
            ->execute();
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/app-'.$id.'.css';
        gridboxHelper::deleteFile($file);
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/post-'.$id.'.css';
        gridboxHelper::deleteFile($file);
    }

    public function checkBlogsTour()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`, `id`')
            ->from('`#__gridbox_api`')
            ->where('`service` = '.$db->Quote('blogs_tour'));
        $db->setQuery($query);
        $result = $db->loadObject();
        if (!isset($result->key)) {
            $result = new stdClass();
            $result->key = 'true';
            $obj = new stdClass();
            $obj->service = 'blogs_tour';
            $obj->key = 'false';
            $db->insertObject('#__gridbox_api', $obj);
        }
        echo $result->key;
        exit;
    }

    public function updateParams()
    {
        $input = JFactory::getApplication()->input;
        $table = $this->getTable();
        $id = $input->get('ba_id');
        if (isset($_POST['meta_tags'])) {
            $tags = $_POST['meta_tags'];
        } else {
            $tags = array();
        }
        if (isset($_POST['intro_text'])) {
            $text = $_POST['intro_text'];
        } else {
            $text = '';
        }
        $theme = $input->get('theme_list');
        $title = $_POST['page_title'];
        $metaTitle = $_POST['page_meta_title'];
        $alias = $_POST['page_alias'];
        $desc = $_POST['page_meta_description'];
        $keyWords = $_POST['page_meta_keywords'];
        $access = $_POST['access'];
        $date = $_POST['published_on'];
        $endDate = $_POST['published_down'];
        if (empty($endDate)) {
            $endDate = '0000-00-00 00:00:00';
        }
        $img = $_POST['intro_image'];
        $language = $_POST['language'];
        $table->load($id);
        $array = array('title' =>$title, 'meta_title' => $metaTitle, 'created' => $date,
            'meta_description' => $desc, 'meta_keywords' => $keyWords, 'end_publishing' => $endDate,
            'theme' => $theme, 'page_alias' => $alias, 'page_access' => $access,
            'intro_text' => strip_tags($text), 'intro_image' => $img, 'language' => $language);
        if (isset($_POST['page_category'])) {
            $array['page_category'] = $_POST['page_category'];
        }
        $table->bind($array);
        if (!$table->check()) {
            gridboxHelper::ajaxReload('ANOTHER_ALIAS');
            return false;
        }
        $table->store();
        $gridboxTags = $this->getTable('Tags', 'gridboxTable');
        $map = $this->getTable('TagsMap', 'gridboxTable');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, tag_id')
            ->from('#__gridbox_tags_map')
            ->where('`page_id` = '. $id);
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $item) {
            if (!in_array($item->tag_id, $tags)) {
                $map->delete($item->id);
            }
        }
        foreach ($tags as $tag) {
            if (!empty($tag)) {
                if (strpos($tag, 'new$') !== false) {
                    $tag = substr($tag, 4);
                    $alias = gridboxHelper::getAlias($tag, '#__gridbox_tags');
                    $gridboxTags->reset();
                    $gridboxTags->bind(array('id' => 0, 'title' => $tag, 'alias' => $alias));
                    $gridboxTags->store();
                    $tag = $gridboxTags->id;
                    $map->reset();
                    $map->bind(array('id' => 0, 'page_id' => $id, 'tag_id' => $tag));
                    $map->store();
                } else {
                    $query = $db->getQuery(true);
                    $query->select('id')
                        ->from('#__gridbox_tags_map')
                        ->where('`page_id` = '.$id)
                        ->where('`tag_id` = '.$tag);
                    $db->setQuery($query);
                    $item = $db->loadResult();
                    if (empty($item)) {
                        $map->reset();
                        $map->bind(array('id' => 0, 'page_id' => $id, 'tag_id' => $tag));
                        $map->store();
                    }
                }
            }
        }
        gridboxHelper::ajaxReload('JLIB_APPLICATION_SAVE_SUCCESS');
    }

    public function getPageTags()
    {
        $db = JFactory::getDbo();
        $id = $_POST['page_id'];
        $query = $db->getQuery(true);
        $query->select('tag_id')
            ->from('#__gridbox_tags_map')
            ->where('`page_id` = '.$id);
        $db->setQuery($query);
        $ids = $db->loadObjectList();
        $tags = array();
        foreach ($ids as $id) {
            $query = $db->getQuery(true);
            $query->select('*')
                ->from('#__gridbox_tags')
                ->where('`id` = '.$id->tag_id);
            $db->setQuery($query);
            $tags[] = $db->loadObject();
        }
        $tags = json_encode($tags);
        echo $tags;
        exit;
    }

    public function updateTags()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__gridbox_tags');
        $db->setQuery($query);
        $tags = $db->loadObjectList();
        $tags = json_encode($tags);
        echo new JResponseJson(true, $tags);
        exit;
    }

    public function applySettings()
    {
        $db = JFactory::getDbo();
        $obj = new stdClass();
        $obj->id = $_POST['blog'];
        $obj->title = $_POST['category_title'];
        $obj->alias = $_POST['category_alias'];
        if (empty($obj->alias)) {
            $obj->alias = $obj->title;
        }
        if (isset($_POST['category_publish'])) {
            $obj->published = 1;
        } else {
            $obj->published = 0;
        }
        $obj->alias = gridboxHelper::getAlias($obj->alias, '#__gridbox_categories', $obj->id);
        $obj->access = $_POST['category_access'];
        $obj->language = $_POST['category_language'];
        $obj->image = $_POST['category_intro_image'];
        $obj->meta_title = $_POST['category_meta_title'];
        $obj->meta_description = $_POST['category_meta_description'];
        $obj->meta_keywords = $_POST['category_meta_keywords'];
        $obj->alias = gridboxHelper::getAlias($obj->alias, '#__gridbox_app', $obj->id);
        $obj->theme = $_POST['blog_theme'];
        $db->updateObject('#__gridbox_app', $obj, 'id');
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option . '.gridbox', 'gridbox', array('control' => 'jform', 'load_data' => $loadData)
        );
        
        if (empty($form))
        {
            return false;
        }
 
        return $form;
    }
    
    protected function getNewTitle($title)
    {
        $table = $this->getTable();
        while ($table->load(array('title' => $title)))
        {
            $title = JString::increment($title);
        }

        return $title;
    }

    protected function getNewAlias($alias)
    {
        $table = $this->getTable();
        while ($table->load(array('page_alias' => $alias))) {
            $alias = JString::increment($alias);
        }

        return $alias;
    }

    public function moveSingle($id, $category)
    {
        $obj = json_decode($category);
        $obj->page_category = '';
        $obj->id = $id;
        JFactory::getDbo()->updateObject('#__gridbox_pages', $obj, 'id');
    }
    
    public function duplicate(&$pks)
    {
        $db = JFactory::getDbo();
        foreach ($pks as $pk) {
            $table = $this->getTable();
            $table->load($pk, true);
            $table->id = 0;
            $table->hits = 0;
            $table->order_list = 0;
            $table->title = $this->getNewTitle($table->title);
            $table->page_alias = $this->getNewAlias($table->page_alias);
            $table->published = 0;
            $table->check();
            $table->store();
            gridboxHelper::copyCss($pk, $table->id);
            $query = $db->getQuery(true)
                ->select('tag_id')
                ->from('`#__gridbox_tags_map`')
                ->where('`page_id` = '.$pk);
            $db->setQuery($query);
            $tags = $db->loadObjectList();
            foreach ($tags as $tag) {
                $tag->page_id = $table->id;
                $db->insertObject('#__gridbox_tags_map', $tag);
            }

        }
    }

    public function trash(&$pks)
    {
        foreach ($pks as $pk) {
            $table = $this->getTable();
            $table->load($pk, true);
            $table->page_category = 'trashed';
            $table->published = 0;
            $table->store();
        }
    }
}