<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="login-area login<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>


    <div class="row vh-center">

        <div class="col-md-6 col-md-offset-3">


            <div class="login-box-wraper">
							<div class="login-box">
	                <div class="text-center">
	                    <h2 class="box-title"><?php echo JText::_('COM_USERS_LOGIN_BOX_TITLE'); ?></h2>
	                </div>


	                <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	                <div class="login-description">
	                    <?php endif; ?>

	                    <?php if ($this->params->get('logindescription_show') == 1) : ?>
	                        <?php echo $this->params->get('login_description'); ?>
	                    <?php endif; ?>

	                    <?php if (($this->params->get('login_image') != '')) :?>
	                        <img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT')?>"/>
	                    <?php endif; ?>

	                    <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	                </div>
	            <?php endif; ?>

	                <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal">
	                    <fieldset class="custom">
													<label for="username"><?php echo JText::_('COM_USERS_LOGIN_USERNAME'); ?></label>
	                        <input id="username" type="text" class="form-control" name="username" placeholder="<?php echo JText::_('COM_USERS_LOGIN_USERNAME_PLACEHOLDER'); ?>">

													<label for="password"><?php echo JText::_('COM_USERS_LOGIN_PASSWORD'); ?></label>
	                        <input id="password" type="password" class="form-control" name="password" placeholder="<?php echo JText::_('COM_USERS_LOGIN_PASSWORD_PLACEHOLDER'); ?>">
	                    </fieldset>

	                    <fieldset>
	                        <?php foreach ($this->form->getFieldset('credentials') as $field) : ?>
	                            <?php if (!$field->hidden) : ?>
	                            <?php if ($field->fieldname == 'username' or $field->fieldname == 'password') continue; ?>
	                                <div class="control-group">
	                                    <div class="control-label">
	                                        <?php echo $field->label; ?>
	                                    </div>
	                                    <div class="controls">
	                                        <?php echo $field->input; ?>
	                                    </div>
	                                </div>
	                            <?php endif; ?>
	                        <?php endforeach; ?>

	                        <?php if ($this->tfa): ?>
	                            <div class="control-group">
	                                <div class="control-label">
	                                    <?php echo $this->form->getField('secretkey')->label; ?>
	                                </div>
	                                <div class="controls">
	                                    <?php echo $this->form->getField('secretkey')->input; ?>
	                                </div>
	                            </div>
	                        <?php endif; ?>

	                        <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
	                            <div class="pull-right">
	                                <div class="remember">
	                                    <input id="remember" type="checkbox" name="remember" value="yes"/>
	                                    <label for="remember">
	                                        <?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?>
	                                    </label>

	                                </div>
	                            </div>
	                        <?php endif; ?>

	                        <div class="pull-left">
	                            <button type="submit" class="btn btn-primary login-btn">
	                                <?php echo JText::_('JLOGIN'); ?>
	                            </button>
	                        </div>

	                        <?php if ($this->params->get('login_redirect_url')) : ?>
	                            <input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
	                        <?php else : ?>
	                            <input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_menuitem', $this->form->getValue('return'))); ?>" />
	                        <?php endif; ?>
	                        <?php echo JHtml::_('form.token'); ?>
	                    </fieldset>
	                </form>
	            </div>

	            <div class="reset-user text-left">
	                <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
	                    <?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a> |
	                <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
	                    <?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
	            </div><!--/.reset-user-->
            </div>


        </div><!--/.col-->
    </div><!--/.row-->
</div><!--/.login-->
