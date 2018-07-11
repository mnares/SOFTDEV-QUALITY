<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class gridboxRouter extends JComponentRouterView
{
    public function build(&$query)
    {
        $segments = array();
        if (!isset($query['Itemid'])) {
            $Itemid = JFactory::getApplication()->input->get('Itemid');
            $menus = JFactory::getApplication()->getMenu('site');
            $menu = $menus->getItem($Itemid);
            if ($menu && $menu->component == 'com_gridbox') {
                $query['Itemid'] = $Itemid;
            }
        }
        if (isset($query['Itemid'])) {
            $app = JFactory::getApplication();
            $menus = $app->getMenu('site');
            $menu = $menus->getItem($query['Itemid']);
            if ($query['option'] == $menu->query['option'] && isset($query['id']) && $query['id'] == $menu->query['id']) {
                if ($query['view'] == 'page') {
                    unset($query['view']);
                    if (isset($query['blog'])) {
                        unset($query['blog']);
                    }
                    if (isset($query['category'])) {
                        unset($query['category']);
                    }
                    unset($query['id']);
                }
            }
        }
        if (isset($query['view']) && ($query['view'] == 'page' || $query['view'] == 'blog')) {
            if (isset($query['view'])) {
                unset($query['view']);
            }
            if (isset($query['tag']) && isset($query['app'])) {
                $db = JFactory::getDbo();
                $q = $db->getQuery(true)
                    ->select('alias')
                    ->from('#__gridbox_app')
                    ->where('id = '.$query['app']);
                $db->setQuery($q);
                $alias = $db->loadResult();
                $segments[] = $alias;
                unset($query['app']);
                unset($query['id']);
                $q = $db->getQuery(true)
                    ->select('alias')
                    ->from('#__gridbox_tags')
                    ->where('`id` = '.$query['tag']);
                $db->setQuery($q);
                $alias = $db->loadResult();
                $segments[] = 'tag';
                $segments[] = $alias;
                unset($query['tag']);
            }
            if (isset($query['app'])) {
                unset($query['app']);
                if (!empty($query['id'])) {
                    $array = gridboxHelper::getCategoryPath($query['id']);
                    $path = array_reverse($array);
                    foreach ($path as $key => $value) {
                        $segments[] = $value;
                    }
                }
                unset($query['id']);
            }
            if (isset($query['blog'])) {
                unset($query['blog']);
            }
            if (isset($query['category'])) {
                $id = $query['category'];
                $array = gridboxHelper::getCategoryPath($id);
                $path = array_reverse($array);
                foreach ($path as $key => $value) {
                    $segments[] = $value;
                }
                unset($query['category']);
            }
            if (isset($query['id'])) {
                $id = $query['id'];
                if (!empty($id)) {
                    $db = JFactory::getDbo();
                    $q = $db->getQuery(true)
                        ->select('page_alias')
                        ->from('#__gridbox_pages')
                        ->where('`id` = '.$id);
                    $db->setQuery($q);
                    $alias = $db->loadResult();
                    $query['id'] = $alias;
                }
                $segments[] = $query['id'];
                unset($query['id']);
            }
            if (isset($query['tag'])) {
                $db = JFactory::getDbo();
                $q = $db->getQuery(true)
                    ->select('alias')
                    ->from('#__gridbox_tags')
                    ->where('`id` = '.$query['tag']);
                $db->setQuery($q);
                $alias = $db->loadResult();
                $segments[] = 'tag';
                $segments[] = $alias;
                unset($query['tag']);
            }
        }
        
        return $segments;
    }

    public function parse(&$segments)
    {
        $tag = '';
        JLoader::register('gridboxHelper', dirname(__FILE__) . '/helpers/gridbox.php');
        foreach ($segments as $value) {
            if ($value == 'tag') {
                $tag = 'tag';
                break;
            }
        }
        $vars = array();
        $db = JFactory::getDbo();
        $alias = end($segments);
        if (!empty($tag)) {
            if ($segments[0] != 'tag') {
                $blog = $segments[0];
            } else {
                $blog = null;
            }
            $vars = getTagsVars($alias, $blog);
            if (!empty($vars)) {
                return $vars;
            }
        }
        $q = $db->getQuery(true)
            ->select('id')
            ->from('#__gridbox_pages')
            ->where('`page_alias` = '.$db->quote($alias));
        $db->setQuery($q);
        $id = $db->loadResult();
        if (!empty($id)) {
            $q = $db->getQuery(true)
                ->select('page_category')
                ->from('#__gridbox_pages')
                ->where('`page_alias` = '.$db->quote($alias));
            $db->setQuery($q);
            $cat = $db->loadResult();
            if (!empty($cat)) {
                $array = gridboxHelper::getCategoryPath($cat);
            } else {
                $array = array();
            }
            $array = array_reverse($array);
            $array[] = $alias;
            foreach ($array as $key => $value) {
                if (!isset($segments[$key]) || $segments[$key] != $value) {
                    $language = JFactory::getLanguage();
                    $language->load('com_gridbox');
                    return JError::raiseError(404, $language->_('NOT_FOUND'));
                }
            }
        }
        if (empty($id)) {
            $q = $db->getQuery(true)
                ->select('id, app_id')
                ->from('#__gridbox_categories')
                ->where('`alias` = '.$db->quote($alias));
            $db->setQuery($q);
            $obj = $db->loadObject();
            $vars['view'] = 'blog';
            if (isset($obj->id)) {
                $id = $obj->id;
                $array = gridboxHelper::getCategoryPath($id);
                $array = array_reverse($array);
                foreach ($array as $key => $value) {
                    if (!isset($segments[$key]) || $segments[$key] != $value) {
                        $language = JFactory::getLanguage();
                        $language->load('com_gridbox');
                        return JError::raiseError(404, $language->_('NOT_FOUND'));
                    }
                }
                $vars['app'] = $obj->app_id;
            } else {
                $vars = getTagsVars($alias);
                if (!empty($vars)) {
                    return $vars;
                }
            }
        } else {
            $vars['view'] = 'page';
        }
        $vars['id'] = $id;

        return $vars;
    }
}

function getTagsVars($alias, $blog = null)
{
    $db = JFactory::getDbo();
    $q = $db->getQuery(true)
        ->select('id')
        ->from('#__gridbox_tags')
        ->where('`alias` = '.$db->quote($alias));
    $db->setQuery($q);
    $id = $db->loadResult();
    $vars = array();
    if (!empty($id)) {
        if ($blog) {
            $q =$db->getQuery(true)
                ->select('id')
                ->from('#__gridbox_app')
                ->where('alias = '.$db->quote($blog));
            $db->setQuery($q);
            $app = $db->loadResult();
            $vars['view'] = 'blog';
            $vars['app'] = $app;
            $vars['id'] = 0;
            $vars['tag'] = $id;

            return $vars;
        }
        $app = JFactory::getApplication();
        $menu = $app->getMenu('site');
        $active = $menu->getActive();
        if (empty($active)) {
            $q = $db->getQuery(true)
                ->select('id')
                ->from('#__gridbox_app')
                ->where('type = '.$db->quote('blog'));
            $db->setQuery($q);
            $app_id = $db->loadResult();
            if (empty($app_id)) {
                return array();
            } else {
                $active = new stdClass();
                $active->query = array('view' => 'blog', 'app' => $app_id, 'id' => 0);
            }
        }
        $query = $active->query;
        if ($query['view'] == 'blog') {
            $vars['view'] = 'blog';
            $vars['app'] = $query['app'];
            $vars['id'] = $query['id'];
            $vars['tag'] = $id;

            return $vars;
        } else if ($query['view'] == 'page') {
            $q = $db->getQuery(true)
                ->select('app_id')
                ->from('#__gridbox_pages')
                ->where('`id` = '.$db->quote($query['id']));
            $db->setQuery($q);
            $app_id = $db->loadResult();
            $vars['view'] = 'blog';
            $vars['app'] = $app_id;
            $vars['id'] = 0;
            $vars['tag'] = $id;

            return $vars;
        }
    }

    return array();
}

function gridboxBuildRoute(&$query)
{
    $app = JFactory::getApplication();
    $router = new gridboxRouter($app, $app->getMenu('site'));

    return $router->build($query);
}

function gridboxParseRoute($segments)
{
    $app = JFactory::getApplication();
    $router = new gridboxRouter($app, $app->getMenu('site'));

    return $router->parse($segments);
}