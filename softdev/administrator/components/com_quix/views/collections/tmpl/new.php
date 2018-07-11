<?php
/**
* @version    1.0.0
* @package    com_quix
* @author     ThemeXpert <info@themexpert.com>
* @copyright  Copyright (C) 2015. All rights reserved.
* @license    GNU General Public License version 2 or later; see LICENSE.txt
*/
	// No direct access
defined('_JEXEC') or die;

JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qxbs.css' );
JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qxui.css' );
JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qxicon.css' );

// Add script js
JHtml::_('jquery.framework');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

JHtml::_('script', 'administrator/components/com_quix/assets/script.js', array('version' => 'auto'));
?>
<div id="collection-window-modal" class="modal-library qx-p-5">
	<div class="qx-row qx-align-items-center">
		<div class="qx-col-6">
			<div class="qx-card qx-p-5">
				<div class="qx-card-body">
					<h2 class="qx-card-title qx-mb-3 qx-title">Choose Template Type</h2>
					<form action="<?php echo JRoute::_('index.php?option=com_quix&view=collections'); ?>" method="post"
						name="adminForm" id="adminForm" class="form-validate">
						<div class="qx-form-group">
							<label for="templateName" class="qx-mb-2">Template Name</label>
							<input require type="text" name="jform[title]" class="qx-form-control required" id="templateName" placeholder="Enter your template name (required)">
						</div>
						<div class="qx-form-group">
							<label for="templateType" class="qx-mb-2">Template Type</label>
							<select require id="templateType" name="jform[type]" class="qx-form-control required">
								<option value="Layout">Page</option>
								<option value="section" selected>Section</option>
							</select>
						</div>

						<button type="submit" class="qx-btn qx-btn-primary qx-text-uppercase">
							Create Template <i class="qxicon-arrow-right"></i>
						</button>
						<br><br>
						<p class="error alert alert-danger" style="display: none;">
							Something went wrong! can't create templates!
						</p>
						<p class="success alert alert-success" style="display: none;">
							Template created and taking you to the builder
						</p>

						<input type="hidden" name="jform[state]" value="1" />
						<input type="hidden" name="jform[builder]" value="frontend" />
						<input type="hidden" name="jform[data]" value="[]" />
						<input type="hidden" name="release" value="true" />
						<input type="hidden" name="task" value="collection.apply" />
						<?php echo JHtml::_('form.token'); ?>
					</form>
				</div>
			</div>
		</div>
		<div class="qx-col-6">
			<div class="qx-mx-5">
				<h1 class="qx-title">Template Help You <br> <b>Work Efficiently</b></h1>
				<p class="qx-text-muted">Use templates to create the different pieces of your site, and reuse them with one click whenever needed.</p>
			</div>
		</div>
	</div>
</div>