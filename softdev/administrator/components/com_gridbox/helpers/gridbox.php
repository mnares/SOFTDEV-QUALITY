<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
use Joomla\CMS\Component\ComponentHelper;
jimport('joomla.filter.output');
jimport('joomla.filesystem.file');
if (!function_exists('mb_strtolower')) {
    function mb_strtolower($str, $encoding = 'utf-8')
    {
        return strtolower($str);
    }
}

abstract class gridboxHelper 
{
    public static function checkUserEditLevel()
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            exit;
        }
    }

    public static function setGridboxFilters($ordering, $direction, $context)
    {
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $query = $db->getQuery(true)
            ->select('id, name')
            ->from('#__gridbox_filter_state')
            ->where('name = '.$db->quote($context.'.list.ordering').' OR name = '.$db->quote($context.'.list.direction'))
            ->where('user = '.$user->id);
        $db->setQuery($query);
        $array = $db->loadObjectList();
        if (!empty($array)) {
            foreach ($array as $obj) {
                if ($obj->name == $context.'.list.ordering') {
                    $obj->value = $ordering;
                } else {
                    $obj->value = $direction;
                }
                $db->updateObject('#__gridbox_filter_state', $obj, 'id');
            }
        } else {
            $obj = new stdClass();
            $obj->user = $user->id;
            $obj->name = $context.'.list.ordering';
            $obj->value = $ordering;
            $db->insertObject('#__gridbox_filter_state', $obj);
            $obj->name = $context.'.list.direction';
            $obj->value = $direction;
            $db->insertObject('#__gridbox_filter_state', $obj);
        }
    }

    public static function getGridboxFilters($context)
    {
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $query = $db->getQuery(true)
            ->select('id, name, value')
            ->from('#__gridbox_filter_state')
            ->where('name = '.$db->quote($context.'.list.ordering').' OR name = '.$db->quote($context.'.list.direction'))
            ->where('user = '.$user->id);
        $db->setQuery($query);
        $array = $db->loadObjectList();

        return $array;
    }

    public static function getGridboxLanguage()
    {
        $language = JFactory::getLanguage();
        $paths = $language->getPaths('com_gridbox');
        $result = array();
        foreach ($paths as $key => $value) {
            if (JFile::exists($key)) {
                if (!function_exists('parse_ini_file')) {
                    $contents = file_get_contents($key);
                    $contents = str_replace('_QQ_', '"\""', $contents);
                    $data = @parse_ini_string($contents);
                } else {
                    $data = @parse_ini_file($key);
                }
                $result = array_merge($result, $data);
            }
        }
        $data = 'var gridboxLanguage = '.json_encode($result).';';
        $data .= 'var JUri = "'.JUri::root().'";';

        return $data;
    }
    
    public static function getThemes()
    {
        $url = 'http://www.balbooa.com/updates/gridbox/themes/themes.xml';
        $curl = gridboxHelper::getContentsCurl($url);
        $xml = simplexml_load_string($curl);
        $themes = array();
        foreach ($xml->themes->theme as $theme) {
            $obj = new stdClass();
            $obj->id = trim((string)$theme->id);
            $obj->title = trim((string)$theme->title);
            $obj->image = trim((string)$theme->image);
            $themes[] = $obj;
        }

        return $themes;
    }

    public static function getTemplate()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__template_styles')
            ->where('`template` = '.$db->Quote('gridbox'))
            ->where('`client_id` = 0');
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public static function deleteTagsLink($pages)
    {
        $db = JFactory::getDbo();
        foreach ($pages as $value) {
            $query = $db->getQuery(true)
                ->select('tag_id')
                ->from('#__gridbox_tags_map')
                ->where('`page_id` = '. $value);
            $db->setQuery($query);
            $tags = $db->loadObjectList();
            $query = $db->getQuery(true)
                ->delete('#__gridbox_tags_map')
                ->where('`page_id` = '. $value);
            $db->setQuery($query)
                ->execute();
            if (!empty($tags) && is_array($tags)) {
                foreach ($tags as $tag) {
                    $query = $db->getQuery(true)
                        ->select('COUNT(id)')
                        ->from('#__gridbox_tags_map')
                        ->where('`tag_id` = '. $tag->tag_id);
                    $db->setQuery($query);
                    $count = $db->loadResult();
                    if (empty($count)) {
                        $query = $db->getQuery(true)
                            ->delete('#__gridbox_tags')
                            ->where('`id` = '. $tag->tag_id);
                        $db->setQuery($query)
                            ->execute();
                    }
                }
            }
        }
    }

    public static function importBlogContent($obj, $apps, $categories)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
        include_once JPATH_ROOT.'/components/com_gridbox/libraries/php/phpQuery/phpQuery.php';
        $dom = phpQuery::newDocument($obj->html);
        $tags = pq('.ba-item-tags');
        foreach ($tags as $value) {
            $app = pq($value)->attr('data-app');
            $cat = pq($value)->attr('data-category');
            $id = pq($value)->attr('id');
            pq($value)->attr('data-app', $apps[$app]);
            $item = $obj->items->{$id};
            $item->app = $apps[$app];
            if (!empty($cat)) {
                $catList = explode(',', $cat);
                $object = new stdClass();
                foreach ($catList as $category) {
                    if (!isset($categories[$category])) {
                        continue;
                    }
                    $catObj = new stdClass();
                    $catObj->id = $categories[$category];
                    $catObj->title = $item->categories->{$category}->title;
                    $object->{$catObj->id} = $catObj;
                    $category = $categories[$category];
                }
                $item->categories = $object;
                $cat = implode(',', $catList);
                pq($value)->attr('data-category', $cat);
            }
        }
        $categories = pq('.ba-item-categories');
        foreach ($categories as $value) {
            $app = pq($value)->attr('data-app');
            $id = pq($value)->attr('id');
            pq($value)->attr('data-app', $apps[$app]);
            $obj->items->{$id}->app = $apps[$app];
        }
        $recent = pq('.ba-item-recent-posts');
        foreach ($recent as $value) {
            $app = pq($value)->attr('data-app');
            $cat = pq($value)->attr('data-category');
            $id = pq($value)->attr('id');
            pq($value)->attr('data-app', $apps[$app]);
            $obj->items->{$id}->app = $apps[$app];
            $item = $obj->items->{$id};
            $item->app = $apps[$app];
            if (!empty($cat)) {
                $catList = explode(',', $cat);
                $object = new stdClass();
                foreach ($catList as $category) {
                    if (!isset($categories[$category])) {
                        continue;
                    }
                    $catObj = new stdClass();
                    $catObj->id = $categories[$category];
                    $catObj->title = $item->categories->{$category}->title;
                    $object->{$catObj->id} = $catObj;
                    $category = $categories[$category];
                }
                $item->categories = $object;
                $cat = implode(',', $catList);
                pq($value)->attr('data-category', $cat);
            }
        }
        $related = pq('.ba-item-related-posts');
        foreach ($related as $value) {
            $app = pq($value)->attr('data-app');
            $id = pq($value)->attr('id');
            pq($value)->attr('data-app', $apps[$app]);
        }
        $obj->html = $dom->htmlOuter();

        return $obj;

    }

    public static function aboutUs()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("manifest_cache");
        $query->from("#__extensions");
        $query->where("type=" .$db->quote('component'))
            ->where('element=' .$db->quote('com_gridbox'));
        $db->setQuery($query);
        $about = $db->loadResult();
        $about = json_decode($about);
        
        return $about;
    }
    
    public static function getLanguagesList()
    {
        $url = 'http://www.balbooa.com/updates/gridbox/language/language.xml';
        $curl = self::getContentsCurl($url);
        $xml = simplexml_load_string($curl);
        $array = array();
        if (isset($xml->languages)) {
            foreach ($xml->languages->language as $language) {
                $obj = new StdClass();
                $obj->flag = 'http://www.balbooa.com/updates/gridbox/language/flags/'.trim((string)$language->flag);
                $obj->title = trim((string)$language->title);
                $obj->code = trim((string)$language->tag);
                $obj->url = trim((string)$language->url);
                $array[] = $obj;
            }
        }

        return $array;
    }

    public static function setCalendar()
    {
        $_DN = array(JText::_('SUNDAY'), JText::_('MONDAY'), JText::_('TUESDAY'), JText::_('WEDNESDAY'),
            JText::_('THURSDAY'), JText::_('FRIDAY'), JText::_('SATURDAY'), JText::_('SUNDAY'));
        $_SDN = array(JText::_('SUN'), JText::_('MON'), JText::_('TUE'), JText::_('WED'), JText::_('THU'),
            JText::_('FRI'), JText::_('SAT'), JText::_('SUN'));
        $_MN = array(JText::_('JANUARY'), JText::_('FEBRUARY'), JText::_('MARCH'), JText::_('APRIL'),
            JText::_('MAY'), JText::_('JUNE'), JText::_('JULY'), JText::_('AUGUST'), JText::_('SEPTEMBER'),
            JText::_('OCTOBER'), JText::_('NOVEMBER'), JText::_('DECEMBER'));
        $_SMN = array(JText::_('JANUARY_SHORT'), JText::_('FEBRUARY_SHORT'), JText::_('MARCH_SHORT'),
            JText::_('APRIL_SHORT'), JText::_('MAY_SHORT'), JText::_('JUNE_SHORT'), JText::_('JULY_SHORT'),
            JText::_('AUGUST_SHORT'), JText::_('SEPTEMBER_SHORT'), JText::_('OCTOBER_SHORT'),
            JText::_('NOVEMBER_SHORT'), JText::_('DECEMBER_SHORT'));
        $today = " " . JText::_('JLIB_HTML_BEHAVIOR_TODAY') . " ";
        $_TT = array('INFO' => JText::_('JLIB_HTML_BEHAVIOR_ABOUT_THE_CALENDAR'),
            'ABOUT' => "DHTML Date/Time Selector\n"
            . "(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n"
            . "For latest version visit: http://www.dynarch.com/projects/calendar/\n"
            . "Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details."
            . "\n\n" . JText::_('JLIB_HTML_BEHAVIOR_DATE_SELECTION')
            . JText::_('JLIB_HTML_BEHAVIOR_YEAR_SELECT')
            . JText::_('JLIB_HTML_BEHAVIOR_MONTH_SELECT')
            . JText::_('JLIB_HTML_BEHAVIOR_HOLD_MOUSE'),
            'ABOUT_TIME' => "\n\n"
            . "Time selection:\n"
            . "- Click on any of the time parts to increase it\n"
            . "- or Shift-click to decrease it\n"
            . "- or click and drag for faster selection.",
            'PREV_YEAR' => JText::_('JLIB_HTML_BEHAVIOR_PREV_YEAR_HOLD_FOR_MENU'),
            'PREV_MONTH' => JText::_('JLIB_HTML_BEHAVIOR_PREV_MONTH_HOLD_FOR_MENU'),
            'GO_TODAY' => JText::_('JLIB_HTML_BEHAVIOR_GO_TODAY'),
            'NEXT_MONTH' => JText::_('JLIB_HTML_BEHAVIOR_NEXT_MONTH_HOLD_FOR_MENU'),
            'SEL_DATE' => JText::_('JLIB_HTML_BEHAVIOR_SELECT_DATE'),
            'DRAG_TO_MOVE' => JText::_('JLIB_HTML_BEHAVIOR_DRAG_TO_MOVE'),
            'PART_TODAY' => $today,
            'DAY_FIRST' => JText::_('JLIB_HTML_BEHAVIOR_DISPLAY_S_FIRST'),
            'WEEKEND' => JFactory::getLanguage()->getWeekEnd(),
            'CLOSE' => JText::_('JLIB_HTML_BEHAVIOR_CLOSE'),
            'TODAY' => JText::_('JLIB_HTML_BEHAVIOR_TODAY'),
            'TIME_PART' => JText::_('JLIB_HTML_BEHAVIOR_SHIFT_CLICK_OR_DRAG_TO_CHANGE_VALUE'),
            'DEF_DATE_FORMAT' => "%Y-%m-%d",
            'TT_DATE_FORMAT' => JText::_('JLIB_HTML_BEHAVIOR_TT_DATE_FORMAT'),
            'WK' => JText::_('JLIB_HTML_BEHAVIOR_WK'),
            'TIME' => JText::_('JLIB_HTML_BEHAVIOR_TIME')
        );

        return 'Calendar._DN = ' . json_encode($_DN) . ';'
            . ' Calendar._SDN = ' . json_encode($_SDN) . ';'
            . ' Calendar._FD = 0;'
            . ' Calendar._MN = ' . json_encode($_MN) . ';'
            . ' Calendar._SMN = ' . json_encode($_SMN) . ';'
            . ' Calendar._TT = ' . json_encode($_TT) . ';';
    }

    public static function deletePageCss($cid)
    {
        foreach ($cid as $id) {
            $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/style-'.$id.'.css';
            JFile::delete($file);
        }
    }

    public static function deleteThemeCss($cid)
    {
        foreach ($cid as $id) {
            $file = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$id.'.css';
            self::deleteFile($file);
            $file = JPATH_ROOT. '/templates/gridbox/css/storage/style-'.$id.'.css';
            self::deleteFile($file);
            $file = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$id.'.js';
            self::deleteFile($file);
        }
    }

    public static function deleteFile($file)
    {
        if (JFile::exists($file)) {
            JFile::delete($file);
        }
    }

    public static function getApps()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title, alias, theme, type, published, access, language, image, meta_title, meta_description, meta_keywords')
            ->from('#__gridbox_app')
            ->order('order_list ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }

    public static function saveCodeEditor($obj, $id)
    {
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$id.'.css';
        JFile::write($file, (string)$obj->css);
        $file = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$id.'.js';
        JFile::write($file, (string)$obj->js);
    }

    public static function copyThemeFiles($pk, $id)
    {
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$pk.'.css';
        if (JFile::exists($file)) {
            $target = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$id.'.css';
            JFile::copy($file, $target);
        }
        $file = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$pk.'.js';
        if (JFile::exists($file)) {
            $target = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$id.'.js';
            JFile::copy($file, $target);
        }
    }

    public static function copyCss($pk, $id)
    {
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/style-'.$pk.'.css';
        $target = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/style-'.$id.'.css';
        JFile::copy($file, $target);
    }

    public static function replace($str)
    {

        $str = mb_strtolower($str, 'utf-8');
        $search = array('?', '!', '.', ',', ':', ';', '*', '(', ')', '{', '}', '***91;',
            '***93;', '%', '#', '№', '@', '$', '^', '-', '+', '/', '\\', '=',
            '|', '"', '\'', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ъ',
            'ы', 'э', ' ', 'ж', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я');
        $replace = array('-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-',
            '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-',
            'a', 'b', 'v', 'g', 'd', 'e', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n',
            'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'j', 'i', 'e', '-', 'zh', 'ts',
            'ch', 'sh', 'shch', '', 'yu', 'ya');
        $str = str_replace($search, $replace, $str);
        $str = trim($str);
        $str = preg_replace("/_{2,}/", "-", $str);

        return $str;
    }
    
    public static function checkActive($app)
    {
        $active = '';
        $view = 'pages';
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (isset($_GET['view'])) {
            $view = $_GET['view'];
        }
        if (gettype($app) == 'string') {
            if ($app == $view) {
                $active = 'active';
            }
        } else if ($app->id == $id) {
            $active = 'active';
        }

        return $active;
    }

    public static function getUrl($app)
    {
        $view = str_replace('blog', 'blogs', $app->type);

        return 'index.php?option=com_gridbox&view='.$view.'&id='.$app->id;
    }

    public static function getIcon($app)
    {
        switch ($app->type) {
            case 'blog':
                return 'zmdi zmdi-format-color-text';
                break;
            case 'tags':
                return 'zmdi zmdi-label';
                break;
            default:
                return 'zmdi zmdi-file';
                break;
        }
    }
    
    public static function ajaxReload($text, $type = '')
    {
        echo $type.JText::_($text);
        exit;
    }

    public static function stringURLSafe($string, $language = '')
    {
        if (\JFactory::getConfig()->get('unicodeslugs') == 1)
        {
            $output = \JFilterOutput::stringURLUnicodeSlug($string);
        }
        else
        {
            if ($language === '*' || $language === '')
            {
                $languageParams = ComponentHelper::getParams('com_languages');
                $language = $languageParams->get('site');
            }

            $output = \JFilterOutput::stringURLSafe($string, $language);
        }

        return $output;
    }

    public static function getAlias($alias, $table, $app = 0)
    {
        $originAlias = $alias;
        $alias = self::stringURLSafe(trim($alias));
        if (empty($alias)) {
            $alias = $originAlias;
            $alias = self::replace($alias);
            $alias = JFilterOutput::stringURLSafe($alias);
        }
        if (empty($alias)) {
            $alias = date('Y-m-d-H-i-s');
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from($table)
            ->where('`alias` = ' .$db->Quote($alias))
            ->where('`id` <> ' .$db->Quote($app));
        $db->setQuery($query);
        $id = $db->loadResult();
        if (!empty($id)) {
            $alias = JString::increment($alias);
            $alias = self::getAlias($alias, $table);
        }
        
        return $alias;
    }

    public static function prepareGridbox()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_api')
            ->where('service = '.$db->quote('balbooa'));
        $db->setQuery($query);
        $balbooa = $db->loadObject();
        if (!$balbooa) {
            $obj = new stdClass();
            $obj->key = '{}';
            $obj->service = 'balbooa';
            $db->insertObject('#__gridbox_api', $obj);
        }
    }

    public static function getNewPageAlias($type, $orig)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_pages')
            ->where('`page_alias` = '.$db->quote($type));
        $db->setQuery($query);
        $id = $db->loadResult();
        if (!empty($id)) {
            if (empty($orig)) {
                $type = JString::increment($type);
            } else {
                $type = JString::increment($orig);
            }
            $orig = $type;
            $type = self::stringURLSafe($type);
            if (empty($type)) {
                $type = $orig;
                $type = self::replace($type);
                $type = JFilterOutput::stringURLSafe($type);
            }
            if (empty($type)) {
                $type = date('Y-m-d-H-i-s');
            }
            $type = self::getNewPageAlias($type, $orig);
        }

        return $type;
    }

    public static function setAppLicense($data)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_api')
            ->where('service = '.$db->quote('balbooa'));
        $db->setQuery($query);
        $balbooa = $db->loadObject();
        $balbooa->key = json_decode($balbooa->key);
        $balbooa->key->license = $data;
        $balbooa->key = json_encode($balbooa->key);
        $db->updateObject('#__gridbox_api', $balbooa, 'id');
    }

    public static function appClassName()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('`key`')
            ->from('#__gridbox_api')
            ->where('service = '.$db->quote('balbooa'));
        $db->setQuery($query);
        $balbooa = $db->loadResult();
        $obj = json_decode($balbooa);
        $str = 'disabled-apps';
        $today = date("Y-m-d H:i:s");
        if ($obj && isset($obj->license) && $today < $obj->license) {
            $str = '';
        }

        return $str;
    }
    
    public static function getContentsCurl($url)
    {
        $http = JHttpFactory::getHttp();
        $body = '';
        $host = 'balbooa.com';
        if($socket =@ fsockopen($host, 80, $errno, $errstr, 30)) {
            $data = $http->get($url);
            $body = $data->body;
            fclose($socket);
        }
        
        return $body;
    }
    
    public static function getSystemPlugin()
    {
        $flag = JPluginHelper::isEnabled('system', 'gridbox');
        
        return $flag;
    }
    
    public static function getGlobal($body, $array)
    {
        $regex = '/\[global item=+(.*?)\]/i';
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        $db = JFactory::getDBO();
        foreach ($matches as $index => $match) {
            $query = $db->getQuery(true)
                ->select('*')
                ->from('#__gridbox_library')
                ->where('`global_item` = ' . $db->quote($match[1]));
            $db->setQuery($query);
            $result = $db->loadObject();
            $array[] = $result;
        }
        
        return $array;
    }

    public static function getBaforms($body, $array)
    {
        $regex = '/\[forms ID=+(.*?)\]/i';
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        $db = JFactory::getDbo();
        $query = 'SHOW TABLES LIKE '.$db->quote('%baforms_forms');
        $db->setQuery($query);
        $result = $db->loadResult();
        if (!empty($result)) {
            foreach ($matches as $match) {
                if (!array_key_exists($match[1], $array)) {
                    $id = $match[1];
                    $obj = new StdClass();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__baforms_forms')
                        ->where('`id` = ' .$db->quote($id));
                    $db->setQuery($query);
                    $obj->forms = $db->loadObject();
                    if (empty($obj)) {
                        continue;
                    }
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__baforms_items')
                        ->where('`form_id` = ' .$db->quote($id));
                    $db->setQuery($query);
                    $obj->items = $db->loadObjectList();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__baforms_columns')
                        ->where('`form_id` = ' .$db->quote($id));
                    $db->setQuery($query);
                    $obj->columns = $db->loadObjectList();
                    $array[$id] = $obj;
                }
            }
        }
        
        return $array;
    }

    public static function getMainMenu($body, $array)
    {
        $regex = '/\[main_menu=+(.*?)\]/i';
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        if ($matches) {
            foreach ($matches as $match) {
                if (!array_key_exists($match[1], $array)) {
                    $id = $match[1];
                    $obj = new StdClass();
                    $db = JFactory::getDBO();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__modules')
                        ->where('`id` = ' .$db->quote($id));
                    $db->setQuery($query);
                    $obj->module = $db->loadObject();
                    if (empty($obj->module)) {
                        $query = $db->getQuery(true)
                            ->select('*')
                            ->from('#__modules')
                            ->where('client_id = 0')
                            ->where('published = 1')
                            ->where('position = '.$db->quote('main-menu'))
                            ->where('module = '.$db->quote('mod_menu'));
                        $db->setQuery($query);
                        $obj->module = $db->loadObject();
                        if (empty($obj->module)) {
                            $query = $db->getQuery(true)
                                ->select('*')
                                ->from('#__modules')
                                ->where('client_id = 0')
                                ->where('published = 1')
                                ->where('module = '.$db->quote('mod_menu'));
                            $db->setQuery($query);
                            $obj->module = $db->loadObject();
                        }
                    }
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__assets')
                        ->where('`id` = ' .$db->quote($obj->module->asset_id));
                    $db->setQuery($query);
                    $obj->asset = $db->loadObject();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__modules_menu')
                        ->where('`moduleid` = ' .$db->quote($obj->module->id));
                    $db->setQuery($query);
                    $obj->module_menu = $db->loadObject();
                    $params = $obj->module->params;
                    $params = json_decode($params);
                    $query = $db->getQuery(true);
                    $query->select("extension_id");
                    $query->from("#__extensions");
                    $query->where("type=" .$db->quote('component'))
                        ->where('element=' .$db->quote('com_gridbox'));
                    $db->setQuery($query);
                    $com_id = $db->loadResult();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__menu_types')
                        ->where('`menutype` = ' .$db->quote($params->menutype));
                    $db->setQuery($query);
                    $obj->menu = $db->loadObject();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__menu')
                        ->where('`menutype` = ' .$db->quote($params->menutype))
                        ->where('`component_id` = ' .$db->quote($com_id))
                        ->order('`id` DESC');
                    $db->setQuery($query);
                    $obj->menu_items = $db->loadObjectList();
                    $array[$id] = $obj;
                }
            }
        }
        
        return $array;
    }

    public static function getTags()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__gridbox_tags');
        $db->setQuery($query);
        $tags = $db->loadObjectList();

        return $tags;
    }
}