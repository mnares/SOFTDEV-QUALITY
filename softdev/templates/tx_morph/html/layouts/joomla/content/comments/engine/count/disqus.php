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

if( $displayData['params']->get('disqus_subdomain') != '' ) {
	$doc = JFactory::getDocument();

	if(!defined('TX_COMMENTS_DISQUS_COUNT')) {
		ob_start();

		$devmode = $displayData['params']->get('disqus_devmode');
		if ($devmode) {
			echo 'var disqus_developer = "1";';
		}

		?>
		var disqus_shortname = '<?php echo $displayData['params']->get("disqus_subdomain"); ?>';
		(function () {
			var s = document.createElement('script'); s.async = true;
			s.type = 'text/javascript';
			s.src = '//' + disqus_shortname + '.disqus.com/count.js';
			(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		}());

		<?php

		$output = ob_get_clean();

		$doc->addScriptdeclaration( $output );

		define('TX_COMMENTS_DISQUS_COUNT', 1);

	}

	?>
	<span class="comments-anchor">
		<a href="<?php echo $displayData['url']; ?>#disqus_thread">View Comments</a>
	</span>
	<?php
}
