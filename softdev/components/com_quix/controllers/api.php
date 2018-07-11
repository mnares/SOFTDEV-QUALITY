<?php
/**
 * @version    2.0
 * @package    com_quix
 * @author     ThemeXpert <info@themexpert.com>
 * @copyright  Copyright (C) 2015. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
require JPATH_LIBRARIES . "/quix/vendor/autoload.php";

/**
 * Handle App API request through one controller
 *
 * @since  2.0
 */
class QuixControllerApi extends JControllerLegacy
{
    /*
    * Method to check the image  
    * previous: hasImage
    */
    public function checkImage()
	{
		// Reference global application object
		$app = JFactory::getApplication();

		// JInput object
		$input = $app->input;

		// Requested format passed via URL
		$format = strtolower($input->getWord('format', 'json'));

		// Requested element name
		$path = strtolower($input->get('path', '', 'string'));

		// check if path passed
		if( !$path )
	   	{
	   		$results = new InvalidArgumentException(JText::_('COM_QUIX_NO_ARGUMENT'), 403);
	   	}

		// first check if its from default template
		if ( is_file( PATH_ROOT . $path ) )
		{
			$results = true;
		}
		else
		{
			$results = new InvalidArgumentException(JText::_('COM_QUIX_FILE_NOT_EXISTS'), 404);
		}

		// return result
		echo new JResponseJson($results , null, false, $input->get('ignoreMessages', true, 'bool'));

		$app->close();
	}

    /*
    * Method to encode image or data
    * previous name: base64EncodedJson
    */
	public function encodeBase64Json()
	{
		// Reference global application object
		$app = JFactory::getApplication();
		$input = $app->input;
		$input->post->getArray();

		$post = $input->post->getArray();
		if( !count($post) ) $post = @file_get_contents('php://input');

		// taking posted data 	
		$quix = json_decode($post, true)['quix'];

		// preg matching
		preg_match_all('/([-a-z0-9_\/:.]+\.(jpg|jpeg|png))/i', $quix, $matches);

		$base64EncodedImage= [];

		// looping throw all original images
		// and setuping base64 encoded image
		foreach($matches[0] as $key => $image) {

			$type = $matches[2][$key];

			if(!isset($base64EncodedImage[$image])) {
				$base64EncodedImage[$image] = 'data:image/' . $type . ';base64,' . base64_encode( file_get_contents( $this->getSrcLink($image) ) );
			}
		}

		$originalImages = array_keys($base64EncodedImage);

		// replacing all original images with base64 encoded images
		$replacedImage = str_replace($originalImages, $base64EncodedImage, $quix);

		// return result
		echo new JResponseJson(["config" => $replacedImage], null, false, true);

		$app->close();
	}

	/*
    * Method to encode image or data
    * previous name: base64EncodedJson
    */
	public function exportCollection()
	{
		$app = JFactory::getApplication();
		// Send json mime type.
		$app->mimeType = 'application/json';
		$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
		$app->sendHeaders();
		
		// Check if user token is valid.
		if (!JSession::checkToken('get'))
		{
			$exception = new Exception(JText::_('JINVALID_TOKEN'));
			echo new JResponseJSON($exception);
			$app->close();
		}

		$input = $app->input;
		$id = $input->get('id', '', 'int');
		if(!$id){
			echo new JResponseJSON('No id found!');
			$app->close();
		}
		
		$result = qxGetCollectionById($id);

		// taking posted data 	
		$quix = $result->data;

		// preg matching
		preg_match_all('/([-a-z0-9_\/:.]+\.(jpg|jpeg|png))/i', $quix, $matches);

		$base64EncodedImage= [];

		// looping throw all original images
		// and setuping base64 encoded image
		foreach($matches[0] as $key => $image) {

			$type = $matches[2][$key];

			if(!isset($base64EncodedImage[$image])) {
				$base64EncodedImage[$image] = 'data:image/' . $type . ';base64,' . base64_encode( file_get_contents( $this->getSrcLink($image) ) );
			}
		}

		$originalImages = array_keys($base64EncodedImage);

		// replacing all original images with base64 encoded images
		$replacedImage = str_replace($originalImages, $base64EncodedImage, $quix);

		// return result
		echo new JResponseJson(["config" => $replacedImage], null, false, true);

		$app->close();
	}

	  /**
     * Get image source link
     */
    protected function getSrcLink($src) {
        if(
            preg_match('/^(https?:\/\/)|(http?:\/\/)|(\/\/)|(libraries)|([a-z0-9-].)+(:[0-9]+)(\/.*)?$/', $src)
        ) {
            return $src;
        }

        return \JURI::root() . "images" . $src;
    }

	/**
	 * Gets the parent items of the menu location currently.
	 *
	 * @return  json encoded output and close app
	 *
	 * @since   2.0
	 */
	public function getParentItem()
	{
		JModelLegacy::addIncludePath(JPATH_SITE . '/administrator/components/com_menus/models');
		$app = JFactory::getApplication();

		$results  = array();
		$menutype = $this->input->get->get('menutype');

		if ($menutype)
		{
			$model = $this->getModel('Items', 'MenusModel', array());
			$model->getState();
			$model->setState('filter.menutype', $menutype);
			$model->setState('list.select', 'a.id, a.title, a.level');
			$model->setState('list.start', '0');
			$model->setState('list.limit', '0');

			/** @var  MenusModelItems  $model */
			$results = $model->getItems();

			// Pad the option text with spaces using depth level as a multiplier.
			for ($i = 0, $n = count($results); $i < $n; $i++)
			{
				$results[$i]->title = str_repeat(' - ', $results[$i]->level) . $results[$i]->title;
			}
		}

		// Output a JSON object
		echo json_encode($results);

		$app->close();
	}

    /**
	 * Method to create menu.
	 *
	 * @return  json result
	 *
	 * @since   2.0
	 */
	public function createMenu()
	{
		// Check for request forgeries.
		// echo JSession::getFormToken();die;
		JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		JModelLegacy::addIncludePath(JPATH_SITE . '/administrator/components/com_menus/models');
		JTable::addIncludePath(JPATH_SITE . '/administrator/components/com_menus/tables');
		$app = JFactory::getApplication();
		$title = $app->input->post->get('title', '', 'string');
		if(empty($title)){
			echo new JResponseJson(new Exception('Title required'));
			$app->close();
			return;
		}

		$alias = $app->input->post->get('alias');

		$menu = $app->input->post->get('menu');
		if(empty($menu)){
			echo new JResponseJson(new Exception('Menu selection is required!'));
			$app->close();
			return;
		}

		$parentid = $app->input->post->get('parentid');
		if(empty($parentid)){
			echo new JResponseJson(new Exception('Select menu parant!'));
			$app->close();
			return;
		}
		
		
		$link = $app->input->post->get('link', '', 'string', 'raw');
		$component_id = JComponentHelper::getComponent('com_quix')->id; // update it
		$language = '*';
		$published = 1;
		$type = 'component';

		$data = ['id' => '', 'link'=> $link,'parent_id' => $parentid, 'menutype' => $menu, 'title' => $title, 'alias' => $alias,
				'type' => $type, 'published' => $published, 'language' => $language, 'component_id' => $component_id

			];
		$model = $this->getModel('Item', 'MenusModel', array());
		
		try{
			if($model->save($data)){
				$Itemid = $model->getState('item.id');
				$link = JRoute::_($link . (parse_url($link, PHP_URL_QUERY) ? '&' : '?') . 'Itemid=' . $Itemid);
				echo new JResponseJson(['Itemid' => $Itemid, 'link' => $link]);
			}
			else{
				echo new JResponseJson(new Exception($model->getError()));
			}
		}catch(Exception $e) {
			echo new JResponseJson($e);
		}
		$app->close();
	}

    /**
	 * Method to handle file manager operation
	 *
	 * @return  object
	 *
	 * @since   2.0
	 */
	function uploadMedia()
	{
		// Check for request forgeries.
		JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		(new \FileManager\FileManager(__DIR__ . '/../filemanager/config.php'));
        exit;
	}

    /**
	 * get Icons pack, store it and return the content
	 *
	 * @return  object
	 *
	 * @since   2.0
	 */
	function getIcons()
	{
		// $profiler = new JProfiler();

		$app = JFactory::getApplication();
		// Send json mime type.
		$app->mimeType = 'application/json';
		$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
		$app->sendHeaders();
		
		// Check if user token is valid.
		if (!JSession::checkToken('get'))
		{
			$exception = new Exception(JText::_('JINVALID_TOKEN'));
			echo new JResponseJSON($exception);
			$app->close();
		}

		// now call the cache		
		$cache = new JCache(['defaultgroup'=>'quix', 'cachebase' => JPATH_SITE . DIRECTORY_SEPARATOR . 'cache']);
		$cacheid = 'QuixFlatIcons30';
		$cache->setCaching(true);
		$cache->setLifeTime(2592000);  //24 hours 86400// 30days 2592000

		// return from cache
		$output = $cache->get($cacheid);

		// if no cache, read from file
		if(empty($output)){
			// this will check local files, if not found will call from server 
			$output = QuixFrontendHelper::getFlatIconsfromLocal();
			// store to cache
			$cache->store( $output, $cacheid );
		}

		// response json
		echo $output;
		
		// close the output
		$app->close();
	}

	function getTemplates()
	{
		$app = JFactory::getApplication();
		// Send json mime type.
		$app->mimeType = 'application/json';
		$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
		$app->sendHeaders();
		
		// Check if user token is valid.
		// if (!JSession::checkToken('get'))
		// {
		// 	$exception = new Exception(JText::_('JINVALID_TOKEN'));
		// 	echo new JResponseJSON($exception);
		// 	$app->close();
		// }

		$source = $app->input->get('source', 'local');
		$type = $app->input->get('type', '');

		// return from cache
		
		if($source == 'local'){
			$result = qxGetCollections(false, 'frontend', $type);
			$output = json_encode($result);
		}
		else
		{
			// online from getquix
			$output = qxGetBlocks();
		}

		// response json
		echo $output;
		
		// close the output
		$app->close();
	}

	function getTemplate()
	{
		$app = JFactory::getApplication();
		// Send json mime type.
		$app->mimeType = 'application/json';
		$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
		$app->sendHeaders();
		
		// Check if user token is valid.
		if (!JSession::checkToken('get'))
		{
			$exception = new Exception(JText::_('JINVALID_TOKEN'));
			echo new JResponseJSON($exception);
			$app->close();
		}

		$id = $app->input->get('id');
		$result = qxGetCollectionById($id);
		$output = json_encode($result);

		// response json
		echo $output;
		
		// close the output
		$app->close();
	}
	
	function getJoomlaModule()
	{
		$app = JFactory::getApplication();
		// Send json mime type.
		$app->mimeType = 'application/json';
		$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
		$app->sendHeaders();
		
		// Check if user token is valid.
		if (!JSession::checkToken('get'))
		{
			$exception = new Exception(JText::_('JINVALID_TOKEN'));
			echo new JResponseJSON($exception);
			$app->close();
		}

		$id = $app->input->get('id');
		$style = $app->input->get('style');

		if( empty($id) ){
			echo '';
			$app->close();
		}
		
		$db = \JFactory::getDBo();
		$query = $db->getQuery( true );
		$query->select( '*' )
				->from( '#__modules' )
				->where( 'published = ' . 1 )
				->where( 'id = ' . $id );
		$db->setQuery( $query );
		$module = $db->loadObject();
        
		$mparams = json_decode($module->params);
		$params = array( 'style' => ( isset($mparams->style) ? $mparams->style : $style) );
		$enabled = \JModuleHelper::isEnabled( $module->module);

		$result = "";

		if($enabled){
			$moduleinfo = \JModuleHelper::getModule( $module->module, $module->title );
			$info = (object) array_merge((array) $moduleinfo, (array) $module);
			
			$result = \JModuleHelper::renderModule( $info, $params );
		}

		$output = json_encode($result);

		// response json
		echo $output;
		
		// close the output
		$app->close();
	}

	function getWebFonts()
	{
		$app = JFactory::getApplication();
		// Send json mime type.
		$app->mimeType = 'application/json';
		$app->setHeader('Content-Type', $app->mimeType . '; charset=' . $app->charSet);
		$app->sendHeaders();
		
		// Check if user token is valid.
		if (!JSession::checkToken('get'))
		{
			$exception = new Exception(JText::_('JINVALID_TOKEN'));
			echo new JResponseJSON($exception);
			$app->close();
		}

		// now call the cache		
		$cache = new JCache(['defaultgroup'=>'quix', 'cachebase' => JPATH_SITE . DIRECTORY_SEPARATOR . 'cache']);
		$cacheid = 'QuixWebFonts30';
		$cache->setCaching(true);
		$cache->setLifeTime(2592000);  //24 hours 86400// 30days 2592000

		// return from cache
		$output = $cache->get($cacheid);

		// if no cache, read from file
		if(empty($output)){
			// this will check local files, if not found will call from server 
			$output = QuixFrontendHelper::getGoogleFontsJSONfromLocal();
			// store to cache
			$cache->store( $output, $cacheid );
		}

		// response json
		echo $output;
		
		// close the output
		$app->close();
	}
}
