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

if( $displayData['params']->get('intensedebate_acc') != '' ) {
	?>
	
	<script>
	var idcomments_acct = '<?php echo $displayData["params"]->get("intensedebate_acc"); ?>';
	var idcomments_post_id = '<?php echo md5( $displayData["url"] ); ?>';
	var idcomments_post_url = '<?php echo $displayData["url"]; ?>';
	</script>
	<span id="IDCommentsPostTitle" style="display:none"></span>
	<script type='text/javascript' src='http://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>

	<?php
}