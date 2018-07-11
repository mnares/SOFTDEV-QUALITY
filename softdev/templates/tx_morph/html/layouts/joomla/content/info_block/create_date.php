<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>
<dd class="create qx-element-jarticle-date">
	<i class="fa fa-clock-o"></i>

	<time datetime="<?php echo JHtml::_('date', $displayData['item']->created, 'c'); ?>"><?php echo JHtml::_('date', $displayData['item']->created, 'c'); ?></time>
</dd>
