<?php
/**
* @package ThemeXpert
* @author ThemeXpert http://www.themexpert.com
* @copyright Copyright (c) 2010 - 2016 ThemeXpert
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
* @credit: Helix Framework
*/
//no direct access
defined('_JEXEC') or die('Restricted Access');

if( $displayData['params']->get('fb_appID') != '' ) {

	$doc = JFactory::getDocument();

	if(!defined('TX_COMMENTS_FACEBOOK_COUNT')) {

		$doc->addScript( '//connect.facebook.net/en-GB/all.js#xfbml=1&appId=' . $displayData['params']->get('fb_appID') . '&version=v2.0' );

		define('TX_COMMENTS_FACEBOOK_COUNT', 1);

	}

	?>

	<span class="comments-anchor">
		<a href="<?php echo $displayData['url']; ?>#tx-comments"><?php echo JText::_('COMMENTS'); ?> <fb:comments-count href=<?php echo $displayData['url']; ?>></fb:comments-count></a>
	</span>

	<?php

}