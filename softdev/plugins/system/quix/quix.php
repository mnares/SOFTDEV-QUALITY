<?php
/**
 * @package    Quix
 * @author    ThemeXpert http://www.themexpert.com
 * @copyright  Copyright (c) 2010-2015 ThemeXpert. All rights reserved.
 * @license  GNU General Public License version 3 or later; see LICENSE.txt
 * @since    1.0.0
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
use ThemeXpert\Shortcode\Shortcode;

JLoader::discover('QuixSiteHelper', JPATH_SITE . '/components/com_quix/helpers/');

// Include dependencies
jimport( 'quix.app.bootstrap' );

global  $QuixBuilderType ;
if( empty($QuixBuilderType) ) $QuixBuilderType = "frontend";
jimport( 'quix.app.init' );

class plgSystemQuix extends JPlugin
{

  /**
   * Load the language file on instantiation.
   *
   * @var    boolean
   * @since  3.1
   */
  protected $autoloadLanguage = true;

  public $configs = null;
  protected $app;

  public function onAfterInitialise() 
	{	
		if (!$this->app) {
			$this->app = JFactory::getApplication();
		}
		// work only on front-end
		if ($this->app->isAdmin()){  return; }
		if (!$this->app->input->get('quixlogin', false)){  return; }

		// Check for a cookie if user is not logged in (quest cookie)
		if (JFactory::getUser()->get('guest')){
			$config = JFactory::getConfig();
			$cookie_domain = $config->get('cookie_domain', '');
			$cookie_path = $config->get('cookie_path', '/');
			// prepare cookie name
			$cookie_name = md5(JApplicationHelper::getHash('administrator'));
			if($_COOKIE[$cookie_name] !== '') {
				$sessionId = $_COOKIE[$cookie_name];
				// find back-end session
				$db = $this->db = JFactory::getDbo();
				$query = $db->getQuery(true)
				    ->select($db->quoteName(array('session_id', 'client_id', 'guest', 'time', 'data', 'userid', 'username')))
				    ->from($db->quoteName('#__session'))
				    ->where($db->quoteName('session_id') . ' = '. $db->quote($sessionId))
				    ->order('client_id ASC');
				$db->setQuery($query);
				$adminSession = $db->loadObjectList();
				
				// second check if the session exists but it was changed to guest session (login -> logout)
				preg_match('/"guest";i:(\d)/mis', $adminSession[0]->data, $guest);
				if(count($adminSession) > 0 && !(isset($guest[1]) ? $guest[1] : false)){
					$adminSession = $adminSession[0];
					// user is already logged to back-end
					$session = JFactory::getSession();
					// Update the user related fields for the Joomla sessions table.
					$query = $db->getQuery(true)
						->update($db->quoteName('#__session'))
						->set($db->quoteName('client_id') . ' = ' . '0')
						->set($db->quoteName('guest') . ' = ' . '0')
						->set($db->quoteName('data') . ' = ' . $db->quote($adminSession->data))
						->set($db->quoteName('username') . ' = ' . $db->quote($adminSession->username))
						->set($db->quoteName('userid') . ' = ' . (int) $adminSession->userid)
						->where($db->quoteName('session_id') . ' = ' . $db->quote($session->getId()));
					$res = $db->setQuery($query)->execute();
					
					if($res) {
						$this->app = JFactory::getApplication();
						// find user ID in back-end session 'data' string
						# preg_match('/("id";s:\d*:)"(\w*)"/mis', $adminSession->data, $matches);
						$userId = $adminSession->userid;
						$user = JUser::getInstance($userId);
						
						// new 
						$instance = JUser::getInstance($userId);
						// If _getUser returned an error, then pass it back.
						if ($instance instanceof Exception)
						{
							return false;
						}

						// If the user is blocked, redirect with an error
						if ($instance->block == 1)
						{
							$this->app->enqueueMessage(JText::_('JERROR_NOLOGIN_BLOCKED'), 'warning');

							return false;
						}

						// Check the user can login.
						$result = $instance->authorise('core.manage');

						if (!$result)
						{
							$this->app->enqueueMessage(JText::_('JERROR_LOGIN_DENIED'), 'warning');

							return false;
						}

						// Mark the user as logged in
						$instance->guest = 0;

						$session = JFactory::getSession();

						// Grab the current session ID
						$oldSessionId = $session->getId();

						// Fork the session
						$session->fork();

						$session->set('user', $instance);

						// Ensure the new session's metadata is written to the database
						$this->app->checkSession();

						// Purge the old session
						$query = $this->db->getQuery(true)
							->delete('#__session')
							->where($this->db->quoteName('session_id') . ' = ' . $this->db->quote($oldSessionId));

						try
						{
							$this->db->setQuery($query)->execute();
						}
						catch (RuntimeException $e)
						{
							// The old session is already invalidated, don't let this block logging in
						}

						// Hit the user last visit field
						$instance->setLastVisit();

						// Add "user state" cookie used for reverse caching proxies like Varnish, Nginx etc.
						if ($this->app->isClient('site'))
						{
							$this->app->input->cookie->set(
								'joomla_user_state',
								'logged_in',
								0,
								$this->app->get('cookie_path', '/'),
								$this->app->get('cookie_domain', ''),
								$this->app->isHttpsForced(),
								true
							);
						}

						// now comes the Login One! part
						//
						$cookie_domain = $this->app->get('cookie_domain', '');
						$cookie_path   = $this->app->get('cookie_path', '/');

						// get the configured session lifetime in minutes
						$session_lifetime = $this->app->get('lifetime');

						// // always set this cookie when user is logged in
						// setcookie(
      //         JApplication::getHash('COM_QUIX'.$instance->username, $session->getId(), time()+$session_lifetime*65, $cookie_path, $cookie_domain)
      //       );		// cookie lives just a little bit longer than the session

						// return true;

						$_SESSION['__default']['user'] = $instance;
            // hide the message
						// $this->app->enqueueMessage(JText::_('You\'ve been automatically logged based on your administrator area session.'), 'message');
					} else {
            // hide the message
						// $this->app->enqueueMessage(JText::_('Back-end session found but can\t auhorize user.'), 'notice');
					}
				} else {
					// session not found; return 
					return;
				}
			} else {
				return;
			}
		} else {
			// logged user
			return;
		}
	}
  
  /**
  * Load Quix Assets
  * previous event name: onAfterInitialise
  * error: due to mutilingual issue, change to onBeforeCompileHead.
  */
  function onBeforeCompileHead()
  {
    $extension = JTable::getInstance( 'extension' );
    $id = $extension->find( array( 'element' => 'com_quix' ) );
    $extension->load( $id );
    $componentInfo = json_decode( $extension->manifest_cache, true );
    $version = str_replace(['.','-'], '', $componentInfo['version']);

    if(JFactory::getApplication()->isAdmin()){
      return;
    }
    
    if($this->params->get('load_global', 0))
    {
      // move quix at top of css :D
      self::addQuixTrapCSS();
    }

    if($this->params->get('init_wow', 1))
    {
      JHtml::_('jquery.framework');
      JFactory::getDocument()->addScript(JUri::root(true) . '/libraries/quix/assets/js/wow.js?'.$version);
      JFactory::getDocument()->addScriptDeclaration('new WOW().init();');
    }
    
    // apply gantry fix for offcanvas toggler
    if ($this->params->get('gantry_fix_offcanvas', 0) && class_exists('Gantry5\Loader')) {
      JFactory::getDocument()->addScriptDeclaration("jQuery(document).ready(function(){jQuery('.g-offcanvas-toggle').on('click', function(e){e.preventDefault();});});");
    }

  }

  /**
   * determine is version 2
   */
  protected static function isV2()
  {
    // return \JFactory::getApplication()->input->get('v') == 2;
    $input = JFactory::getApplication()->input;
    $option = $input->get('option');
    $id = $input->get('id');
    $view = $input->get('view', 'page');

    if($option == 'com_quix' && $id)
    {
      $db = JFactory::getDbo();
      $sql = "SELECT builder FROM " . ($view == 'page' ? "`#__quix`" : "`#__quix_collections`") . " WHERE `id` = " . $id;
      $db->setQuery($sql);
      $result = $db->loadResult();
      
      if($result == 'classic') return false;
    }
    
    return true;
  }

  /*
  * Method addQuixTrapCSS
  */
  public static function addQuixTrapCSS()
  {
    jimport( 'quix.app.bootstrap' );
 
    $document = JFactory::getDocument();
    $_styleSheets = $document->_styleSheets;
    $version = 'ver=' . QUIX_VERSION;
    
    if( checkQuixIsVersion2() ) {
      $quixCss = JUri::root(true) . '/libraries/quix/assets/css/qxbs.css?'.$version;
      $quixCssArray = array(
        $quixCss => array(
          'mime' => 'text/css',
          'media' => '',
          'attribs' => array()
        )
      );

      $quix = JUri::root(true) . '/libraries/quix/assets/css/quix.css?'.$version;
      $quixArray = array(
        $quix => array(
          'mime' => 'text/css',
          'media' => '',
          'attribs' => array()
        )
      );
      
      $quixClassic = JUri::root(true) . '/libraries/quix/assets/css/quix-classic.css?'.$version;
      $quixClassicArray = array(
        $quixClassic => array(
          'mime' => 'text/css',
          'media' => '',
          'attribs' => array()
        )
      );
      $styleSheets = $quixCssArray + $quixArray + $quixClassicArray + $_styleSheets;
    } else {
      $quixCss = JUri::root(true) . '/libraries/quix/assets/css/quixtrap.css?'.$version;
      $quixCssArray = array(
        $quixCss => array(
          'mime' => 'text/css',
          'media' => '',
          'attribs' => array()
        )
      );

      $quix = JUri::root(true) . '/libraries/quix/assets/css/quix-classic.css?'.$version;
      $quixArray = array(
        $quix => array(
          'mime' => 'text/css',
          'media' => '',
          'attribs' => array()
        )
      );

      $quixMP = JUri::root(true) . '/libraries/quix/assets/css/magnific-popup.css?'.$version;
      $quixMPArray = array(
        $quixMP => array(
          'mime' => 'text/css',
          'media' => '',
          'attribs' => array()
        )
      );

      $styleSheets = $quixCssArray + $quixArray + $quixMPArray + $_styleSheets;
    }

    $document->_styleSheets = $styleSheets;
  }

  public function getConfigs()
  {
    if (!$this->configs) {
      $config = JComponentHelper::getComponent('com_quix');
      $this->configs = $config->params;
    }

    return $this->configs;
  }

  public function onGetIcons($context)
  {
    if($context == 'mod_quickicon')
    {
      return array(
        array(
          'link'   => JRoute::_('index.php?option=com_quix&task=page.add'),
          'image'  => 'pencil-2',
          'icon'   => 'header/icon-48-article-add.png',
          'text'   => JText::_('Add New Page'),
          'access' => array('core.manage', 'com_quix', 'core.create', 'com_quix'),
          'group'  => 'QUIX',
        ),
        array(
          'link'   => JRoute::_('index.php?option=com_quix'),
          'image'  => 'list-2',
          'icon'   => 'header/icon-48-article.png',
          'text'   => JText::_('All Pages'),
          'access' => array('core.manage', 'com_quix'),
          'group'  => 'QUIX',
        ),
        array(
          'link'   => JRoute::_('index.php?option=com_quix&view=filemanager'),
          'image'  => 'folder-open',
          'icon'   => 'header/icon-48-article.png',
          'text'   => JText::_('Filemanager'),
          'access' => array('core.manage', 'com_quix'),
          'group'  => 'QUIX',
        )
      );
    }
  }
}
