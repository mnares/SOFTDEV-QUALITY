/**
 * @copyright  Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
(function($, window, document) {
	"use strict";

	jQuery(function() {
		// Turn off link click
		jQuery("a").on( "click", function(e) {
			e.stopPropagation();
			e.preventDefault();
			return false;
		});
		// turn off form submit
		jQuery("form").on( "submit", function(e) {
			e.stopPropagation();
			e.preventDefault();
			return false;
		});
		
		jQuery('#pageoption-tab-wrapper a').click(function (e) {
		  e.preventDefault()
		  jQuery(this).tab('show')
		})

		// updateAjax make ajax request on the background if we need to;
		axios({
	      method: 'get',
	      url: `${quix.url}/index.php?option=com_quix&task=updateAjax`
	    });
	});

})(window.jQuery, window, document);