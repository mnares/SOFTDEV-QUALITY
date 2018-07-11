<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
jimport('joomla.filter.output');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
use Joomla\Registry\Registry;
use Joomla\CMS\Component\ComponentHelper;
include 'mb_compat.php';

abstract class gridboxHelper
{
    public static $fonts;
    public static $up;
    public static $cssRulesFlag;
    public static $breakpoints;
    public static $menuBreakpoint;
    public static $website;
    public static $dateFormat;
    public static $customFonts;
    public static $colorVariables;
    public static $presets;
    public static $editItem;
    public static $parentFonts;

    public static function checkUserEditLevel()
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            exit;
        }
    }

    public static function getDefaultElementsStyle()
    {
        $dir = JPATH_COMPONENT.'/libraries/json/';
        $object = array();
        $files = JFolder::files($dir);
        foreach ($files as $file) {
            $str = JFile::read($dir.$file);
            $obj = json_decode($str);
            if (isset($obj->type)) {
                $object[$obj->type] = $obj;
            } else {
                foreach ($obj as $key => $value) {
                    if (is_object($value) && isset($value->type) && !isset($object[$value->type])) {
                        $object[$value->type] = $value;
                    }
                }
            }
        }
        $dir = JPATH_COMPONENT.'/views/layout/blog/';
        $str = JFile::read($dir.'app.json');
        $obj = json_decode($str);
        foreach ($obj as $item) {
            if (!isset($object[$item->type])) {
                $object[$item->type] = $item;
            }
        }
        $str = JFile::read($dir.'default.json');
        $obj = json_decode($str);
        foreach ($obj as $item) {
            if (!isset($object[$item->type])) {
                $object[$item->type] = $item;
            }
        }
        $dir = JPATH_COMPONENT.'/views/layout/system/';
        $str = JFile::read($dir.'404.json');
        $obj = json_decode($str);
        foreach ($obj as $item) {
            if (!isset($object[$item->type])) {
                $object[$item->type] = $item;
            }
        }
        $dir = JPATH_COMPONENT.'/views/layout/system/';
        $str = JFile::read($dir.'offline.json');
        $obj = json_decode($str);
        foreach ($obj as $item) {
            if (!isset($object[$item->type])) {
                $object[$item->type] = $item;
            }
        }
        $str = json_encode($object);

        return $str;
    }

    public static function getFonts()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('font, styles, custom_src')
            ->from('`#__gridbox_fonts`')
            ->order($db->quoteName('font') . ' ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        $fonts = new stdClass();
        foreach ($items as $item) {
            if (!isset($fonts->{$item->font})) {
                $fonts->{$item->font} = array();
            }
            $fonts->{$item->font}[] = $item;
        }
        foreach ($fonts as $key => $value) {
            usort($value, function($a, $b){
                if ($a->styles == $b->styles) {
                    return 0;
                }

                return ($a->styles < $b->styles) ? -1 : 1;
            });
            $fonts->{$key} = $value;
        }
        $str = json_encode($fonts);
        
        return $str;
    }

    public static function checkCreatePage($id)
    {
        $app = (int)$id;
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('type')
            ->from('#__gridbox_app')
            ->where('id = '.$app);
        $db->setQuery($query);
        $type = $db->loadResult();
        
        return $type;
    }

    public static function getCorrectColor($key)
    {
        if (isset(self::$colorVariables->{$key})) {
            $key = self::$colorVariables->{$key}->color;
        }

        return $key;
    }

    public static function compareFlipboxPresets($obj, $object)
    {
        $obj->parallax = $object->parallax;
        $obj->desktop->background = $object->desktop->background;
        $obj->desktop->overlay = $object->desktop->overlay;
        foreach (self::$breakpoints as $key => $value) {
            if (isset($object->{$key}->background)) {
                $obj->{$key}->background = $object->{$key}->background;
            }
            if (isset($object->{$key}->overlay)) {
                $obj->{$key}->overlay = $object->{$key}->overlay;
            }
        }
    }

    public static function comparePresets($obj)
    {
        if (!empty($obj->preset) && isset(self::$presets->{$obj->type}) && isset(self::$presets->{$obj->type}->{$obj->preset})) {
            $object = self::$presets->{$obj->type}->{$obj->preset};
            foreach (self::$presets->{$obj->type}->{$obj->preset}->data as $ind => $data) {
                if ($ind == 'desktop' || isset(self::$breakpoints->{$ind})) {
                    foreach ($data as $key => $value) {
                        $obj->{$ind}->{$key} = $value;
                    }
                } else if ($obj->type == 'flipbox' && $ind == 'sides') {
                    self::compareFlipboxPresets($obj->sides->backside, $object->data->{$ind}->backside);
                    self::compareFlipboxPresets($obj->sides->frontside, $object->data->{$ind}->frontside);
                } else {
                    $obj->{$ind} = $data;
                }
            }
        }
    }

    public static function getVersion()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('manifest_cache')
            ->from('#__extensions')
            ->where("type = " .$db->quote('component'))
            ->where('element = ' .$db->quote('com_gridbox'));
        $db->setQuery($query);
        $manifest = $db->loadResult();
        $obj = json_decode($manifest);

        return $obj->version;
    }

    public static function getGlobalItems()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('item')
            ->from('`#__gridbox_library`')
            ->where('`global_item` <> ' .$db->quote(''));
        $db->setQuery($query);
        $items = $db->loadObjectList();

        return $items;
    }

    public static function setBreakpoints()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_website');
        $db->setQuery($query);
        $website = $db->loadObject();
        if ($website->breakpoints != 'null' && !empty($website->breakpoints)) {
            $obj = json_decode($website->breakpoints);
        } else {
            $obj = new stdClass();
            $obj->tablet = 768;
            $obj->{'tablet-portrait'} = 768;
            $obj->phone = 480;
            $obj->{'phone-portrait'} = 480;
            $obj->menuBreakpoint = 768;
            self::siteRules($obj);
        }
        self::$website = $website;
        self::$dateFormat = $website->date_format;
        self::$menuBreakpoint = $obj->menuBreakpoint;
        unset($obj->menuBreakpoint);
        self::$breakpoints = $obj;
    }

    public static function checkResponsive()
    {
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/responsive.css';
        if (!JFile::exists($file)) {
            $empty = new stdClass();
            $obj = self::object_extend($empty, self::$breakpoints);
            $obj->menuBreakpoint = self::$menuBreakpoint;
            self::siteRules($obj);
        }
    }

    public static function setMediaRules($obj, $key, $callback)
    {
        $empty = new stdClass();
        $desktop = self::object_extend($empty, $obj->desktop);
        $type = 'theme';
        if (isset($obj->type)) {
            $type = $obj->type;
        }
        $str = '';
        if ((bool)self::$website->disable_responsive) {
            return $str;
        }
        foreach (self::$breakpoints as $ind => $value) {
            if (!isset($obj->{$ind})) {
                $obj->{$ind} = new stdClass();
            }
            $object = self::object_extend($desktop, $obj->{$ind});
            $str .= "@media (max-width: ".$value."px) {";
            $str .= call_user_func(array('gridboxHelper', $callback), $object, $key, $type);
            $str .= "}";
            $desktop = self::object_extend($empty, $object);
        }
        
        return $str;
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

    public static function getAlias($alias, $table, $name = 'page_alias', $id = 0)
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
            ->where($db->quoteName($name).' = '.$db->quote($alias))
            ->where('`id` <> ' .$db->quote($id));
        $db->setQuery($query);
        $id = $db->loadResult();
        if (!empty($id)) {
            $alias = JString::increment($alias);
            $alias = self::getAlias($alias, $table, $name);
        }
        return $alias;
    }

    public static function sectionRules($obj, $up = '../../../../')
    {

        $str = '';
        self::$up = $up;
        foreach ($obj as $key => $value) {
            $str .= self::getPageCSS($value, $key);
        }
        return $str;
    }

    public static function presetsCompatibility($obj)
    {
        if ((empty($obj->type) || $obj->type == 'side-navigation-menu') && isset($obj->hamburger)) {
            $obj->layout->type = $obj->type;
            $obj->type = 'one-page';
        }
        switch ($obj->type) {
            case 'overlay-section':
            case 'lightbox':
            case 'cookies':
            case 'mega-menu-section':
            case 'row':
            case 'section':
            case 'footer':
            case 'header':
            case 'column':
                if (!isset($obj->desktop->full)) {
                    $obj->desktop->full = new stdClass();
                    $obj->desktop->full->fullscreen = $obj->desktop->fullscreen == '1';
                    if (isset($obj->{'max-width'})) {
                        $obj->desktop->full->fullwidth = $obj->{'max-width'} == '100%';
                    }
                    $obj->desktop->image = new stdClass();
                    $obj->desktop->image->image = $obj->desktop->background->image->image;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            if (isset($obj->{$ind}->fullscreen)) {
                                $obj->{$ind}->full = new stdClass();
                                $obj->{$ind}->full->fullscreen = $obj->{$ind}->fullscreen == '1';
                            }
                        }
                        if (isset($obj->{$ind}->background) && isset($obj->{$ind}->background->image)
                            && isset($obj->{$ind}->background->image->image)) {
                            $obj->{$ind}->image = new stdClass();
                            $obj->{$ind}->image->image = $obj->{$ind}->background->image->image;
                        }
                    }
                    if ($obj->type == 'column') {
                        foreach (self::$breakpoints as $ind => $value) {
                            if (isset($obj->{$ind}) && isset($obj->{$ind}->{'column-width'})) {
                                $obj->{$ind}->span = new stdClass();
                                $obj->{$ind}->span->width = $obj->{$ind}->{'column-width'};
                            }
                        }
                    } else if ($obj->type == 'row') {
                        $obj->desktop->view = new stdClass();
                        $obj->desktop->view->gutter = $obj->desktop->gutter == '1';
                        foreach (self::$breakpoints as $ind => $value) {
                            if (isset($obj->{$ind}) && isset($obj->{$ind}->gutter)) {
                                $obj->{$ind}->view = new stdClass();
                                $obj->{$ind}->view->gutter = $obj->{$ind}->gutter == '1';
                            }
                        }
                    } else if ($obj->type == 'overlay-section' || $obj->type == 'lightbox' || $obj->type == 'cookies') {
                        $obj->lightbox = new stdClass();
                        if (isset($obj->layout) && isset($obj->position)) {
                            $obj->lightbox->layout = $obj->layout;
                            $obj->lightbox->position = $obj->position;
                        } else if (isset($obj->layout)) {
                            $obj->lightbox->layout = $obj->layout;
                        } else if (isset($obj->position)) {
                            $obj->lightbox->layout = $obj->position;
                        }
                        if (isset($obj->{'background-overlay'})) {
                            $obj->lightbox->background = $obj->{'background-overlay'};
                        }
                        $obj->desktop->view = new stdClass();
                        $obj->desktop->view->width = $obj->desktop->width;
                        if (isset($obj->desktop->height)) {
                            $obj->desktop->view->height = $obj->desktop->height;
                        }
                        foreach (self::$breakpoints as $ind => $value) {
                            if (isset($obj->{$ind})) {
                                $obj->{$ind}->view = new stdClass();
                                if (isset($obj->{$ind}->width)) {
                                    $obj->{$ind}->view->width = $obj->{$ind}->width;
                                }
                                if (isset($obj->{$ind}->height)) {
                                    $obj->{$ind}->view->height = $obj->{$ind}->height;
                                }
                            }
                        }
                    } else if ($obj->type == 'mega-menu-section') {
                        $obj->view = new stdClass();
                        $obj->view->width = $obj->width;
                        $obj->view->position = $obj->position;
                    }
                }
                break;
            case 'button':
            case 'overlay-button':
            case 'scroll-to':
            case 'scroll-to-top':
                if (!isset($obj->desktop->icons)) {
                    $obj->desktop->icons = new stdClass();
                    $obj->desktop->icons->size = $obj->desktop->size;
                    if ($obj->type == 'scroll-to') {
                        $obj->desktop->icons->align = 'center';
                    }
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind}) && isset($obj->{$ind}->size)) {
                            $obj->{$ind}->icons = new stdClass();
                            $obj->{$ind}->icons->size = $obj->{$ind}->size;
                        }
                    }
                }
                if ($obj->type == 'scroll-to-top' && !isset($obj->text)) {
                    $obj->text =  new stdClass();
                    $obj->text->align = $obj->{"scrolltop-align"};
                }
                if ($obj->type == 'scroll-to' && !isset($obj->desktop->typography)) {
                    $obj->desktop->icons->position = 'after';
                    $typography = '{"font-family":"@default","font-size":10,"font-style":"normal","font-weight":"700",';
                    $typography .= '"letter-spacing":4,"line-height":26,"text-align":"center","text-decoration":"none",';
                    $typography .= '"text-transform":"uppercase"}';
                    $obj->desktop->typography = json_decode($typography);
                    $obj->desktop->typography->{"text-align"} = $obj->desktop->icons->align;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind}) && isset($obj->{$ind}->icons) && isset($obj->{$ind}->align)) {
                            $obj->{$ind}->typography = new stdClass();
                            $obj->{$ind}->typography->{"text-align"} = $obj->{$ind}->icons->align;
                        }
                    }
                }
            case 'scroll-to':
            case 'scroll-to-top':
            case 'tags':
            case 'post-tags':
            case 'icon':
            case 'social-icons':
                if (!isset($obj->desktop->normal)) {
                    $obj->desktop->normal = new stdClass();
                    $obj->desktop->normal->color = $obj->desktop->color;
                    $obj->desktop->normal->{'background-color'} = $obj->desktop->{'background-color'};
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            if (isset($obj->{$ind}->color) || isset($obj->{$ind}->{'background-color'})) {
                                $obj->{$ind}->normal = new stdClass();
                                if (isset($obj->{$ind}->color)) {
                                    $obj->{$ind}->normal->color = $obj->{$ind}->color;
                                }
                                if (isset($obj->{$ind}->{'background-color'})) {
                                    $obj->{$ind}->normal->{'background-color'} = $obj->{$ind}->{'background-color'};
                                }
                            }
                        }
                    }
                }
                break;
            case 'counter':
            case 'countdown':
                if (!isset($obj->desktop->background)) {
                    $obj->desktop->background = new stdClass();
                    $obj->desktop->background->color = $obj->desktop->color;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind}) && isset($obj->{$ind}->color)) {
                            $obj->{$ind}->background = new stdClass();
                            $obj->{$ind}->background->color = $obj->{$ind}->color;
                        }
                    }
                }
                break;
            case 'categories':
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->view->counter = $obj->desktop->counter;
                    $obj->desktop->view->sub = $obj->desktop->sub;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->counter)) {
                                $obj->{$ind}->view->counter = $obj->{$ind}->counter;
                            }
                            if (isset($obj->{$ind}->sub)) {
                                $obj->{$ind}->view->sub = $obj->{$ind}->sub;
                            }
                        }
                    }
                }
                break;
            case 'carousel':
            case 'slideset':
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->gutter = ($obj->gutter != '');
                    $obj->desktop->view->height = $obj->desktop->height;
                    $obj->desktop->view->size = $obj->desktop->size;
                    $obj->desktop->view->dots = $obj->desktop->dots->enable;
                    $obj->desktop->view->arrows = $obj->desktop->arrows->enable;
                    $obj->desktop->overlay =  new stdClass();
                    $obj->desktop->overlay->color = $obj->desktop->caption->color;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->overflow)) {
                                $obj->{$ind}->view->overflow = $obj->{$ind}->overflow;
                            }
                            if (isset($obj->{$ind}->height)) {
                                $obj->{$ind}->view->height = $obj->{$ind}->height;
                            }
                            if (isset($obj->{$ind}->size)) {
                                $obj->{$ind}->view->size = $obj->{$ind}->size;
                            }
                        }
                    }
                }
                break;
            case 'slideshow':
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->view->fullscreen = $obj->desktop->fullscreen;
                    $obj->desktop->view->height = $obj->desktop->height;
                    $obj->desktop->view->size = $obj->desktop->size;
                    $obj->desktop->view->dots = $obj->desktop->dots->enable;
                    $obj->desktop->view->arrows = $obj->desktop->arrows->enable;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->fullscreen)) {
                                $obj->{$ind}->view->fullscreen = $obj->{$ind}->fullscreen;
                            }
                            if (isset($obj->{$ind}->height)) {
                                $obj->{$ind}->view->height = $obj->{$ind}->height;
                            }
                            if (isset($obj->{$ind}->size)) {
                                $obj->{$ind}->view->size = $obj->{$ind}->size;
                            }
                        }
                    }
                }
                break;
            case 'accordion':
                if (!isset($obj->desktop->icon)) {
                    $obj->desktop->icon = new stdClass();
                    $obj->desktop->icon->position = $obj->{'icon-position'};
                    $obj->desktop->icon->size = $obj->desktop->size;
                    $color = $obj->desktop->background;
                    $obj->desktop->background = new stdClass();
                    $obj->desktop->background->color = $color;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            if (isset($obj->{$ind}->size)) {
                                $obj->{$ind}->icon = new stdClass();
                                $obj->{$ind}->icon->size = $obj->{$ind}->size;
                            }
                            if (isset($obj->{$ind}->background)) {
                                $color = $obj->{$ind}->background;
                                $obj->{$ind}->background = new stdClass();
                                $obj->{$ind}->background->color = $color;
                            }
                        }
                    }
                }
                break;
            case 'tabs':
                if (!isset($obj->desktop->icon)) {
                    $obj->desktop->icon = new stdClass();
                    $obj->desktop->icon->position = $obj->{'icon-position'};
                    $obj->desktop->icon->size = $obj->desktop->size;
                    $color = $obj->desktop->background;
                    $obj->desktop->background = new  stdClass();
                    $obj->desktop->background->color = $color;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            if (isset($obj->{$ind}->size)) {
                                $obj->{$ind}->icon = new stdClass();
                                $obj->{$ind}->icon->size = $obj->{$ind}->size;
                            }
                            if (isset($obj->{$ind}->background)) {
                                $color = $obj->{$ind}->background;
                                $obj->{$ind}->background = new stdClass();
                                $obj->{$ind}->background->color = $color;
                            }
                        }
                    }
                }
                break;
            case 'image':
                if (!isset($obj->desktop->style)) {
                    if (!isset($obj->desktop->width)) {
                        $obj->desktop->width = $obj->width;
                    }
                    $obj->popup = (bool)($obj->lightbox->enable * 1);
                    $obj->desktop->style = new stdClass();
                    $obj->desktop->style->width = $obj->desktop->width;
                    $obj->desktop->style->align = $obj->align;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->style = new stdClass();
                            if (isset($obj->{$ind}->width)) {
                                $obj->{$ind}->style->width = $obj->{$ind}->width;
                            }
                        }
                    }
                }
                break;
            case 'simple-gallery':
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->view->height = $obj->desktop->height;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->count)) {
                                $obj->{$ind}->view->count = $obj->{$ind}->count;
                            }
                            if (isset($obj->{$ind}->height)) {
                                $obj->{$ind}->view->height = $obj->{$ind}->height;
                            }
                            if (isset($obj->{$ind}->gutter)) {
                                $obj->{$ind}->view->gutter = $obj->{$ind}->gutter;
                            }
                        }
                    }
                }
                break;
            case 'weather':
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->view->layout = $obj->layout;
                    $obj->desktop->view->layout = $obj->desktop->forecast;
                    $obj->desktop->view->layout = $obj->desktop->wind;
                    $obj->desktop->view->layout = $obj->desktop->humidity;
                    $obj->desktop->view->layout = $obj->desktop->pressure;
                    $obj->desktop->view->layout = $obj->desktop->{'sunrise-wrapper'};
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->forecast)) {
                                $obj->{$ind}->view->forecast = $obj->{$ind}->forecast;
                            }
                            if (isset($obj->{$ind}->wind)) {
                                $obj->{$ind}->view->forecast = $obj->{$ind}->wind;
                            }
                            if (isset($obj->{$ind}->humidity)) {
                                $obj->{$ind}->view->humidityhumidity = $obj->{$ind}->humidity;
                            }
                            if (isset($obj->{$ind}->pressure)) {
                                $obj->{$ind}->view->pressure = $obj->{$ind}->pressure;
                            }
                            if (isset($obj->{$ind}->{'sunrise-wrapper'})) {
                                $obj->{$ind}->view->{'sunrise-wrapper'} = $obj->{$ind}->{'sunrise-wrapper'};
                            }
                        }
                    }
                }
                break;
            case "menu":
                if (!isset($obj->desktop->nav)) {
                    $nav ='{"padding":{"bottom":"15","left":"15","right":"15","top":"15"},"margin":{"left":"0","right":"0"}';
                    $nav .= ',"icon":{"size":24},"border":{"bottom":"0","left":"0","right":"0","top":"0","color":"#000000",';
                    $nav .= '"style":"solid","radius":"0","width":"0"},"normal":{"color":"color","background":"rgba(0,0,0,';
                    $nav .= '0)"},"hover":{"color":"color","background":"rgba(0,0,0,0)"}}';
                    $obj->desktop->nav = json_decode($nav);
                    $obj->desktop->nav->normal->color = $obj->desktop->{'nav-typography'}->color;
                    $obj->desktop->nav->hover->color = $obj->desktop->{'nav-hover'}->color;
                    $sub = '{"padding":{"bottom":"10","left":"20","right":"20","top":"10"},"icon":{"size":24},"border":{';
                    $sub .= '"bottom":"0","left":"0","right":"0","top":"0","color":"#000000","style":"solid","radius":"0",';
                    $sub .= '"width":"0"},"normal":{"color":"color","background":"rgba(0,0,0,0)"},"hover":{"color":"color",';
                    $sub .= '"background":"rgba(0,0,0,0)"}}';
                    $obj->desktop->sub = json_decode($sub);
                    $obj->desktop->sub->normal->color = $obj->desktop->{'sub-typography'}->color;
                    $obj->desktop->sub->hover->color = $obj->desktop->{'sub-hover'}->color;
                    $dropdown = '{"width":250,"animation":{"effect":"fadeInUp","duration":"0.2"},"padding":{"bottom":"10",';
                    $dropdown .= '"left":"0","right":"0","top":"10"}}';
                    $obj->desktop->dropdown = json_decode($dropdown);
                }
                if (!isset($obj->desktop->background)) {
                    $obj->desktop->background = new stdClass();
                    $obj->desktop->background->color = $obj->desktop->{'background-color'};
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind}) && isset($obj->{$ind}->{'background-color'})) {
                            $obj->{$ind}->background = new stdClass();
                            $obj->{$ind}->background->color = $obj->{$ind}->{'background-color'};
                        }
                    }
                    $layout = $obj->layout;
                    $obj->layout = new stdClass();
                    $obj->layout->layout = $layout;
                }
                break;
            case "one-page":
                if (!isset($obj->desktop->nav)) {
                    $nav ='{"padding":{"bottom":"15","left":"15","right":"15","top":"15"},"margin":{"left":"0","right":"0"}';
                    $nav .= ',"icon":{"size":24},"border":{"bottom":"0","left":"0","right":"0","top":"0","color":"#000000",';
                    $nav .= '"style":"solid","radius":"0","width":"0"},"normal":{"color":"color","background":"rgba(0,0,0,';
                    $nav .= '0)"},"hover":{"color":"color","background":"rgba(0,0,0,0)"}}';
                    $obj->desktop->nav = json_decode($nav);
                    $obj->desktop->nav->normal->color = $obj->desktop->{'nav-typography'}->color;
                    $obj->desktop->nav->hover->color = $obj->desktop->{'nav-hover'}->color;
                }
                if (gettype($obj->layout) == 'string') {
                    $layout = $obj->layout;
                    $obj->layout = new stdClass();
                    $obj->layout->layout = $layout;
                    $obj->layout->type = $obj->{'menu-type'};
                }
                break;
            case 'social':
                if (!isset($obj->view)) {
                    $obj->view = new stdClass();
                    $obj->view->layout = $obj->layout;
                    $obj->view->size = $obj->size;
                    $obj->view->style = $obj->style;
                    $obj->view->counters = $obj->counters;
                }
                break;
            case 'recent-posts':
            case 'search-result':
            case 'post-navigation':
            case 'related-posts':
            case 'blog-posts':
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->view->count = $obj->desktop->count;
                    $obj->desktop->view->gutter = $obj->desktop->gutter;
                    if ($obj->type == 'blog-posts' && !isset($obj->desktop->image->show)) {
                        $obj->desktop->image->show = $obj->desktop->title->show = $obj->desktop->date = true;
                        $obj->desktop->category = $obj->desktop->intro->show = $obj->desktop->button->show = true;
                        $obj->desktop->hits = true;
                    } else if ($obj->type != 'blog-posts') {
                        $obj->desktop->hits = false;
                    }
                    $obj->desktop->view->image = $obj->desktop->image->show;
                    $obj->desktop->view->title = $obj->desktop->title->show;
                    $obj->desktop->view->intro = $obj->desktop->intro->show;
                    $obj->desktop->view->button = $obj->desktop->button->show;
                    $obj->desktop->view->date = $obj->desktop->date;
                    $obj->desktop->view->category = $obj->desktop->category;
                    $obj->desktop->view->hits = $obj->desktop->hits;
                    $color = $obj->desktop->overlay;
                    $obj->desktop->overlay = new stdClass();
                    $obj->desktop->overlay->color = $color;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->count)) {
                                $obj->{$ind}->view->count = $obj->{$ind}->count;
                            }
                            if (isset($obj->{$ind}->gutter)) {
                                $obj->{$ind}->view->gutter = $obj->{$ind}->gutter;
                            }
                            if (isset($obj->{$ind}->date)) {
                                $obj->{$ind}->view->date = $obj->{$ind}->date;
                            }
                            if (isset($obj->{$ind}->category)) {
                                $obj->{$ind}->view->category = $obj->{$ind}->category;
                            }
                            if (isset($obj->{$ind}->hits)) {
                                $obj->{$ind}->view->hits = $obj->{$ind}->hits;
                            }
                            if (isset($obj->{$ind}->image) && isset($obj->{$ind}->image->show)) {
                                $obj->{$ind}->view->image = $obj->{$ind}->image->show;
                            }
                            if (isset($obj->{$ind}->title) && isset($obj->{$ind}->title->show)) {
                                $obj->{$ind}->view->title = $obj->{$ind}->title->show;
                            }
                            if (isset($obj->{$ind}->intro) && isset($obj->{$ind}->intro->show)) {
                                $obj->{$ind}->view->intro = $obj->{$ind}->intro->show;
                            }
                            if (isset($obj->{$ind}->button) && isset($obj->{$ind}->button->show)) {
                                $obj->{$ind}->view->button = $obj->{$ind}->button->show;
                            }
                        }
                    }
                    $layout = $obj->layout;
                    $obj->layout = new stdClass();
                    $obj->layout->layout = $layout;
                }
                break;
            case 'search':
                if (!isset($obj->desktop->icons)) {
                    $obj->desktop->icons = new stdClass();
                    $obj->desktop->icons->size = $obj->desktop->size;
                    $obj->desktop->icons->position = $obj->icon->position;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->icons = new stdClass();
                            if (isset($obj->{$ind}->size)) {
                                $obj->{$ind}->icons->size = $obj->{$ind}->size;
                            }
                        }
                    }
                }
                break;
            case 'category-intro':
            case 'post-intro':
                if (!isset($obj->desktop->info->hover)) {
                    $obj->desktop->info->hover = new stdClass();
                    $obj->desktop->info->hover->color = '#fc5859';
                }
                if (!isset($obj->desktop->image->show)) {
                    $obj->desktop->image->show = $obj->desktop->title->show = true;
                    $obj->desktop->date = $obj->desktop->category = $obj->desktop->hits = true;
                }
                if (!isset($obj->desktop->view)) {
                    $obj->desktop->view = new stdClass();
                    $obj->desktop->view->date = $obj->desktop->date;
                    $obj->desktop->view->category = $obj->desktop->category;
                    $obj->desktop->view->hits = $obj->desktop->hits;
                    $layout = $obj->layout;
                    $obj->layout = new stdClass();
                    $obj->layout->layout = $layout;
                    foreach (self::$breakpoints as $ind => $value) {
                        if (isset($obj->{$ind})) {
                            $obj->{$ind}->view = new stdClass();
                            if (isset($obj->{$ind}->date)) {
                                $obj->{$ind}->view->date = $obj->{$ind}->date;
                            }
                            if (isset($obj->{$ind}->category)) {
                                $obj->{$ind}->view->category = $obj->{$ind}->category;
                            }
                            if (isset($obj->{$ind}->hits)) {
                                $obj->{$ind}->view->hits = $obj->{$ind}->hits;
                            }
                        }
                    }
                }
                break;
        }
        if ($obj->type == 'icon' || $obj->type == 'social-icons') {
            if (!isset($obj->desktop->icon)) {
                $obj->desktop->icon = new stdClass();
                $obj->desktop->icon->size = $obj->desktop->size;
                $obj->desktop->icon->{'text-align'} = $obj->desktop->{'text-align'};
                foreach (self::$breakpoints as $ind => $value) {
                    if (isset($obj->{$ind})) {
                        $obj->{$ind}->icon = new stdClass();
                        if (isset($obj->{$ind}->size)) {
                            $obj->{$ind}->icon->size = $obj->{$ind}->size;
                        }
                        if (isset($obj->{$ind}->{'text-align'})) {
                            $obj->{$ind}->icon->{'text-align'} = $obj->{$ind}->{'text-align'};
                        }
                    }
                }
            }
        }
    }

    public static function getPageCSS($obj, $key)
    {
        self::$editItem = $obj;
        self::presetsCompatibility($obj);
        self::comparePresets($obj);
        switch ($obj->type) {
            case 'star-ratings' :
                $str = self::createStarRatingsRules($obj, $key);
                break;
            case 'blog-posts' :
            case 'search-result' :
            case 'recent-posts' :
            case 'related-posts' :
            case 'post-navigation' :
                $str = self::createBlogPostsRules($obj, $key);
                break;
            case 'post-intro':
            case 'category-intro':
                $str = self::createPostIntroRules($obj, $key);
                break;
            case 'blog-content' :
                $str = '';
                break;
            case 'search':
                $str = self::createSearchRules($obj, $key);
                break;
            case 'logo' :
                $str = self::createLogoRules($obj, $key);
                break;
            case 'slideshow' :
                $str = self::createSlideshowRules($obj, $key);
                break;
            case 'carousel' :
            case 'slideset' :
                $str = self::createCarouselRules($obj, $key);
                break;
            case 'recent-posts-slider':
                $str = self::createRecentSliderRules($obj, $key);
                break;
            case 'menu' :
                $str = self::createMenuRules($obj, $key);
                break;
            case 'one-page' :
                $str = self::createOnePageRules($obj, $key);
                break;
            case 'map' :
                $str = self::createMapRules($obj, $key);
                break;
            case 'weather' :
                $str = self::createWeatherRules($obj, $key);
                break;
            case 'scroll-to-top' :
                $str = self::createScrollTopRules($obj, $key);
                break;
            case 'image' :
                $str = self::createImageRules($obj, $key);
                break;
            case 'video' :
                $str = self::createVideoRules($obj, $key);
                break;
            case 'tabs' :
                $str = self::createTabsRules($obj, $key);
                break;
            case 'accordion' :
                $str = self::createAccordionRules($obj, $key);
                break;
            case 'icon' :
            case 'social-icons' :
                $str = self::createIconRules($obj, $key);
                break;
            case 'button' :
            case 'tags' :
            case 'post-tags' :
            case 'overlay-button' :
            case 'scroll-to' :
                $str = self::createButtonRules($obj, $key);
                break;
            case 'countdown' :
                $str = self::createCountdownRules($obj, $key);
                break;
            case 'counter' :
                $str = self::createCounterRules($obj, $key);
                break;
            case 'text':
            case 'headline':
                $str = self::createTextRules($obj, $key);
                break;
            case 'progress-bar' :
                $str = self::createProgressBarRules($obj, $key);
                break;
            case 'progress-pie' :
                $str = self::createProgressPieRules($obj, $key);
                break;
            case 'social' :
                $str = self::createSocialRules($obj, $key);
                break;
            case 'disqus' :
            case 'vk-comments' :
            case 'facebook-comments' :
            case 'hypercomments' :
            case 'modules' :
            case 'custom-html' :
            case 'gallery' :
            case 'forms' :
                $str = self::createModulesRules($obj, $key);
                break;
            case 'instagram':
            case 'simple-gallery':
                $str = self::createInstagramRules($obj, $key);
            break;
            case 'categories' :
                $str = self::createCategoriesRules($obj, $key);
            break;
            case 'mega-menu-section' :
                $str = self::createMegaMenuSectionRules($obj, $key);
                break;
            case 'flipbox' :
                $str = self::createFlipboxRules($obj, $key);
                break;
            case 'error-message' :
                $str = self::createErrorRules($obj, $key);
                break;
            default :
                $str = self::createSectionRules($obj, $key);
        }
        
        return $str;
    }

    public static function setItemsVisability($disable, $display)
    {
        if ($disable == 1) {
            $str = "display : none;";
        } else {
            $str = "display : ".$display.";";
        }

        return $str;
    }

    public static function setBoxModel($obj, $selector)
    {
        $str = '';
        if (isset($obj->margin) && isset($obj->margin->top)) {
            $str .= "#".$selector." > .ba-box-model:before {";
            $str .= "height: ".$obj->margin->top."px;";
            if (isset($obj->border) && isset($obj->border->width)) {
                if ((isset($obj->border->top) && $obj->border->top == 1) || !isset($obj->border->top)) {
                    $str .= "top: -".$obj->border->width."px;";
                } else {
                    $str .= "top: 0;";
                }
            }
            $str .= "}";
            $str .= "#".$selector." > .ba-box-model:after {";
            $str .= "height: ".$obj->margin->bottom."px;";
            if (isset($obj->border) && isset($obj->border->width)) {
                if ((isset($obj->border->bottom) && $obj->border->bottom == 1) || !isset($obj->border->bottom)) {
                    $str .= "bottom: -".$obj->border->width."px;";
                } else {
                    $str .= "bottom: 0;";
                }
            }
            $str .= "}";
        }
        if (isset($obj->padding)) {
            foreach ($obj->padding as $key => $value) {
                $str .= "#".$selector." > .ba-box-model .ba-bm-".$key." {";
                $str .= "width: ".$value."px; height: ".$value."px;}";
            }
        }

        return $str;
    }

    public static function createOnePageRules($obj, $key)
    {
        $str = self::getOnePageRules($obj->desktop, $key);
        $str .= "#".$key." .main-menu li a:hover {";
        $str .= "color : ".self::getCorrectColor($obj->desktop->nav->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->desktop->nav->hover->background).";";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getOnePageRules');
        if (!(bool)self::$website->disable_responsive) {
            $str .= "@media (max-width: ".self::$menuBreakpoint."px) {";
            $str .= "#".$key." .ba-hamburger-menu .main-menu {";
            $str .= "background-color : ".self::getCorrectColor($obj->hamburger->background).";";
            $str .= "}";
            $str .= "#".$key." .ba-hamburger-menu .open-menu {";
            $str .= "color : ".self::getCorrectColor($obj->hamburger->open).";";
            $str .= "text-align : ".$obj->hamburger->{'open-align'}.";";
            $str .= "}";
            $str .= "#".$key." .ba-hamburger-menu .close-menu {";
            $str .= "color : ".self::getCorrectColor($obj->hamburger->close).";";
            $str .= "text-align : ".$obj->hamburger->{'close-align'}.";";
            $str .= "}";
            $str .= "}";
        }

        return $str;
    }

    public static function createCategoriesRules($obj, $key)
    {
        $str = self::getCategoriesRules($obj->desktop, $key);
        $str .= "#".$key." li a:hover {";
        $str .= "color : ".self::getCorrectColor($obj->desktop->{'nav-hover'}->color).";";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getCategoriesRules');

        return $str;
    }

    public static function createMenuRules($obj, $key)
    {
        $str = self::getMenuRules($obj->desktop, $key);
        $str .= "#".$key." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a:hover,#";
        $str .= $key." .main-menu li > span:hover {";
        $str .= "color : ".self::getCorrectColor($obj->desktop->nav->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->desktop->nav->hover->background).";";
        $str .= "}";
        $str .= "#".$key." .main-menu .nav-child li a:hover,#".$key." .main-menu .nav-child li span:hover {";
        $str .= "color : ".self::getCorrectColor($obj->desktop->sub->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->desktop->sub->hover->background).";";
        $str .= "}";
        $str .= "#".$key." ul.nav-child {";
        $str .= "width: ".$obj->desktop->dropdown->width."px;";
        $str .= "background-color : ".self::getCorrectColor($obj->desktop->background->color).";";
        $str .= "box-shadow: 0 ".($obj->desktop->shadow->value * 10);
        $str .= "px ".($obj->desktop->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->desktop->shadow->color).";";
        $str .= "animation-duration: ".$obj->desktop->dropdown->animation->duration."s;";
        $str .= "}";
        $str .= "#".$key." li.megamenu-item > .tabs-content-wrapper > .ba-section {";
        $str .= "box-shadow: 0 ".($obj->desktop->shadow->value * 10);
        $str .= "px ".($obj->desktop->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->desktop->shadow->color).";";
        $str .= "animation-duration: ".$obj->desktop->dropdown->animation->duration."s;";
        $str .= "}";
        $str .= "#".$key." .nav-child > .deeper:hover > .nav-child {";
        $str .= "top : -".$obj->desktop->dropdown->padding->top."px;";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getMenuRules');
        if (!(bool)self::$website->disable_responsive) {
            $str .= "@media (max-width: ".self::$menuBreakpoint."px) {";
            $str .= "#".$key." .ba-hamburger-menu .main-menu {";
            $str .= "background-color : ".self::getCorrectColor($obj->hamburger->background).";";
            $str .= "}";
            $str .= "#".$key." .ba-hamburger-menu .open-menu {";
            $str .= "color : ".self::getCorrectColor($obj->hamburger->open).";";
            $str .= "text-align : ".$obj->hamburger->{'open-align'}.";";
            $str .= "}";
            $str .= "#".$key." .ba-hamburger-menu .close-menu {";
            $str .= "color : ".self::getCorrectColor($obj->hamburger->close).";";
            $str .= "text-align : ".$obj->hamburger->{'close-align'}.";";
            $str .= "}";
            $str .= "}";
        }

        return $str;
    }

    public static function createLogoRules($obj, $key)
    {
        $str = self::getLogoRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getLogoRules');

        return $str;
    }

    public static function createWeatherRules($obj, $key)
    {
        $str = self::getWeatherRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getWeatherRules');

        return $str;
    }

    public static function createScrollTopRules($obj, $key)
    {
        $str = self::getScrollTopRules($obj->desktop, $key);
        $str .= "#".$key." i.ba-btn-transition:hover {";
        $str .= "color : ".self::getCorrectColor($obj->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->hover->{'background-color'}).";";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getScrollTopRules');

        return $str;
    }

    public static function createCarouselRules($obj, $key)
    {
        $str = self::getCarouselRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getCarouselRules');

        return $str;
    }

    public static function createRecentSliderRules($obj, $key)
    {
        $str = self::getRecentSliderRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getRecentSliderRules');

        return $str;
    }

    public static function createSlideshowRules($obj, $key)
    {
        $str = self::getSlideshowRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getSlideshowRules');

        return $str;
    }

    public static function createAccordionRules($obj, $key)
    {
        $str = self::getAccordionRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getAccordionRules');

        return $str;
    }

    public static function createTabsRules($obj, $key)
    {
        $str = self::getTabsRules($obj->desktop, $key);
        $str .= "#".$key." ul.nav.nav-tabs li a:hover {";
        $str .= "color : ".self::getCorrectColor($obj->desktop->hover->color).";";
        $str .= "}";
        if ($obj->desktop->icon->position == 'icon-position-left') {
            $str .= '#'.$key.' .ba-tabs-wrapper li a > span {direction: rtl;display: inline-flex;display: -webkit-inline-flex;';
            $str .= 'flex-direction: row;-webkit-flex-direction: row;}';
            $str .= '#'.$key.' .ba-tabs-wrapper li a > span i {margin-bottom:0;}';
        } else if ($obj->desktop->icon->position == 'icon-position-top') {
            $str .= '#'.$key.' .ba-tabs-wrapper li a > span {display: inline-flex;display: -webkit-inline-flex;';
            $str .= 'flex-direction: column-reverse;-webkit-flex-direction: column-reverse;}';
            $str .= '#'.$key.' .ba-tabs-wrapper li a > span i {margin-bottom:10px;}';
        } else {
            $str .= '#'.$key.' .ba-tabs-wrapper li a > span {direction: ltr;display: inline-flex;display: -webkit-inline-flex;';
            $str .= 'flex-direction: row;-webkit-flex-direction: row;}';
            $str .= '#'.$key.' .ba-tabs-wrapper li a > span i {margin-bottom:0;}';
        }
        $str .= self::setMediaRules($obj, $key, 'getTabsRules');

        return $str;
    }

    public static function createMapRules($obj, $key)
    {
        $str = self::getMapRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getMapRules');

        return $str;
    }

    public static function createCounterRules($obj, $key)
    {
        $str = self::getCounterRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getCounterRules');

        return $str;
    }

    public static function createSearchRules($obj, $key)
    {
        $str = self::getSearchRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getSearchRules');

        return $str;
    }

    public static function createCountdownRules($obj, $key)
    {
        $str = self::getCountdownRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getCountdownRules');

        return $str;
    }

    public static function createButtonRules($obj, $key)
    {
        $str = self::getButtonRules($obj->desktop, $key);
        $str .= "#".$key." .ba-button-wrapper a:hover {";
        $str .= "color : ".self::getCorrectColor($obj->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->hover->{'background-color'}).";";
        $str .= "}";
        if (isset($obj->icon) && is_object($obj->icon)) {
            $str .= "#".$key." .ba-button-wrapper a {";
            if ($obj->icon->position == '') {
                $str .= 'flex-direction: row-reverse; -webkit-flex-direction: row-reverse;';
            } else {
                $str .= 'flex-direction: row; -webkit-flex-direction: row;';
            }
            $str .= "}";
            $str .= "#".$key." .ba-button-wrapper a i {";
            if ($obj->icon->position == '') {
                $str .= 'margin: 0 10px 0 0;';
            } else {
                $str .= 'margin: 0 0 0 10px;';
            }
            $str .= "}";
        }
        $str .= self::setMediaRules($obj, $key, 'getButtonRules');

        return $str;
    }

    public static function createBlogPostsRules($obj, $key)
    {
        $str = self::getBlogPostsRules($obj->desktop, $key, $obj->type);
        $str .= "#".$key." .ba-blog-post-title a:hover {";
        $str .= "color: ".self::getCorrectColor($obj->desktop->title->hover->color).";";
        $str .= "}";
        $str .= "#".$key." .ba-blog-post-info-wrapper > span a:hover {";
        $str .= "color: ".self::getCorrectColor($obj->desktop->info->hover->color).";";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getBlogPostsRules');

        return $str;
    }

    public static function createPostIntroRules($obj, $key)
    {
        $str = self::getPostIntroRules($obj->desktop, $key);
        $str .= "#".$key." .intro-post-wrapper .intro-post-info > span a:hover {";
        $str .= "color: ".self::getCorrectColor($obj->desktop->info->hover->color).";";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getPostIntroRules');

        return $str;
    }

    public static function createStarRatingsRules($obj, $key)
    {
        $str = self::getStarRatingsRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getStarRatingsRules');

        return $str;
    }

    public static function createInstagramRules($obj, $key)
    {
        $str = self::getInstagramRules($obj->desktop, $key);
        if ($obj->type == 'simple-gallery' || $obj->popup->enable) {
            $str .= '#'.$key.' .ba-instagram-image a {display: none;} #'.$key.' .ba-instagram-image {';
            $str .= 'cursor: zoom-in;}';
        } else {
            $str .= '#'.$key.' .ba-instagram-image a {display: block;} #'.$key.' .ba-instagram-image {';
            $str .= 'cursor: default;}';
        }
        $str .= self::setMediaRules($obj, $key, 'getInstagramRules');

        return $str;
    }

    public static function createIconRules($obj, $key)
    {
        $str = self::getIconRules($obj->desktop, $key);
        $str .= "#".$key." .ba-icon-wrapper i:hover {";
        $str .= "color : ".self::getCorrectColor($obj->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->hover->{'background-color'}).";";
        $str .= "}";
        $str .= self::setMediaRules($obj, $key, 'getIconRules');

        return $str;
    }

    public static function createProgressBarRules($obj, $key)
    {
        $str = self::getProgressBarRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getProgressBarRules');

        return $str;
    }

    public static function createProgressPieRules($obj, $key)
    {
        $str = self::getProgressPieRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getProgressPieRules');

        return $str;
    }

    public static function createSocialRules($obj, $key)
    {
        $str = self::getModulesRules($obj->desktop, $key);
        $str .= '#'.$key.' .social-counter {display:'.($obj->view->counters ? 'inline-block' : 'none').'}';
        $str .= self::setMediaRules($obj, $key, 'getModulesRules');

        return $str;
    }

    public static function createModulesRules($obj, $key)
    {
        $str = self::getModulesRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getModulesRules');

        return $str;
    }

    public static function createErrorRules($obj, $key)
    {
        $str = self::getErrorRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getErrorRules');

        return $str;

        return $str;
    }

    public static function createTextRules($obj, $key)
    {
        $array = array('h1' ,'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'links');
        if (isset($obj->global) && $obj->global) {
            unset($obj->global);
            foreach ($array as $value) {
                unset($obj->desktop->{$value});
                foreach (self::$breakpoints as $ind => $property) {
                    unset($obj->{$ind}->{$value});
                }
            }
        }
        if (!isset($obj->desktop->p)) {
            foreach ($array as $value) {
            	if ($value == 'links') {
            		continue;
            	}
                $obj->desktop->{$value} = new stdClass();
                foreach (self::$breakpoints as $ind => $property) {
                    if (!isset($obj->{$ind})) {
                        $obj->{$ind} = new stdClass();
                    }
                    $obj->{$ind}->{$value} = new stdClass();
                }
            }
        }
        $str = self::getTextRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getTextRules');

        return $str;
    }

    public static function createImageRules($obj, $key)
    {
        $str = self::getImageRules($obj->desktop, $key);
        if (!empty($obj->link->link)) {
            $str .= '#'.$key.' .ba-image-wrapper img { cursor: pointer; }';
        } else if ($obj->popup) {
            $str .= '#'.$key.' .ba-image-wrapper img { cursor: zoom-in; }';
        } else {
            $str .= '#'.$key.' .ba-image-wrapper img { cursor: default; }';
        }
        $str .= self::setMediaRules($obj, $key, 'getImageRules');

        return $str;
    }

    public static function createVideoRules($obj, $key)
    {
        $str = self::getVideoRules($obj->desktop, $key);
        $str .= self::setMediaRules($obj, $key, 'getVideoRules');

        return $str;
    }

    public static function createHeaderRules($obj, $view)
    {
        $str = "body header.header {";
        $str .= "position:".$obj->position.";";
        $str .= "}";
        $str .= "body.com_gridbox.gridbox header.header {";
        if ($obj->position == 'fixed') {
            if ($view == 'desktop') {
                $str .= "width: calc(100% - 103px);width: -webkit-calc(100% - 103px);";
                $str .= "left: 52px;";
            } else {
                $str .= "width: 100%;";
                $str .= "left: 0;";
            }
            $str .= "top: 40px;";
        } else {
            $str .= "width: 100%;";
            $str .= "left: 0;";
            $str .= "top: 0;";
        }
        if ($obj->position == 'relative') {
            $str .= "z-index: 2;";
        } else {
            $str .= "z-index: 20;";
        }
        $str .= "}";
        if ($obj->position == 'fixed') {
            $str .= ".ba-container .header {margin-left: calc((100vw - 1280px)/2);";
            $str .= "margin-left: -webkit-calc((100vw - 1280px)/2);max-width: 1170px;}";
        } else {
            $str .= ".ba-container .header {margin-left:0;max-width: none;}";
        }

        return $str;
    }

    public static function createMegaMenuSectionRules($obj, $key)
    {
        $str = self::createMegaMenuRules($obj->desktop, $key);
        if (isset($obj->parallax)) {
            $pHeight = 100 + $obj->parallax->offset * 2 * 200;
            $pTop = $obj->parallax->offset * 2 * -100;
            $str .= "#".$key." > .parallax-wrapper.scroll .parallax {";
            $str .= "height: ".$pHeight."%;";
            $str .= "top: ".$pTop."%;";
            $str .= "}";
        }
        $str .= "#".$key." { width: ".$obj->view->width."px; }";
        $str .= self::setMediaRules($obj, $key, 'createMegaMenuRules');
        
        return $str;
    }

    public static function setFlipboxSide($obj, $side)
    {
        $array = array('background', 'overlay', 'image', 'video');
        $obj->parallax = $obj->sides->{$side}->parallax;
        for ($i = 0; $i < count($array); $i++) {
            $obj->desktop->{$array[$i]} = $obj->sides->{$side}->desktop->{$array[$i]};
        }
        foreach (self::$breakpoints as $ind => $value) {
            if (isset($obj->{$ind})) {
                for ($i = 0; $i < count($array); $i++) {
                    if (isset($obj->sides->{$side}->{$ind}->{$array[$i]})) {
                        $obj->{$ind}->{$array[$i]} = $obj->sides->{$side}->{$ind}->{$array[$i]};
                    } else if (isset($obj->{$ind}->{$array[$i]})) {
                        unset($obj->{$ind}->{$array[$i]});
                    }
                }
            }
        }
    }

    public static function createFlipboxRules($obj, $key)
    {
        self::setFlipboxSide($obj, $obj->side);
        $str = self::getFlipboxRules($obj->desktop, $key);
        $empty = new stdClass();
        $object = self::object_extend($empty, $obj);
        $str .= self::setMediaRules($obj, $key, 'getFlipboxRules');
        self::setFlipboxSide($object, 'frontside');
        $key1 = $key.' > .ba-flipbox-wrapper > .ba-flipbox-frontside > .ba-grid-column-wrapper > .ba-grid-column';
        $pHeight = 100 + $object->parallax->offset * 2 * 200;
        $pTop = $object->parallax->offset * 2 * -100;
        $str .= "#".$key1." > .parallax-wrapper.scroll .parallax {";
        $str .= "height: ".$pHeight."%;";
        $str .= "top: ".$pTop."%;";
        $str .= "}";
        $str .= self::getFlipsidesRules($object->desktop, $key1);
        $str .= self::setMediaRules($object, $key1, 'getFlipsidesRules');
        self::setFlipboxSide($object, 'backside');
        $key1 = $key.' > .ba-flipbox-wrapper > .ba-flipbox-backside > .ba-grid-column-wrapper > .ba-grid-column';
        $pHeight = 100 + $object->parallax->offset * 2 * 200;
        $pTop = $object->parallax->offset * 2 * -100;
        $str .= "#".$key1." > .parallax-wrapper.scroll .parallax {";
        $str .= "height: ".$pHeight."%;";
        $str .= "top: ".$pTop."%;";
        $str .= "}";
        $str .= self::getFlipsidesRules($object->desktop, $key1);
        $str .= self::setMediaRules($object, $key1, 'getFlipsidesRules');
        
        return $str;
    }

    public static function createSectionRules($obj, $key)
    {
        self::$cssRulesFlag = 'desktop';
        $str = self::createPageRules($obj->desktop, $key, $obj->type);
        if ($obj->type == 'lightbox') {
            $str .= ".ba-lightbox-backdrop[data-id=".$key."] .close-lightbox {";
            $str .= "color: ".self::getCorrectColor($obj->close->color).";";
            $str .= "text-align: ".$obj->close->{'text-align'}.";";
            $str .= "}";
            $str .= "body.gridbox .ba-lightbox-backdrop[data-id=".$key."] > .ba-lightbox-close {";
            $str .= "background-color: ".self::getCorrectColor($obj->lightbox->background).";";
            $str .= "}";
            $str .= "body:not(.gridbox) .ba-lightbox-backdrop[data-id=".$key."] {";
            $str .= "background-color: ".self::getCorrectColor($obj->lightbox->background).";";
            $str .= "}";
        }
        if ($obj->type == 'overlay-section') {
            $str .= ".ba-overlay-section-backdrop[data-id=".$key."] .close-overlay-section {";
            $str .= "color: ".self::getCorrectColor($obj->close->color).";";
            $str .= "text-align: ".$obj->close->{'text-align'}.";";
            $str .= "}";
            $str .= "body.gridbox .ba-overlay-section-backdrop[data-id=".$key."] > .ba-overlay-section-close {";
            $str .= "background-color: ".self::getCorrectColor($obj->lightbox->background).";";
            $str .= "}";
            $str .= "body:not(.gridbox) .ba-overlay-section-backdrop[data-id=".$key."] {";
            $str .= "background-color: ".self::getCorrectColor($obj->lightbox->background).";";
            $str .= "}";
        }
        if (isset($obj->parallax)) {
            $pHeight = 100 + $obj->parallax->offset * 2 * 200;
            $pTop = $obj->parallax->offset * 2 * -100;
            $str .= "#".$key." > .parallax-wrapper.scroll .parallax {";
            $str .= "height: ".$pHeight."%;";
            $str .= "top: ".$pTop."%;";
            $str .= "}";
        }
        self::$cssRulesFlag = 'tablet';
        $str .= self::setMediaRules($obj, $key, 'createPageRules');
        
        return $str;
    }

    public static function createFooterStyle($obj)
    {
        $str = "";
        foreach ($obj as $key => $value) {
            switch($key) {
                case 'links' : 
                    $str .= "body footer a {";
                    $str .= "color : ".self::getCorrectColor($value->color).";";
                    $str .= "}";
                    $str .= "body footer a:hover {";
                    $str .= "color : ".self::getCorrectColor($value->{'hover-color'}).";";
                    $str .= "}";
                    break;
                case 'body':
                    $str .= "body footer, footer ul, footer ol, footer table, footer blockquote";
                    $str .= " {";
                    $str .= self::getTypographyRule($value);
                    $str .= "}";
                    break;
                case 'p' :
                case 'h1' :
                case 'h2' :
                case 'h3' :
                case 'h4' :
                case 'h5' :
                case 'h6' :
                    $str .= "footer ".$key;
                    $str .= " {";
                    $str .= self::getTypographyRule($value);
                    $str .= "}";
                    break;
            }
        }
        return $str;
    }

    public static function createMegaMenuRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= "min-height: 50px;";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "border-bottom-width : ".($obj->border->width * $obj->border->bottom)."px;";
        $str .= "border-color : ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-left-width : ".($obj->border->width * $obj->border->left)."px;";
        $str .= "border-right-width : ".($obj->border->width * $obj->border->right)."px;";
        $str .= "border-style : ".$obj->border->style.";";
        $str .= "border-top-width : ".($obj->border->width * $obj->border->top)."px;";
        $str .= "}";
        $str .= 'li.deeper > .tabs-content-wrapper[data-id="'.$selector.'"] + a > i.zmdi-caret-right {';
        $str .= self::setItemsVisability($obj->disable, "inline-block");
        $str .= "}";
        if (!empty($obj->background->image->image)) {
            $str .= "#".$selector." > .parallax-wrapper .parallax {";
            if (strpos($obj->background->image->image, 'balbooa.com') === false) {
                $str .= "background-image: url(".self::$up.str_replace(' ', '%20', $obj->background->image->image).");";
            } else {
                $str .= "background-image: url(".$obj->background->image->image.");";
            }
            $str .= "}";
        } else {
            $str .= "#".$selector." > .parallax-wrapper .parallax {";
            $str .= "background-image: none;";
            $str .= "}";
        }
        $str .= self::backgroundRule($obj, '#'.$selector, self::$up);

        return $str;
    }

    public static function getFlipboxRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." > .ba-flipbox-wrapper {";
        $str .= "height: ".$obj->view->height."px;";
        $str .= "}";
        $str .= "#".$selector." > .ba-flipbox-wrapper > .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column {";
        if ($obj->full->fullscreen) {
            $str .= "justify-content: center;";
            $str .= "-webkit-justify-content: center;";
            $str .= "min-height: 100vh;";
        } else {
            $str .= "min-height: 50px;";
        }
        $str .= "}";
        $str .= "#".$selector." > .ba-flipbox-wrapper > .column-wrapper {";
        $str .= "transition-duration: ".$obj->animation->duration."s;";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getFlipsidesRules($obj, $selector)
    {
        $str = '#'.$selector." {";
        $str .= "border-bottom-width : ".($obj->border->width * $obj->border->bottom)."px;";
        $str .= "border-color : ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-left-width : ".($obj->border->width * $obj->border->left)."px;";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "border-right-width : ".($obj->border->width * $obj->border->right)."px;";
        $str .= "border-style : ".$obj->border->style.";";
        $str .= "border-top-width : ".($obj->border->width * $obj->border->top)."px;";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= self::backgroundRule($obj, '#'.$selector, self::$up);

        return $str;
    }

    public static function createPageRules($obj, $selector, $type)
    {
        $str = "#".$selector." {";
        if ($obj->border->bottom == 1) {
            $str .= "border-bottom-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-bottom-width : 0;";
        }
        $str .= "border-color : ".self::getCorrectColor($obj->border->color).";";
        if ($obj->border->left == 1) {
            $str .= "border-left-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-left-width : 0;";
        }
        $str .= "border-radius : ".$obj->border->radius."px;";
        if ($obj->border->right == 1) {
            $str .= "border-right-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-right-width : 0;";
        }
        $str .= "border-style : ".$obj->border->style.";";
        if ($obj->border->top == 1) {
            $str .= "border-top-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-top-width : 0;";
        }
        $str .= "animation-duration: ".$obj->animation->duration."s;";
        if (isset($obj->animation->delay)) {
            $str .= "animation-delay: ".$obj->animation->delay."s;";
        }
        if (!empty($obj->animation->effect)) {
            $str .= "opacity: 0;";
        } else {
            $str .= "opacity: 1;";
        }
        if ($obj->full->fullscreen) {
            if ($type != 'column') {
                $str .= "align-items: center;-webkit-align-items: center;";
            }
            $str .= "justify-content: center;";
            $str .= "-webkit-justify-content: center;";
            if ($type != 'lightbox') {
                $str .= "min-height: 100vh;";
            } else {
                $str .= "min-height: calc(100vh - 50px);min-height: -webkit-calc(100vh - 50px);";
            }
            $str .= self::setItemsVisability($obj->disable, "flex;display: -webkit-flex;");
        } else {
            if (isset($obj->view) && isset($obj->view->height)) {
                $str .= "min-height: ".$obj->view->height."px;";
            } else {
                $str .= "min-height: 50px;";
            }
            $str .= self::setItemsVisability($obj->disable, "block");
        }
        if (isset($obj->view) && isset($obj->view->width)) {
            $str .= "width: ".$obj->view->width."px;";
        }
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector.".visible {opacity: 1;}";
        if (!empty($obj->background->image->image)) {
            $image = $obj->background->image->image;
            if (isset($obj->image)) {
                $image = $obj->image->image;
            }
            $str .= "#".$selector." > .parallax-wrapper .parallax {";
            if (strpos($image, 'balbooa.com') === false) {
                $str .= "background-image: url(".self::$up.str_replace(' ', '%20', $image).");";
            } else {
                $str .= "background-image: url(".$image.");";
            }
            $str .= "}";
        } else {
            $str .= "#".$selector." > .parallax-wrapper .parallax {";
            $str .= "background-image: none;";
            $str .= "}";
        }
        if (isset($obj->shape)) {
            $str .= self::getShapeRules($selector, $obj->shape->bottom, 'bottom');
            $str .= self::getShapeRules($selector, $obj->shape->top, 'top');
        }
        $str .= self::backgroundRule($obj, '#'.$selector, self::$up);
        $str .= self::setBoxModel($obj, $selector);
        if ($type == 'header') {
            $str .= self::createHeaderRules($obj, self::$cssRulesFlag);
        }
        if ($type == 'footer') {
            $str .= self::createFooterStyle($obj);
        }

        return $str;
    }

    public static function getShapeRules($selector, $obj, $type)
    {
        $str = "#".$selector." > .ba-shape-divider.ba-shape-divider-".$type." {";
        if ($obj->effect == 'arrow') {
            $arrow = '';
            $arrow .= "clip-path: polygon(100% ".(100 - $obj->value);
            $arrow .= "%, 100% 100%, 0 100%, 0 ".(100 - $obj->value);
            $arrow .= "%, ".(50 - $obj->value / 2)."% ".(100 - $obj->value);
            $arrow .= "%, 50% 100%, ".(50 + $obj->value / 2)."% ";
            $arrow .= (100 - $obj->value)."%);";
            $str .= $arrow;
            $str .= "-webkit-".$arrow;
        } else if ($obj->effect == 'zigzag') {
            $pyramids = "clip-path: polygon(";
            $delta = 0;
            $delta2 = 100 / ($obj->value * 2);
            for ($i = 0; $i < $obj->value; $i++) {
                if ($i != 0) {
                    $pyramids .= ",";
                }
                $pyramids .= $delta."% 100%,";
                $pyramids .= $delta2."% calc(100% - 15px),";
                $delta += 100 / $obj->value;
                $delta2 += 100 / $obj->value;
                $pyramids .= $delta."% 100%";
            }
            $pyramids .= ");";
            $str .= $pyramids;
            $str .= "-webkit-".$pyramids;
        } else if ($obj->effect == 'circle') {
            $str .= "clip-path: circle(".$obj->value."% at 50% 100%);";
            $str .= "-webkit-clip-path: circle(".$obj->value."% at 50% 100%);";
        } else if ($obj->effect == 'vertex') {
            $str .= "clip-path: polygon(20% calc(".(100 - $obj->value)."% + 15%), 35%  calc(".(100 - $obj->value);
            $str .= "% + 45%), 65%  ".(100 - $obj->value)."%, 100% 100%, 100% 100%, 0% 100%, 0  calc(";
            $str .= (100 - $obj->value)."% + 10%), 10%  calc(".(100 - $obj->value)."% + 30%));";
        } else if ($obj->effect != 'arrow' && $obj->effect != 'zigzag' &&
            $obj->effect != 'circle' && $obj->effect != 'vertex') {
            $str .= "clip-path: none;";
            $str .= "background: none;";
            $str .= "color: ".self::getCorrectColor($obj->color).";";
        }
        if ($obj->effect == 'arrow' || $obj->effect == 'zigzag' ||
            $obj->effect == 'circle' || $obj->effect == 'vertex') {
            $str .= "background-color: ".self::getCorrectColor($obj->color).";";
        }
        if ($obj->effect == '') {
            $str .= 'display: none;';
        } else {
            $str .= 'display: block;';
        }
        $str .= "}";
        $str .= "#".$selector." > .ba-shape-divider.ba-shape-divider-".$type." svg:not(.shape-divider-".$obj->effect.") {";
        $str .= "display: none;";
        $str .= "}";
        $str .= "#".$selector." > .ba-shape-divider.ba-shape-divider-".$type." svg.shape-divider-".$obj->effect." {";
        $str .= "display: block;";
        $str .= "height: ".($obj->value * 10)."px;";
        $str .= "}";

        return $str;
    }

    public static function getOnePageRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .integration-wrapper > ul > li {";
        foreach ($obj->nav->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." i.ba-menu-item-icon {";
        $str .= "font-size: ".$obj->nav->icon->size."px;";
        $str .= "}";
        $str .= "#".$selector." .main-menu li a {";
        $str .= self::getTypographyRule($obj->{'nav-typography'});
        $str .= "color : ".self::getCorrectColor($obj->nav->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->nav->normal->background).";";
        foreach ($obj->nav->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "border-bottom-width : ".($obj->nav->border->width * $obj->nav->border->bottom)."px;";
        $str .= "border-color : ".self::getCorrectColor($obj->nav->border->color).";";
        $str .= "border-left-width : ".($obj->nav->border->width * $obj->nav->border->left)."px;";
        $str .= "border-radius : ".$obj->nav->border->radius."px;";
        $str .= "border-right-width : ".($obj->nav->border->width * $obj->nav->border->right)."px;";
        $str .= "border-style : ".$obj->nav->border->style.";";
        $str .= "border-top-width : ".($obj->nav->border->width * $obj->nav->border->top)."px;";
        $str .= "}";
        if ($obj->nav->border->left == 1 && $obj->nav->border->right == 1 &&
            $obj->nav->margin->left == 0 && $obj->nav->margin->right == 0) {
            $str .= "#".$selector." > .ba-menu-wrapper:not(.vertical-menu) > .main-menu:not(.visible-menu)";
            $str .= " > .integration-wrapper > ul > li:not(:last-child) > a, #".$selector."> .ba-menu-wrapper:not(.vertical-menu)";
            $str .= " > .main-menu:not(.visible-menu) .integration-wrapper > ul > li:not(:last-child) > span {";
            $str .= "border-right: none";
            $str .= "}";
        }
        if ($obj->nav->border->top == 1 && $obj->nav->border->bottom == 1) {
            $str .= "#".$selector." > .ba-menu-wrapper.vertical-menu > .main-menu";
            $str .= " > .integration-wrapper > ul > li:not(:last-child) > a, #".$selector."> .ba-menu-wrapper.vertical-menu";
            $str .= " > .main-menu .integration-wrapper > ul > li:not(:last-child) > span, #";
            $str .= $selector." > .ba-menu-wrapper > .main-menu.visible-menu";
            $str .= " > .integration-wrapper > ul > li:not(:last-child) > a, #".$selector."> .ba-menu-wrapper";
            $str .= " > .main-menu.visible-menu .integration-wrapper > ul > li:not(:last-child) > span {";
            $str .= "border-bottom: none";
            $str .= "}";
        }
        $str .= "#".$selector." .main-menu li a:hover {";
        $str .= "color : ".self::getCorrectColor($obj->nav->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->nav->normal->background).";";
        $str .= "}";
        $str .= "#".$selector." ul {";
        $str .= "text-align : ".$obj->{'nav-typography'}->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .main-menu li.active > a {";
        $str .= "color : ".self::getCorrectColor($obj->nav->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->nav->hover->background).";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getMenuRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li {";
        foreach ($obj->nav->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a > i.ba-menu-item-icon, #";
        $str .= $selector." .integration-wrapper > ul > li > span > i.ba-menu-item-icon {";
        $str .= "font-size: ".$obj->nav->icon->size."px;";
        $str .= "}";
        $str .= "#".$selector." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a, #";
        $str .= $selector." .integration-wrapper > ul > li > span {";
        $str .= self::getTypographyRule($obj->{'nav-typography'});
        $str .= "color : ".self::getCorrectColor($obj->nav->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->nav->normal->background).";";
        foreach ($obj->nav->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "border-bottom-width : ".($obj->nav->border->width * $obj->nav->border->bottom)."px;";
        $str .= "border-color : ".self::getCorrectColor($obj->nav->border->color).";";
        $str .= "border-left-width : ".($obj->nav->border->width * $obj->nav->border->left)."px;";
        $str .= "border-radius : ".$obj->nav->border->radius."px;";
        $str .= "border-right-width : ".($obj->nav->border->width * $obj->nav->border->right)."px;";
        $str .= "border-style : ".$obj->nav->border->style.";";
        $str .= "border-top-width : ".($obj->nav->border->width * $obj->nav->border->top)."px;";
        $str .= "}";
        if ($obj->nav->border->left == 1 && $obj->nav->border->right == 1 &&
            $obj->nav->margin->left == 0 && $obj->nav->margin->right == 0) {
            $str .= "#".$selector." > .ba-menu-wrapper:not(.vertical-menu) > .main-menu:not(.visible-menu)";
            $str .= " > .integration-wrapper > ul > li:not(:last-child) > a, #".$selector."> .ba-menu-wrapper:not(.vertical-menu)";
            $str .= " > .main-menu:not(.visible-menu) .integration-wrapper > ul > li:not(:last-child) > span {";
            $str .= "border-right: none";
            $str .= "}";
        }
        if ($obj->nav->border->top == 1 && $obj->nav->border->bottom == 1) {
            $str .= "#".$selector." > .ba-menu-wrapper.vertical-menu > .main-menu";
            $str .= " > .integration-wrapper > ul > li:not(:last-child) > a, #".$selector."> .ba-menu-wrapper.vertical-menu";
            $str .= " > .main-menu .integration-wrapper > ul > li:not(:last-child) > span, #";
            $str .= $selector." > .ba-menu-wrapper > .main-menu.visible-menu";
            $str .= " > .integration-wrapper > ul > li:not(:last-child) > a, #".$selector."> .ba-menu-wrapper";
            $str .= " > .main-menu.visible-menu .integration-wrapper > ul > li:not(:last-child) > span {";
            $str .= "border-bottom: none";
            $str .= "}";
        }
        $str .= "#".$selector." .main-menu .nav-child li i.ba-menu-item-icon {";
        $str .= "font-size: ".$obj->sub->icon->size."px;";
        $str .= "}";
        $str .= "#".$selector." .main-menu .nav-child li a,#".$selector." .main-menu .nav-child li span {";
        $str .= self::getTypographyRule($obj->{'sub-typography'});
        $str .= "color : ".self::getCorrectColor($obj->sub->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->sub->normal->background).";";
        foreach ($obj->sub->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "border-bottom-width : ".($obj->sub->border->width * $obj->sub->border->bottom)."px;";
        $str .= "border-color : ".self::getCorrectColor($obj->sub->border->color).";";
        $str .= "border-left-width : ".($obj->sub->border->width * $obj->sub->border->left)."px;";
        $str .= "border-radius : ".$obj->sub->border->radius."px;";
        $str .= "border-right-width : ".($obj->sub->border->width * $obj->sub->border->right)."px;";
        $str .= "border-style : ".$obj->sub->border->style.";";
        $str .= "border-top-width : ".($obj->sub->border->width * $obj->sub->border->top)."px;";
        $str .= "}";
        if ($obj->sub->border->top == 1 && $obj->sub->border->bottom == 1) {
            $str .= "#".$selector." .main-menu .nav-child li:not(:last-child) > a,#";
            $str .= $selector." .main-menu .nav-child li:not(:last-child) > span {";
            $str .= "border-bottom: none";
            $str .= "}";
        }
        $str .= "#".$selector." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a:hover,#";
        $str .= $selector." .main-menu li > span:hover {";
        $str .= "color : ".self::getCorrectColor($obj->nav->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->nav->normal->background).";";
        $str .= "}";
        $str .= "#".$selector." .main-menu .nav-child li a:hover,#".$selector." .main-menu .nav-child li span:hover {";
        $str .= "color : ".self::getCorrectColor($obj->sub->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->sub->normal->background).";";
        $str .= "}";
        $str .= "#".$selector." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul {";
        $str .= "text-align : ".$obj->{'nav-typography'}->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li.active > a,#";
        $str .= $selector." .main-menu li.active > span {";
        $str .= "color : ".self::getCorrectColor($obj->nav->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->nav->hover->background).";";
        $str .= "}";
        $str .= "#".$selector." .main-menu .nav-child li.active > a,#".$selector." .main-menu .nav-child li.active > span {";
        $str .= "color : ".self::getCorrectColor($obj->sub->hover->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->sub->hover->background).";";
        $str .= "}";
        $str .= "#".$selector." ul.nav-child {";
        foreach ($obj->dropdown->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getWeatherRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .weather .city {";
        $str .= self::getTypographyRule($obj->city);
        $str .= "}";
        $str .= "#".$selector." .weather .condition {";
        $str .= self::getTypographyRule($obj->condition);
        $str .= "}";
        $str .= "#".$selector." .weather-info > div,#".$selector." .weather .date {";
        $str .= self::getTypographyRule($obj->info);
        $str .= "}";
        $str .= "#".$selector." .forecast > span {";
        $str .= self::getTypographyRule($obj->forecasts);
        $str .= "}";
        $str .= "#".$selector." .weather-info .wind {";
        if ($obj->view->wind) {
            $str .= "display : inline;";
        } else {
            $str .= "display : none;";
        }
        $str .= "}";
        $str .= "#".$selector." .weather-info .humidity {";
        if ($obj->view->humidity) {
            $str .= "display : inline-block;";
        } else {
            $str .= "display : none;";
        }
        $str .= "}";
        $str .= "#".$selector." .weather-info .pressure {";
        if ($obj->view->pressure) {
            $str .= "display : inline-block;";
        } else {
            $str .= "display : none;";
        }
        $str .= "}";
        $str .= "#".$selector." .weather-info .sunrise-wrapper {";
        if ($obj->view->{'sunrise-wrapper'}) {
            $str .= "display : block;";
        } else {
            $str .= "display : none;";
        }
        $str .= "}";
        if ($obj->view->layout == 'forecast-block') {
            $str .= "#".$selector.' .forecast > span {display: block;width: initial;}';
            $str .= "#".$selector.' .weather-info + div {text-align: center;}';
            $str .= "#".$selector.' .ba-weather div.forecast {margin: 0 20px 0 10px;}';
            $str .= "#".$selector.' .ba-weather div.forecast .day-temp,';
            $str .= "#".$selector.' .ba-weather div.forecast .night-temp {margin: 0 5px;}';
            $str .= "#".$selector.' .ba-weather div.forecast span.night-temp,';
            $str .= "#".$selector.' .ba-weather div.forecast span.day-temp {padding-right: 0;width: initial;}';
        } else {
            $str .= "#".$selector.' .forecast > span {display: inline-block;width: 33.3%;}';
            $str .= "#".$selector.' .weather-info + div {text-align: left;}';
            $str .= "#".$selector.' .ba-weather div.forecast .day-temp,';
            $str .= "#".$selector.' .ba-weather div.forecast .night-temp {margin: 0;}';
            $str .= "#".$selector.' .ba-weather div.forecast {margin: 0;}';
            $str .= "#".$selector.' .ba-weather div.forecast span.night-temp,';
            $str .= "#".$selector.' .ba-weather div.forecast span.day-temp {padding-right: 1.5%;width: 14%;}';
        }
        $str .= "#".$selector." .forecast:nth-child(n) {";
        $str .= "display : none;";
        $str .= "}";
        for ($i = 0; $i < $obj->view->forecast; $i++) {
            $str .= "#".$selector."  .forecast:nth-child(".($i + 1).")";
            if ($i != $obj->view->forecast - 1 ) {
                $str .= ",";
            }
        }
        $str .= " {display: ".($obj->view->layout == 'forecast-block' ? 'inline-block' : 'block').";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getAccordionRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .accordion-group, #".$selector." .accordion-inner {";
        $str .= "border-color: ".self::getCorrectColor($obj->border->color).";"; 
        $str .= "}";
        $str .= "#".$selector." .accordion-inner {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "background-color: ".self::getCorrectColor($obj->background->color).";";
        $str .= "}";
        $str .= "#".$selector." .accordion-heading a {";
        $str .= self::getTypographyRule($obj->typography, 'text-decoration');
        $str .= "}";
        $str .= "#".$selector." .accordion-heading span.accordion-title {";
        $str .= "text-decoration: ".$obj->typography->{'text-decoration'}.";";
        $str .= "}";
        $str .= "#".$selector." .accordion-heading a i {";
        $str .= "font-size: ".$obj->icon->size."px;";
        $str .= "}";
        $str .= "#".$selector." .accordion-heading {";
        $str .= "background-color: ".self::getCorrectColor($obj->header->color).";";
        $str .= "}";
        if ($obj->icon->position == 'icon-position-left') {
            $str .= "#".$selector.' .accordion-toggle > span { flex-direction: row-reverse; -webkit-flex-direction: row-reverse; }';
        } else {
            $str .= "#".$selector.' .accordion-toggle > span { flex-direction: row; -webkit-flex-direction: row; }';
        }
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getInstagramRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-instagram-image {";
        if ($obj->gutter) {
            $str .= "width: calc((100% / ".$obj->count.") - 21px);";
            $str .= "width: -webkit-calc((100% / ".$obj->count.") - 21px);";
            $str .= "margin: 0 5px 10px;";
        } else {
            $str .= "width: calc(100% / ".$obj->count.");";
            $str .= "width: -webkit-calc(100% / ".$obj->count.");";
            $str .= "margin: 0;";
        }
        $str .= "height: ".$obj->view->height."px;";
        $str .= "}";
        $str .= "#".$selector." .instagram-wrapper {";
        if ($obj->gutter) {
            $str .= 'margin-left: -10px; margin-right: -10px;width: calc(100% + 20px);width: -webkit-calc(100% + 20px);';
        } else {
            $str .= 'margin-left: 0; margin-right: 0;width: 100%;';
        }
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getProgressBarRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-progress-bar {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        $str .= 'height: '.$obj->view->height.'px;';
        $str .= "background-color: ".self::getCorrectColor($obj->view->background).";";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ";
        $str .= self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-animated-bar {";
        $str .= "background-color: ".self::getCorrectColor($obj->view->bar).";";
        $str .= self::getTypographyRule($obj->typography);
        $str .= "}";
        $str .= "#".$selector." .progress-bar-title {display: ";
        if ($obj->display->label) {
            $str .= 'inline-block;';
        } else {
            $str .= 'none;';
        }
        $str .= "}";
        $str .= "#".$selector." .progress-bar-number {display: ";
        if ($obj->display->target) {
            $str .= 'inline-block;';
        } else {
            $str .= 'none;';
        }
        $str .= "}";

        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getProgressPieRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-progress-pie {";
        $str .= 'width: '.$obj->view->width.'px;';
        $str .= self::getTypographyRule($obj->typography);
        $str .= "}";
        $str .= "#".$selector." .ba-progress-pie canvas {";
        $str .= 'width: '.$obj->view->width.'px;';
        $str .= "}";
        $str .= "#".$selector." .progress-bar-number {display: ";
        if ($obj->display->target) {
            $str .= 'inline-block;';
        } else {
            $str .= 'none;';
        }
        $str .= "}";

        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getModulesRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getErrorRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." h1.ba-error-code {";
        $str .= self::getTypographyRule($obj->code->typography);
        foreach ($obj->code->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "display: ".($obj->view->code ? "block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." p.ba-error-message {";
        $str .= self::getTypographyRule($obj->message->typography);
        foreach ($obj->message->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "display: ".($obj->view->message ? "block" : "none").";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getTextRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $array = array('p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        foreach ($array as $key => $value) {
            if (isset($obj->{$value}->{'font-style'}) && $obj->{$value}->{'font-style'} == '@default') {
                unset($obj->{$value}->{'font-style'});
            }
            $str .= "#".$selector." ".$value." {";
            $str .= self::getTypographyRule($obj->{$value}, '', $value);
            if (isset($obj->animation)) {
                $str .= 'animation-duration: '.$obj->animation->duration.'s;';
            }
            $str .= ";}";
        }
        if (isset($obj->links) && isset($obj->links->color)) {
            $str .= "#".$selector.' a {';
            $str .= 'color:'.self::getCorrectColor($obj->links->color).';';
            $str .= '}';
        }
        if (isset($obj->links) && isset($obj->links->{'hover-color'})) {
            $str .= "#".$selector.' a:hover {';
            $str .= 'color:'.self::getCorrectColor($obj->links->{'hover-color'}).';';
            $str .= '}';
        }
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getCategoriesRules($obj, $selector)
    {
        $str = "#".$selector." {";
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= self::setItemsVisability($obj->disable, "block");
        $str .= "}";
        $str .= "#".$selector." li {";
        $str .= "text-align: ".$obj->{'nav-typography'}->{'text-align'}.';';
        $str .= "}";
        $str .= "#".$selector." li a {";
        $str .= self::getTypographyRule($obj->{'nav-typography'}, 'text-align');
        $str .= "}";
        $str .= "#".$selector." li a span {";
        if ($obj->view->counter) {
            $str .= "display: inline;";
        } else {
            $str .= "display: none;";
        }
        $str .= "}";
        $str .= "#".$selector." ul ul {";
        if ($obj->view->sub) {
            $str .= "display: block;";
        } else {
            $str .= "display: none;";
        }
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getTabsRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $align = str_replace('left', 'flex-start', $obj->typography->{'text-align'});
        $align = str_replace('right', 'flex-end', $align);
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .tab-content {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "background-color: ".self::getCorrectColor($obj->background->color).";";
        $str .= "}";
        $str .= "#".$selector." ul.nav.nav-tabs li a {";
        $str .= self::getTypographyRule($obj->typography, 'text-decoration');
        $str .= 'align-items:'.$align.'; -webkit-align-items:'.$align.';';
        $str .= "border-color: ".self::getCorrectColor($obj->header->border).";";
        $str .= "}";
        $str .= "#".$selector." li span.tabs-title {";
        $str .= "text-decoration : ".$obj->typography->{'text-decoration'}.";";
        $str .= "}";
        $str .= "#".$selector." ul.nav.nav-tabs li a i {";
        $str .= "font-size: ".$obj->icon->size."px;";
        $str .= "}";
        $str .= "#".$selector." ul.nav.nav-tabs li.active a {";
        $str .= "color : ".self::getCorrectColor($obj->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." ul.nav.nav-tabs li.active a:before {";
        $str .= "background-color : ".self::getCorrectColor($obj->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." ul.nav.nav-tabs {";
        $str .= "background-color: ".self::getCorrectColor($obj->header->color).";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getCounterRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "text-align : ".$obj->counter->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-counter span.counter-number {";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "background-color: ".self::getCorrectColor($obj->background->color).";";
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        $str .= self::getTypographyRule($obj->counter, 'text-align');
        $str .= "width : ".$obj->counter->{'line-height'}."px;";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getCountdownRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-countdown > span {";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "background-color: ".self::getCorrectColor($obj->background->color).";";
        $str .= "}";
        $str .= "#".$selector." .countdown-time {";
        $str .= self::getTypographyRule($obj->counter);
        $str .= "}";
        $str .= "#".$selector." .countdown-label {";
        $str .= self::getTypographyRule($obj->label);
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function prepareParentFonts($params)
    {
        self::$parentFonts = $params;
    }

    public static function getTextParentFamily($key)
    {
        if (!isset(self::$parentFonts->desktop->body)) {
            $empty = new stdClass();
            self::$parentFonts->desktop->body = self::object_extend($empty, self::$parentFonts->desktop->p);
        }
        $family = self::$parentFonts->desktop->{$key}->{'font-family'};
        if ($family == '@default') {
            $family = self::$parentFonts->desktop->body->{'font-family'};
        }

        return $family;
    }

    public static function getTextParentWeight($key)
    {
        $weight = self::$parentFonts->desktop->{$key}->{'font-weight'};
        if ($weight == '@default') {
            $weight = self::$parentFonts->desktop->body->{'font-weight'};
        }

        return $weight;
    }

    public static function getTextParentCustom($key)
    {
        $obj = self::$parentFonts->desktop->{$key};
        $custom = isset($obj->custom) ? $obj->custom : '';
        $family = $obj->{'font-family'};
        if ($family == '@default') {
            $body = self::$parentFonts->desktop->body;
            $custom = isset($body->custom) ? $body->custom : '';
        }

        return $custom;
    }

    public static function getTypographyRule($obj, $not = '', $ind = null)
    {
        $str = "";
        $family = $weight = $custom = '';
        $font = $ind ? $ind : 'body';
        foreach ($obj as $key => $value) {
            if ($key != $not)  {
                if ($key == 'font-family') {
                    $family = $value;
                    if ($family == '@default') {
                        $family = self::getTextParentFamily($font);
                    }
                    $str .= $key." : '".str_replace('+', ' ', $family)."'";
                } else if ($key == 'font-weight') {
                    $weight = $value;
                    if ($weight == '@default') {
                        $weight = self::getTextParentWeight($font);
                    }
                    $str .= $key." : ".str_replace('i', '', $weight);
                } else if ($key == 'color') {
                    $str .= 'color:'.self::getCorrectColor($value);
                } else if ($key != 'custom') {
                    $str .= $key." : ".$value;
                } else if ($key = 'custom') {
                    $custom = $value;
                }
                if ($key == 'letter-spacing' || $key == 'font-size' || $key == 'line-height') {
                    $str .= "px";
                }
                $str .= ";";
            }
        }
        if (isset($obj->{'font-family'}) && $obj->{'font-family'} == '@default') {
            $custom = self::getTextParentCustom($font);
        }
        if (!empty($family)) {
            if (!empty($custom)) {
                if (!isset(self::$customFonts[$family])) {
                    self::$customFonts[$family] = array();
                }
                if (!in_array($custom, self::$customFonts[$family])) {
                    self::$customFonts[$family][$weight] = $custom;
                }
            } else {
                if (!isset(self::$fonts[$family])) {
                    self::$fonts[$family] = array();
                }
                if (!in_array($weight, self::$fonts[$family])) {
                    self::$fonts[$family][] = $weight;
                }
            }
        }
        
        return $str;
    }

    public static function getSearchRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-search-wrapper input::-webkit-input-placeholder {";
        $str .= self::getTypographyRule($obj->typography);
        $str .= "}";
        $str .= "#".$selector." .ba-search-wrapper input::-moz-placeholder {";
        $str .= self::getTypographyRule($obj->typography);
        $str .= "}";
        $str .= "#".$selector." .ba-search-wrapper input {";
        $str .= self::getTypographyRule($obj->typography, 'text-align');
        $str .= "height : ".$obj->typography->{'line-height'}."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-search-wrapper {";
        if ($obj->border->bottom == 1) {
            $str .= "border-bottom-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-bottom-width : 0;";
        }
        $str .= "border-color : ".self::getCorrectColor($obj->border->color).";";
        if ($obj->border->left == 1) {
            $str .= "border-left-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-left-width : 0;";
        }
        $str .= "border-radius : ".$obj->border->radius."px;";
        if ($obj->border->right == 1) {
            $str .= "border-right-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-right-width : 0;";
        }
        $str .= "border-style : ".$obj->border->style.";";
        if ($obj->border->top == 1) {
            $str .= "border-top-width : ".$obj->border->width."px;";
        } else {
            $str .= "border-top-width : 0;";
        }
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-search-wrapper i {";
        $str .= "color: ".self::getCorrectColor($obj->typography->color).";";
        $str .= "font-size : ".$obj->icons->size."px;";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getButtonRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= "text-align: ".$obj->typography->{'text-align'}.";";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-button-wrapper a span {";
        $str .= self::getTypographyRule($obj->typography);
        $str .= "}";
        $str .= "#".$selector." .ba-button-wrapper a {";
        $str .= "color : ".self::getCorrectColor($obj->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->normal->{'background-color'}).";";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        if (isset($obj->icons)) {
            $str .= "#".$selector." .ba-button-wrapper a i {";
            $str .= "font-size : ".$obj->icons->size."px;";
            $str .= "}";
        }
        if (isset($obj->icons) && isset($obj->icons->position)) {
            $str .= "#".$selector." .ba-button-wrapper a {";
            if ($obj->icons->position == '') {
                $str .= 'flex-direction: row-reverse; -webkit-flex-direction: row-reverse;';
            } else {
                $str .= 'flex-direction: row; -webkit-flex-direction: row;';
            }
            $str .= "}";
            if ($obj->icons->position == '') {
                $str .= "#".$selector." .ba-button-wrapper a i {";
                $str .= 'margin: 0 10px 0 0;';
                $str .= "}";
            } else {
                $str .= "#".$selector." .ba-button-wrapper a i {";
                $str .= 'margin: 0 0 0 10px;';
                $str .= "}";
            }
        }
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getBlogPostsRules($obj, $selector, $type)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-grid-layout .ba-blog-post {";
        $str .= "width: calc((100% / ".$obj->view->count.") - 21px);";
        $str .= "width: -webkit-calc((100% / ".$obj->view->count.") - 21px);";
        $str .= "}";
        $str .= "#".$selector." .ba-overlay {";
        $str .= "background-color: ".self::getCorrectColor($obj->overlay->color).";";
        $str .= "}";
        if ($obj->view->gutter) {
            $str .= "#".$selector." .ba-cover-layout .ba-blog-post {";
            $str .= "margin-left: 10px;margin-right: 10px;margin-bottom: 30px;";
            $str .= "width: calc((100% / ".$obj->view->count.") - 21px);";
            $str .= "width: -webkit-calc((100% / ".$obj->view->count.") - 21px);";
            $str .= "}";
            $str .= "#".$selector." .ba-cover-layout {margin-left: -10px;margin-right: -10px;}";
        } else {
            $str .= "#".$selector." .ba-cover-layout .ba-blog-post {";
            $str .= "margin: 0;";
            $str .= "width: calc(100% / ".$obj->view->count.");";
            $str .= "width: -webkit-calc(100% / ".$obj->view->count.");";
            $str .= "}";
            $str .= "#".$selector." .ba-cover-layout {margin-left: 0;margin-right: 0;}";
        }
        if (isset($obj->background)) {
            $str .= "#".$selector." .ba-blog-post {";
            $str .= "background-color:".self::getCorrectColor($obj->background->color).';';
            $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
            $str .= "border-radius : ".$obj->border->radius."px;";
            $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
            $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
            $str .= "}";
        }
        if (isset($obj->image->border)) {
            $str .= "#".$selector." .ba-blog-post-image {";
            $str .= "border : ".$obj->image->border->width."px ";
            $str .= $obj->image->border->style." ".self::getCorrectColor($obj->image->border->color).";";
            $str .= "border-radius : ".$obj->image->border->radius."px;";
            $str .= "}";
        }
        $str .= "#".$selector." .ba-blog-post-image {";
        $str .= "display:".($obj->view->image ? "block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-title-wrapper {";
        $str .= "display:".($obj->view->title ? "block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-date {";
        $str .= "display:".($obj->view->date ? "inline-block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-category {";
        $str .= "display:".($obj->view->category ? "inline-block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-views {";
        $str .= "display:".($obj->view->hits ? "inline-block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-intro-wrapper {";
        $str .= "display:".($obj->view->intro ? "block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-button-wrapper {";
        $str .= "display:".($obj->view->button ? "block" : "none").";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-image {";
        $str .= "width :".$obj->image->width."px;";
        $str .= "height :".$obj->image->height."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-cover-layout .ba-blog-post {";
        $str .= "height :".$obj->image->height."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-title {";
        if ($type == 'post-navigation' && $obj->title->typography->{'text-align'} == 'left') {
            $str .= "text-align :right;";
        } else if ($type == 'post-navigation' && $obj->title->typography->{'text-align'} == 'right') {
            $str .= "text-align :left;";
        } else {
            $str .= "text-align :".$obj->title->typography->{'text-align'}.";";
        }
        $str .= "}";
        if ($type == 'post-navigation') {
            $str .= "#".$selector." i + .ba-blog-post .ba-blog-post-title {";
            $str .= "text-align :".$obj->title->typography->{'text-align'}.";";
            $str .= "}";
        }
        $str .= "#".$selector." .ba-blog-post-title a {";
        $str .= self::getTypographyRule($obj->title->typography, 'text-align');
        foreach ($obj->title->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-info-wrapper {";
        foreach ($obj->info->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        if ($type == 'post-navigation' && $obj->info->typography->{'text-align'} == 'left') {
            $str .= "text-align :right;";
        } else if ($type == 'post-navigation' && $obj->info->typography->{'text-align'} == 'right') {
            $str .= "text-align :left;";
        } else {
            $str .= "text-align :".$obj->info->typography->{'text-align'}.";";
        }
        $str .= "}";
        if ($type == 'post-navigation') {
            $str .= "#".$selector." i + .ba-blog-post .ba-blog-post-info-wrapper {";
            $str .= "text-align :".$obj->info->typography->{'text-align'}.";";
            $str .= "}";
        }
        $str .= "#".$selector." .ba-blog-post-info-wrapper > * {";
        $str .= self::getTypographyRule($obj->info->typography, 'text-align');
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-intro-wrapper {";
        $str .= self::getTypographyRule($obj->intro->typography, 'text-align');
        foreach ($obj->intro->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-intro-wrapper {";
        if ($type == 'post-navigation' && $obj->intro->typography->{'text-align'} == 'left') {
            $str .= "text-align :right;";
        } else if ($type == 'post-navigation' && $obj->intro->typography->{'text-align'} == 'right') {
            $str .= "text-align :left;";
        } else {
            $str .= "text-align :".$obj->intro->typography->{'text-align'}.";";
        }
        $str .= "}";
        if ($type == 'post-navigation') {
            $str .= "#".$selector." i + .ba-blog-post .ba-blog-post-intro-wrapper {";
            $str .= "text-align :".$obj->intro->typography->{'text-align'}.";";
            $str .= "}";
        }
        $str .= "#".$selector." .ba-blog-post-button-wrapper {";
        if ($type == 'post-navigation' && $obj->button->typography->{'text-align'} == 'left') {
            $str .= "text-align :right;";
        } else if ($type == 'post-navigation' && $obj->button->typography->{'text-align'} == 'right') {
            $str .= "text-align :left;";
        } else {
            $str .= "text-align :".$obj->button->typography->{'text-align'}.";";
        }
        $str .= "}";
        if ($type == 'post-navigation') {
            $str .= "#".$selector." i + .ba-blog-post .ba-blog-post-button-wrapper {";
            $str .= "text-align :".$obj->button->typography->{'text-align'}.";";
            $str .= "}";
        }
        $str .= "#".$selector." .ba-blog-post-button-wrapper a {";
        foreach ($obj->button->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= self::getTypographyRule($obj->button->typography, 'text-align');
        $str .= "border : ".$obj->button->border->width."px ";
        $str .= $obj->button->border->style." ".self::getCorrectColor($obj->button->border->color).";";
        $str .= "border-radius : ".$obj->button->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->button->shadow->value * 10);
        $str .= "px ".($obj->button->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->button->shadow->color).";";
        $str .= "background-color: ".self::getCorrectColor($obj->button->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->normal->color).";";
        foreach ($obj->button->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-button-wrapper a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->button->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->hover->color).";";
        $str .= "}";
        if (isset($obj->pagination)) {
            $str .= "#".$selector." .ba-blog-posts-pagination span a {";
            $str .= "color: ".self::getCorrectColor($obj->pagination->color).";";
            $str .= "}";
            $str .= "#".$selector." .ba-blog-posts-pagination span.active a,#".$selector;
            $str .= " .ba-blog-posts-pagination span:hover a {";
            $str .= "color: ".self::getCorrectColor($obj->pagination->hover).";";
            $str .= "}";
        }
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getPostIntroRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .intro-post-wrapper.fullscreen-post {";
        $str .= "height :".$obj->image->height."px;";
        if ($obj->image->fullscreen) {
            $str .= "min-height: 100vh;";
        } else {
            $str .= "min-height: auto;";
        }
        $str .= "}";
        $str .= "#".$selector." .intro-post-wrapper:not(.fullscreen-post) {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .fullscreen-post .intro-post-title-wrapper,#".$selector;
        $str .= " .fullscreen-post .intro-post-info {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-overlay {background-color:";
        if (!isset($obj->image->type) || $obj->image->type == 'color'){
            $str .= self::getCorrectColor($obj->image->color).";";
            $str .= 'background-image: none';
        } else if ($obj->image->type == 'none') {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: none;';
        } else {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: '.$obj->image->gradient->effect.'-gradient(';
            if ($obj->image->gradient->effect == 'linear') {
                $str .= $obj->image->gradient->angle.'deg';
            } else {
                $str .= 'circle';
            }
            $str .= ', '.self::getCorrectColor($obj->image->gradient->color1).' ';
            $str .= $obj->image->gradient->position1.'%, '.self::getCorrectColor($obj->image->gradient->color2);
            $str .= ' '.$obj->image->gradient->position2.'%);';
            $str .= 'background-attachment: scroll;';
        }
        $str .= '}';
        $str .= "#".$selector." .intro-post-image {";
        $str .= "height :".$obj->image->height."px;";
        $str .= "background-attachment: ".$obj->image->attachment.";";
        $str .= "background-position: ".$obj->image->position.";";
        $str .= "background-repeat: ".$obj->image->repeat.";";
        $str .= "background-size: ".$obj->image->size.";";
        if ($obj->image->fullscreen) {
            $str .= "min-height: 100vh;";
        } else {
            $str .= "min-height: auto;";
        }
        $str .= "}";
        $str .= "#".$selector." .intro-post-title-wrapper {";
        $str .= "text-align :".$obj->title->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .intro-post-title {";
        $str .= self::getTypographyRule($obj->title->typography, 'text-align');
        foreach ($obj->title->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .intro-post-info {";
        $str .= "text-align :".$obj->info->typography->{'text-align'}.";";
        foreach ($obj->info->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        if (isset($obj->info->show)) {
            $str .= 'display:'.($obj->info->show ? 'block' : 'none').';';
        }
        if (!isset($obj->image->show)) {
            $obj->image->show = $obj->title->show = $obj->date = $obj->category = $obj->hits = true;
        }
        $str .= "}";
        $str .= "#".$selector." .intro-post-info *:not(i) {";
        $str .= self::getTypographyRule($obj->info->typography, 'text-align');
        $str .= "}";
        $str .= "#".$selector." .intro-post-image-wrapper {";
        $str .= 'display:'.($obj->image->show ? 'block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .intro-post-title-wrapper {";
        $str .= 'display:'.($obj->title->show ? 'block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .intro-post-date {";
        $str .= 'display:'.($obj->view->date ? 'inline-block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .intro-post-category {";
        $str .= 'display:'.($obj->view->category ? 'inline-block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .intro-post-views {";
        $str .= 'display:'.($obj->view->hits ? 'inline-block' : 'none').';';
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getStarRatingsRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .star-ratings-wrapper {";
        $str .= "text-align: ".$obj->icon->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .rating-wrapper {";
        $str .= self::setItemsVisability(!$obj->view->rating, "inline");
        $str .= "}";
        $str .= "#".$selector." .votes-wrapper {";
        $str .= self::setItemsVisability(!$obj->view->votes, "inline");
        $str .= "}";
        $str .= "#".$selector." .stars-wrapper {";
        $str .= "color:".self::getCorrectColor($obj->icon->color).";";
        $str .= "}";
        $str .= "#".$selector." .star-ratings-wrapper i {";
        $str .= "font-size:".$obj->icon->size."px;";
        $str .= "}";
        $str .= "#".$selector." .star-ratings-wrapper i.active, #".$selector." .star-ratings-wrapper i.active + i:after";
        $str .= ", #".$selector." .stars-wrapper:hover i {";
        $str .= "color:".self::getCorrectColor($obj->icon->hover).";";
        $str .= "}";
        $str .= "#".$selector." .info-wrapper * {";
        $str .= self::getTypographyRule($obj->info, 'text-align');
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getIconRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= "text-align: ".$obj->icon->{'text-align'}.";";
        if (isset($obj->inline) && $obj->inline) {
            $str .= self::setItemsVisability($obj->disable, "inline-block");
            $str .= "margin : 0 10px;";
            $str .= "width: auto;";
        } else {
            $str .= self::setItemsVisability($obj->disable, "block");
            $str .= "margin : 0;";
        }
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-icon-wrapper i {";
        $str .= "width : ".$obj->icon->size."px;";
        $str .= "height : ".$obj->icon->size."px;";
        $str .= "font-size : ".$obj->icon->size."px;";
        $str .= "color : ".self::getCorrectColor($obj->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->normal->{'background-color'}).";";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        if (isset($obj->shadow)) {
            $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
            $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        }
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getRecentSliderRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $margin = $obj->gutter ? 30 : 0;
        $margin = $margin * ($obj->slideset->count - 1);
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        if ($obj->overflow) {
            $str .= "#".$selector." .slideshow-content {";
            $str .= "width: calc(100% + (100% / ".$obj->slideset->count.") * 2);";
            $str .= "width: -webkit-calc(100% + (100% / ".$obj->slideset->count.") * 2);";
            $str .= "margin-left: calc((100% / ".$obj->slideset->count.") * -1);";
            $str .= "margin-left: -webkit--calc((100% / ".$obj->slideset->count.") * -1);";
            $str .= "min-height: ".$obj->view->height."px;";
            $str .= "}";
        } else {
            $str .= "#".$selector." .slideshow-content {";
            $str .= "width: 100%;";
            $str .= "margin-left: auto;";
            $str .= "min-height: ".$obj->view->height."px;";
            $str .= "}";
        }
        $str .= "#".$selector." li {";
        $str .= "width: calc((100% - ".$margin."px) / ".$obj->slideset->count.");";
        $str .= "width: -webkit-calc((100% - ".$margin."px) / ".$obj->slideset->count.");";
        $str .= "}";
        $str .= "#".$selector." ul:not(.slideset-loaded) li {";
        $str .= "position: relative; float:left;";
        $str .= "}";
        $str .= "#".$selector." ul:not(.slideset-loaded) li.item.active:not(:first-child) {";
        $str .= "margin-left: ".($obj->gutter ? 30 : 0)."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-img {";
        $str .= "background-size :".$obj->view->size.";";
        $str .= "height:".$obj->view->height."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-caption > * {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-caption {background-color :";
        if (!isset($obj->overlay->type) || $obj->overlay->type == 'color'){
            $str .= self::getCorrectColor($obj->overlay->color).";";
            $str .= 'background-image: none';
        } else if ($obj->overlay->type == 'none') {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: none;';
        } else {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: '.$obj->overlay->gradient->effect.'-gradient(';
            if ($obj->overlay->gradient->effect == 'linear') {
                $str .= $obj->overlay->gradient->angle.'deg';
            } else {
                $str .= 'circle';
            }
            $str .= ', '.self::getCorrectColor($obj->overlay->gradient->color1).' ';
            $str .= $obj->overlay->gradient->position1.'%, '.self::getCorrectColor($obj->overlay->gradient->color2);
            $str .= ' '.$obj->overlay->gradient->position2.'%);';
            $str .= 'background-attachment: scroll;';
        }
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-title {";
        $str .= self::getTypographyRule($obj->title->typography);
        foreach ($obj->title->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= 'display:'.($obj->view->title ? 'block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-title:hover {";
        $str .= "color: ".self::getCorrectColor($obj->title->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-info-wrapper {";
        $str .= "text-align :".$obj->info->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-info-wrapper span {";
        $str .= self::getTypographyRule($obj->info->typography, 'text-align');
        foreach ($obj->info->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-info-wrapper span.ba-blog-post-date {";
        $str .= 'display:'.($obj->view->date ? 'inline-block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-info-wrapper span.ba-blog-post-category {";
        $str .= 'display:'.($obj->view->category ? 'inline-block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-info-wrapper span.ba-blog-post-category:hover {";
        $str .= "color: "+self::getCorrectColor($obj->info->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .slideshow-button {";
        $str .= "text-align :".$obj->button->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-intro-wrapper {";
        $str .= self::getTypographyRule($obj->intro->typography);
        foreach ($obj->intro->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= 'display:'.($obj->view->intro ? 'block' : 'none').';';
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-button-wrapper {";
        $str .= "text-align :".$obj->button->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-button-wrapper a {";
        foreach ($obj->button->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= 'display:'.($obj->view->button ? 'inline-block' : 'none').';';
        $str .= self::getTypographyRule($obj->button->typography, 'text-align');
        $str .= "border : ".$obj->button->border->width."px ".$obj->button->border->style;
        $str .= " ".self::getCorrectColor($obj->button->border->color).";";
        $str .= "border-radius : ".$obj->button->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->button->shadow->value * 10);
        $str .= "px ".($obj->button->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->button->shadow->color).";";
        $str .= "background-color: ".self::getCorrectColor($obj->button->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->normal->color).";";
        foreach ($obj->button->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-blog-post-button-wrapper a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->button->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-nav {";
        $str .= self::setItemsVisability(!$obj->view->arrows, "block");
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-nav a {";
        $str .= "font-size: ".$obj->arrows->size."px;";
        $str .= "width: ".$obj->arrows->size."px;";
        $str .= "height: ".$obj->arrows->size."px;";
        $str .= "background-color: ".self::getCorrectColor($obj->arrows->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->arrows->normal->color).";";
        $str .= "padding : ".$obj->arrows->padding."px;";
        $str .= "box-shadow: 0 ".($obj->arrows->shadow->value * 10);
        $str .= "px ".($obj->arrows->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->arrows->shadow->color).";";
        $str .= "border : ".$obj->arrows->border->width."px ".$obj->arrows->border->style;
        $str .= " ".self::getCorrectColor($obj->arrows->border->color).";";
        $str .= "border-radius : ".$obj->arrows->border->radius."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-nav a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->arrows->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->arrows->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-dots {";
        $str .= self::setItemsVisability(!$obj->view->dots, "flex;display: -webkit-flex;");
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-dots > div {";
        $str .= "font-size: ".$obj->dots->size."px;";
        $str .= "width: ".$obj->dots->size."px;";
        $str .= "height: ".$obj->dots->size."px;";
        $str .= "color: ".self::getCorrectColor($obj->dots->normal->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-dots > div:hover,#".$selector." .ba-slideset-dots > div.active {";
        $str .= "color: ".self::getCorrectColor($obj->dots->hover->color).";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getCarouselRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $margin = $obj->gutter ? 30 : 0;
        $margin = $margin * ($obj->slideset->count - 1);
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        if ($obj->overflow) {
            $str .= "#".$selector." .slideshow-content {";
            $str .= "width: calc(100% + (100% / ".$obj->slideset->count.") * 2);";
            $str .= "width: -webkit-calc(100% + (100% / ".$obj->slideset->count.") * 2);";
            $str .= "margin-left: calc((100% / ".$obj->slideset->count.") * -1);";
            $str .= "margin-left: -webkit--calc((100% / ".$obj->slideset->count.") * -1);";
            $str .= "min-height: ".$obj->view->height."px;";
            $str .= "}";
        } else {
            $str .= "#".$selector." .slideshow-content {";
            $str .= "width: 100%;";
            $str .= "margin-left: auto;";
            $str .= "min-height: ".$obj->view->height."px;";
            $str .= "}";
        }
        $str .= "#".$selector." li {";
        $str .= "width: calc((100% - ".$margin."px) / ".$obj->slideset->count.");";
        $str .= "width: -webkit-calc((100% - ".$margin."px) / ".$obj->slideset->count.");";
        $str .= "}";
        $str .= "#".$selector." ul:not(.slideset-loaded) li {";
        $str .= "position: relative; float:left;";
        $str .= "}";
        $str .= "#".$selector." ul:not(.slideset-loaded) li.item.active:not(:first-child) {";
        $str .= "margin-left: ".($obj->gutter ? 30 : 0)."px;";
        $str .= "}";
        foreach ($obj->slides as $key => $value) {
            if (!empty($value->image)) {
                $str .= "#".$selector." li.item:nth-child(".$key.") .ba-slideshow-img {background-image: url(";
                if (strpos($value->image, 'balbooa.com') === false) {
                    $str .= self::$up.str_replace(' ', '%20', $value->image).");";
                } else {
                    $str .= $value->image.");";
                }
                $str .= "}"; 
            }
        }
        $str .= "#".$selector." .ba-slideshow-img {";
        $str .= "background-size :".$obj->view->size.";";
        $str .= "height:".$obj->view->height."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-caption {background-color :";
        if (!isset($obj->overlay->type) || $obj->overlay->type == 'color'){
            $str .= self::getCorrectColor($obj->overlay->color).";";
            $str .= 'background-image: none';
        } else if ($obj->overlay->type == 'none') {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: none;';
        } else {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: '.$obj->overlay->gradient->effect.'-gradient(';
            if ($obj->overlay->gradient->effect == 'linear') {
                $str .= $obj->overlay->gradient->angle.'deg';
            } else {
                $str .= 'circle';
            }
            $str .= ', '.self::getCorrectColor($obj->overlay->gradient->color1).' ';
            $str .= $obj->overlay->gradient->position1.'%, '.self::getCorrectColor($obj->overlay->gradient->color2);
            $str .= ' '.$obj->overlay->gradient->position2.'%);';
            $str .= 'background-attachment: scroll;';
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-title-wrapper {";
        $str .= "text-align :".$obj->title->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-title {";
        $str .= self::getTypographyRule($obj->title->typography, 'text-align');
        foreach ($obj->title->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-description-wrapper {";
        $str .= "text-align :".$obj->description->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-description {";
        $str .= self::getTypographyRule($obj->description->typography, 'text-align');
        foreach ($obj->description->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-button {";
        $str .= "text-align :".$obj->button->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .slideshow-button:not(.empty-content) a {";
        foreach ($obj->button->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= self::getTypographyRule($obj->button->typography, 'text-align');
        $str .= "border : ".$obj->button->border->width."px ";
        $str .= $obj->button->border->style." ".self::getCorrectColor($obj->button->border->color).";";
        $str .= "border-radius : ".$obj->button->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->button->shadow->value * 10);
        $str .= "px ".($obj->button->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->button->shadow->color).";";
        $str .= "background-color: ".self::getCorrectColor($obj->button->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->normal->color).";";
        foreach ($obj->button->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-button a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->button->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-nav {";
        $str .= self::setItemsVisability(!$obj->view->arrows, "block");
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-nav a {";
        $str .= "font-size: ".$obj->arrows->size."px;";
        $str .= "width: ".$obj->arrows->size."px;";
        $str .= "height: ".$obj->arrows->size."px;";
        $str .= "background-color: ".self::getCorrectColor($obj->arrows->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->arrows->normal->color).";";
        $str .= "padding : ".$obj->arrows->padding."px;";
        $str .= "box-shadow: 0 ".($obj->arrows->shadow->value * 10);
        $str .= "px ".($obj->arrows->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->arrows->shadow->color).";";
        $str .= "border : ".$obj->arrows->border->width."px ".$obj->arrows->border->style;
        $str .= " ".self::getCorrectColor($obj->arrows->border->color).";";
        $str .= "border-radius : ".$obj->arrows->border->radius."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-nav a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->arrows->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->arrows->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-dots {";
        $str .= self::setItemsVisability(!$obj->view->dots, "flex;display: -webkit-flex;");
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-dots > div {";
        $str .= "font-size: ".$obj->dots->size."px;";
        $str .= "width: ".$obj->dots->size."px;";
        $str .= "height: ".$obj->dots->size."px;";
        $str .= "color: ".self::getCorrectColor($obj->dots->normal->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideset-dots > div:hover,#".$selector." .ba-slideset-dots > div.active {";
        $str .= "color: ".self::getCorrectColor($obj->dots->hover->color).";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getSlideshowRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        foreach ($obj->slides as $key => $value) {
            if ($value->type == 'image') {
                $str .= "#".$selector." li.item:nth-child(".$key.") .ba-slideshow-img {background-image: url(";
                if (strpos($value->image, 'balbooa.com') === false) {
                    $str .= self::$up.str_replace(' ', '%20', $value->image).");";
                } else {
                    $str .= $value->image.");";
                }
                $str .= "}"; 
            }
        }
        $str .= "#".$selector." .slideshow-wrapper {";
        if ($obj->view->fullscreen) {
            $str .= "min-height: 100vh;";
        } else {
            $str .= "min-height: auto;";
        }
        $str .= "height:".$obj->view->height."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-img {";
        $str .= "background-size :".$obj->view->size.";";
        $str .= "}";
        $str .= "#".$selector." .ba-overlay {background-color :";
        if (!isset($obj->overlay->type) || $obj->overlay->type == 'color'){
            $str .= self::getCorrectColor($obj->overlay->color).";";
            $str .= 'background-image: none';
        } else if ($obj->overlay->type == 'none') {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: none;';
        } else {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: '.$obj->overlay->gradient->effect.'-gradient(';
            if ($obj->overlay->gradient->effect == 'linear') {
                $str .= $obj->overlay->gradient->angle.'deg';
            } else {
                $str .= 'circle';
            }
            $str .= ', '.self::getCorrectColor($obj->overlay->gradient->color1).' ';
            $str .= $obj->overlay->gradient->position1.'%, '.self::getCorrectColor($obj->overlay->gradient->color2);
            $str .= ' '.$obj->overlay->gradient->position2.'%);';
            $str .= 'background-attachment: scroll;';
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-title-wrapper {";
        $str .= "text-align :".$obj->title->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-title {";
        $str .= "animation-duration :".$obj->title->animation->duration."s;";
        $str .= self::getTypographyRule($obj->title->typography, 'text-align');
        $str .= "}";
        $str .= "#".$selector." .slideshow-description-wrapper {";
        $str .= "text-align :".$obj->description->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-description {";
        $str .= "animation-duration :".$obj->description->animation->duration."s;";
        $str .= self::getTypographyRule($obj->description->typography, 'text-align');
        foreach ($obj->description->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-button {";
        $str .= "text-align :".$obj->button->typography->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." .slideshow-button:not(.empty-content) a {";
        $str .= "animation-duration :".$obj->button->animation->duration."s;";
        foreach ($obj->button->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= self::getTypographyRule($obj->button->typography, 'text-align');
        $str .= "border : ".$obj->button->border->width."px ".$obj->button->border->style;
        $str .= " ".self::getCorrectColor($obj->button->border->color).";";
        $str .= "border-radius : ".$obj->button->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->button->shadow->value * 10);
        $str .= "px ".($obj->button->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->button->shadow->color).";";
        $str .= "background-color: ".self::getCorrectColor($obj->button->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->normal->color).";";
        foreach ($obj->button->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .slideshow-button a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->button->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->button->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-nav {";
        $str .= self::setItemsVisability(!$obj->view->arrows, "block");
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-nav a {";
        $str .= "font-size: ".$obj->arrows->size."px;";
        $str .= "width: ".$obj->arrows->size."px;";
        $str .= "height: ".$obj->arrows->size."px;";
        $str .= "background-color: ".self::getCorrectColor($obj->arrows->normal->background).";";
        $str .= "color: ".self::getCorrectColor($obj->arrows->normal->color).";";
        $str .= "padding : ".$obj->arrows->padding."px;";
        $str .= "box-shadow: 0 ".($obj->arrows->shadow->value * 10);
        $str .= "px ".($obj->arrows->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->arrows->shadow->color).";";
        $str .= "border : ".$obj->arrows->border->width."px ".$obj->arrows->border->style;
        $str .= " ".self::getCorrectColor($obj->arrows->border->color).";";
        $str .= "border-radius : ".$obj->arrows->border->radius."px;";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-nav a:hover {";
        $str .= "background-color: ".self::getCorrectColor($obj->arrows->hover->background).";";
        $str .= "color: ".self::getCorrectColor($obj->arrows->hover->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-dots {";
        $str .= self::setItemsVisability(!$obj->view->dots, "flex;display: -webkit-flex;");
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-dots > div {";
        $str .= "font-size: ".$obj->dots->size."px;";
        $str .= "width: ".$obj->dots->size."px;";
        $str .= "height: ".$obj->dots->size."px;";
        $str .= "color: ".self::getCorrectColor($obj->dots->normal->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-slideshow-dots > div:hover,#".$selector." .ba-slideshow-dots > div.active {";
        $str .= "color: ".self::getCorrectColor($obj->dots->hover->color).";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);
        
        return $str;
    }

    public static function getImageRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-image-wrapper {";
        $str .= "text-align: ".$obj->style->align.";}";
        $str .= "#".$selector." img {";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        $str .= "width: ".$obj->style->width."px;";
        $str .= "}";        
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getVideoRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "}";
        $str .= "#".$selector." .ba-video-wrapper {";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        $str .= "padding-bottom: calc(56.24% - ".$obj->border->width."px);";
        $str .= "}";        
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getScrollTopRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        if (isset($obj->margin)) {
            foreach ($obj->margin as $key => $value) {
                $str .= "margin-".$key." : ".$value."px;";
            }
        }
        if (isset($obj->icons->align)) {
            $str .= "text-align : ".$obj->icons->align.";";
        }
        $str .= "}";
        $str .= "#".$selector." i.ba-btn-transition {";
        foreach ($obj->padding as $key => $value) {
            $str .= "padding-".$key." : ".$value."px;";
        }
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        $str .= "border : ".$obj->border->width."px ".$obj->border->style." ".self::getCorrectColor($obj->border->color).";";
        $str .= "border-radius : ".$obj->border->radius."px;";
        $str .= "font-size : ".$obj->icons->size."px;";
        $str .= "width : ".$obj->icons->size."px;";
        $str .= "height : ".$obj->icons->size."px;";
        $str .= "color : ".self::getCorrectColor($obj->normal->color).";";
        $str .= "background-color : ".self::getCorrectColor($obj->normal->{'background-color'}).";";
        $str .= "}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getLogoRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "text-align: ".$obj->{'text-align'}.";";
        $str .= "}";
        $str .= "#".$selector." img {";
        $str .= "width: ".$obj->width."px;}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function getMapRules($obj, $selector)
    {
        $str = "#".$selector." {";
        $str .= self::setItemsVisability($obj->disable, "block");
        foreach ($obj->margin as $key => $value) {
            $str .= "margin-".$key." : ".$value."px;";
        }
        $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
        $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        $str .= "}";
        $str .= "#".$selector." .ba-map-wrapper {";
        $str .= "height: ".$obj->height."px;}";
        $str .= self::setBoxModel($obj, $selector);

        return $str;
    }

    public static function object_extend($obj1, $obj2) {
        $obj = json_encode($obj1);
        $obj = json_decode($obj);
        foreach ($obj2 as $key => $value) {
            if (is_object($value)) {
                if(!isset($obj1->{$key})) {
                    $obj->{$key} = $value;
                } else {
                    $obj->{$key} = self::object_extend($obj1->{$key}, $value);
                }
            } else {
                $obj->{$key} = $value;
            }
        }

        return $obj;
    }

    public static function createRules($obj)
    {
        $str = "";
        self::$editItem = null;
        foreach ($obj as $key => $value) {
            if ($key == 'padding') {
                $str .= "body {";
                foreach ($value as $ind => $val) {
                    $str .= $key.'-'.$ind." : ".$val."px;";
                }
                $str .= "}";
                $str .= ".page-layout {left: calc(100% + ".($value->right + 1);
                $str .= "px); left: -webkit-calc(100% + ".($value->right + 1)."px);}";
            } else if ($key == 'links') {
                $str .= "body a {";
                $str .= "color : ".self::getCorrectColor($value->color).";";
                $str .= "}";
                $str .= "body a:hover {";
                $str .= "color : ".self::getCorrectColor($value->{'hover-color'}).";";
                $str .= "}";
            } else if ($key != 'background' && $key != 'overlay' && $key != 'shadow') {
                $str .= $key;
                if ($key == 'body') {
                    $str .= ' , ul, ol, table, blockquote';
                }
                $str .= " {";
                $str .= self::getTypographyRule($value);
                $str .= "}";
            }
        }
        $str .= 'blockquote { border-color:'.self::getCorrectColor('@primary').'; ';
        $str .= 'background-color: '.self::getCorrectColor('@bg-secondary').';';
        $str .= '}';
        $str .= self::backgroundRule($obj, 'body', '../../../../');
        
        return $str;
    }

    public static function backgroundRule($obj, $selector, $up)
    {
        $str = '';
        $str .= $selector." > .ba-overlay {background-color: ";
        if (!isset($obj->overlay->type) || $obj->overlay->type == 'color'){
            $str .= self::getCorrectColor($obj->overlay->color).";";
            $str .= 'background-image: none';
        } else if ($obj->overlay->type == 'none') {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: none;';
        } else {
            $str .= 'rgba(0, 0, 0, 0);';
            $str .= 'background-image: '.$obj->overlay->gradient->effect.'-gradient(';
            if ($obj->overlay->gradient->effect == 'linear') {
                $str .= $obj->overlay->gradient->angle.'deg';
            } else {
                $str .= 'circle';
            }
            $str .= ', '.self::getCorrectColor($obj->overlay->gradient->color1).' ';
            $str .= $obj->overlay->gradient->position1.'%, '.self::getCorrectColor($obj->overlay->gradient->color2);
            $str .= ' '.$obj->overlay->gradient->position2.'%);';
            $str .= 'background-attachment: scroll;';
        }
        $str .= "}";
        $str .= $selector." > .ba-video-background {display: ";
        if ($obj->background->type == 'video') {
            $str .= 'block';
        } else {
            $str .= 'none';
        }
        $str .= ";}";
        $str .= $selector." {";
        switch ($obj->background->type) {
            case 'image' :
                $image = $obj->background->image->image;
                if (isset($obj->image)) {
                    $image = $obj->image->image;
                }
                if (strpos($image, 'balbooa.com') === false) {
                    $str .= "background-image: url(".$up.str_replace(' ', '%20', $image).");";
                } else {
                    $str .= "background-image: url(".$image.");";
                }
                foreach ($obj->background->image as $key => $value) {
                    if ($key != 'image') {
                        $str .= "background-".$key.": ".$value.";";
                    }
                }
                $str .= "background-color: rgba(0, 0, 0, 0);";
                break;
            case 'color' :
                $str .= "background-color: ".self::getCorrectColor($obj->background->color).";";
                $str .= "background-image: none;";
                break;
            case 'gradient':
                $str .= 'background-image: '.$obj->background->gradient->effect.'-gradient(';
                if ($obj->background->gradient->effect == 'linear') {
                    $str .= $obj->background->gradient->angle.'deg';
                } else {
                    $str .= 'circle';
                }
                $str .= ', '.self::getCorrectColor($obj->background->gradient->color1).' ';
                $str .= $obj->background->gradient->position1.'%, '.self::getCorrectColor($obj->background->gradient->color2);
                $str .= ' '.$obj->background->gradient->position2.'%);';
                $str .= "background-color: rgba(0, 0, 0, 0);";
                $str .= 'background-attachment: scroll;';
                break;
            default :
                $str .= "background-image: none;";
                $str .= "background-color: rgba(0, 0, 0, 0);";
                
        }
        if (isset($obj->shadow)) {
            $str .= "box-shadow: 0 ".($obj->shadow->value * 10);
            $str .= "px ".($obj->shadow->value * 20)."px 0 ".self::getCorrectColor($obj->shadow->color).";";
        }
        $str .= "}";
        
        return $str;
    }

    public static function siteRules($obj)
    {
        $delete = false;
        foreach (self::$breakpoints as $key => $value) {
            if ($value != $obj->{$key}) {
                $delete = true;
                break;
            }
        }
        if (self::$menuBreakpoint != $obj->menuBreakpoint) {
            $delete = true;
        }
        if ($delete) {
            $folder = JPATH_ROOT. '/templates/gridbox/css/storage/';
            $files = JFolder::files($folder);
            foreach ($files as $file) {
                if (strpos($file, 'code-editor') === false && strpos($file, 'index.') === false) {
                    JFile::delete($folder.$file);
                }
            }
        }
        $object = new stdClass();
        $object->id = 1;
        $object->breakpoints = json_encode($obj);
        $db = JFactory::getDbo();
        $db->updateObject('#__gridbox_website', $object, 'id');
        self::$menuBreakpoint = $obj->menuBreakpoint;
        unset($obj->menuBreakpoint);
        self::$breakpoints = $obj;
        $patern = self::getSiteCssPaterns();
        $str = "body:not(.com_gridbox) .body .main-body, .ba-overlay-section-backdrop.horizontal-top";
        $str .= " .ba-overlay-section.ba-container .ba-row-wrapper.ba-container, ";
        $str .= ".ba-overlay-section-backdrop.horizontal-bottom .ba-overlay-section.ba-container ";
        $str .= ".ba-row-wrapper.ba-container, .ba-container:not(.ba-overlay-section) {width: ".self::$website->container."px;}";
        $str .= "\n@media (min-width: ".(self::$breakpoints->tablet + 1)."px) {\n";
        $str .= $patern->desktop;
        $str .= "\n}";
        if (!(bool)self::$website->disable_responsive) {
            $str .= "@media (max-width: ".self::$menuBreakpoint."px) {\n";
            $str .= $patern->menu;
            $str .= "\n}";
            $str .= "\n@media (max-width: ".self::$breakpoints->tablet."px) {\n";
            $str .= $patern->tablet;
            $str .= "}";
            $str .= "\n@media (max-width: ".self::$breakpoints->{'tablet-portrait'}."px) {\n";
            $str .= $patern->tabletPortrait;
            $str .= "\n}";
            $str .= "\n@media (min-width: ".(self::$breakpoints->phone + 1)."px) and (max-width: ".self::$breakpoints->tablet."px){\n";
            $str .= $patern->tabletPhone;
            $str .= "}";
            $str .= "\n@media (max-width: ".self::$breakpoints->phone."px) {\n";
            $str .= $patern->phone;
            $str .= "\n}";
            $str .= "\n@media (max-width: ".self::$breakpoints->{'phone-portrait'}."px) {\n";
            $str .= $patern->phonePortrait;
            $str .= "\n}";
        } else {
            $str .= 'body {min-width: '.self::$website->container.'px;}';
        }
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/responsive.css';
        JFile::write($file, $str);
    }

    public static function themeRules($obj, $id)
    {
        $theme = $obj->params;
        foreach ($obj->footer->items as $value) {
            if ($value->type == 'footer') {
                $footer = $value;
            }
        }
        self::$parentFonts = $footer;
        $str = self::sectionRules($obj->footer->items, '../../../../');
        self::$parentFonts = $theme;
        $str .= self::createRules($theme->desktop);
        $str .= self::setMediaRules($theme, 'body', 'createRules');
        $str .= self::sectionRules($obj->header->items, '../../../../');
        $str .= self::prepareCustomFonts();
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/style-'.$id.'.css';
        JFile::write($file, $str);
    }

    public static function getSiteCssPaterns()
    {
        $obj = new stdClass();
        $obj->menu = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/menu.css');
        $obj->desktop = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/desktop.css');
        $obj->tablet = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/tablet.css');
        $obj->tabletPortrait = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/tablet-portrait.css');
        $obj->phone = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/phone.css');
        $obj->phonePortrait = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/phone-portrait.css');
        $obj->tabletPhone = JFile::read(JPATH_ROOT. '/components/com_gridbox/views/layout/css/tablet-phone.css');

        return $obj;
    }

    public static function returnSystemStyle($doc)
    {
        $str = '';
        foreach ($doc->_scripts as $key => $script) {
            $str .= '<script src="'.$key.'" type="text/javascript"';
            if (isset($script['defer']) && !empty($script['defer'])) {
                $str .= ' defer';
            }
            if (isset($script['async']) && !empty($script['async'])) {
                $str .= ' async';
            }
            $str .= "></script>\n\t";
        }
        foreach ($doc->_script as $key => $script) {
            $str .= '<script type="'.$key.'">'.$script."</script>\n\t";
        }
        foreach ($doc->_styleSheets as $key => $link) {
            $str .= '<link href="'.$key.'" type="text/css"';
            if (isset($script['media']) && !empty($link['media'])) {
                $str .= ' media="'.$link['media'].'"';
            }
            $str .= " rel='stylesheet'>\n\t";
        }
        foreach ($doc->_style as $key => $style) {
            $str .= '<style type="'.$key.'">'.$style."</style>\n\t";
        }

        return $str;
    }

    public static function getSystemParams($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('`#__gridbox_system_pages`')
            ->where('id = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();

        return $obj;
    }

    public static function checkSystemTheme($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, theme')
            ->from('`#__gridbox_system_pages`')
            ->where('id = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__template_styles')
            ->where('`id` = ' .$db->Quote($obj->theme));
        $db->setQuery($query);
        $theme = $db->loadResult();
        if ($theme != $obj->theme) {
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__template_styles')
                ->where('`client_id` = 0')
                ->where('`template` = ' .$db->quote('gridbox'))
                ->where('`home` = 1');
            $db->setQuery($query);
            $default = $db->loadResult();
            if (!$default) {
                $query = $db->getQuery(true)
                    ->select('id')
                    ->from('#__template_styles')
                    ->where('`client_id` = 0')
                    ->where('`template` = ' .$db->quote('gridbox'));
                $db->setQuery($query);
                $default = $db->loadResult();
            }
            $obj->theme = $default;
            $db->updateObject('#__gridbox_system_pages', $obj, 'id');
        }
    }

    public static function checkSystemCss($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('type, items')
            ->from('`#__gridbox_system_pages`')
            ->where('id = '.$id);
        $db->setQuery($query);
        $object = $db->loadObject();
        $type = $object->type;
        $name = str_replace('404', 'error', $type);
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/'.$name.'.css';
        if (!JFile::exists($file)) {
            if (empty($object->items)) {
                $item = new stdClass();
                $item->html = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/system/'.$type.'.php');
                $item->items = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/system/'.$type.'.json');
                $item->id = $id;
                $obj = json_decode($item->items);
            } else {
                $obj = json_decode($object->items);
            }
            self::$fonts = array();
            self::$customFonts = array();
            $str = self::sectionRules($obj, '../../../../');
            $str .= self::prepareCustomFonts();
            JFile::write($file, $str);
            if (empty($object->items)) {
                $item->fonts = json_encode(self::$fonts);
                $item->saved_time = date('H.i.s');
                $db->updateObject('#__gridbox_system_pages', $item, 'id');
            }
        }
    }

    public static function checkPageCss($id)
    {
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/style-'.$id.'.css';
        if (!JFile::exists($file)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                ->select('p.style, p.app_id')
                ->from('`#__gridbox_pages` AS p')
                ->select('a.type')
                ->leftJoin('`#__gridbox_app` AS a'
                    . ' ON '
                    . $db->quoteName('p.app_id')
                    . ' = ' 
                    . $db->quoteName('a.id')
                )
                ->where('p.id = '.$id);
            $db->setQuery($query);
            $app = $db->loadObject();
            $obj = json_decode($app->style);
            self::$fonts = array();
            self::$customFonts = array();
            $str = self::sectionRules($obj, '../../../../../');
            $str .= self::prepareCustomFonts();
            $object = new stdClass();
            $object->id = $id;
            $object->fonts = json_encode(self::$fonts);
            $object->saved_time = date('H.i.s');
            $db->updateObject('#__gridbox_pages', $object, 'id');
            JFile::write($file, $str);
            if (!empty($app->type) == 'blog') {
                self::checkPostCss($app->app_id);
            }
        }
    }

    public static function checkAppCss($id)
    {
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/app-'.$id.'.css';
        if (!JFile::exists($file)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                ->select('app_items')
                ->from('`#__gridbox_app`')
                ->where('id = '.$id);
            $db->setQuery($query);
            $str = $db->loadResult();
            if (empty($str)) {
                $str = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/app.json');
            }
            $obj = json_decode($str);
            if (!isset($obj->{'item-15003687281'})) {
                $obj->{'item-15003687281'} = self::getOptions('category-intro');
                $object = new stdClass();
                $object->app_items = json_encode($obj);
                $object->id = $id;
                $db->updateObject('#__gridbox_app', $object, 'id');
            }
            self::$fonts = array();
            self::$customFonts = array();
            $str = self::sectionRules($obj, '../../../../../');
            $str .= self::prepareCustomFonts();
            $object->id = $id;
            $object->app_fonts = json_encode(self::$fonts);
            $object->saved_time = date('H.i.s');
            $db->updateObject('#__gridbox_app', $object, 'id');
            JFile::write($file, $str);
        }
    }

    public static function checkPostCss($id)
    {
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/post-'.$id.'.css';
        if (!JFile::exists($file)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                ->select('page_items')
                ->from('`#__gridbox_app`')
                ->where('id = '.$id);
            $db->setQuery($query);
            $str = $db->loadResult();
            if (empty($str)) {
                $str = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/default.json');
            }
            $obj = json_decode($str);
            self::$fonts = array();
            self::$customFonts = array();
            $str = self::sectionRules($obj, '../../../../../');
            $str .= self::prepareCustomFonts();
            $object->id = $id;
            $object->page_fonts = json_encode(self::$fonts);
            $object->saved_time = date('H.i.s');
            $db->updateObject('#__gridbox_app', $object, 'id');
            JFile::write($file, $str);
        }
    }

    public static function pageRules($obj, $id)
    {
        $str = self::sectionRules($obj, '../../../../../');
        $str .= self::prepareCustomFonts();
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/style-'.$id.'.css';
        JFile::write($file, $str);
    }

    public static function prepareCustomFonts()
    {
        $str = '';
        if (!is_array(self::$customFonts)) {
            self::$customFonts = array();
        }
        foreach (self::$customFonts as $key => $custom) {
            $url = '';
            foreach ($custom as $weight => $src) {
                $str .= "@font-face {font-family: '".str_replace('+', ' ', $key)."'; ";
                $str .= "font-weight: ".$weight."; ";
                $str .= "src: url(".self::$up."templates/gridbox/library/fonts/".$src.");} ";
            }
        }

        return $str;
    }

    public static function saveAppLayout($obj, $id)
    {
        $db = JFactory::getDbo();
        self::$fonts = array();
        self::$customFonts = array();
        $str = self::sectionRules($obj->style, '../../../../../');
        $str .= self::prepareCustomFonts();
        $object = new stdClass();
        $object->id = $id;
        $object->app_layout = $obj->params;
        $object->title = $obj->title;
        $object->alias = $obj->alias;
        $object->app_items = json_encode($obj->style);
        $object->app_fonts = json_encode(self::$fonts);
        $object->saved_time = date('H.i.s');
        $db->updateObject('#__gridbox_app', $object, 'id');
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/app-'.$object->id.'.css';
        JFile::write($file, $str);
    }

    public static function savePostLayout($obj, $id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('p.app_id')
            ->from('`#__gridbox_pages` AS p')
            ->where('p.id = '.$id);
        $db->setQuery($query);
        self::$fonts = array();
        self::$customFonts = array();
        $str = self::sectionRules($obj->items, '../../../../../');
        $str .= self::prepareCustomFonts();
        $object = new stdClass();
        $object->id = $db->loadResult();
        $object->page_layout = $obj->html;
        $object->page_items = json_encode($obj->items);
        $object->page_fonts = json_encode(self::$fonts);
        $object->saved_time = date('H.i.s');
        $db->updateObject('#__gridbox_app', $object, 'id');
        $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/post-'.$object->id.'.css';
        JFile::write($file, $str);
    }

    public static function saveTheme($obj, $id)
    {
        if (!isset($obj->params->colorVariables)) {
            $obj->params->colorVariables = self::getOptions('color-variables');
        }
        if (!isset($obj->params->presets)) {
            $obj->params->presets = new stdClass();
        }
        if (!isset($obj->params->defaultPresets)) {
            $obj->params->defaultPresets = new stdClass();
        }
        self::$presets = $obj->params->presets;
        self::$colorVariables = $obj->params->colorVariables;
        $folder = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/';
        $files = JFolder::files($folder);
        foreach ($files as $file) {
            if (strpos($file, 'index.') === false) {
                JFile::delete($folder.$file);
            }
        }
        $db = JFactory::getDbo();
        self::$fonts = array();
        self::$customFonts = array();
        self::themeRules($obj, $id);
        $obj->fonts = json_encode(self::$fonts);
        if (isset($obj->params->image)) {
            $obj->image = $obj->params->image;
        }
        $obj->time = date('H.i.s');
        $theme = new stdClass();
        $theme->id = $id;
        $theme->params = json_encode($obj);
        $db->updateObject('#__template_styles', $theme, 'id');
        //self::exportFooter($obj->footer, 'footer');
        //self::exportFooter($obj->header, 'header');
        return $obj->fonts;
    }

    public static function saveSystemPage($obj, $id)
    {
        $db = JFactory::getDbo();
        self::$fonts = array();
        self::$customFonts = array();
        $str = self::sectionRules($obj->style, '../../../../../');
        $str .= self::prepareCustomFonts();
        $type = str_replace('404', 'error', $obj->type);
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/'.$type.'.css';
        JFile::write($file, $str);
        $obj->fonts = json_encode(self::$fonts);
        $obj->saved_time = date('H.i.s');        
        $obj->items = json_encode($obj->style);
        unset($obj->style);
        $obj->html = $obj->params;
        unset($obj->params);
        $db->updateObject('#__gridbox_system_pages', $obj, 'id');
    }

    public static function savePage($obj, $id)
    {
        $db = JFactory::getDbo();
        self::$fonts = array();
        self::$customFonts = array();
        self::pageRules($obj->style, $id);
        $obj->fonts = json_encode(self::$fonts);
        $obj->saved_time = date('H.i.s');
        if (empty($obj->page_alias)) {
            $obj->page_alias = $obj->title;
        }
        $tags = $obj->meta_tags;
        unset($obj->meta_tags);
        $obj->page_alias = self::getAlias($obj->page_alias, '#__gridbox_pages', 'page_alias', $obj->id);
        $obj->style = json_encode($obj->style);
        $db->updateObject('#__gridbox_pages', $obj, 'id');
        self::saveMetaTags($tags, $id);
        //self::exportBlock($id);
    }

    public static function saveMetaTags($tags, $id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, tag_id')
            ->from('#__gridbox_tags_map')
            ->where('`page_id` = '. $id);
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $item) {
            if (!in_array($item->tag_id, $tags)) {
                $query = $db->getQuery(true)
                    ->delete('#__gridbox_tags_map')
                    ->where('id = '.$item->id);
                $db->setQuery($query);
                $db->execute();
            }
        }
        foreach ($tags as $tag) {
            if (!empty($tag)) {
                if (strpos($tag, 'new$') !== false) {
                    $tag = substr($tag, 4);
                    $object = new stdClass();
                    $object->title = $tag;
                    $object->alias = $object->title;
                    $object->alias = self::getAlias($object->alias, '#__gridbox_tags', 'alias');
                    $db->insertObject('#__gridbox_tags', $object);
                    $obj = new stdClass();
                    $obj->page_id = $id;
                    $obj->tag_id = $db->insertid();
                    $db->insertObject('#__gridbox_tags_map', $obj);
                } else {
                    $query = $db->getQuery(true)
                        ->select('id')
                        ->from('#__gridbox_tags_map')
                        ->where('`page_id` = '.$id)
                        ->where('`tag_id` = '.$tag);
                    $db->setQuery($query);
                    $item = $db->loadResult();
                    if (empty($item)) {
                        $obj = new stdClass();
                        $obj->page_id = $id;
                        $obj->tag_id = $tag;
                        $db->insertObject('#__gridbox_tags_map', $obj);
                    }
                }
            }
        }
    }

    public static function exportFooter($obj, $name)
    {
        $config = JFactory::getConfig();
        $file =  $config->get('tmp_path') . '/'.$name.'.json';
        JFile::write($file, json_encode($obj->items));
        $file =  $config->get('tmp_path') . '/'.$name.'.php';
        JFile::write($file, $obj->html);
    }

    public static function exportBlock($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('style, params, title')
            ->from('#__gridbox_pages')
            ->where('`id` = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();
        $object = new stdClass();
        $object->html = $obj->params;
        $object->items = $obj->style;
        $string = json_encode($object);
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $root = $doc->createElement('gridbox');
        $root = $doc->appendChild($root);
        $page = $doc->createElement('data');
        $page = $root->appendChild($page);
        $data = $doc->createTextNode($string);
        $page->appendChild($data);
        $config = JFactory::getConfig();
        $file = $config->get('tmp_path').'/'.$obj->title.'.xml';
        $doc->save($file);
    }

    public static function createGlobalCss()
    {
        $db = JFactory::getDbo();
        $str = '';
        $query = $db->getQuery(true)
            ->select('item')
            ->from('`#__gridbox_library`')
            ->where('`global_item` <> '.$db->quote(''));
        $db->setQuery($query);
        $items = $db->loadObjectList();
        self::$fonts = array();
        self::$customFonts = array();
        foreach ($items as $key => $value) {
            $item = json_decode($value->item);
            $str .= self::sectionRules($item->items, '../../../../');
        }
        $str .= self::prepareCustomFonts();
        $fonts = json_encode(self::$fonts);
        $query = $db->getQuery(true)
            ->update('`#__gridbox_api`')
            ->set('`key` = '.$db->quote($fonts))
            ->where('`service` = '.$db->quote('library_font'));
        $db->setQuery($query)
            ->execute();
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/global-library.css';
        JFile::write($file, $str);
    }

    public static function saveGlobalItems($obj)
    {
        $db = JFactory::getDbo();
        foreach ($obj as $key => $value) {
            $item = json_encode($value);
            $query = $db->getQuery(true)
                ->update('`#__gridbox_library`')
                ->set('`item` = '.$db->quote($item))
                ->where('`global_item` = '.$db->quote($key));
            $db->setQuery($query)
                ->execute();
        }
        self::createGlobalCss();
    }

    public static function getFontUrl()
    {
        if (empty(self::$fonts)) {
            return '';
        }
        $url = '//fonts.googleapis.com/css?family=';
        foreach (self::$fonts as $key => $family) {
            $url .= $key.':';
            foreach ($family as $ind => $weight) {
                $url .= $weight;
                if ($ind != count($family) - 1) {
                    $url .= ',';
                } else {
                    $url .= '%7C';
                }
            }
        }
        $pos = strripos($url, '%7C');
        $url = substr($url, 0, $pos);
        $url .= '&subset=latin,cyrillic,greek,latin-ext,greek-ext,vietnamese,cyrillic-ext';

        return $url;
    }

    public static function saveCodeEditor($obj, $id)
    {
        $file = JPATH_ROOT. '/templates/gridbox/css/storage/code-editor-'.$id.'.css';
        JFile::write($file, $obj->css);
        $file = JPATH_ROOT. '/templates/gridbox/js/storage/code-editor-'.$id.'.js';
        JFile::write($file, $obj->js);
    }

    public static function saveWebsite($obj)
    {
        $obj->id = 1;
        $db = JFactory::getDbo();
        $db->updateObject('#__gridbox_website', $obj, 'id');
    }

    public static function createFavicon()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('favicon')
            ->from('#__gridbox_website')
            ->where('`id` = 1');
        $db->setQuery($query);
        $favicon = $db->loadResult();
        if (!empty($favicon) && JFile::exists(JPATH_ROOT.'/'.$favicon)) {
            JFile::delete(JPATH_ROOT. '/templates/gridbox/favicon.ico');
            JFile::copy(JPATH_ROOT.'/'.$favicon, JPATH_ROOT. '/templates/gridbox/favicon.ico');
        }
    }

    public static function getWebsiteCode()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('header_code, body_code')
            ->from('#__gridbox_website')
            ->where('`id` = 1');
        $db->setQuery($query);
        $result = $db->loadObject();

        return $result;
    }

    public static function getComBa($element)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('extension_id')
            ->from('`#__extensions`')
            ->where('`element` = '.$db->quote($element));
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public static function getContentsCurl($url)
    {
        $http = JHttpFactory::getHttp();
        $body = '';
        $host = 'balbooa.com';
        if ($socket =@ fsockopen($host, 80, $errno, $errstr, 30)) {
            $data = $http->get($url);
            $body = $data->body;
            fclose($socket);
        }
        
        return $body;
    }
    
    public static function parseHttpRequest()
    {
        $input = file_get_contents('php://input');
        $data = array();
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        if (!count($matches)) {
            parse_str(urldecode($input), $data);
            return $data;
        }
        $boundary = $matches[1];
        $blocks = preg_split("/-+$boundary/", $input);
        array_pop($a_blocks);
        foreach ($blocks as $id => $block) {
            if (empty($block))
                continue;
            if (strpos($block, 'application/octet-stream') !== FALSE) {
                preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
                $data['files'][$matches[1]] = $matches[2];
            } else {
                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
                $data[$matches[1]] = $matches[2];
            }
        }
        
        return $data;
    }

    public static function checkPostData()
    {
        if (empty($_POST) && function_exists('file_get_contents') && function_exists('parse_str')) {
            $_POST = self::parseHttpRequest();
        }
    }

    public static function setNewMenuItem()
    {
        $db = JFactory::getDbo();
        $input = JFactory::getApplication()->input;
        $query = $db->getQuery(true)
            ->select('extension_id')
            ->from('`#__extensions`')
            ->where('`element` = '.$db->quote('com_gridbox'))
            ->where('`type` = '.$db->quote('component'));
        $db->setQuery($query);
        $component = $db->loadResult();
        $parent = $input->get('parent', 0, 'int');
        $menu = self::getMenu();
        $object = json_decode($menu);
        $obj = array();
        $obj['title'] = $input->get('title', '', 'string');
        $obj['menutype'] = $object->menutype;
        $alias = $obj['title'];
        $obj['alias'] = self::getNewMenuAlias($alias, '');
        $obj['link'] = $input->get('link', '', 'string');
        $obj['type'] = 'component';
        $obj['published'] = 1;
        $obj['parent_id'] = $parent;
        $obj['component_id'] = $component;
        $obj['access'] = 1;
        $obj['language'] = '*';
        $obj['params'] = '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"",';
        $obj['params'] .= '"show_category":"","link_category":"","show_parent_category":"","link_parent_category":"",';
        $obj['params'] .= '"show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"",';
        $obj['params'] .= '"show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"",';
        $obj['params'] .= '"show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"",';
        $obj['params'] .= '"menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"1","page_heading":"",';
        $obj['params'] .= '"pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}';
        JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_gridbox/tables/');
        $table = JTable::getInstance('Menu', 'gridboxTable', array());
        $table->setLocation($obj['parent_id'], 'last-child');
        $table->bind($obj);
        $table->store();
    }

    public static function setMenuItem()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('extension_id')
            ->from('`#__extensions`')
            ->where('`element` = '.$db->quote('com_gridbox'))
            ->where('`type` = '.$db->quote('component'));
        $db->setQuery($query);
        $component = $db->loadResult();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $parent = $input->get('parent', 0, 'int');
        $obj = array();
        $obj['title'] = $input->get('title', '', 'string');
        $obj['menutype'] = $input->get('menutype', '', 'string');
        $alias = $obj['title'];
        $obj['alias'] = self::getNewMenuAlias($alias, '');
        $edit_type = $input->get('edit_type', '', 'string');
        if (empty($edit_type)) {
            $obj['link'] = 'index.php?option=com_gridbox&view=page&id='.$id;
        } else if ($edit_type == 'blog') {
            $obj['link'] = 'index.php?option=com_gridbox&view=blog&app='.$id.'&id=0';
        }
        $obj['type'] = 'component';
        $obj['published'] = 1;
        $obj['parent_id'] = $parent;
        $obj['component_id'] = $component;
        $obj['access'] = 1;
        $obj['language'] = '*';
        $obj['params'] = '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"",';
        $obj['params'] .= '"show_category":"","link_category":"","show_parent_category":"","link_parent_category":"",';
        $obj['params'] .= '"show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"",';
        $obj['params'] .= '"show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"",';
        $obj['params'] .= '"show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"",';
        $obj['params'] .= '"menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"1","page_heading":"",';
        $obj['params'] .= '"pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}';
        JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_gridbox/tables/');
        $table = JTable::getInstance('Menu', 'gridboxTable', array());
        $table->setLocation($obj['parent_id'], 'last-child');
        $table->bind($obj);
        $table->store();

        return $table->id;
    }

    public static function getNewMenuAlias($type, $orig)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('COUNT(id)')
            ->from('#__menu')
            ->where('`alias` = '.$db->quote($type));
        $db->setQuery($query);
        $n = $db->loadResult();
        if (!empty($n)) {
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
            $type = self::getNewMenuAlias($type, $orig);
        }

        return $type;
    }

    public static function getMenu()
    {
    	$input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('params')
            ->from('#__modules')
            ->where('`id` = '.$id);
        $db->setQuery($query);
        $menu = $db->loadResult();
        $menu = json_decode($menu);
        $obj = new stdClass();
        $obj->menutype = $menu->menutype;
        $obj->items = self::getMenuItems($menu->menutype);
        
        return json_encode($obj);
    }

    public static function getMenuItems($menutype)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title')
            ->from('#__menu')
            ->where('`menutype` = '.$db->quote($menutype));
        $db->setQuery($query);
        $items = $db->loadObjectList();
        
        return $items;
    }

    public static function checkFooter()
    {
        $obj = new stdClass();
        $obj->items = self::getOptions('footer');
        include JPATH_ROOT.'/components/com_gridbox/views/layout/footer.php';
        $obj->html = $out;
        
        return $obj;
    }

    public static function checkHeader()
    {
        $obj = new stdClass();
        $obj->items = self::getOptions('header');
        include JPATH_ROOT.'/components/com_gridbox/views/layout/header.php';
        $obj->html = $out;
        
        return $obj;
    }

    public static function checkGridboxLanguage()
    {
        $language = JFactory::getLanguage();
        $paths = $language->getPaths('com_gridbox');
        if (empty($paths)) {
            $language->load('com_gridbox');
        }
    }

    public static function loadModule()
    {
    	$input = JFactory::getApplication()->input;
        $module = $input->get('module', '', 'string');
        if ($module == 'setCalendar') {
            $data = self::setCalendar();
            $data .= " app.modules.calendar = true;
            if (app.actionStack['calendar']) {
                while (app.actionStack['calendar'].length > 0) {
                    var func = app.actionStack['calendar'].pop();
                    func();
                }
            }";
        } else if($module == 'gridboxLanguage') {
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
        } else if ($module == 'shapeDividers') {
            $shape = self::getShapeObject();
            $data = 'var shapeDividers = '.json_encode($shape).';';
        } else if ($module == 'presetsPatern') {
            $presetsPatern = gridboxHelper::getOptions('presetsPatern');
            $data = 'var presetsPatern = '.json_encode($presetsPatern).';';
        } else {
            $data = JFile::read(JPATH_ROOT.'/components/com_gridbox/libraries/modules/'.$module.'.js');
            $data = str_replace('{uri_root}', JUri::root(), $data);
        }
        return $data;
    }

    public static function getShapeObject()
    {
        $folder = JPATH_ROOT.'/components/com_gridbox/assets/images/shape-dividers/';
        $files = JFolder::files($folder);
        $shape = array();
        foreach ($files as $file) {
            $ext = JFile::getExt($file);
            if ($ext == 'svg') {
                $key = str_replace('.svg', '', $file);
                $shape[$key] = JFile::read($folder.$file);
            }
        }

        return $shape;
    }

    public static function getOptions($type)
    {
        $json = JFile::read(JPATH_ROOT.'/components/com_gridbox/libraries/json/'.$type.'.json');
        
        return json_decode($json);
    }

    public static function createFontString($fonts)
    {
        $html = '';
        foreach ($fonts->items as $key => $font) {
            $str = json_encode($font->variants);
            $str = str_replace('regular', '400', $str);
            $html .= '<li data-style="'.htmlspecialchars($str, ENT_QUOTES).'" data-value="';
            $html .= $font->family.'">'.$font->family.'</li>';
        }
        
        return $html;
    }

    public static function getAccess()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title')
            ->from('#__viewlevels')
            ->order($db->quoteName('ordering') . ' ASC')
            ->order($db->quoteName('title') . ' ASC');
        $db->setQuery($query);
        $array = $db->loadObjectList();
        $access = array();
        foreach ($array as $value) {
            $access[$value->id] = $value->title;
        }

        return $access;
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

    public static function getLanguages()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('lang_code, title')
            ->from('#__languages')
            ->where('published >= 0')
            ->order('title');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        $languages = array();
        $languages['*'] = JText::_('JALL');
        foreach ($items as $key => $value) {
            $languages[$value->lang_code] = $value->title;
        }

        return $languages;
    }

    public static function checkGridboxLoginData()
    {
        if (isset($_COOKIE['gridbox_username'])) {
            $username = $_COOKIE['gridbox_username'];
            self::userLogin($username);
            setcookie('gridbox_username', '', time() - 3600, '/');
        }
    }

    public static function userLogin($username)
    {
        $user = JUser::getInstance();
        $id = (int) JUserHelper::getUserId($username);
        if ($id) {
            $db = JFactory::getDbo();
            $user->load($id);
            $result = $user->authorise('core.login.site');
            if ($result) {
                $user->guest = 0;
                $session = JFactory::getSession();
                $oldSessionId = $session->getId();
                $session->fork();
                $session->set('user', $user);
                $app = JFactory::getApplication();
                $app->checkSession();
                $query = $db->getQuery(true)
                    ->delete('#__session')
                    ->where($db->quoteName('session_id') . ' = ' . $db->quote($oldSessionId));
                try
                {
                    $db->setQuery($query)->execute();
                }
                catch (RuntimeException $e)
                {
                    
                }
                $user->setLastVisit();
                $app->input->cookie->set(
                    'joomla_user_state',
                    'logged_in',
                    0,
                    $app->get('cookie_path', '/'),
                    $app->get('cookie_domain', ''),
                    $app->isHttpsForced(),
                    true
                );
            }
        }
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

    public static function checkMeta()
    {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        $option = $app->input->getCmd('option', '');
        $view = $app->input->getCmd('view', '');
        $edit_type = $app->input->getCmd('edit_type', '');
        $tag = $app->input->getCmd('tag', '');
        $str = '';
        if ($option == 'com_gridbox' && empty($edit_type) && ($view == 'page' || $view == 'gridbox' || $view == 'blog')) {
            $id = $app->input->getCmd('id', 0);
            if ($id == 0 && $view != 'blog') {
                return;
            }
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            if ($view == 'blog') {
                $query->select('title, meta_title, meta_description, image');
                if (!empty($tag)) {
                    $id = $tag;
                    $query->from('#__gridbox_tags');
                } else if ($id != 0) {
                    $query->from('#__gridbox_categories');
                } else {
                    $id = $app->input->getCmd('app', 0);
                    $query->from('#__gridbox_app');
                }
            } else {
                $query->select('title, meta_title, meta_description, intro_image')
                    ->from('#__gridbox_pages');
            }
            $query->where('`id` = '.$id);
            $db->setQuery($query);
            $item = $db->loadObject();
            if ($view == 'blog') {
                $image = $item->image;
            } else {
                $image = $item->intro_image;
            }
            $menus = $app->getMenu();
            $menu = $menus->getActive();
            $title  = $item->meta_title;
            $desc = $item->meta_description;
            if (empty($title)) {
                $title = $item->title;
            }
            if (isset($menu) && $menu->query['view'] == $view && $menu->query['id'] == $id) {
                $params  = $menus->getParams($menu->id);
                $page_title = $params->get('page_title');
                $page_desc = $params->get('menu-meta_description');
            } else {
                $page_title = '';
                $page_desc = '';
                $page_key = '';
            }
            if (!empty($page_title)) {
                $title = $page_title;
            }
            if (!empty($page_desc)) {
                $desc = $page_desc;
            }
            if ($app->get('sitename_pagetitles', 0) == 1) {
                $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
            } else if ($app->get('sitename_pagetitles', 0) == 2) {
                $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
            }
            $path = JPATH_ROOT . '/components/com_bagallery/helpers/bagallery.php';
            JLoader::register('bagalleryHelper', $path);
            $loaded = JLoader::getClassList();
            if (isset($loaded['bagalleryhelper']) && method_exists('bagalleryhelper', 'checkGalleryUri')
                && bagalleryhelper::checkGalleryUri()) {
                echo "\n";
                return;
            }
            $str = "\t<meta property=\"og:title\" content=\"".htmlspecialchars($title, ENT_QUOTES)."\">\n\t";
            $str .= "<meta property=\"og:description\" content=\"".htmlspecialchars($desc, ENT_QUOTES)."\">\n\t";
            $str .= "<meta property=\"og:url\" content=\"".$doc->getBase()."\">\n\t";
            if (!empty($image) && file_exists(JPATH_ROOT.'/'.$image)) {
                $str .= "<meta property=\"og:image\" content=\"".JUri::root().$image."\">\n\t";
                $ext = strtolower(JFile::getExt(JPATH_ROOT.'/'.$image));
                if (self::checkExt($ext)) {
                    $img = new JImage(JPATH_ROOT.'/'.$image);
                    $str .= "<meta property=\"og:image:width\" content=\"".$img->getWidth()."\">\n\t";
                    $str .= "<meta property=\"og:image:height\" content=\"".$img->getHeight()."\">\n";
                }
            } else {
                $str .= "<meta property=\"og:image\" content=\"\">\n";
            }
        }

        return $str;
    }

    public static function checkExt($ext)
    {
        switch($ext) {
            case 'jpg':
            case 'png':
            case 'gif':
            case 'jpeg':
                return true;
            default:
                return false;
        }
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

    public static function getMapsKey()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`')
            ->from('`#__gridbox_api`')
            ->where('`service` = '.$db->quote('google_maps'));
        $db->setQuery($query);
        $key = $db->loadResult();
        return $key;
    }

    public static function checkPlugin($title)
    {
        $default = array('bagallery' => 1, 'baforms' => 1, 'modules' => 1, 'recent-posts' => 1,
            'logo' => 1, 'menu' => 1, 'post-tags' => 1, 'tags' => 1, 'categories' => 1,
            'related-posts' => 1, 'post-navigation' => 1, 'search' => 1, 'recent-posts-slider' => 1);
        if (isset($default[$title])) {
            return 1;
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')
            ->from('#__gridbox_plugins')
            ->where('`title` = ' .$db->quote('ba-'.$title));
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public static function checkMoreScripts($html)
    {
        $doc = JFactory::getDocument();
        if ($doc->getTitle() != 'Gridbox Editor') {
            if (strpos($html, 'ba-item-map')) {
                $key = self::getMapsKey();
                $doc->addScript('https://maps.googleapis.com/maps/api/js?libraries=places&key='.$key);
            }
        }
    }

    public static function getMainMenu()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__modules')
            ->where('client_id = 0')
            ->where('published = 1')
            ->where('module = '.$db->quote('mod_menu'));
        $db->setQuery($query);
        $menu = $db->loadResult();

        return $menu;
    }

    public static function prepareFonts($fonts, $option, $id, $edit_type)
    {
        $app = JFactory::getApplication();
        $view = $app->input->getCmd('view', '');
        if ($view == 'blog' && $edit_type != 'system') {
            $edit_type = 'blog';
            $id = $app->input->getCmd('app', '');
        }
        if ($view != 'page' && $view != 'blog') {
            self::$fonts = array('Roboto' => array(300, 400, 500, 700));
        }
        $fonts = json_decode($fonts);
        self::updateFonts($fonts);
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('`key`')
            ->from('`#__gridbox_api`')
            ->where('`service` = '.$db->quote('library_font'));
        $db->setQuery($query);
        $libraryFonts = $db->loadResult();
        if (!empty($libraryFonts)) {
            $libraryFonts = json_decode($libraryFonts);
            self::updateFonts($libraryFonts);
        }
        if ($option == 'com_gridbox' && empty($edit_type)) {
            $query = $db->getQuery(true)
                ->select('p.fonts')
                ->from('#__gridbox_pages AS p')
                ->where('p.id = '.$id)
                ->select('a.page_fonts')
                ->leftJoin('`#__gridbox_app` AS a'
                    . ' ON '
                    . $db->quoteName('p.app_id')
                    . ' = ' 
                    . $db->quoteName('a.id')
                );
            $db->setQuery($query);
            $pageFonts = $db->loadObject();
            if (!empty($pageFonts->fonts)) {
                $pageFonts->fonts = json_decode($pageFonts->fonts);
                self::updateFonts($pageFonts->fonts);
            }
            if (!empty($pageFonts->page_fonts)) {
                $pageFonts->page_fonts = json_decode($pageFonts->page_fonts);
                self::updateFonts($pageFonts->page_fonts);
            }
        } else if ($edit_type != 'system') {
            $query = $db->getQuery(true)
                ->select('app_fonts')
                ->from('#__gridbox_app')
                ->where('id = '.$id);
            $db->setQuery($query);
            $font = $db->loadResult();
            if (!empty($font)) {
                $font = json_decode($font);
                self::updateFonts($font);
            }
        } else if ($edit_type == 'system') {
            $query = $db->getQuery(true)
                ->select('fonts')
                ->from('#__gridbox_system_pages')
                ->where('id = '.$id);
            $db->setQuery($query);
            $font = $db->loadResult();
            if (!empty($font)) {
                $font = json_decode($font);
                self::updateFonts($font);
            }
        }
        $url = self::getFontUrl();
        
        return $url;
    }

    public static function updateFonts($fonts)
    {
        foreach ($fonts as $key => $font) {
            if (!isset(self::$fonts[$key])) {
                self::$fonts[$key] = array();
            }
            foreach ($font as $weight) {
                if (!in_array($weight, self::$fonts[$key])) {
                    self::$fonts[$key][] = $weight;
                }
            }
        }
    }

    public static function getValidId()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__template_styles')
            ->where('`client_id` = 0')
            ->where('`home` = 1');
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public static function createPageParams($params, $header, $footer, $id)
    {
        if (!isset($params->presets)) {
            $params->presets = new stdClass();
        }
        if (!isset($params->defaultPresets)) {
            $params->defaultPresets = new stdClass();
        }
        self::$presets = $params->presets;
        foreach ($header as $key => $value) {
            self::presetsCompatibility($value);
            self::comparePresets($value);
        }
        foreach ($footer as $key => $value) {
            self::presetsCompatibility($value);
            self::comparePresets($value);
        }
        $library = self::getGlobalItems();
        $array = array('theme' => $params, 'header' => $header,
            'footer' => $footer, 'library' => new stdClass());
        foreach ($library as $value) {
            $globItem = json_decode($value->item);
            foreach ($globItem->items as $key => $glob) {
                self::presetsCompatibility($glob);
                self::comparePresets($glob);
                $array['library']->{$key} = $glob;
            }
        }
        $db = JFactory::getDbo();
        if (!isset($_POST['edit_type']) && $_POST['page']['view'] != 'blog' && $id != 0) {
            $query = $db->getQuery(true)
                ->select('p.style')
                ->from('#__gridbox_pages AS p')
                ->where('p.id = '.$id)
                ->select('a.page_items')
                ->leftJoin('`#__gridbox_app` AS a'
                    . ' ON '
                    . $db->quoteName('p.app_id')
                    . ' = ' 
                    . $db->quoteName('a.id')
                );
            $db->setQuery($query);
            $item = $db->loadObject();
            $page = json_decode($item->style);
            foreach ($page as $key => $value) {
                self::presetsCompatibility($value);
                self::comparePresets($value);
            }
            if (empty($item->page_items) || $item->page_items == null || $item->page_items == 'null') {
                $item->page_items = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/default.json');
            }
            $page_items = json_decode($item->page_items);
            foreach ($page_items as $key => $value) {
                self::presetsCompatibility($value);
                self::comparePresets($value);
                $page->{$key} = $value;
            }
            $array['page'] = $page;
        } else if (isset($_POST['edit_type']) && $_POST['edit_type'] == 'blog') {
            $query = $db->getQuery(true)
                ->select('app_items')
                ->from('#__gridbox_app')
                ->where('id = '.$id);
            $db->setQuery($query);
            $item = $db->loadResult();
            if (empty($item) || $item == null || $item == 'null') {
                $item = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/blog/app.json');
            }
            $page = json_decode($item);
            foreach ($page as $key => $value) {
                self::presetsCompatibility($value);
                self::comparePresets($value);
            }
            $array['page'] = $page;
        } else if (isset($_POST['edit_type']) && $_POST['edit_type'] == 'system') {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                ->select('items, type')
                ->from('#__gridbox_system_pages')
                ->where('id = '.$id);
            $db->setQuery($query);
            $item = $db->loadObject();
            if (empty($item->items)) {
                $item->items = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/system/'.$item->type.'.json');
            }
            $page = json_decode($item->items);
            foreach ($page as $key => $value) {
                self::presetsCompatibility($value);
                self::comparePresets($value);
            }
            $array['page'] = $page;
        }
        $array = json_encode($array);

        return $array;
    }
    
    public static function checkCustom($id, $view, $time)
    {
        $str = '';
        $doc = JFactory::getDocument();
        $file = JPATH_ROOT. '/templates/gridbox/css/custom.css';
        if (JFile::exists($file) && filesize($file) != 0) {
            $file = JUri::root() . 'templates/gridbox/css/custom.css';
            $str .= "\n\t<link rel='stylesheet' href='$file' type='text/css'>";
        }
        $file = JPATH_ROOT.'/templates/gridbox/css/storage/global-library.css';
        if (!JFile::exists($file)) {
            self::createGlobalCss();
        }
        if (filesize($file) != 0) {
            $file = JUri::root() . 'templates/gridbox/css/storage/global-library.css'.$time;;
            $str .= "\n\t<link rel='stylesheet' href='$file' type='text/css'>";
        }
        $db = JFactory::getDbo();
        if ($id == 0) {
            $query = $db->getQuery(true);
            $query->select('id')
                ->from('#__template_styles')
                ->where('`client_id` = 0')
                ->where('`home` = 1');
            $db->setQuery($query);
            $id = $db->loadResult();
        }
        $file = JPATH_ROOT.'/templates/gridbox/css/storage/style-'.$id.'.css';
        if (!JFile::exists($file)) {
            $query = $db->getQuery(true);
            $query->select('params')
                ->from('`#__template_styles`')
                ->where('`id` = ' .$db->quote($id));
            $db->setQuery($query);
            $params = $db->loadResult();
            $params = json_decode($params);
            self::themeRules($params, $id);
        }
        if ($view != 'gridbox' || $doc->getTitle() != 'Gridbox Editor') {
            $file = JPATH_ROOT.'/templates/gridbox/css/storage/code-editor-'.$id.'.css';
            if (JFile::exists($file) && filesize($file) != 0) {
                $file = JUri::root().'templates/gridbox/css/storage/code-editor-'.$id.'.css'.$time;;
                $str .= "\n\t<link rel='stylesheet' href='$file' type='text/css'>";
            }
            $file = JPATH_ROOT.'/templates/gridbox/js/storage/code-editor-'.$id.'.js';
            if (JFile::exists($file) && filesize($file) != 0) {
                $file = JUri::root().'templates/gridbox/js/storage/code-editor-'.$id.'.js'.$time;;
                $str .= "\n\t<script src='$file' type='text/javascript'></script>";
            }
        }

        return $str;
    }
    
    public static function getThemeParams($id)
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('params, id')
            ->from('`#__template_styles`');
        if ($id > 0) {
            $query->where('`id` = ' .$db->quote($id));
        } else {
            $query->where('`client_id` = 0')
                ->where('`template` = '.$db->quote('gridbox'));
        }
        $db->setQuery($query);
        $obj = $db->loadObject();
        $params = json_decode($obj->params);
        if (!isset($params->params)) {
            if (!self::$breakpoints) {
                gridboxHelper::setBreakpoints();
            }
            $params = new stdClass();
            $params->params = self::getOptions('theme');
            $params->footer = self::checkFooter();
            $params->header = self::checkHeader();
            $params->layout = '';
            $params->fonts = self::saveTheme($params, $obj->id);
        }
        if (!isset($params->params->colorVariables)) {
            $params->params->colorVariables = self::getOptions('color-variables');
        }
        if (!isset($params->params->presets)) {
            $params->params->presets = new stdClass();
        }
        if (!isset($params->params->defaultPresets)) {
            $params->params->defaultPresets = new stdClass();
        }
        self::$presets = $params->params->presets;
        self::$colorVariables = $params->params->colorVariables;
        $params = json_encode($params);
        $obj = new Registry;
        $obj->loadString($params);
        
        return $obj;
    }
    
    public static function getTheme($id, $blog = false, $edit_type = '')
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true)
            ->select('theme');
        if ($edit_type == 'system') {
            $query->from('#__gridbox_system_pages');
        } else if (!$blog) {
            $query->from('#__gridbox_pages');
        } else {
            $query->from('#__gridbox_app');
        }
        $query->where('`id` = ' .$db->quote($id));
        $db->setQuery($query);
        $theme = $db->loadResult($id);
        
        return $theme;
    }

    public static function checkMainMenu($body)
    {
        $regex = '/\[main_menu=+(.*?)\]/i';
        $app = JFactory::getApplication();
        $view = $app->input->getCmd('view', '');
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        if ($matches) {
            foreach ($matches as $index => $match) {
                $module = $match[1];
                if (isset($module)) {
                    $db = JFactory::getDBO();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__modules')
                        ->where('client_id = 0')
                        ->where('published = 1')
                        ->where('module = '.$db->quote('mod_menu'))
                        ->where('id = ' . $db->quote($module));
                    $query->order('ordering');
                    $db->setQuery($query);
                    $module = $db->loadObject();
                    $access = self::checkModuleAccess($module);
                    if ($access) {
                        $document = JFactory::getDocument();
                        $document->_type = 'html';
                        $renderer = $document->loadRenderer('module');
                        $html = $renderer->render($module);
                    } else {
                        $html = '';
                    }
                    if (!empty($html) || $view != 'gridbox') {
                        $body = @preg_replace("|\[main_menu=".$match[1]."\]|", $html, $body, 1);
                    }
                }
            }
        }

        return $body;
    }

    public static function checkModuleAccess($module)
    {
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        if (!in_array($module->access, $groups)) {
            return false;
        } else {
            return true;
        }
    }

    public static function clearDOM($body, $items)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
        include_once JPATH_ROOT.'/components/com_gridbox/libraries/php/phpQuery/phpQuery.php';
        $doc = phpQuery::newDocument($body);
        foreach ($items as $key => $item) {
            $access = isset($item->access_view) ? $item->access_view * 1 : 1;
            $user = JFactory::getUser();
            $groups = $user->getAuthorisedViewLevels();
            if (!in_array($access, $groups)) {
                if ($item->type == 'lightbox' || $item->type == 'cookies') {
                    $parent = pq('#'.$key)->parent()->parent()->remove();
                } else {
                    pq('#'.$key)->remove();
                }
            }
        }
        $search = '.ba-edit-item, .ba-box-model, .empty-item, .column-info, .ba-column-resizer,';
        $search .= ' .ba-edit-wrapper, .empty-list';
        foreach (pq($search) as $value) {
            pq($value)->remove();
        }
        foreach (pq('.content-text, .headline-wrapper > *') as $value) {
            pq($value)->removeAttr('contenteditable');
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title')
            ->from('#__gridbox_plugins');
        $db->setQuery($query);
        $result = $db->loadObjectList();
        $array = array('ba-blog-posts', 'ba-post-intro', 'ba-blog-content', 'ba-post-tags', 'ba-search',
            'ba-search-result', 'ba-tags', 'ba-categories', 'ba-recent-posts', 'ba-related-posts',
            'ba-post-navigation', 'ba-category-intro', 'ba-error-message', 'ba-recent-posts-slider');
        foreach ($result as $object) {
            $array[] = str_replace('ba-menu', 'ba-main-menu', $object->title);
        }
        foreach (pq('.ba-item') as $key => $value) {
            $class = pq($value)->attr('class');
            $class = str_replace('-item', '', $class);
            $flag = false;
            $class = explode(' ', $class);
            foreach ($class as $name) {
                if (in_array($name, $array)) {
                    $flag = true;
                }
            }
            if (!$flag) {
                pq($value)->remove();
            }
        }
        foreach (pq('.ba-lightbox-backdrop:not(.ba-item-cookies)') as $key => $value) {
            if (!in_array('ba-lightbox', $array)) {
                pq($value)->remove();
            }
        }
        foreach (pq('.ba-item-cookies') as $key => $value) {
            if (!in_array('ba-cookies', $array)) {
                pq($value)->remove();
            }
        }
        foreach (pq('.ba-item-search-result') as $value) {
            pq($value)->find('.ba-blog-posts-wrapper')->empty();
            pq($value)->find('.ba-blog-posts-pagination-wrapper')->remove();
        }
        $str = $doc->htmlOuter();
        
        return $str;
    }

    public static function checkDOM($html, $obj)
    {
        foreach ($obj as $key => $value) {
            self::presetsCompatibility($value);
            self::comparePresets($value);
        }
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
        include_once JPATH_ROOT.'/components/com_gridbox/libraries/php/phpQuery/phpQuery.php';
        self::$editItem = null;
        $app = JFactory::getApplication();
        $page = new stdClass();
        $input = $app->input;
        $page->option = $input->getCmd('option', 'option');
        $page->view = $input->getCmd('view', 'view');
        $view = $page->view;
        if ($page->option == 'com_gridbox' && $page->view == 'gridbox') {
            $page->view = 'page';
        }
        $page->id = $input->getCmd('id', 'id');
        $dom = phpQuery::newDocument($html);
        $doc = JFactory::getDocument();
        pq('.ba-video-background')->remove();
        pq('.ba-add-section')->remove();
        $slideshow = pq('.ba-item-slideshow');
        $doc->addStyleSheet(JUri::root().'components/com_gridbox/libraries/animation/css/animate.css');
        foreach ($slideshow as $key => $value) {
            $doc->addStyleSheet(JUri::root().'components/com_gridbox/libraries/slideshow/css/animation.css');
            break;
        }
        foreach (pq('.ba-item-headline') as $value) {
            $id = pq($value)->attr('id');
            if (!empty($obj->{$id}->desktop->animation->effect)) {
                $doc->addStyleSheet(JUri::root().'components/com_gridbox/libraries/headline/css/animation.css');
                break;
            }
        }
        foreach (pq('.ba-item-scroll-to-top') as $value) {
            $id = pq($value)->attr('id');
            pq($value)->removeClass('scroll-btn-left');
            pq($value)->removeClass('scroll-btn-right');
            pq($value)->addClass('scroll-btn-'.$obj->{$id}->text->align);
        }
        foreach (pq('.ba-section, .ba-row, .ba-column') as $value) {
            $id = pq($value)->attr('id');
            if (isset($obj->{$id})) {
                if (isset($obj->{$id}->preset) && !empty($obj->{$id}->preset) && isset($obj->{$id}->desktop->shape)) {
                    pq($value)->find(' > .ba-shape-divider')->remove();
                    $shape = self::getShapeObject();
                    $topKeys = array();
                    $bottomKeys = array();
                    if (!empty($obj->{$id}->desktop->shape->bottom->effect)) {
                        $bottomKeys[] = $obj->{$id}->desktop->shape->bottom->effect;
                    }
                    if (!empty($obj->{$id}->desktop->shape->top->effect)) {
                        $topKeys[] = $obj->{$id}->desktop->shape->top->effect;
                    }
                    foreach (self::$breakpoints as $key => $point) {
                        if (isset($obj->{$id}->{$key}) && isset($obj->{$id}->{$key}->shape)) {
                            if (isset($obj->{$id}->{$key}->shape->bottom) && isset($obj->{$id}->{$key}->shape->bottom->effect)) {
                                $bottomKeys[] = $obj->{$id}->{$key}->shape->bottom->effect;
                            }
                            if (isset($obj->{$id}->{$key}->shape->top) && isset($obj->{$id}->{$key}->shape->top->effect)) {
                                $topKeys[] = $obj->{$id}->{$key}->shape->top->effect;
                            }
                        }
                    }
                    if ($count = count($bottomKeys) > 0) {
                        $str = '<div class="ba-shape-divider ba-shape-divider-bottom">';
                        for ($i = 0; $i < $count; $i++) {
                            $str .= $shape[$bottomKeys[$i]] ? $shape[$bottomKeys[$i]] : '';
                        }
                        $str .= '</div>';
                        pq($value)->find('> .ba-overlay')->after($str);
                    }
                    if ($count = count($topKeys) > 0) {
                        $str = '<div class="ba-shape-divider ba-shape-divider-top">';
                        for ($i = 0; $i < $count; $i++) {
                            $str .= $shape[$topKeys[$i]] ? $shape[$topKeys[$i]] : '';
                        }
                        $str .= '</div>';
                        pq($value)->find('> .ba-overlay')->after($str);
                    }
                }
                if ($obj->{$id}->type == 'row') {
                    if ($obj->{$id}->desktop->view->gutter) {
                        pq($value)->removeClass('no-gutter-desktop');
                    } else {
                        pq($value)->addClass('no-gutter-desktop');
                    }
                } else if ($obj->{$id}->type == 'column') {
                    $parent = pq($value)->parent();
                    foreach (self::$breakpoints as $ind => $point) {
                        if (isset($obj->{$id}->{$ind}) && isset($obj->{$id}->{$ind}->span) && isset($obj->{$id}->{$ind}->span->width)) {
                            $name = str_replace('tablet-portrait', 'ba-tb-pt-', $ind);
                            $name = str_replace('tablet', 'ba-tb-la-', $name);
                            $name = str_replace('phone-portrait', 'ba-sm-pt-', $name);
                            $name = str_replace('phone', 'ba-sm-la-', $name);
                            for ($i = 1; $i <= 12; $i++) {
                                pq($parent)->removeClass($name.$i);
                            }
                            pq($parent)->addClass($name.$obj->{$id}->{$ind}->span->width);
                        }
                    }
                }
            }
        }
        foreach (pq('.ba-item-scroll-to .ba-scroll-to') as $value) {
            $id = pq($value)->parent()->attr('id');
            $icon = $obj->{$id}->icon;
            $str = '<div class="ba-button-wrapper"><a class="ba-btn-transition"><span class="empty-textnode">';
            $str .= '</span><i class="'.$obj->{$id}->icon.'"></i></a></div>';
            pq($value)->replaceWith($str);
        }
        foreach (pq('.ba-item-simple-gallery .ba-instagram-image') as $value) {
            $img = pq($value)->find('img');
            $image = pq($img)->attr('data-src');
            if (strpos($image, 'balbooa.com') === false) {
                pq($img)->attr('src', JUri::root().$image);
                pq($value)->attr('style', 'background-image: url('.JUri::root().$image.');');
            }
        }
        foreach (pq('.ba-item-logo') as $key => $value) {
            $id = pq($value)->attr('id');
            $link = $obj->{$id}->link->link;
            if (empty($link)) {
                $link = JUri::root();
            }
            $link = self::prepareGridboxLinks($link);
            pq($value)->find('.ba-logo-wrapper a')->attr('href', $link);
        }
        foreach (pq('.ba-item-image, .ba-item-icon, .ba-item-button') as $key => $value) {
            $id = pq($value)->attr('id');
            $link = $obj->{$id}->link->link;
            if (strpos($link, 'images') === 0) {
                $link = JUri::root().$link;
            }
            $link = self::prepareGridboxLinks($link);
            if ($obj->{$id}->type == 'button') {
                if (empty($link)) {
                    pq($value)->find('a')->attr('onclick', 'return false;');
                } else {
                    pq($value)->find('a')->removeAttr('onclick');
                }
            }
            pq($value)->find('a')->attr('href', $link);
        }
        foreach (pq('.ba-item-slideshow, .ba-item-slideset, .ba-item-carousel') as $value) {
            $id = pq($value)->attr('id');
            $list = $obj->{$id}->desktop->slides;
            pq($value)->find('.slideshow-content')->removeAttr('style');
            pq($value)->find('.slideshow-content > li')->removeAttr('style');
            foreach (pq($value)->find('li.item .slideshow-button a') as $key => $btn) {
                if (isset($list->{$key + 1}->link) && !empty($list->{$key + 1}->link)) {
                    $link = $list->{$key + 1}->link;
                    $link = self::prepareGridboxLinks($link);
                    pq($btn)->attr('href', $link);
                } else {
                    $link = pq($btn)->attr('href');
                    $pos = strpos($link, '/images/');
                    if ($pos !== false) {
                        $link = substr($link, $pos + 1);
                        pq($btn)->attr('href', $link);
                    }
                }
            }
        }
        foreach (pq('.ba-item-one-page-menu') as $value) {
            $itemId = pq($value)->attr('id');
            pq($value)->find('> .ba-menu-backdrop')->remove();
            pq($value)->append('<div class="ba-menu-backdrop"></div>');
            $wrapper = pq($value)->find('.ba-menu-wrapper');
            pq($wrapper)->removeClass('ba-menu-position-left');
            pq($wrapper)->removeClass('ba-hamburger-menu');
            pq($wrapper)->removeClass('ba-menu-position-center');
            if ($obj->{$itemId}->hamburger->enable) {
                pq($wrapper)->addClass('ba-hamburger-menu');
            }
            pq($wrapper)->addClass($obj->{$itemId}->hamburger->position);
        }
        foreach (pq('.ba-item-main-menu') as $value) {
            $menuId = pq($value)->attr('id');
            pq($value)->find('> .ba-menu-backdrop')->remove();
            pq($value)->append('<div class="ba-menu-backdrop"></div>');
            if (!isset($obj->{$menuId}->desktop->dropdown)) {
                $effect = 'fadeInUp';
            } else {
                $effect = $obj->{$menuId}->desktop->dropdown->animation->effect;
            }
            pq($value)->find('ul.nav-child')->addClass($effect);
            if (isset($obj->{$menuId}->items)) {
                foreach ($obj->{$menuId}->items as $key => $item) {
                    $li = pq($value)->find('li.item-'.$key.':first');
                    if (!empty($item->icon)) {
                        pq($li)->find(' > a, > span')->prepend('<i class="ba-menu-item-icon '.$item->icon.'"></i>');
                    }
                    if ($item->megamenu) {
                        pq($li)->addClass('megamenu-item');
                        pq($li)->addClass('deeper');
                        pq($li)->addClass('parent');
                        pq($li)->prepend(pq('#'.$menuId.' .ba-wrapper[data-megamenu="item-'.$key.'"]'));
                    }
                }
            }
            $i = '<i class="zmdi zmdi-caret-right"></i>';
            pq($value)->find('li.deeper.parent')->find('> a, > span')->find('> i.zmdi-caret-right')->remove();
            pq($value)->find('li.deeper.parent')->find('> a, > span')->append($i);
            $wrapper = pq($value)->find(' > .ba-menu-wrapper');
            pq($wrapper)->removeClass('ba-menu-position-left');
            pq($wrapper)->removeClass('ba-hamburger-menu');
            pq($wrapper)->removeClass('ba-menu-position-center');
            pq($wrapper)->removeClass('ba-collapse-submenu');
            if ($obj->{$menuId}->hamburger->enable) {
                pq($wrapper)->addClass('ba-hamburger-menu');
            }
            if ($obj->{$menuId}->hamburger->collapse) {
                pq($wrapper)->addClass('ba-collapse-submenu');
            }
            pq($wrapper)->addClass($obj->{$menuId}->hamburger->position);
        }
        foreach (pq('.ba-item-image, .ba-item-logo') as $value) {
            $img = pq($value)->find('img');
            $src = pq($img)->attr('src');
            if (strpos($src, 'balbooa.com') === false) {
                $img->attr('src', JUri::root().$src);
            }
        }
        $stars = pq('.ba-item-star-ratings');
        foreach ($stars as $value) {
            $id = pq($value)->attr('id');
            list($str, $rating) = self::getStarRatings($id, $page);
            $width = ($rating - floor($rating)) * 100;
            $rating = floor($rating);
            $stars = pq($value)->find('.stars-wrapper i');
            pq($stars)->removeClass('active');
            pq($stars)->removeAttr('style');
            foreach (pq($stars) as $key => $star) {
                if ($key < $rating) {
                    pq($star)->addClass('active');
                    pq($star)->attr('style', '');
                    $last = $star;
                }
            }
            if ($rating == 0) {
                pq($stars)->addClass('active');
            }
            if ($rating != 5 && isset($last)) {
                $next = pq($last)->next();
                $next->attr('style', 'width:'.$width.'%');
            }
            pq($value)->find('.info-wrapper')->replaceWith($str);
        }
        foreach (pq('.ba-item-tags') as $value) {
            $tagsApp = pq($value)->attr('data-app');
            $tagsCat = pq($value)->attr('data-category');
            $tagsLimit = pq($value)->attr('data-limit');
            $str = self::getBlogTags($tagsApp, $tagsCat, $tagsLimit);
            pq($value)->find('.ba-button-wrapper')->html($str);
        }
        foreach (pq('.ba-item-categories') as $value) {
            $catApp = pq($value)->attr('data-app');
            $items = self::getBlogCategories($catApp);
            $str = self::getBlogCategoriesHtml($items);
            pq($value)->find('.ba-categories-wrapper')->html($str);
        }
        foreach (pq('.ba-item-recent-posts') as $value) {
            $application = pq($value)->attr('data-app');
            $sorting = pq($value)->attr('data-sorting');
            $limit = pq($value)->attr('data-count');
            $maximum = pq($value)->attr('data-maximum');
            $category = pq($value)->attr('data-category');
            $id = pq($value)->attr('id');
            self::$editItem = $obj->{$id};
            $str = self::getRecentPosts($application, $sorting, $limit, $maximum, $category);
            pq($value)->find('.ba-blog-posts-wrapper')->html($str);
        }
        foreach (pq('.ba-item-related-posts') as $value) {
            $application = pq($value)->attr('data-app');
            $related = pq($value)->attr('data-related');
            $limit = pq($value)->attr('data-count');
            $maximum = pq($value)->attr('data-maximum');
            $str = self::getRelatedPosts($application, $related, $limit, $maximum);
            pq($value)->find('.ba-blog-posts-wrapper')->html($str);
        }
        foreach (pq('.ba-item-post-navigation') as $value) {
            $maximum = pq($value)->attr('data-maximum');
            $str = self::getPostNavigation($maximum);
            pq($value)->find('.ba-blog-posts-wrapper')->html($str);
        }
        foreach (pq('.ba-edit-item') as $value) {
            pq($value)->attr('style', 'display:none');
        }
        foreach (pq('.ba-item-blog-posts') as $value) {
            $flag = false;
            foreach (pq('.ba-item-category-intro') as $key => $intro) {
                $flag = true;
            }
            if (!$flag){
                $str = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/category-intro.php');
                pq('.ba-item-blog-posts')->before($str);
                $app = $input->getCmd('id', 0);
                if ($view != 'gridbox') {
                    $app = $input->getCmd('app', 0);
                    pq('.ba-edit-item, .ba-box-model')->remove();
                }
                $file = JPATH_ROOT. '/components/com_gridbox/assets/css/storage/app-'.$app.'.css';
                if (JFile::exists($file)) {
                    JFile::delete($file);
                }
            }
        }
        foreach (pq('.ba-item-category-intro') as $key => $intro) {
            $tag = $input->get('tag', '');
            if ($page->id != 0 || !empty($tag)) {
                $str = self::getCategoryIntro();
                pq($intro)->find('.intro-post-wrapper')->html($str);
            } else {
                pq($intro)->remove();
            }
        }
        foreach (pq('.ba-item-instagram') as $key => $value) {
            $id = pq($value)->attr('id');
            $item = $obj->{$id};
            $images = self::getInstagramImages($item, $id);
            pq($value)->find('.instagram-wrapper')->prepend($images);
        }
        foreach (pq('.ba-item-error-message') as $value) {
            $code = '{gridbox_error_code}';
            $message = '{gridbox_error_message}';
            if ($view == 'gridbox') {
                $code = '404';
                $message = JText::_('NOT_FOUND');
            }
            pq($value)->find('.ba-error-code')->text($code);
            pq($value)->find('.ba-error-message')->text($message);
        }
        foreach (pq('.ba-item-recent-posts-slider') as $value) {
            $id = pq($value)->attr('id');
            $application = $obj->{$id}->app;
            $sorting = $obj->{$id}->sorting;
            $limit = $obj->{$id}->limit;
            $maximum = $obj->{$id}->maximum;
            $categories = $obj->{$id}->categories;
            $array = array();
            foreach ($categories as $catId => $cat) {
                $array[] = $catId;
            }
            $category = implode(',', $array);
            self::$editItem = $obj->{$id};
            $str = self::getRecentPosts($application, $sorting, $limit, $maximum, $category);
            pq($value)->find('.slideshow-content')->html($str);
        }
        foreach (pq('.ba-item-blog-posts') as $value) {
            $itemId = pq($value)->attr('id');
            $input = JFactory::getApplication()->input;
            $id = $input->get('id', 0, 'int');
            $category = $input->get('category', 0, 'int');
            $application = $input->get('app', 0, 'int');
            if (!empty($application)) {
                $category = $id;
                $id = $application;
            }
            $start = $input->get('page', 1, 'int');
            $max = $obj->{$itemId}->maximum;
            $limit = $obj->{$itemId}->limit;
            $order = isset($obj->{$itemId}->order) ? $obj->{$itemId}->order : 'created';
            $str = self::getBlogPosts($id, $max, $limit, $start - 1, $category, $order);
            if (empty($str)) {
                $str = self::getEmptyList();
            }
            pq($value)->find('.ba-blog-posts-header')->html('');
            pq($value)->find('.ba-blog-posts-wrapper')->html($str);
            $str = self::getBlogPagination($id, $start - 1, $limit, $category);
            pq($value)->find('.ba-blog-posts-pagination-wrapper')->html($str);
        }

        $str = $dom->htmlOuter();
        
        return $str;
    }

    public static function prepareGridboxLinks($link)
    {
        if (strpos($link, 'option=com_gridbox')) {
            parse_str($link, $array);
            $itemId = null;
            $menus = JFactory::getApplication()->getMenu('site');
            $component = JComponentHelper::getComponent('com_gridbox');
            $attributes = array('component_id');
            $values = array($component->id);
            $items = $menus->getItems($attributes, $values);
            if (!isset($array['app']) && isset($array['blog'])) {
                $array['app'] = $array['blog'];
            }
            if ($array['view'] == 'page') {
                foreach ($items as $item) {
                    if (isset($item->query) && isset($item->query['id']) && isset($item->query['view'])) {
                        if ($item->query['view'] == 'page' && $item->query['id'] == $array['id']) {
                            $itemId .= '&Itemid='.$item->id;
                            break;
                        }
                    }
                }
                if (isset($array['app']) && empty($itemId)) {
                    if (empty($itemId)) {
                        foreach ($items as $value) {
                            if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                                if ($value->query['view'] == 'blog' && $value->query['app'] == $array['app']
                                    && $value->query['id'] == $array['id']) {
                                    $itemId = '&Itemid='.$value->id;
                                    break;
                                }
                            }
                        }
                    }
                    if (empty($itemId)) {
                        foreach ($items as $value) {
                            if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                                if ($value->query['view'] == 'blog' && $value->query['app'] == $array['app']) {
                                    $itemId = '&Itemid='.$value->id;
                                    break;
                                }
                            }
                        }
                    }
                }
            } else if ($array['view'] == 'blog') {
                foreach ($items as $item) {
                    if (isset($item->query) && isset($item->query['id']) && isset($item->query['app'])) {
                        if ($item->query['view'] == 'blog' && $item->query['app'] == $array['app']
                            && $item->query['id'] == $array['id']) {
                            $itemId = '&Itemid='.$item->id;
                            break;
                        }
                    }
                }
                if (empty($itemId)) {
                    foreach ($items as $value) {
                        if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                            if ($value->query['view'] == 'blog' && $value->query['app'] == $array['app']) {
                                $itemId = '&Itemid='.$value->id;
                                break;
                            }
                        }
                    }
                }
            }
            if ($itemId) {
                $link .= $itemId;
            }
        }

        return $link;
    }

    public static function getInstagramImages($item, $id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('`#__gridbox_instagram`')
            ->where('plugin_id = '.$db->quote($id));
        $db->setQuery($query);
        $obj = $db->loadObject();
        $now = strtotime('now');
        if (!$obj || $now - $obj->saved_time >= 3600 || $obj->count != $item->instagram->max
            || $obj->accessToken != $item->instagram->accessToken) {
            $images = self::renderInstagram($item, $id);
            $object = new stdClass();
            $object->plugin_id = $id;
            $object->accessToken = $item->instagram->accessToken;
            $object->count = $item->instagram->max;
            $object->saved_time = $now;
            $object->images = json_encode($images);
            if ($obj) {
                $object->id = $obj->id;
                $db->updateObject('#__gridbox_instagram', $object, 'id');
            } else {
                $db->insertObject('#__gridbox_instagram', $object);
            }
        } else {
            $images = json_decode($obj->images);
        }
        $str = '';
        foreach ($images as $key => $image) {
            $str .= '<div class="ba-instagram-image" style="background-image: url(';
            $str .= $image->images->standard_resolution->url.');" data-key="'.$key.'"><img src="';
            $str .= $image->images->standard_resolution->url.'"><a href="'.$image->link;
            $str .= '" target="_blank"></a><div class="ba-instagram-caption">';
            $str .= '<div class="instagram-icons-wrapper"><span><i class="zmdi zmdi-favorite"></i>';
            $str .= $image->likes->count.'</span><span><i class="zmdi zmdi-comment-text-alt"></i>';
            $str .= $image->comments->count.'</span></div></div></div>';
        }

        return $str;
    }

    public static function renderInstagram($obj, $id)
    {
        
        $userID =  explode('.', $obj->instagram->accessToken);
        $url = 'https://api.instagram.com/v1/users/'.$userID[0].'/media/recent?access_token='.$obj->instagram->accessToken;
        $commentsUrl = 'https://api.instagram.com/v1/media/';
        $http = JHttpFactory::getHttp();
        $data = $http->get($url);
        $body = json_decode($data->body);
        $images = array();
        if (isset($body->data)) {
            $count = count($body->data);
            $max = $obj->instagram->max < $count ? $obj->instagram->max : $count;
            for ($i = 0; $i < $max; $i++) {
                $images[$i] = $body->data[$i];
                $string = $http->get($commentsUrl.$images[$i]->id.'/comments?access_token='.$obj->instagram->accessToken);
                $comments = json_decode($string->body);
                if (isset($comments->data)) {
                    $images[$i]->comments->data = $comments->data;
                }
            }
        }

        return $images;
    }

    public static function getCategoryIntro()
    {
        $app = JFactory::getApplication();
        $input = $app->input;
        $db = JFactory::getDbo();
        $id = $input->get('id', 0, 'int');
        $tag = $input->get('tag', 0, 'int');
        if (!empty($tag)) {
            $id = $tag;
        }
        $str = JFile::read(JPATH_ROOT.'/components/com_gridbox/views/layout/intro-category-wrapper.php');
        if ($input->getCmd('view') == 'gridbox') {
            $obj = new stdClass();
            $obj->title = 'Category Title';
            $obj->description = 'Category Description';
            $obj->image = '';
        } else {
            $query = $db->getQuery(true)
                ->select('title, description, image');
            if (!empty($tag)) {
                $query->from('#__gridbox_tags');
            } else {
                $query->from('#__gridbox_categories');
            }
            $query->where('id = '.$id);
            $db->setQuery($query);
            $obj = $db->loadObject();
        }
        if (empty($obj->image)) {
            $obj->image = 'components/com_gridbox/assets/images/default-theme.png';
        }
        $image = '<div class="intro-post-image-wrapper"><div class="ba-overlay"></div><div class="intro-post-image"';
        $image .= ' style="background-image: url('.$obj->image;
        $image .= ');">';
        $image .= '</div></div>';
        $str = str_replace('[intro-category-image]', $image, $str);
        $str = str_replace('[intro-category-title]', $obj->title, $str);
        $str = str_replace('[intro-category-description]', $obj->description, $str);

        return $str;
    }

    public static function checkModules($body, $items)
    {
        if (!is_object($items)) {
            $obj = json_decode($items);
        } else {
            $obj = $items;
        }
        $body = self::checkGlobalItem($body, $obj);
        $app = JFactory::getApplication();
        $view = $app->input->getCmd('view', '');
        $option = $app->input->getCmd('option', '');
        if ($option != 'com_gridbox' || ($view != 'gridbox' && !empty($view))) {
            $body = self::clearDOM($body, $obj);
        }
        $body = self::checkMainMenu($body);
        $body = self::checkDOM($body, $obj);
        $regex = '/\[modules ID=+(.*?)\]/i';
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        $body = self::checkPostTags($body, $app->input->getCmd('id', 0));
        if ($matches) {
            foreach ($matches as $index => $match) {
                $module = $match[1];
                if (isset($module)) {
                    $db = JFactory::getDBO();
                    $query = $db->getQuery(true)
                        ->select('*')
                        ->from('#__modules')
                        ->where('client_id = 0')
                        ->where('published = 1')
                        ->where('id = ' . $db->quote($module));
                    $query->order('ordering');
                    $db->setQuery($query);
                    $module = $db->loadObject();
                    $access = self::checkModuleAccess($module);
                    if ($access) {
                        $document = JFactory::getDocument();
                        $document->_type = 'html';
                        $renderer = $document->loadRenderer('module');
                        $html = $renderer->render($module);
                    } else {
                        $html = '';
                    }
                    if (!empty($html) || $view != 'gridbox') {
                        $html = str_replace('\\\\', '\\\\\\\\', $html);
                        $body = str_replace($match[0], $html, $body);
                    }
                }
            }
        }
        
        return $body;
    }

    public static function getStarRatings($id, $page)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__gridbox_star_ratings')
            ->where('`plugin_id` = '.$db->quote($id))
            ->where('`option` = '.$db->quote($page->option))
            ->where('`view` = '.$db->quote($page->view))
            ->where('`page_id` = '.$db->quote($page->id));
        $db->setQuery($query);
        $obj = $db->loadObject();
        if (!isset($obj->rating)) {
            $obj = new stdClass();
            $obj->rating = '0.00';
            $obj->count = 0;
        }
        $str = '<div class="info-wrapper" id="star-ratings-'.$id;
        $str .= '" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
        $str .= '<span class="rating-wrapper"><span class="rating-title">'.JText::_('RATING');
        $str .= ' </span><span class="rating-value" itemprop="ratingValue">'.$obj->rating.'</span></span>';
        $str .= '<span class="votes-wrapper"> (<span class="votes-count" itemprop="reviewCount">'.$obj->count;
        $str .= '</span><span class="votes-title"> '.JText::_('VOTES').'</span>)</span></span>';
        $array = array($str, $obj->rating);

        return $array;
    }

    public static function getEmptyList()
    {
        $app = JFactory::getApplication();
        $task = isset($_GET['task']) ? $_GET['task'] : '';
        if (strpos($task, 'editor.') !== false) {
            $app->input->set('view', 'gridbox');
        }
        $view = $app->input->getCmd('view', '');
        $option = $app->input->getCmd('option', '');
        $html = '<div class="empty-list"><i class="zmdi zmdi-alert-polygon"></i><p>';
        $html .= JText::_('NO_ITEMS_HERE').'</p></div>';
        if ($option != 'com_gridbox' || ($view != 'gridbox' && !empty($view))) {
            $html = '';
        }
        

        return $html;
    }

    public static function getBlogPagination($id, $active, $limit, $category)
    {
        $tag = JFactory::getApplication()->input->get('tag', 0, 'int');
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        $url = 'index.php?option=com_gridbox&view=blog';
        $itemId = '';
        foreach ($items as $item) {
            if (isset($item->query) && isset($item->query['id']) && isset($item->query['app'])) {
                if ($item->query['view'] == 'blog' && $item->query['app'] == $id && $item->query['id'] == $category) {
                    $itemId = '&Itemid='.$item->id;
                    break;
                }
            }
        }
        if (!empty($itemId)) {
            $url .= $itemId;
        } else {
            $url .= '&app='.$id.'&id='.$category;
        }
        if (!empty($tag)) {
            $url .= '&tag='.$tag;
        }
        $active = $active * 1;
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from('#__gridbox_pages AS p')
            ->where('p.app_id = '.$id);
        if ($category > 0 && empty($tag)) {
            $categories = self::getBlogPostsChildCategories($category);
            $catStr = (string)$category;
            foreach ($categories as $value) {
                $catStr .= ','.$value->id;
            }
            $query->where('p.page_category in ('.$catStr.')');
        }
        $date = date("Y-m-d H:i:s");
        $nullDate = $db->quote($db->getNullDate());
        $query->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->leftJoin('`#__gridbox_categories` AS c'
                . ' ON '
                . $db->quoteName('p.page_category')
                . ' = ' 
                . $db->quoteName('c.id')
            )
            ->where('c.published = 1')
            ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('c.access in ('.$groups.')');
        if (!empty($tag)) {
            $query->where('t.tag_id = '.$tag)
                ->leftJoin('`#__gridbox_tags_map` AS t'
                    . ' ON '
                    . $db->quoteName('p.id')
                    . ' = ' 
                    . $db->quoteName('t.page_id')
                );
        }
        $db->setQuery($query);
        $count = $db->loadResult();
        if ($count == 0) {
            return '';
        }
        if ($limit == 0) {
            $limit = 1;
        }
        $pages = ceil($count / $limit);
        if ($pages == 1) {
            return '';
        }
        $start = 0;
        $max = $pages;
        if ($active > 2 && $pages > 4) {
            $start = $active - 2;
        }
        if ($pages > 4 && ($pages - $active) < 3) {
            $start = $pages - 5;
        }
        if ($pages > $active + 2) {
            $max = $active + 3;
            if ($pages > 3 && $active < 2) {
                $max = 4;
            }
            if ($pages > 4 && $active < 2) {
                $max = 5;
            }
        }
        include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts-pagination.php';
        
        return $out;
    }

    public static function getBlogPostsChildCategories($id)
    {
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $date = date("Y-m-d H:i:s");
        $nullDate = $db->quote($db->getNullDate());
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__gridbox_categories')
            ->where('published = 1')
            ->where('parent = '.$db->quote($id))
            ->where('language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('access in ('.$groups.')')
            ->order('order_list ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $item) {
            $childs = self::getBlogPostsChildCategories($item->id);
            $items = array_merge($items, $childs);
        }

        return $items;
    }

    public static function getBlogPosts($id, $max, $limit, $start, $category, $order)
    {
        $start *= $limit;
        if ($order == 'order_list') {
            $dir = ' ASC';
        } else {
            $dir = ' DESC';
        }
        $html = '';
        $tag = JFactory::getApplication()->input->get('tag', 0, 'int');
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $query = $db->getQuery(true)
            ->select('p.id, p.title, p.intro_text, p.created, p.hits, p.intro_image, p.page_category, p.app_id')
            ->from('#__gridbox_pages AS p')
            ->where('p.app_id = '.$id);
        if ($category > 0 && empty($tag)) {
            $categories = self::getBlogPostsChildCategories($category);
            $catStr = (string)$category;
            foreach ($categories as $value) {
                $catStr .= ','.$value->id;
            }
            $query->where('p.page_category in ('.$catStr.')');
        }
        $date = date("Y-m-d H:i:s");
        $nullDate = $db->quote($db->getNullDate());
        $query->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.'.$db->quoteName($order).$dir)
            ->select('c.title as category')
            ->leftJoin('`#__gridbox_categories` AS c'
                . ' ON '
                . $db->quoteName('p.page_category')
                . ' = ' 
                . $db->quoteName('c.id')
            )
            ->where('c.published = 1')
            ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('c.access in ('.$groups.')')
            ->select('a.title as blog')
            ->leftJoin('`#__gridbox_app` AS a'
                . ' ON '
                . $db->quoteName('p.app_id')
                . ' = ' 
                . $db->quoteName('a.id')
            );
        if (!empty($tag)) {
            $query->where('t.tag_id = '.$tag)
                ->leftJoin('`#__gridbox_tags_map` AS t'
                    . ' ON '
                    . $db->quoteName('p.id')
                    . ' = ' 
                    . $db->quoteName('t.page_id')
                );
        }
        $db->setQuery($query, $start, $limit);
        $pages = $db->loadObjectList();
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts.php';
        foreach ($pages as $key => $page) {
            $html .= self::getRecentPostsHTML($page, $out, $max, $items);
        }

        return $html;
    }

    public static function checkGlobalItem($body, $items)
    {
        $regex = '/\[global item=+(.*?)\]/i';
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        $db = JFactory::getDBO();
        foreach ($matches as $index => $match) {
            $query = $db->getQuery(true)
                ->select('item')
                ->from('#__gridbox_library')
                ->where('`global_item` = ' . $db->quote($match[1]));
            $db->setQuery($query);
            $obj = $db->loadResult();
            $html = '';
            if (!empty($obj)) {
                $obj = json_decode($obj);
                $html = $obj->html;
                foreach ($obj->items as $key => $value) {
                    $items->{$key} = $obj->items->{$key};
                }
            }
            $body = @preg_replace("|\[global item=".$match[1]."\]|", $html, $body, 1);
        }
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        if (!empty($matches)) {
            $body = self::checkGlobalItem($body, $items);
        }

        return $body;
    }

    public static function getCategoryBreadcrumb($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title, id, parent, app_id')
            ->from('#__gridbox_categories')
            ->where('`id` = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        $catUrl = 'index.php?option=com_gridbox&view=blog';
        $itemId = '';
        foreach ($items as $value) {
            if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                if ($value->query['view'] == 'blog' && $value->query['app'] == $obj->app_id && $value->query['id'] == $id) {
                    $itemId = '&Itemid='.$value->id;
                    break;
                }
            }
        }
        if (!empty($itemId)) {
            return array();
        } else {
            $catUrl .= '&app='.$obj->app_id.'&id='.$id;
        }
        $array1 = array(0 => array ('title' => $obj->title, 'link' => JRoute::_($catUrl)));
        if ($obj->parent != 0) {
            $array2 = self::getCategoryBreadcrumb($obj->parent);
        } else {
            $array2 = array();
        }
        $result = array_merge($array1, $array2);

        return $result;
        
    }

    public static function getCategoryPath($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('alias, app_id, parent')
            ->from('#__gridbox_categories')
            ->where('`id` = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();
        $itemId = null;
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        foreach ($items as $item) {
            if (isset($item->query) && isset($item->query['id']) && isset($item->query['app'])) {
                if ($item->query['view'] == 'blog' && $item->query['app'] == $obj->app_id
                    && $item->query['id'] == $id) {
                    $itemId = '&Itemid='.$item->id;
                    break;
                }
            }
        }
        if ($itemId) {
            return array();
        }
        $array1 = array($obj->alias);
        if ($obj->parent != 0) {
            $array2 = self::getCategoryPath($obj->parent);
        } else {
            $array2 = array();
        }
        $result = array_merge($array1, $array2);
        
        return $result;
    }

    public static function setBlogPageLayout($item, $pageLayout)
    {
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        $catUrl = 'index.php?option=com_gridbox&view=blog';
        $itemId = '';
        foreach ($items as $value) {
            if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                if ($value->query['view'] == 'blog' && $value->query['app'] == $item->app_id
                    && $value->query['id'] == $item->page_category) {
                    $itemId = '&Itemid='.$value->id;
                    break;
                }
            }
        }
        if (!empty($itemId)) {
            $catUrl .= $itemId;
        } else {
            $catUrl .= '&app='.$item->app_id.'&id='.$item->page_category;
        }
        $category = '<i class="zmdi zmdi-label"></i><a href="'.JRoute::_($catUrl).'">'.$item->category_title.'</a>';
        $date = '<i class="zmdi zmdi-time"></i>'.self::getPostDate($item->created);
        $views = '<i class="zmdi zmdi-eye"></i>'.$item->hits;
        if (empty($item->intro_image)) {
            $item->intro_image = 'components/com_gridbox/assets/images/default-theme.png';
        }
        $image = '<div class="intro-post-image-wrapper"><div class="ba-overlay"></div><div class="intro-post-image"';
        $image .= ' style="background-image: url('.$item->intro_image;
        $image .= ');">';
        $app = JFactory::getApplication();
        $view = ($app->input->getCmd('view', ''));
        if ($view == 'gridbox') {
            $image .= '<div class="camera-container"><i class="zmdi zmdi-camera"></i></div>';
        }
        $image .= '</div></div>';
        $pageLayout = str_replace('[intro-post-title]', $item->title, $pageLayout);
        $pageLayout = str_replace('[intro-post-date]', $date, $pageLayout);
        $pageLayout = str_replace('[intro-post-category]', $category, $pageLayout);
        $pageLayout = str_replace('[intro-post-views]', $views, $pageLayout);
        $pageLayout = str_replace('[intro-post-image]', $image, $pageLayout);
        
        return $pageLayout;
    }

    public static function getPostTags($id)
    {
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $query = $db->getQuery(true)
            ->select('m.tag_id as id')
            ->from('#__gridbox_tags_map AS m')
            ->where('m.page_id = '.$id)
            ->select('t.title')
            ->leftJoin('`#__gridbox_tags` AS t'
                . ' ON '
                . $db->quoteName('m.tag_id')
                . ' = ' 
                . $db->quoteName('t.id')
            )
            ->where('t.published = 1')
            ->where('t.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('t.access in ('.$groups.')')
            ->select('p.app_id, p.page_category')
            ->leftJoin('`#__gridbox_pages` AS p'
                . ' ON '
                . $db->quoteName('m.page_id')
                . ' = ' 
                . $db->quoteName('p.id')
            );
        $db->setQuery($query);
        $tags = $db->loadObjectList();
        $html = '';
        if (!empty($tags)) {
            $menus = JFactory::getApplication()->getMenu('site');
            $component = JComponentHelper::getComponent('com_gridbox');
            $attributes = array('component_id');
            $values = array($component->id);
            $items = $menus->getItems($attributes, $values);
            $url = 'index.php?option=com_gridbox&view=blog';
            $itemId = '';
            foreach ($items as $value) {
                if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                    if ($value->query['view'] == 'blog' && $value->query['app'] == $tags[0]->app_id) {
                        $itemId = '&Itemid='.$value->id;
                        break;
                    }
                }
            }
            if (!empty($itemId)) {
                $url .= $itemId;
            } else {
                $url .= '&app='.$tags[0]->app_id.'&id=0';
            }
            foreach ($tags as $tag) {
                $tagUrl = $url.'&tag='.$tag->id;
                $html .= '<a href="'.JRoute::_($tagUrl).'" class="ba-btn-transition"><span>'.$tag->title.'</span></a>';
            }
        }
        if (empty($html)) {
            $html = self::getEmptyList();
        }

        return $html;
    }

    public static function checkPostTags($body, $id)
    {
        $regex = '/\[blog_post_tags\]/i';
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        foreach ($matches as $key => $value) {
            $str = self::getPostTags($id);
            $body = @preg_replace("|\[blog_post_tags\]|", $str, $body, 1);
        }

        return $body;
    }

    public static function getAppId($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('app_id')
            ->from('#__gridbox_pages')
            ->where('id = '.$id);
        $db->setQuery($query);
        $app = $db->loadResult();
        if (empty($app)) {
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__gridbox_app')
                ->where('type = '.$db->quote('blog'))
                ->order('id desc');
            $db->setQuery($query);
            $app = $db->loadResult();
        }

        return $app;
    }

    public static function getBlogTags($id, $category = '', $limit = 0)
    {
        $html = '';
        if (!empty($id)) {
            $db = JFactory::getDbo();
            $user = JFactory::getUser();
            $groups = $user->getAuthorisedViewLevels();
            $groups = implode(',', $groups);
            $query = $db->getQuery(true)
                ->select('DISTINCT t.title, t.id')
                ->from('`#__gridbox_tags` AS t')
                ->where('t.published = 1')
                ->where('t.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('t.access in ('.$groups.')')
                ->order('t.hits desc')
                ->leftJoin('`#__gridbox_tags_map` AS m'
                    . ' ON '
                    . $db->quoteName('m.tag_id')
                    . ' = ' 
                    . $db->quoteName('t.id')
                )
                ->leftJoin('`#__gridbox_pages` AS p'
                    . ' ON '
                    . $db->quoteName('m.page_id')
                    . ' = ' 
                    . $db->quoteName('p.id')
                )
                ->where('p.app_id = '.$id)
                ->where('p.page_category <> '.$db->quote('trashed'));
            if (!empty($category)) {
                $query->where('p.page_category in ('.$category.')');
            }
            $db->setQuery($query, 0, $limit);
            $tags = $db->loadObjectList();
            if (!empty($tags)) {
                $menus = JFactory::getApplication()->getMenu('site');
                $component = JComponentHelper::getComponent('com_gridbox');
                $attributes = array('component_id');
                $values = array($component->id);
                $items = $menus->getItems($attributes, $values);
                $url = 'index.php?option=com_gridbox&view=blog';
                $itemId = '';
                foreach ($items as $value) {
                    if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                        if ($value->query['view'] == 'blog' && $value->query['app'] == $id) {
                            $itemId = '&Itemid='.$value->id;
                            break;
                        }
                    }
                }
                if (!empty($itemId)) {
                    $url .= $itemId;
                } else {
                    $url .= '&app='.$id.'&id=0';
                }
                foreach ($tags as $tag) {
                    $tagUrl = $url.'&tag='.$tag->id;
                    $html .= '<a href="'.JRoute::_($tagUrl).'" class="ba-btn-transition"><span>'.$tag->title.'</span></a>';
                }
            }
        }
        if (empty($html)) {
            $html = self::getEmptyList();
        }

        return $html;
    }

    public static function getBlogCategories($id, $parent = 0)
    {
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $date = date("Y-m-d H:i:s");
        $nullDate = $db->quote($db->getNullDate());
        $query = $db->getQuery(true)
            ->select('id, title, app_id')
            ->from('#__gridbox_categories')
            ->where('published = 1')
            ->where('app_id = '.$db->quote($id))
            ->where('parent = '.$db->quote($parent))
            ->where('language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('access in ('.$groups.')')
            ->order('order_list ASC');
        $db->setQuery($query);
        $items = $db->loadObjectList();
        foreach ($items as $item) {
            $query = $db->getQuery(true)
                ->select('COUNT(id)')
                ->from('`#__gridbox_pages`')
                ->where('page_category = '.$item->id)
                ->where('published = 1')
                ->where('created <= '.$db->quote($date))
                ->where('(end_publishing = '.$nullDate.' OR end_publishing >= '.$db->quote($date).')')
                ->where('language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('page_access in ('.$groups.')');
            $db->setQuery($query);
            $item->count = $db->loadResult();
            $item->childs = self::getBlogCategories($id, $item->id);
            foreach ($item->childs as $child) {
                $item->count += $child->count;
            }
        }

        return $items;
    }

    public static function getBlogCategoriesHtml($categories)
    {
        $html = '<ul>';
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        foreach ($categories as $category) {
            $itemId = '';
            $url = 'index.php?option=com_gridbox&view=blog';
            foreach ($items as $value) {
                if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                    if ($value->query['view'] == 'blog' && $value->query['app'] == $category->app_id
                        && $value->query['id'] == $category->id) {
                        $itemId = '&Itemid='.$value->id;
                        break;
                    }
                }
            }
            if (!empty($itemId)) {
                $url .= $itemId;
            } else {
                $url .= '&app='.$category->app_id.'&id='.$category->id;
            }
            if (empty($itemId)) {
                foreach ($items as $value) {
                    if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                        if ($value->query['view'] == 'blog' && $value->query['app'] == $category->app_id) {
                            $itemId = '&Itemid='.$value->id;
                            break;
                        }
                    }
                }
                $url .= $itemId;
            }
            $html .= '<li class="ba-blog-category"><a href="'.JRoute::_($url).'">'.$category->title;
            $html .= '<span> ('.$category->count.')</span></a>';
            if (!empty($category->childs)) {
                $html .= self::getBlogCategoriesHtml($category->childs);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        if ($html == '<ul></ul>') {
            $html = self::getEmptyList();
        }

        return $html;
    }

    public static function getRecentPosts($id, $sort, $limit, $max, $category = '')
    {
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $date = date("Y-m-d H:i:s");
        $nullDate = $db->quote($db->getNullDate());
        $query = $db->getQuery(true)
            ->select('p.id, p.title, p.intro_text, p.created, p.intro_image, p.page_category, p.app_id')
            ->from('#__gridbox_pages AS p')
            ->where('p.app_id = '.$id)
            ->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.'.$db->quoteName($sort).' desc')
            ->select('c.title as category')
            ->leftJoin('`#__gridbox_categories` AS c'
                . ' ON '
                . $db->quoteName('p.page_category')
                . ' = ' 
                . $db->quoteName('c.id')
            )
            ->where('c.published = 1')
            ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('c.access in ('.$groups.')');
        if (!empty($category)) {
            $query->where('p.page_category in ('.$category.')');
        }
        $db->setQuery($query, 0, $limit);
        $pages = $db->loadObjectList();
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        $html = '';
        if (is_object(self::$editItem) && self::$editItem->type == 'recent-posts-slider') {
            include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts-slider.php';
        } else {
            include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts.php';
        }
        foreach ($pages as $key => $page) {
            $html .= self::getRecentPostsHTML($page, $out, $max, $items, true, false);
        }
        if (empty($html)) {
            $html = self::getEmptyList();
        }

        return $html;
    }

    public static function getRelatedPosts($id, $relate, $limit, $max, $pageId = null)
    {
        if (!$pageId) {
            $app = JFactory::getApplication();
            $pageId = $app->input->get('id', 0, 'int');
            $option = $app->input->getCmd('option', '');
            $view = $app->input->getCmd('view', '');
            if ($option != 'com_gridbox' || $view == 'blog') {
                return '';
            }
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('app_id')
            ->from('#__gridbox_pages')
            ->where('id = '.$pageId);
        $db->setQuery($query);
        $id = $db->loadResult();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $date = date("Y-m-d H:i:s");
        if ($relate == 'tags') {
            $query = $db->getQuery(true)
                ->select('tag_id')
                ->from('#__gridbox_tags_map')
                ->where('page_id = '.$pageId);
            $db->setQuery($query);
            $tags = $db->loadObjectList();
            $array = array();
            if (empty($tags)) {
                return self::getEmptyList();
            }
            foreach ($tags as $tag) {
                $array[] = $tag->tag_id;
            }
            $array = implode(',', $array);
        } else {
            $query = $db->getQuery(true)
                ->select('page_category')
                ->from('#__gridbox_pages')
                ->where('id = '.$pageId);
            $db->setQuery($query);
            $category = $db->loadResult();
            if (empty($category)) {
                return self::getEmptyList();
            }
        }
        $nullDate = $db->quote($db->getNullDate());
        $query = $db->getQuery(true)
            ->select('DISTINCT p.id, p.title, p.intro_text, p.created, p.intro_image, p.page_category, p.app_id')
            ->from('#__gridbox_pages AS p')
            ->where('p.id <> '.$pageId)
            ->where('p.app_id = '.$id)
            ->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.hits desc')
            ->select('c.title as category')
            ->leftJoin('`#__gridbox_categories` AS c'
                . ' ON '
                . $db->quoteName('p.page_category')
                . ' = ' 
                . $db->quoteName('c.id')
            )
            ->where('c.published = 1')
            ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('c.access in ('.$groups.')');
        if ($relate == 'tags') {
            $query->leftJoin('`#__gridbox_tags_map` AS m'
                    . ' ON '
                    . $db->quoteName('p.id')
                    . ' = ' 
                    . $db->quoteName('m.page_id')
                )
                ->where('m.tag_id in('.$array.')')
                ->leftJoin('`#__gridbox_tags` AS t'
                    . ' ON '
                    . $db->quoteName('t.id')
                    . ' = ' 
                    . $db->quoteName('m.tag_id')
                )
                ->where('t.published = 1')
                ->where('t.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('t.access in ('.$groups.')');
        } else {
            $query->where('p.page_category = '.$category);
        }
        $db->setQuery($query, 0, $limit);
        $pages = $db->loadObjectList();
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        $html = '';
        include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts.php';
        foreach ($pages as $key => $page) {
            $html .= self::getRecentPostsHTML($page, $out, $max, $items, true, false);
        }
        if (empty($html)) {
            $html = self::getEmptyList();
        }

        return $html;
    }

    public static function getPostNavigation($max, $id = null)
    {
        if (!$id) {
            $app = JFactory::getApplication();
            $id = $app->input->get('id', 0, 'int');
            $option = $app->input->getCmd('option', '');
            $view = $app->input->getCmd('view', '');
            if ($option != 'com_gridbox' || $view == 'blog') {
                return '';
            }
        }
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $date = date("Y-m-d H:i:s");
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('created, app_id')
            ->from('#__gridbox_pages')
            ->where('id = '.$id);
        $db->setQuery($query);
        $obj = $db->loadObject();
        if (empty($obj->app_id)) {
            return self::getEmptyList();
        }
        $nullDate = $db->quote($db->getNullDate());
        $query = $db->getQuery(true)
            ->select('p.id, p.title, p.intro_text, p.created, p.intro_image, p.page_category, p.app_id')
            ->from('#__gridbox_pages AS p')
            ->where('p.id <> '.$id)
            ->where('p.app_id = '.$obj->app_id)
            ->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('p.created <= '.$db->quote($obj->created))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.created desc')
            ->select('c.title as category')
            ->leftJoin('`#__gridbox_categories` AS c'
                . ' ON '
                . $db->quoteName('p.page_category')
                . ' = ' 
                . $db->quoteName('c.id')
            )
            ->where('c.published = 1')
            ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('c.access in ('.$groups.')');
        $db->setQuery($query);
        $prev = $db->loadObject();
        $query = $db->getQuery(true)
            ->select('p.id, p.title, p.intro_text, p.created, p.intro_image, p.page_category, p.app_id')
            ->from('#__gridbox_pages AS p')
            ->where('p.id <> '.$id)
            ->where('p.app_id = '.$obj->app_id)
            ->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('p.created >= '.$db->quote($obj->created))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.created asc')
            ->select('c.title as category')
            ->leftJoin('`#__gridbox_categories` AS c'
                . ' ON '
                . $db->quoteName('p.page_category')
                . ' = ' 
                . $db->quoteName('c.id')
            )
            ->where('c.published = 1')
            ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('c.access in ('.$groups.')');
        $db->setQuery($query);
        $next = $db->loadObject();
        if (!$next) {
            $query = $db->getQuery(true)
                ->select('p.id, p.title, p.intro_text, p.created, p.intro_image, p.page_category, p.app_id')
                ->from('#__gridbox_pages AS p')
                ->where('p.app_id = '.$obj->app_id)
                ->where('p.page_category <> '.$db->quote('trashed'))
                ->where('p.published = 1')
                ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
                ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('p.page_access in ('.$groups.')')
                ->order('p.created asc')
                ->select('c.title as category')
                ->leftJoin('`#__gridbox_categories` AS c'
                    . ' ON '
                    . $db->quoteName('p.page_category')
                    . ' = ' 
                    . $db->quoteName('c.id')
                )
                ->where('c.published = 1')
                ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('c.access in ('.$groups.')');
            $db->setQuery($query);
            $next = $db->loadObject();
        }
        if (!$prev) {
            $query = $db->getQuery(true)
                ->select('p.id, p.title, p.intro_text, p.created, p.intro_image, p.page_category, p.app_id')
                ->from('#__gridbox_pages AS p')
                ->where('p.app_id = '.$obj->app_id)
                ->where('p.page_category <> '.$db->quote('trashed'))
                ->where('p.published = 1')
                ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
                ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('p.page_access in ('.$groups.')')
                ->order('p.created asc')
                ->select('c.title as category')
                ->leftJoin('`#__gridbox_categories` AS c'
                    . ' ON '
                    . $db->quoteName('p.page_category')
                    . ' = ' 
                    . $db->quoteName('c.id')
                )
                ->where('c.published = 1')
                ->where('c.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
                ->where('c.access in ('.$groups.')');
            $db->setQuery($query);
            $prev = $db->loadObject();
        }
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        $html = '';
        include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts.php';
        if (isset($prev->id)) {
            $html .= '<i class="zmdi zmdi-caret-left"></i>';
            $html .= self::getRecentPostsHTML($prev, $out, $max, $items, true, false);
        }
        if (isset($next->id)) {
            $html .= self::getRecentPostsHTML($next, $out, $max, $items, true, false);
            $html .= '<i class="zmdi zmdi-caret-right"></i>';
        }
        if (empty($html)) {
            $html = self::getEmptyList();
        }
        
        return $html;
    }

    public static function translateMonth($n)
    {
        $month = array(1 => JText::_('JANUARY'), 2 => JText::_('FEBRUARY'), 3 => JText::_('MARCH'),
            4 => JText::_('APRIL'), 5 => JText::_('MAY'), 6 => JText::_('JUNE'),
            7 => JText::_('JULY'), 8 => JText::_('AUGUST'), 9 => JText::_('SEPTEMBER'),
            10 => JText::_('OCTOBER'), 11 => JText::_('NOVEMBER'), 12 =>JText::_('DECEMBER'));

        return $month[$n];
    }

    public static function getPostDate($created)
    {
        $timestamp = strtotime($created);
        $date = date(self::$dateFormat, $timestamp);
        if (strpos(self::$dateFormat, 'F') !== false || strpos(self::$dateFormat, 'M') !== false) {
            $month  = date('n', $timestamp);
            $replace = self::translateMonth($month);
            $search = date('F', $timestamp);
            if (self::$dateFormat == 'M') {
                $replace = substr($replace, 0, 3);
            }
            $date = str_replace($search, $replace, $date);
        }

        return $date;
    }

    public static function getRecentPostsHTML($page, $out, $max, $items, $cat = true, $view = true, $intro = true, $btn = true)
    {
        $url = 'index.php?option=com_gridbox&view=page&blog='.$page->app_id;
        $url .= '&category='.$page->page_category.'&id='.$page->id;
        $itemId = '';
        foreach ($items as $item) {
            if (isset($item->query) && isset($item->query['id']) && isset($item->query['view'])) {
                if ($item->query['view'] == 'page' && $item->query['id'] == $page->id) {
                    $itemId .= '&Itemid='.$item->id;
                    break;
                }
            }
        }
        if (empty($itemId)) {
            foreach ($items as $value) {
                if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                    if ($value->query['view'] == 'blog' && $value->query['app'] == $page->app_id
                        && $value->query['id'] == $page->page_category) {
                        $itemId = '&Itemid='.$value->id;
                        break;
                    }
                }
            }
        }
        if (empty($itemId)) {
            foreach ($items as $value) {
                if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                    if ($value->query['view'] == 'blog' && $value->query['app'] == $page->app_id) {
                        $itemId = '&Itemid='.$value->id;
                        break;
                    }
                }
            }
        }
        if ($page->app_id == 0 || $page->page_category == '') {
            $url = 'index.php?option=com_gridbox&view=page&id='.$page->id;
            foreach ($items as $value) {
                if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                    if ($value->query['view'] == 'page' && $value->query['id'] == $page->id) {
                        $url .= '&Itemid='.$value->id;
                        break;
                    }
                }
            }
        }
        $url = JRoute::_($url.$itemId);
        $imageUrl = empty($page->intro_image) ? 'components/com_gridbox/assets/images/default-theme.png' : $page->intro_image;
        if (strpos($imageUrl, 'balbooa.com') === false) {
            $imageUrl = JUri::root().$imageUrl;
        }
        $date = self::getPostDate($page->created);
        $str = $out;
        if (is_object(self::$editItem) && self::$editItem->type == 'recent-posts-slider') {
            $image = '<div class="ba-slideshow-img" style="background-image: url('.$imageUrl.');"><a href="';
            $image .= $url.'"></a></div>';
        } else {
            $image = '<div class="ba-blog-post-image"><div class="ba-overlay"></div><a href="';
            $image .= $url.'" style="background-image: url('.$imageUrl;
            $image .= ');"></a></div>';
        }
        $dateStr = '<span class="ba-blog-post-date"><i class="zmdi zmdi-time"></i>'.$date.'</span>';
        if ($cat && $page->page_category != '') {
            $catUrl = 'index.php?option=com_gridbox&view=blog';
            $itemId = '';
            foreach ($items as $item) {
                if (isset($item->query) && isset($item->query['id']) && isset($item->query['app'])) {
                    if ($item->query['view'] == 'blog' && $item->query['app'] == $page->app_id
                        && $item->query['id'] == $page->page_category) {
                        $itemId = '&Itemid='.$item->id;
                        break;
                    }
                }
            }
            if (!empty($itemId)) {
                $catUrl .= $itemId;
            } else {
                $catUrl .= '&app='.$page->app_id.'&id='.$page->page_category;
            }
            if (empty($itemId)) {
                foreach ($items as $value) {
                    if (isset($value->query) && isset($value->query['id']) && isset($value->query['app'])) {
                        if ($value->query['view'] == 'blog' && $value->query['app'] == $page->app_id) {
                            $itemId = '&Itemid='.$value->id;
                            break;
                        }
                    }
                }
            }
            $catUrl .= $itemId;
            $catStr = '<span class="ba-blog-post-category"><i class="zmdi zmdi-label"></i><a href="';
            $catStr .= JRoute::_($catUrl).'">'.$page->category.'</a></span>';
        } else {
            $catStr = '';
        }
        if ($view) {
            $viewStr = '<span class="ba-blog-post-views"><i class="zmdi zmdi-eye"></i>'.$page->hits.'</span>';
        } else {
            $viewStr = '';
        }
        if ($intro && mb_strlen($page->intro_text) != 0 && $max != 0) {
            $text = mb_substr($page->intro_text, 0, $max);
            if (mb_strlen($page->intro_text) > $max) {
                $text .= '...';
            }
            $introStr = '<div class="ba-blog-post-intro-wrapper">'.$text.'</div>';
        } else {
            $introStr = '';
        }
        if ($btn) {
            $btnStr = '<div class="ba-blog-post-button-wrapper"><a class="ba-btn-transition" href="';
            $btnStr .= $url.'">'.JText::_('READ_MORE').'</a></div>';
        } else {
            $btnStr = '';
        }
        $titleStr = '<div class="ba-blog-post-title-wrapper"><h3 class="ba-blog-post-title"><a href="'.$url;
        $titleStr .= '">'.$page->title.'</a></h3></div>';
        $str = str_replace('[ba-blog-post-date]', $dateStr, $str);
        $str = str_replace('[ba-blog-post-category]', $catStr, $str);
        $str = str_replace('[ba-blog-post-views]', $viewStr, $str);
        $str = str_replace('[ba-blog-post-intro]', $introStr, $str);
        $str = str_replace('[ba-blog-post-title]', $titleStr, $str);
        $str = str_replace('[ba-blog-post-image]', $image, $str);
        $str = str_replace('[ba-blog-post-btn]', $btnStr, $str);

        return $str;
    }

    public static function getSearchResult($search, $app, $limit, $start, $max)
    {
        $active = $start;
        $start *= $limit;
        $html = '';
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $groups = implode(',', $groups);
        $wheres = array();
        $wheres[] = 'p.title LIKE '.$db->quote('%'.$db->escape($search, true).'%', false);
        $wheres[] = 'p.params LIKE '.$db->quote('%'.$db->escape($search, true).'%', false);
        $date = date("Y-m-d H:i:s");
        $nullDate = $db->quote($db->getNullDate());
        $query = $db->getQuery(true)
            ->select('p.id, p.title, p.created, p.intro_image, p.page_category, p.app_id, p.intro_text')
            ->from('#__gridbox_pages AS p')
            ->where('('.implode(' OR ', $wheres).')')
            ->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.created desc');
        if (!empty($app)) {
            $query->where('p.app_id = '.$app);
        }
        $db->setQuery($query, $start, $limit);
        $pages = $db->loadObjectList();
        $menus = JFactory::getApplication()->getMenu('site');
        $component = JComponentHelper::getComponent('com_gridbox');
        $attributes = array('component_id');
        $values = array($component->id);
        $items = $menus->getItems($attributes, $values);
        include JPATH_ROOT.'/components/com_gridbox/views/layout/blog-posts.php';
        foreach ($pages as $key => $page) {
            if ($page->app_id != 0) {
                $query = $db->getQuery(true)
                    ->select('c.title')
                    ->from('#__gridbox_categories AS c')
                    ->leftJoin('`#__gridbox_pages` AS p'
                        . ' ON '
                        . $db->quoteName('p.page_category')
                        . ' = ' 
                        . $db->quoteName('c.id')
                    )
                    ->where('p.id = '.$page->id);
                $db->setQuery($query);
                $page->category = $db->loadResult();
            }
            $html .= self::getRecentPostsHTML($page, $out, $max, $items, true, false);
        }
        $query = $db->getQuery(true)
            ->select('COUNT(p.id)')
            ->from('#__gridbox_pages AS p')
            ->where('('.implode(' OR ', $wheres).')')
            ->where('p.page_category <> '.$db->quote('trashed'))
            ->where('p.published = 1')
            ->where('p.created <= '.$db->quote($date))
            ->where('(p.end_publishing = '.$nullDate.' OR p.end_publishing >= '.$db->quote($date).')')
            ->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')')
            ->where('p.page_access in ('.$groups.')')
            ->order('p.created desc');
        if (!empty($app)) {
            $query->where('app_id = '.$app);
        }
        $db->setQuery($query);
        $count = $db->loadResult();
        if ($limit == 0) {
            $limit = 1;
        }
        $allPages = ceil($count / $limit);
        if ($count != 0 && $allPages != 1) {
            $start = 0;
            $max = $allPages;
            if ($active > 2 && $allPages > 4) {
                $start = $active - 2;
            }
            if ($allPages > 4 && ($allPages - $active) < 3) {
                $start = $allPages - 5;
            }
            if ($allPages > $active + 2) {
                $max = $active + 3;
                if ($allPages > 3 && $active < 2) {
                    $max = 4;
                }
                if ($allPages > 4 && $active < 2) {
                    $max = 5;
                }
            }
            $prev = $active == 0 ? 1 : $active;
            $next = $active == $allPages - 1 ? $allPages : $active + 2;
            include JPATH_ROOT.'/components/com_gridbox/views/layout/search-result-pagination.php';
            $html .= $out;
        }

        return $html;
    }

    public static function checkMenuItems($menuItems, $itemId)
    {
        $flag = true;
        foreach ($menuItems as $menu) {
            if ($menu->id == $itemId) {
                $flag = false;
                break;
            }
        }

        return $flag;
    }
}