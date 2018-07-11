<?php
/**
* @package		Quix
* @copyright	Copyright (C) 2010 - 2017 ThemeXpert.com. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Quix is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

require_once(dirname(__FILE__) . '/controller.php');

class iQuixControllerInstallation extends iQuixSetupController
{

	public function cleanCache()
	{
		jimport('joomla.filesystem.file');
	    jimport('joomla.filesystem.folder');
	    jimport('joomla.filesystem.path');

	    $cssfiles =  (array) JFolder::files(JPATH_ROOT . '/media/quix/css');
		array_map(
			function ($file) {
				if($file == 'index.html') return;
				JFile::delete(JPATH_ROOT . '/media/quix/css/'. $file);
			}, 
			$cssfiles
		);

	    $jsfiles = (array) JFolder::files(JPATH_ROOT . '/media/quix/js');		
		array_map(
			function ($file) {
				if($file == 'index.html') return;
				JFile::delete(JPATH_ROOT . '/media/quix/js/'. $file);
			},
			$jsfiles
		);
		
		// Clear relavent cache
		$this->cachecleaner('com_quix');
		$this->cachecleaner('mod_quix');
		$this->cachecleaner('libquix', 1);
		$this->cachecleaner('lib_quix', 1);
		$this->cachecleaner('lib_quix');
		$this->cachecleaner('quix', 1);
		$this->cachecleaner('quix');

		return $this->output($this->getResultObj( JText::_( 'COM_IQUIX_INSTALLATION_CACHECLEAN_SUCCESS' ) , true ));

	}

	public function cachecleaner($group = 'com_quix', $client_id = 0){
		$conf = \JFactory::getConfig();

		$options = array(
			'defaultgroup' => $group,
			'cachebase' => $client_id ? JPATH_ADMINISTRATOR . '/cache' : $conf->get('cache_path', JPATH_SITE . '/cache'),
			'result' => true,
		);

		try
		{
			/** @var \JCacheControllerCallback $cache */
			$cache = \JCache::getInstance('callback', $options);
			$cache->clean();
		}
		catch (\JCacheException $exception)
		{
			$options['result'] = false;
		}

		// Trigger the onContentCleanCache event.
		\JEventDispatcher::getInstance()->trigger('onContentCleanCache', $options);
	}

	public function backupDatabase()
	{
		$getComponent = \JComponentHelper::getComponent('com_quix');
		if(empty($getComponent->id) or !$getComponent->id){
			return $this->output($this->getResultObj( JText::_( 'New installation' ) , true ));
		}
		
		$version = $this->getPreviousVersion();
		$versionText = str_replace(".", "", $version);
		
		$app = JFactory::getApplication(); 
		$prefix = $app->get('dbprefix');

		$db = JFactory::getDbo();
		$tables = JFactory::getDbo()->getTableList();
		
		if(!in_array( $prefix.'quix', $tables)){
			return $this->output($this->getResultObj( JText::_( 'No record to backup!' ) , true ));
		}

		try 
		{
			$tables = JFactory::getDbo()->getTableList();
			$quixTable = $prefix.'quix'.$versionText;
			if(!in_array($quixTable, $tables)){
				$query = "CREATE TABLE IF NOT EXISTS `#__quix$versionText` LIKE `#__quix`;";
				$db->setQuery($query);
				$result =  $db->execute();
				
				$query = "INSERT `#__quix$versionText` SELECT * FROM `#__quix`;";
				$db->setQuery($query);
				$db->execute();

				$query = "CREATE TABLE IF NOT EXISTS `#__quix_collections$versionText` LIKE `#__quix_collections`;";
				$db->setQuery($query);
				$db->execute();
				$query = "INSERT `#__quix_collections$versionText` SELECT * FROM `#__quix_collections`;";
				$db->setQuery($query);
				$db->execute();

				$query = "CREATE TABLE IF NOT EXISTS `#__quix_collection_map$versionText` LIKE `#__quix_collection_map`;";
				$db->setQuery($query);
				$db->execute();
				$query = "INSERT `#__quix_collection_map$versionText` SELECT * FROM `#__quix_collection_map`;";
				$db->setQuery($query);
				$db->execute();

				$query = "CREATE TABLE IF NOT EXISTS `#__quix_elements$versionText` LIKE `#__quix_elements`;";
				$db->setQuery($query);
				$db->execute();
				$query = "INSERT `#__quix_elements$versionText` SELECT * FROM `#__quix_elements`;";
				$db->setQuery($query);
				$db->execute();	
	
				return $this->output($this->getResultObj( JText::_( 'Database backup complete' ) , true ));
			}else{
				return $this->output($this->getResultObj( JText::sprintf( 'Version %s already has a backup' , $version) , true ));
			}

		} catch (Exception $e) {
			return $this->output($this->getResultObj( JText::_( 'Error: ' . $e->getMessage() ) , false ));
		}
	}

	public function installComponent()
	{
		// Try to extract the files
		$storage = QX_TMP . '/pkg_quix/com_quix.zip';
		$tmp = QX_TMP . '/pkg_quix/com_quix';
		$state = JArchive::extract($storage, $tmp);			
		if (!$state) {
			return $this->output($this->getResultObj(JText::_('COM_QUIX_INSTALLATION_ERROR_EXTRACT_COMPONENT'), false));
		}

		try {
			$app = JFactory::getApplication();
			$app->input->set('installtype', 'folder');
			$app->input->set('install_directory', $tmp);
			JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_installer/models');
			$installerModel = JModelLegacy::getInstance('Install', 'InstallerModel');
			$result = $installerModel->install();
			// print_r(  );die;
			// $session = JFactory::getSession();
			// $session->set('application.queue', $this->_messageQueue);
			if($result){
				return $this->output($this->getResultObj( JText::_( 'Component installation success!' ) , true ));
			}
			else
			{
				return $this->output($this->getResultObj( JText::_( 'Installation failed! Error: ' . end($app->getMessageQueue())) , false ));	
			}

		} catch (Exception $e) {
			return $this->output($this->getResultObj( JText::_( 'Error: ' . $e->getMessage() ) , false ));
		}
	}

	public function installLibrary()
	{
		// Try to extract the files
		$storage = QX_TMP . '/pkg_quix/lib_quix.zip';
		$tmp = QX_TMP . '/pkg_quix/lib_quix';
		$state = JArchive::extract($storage, $tmp);			
		if (!$state) {
			return $this->output($this->getResultObj(JText::_('COM_QUIX_INSTALLATION_ERROR_EXTRACT_LIBRARY'), false));
		}

		try {
			$app = JFactory::getApplication();
			$app->input->set('installtype', 'folder');
			$app->input->set('install_directory', $tmp);
			JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_installer/models');
			$installerModel = JModelLegacy::getInstance('Install', 'InstallerModel');
			$result = $installerModel->install();
			// print_r(  );die;
			// $session = JFactory::getSession();
			// $session->set('application.queue', $this->_messageQueue);
			if($result){
				return $this->output($this->getResultObj( JText::_( 'Library installation success!' ) , true ));
			}
			else
			{
				return $this->output($this->getResultObj( JText::_( 'Installation failed! Error: ' . end($app->getMessageQueue())) , false ));	
			}

		} catch (Exception $e) {
			return $this->output($this->getResultObj( JText::_( 'Error: ' . $e->getMessage() ) , false ));
		}
	}

	public function installModules()
	{
		$app = JFactory::getApplication();
		$modules = ['mod_quix_menu', 'mod_quix'];
		foreach ($modules as $key => $module) 
		{
			// Try to extract the files
			$storage = QX_TMP . '/pkg_quix/'.$module.'.zip';
			$tmp = QX_TMP . '/pkg_quix/'.$module;
			$state = JArchive::extract($storage, $tmp);			
			if (!$state) {
				return $this->output($this->getResultObj(JText::_('COM_QUIX_INSTALLATION_ERROR_EXTRACT_'. strtoupper($module)), false));
			}
			
			try {
				
				$app->input->set('installtype', 'folder');
				$app->input->set('install_directory', $tmp);
				JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_installer/models');
				$installerModel = JModelLegacy::getInstance('Install', 'InstallerModel');
				$result = $installerModel->install();

				if(!$result)
				{
					return $this->output($this->getResultObj( JText::_( strtoupper($module) . ' installation failed! Error: ' . end($app->getMessageQueue())) , false ));	
				}

			} catch (Exception $e) {
				return $this->output($this->getResultObj( JText::_( 'Error: ' . $e->getMessage() ) , false ));
			}

		}

		return $this->output($this->getResultObj( JText::sprintf( '%s Modules installation success!' , count($modules)) , true ));
	}


	public function installPlugins()
	{
		$app = JFactory::getApplication();
		$plugins = ['plg_content_quix', 'plg_editors_xtd_quix', 'plg_finder_quix', 'plg_system_quix', 'plg_quickicon_quix', 'plg_system_seositeattributes'];
		foreach ($plugins as $key => $plugin) 
		{
			// Try to extract the files
			$storage = QX_TMP . '/pkg_quix/'.$plugin.'.zip';
			if(! JFile::exists($storage) ) continue;

			$tmp = QX_TMP . '/pkg_quix/'.$plugin;
			$state = JArchive::extract($storage, $tmp);			
			if (!$state) {
				return $this->output($this->getResultObj(JText::_('COM_QUIX_INSTALLATION_ERROR_EXTRACT_'. strtoupper($plugin)), false));
			}
			
			try {
				
				$app->input->set('installtype', 'folder');
				$app->input->set('install_directory', $tmp);
				JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_installer/models');
				$installerModel = JModelLegacy::getInstance('Install', 'InstallerModel');
				$result = $installerModel->install();

				if(!$result)
				{
					return $this->output($this->getResultObj( JText::_( strtoupper($plugin) . ' installation failed! Error: ' . end($app->getMessageQueue())) , false ));	
				}

			} catch (Exception $e) {
				return $this->output($this->getResultObj( JText::_( 'Error: ' . $e->getMessage() ) , false ));
			}

		}

		return $this->output($this->getResultObj( JText::sprintf('%s Plugins installation success!' , count($plugins)) , true ));
	}

	/**
	 * Post installation process
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function syncDb()
	{
		include QX_TMP . "/pkg_quix/pkg.script.php";
		try {
			$script = new pkg_QuixInstallerScript();
			ob_start();	
			$script->postflight(array());
			$data = ob_get_contents();
			ob_end_clean();
			return $this->output($this->getResultObj( JText::_('Updating Database complete!'), true));

		} catch (Exception $e) {
			return $this->output($this->getResultObj( JText::_( 'Error: ' . $e->getMessage() ) , false ))	;
		}
	}

	/**
	 * Post installation process
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function installPost()
	{
		$results = array();

		// Update the api key on the server with the one from the bootstrap
		// $this->updateConfig();

		try {
			// Cleanup temporary files from the tmp folder
			$tmp = dirname(dirname(__FILE__)) . '/tmp';
			$folders = JFolder::folders($tmp, '.', false, true);

			if ($folders) {
				foreach ($folders as $folder) {
					@JFolder::delete($folder);
				}
			}

			// Update installation package to 'launcher'
			$this->updatePackage();
			// $this->updateJoomlaUpdater();

			$result = new stdClass();
			$result->state = true;
			$result->message = "Post operation completed!";

			
		} catch (Exception $e) {
			$result = new stdClass();
			$result->state = false;
			$result->message = "Post operation failed! but you proceed...";
			
		}


		return $this->output($result);
	}

	/**
	 * Update installation package to launcher package to update issue via update button
	 *
	 * @since	2.1.3
	 * @access	public
	 */
	public function updatePackage()
	{
		// now we need to update the QX_INSTALLER to launcher to that the update button will
		// work correctly. #1558
		$path = JPATH_ADMINISTRATOR . '/components/com_iquix/setup/bootstrap.php';

		// Read the contents
		$contents = JFile::read($path);

		$contents = str_ireplace("define('QX_INSTALLER', 'full');", "define('QX_INSTALLER', 'launcher');", $contents);
		$contents = preg_replace('/define\(\'QX_PACKAGE\', \'.*\'\);/i', "define('QX_PACKAGE', '');", $contents);

		JFile::write($path, $contents);
	}
	
	/**
	 * Downloads the file from the server
	 *
	 * @since	2.0.9
	 * @access	public
	 */
	public function download()
	{
		$info = $this->getInfo();

		if (!$info->success) {
			$result = new stdClass();
			$result->state = false;
			$result->message = $info->message;

			$this->output($result);
			exit;
		}

		// Download the component installer.
		$data = $info->data;
		$storage = $this->getDownloadFile($data);

		// This only happens when there is no result returned from the server
		if ($storage === false) {
			$result = new stdClass();
			$result->state = false;
			$result->message = 'There was some errors when downloading the file from the server.';

			$this->output($result);
		}

		// Extract files here.
		$tmp = QX_TMP . '/pkg_quix';

		if (JFolder::exists($tmp)) {
			JFolder::delete($tmp);
		}

		try {
			// Try to extract the files
			$state = JArchive::extract($storage, $tmp);
		} catch (Exception $e) {
			$result = new stdClass();
			$result->state = false;
			$result->message = 'File extracting error: ' . $e->getMessage();

			$this->output($result);	
		}

		// If there is an error extracting the zip file, then there is a possibility that the server returned a json string
		if (!$state) {

			$contents = JFile::read($storage);
			$result = json_decode($contents);

			if (is_object($result)) {
				$result->state = false;
				$this->output($result);
				exit;
			}

			$result = new stdClass();
			$result->state = false;
			$result->message = 'There was some errors when extracting the archive from the server. If the problem still persists, please contact our support team.<br /><br /><a href="https://www.themexpert.com/forums" class="btn btn-default" target="_blank">Contact Support</a>';

			$this->output($result);
			exit;
		}


		// Get the md5 hash of the stored file
		$hash = md5_file($storage);

		// @TODO: update server license plugin to generate md5hash for the file
		// Check if the md5 check sum matches the one provided from the server.
		// if (!in_array($hash, $info->md5)) {
		// 	$result = new stdClass();
		// 	$result->state = false;
		// 	$result->message = 'The MD5 hash of the downloaded file does not match. Please contact our support team to look into this.<br /><br /><a href="https://www.themexpert.com/forums" class="btn btn-default" target="_blank">Contact Support</a>';

		// 	$this->output($result);
		// 	exit;
		// }

		// After installation is completed, cleanup all zip files from the site
		$this->cleanupZipFiles(dirname($storage));

		$result = new stdClass();
		$result->message = 'Installation file downloaded successfully';
		$result->state = $state;
		$result->path = $tmp;

		$this->output($result);
	}

	/**
	 * Allows cleanup of installation files
	 *
	 * @since	1.3
	 * @access	public
	 */
	private function cleanupZipFiles($path)
	{
		$zipFiles = JFolder::files($path, '.zip', false, true);

		if ($zipFiles) {
			foreach ($zipFiles as $file) {
				@JFile::delete($file);
			}
		}

		return true;
	}

	/**
	 * For users who uploaded the installer and needs a manual extraction
	 *
	 * @since	2.0.9
	 * @access	public
	 */
	public function extract()
	{
		// Check the api key from the request
		$apiKey = JRequest::getVar('apikey', '');

		// Construct the storage path
		$storage = QX_PACKAGES . '/' . QX_PACKAGE;
		$exists = JFile::exists($storage);

		// Test if package really exists
		if (!$exists) {
			$result = new stdClass();
			$result->state = false;
			$result->message = 'The component package does not exist on the site.<br />Please contact our support team to look into this.';

			$this->output($result);
			exit;
		}

		// Get the folder name
		$folderName = basename($storage);
		$folderName = str_ireplace('.zip', '', $folderName);

		// Extract files here.
		$tmp = QX_TMP . '/' . $folderName;

		// Ensure that there is no such folders exists on the site
		if (JFolder::exists($tmp)) {
			JFolder::delete($tmp);
		}

		// Try to extract the files
		$state = JArchive::extract($storage, $tmp);

		// Regardless of the extraction state, delete the zip file otherwise anyone can download the zip file.
		@JFile::delete($storage);

		if (!$state) {
			$result = new stdClass();
			$result->state = false;
			$result->message = 'There was some errors when extracting the zip file';

			$this->output($result);
			exit;
		}

		$result = new stdClass();

		$result->message = 'Installation archive extracted successfully';
		$result->state = $state;
		$result->path = $tmp;

		$this->output($result);
	}

	/**
	 * Downloads the installation files from our installation API
	 *
	 * @since	2.0.9
	 * @access	public
	 */
	public function getDownloadFile($info)
	{
		// Set the storage page
		$storage = QX_PACKAGES . '/pkg_quix.zip';

		// Delete zip archive if it already exists.
		if (JFile::exists($storage)) {
			JFile::delete($storage);
		}

		set_time_limit(0);

		//This is the file where we save the    information
		$fp = fopen ( $storage, 'w+');

		//Here is the file we are downloading, replace spaces with %20
		$ch = curl_init($info->download_url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 35000);
		// write curl response to file
		curl_setopt($ch, CURLOPT_FILE, $fp); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// get curl response
		$result = curl_exec($ch); 
		curl_close($ch);

		fclose($fp);

	    return $result ? $storage : false;

	}

}
