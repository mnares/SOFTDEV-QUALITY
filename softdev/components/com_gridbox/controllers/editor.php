<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class gridboxControllerEditor extends JControllerForm
{
    public function getModel($name = 'Editor', $prefix = 'gridboxModel', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}

    public function getsavedInstagramMedia()
    {
        $model = $this->getModel();
        $model->getsavedInstagramMedia();
    }

    public function deleteMenuItem()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->deleteMenuItem();
        exit;
    }

    public function saveMenuItemTitle()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->saveMenuItemTitle();
        exit;
    }

    public function sortMenuItems()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->sortMenuItems();
        exit;
    }

    public function getSiteCssObjeck()
    {
        $obj = gridboxHelper::getSiteCssPaterns();
        $str = json_encode($obj);
        echo $str;exit;
    }

    public function setLibraryImage()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->setLibraryImage();
    }

    public function getSearchResult()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $search = strip_tags($input->get('search', '', 'string'));
        $app = $input->get('app', 0, 'int');
        $limit = $input->get('limit', 0, 'int');
        $start = $input->get('start', 0 , 'int');
        $maximum = $_POST['maximum'];
        $html = '<h6 class="search-result-title">'.JText::_('SEARCH_RESULTS_FOR').' '.$search.'</h6>';
        $str = gridboxHelper::getSearchResult($search, $app, $limit, $start, $maximum);
        if (empty($str) || empty($search)) {
        	$str = '<div class="empty-list"><i class="zmdi zmdi-search-replace"></i><p>'.JText::_('NOTHING_FOUND').'</p></div>';
        }
        $html .= $str;
        echo($html);exit();
    }

    public function getPostNavigation()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $maximum = $input->get('maximum', 0, 'int');
        gridboxHelper::$editItem = null;
        $str = gridboxHelper::getPostNavigation($maximum, $id);
        echo $str;exit;
    }

    public function getRelatedPosts()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $app = $input->get('app', 0, 'int');
        $related = $input->get('related');
        $limit = $input->get('limit', 0, 'int');
        $maximum = $input->get('maximum', 0, 'int');
        gridboxHelper::$editItem = null;
        $str = gridboxHelper::getRelatedPosts($app, $related, $limit, $maximum, $id);
        echo $str;exit;
    }

    public function getRecentPosts()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $sorting = $input->get('sorting');
        $limit = $input->get('limit', 0, 'int');
        $maximum = $input->get('maximum', 0, 'int');
        $category = $input->get('category', 0, 'int');
        gridboxHelper::$editItem = null;
        $str = gridboxHelper::getRecentPosts($id, $sorting, $limit, $maximum, $category);
        echo $str;exit;
    }

    public function getRecentPostsSlider()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $sorting = $input->get('sorting');
        $limit = $input->get('limit', 0, 'int');
        $maximum = $input->get('maximum', 0, 'int');
        $category = $input->get('category', 0, 'int');
        gridboxHelper::$editItem = new stdClass();
        gridboxHelper::$editItem->type = 'recent-posts-slider';
        $str = gridboxHelper::getRecentPosts($id, $sorting, $limit, $maximum, $category);
        echo $str;exit;
    }

    public function getBlogCategories()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $items = gridboxHelper::getBlogCategories($id);
        $str = gridboxHelper::getBlogCategoriesHtml($items);
        echo $str;exit;
    }

    public function getBlogTags()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $category = $input->get('category', 0, 'int');
        $limit = $input->get('limit', 0, 'int');
        $str = gridboxHelper::getBlogTags($id, $category, $limit);
        echo $str;exit;
    }

    public function getPageTags()
    {
        $model = $this->getModel();
        $tags = $model->getPageTags();
        echo json_encode($tags);
        exit;
    }

    public function checkProductTour()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->checkProductTour();
    }

    public function getUserAuthorisedLevels()
    {
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
        $obj = json_encode($groups);
        echo $obj;
        exit;
    }

    public function getLibraryItems()
    {
        $model = $this->getModel();
        $obj = $model->getLibraryItems();
        $obj->global = JText::_('GLOBAL_ITEM');
        $obj->delete = JText::_('DELETE');
        $obj = json_encode($obj);
        echo $obj;
        exit;
    }

    public function getBlogPosts()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $max = $input->get('max', 0, 'int');
        $limit = $input->get('limit', 0, 'int');
        $order = $input->get('order', 'created', 'string');
        echo gridboxHelper::getBlogPosts($id, $max, $limit, 0, 0, $order);
        exit;
    }
    public function getBlogPagination()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $max = $input->get('max', 0, 'int');
        $limit = $input->get('limit', 0, 'int');
        echo gridboxHelper::getBlogPagination($id, 0, $limit, 0);
        exit;
    }

    public function getItems()
    {
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $theme = $input->get('theme', 0, 'int');
        $gridbox = gridboxHelper::getThemeParams($theme);
        $params = $gridbox->get('params');
        $params->image = $gridbox->get('image', '');
        $footer = $gridbox->get('footer');
        $header = $gridbox->get('header');
        $pageParams = gridboxHelper::createPageParams($params, $header->items, $footer->items, $id);
        echo $pageParams;
        exit;
    }

    public function setStarRatings()
    {
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $result = $model->setStarRatings();
        echo json_encode($result);
        exit;
    }

    public function getLibrary()
    {
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->getLibrary();
    }

    public function addLibrary()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->addLibrary();
    }

    public function removeLibrary()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->removeLibrary();
    }

    public function gridboxSave()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->gridboxSave();
    }

    public function checkMainMenu()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->checkMainMenu();
    }

    public function getWeatherLang()
    {
        $model = $this->getModel();
        $model->getWeatherLang();
    }

    public function getInstagramLang()
    {
        $model = $this->getModel();
        $model->getInstagramLang();
    }

    public function setMapsKey()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->setMapsKey();
    }

    public function getBlocksLicense()
    {
        gridboxHelper::checkUserEditLevel();
        $model = $this->getModel();
        $model->getBlocksLicense();
    }

    public function getPluginLicense()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->getPluginLicense();
    }

    public function setNewMenuItem()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        gridboxHelper::setNewMenuItem();
        exit;
    }

    public function setMenuItem()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        gridboxHelper::setMenuItem();
        exit;
    }

    public function getMenu()
    {
        gridboxHelper::checkPostData();
        $menu = gridboxHelper::getMenu();
        echo $menu;
        exit;
    }

    public function getMenuItems()
    {
        gridboxHelper::checkUserEditLevel();
        gridboxHelper::checkPostData();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        $menu = gridboxHelper::getMenuItems($id);
        echo json_encode($menu);
        exit;
    }

    public function loadModule()
    {
        gridboxHelper::checkPostData();
        echo gridboxHelper::loadModule();
        exit;
    }

    public function loadLayout()
    {
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->loadLayout();
    }

    public function loadPlugin()
    {
        gridboxHelper::checkPostData();
        $model = $this->getModel();
        $model->loadPlugin();
    }
}