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

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.archive');
jimport('joomla.database.driver');
jimport('joomla.installer.helper');

class iQuixSetupController
{
	private $result = array();

	public function __construct()
	{
		$this->app = JFactory::getApplication();
		$this->input = $this->app->input;
	}

	protected function data($key, $value)
	{
		$obj = new stdClass();
		$obj->$key = $value;

		$this->result[] = $obj;
	}

	/**
	 * Renders a response with proper headers
	 *
	 * @since	2.1.0
	 * @access	public
	 */
	public function output($data = array())
	{
		header('Content-Type: application/json; UTF-8');

		if (empty($data)) {
			$data = $this->result;
		}

		echo json_encode($data);
		exit;
	}

	/**
	 * Generates a result object that can be json encoded
	 *
	 * @since	2.1.0
	 * @access	public
	 */
	public function getResultObj($message, $state, $stateMessage = '')
	{
		$obj = new stdClass();
		$obj->state = $state;
		$obj->stateMessage = $stateMessage;
		$obj->message = JText::_($message);

		return $obj;
	}

	/**
	 * Get's the version of this launcher so we know which to install
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function getVersion()
	{
		static $version = null;

		// Get the version from the manifest file
		if (is_null($version)) {
			$contents 	= JFile::read( JPATH_ROOT . '/administrator/components/com_iquix/iquix.xml' );
			$parser 	= simplexml_load_string( $contents );
			$version 	= $parser->xpath( 'version' );
			$version 	= (string) $version[ 0 ];
		}

		return $version;
	}

	/**
	 * Retrieve the Joomla Version
	 *
	 * @since   2.0
	 * @access  public
	 */
	public function getJoomlaVersion()
	{
		$jVerArr = explode('.', JVERSION);
		$jVersion = $jVerArr[0] . '.' . $jVerArr[1];

		return $jVersion;
	}

	/**
	 * Retrieves the current site's domain information
	 *
	 * @since	2.0.9
	 * @access	public
	 */
	public function getDomain()
	{
		static $domain = null;

		if (is_null($domain)) {
			$domain = JURI::root();
			$domain = str_ireplace(array('http://', 'https://'), '', $domain);
			$domain = rtrim($domain, '/');
		}

		return $domain;
	}

	/**
	 * Retrieves the information about the latest version
	 *
	 * @since	2.0.9
	 * @access	public
	 */
	public function getInfo()
	{
		// Get the md5 hash from the server.
		$session = JFactory::getSession();
		$username = $session->get('quix.username', '');
		$key = $session->get('quix.key', '');
		$id = $session->get('quix.id', '');
		
		$url = QX_API_LICENSE . '&pid=' . $id . '&username=' . $username . '&key=' . $key;
		// &pid=116&username=AAA&key=AAA

		$resource = curl_init();

		$version = $this->getVersion();

		// We need to pass the api keys to the server
		curl_setopt($resource, CURLOPT_URL, $url);
		curl_setopt($resource, CURLOPT_POST, false);
		// curl_setopt($resource, CURLOPT_POSTFIELDS, 'apikey=' . ES_KEY . '&from=' . $version);
		curl_setopt($resource, CURLOPT_TIMEOUT, 120);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($resource, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($resource);

		curl_close($resource);

		if (!$result) {
			return false;
		}

		$obj = json_decode($result);

		return $obj;
	}

	public function getAuthInfo()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')->from('#__quix_configs');
		$db->setQuery($query);
		$result = $db->loadObjectList();
		return $this->output($result);
	}

	/**
	 * Loads the previous version that was installed
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function getInstalledVersion()
	{
		$xml = new SimpleXMLElement(file_get_contents(JPATH_ADMINISTRATOR .'/components/com_quix/quix.xml'));

		$version = (string)$xml->version;
		
		return $version;
	}

	/**
	 * get a configuration item
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function getPreviousVersion()
	{
		$xml = new SimpleXMLElement(file_get_contents(JPATH_ADMINISTRATOR .'/components/com_quix/quix.xml'));
		$version = (string)$xml->version;

		return $version;

	}

	/**
	 * Determines if we are in development mode
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function isDevelopment()
	{
		$session = JFactory::getSession();
		$developer = $session->get('quix.developer');

		return $developer;
	}

	/**
	 * Verifies the api key
	 *
	 * @since	2.1.0
	 * @access	public
	 */
	public function verifyApiKey($username, $key)
	{
		$url = QX_API_LICENSE . '&catid=' . QX_CATID . '&username=' . $username . '&key=' . $key;
		// $post = array('username' => $username, 'key' => $key);
		
		$http = new JHttp();
        $str  = $http->get($url);
		if ($str->code != 200 && $str->code != 310)
		{
	        return false;
		}

		$result = json_decode($str->body);
		
		return $result;
	}

	/**
	 * Retrieves the extension id
	 *
	 * @since	2.0.10
	 * @access	public
	 */
	public function getExtensionId($ext = 'pkg_quix')
	{
		//SELECT * FROM `fl6j4_extensions` WHERE `element` LIKE 'pkg_quix'
		$db = JFactory::getDBO();
		$sql = "SELECT * FROM " . $db->quoteName('#__extensions') . " WHERE " . $db->quoteName('element') . " = " . $db->quote('pkg_quix');
		$db->setQuery($sql);
		
		// Get the extension id
		$extensionId = $db->loadResult();

		return $extensionId;
	}
}
