<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
// load tooltip behavior
JHtml::_('behavior.tooltip');
$user = JFactory::getUser();
?>
<script src="<?php echo JUri::root(); ?>components/com_gridbox/libraries/sortable/sortable.js" type="text/javascript"></script>
<script src="components/com_gridbox/assets/js/ba-admin.js?<?php echo $this->about->version; ?>" type="text/javascript"></script>
<script type="text/javascript">
    var str = "<div class='btn-wrapper' id='toolbar-theme-settings'>";
    str += "<button class='btn btn-small'><span class='icon-options'>";
    str += "</span><?php echo JText::_('SETTINGS') ?></button></div>";
    jQuery('#toolbar-copy').after(str);
</script>
<?php
include(JPATH_COMPONENT.'/views/layouts/notification.php');
include(JPATH_COMPONENT.'/views/layouts/update-message.php');
?>
<input type="hidden" value="<?php echo JText::_('JLIB_HTML_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST'); ?>" class="jlib-selection">
<div id="love-gridbox-modal" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3><?php echo JText::_('LOVE_GRIDBOX'); ?></h3>
        <p class="modal-text"><?php echo JText::_('TELL_THE_WORLD'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('NO_THANKS') ?>
        </a>
        <a href="https://extensions.joomla.org/extension/gridbox" target="_blank" class="ba-btn-primary active-button">
            <?php echo JText::_('RATE_NOW') ?>
        </a>
    </div>
</div>
<div id="delete-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3><?php echo JText::_('DELETE_ITEM'); ?></h3>
        <p class="modal-text can-delete"><?php echo JText::_('MODAL_DELETE') ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL') ?>
        </a>
        <a href="#" class="ba-btn-primary red-btn" id="apply-delete">
            <?php echo JText::_('DELETE') ?>
        </a>
    </div>
</div>
<div id="default-message-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <p class="modal-text"><?php echo JText::_('CANNOT_DELETE_DEFAULT') ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CLOSE') ?></a>
    </div>
</div>
<div id='login-modal' class='ba-modal-sm modal hide'>
    <div class='modal-body'>
        <div class="ba-login-dialog">
            <div class="ba-header-content">
                <h3 class='ba-modal-header'>
                    <?php echo JText::_('LOGIN'); ?>
                </h3>
                <label class="ba-help-icon">
                    <i class="zmdi zmdi-help"></i>
                    <span class="ba-tooltip ba-help ba-hide-element">
                        <?php echo JText::_('LOGIN_TOOLTIP'); ?>
                    </span>
                </label>
            </div>
            <div class="ba-body-content">
                <div class="ba-input-lg">
                    <input class='ba-username' type='text' autocomplete="off" placeholder="<?php echo JText::_('USERNAME'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <div class="ba-input-lg">
                    <input class='ba-password' type='password' name="ba-password" autocomplete="off"
                        placeholder="<?php echo JText::_('PASSWORD'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <input type="hidden" id="theme-id">
            </div>
            <div class="ba-footer-content">
                <a href="#" class="ba-btn-primary login-button active-button">
                    <?php echo JText::_('INSTALL'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="uploader-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none" data-check="single">
    <div class="modal-body">
        <iframe src="javascript:''" name="uploader-iframe"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<form autocomplete="off" action="<?php echo JRoute::_('index.php?option=com_gridbox&view=themes'); ?>"
    enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
    <div id="create-new-app-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-header">
            <h3 class="ba-modal-header"><?php echo JText::_('CREATE_AN_APP'); ?></h3>
        </div>
        <div class="modal-body">
            <input type="text" name="app_name" id="app-name" placeholder="<?php echo JText::_('ENTER_APP_NAME'); ?>">
            <span class="focus-underline"></span>
            <input type="hidden" name="app_type" id="app-type">
            <input type="hidden" name="ba_view" value="themes">
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary create-app"><?php echo JText::_('JTOOLBAR_APPLY') ?></a>
        </div>
    </div>
    <div id="update-dialog" class="modal hide" style="display:none">
        <div class="modal-header">
            <h3><?php echo JText::_('ACCOUNT_LOGIN') ?></h3>
        </div>
        <div class="modal-body">
            <div id="form-update">
                
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CLOSE') ?></a>
        </div>
    </div>
    <div id="theme-edit-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-header">
            <h3><?php echo JText::_('THEME_SETTINGS') ?></h3>
        </div>
        <div class="modal-body">
            <input type="text" class="theme-name" placeholder="<?php echo JText::_('JGLOBAL_TITLE'); ?>">
            <span class="focus-underline"></span>
            <div class="ba-input-lg">
                <input type="text" class="theme-image" readonly onfocus="this.blur()"
                    placeholder="<?php echo JText::_('UPLOAD_IMAGE') ?>">
                <i class="zmdi zmdi-attachment-alt"></i>
            </div>
            <div class="ba-checkbox-parent">
                <label class="ba-checkbox ba-hide-checkbox">
                    <input type="checkbox" class="theme-default ">
                    <span></span>
                </label>
                <label><?php echo JText::_('DEFAULT_THEME') ?></label>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary theme-apply"><?php echo JText::_('JTOOLBAR_APPLY') ?></a>
        </div>
    </div>
    <div class="row-fluid">
        <div id="gridbox-container">
            <div id="gridbox-content">
                <?php include(JPATH_COMPONENT.'/views/layouts/sidebar.php'); ?>
                <div class="ba-main-view">
                    <div id="filter-bar">
                        <input type="text" name="filter_search" id="filter_search"
                               value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
                               placeholder="<?php echo JText::_('JSEARCH_FILTER') ?>">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    <div class="general-tabs">
                        <ul class="nav nav-tabs uploader-nav">
                            <li class="active">
                                <a href="#installed-themes" data-toggle="tab">
                                    <i class="zmdi zmdi-cloud-done"></i>
                                    <?php echo JText::_('INSTALLED'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#upload-theme" data-toggle="tab">
                                    <i class="zmdi zmdi-cloud-download"></i>
                                    <?php echo JText::_('UPLOAD_THEME'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#import-theme" data-toggle="tab">
                                    <i class="zmdi zmdi-cloud-upload"></i>
                                    <?php echo JText::_('IMPORT'); ?>
                                </a>
                            </li>
                        </ul>
                        <div class="tabs-underline"></div>
                        <div class="tab-content">
                            <div class="theme-grid row-fluid tab-pane active" id="installed-themes">
                                <div id="installed-themes-view" class="ba-hide-checkbox">
                                    <?php foreach ($this->items as $i => $item) { ?>
                                    <label>
                                        <div class="image-container" style="background-image: url(<?php echo $item->image; ?>);"
                                            data-image="<?php echo str_replace('../', '', $item->image); ?>">
                                            <img src="components/com_gridbox/assets/images/default-theme.png">
                                        </div>
                                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                                        <p data-default="<?php echo $item->home; ?>">
                                            <?php if ($item->home == 1) { ?>
                                            <span class="default-theme">
                                                <i class="zmdi zmdi-star"></i>
                                                <span class="ba-tooltip ba-top ba-hide-element">
                                                    <?php echo JText::_('DEFAULT_THEME'); ?>
                                                </span>
                                            </span>
                                            <?php } ?>
                                            <span><?php echo $item->title; ?></span>
                                        </p>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="theme-grid row-fluid tab-pane" id="upload-theme">
                                
                            </div>
                            <div class="row-fluid tab-pane" id="import-theme">
                                <label>
                                    <span>
                                        <?php echo JText::_('IMPORT_PAGES_THEMES'); ?>
                                    </span>
                                    <label class="ba-help-icon">
                                        <i class="zmdi zmdi-help"></i>
                                        <span class="ba-tooltip ba-help ba-hide-element">
                                            <?php echo JText::_('IMPORT_PAGES_THEMES_TOOLTIP'); ?> 
                                        </span>
                                    </label>
                                </label>
                                <div>
                                    <i class="zmdi zmdi-attachment-alt theme-import-trigger"></i>
                                    <input id="theme-import-trigger" class="theme-import-trigger" readonly
                                        type="text" value="<?php echo JText::_('SELECT'); ?>">
                                    <input type="file" id="theme-import-file" name="ba-files[]" style="display: none;">
                                    <span class="focus-underline"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                    	<input type="hidden" name="context-item" value="" id="context-item" />
                        <input type="hidden" name="task" value="" />
                        <input type="hidden" name="app_order_list" value="1">
                        <input type="hidden" name="boxchecked" value="0" />
                        <?php echo JHtml::_('form.token'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="ba-context-menu theme-context-menu" style="display: none">
    <span class="theme-settings">
        <i class="zmdi zmdi-settings"></i>
        <?php echo JText::_('SETTINGS'); ?>
    </span>
    <span class="theme-duplicate">
        <i class="zmdi zmdi-copy"></i>
        <?php echo JText::_('DUPLICATE'); ?>
    </span>
    <span class="theme-delete">
        <i class="zmdi zmdi-delete"></i>
        <?php echo JText::_('DELETE'); ?>
    </span>
</div>
<?php include(JPATH_COMPONENT.'/views/layouts/context.php'); ?>
<?php include(JPATH_COMPONENT.'/views/layouts/photo-editor.php'); ?>