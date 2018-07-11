<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class gridboxModelEditor extends JModelItem
{
    public function getTable($type = 'pages', $prefix = 'gridboxTable', $config = array()) 
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getsavedInstagramMedia()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', '', 'string');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('images')
            ->from('`#__gridbox_instagram`')
            ->where('plugin_id = '.$db->quote($db->escape($id, true)));
        $db->setQuery($query);
        $images = $db->loadResult();
        echo $images;
        exit;
    }

    public function saveMenuItemTitle()
    {
        $input = JFactory::getApplication()->input;
        $obj = new stdClass();
        $obj->id = $input->get('id', 0, 'int');
        $obj->title = $input->get('title', '', 'string');
        $db = JFactory::getDbo();
        $db->updateObject('#__menu', $obj, 'id');
    }

    public function deleteMenuItem()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $parent_id = $input->get('parent_id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->delete('#__menu')
            ->where("id = " . $id);
        $db->setQuery($query)
            ->execute();
        $query->clear()
            ->update('#__menu')
            ->where('parent_id = '.$id)
            ->set('parent_id = '.$parent_id);
        $db->setQuery($query)
            ->execute();
        JTable::addIncludePath(array(JPATH_ROOT.'/administrator/components/com_menus/tables'));
        $table = JTable::getInstance($type = 'menu', $prefix = 'menusTable', $config = array());
        $table->rebuild();
    }

    public function sortMenuItems()
    {
        $input = JFactory::getApplication()->input;
        $idArray = $input->get('idArray', array(), 'array');
        $pks = array();
        foreach ($idArray as $value) {
            $pks[] = $value['id'];
        }
        $idStr = implode(',', $pks);
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('lft, rgt')
            ->from('#__menu')
            ->where('id in ('.$idStr.')')
            ->order('lft ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        for ($i = 0; $i < count($idArray); $i++) {
            $query->clear()
                ->update('#__menu')
                ->where('id = '.$idArray[$i]['id'])
                ->set('lft = '.$items[$i]->lft)
                ->set('parent_id = '.$idArray[$i]['parent_id'])
                ->set('rgt = '.$items[$i]->rgt);
            $db->setQuery($query)
                ->execute();
        }
        JTable::addIncludePath(array(JPATH_ROOT.'/administrator/components/com_menus/tables'));
        $table = JTable::getInstance($type = 'menu', $prefix = 'menusTable', $config = array());
        $table->rebuild();
    }

    public function setLibraryImage()
    {
        $input = JFactory::getApplication()->input;
        $str = $input->get('object', '', 'string');
        $obj = json_decode($str);
        $db = JFactory::getDbo();
        $db->updateObject('#__gridbox_library', $obj, 'id');
    }

    public function setStarRatings()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', '', 'string');
        $rating = $input->get('rating', 0, 'int');
        $str = $input->get('page', '', 'string');
        $page = json_decode($str);
        if ($page->option == 'com_gridbox' && $page->view == 'gridbox') {
            $page->view = 'page';
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__gridbox_star_ratings_users')
            ->where('`ip` = '.$db->quote($ip))
            ->where('`plugin_id` = '.$db->quote($id))
            ->where('`option` = '.$db->quote($page->option))
            ->where('`view` = '.$db->quote($page->view))
            ->where('`page_id` = '.$db->quote($page->id));
        $db->setQuery($query);
        $flag = $db->loadResult();
        $object = new stdClass();
        if (empty($flag)) {
            $query = $db->getQuery(true)
                ->select('*')
                ->from('#__gridbox_star_ratings')
                ->where('`plugin_id` = '.$db->quote($id))
                ->where('`option` = '.$db->quote($page->option))
                ->where('`view` = '.$db->quote($page->view))
                ->where('`page_id` = '.$db->quote($page->id));
            $db->setQuery($query);
            $obj = $db->loadObject();
            if (!isset($obj->id)) {
                $obj = new stdClass();
                $obj->plugin_id = $id;
                $obj->rating = $rating;
                $obj->count = 1;
                $obj->option = $page->option;
                $obj->view = $page->view;
                $obj->page_id = $page->id;
                $db->insertObject('#__gridbox_star_ratings', $obj);
                $obj->id = $db->insertid();
            } else {
                $total = ($obj->rating * $obj->count + $rating) / ($obj->count + 1);
                $obj->rating = number_format($total, 2);
                $obj->count++;
                $db->updateObject('#__gridbox_star_ratings', $obj, 'id');
            }
            $user = new StdClass();
            $user->plugin_id = $obj->plugin_id;
            $user->option = $page->option;
            $user->view = $page->view;
            $user->page_id = $page->id;
            $user->ip = $ip;
            $db->insertObject('#__gridbox_star_ratings_users', $user);
            $object->result = '<span>'.JText::_('THANK_YOU_FOR_VOTE').'</span>';
        } else {
            $object->result = '<span>'.JText::_('ALREADY_VOTED').'</span>';
        }
        list($object->str, $object->rating) = gridboxHelper::getStarRatings($id, $page);

        return $object;
    }

    public function getPageTags()
    {
        $db = JFactory::getDbo();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
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
            $tag = $db->loadObject();
            if (!empty($tag)) {
                $tags[$tag->id] = $tag->title;
            }
        }
        
        return $tags;
    }

    public function getTags()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__gridbox_tags');
        $db->setQuery($query);
        $tags = $db->loadObjectList();

        return $tags;
    }

    public function checkProductTour()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`, `id`')
            ->from('`#__gridbox_api`')
            ->where('`service` = '.$db->quote('editor_tour'));
        $db->setQuery($query);
        $result = $db->loadObject();
        if (!isset($result->key)) {
            $result = new stdClass();
            $result->key = 'true';
            $obj = new stdClass();
            $obj->service = 'editor_tour';
            $obj->key = 'false';
            $db->insertObject('#__gridbox_api', $obj);
        }
        echo $result->key;
        exit;
    }

    public function setEditorView()
    {
        $app = JFactory::getApplication();
        $app->input->set('view', 'gridbox');
    }

    public function getLibrary()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $type = $input->get('type', '', 'string');
        $db = JFactory::getDbo();
        $table = '#__gridbox_library';
        $where = '`id` = '.$db->quote($id);
        if ($type == 'blocks') {
            $id = $input->get('id', '', 'string');
            $table = '#__gridbox_page_blocks';
            $where = '`title` = '.$db->quote($id);
        }
        $query = $db->getQuery(true)
            ->select('item')
            ->from($table)
            ->where($where);
        $db->setQuery($query);
        $string = $db->loadResult();
        $item = json_decode($string);
        $this->setEditorView();
        $item->html = gridboxHelper::checkModules($item->html, $item->items);
        $file = JPATH_ROOT.'/plugins/system/bagallery/bagallery.php';
        if (JFile::exists($file)) {
            include_once $file;
            $subj = JEventDispatcher::getInstance();
            $config = array('type' => 'system', 'name' => 'bagallery', 'params' => '{}');
            $plg = new plgSystemBagallery($subj, $config);
            $item->html = $plg->getContent($item->html);
        }
        $file = JPATH_ROOT.'/plugins/system/baforms/baforms.php';
        if (JFile::exists($file)) {
            include_once $file;
            $subj = JEventDispatcher::getInstance();
            $config = array('type' => 'system', 'name' => 'baforms', 'params' => '{}');
            $plg = new plgSystemBaforms($subj, $config);
            $item->html = $plg->getContent($item->html);
        }
        $item->html = gridboxHelper::checkMainMenu($item->html);
        $item = json_encode($item);

        echo $item;
        exit;
    }

    public function removeLibrary()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->delete('#__gridbox_library')
            ->where('`id` = '.$db->quote($id));
        $db->setQuery($query)
            ->execute();
        exit;
    }

    public function addLibrary()
    {
        $str = $_POST['object'];
        $obj = json_decode($str);
        $db = JFactory::getDbo();
        if (!empty($obj->global_item)) {
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__gridbox_library')
                ->where('`global_item` = '.$db->quote($obj->global_item));
            $db->setQuery($query);
            $id = $db->loadResult();
            if (!empty($id)) {
                $msg = new stdClass();
                $msg->text = JText::_('ALREADY_GLOBAL');
                $msg->type = 'ba-alert';
                $msg = json_encode($msg);
                echo($msg);
                exit;
            }
        }
        $obj->item = json_encode($obj->item);
        $db->insertObject('#__gridbox_library', $obj);
        $msg = new stdClass();
        $msg->text = JText::_('SAVED_TO_LIBRARY');
        $msg->type = '';
        $msg = json_encode($msg);
        echo $msg;
        exit;
    }

    public function gridboxSave()
    {
        $obj = file_get_contents('php://input');
        $obj = json_decode($obj);
        gridboxHelper::$website = $obj->website;
        gridboxHelper::siteRules($obj->breakpoints);
        gridboxHelper::saveTheme($obj->theme, $obj->page->theme);
        if (!isset($obj->edit_type)) {
            gridboxHelper::savePage($obj->page, $obj->page->id);
        } else if ($obj->edit_type == 'blog') {
            gridboxHelper::saveAppLayout($obj->page, $obj->page->id);
        } else if ($obj->edit_type == 'system') {
            gridboxHelper::saveSystemPage($obj->page, $obj->page->id);
        }
        gridboxHelper::saveCodeEditor($obj->code, $obj->page->theme);
        gridboxHelper::saveWebsite($obj->website);
        gridboxHelper::saveGlobalItems($obj->global);
        if (isset($obj->post)) {
            gridboxHelper::savePostLayout($obj->post, $obj->page->id);
        }
        echo JText::_('GRIDBOX_SAVED');
        exit;
    }

    public function checkMainMenu()
    {
        $input = JFactory::getApplication()->input;
        $menu = $input->get('main_menu', 0, 'int');
        $id = $input->get('id', 0, 'int');
        $items = new stdClass();
        $items->{$id} = json_decode($_POST['items']);
        $html = '<div class="ba-item-main-menu ba-item" id="'.$id.'">[main_menu='.$menu.']</div>';
        $html = gridboxHelper::checkMainMenu($html);
        $html = gridboxHelper::checkDOM($html, $items);
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
        include_once JPATH_ROOT.'/components/com_gridbox/libraries/php/phpQuery/phpQuery.php';
        $dom = phpQuery::newDocument($html);
        $html = pq('.ba-item-main-menu')->html();
        echo $html;
        exit;
    }

    public function getInstagramLang()
    {
        $lang = array(JText::_('JANUARY'), JText::_('FEBRUARY'), JText::_('MARCH'), JText::_('APRIL'),
            JText::_('MAY'), JText::_('JUNE'), JText::_('JULY'), JText::_('AUGUST'), JText::_('SEPTEMBER'),
            JText::_('OCTOBER'), JText::_('NOVEMBER'), JText::_('DECEMBER'), 'HOUR_AGO' => JText::_('HOUR_AGO'),
            'HOURS_AGO' => JText::_('HOURS_AGO'), 'DAY_AGO' => JText::_('DAY_AGO'), 'DAYS_AGO' => JText::_('DAYS_AGO'));
        $lang = json_encode($lang);
        echo $lang;
        exit;
    }

    public function getWeatherLang()
    {
        $lang = array('wind' => JText::_('WIND'), 'humidity' => JText::_('HUMIDITY'), 'pressure' => JText::_('PRESSURE'),
            'sunrise' => JText::_('SUNRISE'), 'sunset' => JText::_('SUNSET'), 'mon' => JText::_('WEATHER_MONDAY'),
            'tue' => JText::_('WEATHER_TUESDAY'), 'wed' => JText::_('WEATHER_WEDNESDAY'), 'thu' => JText::_('WEATHER_THURSDAY'),
            'fri' => JText::_('WEATHER_FRIDAY'), 'sat' => JText::_('WEATHER_SATURDAY'), 'sun' => JText::_('WEATHER_SUNDAY'),
            '0' => JText::_('WEATHER_JANUARY'), '1' => JText::_('WEATHER_FEBRUARY'), '2' => JText::_('WEATHER_MARCH'),
            '3' => JText::_('WEATHER_APRIL'), '4' => JText::_('WEATHER_MAY'), '5' => JText::_('WEATHER_JUNE'),
            '6' => JText::_('WEATHER_JULY'), '7' => JText::_('WEATHER_AUGUST'), '8' => JText::_('WEATHER_SEPTEMBER'),
            '9' => JText::_('WEATHER_OCTOBER'), '10' => JText::_('WEATHER_NOVEMBER'), '11' => JText::_('WEATHER_DECEMBER'),
            'speed' => JText::_('WIND_SPEED'), 'mph' => JText::_('MPH'));
        $lang = json_encode($lang);
        echo $lang;
        exit;
    }

    public function setMapsKey()
    {
        $input = JFactory::getApplication()->input;
        $key = $input->get('google_maps_key', '', 'string');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->update('`#__gridbox_api`')
            ->set('`key` = '.$db->quote($key))
            ->where('`service` = '.$db->quote('google_maps'));
        $db->setQuery($query);
        $db->setQuery($query)
            ->execute();
    }

    public function getBlocksLicense()
    {
        $str = file_get_contents('php://input');
        $data = json_decode($str);
        $this->installBlocks($data);
        echo JText::_('BLOCKS_INSTALLED');
        exit;
    }

    public function getPluginLicense()
    {
        $input = JFactory::getApplication()->input;
        $str = $input->get('data', '', 'string');
        $data = json_decode($str);
        $this->installPlugin($data);
        echo JText::_('PLUGIN_INSTALLED');
        exit;
    }

    public function loadLayout()
    {
        $input = JFactory::getApplication()->input;
        $layout = $input->get('layout', '', 'string');
        $count = $input->get('count', '', 'string');
        $span = explode('+', $count);
        $count = count($span);
        $obj = new stdClass();
        $obj->items = new stdClass();
        $now = strtotime(date('Y-m-d G:i:s')) * 10;
        include JPATH_ROOT.'/components/com_gridbox/views/layout/'.$layout.'.php';
        $obj->html = $out;
        echo json_encode($obj);
        exit;
    }

    public function loadPlugin()
    {
        $input = JFactory::getApplication()->input;
        $layout = $input->get('layout', '', 'string');
        if (!gridboxHelper::checkPlugin($layout)) {
            echo '';
            exit;
        }
        $data = $input->get('data', '', 'string');
        $obj = new stdClass();
        $obj->items = new stdClass();
        $now = strtotime(date('Y-m-d G:i:s')) * 10;
        include JPATH_ROOT.'/components/com_gridbox/views/layout/'.$layout.'.php';
        if ($layout == 'modules') {
            $this->setEditorView();
            $out = gridboxHelper::checkModules($out, $obj->items);
            $str = $this->returnStyle();
            $out = str_replace('<input type="hidden" class="modules-styles">', $str, $out);
        } else if ($layout == 'bagallery') {
            $file = JPATH_ROOT.'/plugins/system/bagallery/bagallery.php';
            if (JFile::exists($file)) {
                include_once $file;
                $subj = JEventDispatcher::getInstance();
                $config = array('type' => 'system', 'name' => 'bagallery', 'params' => '{}');
                $plg = new plgSystemBagallery($subj, $config);
                $str = '[gallery ID='.$data.']';
                $str = $plg->getContent($str);
                $out = str_replace('[gallery ID='.$data.']', $str, $out);
            }
        } else if ($layout == 'baforms') {
            $file = JPATH_ROOT.'/plugins/system/baforms/baforms.php';
            if (JFile::exists($file)) {
                include_once $file;
                $subj = JEventDispatcher::getInstance();
                $config = array('type' => 'system', 'name' => 'baforms', 'params' => '{}');
                $plg = new plgSystemBaforms($subj, $config);
                $str = '[forms ID='.$data.']';
                $str = $plg->getContent($str);
                $out = str_replace('[forms ID='.$data.']', $str, $out);
            }
        } else if ($layout == 'menu') {
            $out = gridboxHelper::checkMainMenu($out);
            $out = gridboxHelper::checkDOM($out, $obj->items);
        } else if ($layout == 'post-tags') {
            $str = gridboxHelper::getPostTags($_POST['id']);
            $out = str_replace('[blog_post_tags]', $str, $out);
        } else if ($layout == 'tags') {
            if (!empty($_POST['edit_type']) && $_POST['edit_type'] == 'blog') {
                $obj->items->{'item-'.$now}->app = $_POST['id'];
            } else if (empty($_POST['edit_type'])) {
                $obj->items->{'item-'.$now}->app = gridboxHelper::getAppId($_POST['id']);
            }
            if (empty($obj->items->{'item-'.$now}->app)) {
                $obj->items->{'item-'.$now}->app = 0;
            }
            $str = gridboxHelper::getBlogTags($obj->items->{'item-'.$now}->app, '', $obj->items->{'item-'.$now}->count);
            $out = str_replace('[ba_blog_tags]', $str, $out);
        } else if ($layout == 'categories') {
            if (!empty($_POST['edit_type']) && $_POST['edit_type'] == 'blog') {
                $obj->items->{'item-'.$now}->app = $_POST['id'];
            } else if (empty($_POST['edit_type'])) {
                $obj->items->{'item-'.$now}->app = gridboxHelper::getAppId($_POST['id']);
            }
            if (empty($obj->items->{'item-'.$now}->app)) {
                $obj->items->{'item-'.$now}->app = 0;
            }
            $categories = gridboxHelper::getBlogCategories($obj->items->{'item-'.$now}->app);
            $str = gridboxHelper::getBlogCategoriesHtml($categories);
            $out = str_replace('[ba_blog_categories]', $str, $out);
        } else if ($layout == 'recent-posts') {
            if (!empty($_POST['edit_type']) && $_POST['edit_type'] == 'blog') {
                $obj->items->{'item-'.$now}->app = $_POST['id'];
            } else if (empty($_POST['edit_type'])) {
                $obj->items->{'item-'.$now}->app = gridboxHelper::getAppId($_POST['id']);
            }
            if (empty($obj->items->{'item-'.$now}->app)) {
                $obj->items->{'item-'.$now}->app = 0;
            }
            $id = $obj->items->{'item-'.$now}->app;
            $sort = $obj->items->{'item-'.$now}->sorting;
            $limit = $obj->items->{'item-'.$now}->limit;
            $maximum = $obj->items->{'item-'.$now}->maximum;
            gridboxHelper::$editItem = $obj->items->{'item-'.$now};
            $str = gridboxHelper::getRecentPosts($id, $sort, $limit, $maximum);
            $out = str_replace('[ba_recent_posts]', $str, $out);
        } else if ($layout == 'recent-posts-slider') {
            if (!empty($_POST['edit_type']) && $_POST['edit_type'] == 'blog') {
                $obj->items->{'item-'.$now}->app = $_POST['id'];
            } else if (empty($_POST['edit_type'])) {
                $obj->items->{'item-'.$now}->app = gridboxHelper::getAppId($_POST['id']);
            }
            if (empty($obj->items->{'item-'.$now}->app)) {
                $obj->items->{'item-'.$now}->app = 0;
            }
            $id = $obj->items->{'item-'.$now}->app;
            $sort = $obj->items->{'item-'.$now}->sorting;
            $limit = $obj->items->{'item-'.$now}->limit;
            $maximum = $obj->items->{'item-'.$now}->maximum;
            gridboxHelper::$editItem = $obj->items->{'item-'.$now};
            $str = gridboxHelper::getRecentPosts($id, $sort, $limit, $maximum);
            $out = str_replace('[ba_recent_posts_slider]', $str, $out);
        } else if ($layout == 'related-posts') {
            $obj->items->{'item-'.$now}->app = gridboxHelper::getAppId($_POST['id']);
            $id = $obj->items->{'item-'.$now}->app;
            $related = $obj->items->{'item-'.$now}->related;
            $limit = $obj->items->{'item-'.$now}->limit;
            $maximum = $obj->items->{'item-'.$now}->maximum;
            gridboxHelper::$editItem = $obj->items->{'item-'.$now};
            $str = gridboxHelper::getRelatedPosts($id, $related, $limit, $maximum, $_POST['id']);
            $out = str_replace('[ba_related_posts]', $str, $out);
        } else if ($layout == 'post-navigation') {
            $maximum = $obj->items->{'item-'.$now}->maximum;
            gridboxHelper::$editItem = $obj->items->{'item-'.$now};
            $str = gridboxHelper::getPostNavigation($maximum, $_POST['id']);
            $out = str_replace('[ba_post_navigation]', $str, $out);
        } else if ($layout == 'search') {
            $str = '';
            for ($i = 0; $i < 6; $i++) {
                $str .= '<div class="ba-blog-post"><div class="ba-blog-post-image"><div class="ba-overlay"></div><a href="'.JUri::root();
                $str .= '" style="background-image: url(components/com_gridbox/assets/images/default-theme.png);">';
                $str .= '</a></div><div class="ba-blog-post-content"><div class="ba-blog-post-title-wrapper">';
                $str .= '<h3 class="ba-blog-post-title"><a href="'.JUri::root().'">'.JText::_('TITLE');
                $str .= '</a></h3></div><div class="ba-blog-post-info-wrapper"><span class="ba-blog-post-date">';
                $str .= '<i class="zmdi zmdi-time"></i>'.JText::_('START_PUBLISHING').'</span>';
                $str .= '<span class="ba-blog-post-category"><i class="zmdi zmdi-label"></i><a href="'.JUri::root().'">';
                $str .= JText::_('CATEGORY').'</a></span></div><div class="ba-blog-post-intro-wrapper">';
                $str .= JText::_('INTRO_TEXT').'</div><div class="ba-blog-post-button-wrapper">';
                $str .= '<a class="ba-btn-transition" href="'.JUri::root().'">'.JText::_('READ_MORE').'</a></div></div></div>';
            }
            $out = str_replace('[ba_search_result]', $str, $out);
            $str = '<div class="ba-blog-posts-pagination-wrapper"><div class="ba-blog-posts-pagination">';
            $str .= '<span class="disabled ba-search-first-page"><a href="#"><i class="zmdi zmdi-skip-previous"></i>';
            $str .= '</a></span><span class="disabled ba-search-prev-page"><a href="#"><i class="zmdi zmdi-fast-rewind">';
            $str .= '</i></a></span><span class="active ba-search-pages"><a href="#">1</a></span>';
            $str .= '<span class="ba-search-pages"><a href="#">2</a></span><span class="ba-search-next-page">';
            $str .= '<a href="#"><i class="zmdi zmdi-fast-forward"></i></a></span><span class="ba-search-last-page">';
            $str .= '<a href="#"><i class="zmdi zmdi-skip-next"></i></a></span></div></div>';
            $out = str_replace('[ba_search_result_paginator]', $str, $out);
        }
        $obj->html = $out;
        echo json_encode($obj);
        exit;
    }

    public function returnStyle()
    {
        $str = '';
        $doc = JFactory::getDocument();
        foreach ($doc->_scripts as $key => $script) {
            $str .= '<script src="'.$key.'" type="text/javascript"';
            if (isset($script['defer']) && !empty($script['defer'])) {
                $str .= ' defer';
            }
            if (isset($script['async']) && !empty($script['async'])) {
                $str .= ' async';
            }
            $str .= '></script>';
        }
        foreach ($doc->_script as $key => $script) {
            $str .= '<script type="'.$key.'">'.$script.'</script>';
        }
        foreach ($doc->_styleSheets as $key => $link) {
            $str .= '<link href="'.$key.'" type="text/css"';
            if (isset($script['media']) && !empty($link['media'])) {
                $str .= ' media="'.$link['media'].'"';
            }
            $str .= ' rel="stylesheet">';
        }
        foreach ($doc->_style as $key => $style) {
            $str .= '<style type="'.$key.'">'.$style.'</style>';
        }

        return $str;
    }

    public function getWebsite()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('`#__gridbox_website`')
            ->where('`id` = 1');
        $db->setQuery($query);
        $result = $db->loadObject();

        return $result;
    }

    public function getLibraryItems()
    {
        $obj = new stdClass();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('title, global_item, id, image')
            ->from('`#__gridbox_library`')
            ->where('`type` = ' .$db->quote('section'));
        $db->setQuery($query);
        $obj->sections = $db->loadObjectList();
        $query = $db->getQuery(true);
        $query->select('title, global_item, id, image')
            ->from('`#__gridbox_library`')
            ->where('`type` = ' .$db->quote('plugin'));
        $db->setQuery($query);
        $obj->plugins = $db->loadObjectList();

        return $obj;
    }

    public function getItem($id = null)
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            $input = JFactory::getApplication()->input;
            $name = $input->getCmd('name');
            if (!empty($name)) {
                $name = urldecode($name);
                gridboxHelper::userLogin($name);
            }
        }
        if (isset($_GET['session_id']) || isset($_GET['name'])) {
            parse_str($_SERVER['QUERY_STRING'], $array);
            unset($array['name']);
            unset($array['session_id']);
            $url = '';
            foreach ($array as $key => $value) {
                $url .= '&'.$key.'='.$value;
            }
            $url = substr($url, 1);
            $url = JUri::current().'?'.$url;
            header('Location: '.$url);
            exit;
        }
        $input = JFactory::getApplication()->input;
        $db = $this->getDbo();
        $title = $input->get('ba-title', '', 'string');
        $edit_type = $input->get('edit_type', '', 'string');
        $id = $input->get('id', 0, 'int');
        if ($id != 0) {
            $query = $db->getQuery(true);
            if ($edit_type == 'blog') {
                $query->select('b.*')
                    ->from('`#__gridbox_app` AS b')
                    ->where('b.id = ' .$id)
                    ->select('t.title as ThemeTitle')
                    ->leftJoin('`#__template_styles` AS t'
                        . ' ON '
                        . $db->quoteName('b.theme')
                        . ' = ' 
                        . $db->quoteName('t.id')
                    );
            } else if (empty($edit_type)) {
                $query->select('b.*')
                    ->from('`#__gridbox_pages` AS b')
                    ->where('b.id = ' .$id)
                    ->select('t.title as ThemeTitle')
                    ->leftJoin('`#__template_styles` AS t'
                        . ' ON '
                        . $db->quoteName('b.theme')
                        . ' = ' 
                        . $db->quoteName('t.id')
                    )
                    ->select('a.type as app_type')
                    ->leftJoin('`#__gridbox_app` AS a'
                        . ' ON '
                        . $db->quoteName('b.app_id')
                        . ' = ' 
                        . $db->quoteName('a.id')
                    );
            } else if ($edit_type == 'system') {
                $query->select('*')
                    ->from('#__gridbox_system_pages')
                    ->where('id = '.$id);
            }
            $db->setQuery($query);
            $item = $db->loadObject();
        } else {
            $item = new stdClass();
        }
        
        return $item;
    }

    public function getThemes()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title, home')
            ->from('#__template_styles')
            ->where('`template`=' .$db->quote('gridbox'))
            ->order('home desc');
        $db->setQuery($query);
        $themes = $db->loadObjectList();
        
        return $themes;
    }

    public function installBlocks($item)
    {
        $db = JFactory::getDbo();
        $obj = new stdClass();
        $obj->type = $item->type;
        $obj->title = $item->title;
        $obj->image = $item->image;
        $object = json_decode($item->data);
        $object->items = json_decode($object->items);
        $obj->item = json_encode($object);
        $db->insertObject('#__gridbox_page_blocks', $obj);
        $array = explode(',', $item->imageData);
        $content = base64_decode($array[1]);
        JFile::write(JPATH_COMPONENT.'/assets/images/page-blocks/'.$obj->image, $content);
    }

    public function installPlugin($data)
    {
        $db = JFactory::getDbo();
        foreach ($data as $group) {
            foreach ($group as $plugin) {
                $db->insertObject('#__gridbox_plugins', $plugin);
            }
        }
    }

    public function checkBlocks($block) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_page_blocks')
            ->where('`title` = ' .$db->quote($block));
        $db->setQuery($query);
        $id = $db->loadResult();
        
        return $id;
    }

    public function checkPlugin($plugin) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_plugins')
            ->where('`title` = ' .$db->quote($plugin));
        $db->setQuery($query);
        $id = $db->loadResult();
        
        return $id;
    }

    public function returnObj($id, $plugin)
    {
        $obj = new stdClass();
        $obj->id = $id;
        $obj->title = trim((string)$plugin->title);
        $obj->image = trim((string)$plugin->image);
        $obj->type = trim((string)$plugin->type);
        $obj->joomla_constant = trim((string)$plugin->joomla_constant);

        return $obj;
    }

    public function getBlocks()
    {
        $blocks = array('cover' => array(), 'about-us' => array(), 'services' => array(), 
            'description' => array(), 'steps' => array(), 'schedule' => array(), 'features' => array(),
            'pricing-table' => array(), 'pricing-list' => array(), 'testimonials' => array(), 'team' => array(),
            'counters' => array(), 'faq' => array(), 'call-to-action' => array());
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('type, title, image, id')
            ->from('#__gridbox_page_blocks')
            ->order('id asc');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $item) {
            if (isset($blocks[$item->type])) {
                $blocks[$item->type][$item->title] = $item;
            }
        }

        return $blocks;
    }

    public function getPlugins()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__gridbox_plugins')
            ->order('joomla_constant asc');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        $plugins = array('content' => array(), 'info' => array(), 'navigation' => array(),
            'social' => array(), 'blog' => array(), '3rd-party-plugins' => array());
        $query = $db->getQuery(true)
            ->select('`key`')
            ->from('#__gridbox_api')
            ->where('service = '.$db->quote('balbooa'));
        $db->setQuery($query);
        $balbooa = $db->loadResult();
        $balbooa = json_decode($balbooa);
        if (isset($balbooa->license)) {
            $plugins['blog'] = $this->getBlogPlugins();
        } else {
            unset($plugins['blog']);
        }
        foreach ($items as $item) {
            $plugins[$item->type][$item->title] = $item;
        }

        return $plugins;
    }

    public function getBlogPlugins()
    {
        $plugins = array('tags', 'categories', 'recent-posts', 'search'/*, 'recent-posts-slider'*/);
        $icons = array('flaticon-bookmark', 'flaticon-folder-13', 'flaticon-calendar-6', 'flaticon-search'/*, 'flaticon-tabs'*/);
        while ($plugin = array_pop($plugins)) {
            $obj = new stdClass();
            $obj->title = 'ba-'.$plugin;
            $obj->image = array_pop($icons);
            $obj->type = 'blog';
            $obj->joomla_constant = strtoupper(str_replace('-', '_', $plugin));
            $blog[$obj->title] = $obj;
        }

        return $blog;
    }

    public function getMenus()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('menutype, title')
            ->from('#__menu_types');
        $db->setQuery($query);
        $menus = $db->loadObjectList();
        
        return $menus;
    }

    public function getApps()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title, id')
            ->from('#__gridbox_app')
            ->where('type = '.$db->quote('blog'));
        $db->setQuery($query);
        $items = $db->loadObjectList();

        return $items;
    }

    public function getCategories()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title, id, app_id')
            ->from('#__gridbox_categories')
            ->order('order_list ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();

        return $items;
    }

    public function getFonts()
    {
        $str = gridboxHelper::getFonts();
        
        return $str;
    }
    
    public function getForm()
    {
        $form = JForm::getInstance('gridbox', JPATH_COMPONENT.'/models/forms/gridbox.xml');
        
        return $form;
    }
}
