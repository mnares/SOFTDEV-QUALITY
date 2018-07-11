<?php
/**
 * @package		Quix
 * @author 		ThemeXpert http://www.themexpert.com
 * @copyright	Copyright (c) 2010-2015 ThemeXpert. All rights reserved.
 * @license 	GNU General Public License version 3 or later; see LICENSE.txt
 * @since 		1.0.0
 */

defined('_JEXEC') or die;
// Include dependencies
jimport( 'quix.app.bootstrap' );

global  $QuixBuilderType ;
if( empty($QuixBuilderType) ) $QuixBuilderType = "frontend";
jimport( 'quix.app.init' );

/**
 * Helper for mod_breadcrumbs
 *
 * @since  1.5
 */
class ModQuixHelper
{
	/**
	 * renderShortCode
	 *
	 * @param   \Joomla\Registry\Registry  &$params  module parameters
	 *
	 * @return html
	 */
	public static function renderShortCode(&$params)
	{
		$id = $params->get('id');
		if (!$id) {
		  return '<p>'.JText::_('MOD_QUIX_INVALID_ID').'</p >';
		}

		$collection = qxGetCollectionInfoById($id);

		if (!$collection) {
			return '<p>'.JText::_('MOD_QUIX_INVALID_LIBRARY').'</p >';
		}

		// reset after loaded
		Assets::resetObject();

		// load common assets
		if(checkQuixCollectionIsVersion2($id)){
      loadLiveBuilderPreviewAssets();
    }

		// rander main item
		$html = quixRenderItem($collection);

		// load output assets
		Assets::load();

		// load quixtrap from system plugin
		plgSystemQuix::addQuixTrapCSS();
		    
		return $html;
	}
}
