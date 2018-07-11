<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

//Gravatar images
$user = JFactory::getUser($displayData['item']->created_by);
$author_email = $user->email;
$email = md5( strtolower( trim( $author_email ) ) );

// var_dump($user);die;

?>
<dd class="createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<img class="author-img img-circle" src="https://www.gravatar.com/avatar/<?php echo $email; ?>?s=20" alt="<?php echo $displayData['item']->author; ?>">

	<!-- <i class="fa fa-user"></i> -->
	<?php $author = ($displayData['item']->created_by_alias ? $displayData['item']->created_by_alias : $displayData['item']->author); ?>
	<?php $author = '<span itemprop="name" data-toggle="tooltip" title="' . JText::sprintf('COM_CONTENT_WRITTEN_BY', '') . '">' . $author . '</span>'; ?>
	<?php if (!empty($displayData['item']->contact_link ) && $displayData['params']->get('link_author') == true) : ?>
		<?php echo JHtml::_('link', $displayData['item']->contact_link, $author, array('itemprop' => 'url')); ?>
	<?php else :?>
		<?php echo $author; ?>
	<?php endif; ?>
</dd>
