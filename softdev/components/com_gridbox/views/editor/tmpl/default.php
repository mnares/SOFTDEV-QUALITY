<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
$url = JUri::root().'index.php?option=com_gridbox&view=gridbox&app_id='.$this->app;
$blogFlag = false;
if ($this->edit_type != '') {
    $url.= '&edit_type='.$this->edit_type;
    $blogFlag = true;
}
$url .= '&category='.$this->category.'&id='.$_GET['id'];
$newPage = JUri::root().'index.php?option=com_gridbox&view=editor&tmpl=component';
if ($this->app != 0) {
    $newPage .= '&app_id='.$this->app;
}
if (!empty($this->category)) {
    $newPage .= '&category='.$this->category;
}
$newPage .= '&id=';
$app = JFactory::getApplication();
$gridboxId = $app->input->get('id');
$id = gridboxHelper::getTheme($gridboxId, $blogFlag);
$params = gridboxHelper::getThemeParams($id);
$theme = $params->get('params');
$user = JFactory::getUser();
$groups = $user->getAuthorisedViewLevels();
$datesFormats = array("j F Y" => "11 April 2016", "F jS, Y" => "April 11th, 2016", "F j, Y g:i a" => "April 11, 2016 11:36 am",
    "M d, Y" => "Apr 11, 2016", "d M, Y" => "11 Apr, 2016");
$dateFormatValue = isset($datesFormats[gridboxHelper::$dateFormat]) ? gridboxHelper::$dateFormat : '';
if (empty($dateFormatValue)) {
    $dateConst = JText::_('CUSTOM');
} else {
    $dateConst = $datesFormats[gridboxHelper::$dateFormat];
}
?>
<input type="hidden" class="sorting-url" value="<?php echo JURI::root(). 'components/com_gridbox/libraries/sortable/sortable.js';?>">
<input type="hidden" id="juri-root" value="<?php echo JURI::root();?>">
<div id="ba-notification">
    <i class="zmdi zmdi-close"></i>
    <h4><?php echo JText::_('ERROR'); ?></h4>
    <p></p>
</div>
<div class="end-point-cover"></div>
<div class="library-item-handle" id="library-item-handle" style="display: none;">
    <i class="zmdi zmdi-apps"></i>
</div>
<div id="lightbox-panels"></div>
<div class="tour-parent">
    <div class="product-tour editor-tour step-1">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('PAGE_BLOCKS'); ?></p>
            <p><?php echo JText::_('BUILDING_PAGES_QUICKLY'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour editor-tour step-2">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('NEW_SECTION'); ?></p>
            <p><?php echo JText::_('BUILDING_YOUR_CONTENT_BLOCKS'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour editor-tour step-3">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('MOBILE_EDITOR'); ?></p>
            <p><?php echo JText::_('CONFIGURE_YOUR_PAGE_FOR_MOBILE'); ?></p>
            <a class="ba-btn close"><?php echo JText::_('CLOSE'); ?></a>
        </div>
    </div>
</div>
<div class="product-tour-add-section">
    <i class="zmdi zmdi-plus"></i>
</div>
<div id="love-gridbox-modal" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('LOVE_GRIDBOX'); ?></h3>
        <p class="modal-text"><?php echo JText::_('TELL_THE_WORLD'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('NO_THANKS') ?>
        </a>
        <a href="https://extensions.joomla.org/extension/gridbox" target="_blank" class="ba-btn-primary active-button default-action">
            <?php echo JText::_('RATE_NOW') ?>
        </a>
    </div>
</div>
<div id="shortcuts-modal" class="ba-modal-cp modal hide" style="display: none;">
    <div class="modal-body">
        <div class="ba-modal-header">
            <h3 class="ba-modal-title"><?php echo JText::_('KEYBOARD_SHORTCUTS'); ?></h3>
            <i data-dismiss="modal" class="zmdi zmdi-close"></i>
        </div>
        <div class="shortcuts-container">
            <p class="shortcuts-group-title">
                <i class="zmdi zmdi-tune"></i>
                <?php echo JText::_('EDITOR'); ?>
            </p>
            <div class="shortcut-row">
                <p><?php echo JText::_('SAVE_PAGE'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Ctrl</span>
                    <span class="sc-btn-active">S</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('UNDO'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Ctrl</span>
                    <span class="sc-btn-active">Z</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('REDO'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Ctrl</span>
                    <span class="sc-btn">Shift</span>
                    <span class="sc-btn-active">Z</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('CLOSE_MODAL'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">X</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('SWITCH_DEVICE'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Shift</span>
                    <span class="sc-btn-active">Tab</span>
                </span>
            </div>
            <p class="shortcuts-group-title">
                <i class="zmdi zmdi-settings"></i>
                <?php echo JText::_('SETTINGS'); ?>
            </p>
            <div class="shortcut-row">
                <p><?php echo JText::_('PAGE_SETTINGS'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">S</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('THEME_SETTINGS'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">T</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('WEBSITE_SETTINGS'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">W</span>
                </span>
            </div>
            <p class="shortcuts-group-title">
                <i class="zmdi zmdi-wrench"></i>
                <?php echo JText::_('TOOLS'); ?>
            </p>
            <div class="shortcut-row">
                <p><?php echo JText::_('CODE_EDITOR'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">E</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('MEDIA_MANAGER'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">M</span>
                </span>
            </div>
            <div class="shortcut-row">
                <p><?php echo JText::_('FONT_LIBRARY'); ?></p>
                <span class="sc-btn-wrapper">
                    <span class="sc-btn">Alt</span>
                    <span class="sc-btn-active">F</span>
                </span>
            </div>
        </div>
    </div>
</div>
<div id="add-to-library-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_TO_LIBRARY'); ?>
        </h3>
        <div class="ba-input-lg">
            <input type="text" class="library-item-title reset-input-margin" placeholder="<?php echo JText::_('TITLE'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-input-lg">
            <input type="text" class="library-item-image reset-input-margin" readonly onfocus="this.blur()"
                placeholder="<?php echo JText::_('UPLOAD_IMAGE'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
        </div>
        <div class="ba-checkbox-parent">
            <label class="ba-checkbox ba-hide-checkbox">
                <input type="checkbox" class="save-as-global">
                <span></span>
            </label>
            <label><?php echo JText::_('GLOBAL_ITEM'); ?></label>
            <label class="ba-help-icon">
                <i class="zmdi zmdi-help"></i>
                <span class="ba-tooltip ba-help">
                   <?php echo JText::_('GLOBAL_ITEM_TOOLTIP'); ?> 
                </span>
            </label>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="library-apply">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="save-copy-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_COPY'); ?>
        </h3>
        <div class="ba-input-lg">
            <input type="text" class="photo-editor-file-title" placeholder="<?php echo JText::_('ENTER_FILE_NAME'); ?>">
            <span class="focus-underline"></span>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-save-copy">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="save-copy-notice-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_COPY'); ?>
        </h3>
        <p class="modal-text"><?php echo JText::_('SAVE_COPY_NOTICE'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary red-btn" id="apply-overwrite-copy">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="create-preset-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_PRESET'); ?>
        </h3>
        <div class="ba-input-lg">
            <input type="text" class="preset-title reset-input-margin" placeholder="<?php echo JText::_('ENTER_PRESET_NAME'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-checkbox-parent">
            <label class="ba-checkbox ba-hide-checkbox">
                <input type="checkbox" class="save-as-default-preset">
                <span></span>
            </label>
            <label><?php echo JText::_('DEFAULT'); ?></label>
            <label class="ba-help-icon">
                <i class="zmdi zmdi-help"></i>
                <span class="ba-tooltip ba-help">
                   <?php echo JText::_('DEFAULT_PRESET_TOOLTIP'); ?> 
                </span>
            </label>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="save-preset">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="edit-social-icon-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('ITEM') ?>
        </h3>
        <div class="ba-input-lg">
            <input type="text" class="reset-input-margin" readonly onfocus="this.blur()" data-property="icon"
                placeholder="<?php echo JText::_('ICON'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
        </div>
        <div class="ba-input-lg">
            <input type="text" class="reset-input-margin" placeholder="<?php echo JText::_('LINK'); ?>" data-property="link">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-custom-select">
            <input readonly="" onfocus="this.blur()" type="text">
            <input type="hidden" data-property="target">
            <i class="zmdi zmdi-caret-down"></i>
            <ul>
                <li data-value="_blank"><?php echo JText::_('NEW_WINDOW'); ?></li>
                <li data-value="_self"><?php echo JText::_('SAME_WINDOW'); ?></li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="social-icon-apply">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="map-item-dialog" class="ba-modal-lg modal hide">
    <div class="modal-header">
        <div class="modal-header-icon">
            <i class="zmdi zmdi-check disable-button" id="apply-marker-info"></i>
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a onclick="return false;" data-toggle="tab">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('ITEM'); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="row-fluid tab-pane active">
                <p class="ba-group-title"><?php echo JText::_('MARKER_AND_INFOBOX'); ?></p>
                <div class="ba-options-group">
                    <div class="ba-group-element">
                        <label><?php echo JText::_('UPLOAD_MARKER'); ?></label>
                        <input type="text" class="select-input" readonly onfocus="this.blur()" data-option="icon"
                            placeholder="<?php echo JText::_('SELECT'); ?>">
                        <i class="zmdi zmdi-attachment-alt"></i>
                        <div class="reset disabled-reset">
                            <i class="zmdi zmdi-close" data-option="icon"></i>
                            <span class="ba-tooltip ba-top">
                                <?php echo JText::_('RESET'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="ba-group-element">
                        <label><?php echo JText::_('DISPLAY_INFOBOX'); ?></label>
                        <label class="ba-checkbox">
                            <input type="checkbox" data-option="infobox">
                            <span></span>
                        </label>
                    </div>
                    <div class="ba-group-element">
                        <label><?php echo JText::_('DESCRIPTION'); ?></label>
                        <textarea data-option="description"
                            placeholder="<?php echo JText::_('DESCRIPTION'); ?>"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="megamenu-library-dialog" class="ba-modal-lg modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('LIBRARY'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <input type="text" value="" placeholder="<?php echo JText::_('SEARCH'); ?>" class="megamenu-library-search">
                    <i class="zmdi zmdi-search"></i>
                </li>
            </ul>
            <div class="tab-content">
                <div class="row-fluid tab-pane active">
                    <div class="ba-group-wrapper">
                        <p class="ba-group-title">
                            <span class="title"><?php echo JText::_('TITLE'); ?></span>
                            <span class="id">ID</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="slideshow-item-dialog" class="ba-modal-lg modal hide">
    <div class="modal-header">
        <div class="modal-header-icon">
            <i class="zmdi zmdi-check disable-button" id="apply-new-slide" data-edit="new"></i>
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#slideshow-add-item" data-toggle="tab">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('ITEM'); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="slideshow-add-item">
                <div class="ba-options-group">
                    <div class="ba-group-element slideshow-slide-select">
                        <label>
                            <?php echo JText::_('TYPE'); ?>
                        </label>
                        <div class="ba-custom-select slide-type-select">
                            <input readonly onfocus="this.blur()" value="" type="text">
                            <input type="hidden" value="">
                            <i class="zmdi zmdi-caret-down"></i>
                            <ul>
                                <li data-value="image"><?php echo JText::_('IMAGE'); ?></li>
                                <li class="desktop-only" data-value="video"><?php echo JText::_('VIDEO'); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="image-options" style="display: none;">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('SELECT'); ?>
                            </label>
                            <input type="text" class="select-input slide-image" readonly onfocus="this.blur()"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                    </div>
                    <div class="video-options" style="display: none;">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('VIDEO_SOURCE'); ?>
                            </label>
                            <div class="ba-custom-select video-select">
                                <input readonly onfocus="this.blur()" value="Youtube" type="text">
                                <input type="hidden" value="youtube" data-option="video-type" data-group="background">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="youtube">Youtube</li>
                                    <li data-value="vimeo">Vimeo</li>
                                    <li data-value="source"><?php echo JText::_('SOURCE_FILE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-group-element video-id">
                            <label>
                                <?php echo JText::_('VIDEO_ID'); ?>
                            </label>
                            <input type="text" class="slide-video-id" placeholder="<?php echo JText::_('VIDEO_ID'); ?>">
                        </div>
                        <div class="ba-group-element video-source-select">
                            <label>
                                <?php echo JText::_('SOURCE_FILE'); ?>
                            </label>
                            <input type="text" class="select-input" readonly onfocus="this.blur()"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('SOURCE_FILE_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('MUTE'); ?>
                            </label>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="slide-video-mute">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('START'); ?>
                            </label>
                            <input type="text" class="slide-video-start" placeholder="<?php echo JText::_('START'); ?>">
                        </div>
                        <div class="ba-group-element youtube-quality">
                            <label>
                                <?php echo JText::_('QUALITY'); ?>
                            </label>
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" value="720p" type="text">
                                <input type="hidden" value="hd720">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="hd720">720p</li>
                                    <li data-value="large">480p</li>
                                    <li data-value="medium">360p</li>
                                    <li data-value="small">240p</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="ba-group-title desktop-only"><?php echo JText::_('CAPTION'); ?></p>
                <div class="ba-options-group desktop-only">
                    <div class="ba-group-element">
                        <label>
                            <?php echo JText::_('TITLE'); ?>
                        </label>
                        <input type="text" class="slide-title" placeholder="<?php echo JText::_('TITLE'); ?>">
                    </div>
                    <div class="ba-group-element">
                        <label>
                            <?php echo JText::_('DESCRIPTION'); ?>
                        </label>
                        <textarea class="slide-description" placeholder="<?php echo JText::_('DESCRIPTION'); ?>"></textarea>
                    </div>
                </div>
                <p class="ba-group-title desktop-only"><?php echo JText::_('LINK'); ?></p>
                <div class="ba-options-group desktop-only">
                    <div class="ba-group-element">
                        <label>
                            <?php echo JText::_('VIEW'); ?>
                        </label>
                        <div class="ba-custom-select slide-button-type-select">
                            <input readonly onfocus="this.blur()" value="" type="text">
                            <input type="hidden" value="">
                            <i class="zmdi zmdi-caret-down"></i>
                            <ul>
                                <li data-value="button"><?php echo JText::_('BUTTON'); ?></li>
                                <li data-value="link"><?php echo JText::_('LINK'); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ba-group-element slideshow-button-label">
                        <label>
                            <?php echo JText::_('LABEL'); ?>
                        </label>
                        <input type="text" class="slide-button-label" placeholder="<?php echo JText::_('LABEL'); ?>">
                    </div>
                    <div class="ba-group-element link-picker-container">
                        <label>
                            <?php echo JText::_('LINK'); ?>
                        </label>
                        <input type="text" class="slide-button-link" placeholder="<?php echo JText::_('LINK'); ?>">
                        <div class="select-link">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('LINK_PICKER') ?></span>
                        </div>
                        <div class="select-file">
                            <i class="zmdi zmdi-file"></i>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('FILE_PICKER') ?></span>
                        </div>
                    </div>
                    <div class="ba-group-element">
                        <label>
                            <?php echo JText::_('TARGET'); ?>
                        </label>
                        <div class="ba-custom-select slide-button-target-select visible-select-top">
                            <input readonly onfocus="this.blur()" value="" type="text">
                            <input type="hidden" value="">
                            <i class="zmdi zmdi-caret-down"></i>
                            <ul>
                                <li data-value="_blank"><?php echo JText::_('NEW_WINDOW'); ?></li>
                                <li data-value="_self"><?php echo JText::_('SAME_WINDOW'); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ba-group-element">
                        <label>
                            <?php echo JText::_('TYPE'); ?>
                        </label>
                        <div class="ba-custom-select slide-button-attribute-select visible-select-top">
                            <input readonly onfocus="this.blur()" value="" type="text">
                            <input type="hidden" value="">
                            <i class="zmdi zmdi-caret-down"></i>
                            <ul>
                                <li data-value=""><?php echo JText::_('DEFAULT'); ?></li>
                                <li data-value="download"><?php echo JText::_('DOWNLOAD'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add-section-dialog" class="ba-modal-cp modal hide">
    <div class="modal-header">
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#columns" data-toggle="tab">
                        <?php echo JText::_('COLUMNS'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="columns" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NUMBER_OF_COLUMNS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <div class="columns-wrapper">
                                <div class="ba-column" data-count="12"></div>
                                <div class="ba-column" data-count="6+6"></div>
                                <div class="ba-column" data-count="4+4+4"></div>
                                <div class="ba-column" data-count="3+3+3+3"></div>
                            </div>
                            <div>
                                <span><?php echo JText::_("ONE"); ?></span>
                                <span><?php echo JText::_("TWO"); ?></span>
                                <span><?php echo JText::_("THREE"); ?></span>
                                <span><?php echo JText::_("FOUR"); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CUSTOM_ROW_LAYOUT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <input type="text" class="advanced-column" placeholder="3+3+3+3">
                            <a href="#" class="ba-btn-primary disable-button" id="apply-column">
                                <?php echo JText::_('SAVE'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="text-editor-dialog" class="ba-modal-lg modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('TEXT_EDITOR'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-check apply-text" data-dismiss="modal"></i>
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#" class="hide-text-editor-general">
                        <i class="zmdi zmdi-keyboard"></i>
                        <?php echo JText::_('EDITOR'); ?>
                    </a>
                </li>
                <li class="">
                    <a href="#" class="show-text-editor-general">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content hide-general-cell">
                <div class="row-fluid tab-pane active">
                    <iframe name="text-editor" src="javascript:''"></iframe>
                </div>
                <div class="text-editor-general-cell">
                    <div class="ba-settings-group text-typography-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPOGRAPHY'); ?>
                            </span>
                            <div class="ba-custom-select typography-select">
                                <input readonly onfocus="this.blur()" value="H1" type="text">
                                <input type="hidden" value="h1">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="h1">H1</li>
                                    <li data-value="h2">H2</li>
                                    <li data-value="h3">H3</li>
                                    <li data-value="h4">H4</li>
                                    <li data-value="h5">H5</li>
                                    <li data-value="h6">H6</li>
                                    <li data-value="p">Paragraph</li>
                                    <li data-value="links"><?php echo JText::_('LINKS') ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="h1">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="h1" data-callback="sectionRules">
                                    </div>
                                    <div class="reset-text-typography-wrapper">
                                        <i class="zmdi zmdi-replay reset-text-typography" data-type="reset"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RESET'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="h1" data-callback="sectionRules">
                                    </div>
                                    <div class="reset-text-typography-wrapper">
                                        <i class="zmdi zmdi-replay reset-text-typography" data-type="reset"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RESET'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="h1" data-callback="sectionRules">
                                    </div>
                                    <div class="reset-text-typography-wrapper">
                                        <i class="zmdi zmdi-replay reset-text-typography" data-type="reset"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RESET'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="h1"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                                <div class="ba-settings-item links" style="display: none;">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="links">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item links" style="display: none;">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="hover-color" data-group="links">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="map-editor-dialog" class="ba-modal-lg modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('GOOGLE_MAP'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-check apply-text" data-dismiss="modal"></i>
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content show-general-cell">
                <div class="row-fluid tab-pane active">
                    <div id="map-location"></div>
                </div>
                <div class="text-editor-general-cell">
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('SETTINGS'); ?></span>
                        </div>
                        <div class="ba-settings-item input-resize">
                            <span>
                                <?php echo JText::_('GOOGLE_MAPS_API_KEY'); ?>
                            </span>
                            <input type="text" id="google-map-api-key" value="<?php echo $this->mapsKey; ?>"
                                placeholder="<?php echo JText::_('GOOGLE_MAPS_API_KEY'); ?>">
                        </div>
                    </div>
                    <div class="settings-group-title">
                            <i class="zmdi zmdi-pin"></i>
                            <span><?php echo JText::_('LOCATIONS'); ?></span>
                        </div>
                    <div class="ba-settings-group">
                        <div class="sorting-container">
                            <div class="sorting-item" data-marker="0">
                                <input type="text" id="choose-location" data-marker="0" class="choose-location-input"
                                    placeholder="<?php echo JText::_('ENTER_LOCATION'); ?>">
                                <span class="focus-underline"></span>
                                <div class="sorting-icons">
                                    <span>
                                        <i class="zmdi zmdi-edit"></i>
                                    </span>
                                    <span>
                                        <i class="zmdi zmdi-close"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2500">
                                <input type="number" data-option="height" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('THEME'); ?>
                            </span>
                            <div class="ba-custom-select map-theme-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="standart">Standard</li>
                                    <li data-value="silver">Silver</li>
                                    <li data-value="retro">Retro</li>
                                    <li data-value="dark">Dark</li>
                                    <li data-value="night">Night</li>
                                    <li data-value="aubergine">Aubergine</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('CONTROLS'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="controls">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('SCROLL_ZOOMING'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="scrollwheel">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('DRAGGABLE_MAP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="draggable">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cke-image-modal" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('ADD_IMAGE'); ?></h3>
        <div>
            <input type="text" class="cke-upload-image" readonly onfocus="this.blur()"
                placeholder="<?php echo JText::_('SELECT'); ?>">
            <span class="focus-underline"></span>
            <i class="zmdi zmdi-attachment-alt"></i>
        </div>
        <input type="text" class="cke-image-alt" placeholder="<?php echo JText::_('IMAGE_ALT'); ?>">
        <span class="focus-underline"></span>
        <div>
            <input type="text" class="cke-image-width" placeholder="<?php echo JText::_('WIDTH'); ?>">
            <span class="focus-underline"></span>
            <input type="text" class="cke-image-height" placeholder="<?php echo JText::_('HEIGHT'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-custom-select visible-select-top cke-image-select">
            <input type="text" class="cke-image-align" readonly onfocus="this.blur()"
                placeholder="<?php echo JText::_('ALIGNMENT'); ?>">
            <input type="hidden" id="cke-image-align">
            <ul class="select-no-scroll">
                <li data-value=""><?php echo JText::_('NO_NE'); ?></li>
                <li data-value="left"><?php echo JText::_('LEFT'); ?></li>
                <li data-value="right"><?php echo JText::_('RIGHT'); ?></li>
            </ul>
            <i class="zmdi zmdi-caret-down"></i>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL') ?>
        </a>
        <a href="#" class="ba-btn-primary" id="add-cke-image">
            <?php echo JText::_('SAVE') ?>
        </a>
    </div>
</div>
<div id="delete-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('DELETE_ITEM'); ?></h3>
        <p class="modal-text can-delete"><?php echo JText::_('MODAL_DELETE') ?></p>
        <p class="modal-text global-library-delete" style="display: none;">
            <?php echo JText::_('ATTENTION_DELETE_GLOBAL') ?>
        </p>
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
<div id="add-to-menu-modal" class="ba-modal-sm modal hide" style="display: none;" aria-hidden="false">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('ADD_TO_MENU'); ?></h3>
        <div class="ba-input-lg">
            <input type="text" class="menu-item-title reset-input-margin" placeholder="<?php echo JText::_('MENU_TITLE'); ?>">
            <span class="focus-underline"></span>    
        </div>
        <div class="ba-custom-select menu-type-select">
            <input readonly onfocus="this.blur()" type="text" value="" class="reset-input-margin">
            <input type="hidden" value="">
            <i class="zmdi zmdi-caret-down"></i>
            <ul>
                <?php
                foreach ($this->menutypes as $menu) {
                    $str = '<li data-value="'.$menu->menutype.'">';
                    $str .= $menu->title.'</li>';
                    echo $str;
                }
                ?>
            </ul>
        </div>
        <div class="ba-custom-select menu-items-select visible-select-top">
            <input readonly onfocus="this.blur()" type="text" value="">
            <input type="hidden" value="">
            <i class="zmdi zmdi-caret-down"></i>
            <ul>
                <li data-value="1" class="item-root"><?php echo JText::_('MENU_ITEM_ROOT'); ?></li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="add-to-menu">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="add-new-element-modal" class="ba-modal-sm modal hide" style="display: none;" aria-hidden="false">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('ITEM'); ?></h3>
        <div class="ba-input-lg">
            <input type="text" class="element-title reset-input-margin" placeholder="<?php echo JText::_('TITLE'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div>
            <input class="select-input select-item-icon" type="text" readonly onfocus="this.blur()"
                placeholder="<?php echo JText::_('ICON'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
            <div class="reset-element-icon">
                <i class="zmdi zmdi-close"></i>
                <span class="ba-tooltip ba-top">
                    <?php echo JText::_('RESET'); ?>
                </span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-new-element">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="one-page-item-modal" class="ba-modal-sm modal hide" style="display: none;" aria-hidden="false">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('ITEM'); ?></h3>
        <div class="ba-input-lg">
            <input type="text" class="element-title reset-input-margin" placeholder="<?php echo JText::_('TITLE'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-input-lg">
            <input type="text" class="element-alias reset-input-margin" placeholder="<?php echo JText::_('ALIAS'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-input-lg">
            <input type="text" readonly onfocus="this.blur()" class="select-end-point select-input reset-input-margin"
                placeholder="<?php echo JText::_('SELECT_END_POINT'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
        </div>
        <div class="ba-input-lg">
            <input class="select-item-icon" type="text" readonly onfocus="this.blur()"
                placeholder="<?php echo JText::_('ICON'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
            <div class="reset-element-icon">
                <i class="zmdi zmdi-close"></i>
                <span class="ba-tooltip ba-top">
                    <?php echo JText::_('RESET'); ?>
                </span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-one-page-item">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>
<div id="menu-item-add-modal" class="ba-modal-sm modal hide" style="display: none;" aria-hidden="false">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('ITEM'); ?></h3>
        <div class="ba-input-lg">
            <input type="text" class="reset-input-margin" data-property="title" placeholder="<?php echo JText::_('TITLE'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-input-lg">
            <input type="text" readonly="" onfocus="this.blur()" data-property="link" class="reset-input-margin select-link"
                placeholder="<?php echo JText::_('PAGE'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
        </div>
        <div class="ba-custom-select menu-items-select-parent visible-select-top">
            <input readonly="" onfocus="this.blur()" type="text" value="">
            <input type="hidden" value="1">
            <i class="zmdi zmdi-caret-down"></i>
            <ul>
                <li data-value="1" class="item-root"><?php echo JText::_('MENU_ITEM_ROOT'); ?></li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-new-menu-item">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>

<div id="menu-item-edit-modal" class="ba-modal-sm modal hide" style="display: none;" aria-hidden="false">
    <div class="modal-body">
        <h3 class="ba-modal-title"><?php echo JText::_('ITEM'); ?></h3>
        <div class="ba-input-lg">
            <input type="text" data-property="title" class="reset-input-margin" placeholder="<?php echo JText::_('TITLE'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-input-lg">
            <input type="text" readonly onfocus="this.blur()" data-property="icon" class="reset-input-margin select-item-icon"
                placeholder="<?php echo JText::_('ICON'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
            <div class="reset-element-icon">
                <i class="zmdi zmdi-close"></i>
                <span class="ba-tooltip ba-top">
                    <?php echo JText::_('RESET'); ?>
                </span>
            </div>
        </div>
        <div class="ba-checkbox-parent">
                <label class="ba-checkbox ba-hide-checkbox">
                    <input type="checkbox" data-property="megamenu">
                    <span></span>
                </label>
                <label><?php echo JText::_('MEGAMENU'); ?></label>
            </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-menu-item">
            <?php echo JText::_('SAVE'); ?>
        </a>
    </div>
</div>

<div class="ba-toolbar">
    <div class="ba-toolbar-group">
        <div class="ba-toolbar-element gridbox-save">
            <i class="zmdi zmdi-check"></i>
            <span class="ba-toolbar-label">
                <?php echo JText::_('SAVE'); ?>
            </span>
        </div>
    </div>
    <div class="ba-toolbar-group">
        <div class="ba-toolbar-element ba-action-undo" data-module="actionUndo">
            <i class="zmdi zmdi-arrow-left"></i>
            <span class="ba-tooltip ba-bottom">
                <?php echo JText::_('UNDO'); ?>
            </span>
        </div>
        <div class="ba-toolbar-element ba-action-redo" data-module="actionRedo">
            <i class="zmdi zmdi-arrow-right"></i>
            <span class="ba-tooltip ba-bottom">
                <?php echo JText::_('REDO'); ?>
            </span>
        </div>
    </div>
    <div class="ba-toolbar-group">
        <div class="ba-toolbar-element<?php echo $this->website->disable_responsive == 1 ? ' disable-button' : ''; ?>"
            data-context="responsive-context-menu">
            <i class="zmdi zmdi-desktop-windows"></i>
            <span class="ba-toolbar-label">
                <?php echo JText::_('DESKTOP'); ?>
            </span>
            <i class="zmdi zmdi-caret-down"></i>
        </div>
    </div>
<?php
if (in_array($theme->access, $groups)) {
?>
    <div class="ba-toolbar-group">
        <div class="ba-toolbar-element" data-context="tools-context-menu">
            <i class="zmdi zmdi-wrench"></i>
            <span class="ba-toolbar-label">
                <?php echo JText::_('TOOLS'); ?>
            </span>
            <i class="zmdi zmdi-caret-down"></i>
        </div>
    </div>
<?php
}
?>
    <div class="ba-toolbar-group">
        <div class="ba-toolbar-element" data-context="page-context-menu">
            <i class="zmdi zmdi-settings"></i>
            <span class="ba-toolbar-label">
                <?php echo JText::_('PAGE'); ?>
            </span>
            <i class="zmdi zmdi-caret-down"></i>
        </div>
<?php
if (in_array($theme->access, $groups)) {
?>
        <div class="ba-toolbar-element ba-theme-editor">
            <i class="zmdi zmdi-format-color-fill"></i>
            <span class="ba-toolbar-label">
                <?php echo JText::_('THEME'); ?>
            </span>
        </div>
<?php
}
?>
        <div class="ba-toolbar-element ba-site-settings">
            <i class="zmdi zmdi-globe"></i>
            <span class="ba-toolbar-label">
                <?php echo JText::_('SITE'); ?>
            </span>
        </div>
    </div>
</div>
<div class="ba-sidebar">
    <div class="top-icons <?php echo $this->item->app_type == 'blog' ? 'blog-editing' : ''; ?>">
        <span class="add-page-block"
        <?php echo $this->item->app_type != 'blog' && $this->edit_type != 'blog' ? ' data-context="section-page-blocks-list"' : ''; ?>>
            <a href="#">
                <span class="zmdi zmdi-collection-plus"></span>
            </a>
            <span class="ba-tooltip ba-right">
                <?php echo JText::_('PAGE_BLOCKS'); ?>
            </span>
        </span>
        <span class="add-library-block" data-context="section-library-list">
            <a href="#">
                <span class="zmdi zmdi-collection-text"></span>
            </a>
            <span class="ba-tooltip ba-right">
                <?php echo JText::_('LIBRARY'); ?>
            </span>
        </span>
        <span class="hide-hidden-elements" style="display: none;">
            <a href="#">
                <span class="zmdi zmdi-eye"></span>
            </a>
            <span class="ba-tooltip ba-right">
                <?php echo JText::_('SHOW_HIDDEN'); ?>
            </span>
        </span>
        <span class="show-hidden-elements">
            <a href="#">
                <span class="zmdi zmdi-eye-off"></span>
            </a>
            <span class="ba-tooltip ba-right">
                <?php echo JText::_('HIDE_HIDDEN'); ?>
            </span>
        </span>
    </div>
    <div class="bottom-icons" data-context="help-context-menu">
        <span class="gridbox-help">
            <a href="#">
                <span class="zmdi zmdi-help"></span>
            </a>
            <span class="ba-tooltip ba-right"><?php echo JText::_('HELP'); ?></span>
        </span>
        <span class="joomla-admin">
            <a href="<?php echo JUri::root().'administrator/index.php?option=com_gridbox'; ?>" class="default-action" target="_blank">
                <span class="fa fa-joomla"></span>
            </a>
            <span class="ba-tooltip ba-right"><?php echo JText::_('ADMIN_PANEL'); ?></span>
        </span>
    </div>
</div>
<div id="code-editor-dialog" class="ba-modal-lg modal hide" style="display: none;">
    <div class="modal-header">
        <h3 class="ba-modal-title"><?php echo JText::_('CODE_EDITOR'); ?></h3>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs code-nav">
                <li class="active">
                    <a href="#code-edit-css" data-toggle="tab">
                        css
                    </a>
                </li>
                <li>
                    <a href="#code-edit-javascript" data-toggle="tab">
                        javascript
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="code-edit-css" class="row-fluid tab-pane active">
                    <textarea id="code-editor-css"></textarea>
                    <span></span>
                </div>
                <div id="code-edit-javascript" class="row-fluid tab-pane">
                    <textarea id="code-editor-javascript"></textarea>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <i class="zmdi zmdi-format-valign-center resizable-handle-right"></i>
</div>
<div id="color-variables-dialog" class="modal hide" style="display: none;">
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs code-nav">
                <li class="active">
                    <a href="#color-picker-cell" data-toggle="tab">
                        <i class="zmdi zmdi-eyedropper"></i>
                    </a>
                </li>
                <li>
                    <a href="#color-variables-cell" data-toggle="tab">
                        <i class="zmdi zmdi-format-color-fill "></i>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="color-picker-cell" class="row-fluid tab-pane active">
                    <input type="hidden" data-dismiss="modal">
                    <input type="text" class="variables-color-picker">
                    <span class="minicolors-opacity-wrapper">
                        <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY'); ?></span>
                    </span>
                </div>
                <div id="color-variables-cell" class="row-fluid tab-pane">
                    <div class="color-variables-group">
                        <div class="color-variables-group-title">
                            <span><?php echo JText::_('BRAND'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@primary">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('PRIMARY'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@secondary">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('SECONDARY'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@accent">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('ACCENT'); ?></span>
                        </div>
                    </div>
                    <div class="color-variables-group">
                        <div class="color-variables-group-title">
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@title">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('TITLE'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@subtitle">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('SUBTITLE'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@text">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('TEXT'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@icon">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('ICON'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@title-inverse">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('TITLE_INVERSE'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@text-inverse">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('TEXT_INVERSE'); ?></span>
                        </div>
                    </div>
                    <div class="color-variables-group">
                        <div class="color-variables-group-title">
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@bg-primary">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('PRIMARY'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@bg-secondary">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('SECONDARY'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@bg-dark">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('DARK'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@bg-dark-accent">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('DARK_ACCENT'); ?></span>
                        </div>
                    </div>
                    <div class="color-variables-group">
                        <div class="color-variables-group-title">
                            <span><?php echo JText::_('OTHER'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@border">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@shadow">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@overlay">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@hover">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('HOVER'); ?></span>
                        </div>
                    </div>
                    <div class="color-variables-group">
                        <div class="color-variables-group-title">
                            <span><?php echo JText::_('CUSTOM_COLORS') ?></span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-1">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 1</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-2">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 2</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-3">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 3</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-4">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 4</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-5">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 5</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-6">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 6</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-7">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 7</span>
                        </div>
                        <div class="color-variables-item" data-variable="@color-8">
                            <span class="color-varibles-color-swatch"></span>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('COLOR'); ?> 8</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="custom-html-dialog" class="ba-modal-lg modal hide" style="display: none;">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('CUSTOM_HTML'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs code-nav">
                <li class="active">
                    <a href="#custom-edit-html" data-toggle="tab" class="hide-text-editor-general">
                        <i class="zmdi zmdi-language-html5"></i>
                        html
                    </a>
                </li>
                <li>
                    <a href="#custom-edit-css" data-toggle="tab" class="hide-text-editor-general">
                        <i class="zmdi zmdi-language-css3"></i>
                        css
                    </a>
                </li>
                <li>
                    <a href="#" class="show-text-editor-general">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content hide-general-cell">
                <div id="custom-edit-html" class="row-fluid tab-pane active">
                    <textarea id="custom-html-edit-html"></textarea>
                    <span></span>
                </div>
                <div id="custom-edit-css" class="row-fluid tab-pane">
                    <textarea id="custom-html-edit-css"></textarea>
                    <span></span>
                </div>
                <div class="text-editor-general-cell">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add-plugin-dialog" class="ba-modal-lg modal hide" style="display: none;">
    <div class="modal-header">
        <h3 class="ba-modal-title"><?php echo JText::_('PLUGINS'); ?></h3>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="plugin-search-bar">
            <input class="plugin-search">
            <i class="zmdi zmdi-search"></i>
        </div>
        <div class="ba-plugin-list-wrapper">
<?php
foreach ($this->plugins as $key => $value) {
    $name = str_replace('-', '_', $key);
    $name = strtoupper($name);
?>
        <div class="ba-plugin-group" data-type="<?php echo $key; ?>">
            <p><?php echo JText::_($name); ?></p>
<?php
    foreach ($value as $plugin) {
?>
            <div class="ba-plugin" data-plugin="<?php echo $plugin->title; ?>">
                <i class="<?php echo $plugin->image; ?>"></i>
                <span class="ba-title"><?php echo JText::_($plugin->joomla_constant); ?></span>
            </div>
<?php
    }
?>
        </div>
<?php
}
?>
        </div>
    </div>
</div>
<div id='login-modal' class='ba-modal-sm modal hide'>
    <div class='modal-body'>
        <div class="ba-login-dialog">
            <div class="ba-header-content">
                <h3 class='ba-modal-title'>
                    <?php echo JText::_('LOGIN'); ?>
                </h3>
                <label class="ba-help-icon">
                    <i class="zmdi zmdi-help"></i>
                    <span class="ba-tooltip ba-help ba-hide-element">
                        <?php echo JText::_('LOGIN_BALBOOA_TOOLTIP'); ?>
                    </span>
                </label>
            </div>
            <div class="ba-body-content">
                <input type="hidden" id="installing-const" value="<?php echo JText::_('INSTALLING'); ?>">
                <div class="ba-input-lg">
                    <input class='ba-username reset-input-margin' type='text' name="login"
                        placeholder="<?php echo JText::_('USERNAME'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <div class="ba-input-lg">
                    <input class='ba-password' type='password' name="password" placeholder="<?php echo JText::_('PASSWORD'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <input type="hidden" name="plugin_id" id="plugin-id">
            </div>
            <div class="ba-footer-content">
                <a href="#" class="ba-btn-primary login-button active-button">
                    <?php echo JText::_('INSTALL'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="fonts-editor-dialog" class="ba-modal-lg modal hide" style="display: none;">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('FONT_LIBRARY'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
    </div>
</div>
<div id="icon-upload-dialog" class="ba-modal-lg modal hide" style="display: none;">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('LIBRARY_ICONS'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-fullscreen media-fullscrean"></i>
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
    </div>
</div>
<div id="uploader-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none" data-check="single">
    <div class="modal-body">
        <iframe src="javascript:''" name="uploader-iframe"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div id="link-select-modal" class="ba-modal-md modal ba-modal-dialog hide" style="display:none" data-check="single">
    <div class="modal-body">
        <div class="ba-modal-header">
            <h3 class="ba-modal-title"><?php echo JText::_('LINK_PICKER'); ?></h3>
            <i data-dismiss="modal" class="zmdi zmdi-close"></i>
        </div>
        <div class="availible-folders">

        </div>
        <input type="hidden" data-dismiss="modal">
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL'); ?></a>
        <a href="#" class="ba-btn-primary apply-link disable-button"><?php echo JText::_('SAVE'); ?></a>
    </div>
</div>
<?php
    if (isset($this->item->app_type) && $this->item->app_type == 'blog') {
?>
<div id="blog-content-dialog" class="ba-modal-lg modal ba-modal-dialog hide fullscrean" style="display:none">
    <div class="modal-header">
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#" class="hide-text-editor-general">
                        <i class="zmdi zmdi-keyboard"></i>
                        <?php echo JText::_('EDITOR'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content hide-general-cell">
                <div class="row-fluid tab-pane active">
                    <iframe name="blog-editor" src="javascript:''"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div id="menu-select-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none" data-check="single">
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div id="pages-list-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none">
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div id="gallery-list-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none">
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div id="forms-list-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none">
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div id="modules-list-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none">
    <div class="modal-body">
        <iframe src="javascript:''"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div class="ba-context-menu section-library-list left-context-menu" style="display: none;">
    <div class="">
        <ul class="nav nav-tabs">
            <li class="active">
<?php
            if ($this->item->app_type != 'blog' && $this->edit_type != 'blog') {
?>
                <a href="#section-library-cell" data-toggle="tab">
                    <i class="zmdi zmdi-puzzle-piece"></i>
                    <?php echo JText::_('SECTIONS'); ?>
                </a>
            </li>
            <li>
<?php
            }
?>
                <a href="#plugins-library-cell" data-toggle="tab">
                    <i class="zmdi zmdi-label"></i>
                    <?php echo JText::_('PLUGINS'); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
<?php
        if ($this->item->app_type != 'blog' && $this->edit_type != 'blog') {
?>
            <div id="section-library-cell" class="row-fluid tab-pane active">
                <div class="empty-list">
                    <i class="zmdi zmdi-alert-polygon"></i>
                    <p><?php echo JText::_('NO_ITEMS_HERE'); ?></p>
                </div>
            </div>
            <div id="plugins-library-cell" class="row-fluid tab-pane">
<?php
        } else {
?>
            <div id="plugins-library-cell" class="row-fluid tab-pane active">
<?php
        }
?>
                <div class="empty-list">
                    <i class="zmdi zmdi-alert-polygon"></i>
                    <p><?php echo JText::_('NO_ITEMS_HERE'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ba-context-menu section-page-blocks-list left-context-menu" style="display: none;">
    <div class="">
        <ul class="nav nav-tabs">
<?php
        $active = 'active';
        foreach ($this->blocks as $key => $block) {
            $name = str_replace('-', '_', $key);
            $name = strtoupper($name);
?>
            <li class="<?php echo $active; ?>">
                <a href="#<?php echo $key; ?>-page-blocks" data-toggle="tab">
                    <i class="<?php echo $this->blocksIcon[$key]; ?>"></i>
                    <?php echo JText::_($name); ?>
                </a>
            </li>
<?php
            $active = '';
        }
?>
        </ul>
        <div class="tab-content">
<?php
        $active = ' active';
        foreach ($this->blocks as $key => $value) {
?>
            <div id="<?php echo $key; ?>-page-blocks" class="row-fluid tab-pane<?php echo $active; ?>">
<?php
            $active = '';
            foreach ($value as $block) {
?>
                <span class="ba-page-block-item <?php echo $block->id == 0 ? 'disabled' : ''; ?>" data-id="<?php echo $block->title; ?>">
                    <img src="<?php echo JUri::root().'components/com_gridbox/assets/images/page-blocks/'.$block->image; ?>">
                </span>
<?php
            }
?>
            </div>
<?php
        }
?>
        </div>
    </div>
</div>
<div class="ba-context-menu page-context-menu" style="display: none;">
<?php
if ($this->edit_type == '') {
?>
    <span class="ba-page-settings">
        <i class="zmdi zmdi-wrench"></i>
        <span><?php echo JText::_('SETTINGS'); ?></span>
    </span>
<?php
}
if ($this->edit_type != 'system') {
?>
    <span class="add-to-menu">
        <i class="zmdi zmdi-star"></i>
        <span><?php echo JText::_('ADD_TO_MENU'); ?></span>
    </span>
<?php
}
if ($this->edit_type == '' || $this->edit_type == 'system') {
?>
    <span>
        <a target="_blank" href="<?php echo $newPage; ?>" class="default-action create-new-page">
            <i class="zmdi zmdi-plus-circle"></i>
            <span><?php echo JText::_('NEW_PAGE'); ?></span>
        </a>
    </span>
<?php
}
?>
    <span class="pages-list">
        <i class="zmdi zmdi-file"></i>
        <span><?php echo JText::_('PAGES'); ?></span>
    </span>
</div>
<div class="ba-context-menu responsive-context-menu" style="display: none;">
    <span data-width="100%" data-view="desktop">
        <i class="zmdi zmdi-desktop-windows"></i>
        <span><?php echo JText::_('DESKTOP'); ?></span>
    </span>
    <span data-width="<?php echo $this->breakpoints->tablet; ?>px" data-view="tablet">
        <i class="zmdi zmdi-tablet"></i>
        <span><?php echo JText::_('TABLET_LANDSCAPE'); ?></span>
    </span>
    <span data-width="<?php echo $this->breakpoints->{'tablet-portrait'}; ?>px" data-view="tablet-portrait">
        <i class="zmdi zmdi-tablet-mac"></i>
        <span><?php echo JText::_('TABLET_PORTRAIT'); ?></span>
    </span>
    <span data-width="<?php echo $this->breakpoints->phone; ?>px" data-view="phone">
        <i class="zmdi zmdi-smartphone-landscape"></i>
        <span><?php echo JText::_('PHONE_LANDSCAPE'); ?></span>
    </span>
    <span data-width="<?php echo $this->breakpoints->{'phone-portrait'}; ?>px" data-view="phone-portrait">
        <i class="zmdi zmdi-smartphone-android"></i>
        <span><?php echo JText::_('PHONE_PORTRAIT'); ?></span>
    </span>
</div>
<div class="ba-context-menu help-context-menu" style="display: none">
    <span class="shortcuts-gridbox">
        <i class="zmdi zmdi-keyboard"></i><?php echo JText::_('SHORTCUTS'); ?>
    </span>
    <span class="documentation">
        <a target="_blank" href="http://www.balbooa.com/gridbox-documentation/basics/key-features" class="default-action">
            <i class="zmdi zmdi-info"></i><?php echo JText::_('DOCUMENTATION'); ?>
        </a>
    </span>
    <span class="support">
        <a target="_blank" href="http://support.balbooa.com/forum/gridbox" class="default-action">
            <i class="zmdi zmdi-help"></i><?php echo JText::_('SUPPORT'); ?>
        </a>
    </span>
    <span class="love-gridbox ba-group-element">
        <i class="zmdi zmdi-favorite"></i><?php echo JText::_('LOVE_GRIDBOX'); ?>
    </span>
</div>
<div class="ba-context-menu section-context-menu" style="display: none">
    <span class="context-edit-item">
        <i class="zmdi zmdi-edit"></i>
        <?php echo JText::_('EDIT'); ?>
    </span>
    <span class="ba-group-element context-add-new-row">
        <i class="zmdi zmdi-plus-circle"></i>
        <?php echo JText::_('NEW_ROW'); ?>
    </span>
    <span class="context-add-to-library">
    <i class="zmdi zmdi-globe"></i>
        <?php echo JText::_('ADD_TO_LIBRARY'); ?>
    </span>
    <span class="ba-group-element context-copy-item">
        <i class="zmdi zmdi-copy"></i>
        <?php echo JText::_('COPY'); ?>
    </span>
    <span class="context-copy-content">
        <i class="zmdi zmdi-collection-text"></i>
        <?php echo JText::_('COPY_CONTENT'); ?>
    </span>
    <span class="context-copy-style">
        <i class="zmdi zmdi-roller"></i>
        <?php echo JText::_('COPY_STYLE'); ?>
    </span>
    <span class="ba-group-element disable-button context-paste-buffer">
        <i class="zmdi zmdi-assignment-o"></i>
        <?php echo JText::_('PASTE'); ?>
    </span>
    <span class="ba-group-element context-reset-style">
        <i class="zmdi zmdi-replay"></i>
        <?php echo JText::_('RESET_STYLE'); ?>
    </span>
    <span class="context-delete-content">
        <i class="zmdi zmdi-close"></i>
        <?php echo JText::_('CLEAR_CONTENTS'); ?>
    </span>
    <span class="ba-group-element context-delete-item">
        <i class="zmdi zmdi-delete"></i>
        <?php echo JText::_('DELETE'); ?>
    </span>
</div>
<div class="ba-context-menu row-context-menu" style="display: none">
    <span class="context-edit-item">
        <i class="zmdi zmdi-edit"></i>
        <?php echo JText::_('EDIT'); ?>
    </span>
    <span class="ba-group-element context-modify-columns">
        <i class="zmdi zmdi-plus-circle"></i>
        <?php echo JText::_('MODIFY_COLUMNS'); ?>
    </span>
    <span class="ba-group-element context-copy-item">
        <i class="zmdi zmdi-copy"></i>
        <?php echo JText::_('COPY'); ?>
    </span>
    <span class="context-copy-style">
        <i class="zmdi zmdi-roller"></i>
        <?php echo JText::_('COPY_STYLE'); ?>
    </span>
    <span class="ba-group-element disable-button context-paste-buffer">
        <i class="zmdi zmdi-assignment-o"></i>
        <?php echo JText::_('PASTE'); ?>
    </span>
    <span class="ba-group-element context-reset-style">
        <i class="zmdi zmdi-replay"></i>
        <?php echo JText::_('RESET_STYLE'); ?>
    </span>
    <span class="ba-group-element context-delete-item">
        <i class="zmdi zmdi-delete"></i>
        <?php echo JText::_('DELETE'); ?>
    </span>
</div>
<div class="ba-context-menu column-context-menu" style="display: none">
    <span class="context-edit-item">
        <i class="zmdi zmdi-edit"></i>
        <?php echo JText::_('EDIT'); ?>
    </span>
    <span class="ba-group-element context-add-nested-row">
        <i class="zmdi zmdi-plus-circle"></i>
        <?php echo JText::_('NESTED_ROW'); ?>
    </span>
    <span class="context-add-new-element">
        <i class="zmdi zmdi-plus-circle"></i>
        <?php echo JText::_('ADD_NEW_ELEMENT'); ?>
    </span>
    <span class="ba-group-element context-copy-content">
        <i class="zmdi zmdi-collection-text"></i>
        <?php echo JText::_('COPY_CONTENT'); ?>
    </span>
    <span class="context-copy-style">
        <i class="zmdi zmdi-roller"></i>
        <?php echo JText::_('COPY_STYLE'); ?>
    </span>
    <span class="ba-group-element disable-button context-paste-buffer">
        <i class="zmdi zmdi-assignment-o"></i>
        <?php echo JText::_('PASTE'); ?>
    </span>
    <span class="ba-group-element context-reset-style">
        <i class="zmdi zmdi-replay"></i>
        <?php echo JText::_('RESET_STYLE'); ?>
    </span>
    <span class="context-delete-content">
        <i class="zmdi zmdi-close"></i>
        <?php echo JText::_('CLEAR_CONTENTS'); ?>
    </span>
</div>
<div class="ba-context-menu plugin-context-menu" style="display: none">
    <span class="context-edit-item">
        <i class="zmdi zmdi-edit"></i>
        <?php echo JText::_('EDIT'); ?>
    </span>
    <span class="ba-group-element context-add-to-library">
    <i class="zmdi zmdi-globe"></i>
        <?php echo JText::_('ADD_TO_LIBRARY'); ?>
    </span>
    <span class="ba-group-element context-copy-item">
        <i class="zmdi zmdi-copy"></i>
        <?php echo JText::_('COPY'); ?>
    </span>
    <span class="context-copy-style">
        <i class="zmdi zmdi-roller"></i>
        <?php echo JText::_('COPY_STYLE'); ?>
    </span>
    <span class="ba-group-element disable-button context-paste-buffer">
        <i class="zmdi zmdi-assignment-o"></i>
        <?php echo JText::_('PASTE'); ?>
    </span>
    <span class="ba-group-element context-reset-style">
        <i class="zmdi zmdi-replay"></i>
        <?php echo JText::_('RESET_STYLE'); ?>
    </span>
    <span class="ba-group-element context-delete-item">
        <i class="zmdi zmdi-delete"></i>
        <?php echo JText::_('DELETE'); ?>
    </span>
</div>
<iframe class="editor-iframe" style="width: 100%;" src="<?php echo $url; ?>" name="editor-iframe"></iframe>
<div class="ba-context-menu save-image-context-menu" style="display: none;">
    <span class="photo-editor-save-copy">
        <span><?php echo JText::_('SAVE_COPY'); ?></span>
    </span>
    <span class="save-photo-editor-image">
        <span><?php echo JText::_('SAVE'); ?></span>
    </span>
</div>
<div class="ba-context-menu tools-context-menu" style="display: none;">
    <span class="show-media-manager">
        <i class="zmdi zmdi-camera-alt"></i>
        <span><?php echo JText::_('MEDIA_MANAGER'); ?></span>
    </span>
    <span class="show-font-library">
        <i class="zmdi zmdi-brightness-auto"></i>
        <span><?php echo JText::_('FONT_LIBRARY'); ?></span>
    </span>
    <span class="ba-code-editor">
        <i class="zmdi zmdi-code-setting"></i>
        <span><?php echo JText::_('CODE_EDITOR'); ?></span>
    </span>
</div>
<div class="preloader ba-preloader-slide">
    <div class="preloader-left-section"></div>
</div>
<div id="site-dialog" class="ba-modal-lg modal hide" style="display:none">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('SITE'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#site-options" data-toggle="tab">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#mobile-options" data-toggle="tab">
                        <i class="zmdi zmdi-tv"></i>
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="site-options" class="row-fluid tab-pane active">
                    <div class="ba-options-group">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('FAVICON'); ?>
                            </label>
                            <input type="text" readonly onfocus="this.blur()" class="favicon select-favicon"
                                value="<?php echo $this->website->favicon; ?>" placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <input type="hidden" class="favicon-error" value="<?php echo JText::_('NOT_SUPPORTED_FILE'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('FAVICON_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <p class="ba-group-title"><?php echo JText::_('CUSTOM_CODE'); ?></p>
                    <div class="ba-options-group">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('HEADER_CODE'); ?>
                            </label>
                            <textarea class="header-code"
                                placeholder="<?php echo JText::_('HEADER_CODE'); ?>"><?php echo $this->website->header_code; ?></textarea>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CUSTOM_CODE_TOOLTIP'); ?> head
                                </span>
                            </label>
                        </div>
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('BODY_CODE'); ?>
                            </label>
                            <textarea class="body-code"
                                placeholder="<?php echo JText::_('BODY_CODE'); ?>"><?php echo $this->website->body_code; ?></textarea>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CUSTOM_CODE_TOOLTIP'); ?> body
                                </span>
                            </label>
                        </div>
                    </div>
                    <p class="ba-group-title"><?php echo JText::_('DATE_FORMATS'); ?></p>
                    <div class="ba-options-group">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('DATE_FROMAT'); ?>
                            </label>
                            <div class="ba-custom-select date-format-select visible-select-top">
                                <input readonly="" onfocus="this.blur()" type="text" value="<?php echo $dateConst; ?>">
                                <input type="hidden" value="<?php echo $dateFormatValue; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="j F Y">11 April 2016</li>
                                    <li data-value="F jS, Y">April 11th, 2016</li>
                                    <li data-value="F j, Y g:i a">April 11, 2016 11:36 am</li>
                                    <li data-value="M d, Y">Apr 11, 2016</li>
                                    <li data-value="d M, Y">11 Apr, 2016</li>
                                    <li data-value=""><?php echo JText::_('CUSTOM'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-group-element ba-custom-date-format"
                            style="<?php echo !empty($dateFormatValue) ? 'display: none;' : ''; ?>">
                            <label>
                                <?php echo JText::_('CUSTOM'); ?>
                            </label>
                            <input type="text" placeholder="F j, Y"
                                value="<?php echo gridboxHelper::$dateFormat; ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CUSTOM_DATE_FORMAT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="mobile-options" class="row-fluid tab-pane">
                    <div class="ba-options-group">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('CONTAINER'); ?>, px
                            </label>
                            <input type="number" class="website-container" value="<?php echo $this->website->container; ?>">
                        </div>
                        <div class="ba-group-element">
                            <label><?php echo JText::_('DISABLE_RESPONSIVE'); ?></label>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="disable-responsive"
                                    <?php echo $this->website->disable_responsive == 1 ? 'checked' : ''; ?>>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <p class="ba-group-title"><?php echo JText::_('BREAKPOINTS'); ?></p>
                    <div class="ba-options-group">
                        <div class="ba-group-element breakpoints-container">
                            <label>
                                <?php echo JText::_('TABLET_LANDSCAPE'); ?>, px
                            </label>
                            <input type="number" value="<?php echo $this->breakpoints->tablet; ?>" data-breakpoint="tablet">
                        </div>
                        <div class="ba-group-element breakpoints-container">
                            <label>
                                <?php echo JText::_('TABLET_PORTRAIT'); ?>, px
                            </label>
                            <input type="number" value="<?php echo $this->breakpoints->{'tablet-portrait'}; ?>"
                                data-breakpoint="tablet-portrait">
                        </div>
                        <div class="ba-group-element breakpoints-container">
                            <label>
                                <?php echo JText::_('PHONE_LANDSCAPE'); ?>, px
                            </label>
                            <input type="number" value="<?php echo $this->breakpoints->phone; ?>" data-breakpoint="phone">
                        </div>
                        <div class="ba-group-element breakpoints-container">
                            <label>
                                <?php echo JText::_('PHONE_PORTRAIT'); ?>, px
                            </label>
                            <input type="number" value="<?php echo $this->breakpoints->{'phone-portrait'}; ?>"
                                data-breakpoint="phone-portrait">
                        </div>
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('MOBILE_MENU'); ?>, px
                            </label>
                            <input type="number" value="<?php echo gridboxHelper::$menuBreakpoint; ?>" class="menu-breakpoint">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="photo-editor-dialog" class="ba-modal-lg modal hide" style="display:none">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('PHOTO_EDITOR'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#resize-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-wallpaper"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('RESIZE'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#crop-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-crop"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('CROP'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#flip-rotate-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-flip"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_ROTATE'); ?></span>
                    </a>
                </li>
                <span class="photo-editor-save-image" data-context="save-image-context-menu">
                    <span><?php echo JText::_('SAVE'); ?></span>
                    <i class="zmdi zmdi-caret-down"></i>
                </span>
            </ul>
            <div class="tabs-underline"></div>
            <div class="resize-image-wrapper">
                <div>
                    <canvas id="photo-editor"></canvas>
                </div>
                <div class="ba-crop-overlay" style="opacity: 0;">
                    <canvas id="ba-overlay-canvas"></canvas>
                    <span class="ba-crop-overlay-resize-handle" data-resize="top-left"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="top-right"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="bottom-left"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="bottom-right"></span>
                </div>
            </div>
            <div class="tab-content">
                <div id="resize-image-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('WIDTH'); ?></span>
                                <input type="number" class="resize-width" data-callback="emptyCallback">
                            </div>
                            <div>
                                <span><?php echo JText::_('HEIGHT'); ?></span>
                                <input type="number" class="resize-height" data-callback="emptyCallback">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('IMAGE_QUALITY'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="100">
                                <input type="number" class="photo-editor-quality" data-callback="photoEditorQuality">
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="resize-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="crop-image-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('WIDTH'); ?></span>
                                <input type="number" class="crop-width" data-callback="emptyCallback">
                            </div>
                            <div>
                                <span><?php echo JText::_('HEIGHT'); ?></span>
                                <input type="number" class="crop-height" data-callback="emptyCallback">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('KEEP_PROPORTIONS'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="keep-proportions">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('ASPECT_RATIO'); ?></span>
                            <div class="ba-custom-select aspect-ratio-select">
                                <input readonly="" onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="3">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="original"><?php echo JText::_('ORIGINAL'); ?></li>
                                    <li data-value="1:1">1:1</li>
                                    <li data-value="3:2">3:2</li>
                                    <li data-value="3:4">3:4</li>
                                    <li data-value="16:9">16:9</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="crop-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="flip-rotate-image-options" class="row-fluid tab-pane">
                    <span>
                        <i class="zmdi zmdi-rotate-left rotate-action" data-rotate="-90"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ROTATE_LEFT'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-rotate-right rotate-action" data-rotate="90"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ROTATE_RIGHT'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-flip flip-action" data-flip="horizontal"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_HORIZONTAL'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-flip flip-action" data-flip="vertical"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_VERTICAL'); ?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($this->edit_type == '') {
?>
<div id="settings-dialog" class="ba-modal-lg modal hide" style="display:none">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('SETTINGS'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#general-options" data-toggle="tab">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#media-options" data-toggle="tab">
                        <i class="zmdi zmdi-collection-image"></i>
                        <?php echo JText::_('MEDIA'); ?>
                    </a>
                </li>
                <li>
                    <a href="#seo-options" data-toggle="tab">
                        <i class="zmdi zmdi-globe"></i>
                        SEO
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="general-options" class="row-fluid tab-pane active">
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-title">
                            <label>
                                <?php echo JText::_('JGLOBAL_TITLE'); ?>
                            </label>
                            <input type="hidden" name="ba_id" class="page-id" value="<?php echo $this->item->id; ?>">
                            <input type="text" class="page-title" value="<?php echo htmlentities($this->item->title); ?>"
                                placeholder="<?php echo JText::_('JGLOBAL_TITLE'); ?>" name="page_title">
                            <div class="ba-alert-container" style="display: none;">
                                <i class="zmdi zmdi-alert-circle"></i>
                                <span></span>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('REQUIRED_FIELD'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-alias">
                            <label>
                                <?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>
                            </label>
                            <input type="text" class="page-alias" value="<?php echo $this->item->page_alias; ?>"
                                placeholder="<?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>" name="page_alias">
                        </div>
                    </div>
                    <div class="ba-options-group"<?php echo $this->item->app_type != 'blog' ? ' style="display:none;"' : ''; ?>>
                        <div class="ba-group-element ba-original-intro-text">
                            <label>
                                <?php echo JText::_('INTRO_TEXT'); ?>
                            </label>
                            <textarea placeholder="<?php echo JText::_('INTRO_TEXT'); ?>"
                                name="intro_text" class="intro-text"><?php echo $this->item->intro_text; ?></textarea>
                        </div>
                    </div>
                    <div class="ba-options-group"<?php echo $this->item->app_type != 'blog' ? ' style="display:none;"' : ''; ?>>
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('CATEGORY'); ?>
                            </label>
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" type="text"
                                    value="<?php echo !empty($this->category) ? $this->categoryList[$this->category]->title : ''; ?>">
                                <input type="hidden" id="page-category" value="<?php echo $this->item->page_category; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->categoryList as $key => $category) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $category->title.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-options-group"<?php echo $this->item->app_type != 'blog' ? ' style="display:none;"' : ''; ?>>
                        <div class="ba-group-element ba-original-tags">
                            <div class="ba-tags">
                                <label>
                                    <?php echo JText::_('TAGS'); ?>
                                </label>
                                <div class="meta-tags">
                                    <select style="display: none;" name="meta_tags[]" class="meta_tags" multiple>
<?php
                                    foreach ($this->pageTags as $key => $value) {
                                        $str = '<option value="'.$key.'" selected>'.$value.'</option>';
                                        echo $str;
                                    }
?>
                                    </select>
                                    <ul class="picked-tags">
<?php
                                    foreach ($this->pageTags as $key => $value) {
                                        $str = '<li class="tags-chosen"><span>';
                                        $str .= $value.'</span><i class="zmdi zmdi-close" data-remove="'.$key.'"></i></li>';
                                        echo $str;
                                    }
?>
                                        <li class="search-tag">
                                            <input type="text" placeholder="<?php echo JText::_('TAGS'); ?>">
                                        </li>
                                    </ul>
                                    <ul class="all-tags">
                                        <?php foreach ($this->tags as $tag) {
                                            $str = '<li data-id="'.$tag->id.'" style="display:none;"';
                                            if (isset($this->pageTags[$tag->id])) {
                                                $str .= ' class="selected-tag"';
                                            }
                                            $str .='>'.$tag->title.'</li>';
                                            echo $str;
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help ba-hide-element">
                                    <?php echo JText::_('TAGS_DESC'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <p class="ba-group-title"><?php echo JText::_('PUBLISHING'); ?></p>
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-access">
                            <label>
                                <?php echo JText::_('JFIELD_ACCESS_LABEL'); ?>
                            </label>
                            <div class="ba-custom-select access-select">
                                <input readonly onfocus="this.blur()" type="text"
                                    value="<?php echo $this->access[$this->item->page_access]; ?>">
                                <input type="hidden" name="access" id="access" value="<?php echo $this->item->page_access; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-group-element ba-original-publishing">
                            <label>
                                <?php echo JText::_('START_PUBLISHING'); ?>
                            </label>
                            <div class="container-icon">
                                <input type="text" name="published_on" id="published_on" value="<?php echo $this->item->created; ?>">
                                <div class="icons-cell" id="calendar-button">
                                    <i class="zmdi zmdi-calendar-alt"></i>
                                </div>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('START_DESC'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-group-element"<?php echo $this->item->app_type != 'blog' ? ' style="display:none;"' : ''; ?>>
                            <label>
                                <?php echo JText::_('END_PUBLISHING'); ?>
                            </label>
                            <div class="container-icon">
<?php
    $end = $this->item->end_publishing == '0000-00-00 00:00:00' ? '' : $this->item->end_publishing;
?>
                                <input type="text" name="published_down" id="published_down"
                                    value="<?php echo $end; ?>">
                                <div class="icons-cell" id="calendar-end-button">
                                    <i class="zmdi zmdi-calendar-alt"></i>
                                </div>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('END_DESC'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-language">
                            <label>
                                <?php echo JText::_('JFIELD_LANGUAGE_LABEL'); ?>
                            </label>
                            <div class="ba-custom-select language-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text"
                                    value="<?php echo $this->languages[$this->item->language]; ?>">
                                <input type="hidden" name="language" id="language" value="<?php echo $this->item->language; ?>">
                                <ul>
                                    <?php
                                    foreach ($this->languages as $key => $language) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $language.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                                <i class="zmdi zmdi-caret-down"></i>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('LANGUAGE_DESC'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="media-options" class="row-fluid tab-pane">
                    <div class="ba-options-group">
                        <div class="ba-group-element">
                            <label>
                                <?php echo JText::_('IMAGE'); ?>
                            </label>
                            <input type="text" readonly onfocus="this.blur()" class="intro-image select-intro-image"
                                name="intro_image" value="<?php echo $this->item->intro_image; ?>"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <div class="reset disabled-reset reset-page-intro-image">
                                <i class="zmdi zmdi-close"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="seo-options" class="row-fluid tab-pane">
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-browser-title">
                            <label>
                                <?php echo JText::_('BROWSER_PAGE_TITLE'); ?>
                            </label>
                            <input type="text" name="page_meta_title" class="page-meta-title"
                                value="<?php echo htmlentities($this->item->meta_title); ?>"
                                placeholder="<?php echo JText::_('BROWSER_PAGE_TITLE'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('BROWSER_PAGE_TITLE_DESC'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-meta-description">
                            <label>
                                <?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>
                            </label>
                            <textarea name="page_meta_description" class="page-meta-description"
                                placeholder="<?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>"
                                ><?php echo $this->item->meta_description; ?></textarea>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('JFIELD_META_DESCRIPTION_DESC'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-meta-keywords">
                            <label>
                                <?php echo JText::_('JFIELD_META_KEYWORDS_LABEL'); ?>
                            </label>
                            <textarea name="page_meta_keywords" class="page-meta-keywords"
                                placeholder="<?php echo JText::_('JFIELD_META_KEYWORDS_LABEL'); ?>"
                                ><?php echo $this->item->meta_keywords; ?></textarea>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('JFIELD_META_KEYWORDS_DESC'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
?>
<div id="settings-dialog" class="ba-modal-lg modal hide" style="display:none">
    <div class="modal-header">
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#general-options" data-toggle="tab">
                        <i class="zmdi zmdi-settings"></i>
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="general-options" class="row-fluid tab-pane active">
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-title">
                            <label>
                                <?php echo JText::_('JGLOBAL_TITLE'); ?>
                            </label>
                            <input type="hidden" name="ba_id" class="page-id" value="<?php echo $this->item->id; ?>">
                            <input type="text" class="page-title" value="<?php echo $this->item->title; ?>"
                                placeholder="<?php echo JText::_('JGLOBAL_TITLE'); ?>" name="page_title">
                            <div class="ba-alert-container" style="display: none;">
                                <i class="zmdi zmdi-alert-circle"></i>
                                <span></span>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('REQUIRED_FIELD'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-options-group">
                        <div class="ba-group-element ba-original-alias">
                            <label>
                                <?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>
                            </label>
                            <input type="text" class="page-alias" value="<?php echo $this->item->alias; ?>"
                                placeholder="<?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>" name="page_alias">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<div id="theme-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('THEME'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#theme-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li class="">
                    <a href="#theme-colors-options" data-toggle="tab">
                        <?php echo JText::_('COLORS'); ?>
                    </a>
                </li>
                <li class="">
                    <a href="#theme-background-options" data-toggle="tab">
                        <?php echo JText::_('BACKGROUND'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="theme-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPOGRAPHY'); ?>
                            </span>
                            <div class="ba-custom-select typography-select">
                                <input readonly onfocus="this.blur()" value="<?php echo JText::_('BASE_FONT'); ?>" type="text">
                                <input type="hidden" value="body">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="body"><?php echo JText::_('BASE_FONT'); ?></li>
                                    <li data-value="h1">H1</li>
                                    <li data-value="h2">H2</li>
                                    <li data-value="h3">H3</li>
                                    <li data-value="h4">H4</li>
                                    <li data-value="h5">H5</li>
                                    <li data-value="h6">H6</li>
                                    <li data-value="p">Paragraph</li>
                                    <li data-value="links"><?php echo JText::_('LINKS') ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" class="minicolors-input"
                                        data-option="color" data-group="h1">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="h1" data-callback="themeRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="h1" data-callback="themeRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="h1" data-callback="themeRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="h1" data-callback="themeRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                                <div class="ba-settings-item links" style="display: none;">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" class="minicolors-input"
                                        data-option="color" data-group="links">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item links" style="display: none;">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" class="minicolors-input"
                                        data-option="hover-color" data-group="links">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="themeRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="themeRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="themeRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="themeRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="themeRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix"
                                placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="theme-colors-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group colors-wrapper">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('BRAND'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@primary">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('PRIMARY'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@secondary">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('SECONDARY'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@accent">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('ACCENT'); ?></span>
                        </div>
                    </div>
                    <div class="ba-settings-group colors-wrapper">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@title">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('TITLE'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@subtitle">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('SUBTITLE'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@text">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('TEXT'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@icon">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('ICON'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@title-inverse">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('TITLE_INVERSE'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@text-inverse">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('TEXT_INVERSE'); ?></span>
                        </div>
                    </div>
                    <div class="ba-settings-group colors-wrapper">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@bg-primary">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('PRIMARY'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@bg-secondary">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('SECONDARY'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@bg-dark">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('DARK'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@bg-dark-accent">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('DARK_ACCENT'); ?></span>
                        </div>
                    </div>
                    <div class="ba-settings-group colors-wrapper">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('OTHER'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@border">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@shadow">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@overlay">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@hover">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('HOVER'); ?></span>
                        </div>
                    </div>
                    <div class="ba-settings-group colors-wrapper">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('CUSTOM_COLORS'); ?></span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-1">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 1</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-2">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 2</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-3">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 3</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-4">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 4</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-5">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 5</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-6">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 6</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-7">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 7</span>
                        </div>
                        <div class="ba-settings-item colors-item" data-variable="@color-8">
                            <span class="color-varibles-color-swatch"></span>
                            <span><?php echo JText::_('COLOR'); ?> 8</span>
                        </div>
                    </div>
                </div>
                <div id="theme-background-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select background-select" data-callback="themeRules">
                                <input readonly onfocus="this.blur()" value="<?php echo JText::_('COLOR'); ?>" type="text">
                                <input type="hidden" value="color">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="color"><?php echo JText::_('COLOR'); ?></li>
                                    <li data-value="gradient"><?php echo JText::_('GRADIENT'); ?></li>
                                    <li data-value="image"><?php echo JText::_('IMAGE'); ?></li>
                                    <li data-value="video"><?php echo JText::_('VIDEO'); ?></li>
                                    <li data-value="none"><?php echo JText::_('NO_NE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="background-options">
                            <div class="color-options">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" class="minicolors-input"
                                            data-option="color" data-group="background">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                            </div>
                            <div class="image-options" style="display: none;">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('UPLOAD_BG_IMAGE'); ?>
                                    </span>
                                    <input type="text" class="select-input" readonly onfocus="this.blur()"
                                        data-type="upload-image" data-option="image"
                                        data-group="image" placeholder="<?php echo JText::_('SELECT'); ?>" data-action="themeRules">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('ATTACHMENT'); ?>
                                    </span>
                                    <div class="ba-custom-select attachment">
                                        <input readonly onfocus="this.blur()" value="fixed" type="text">
                                        <input type="hidden" value="fixed" data-option="attachment" data-group="image"
                                            data-action="themeRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="fixed">Fixed</li>
                                            <li data-value="scroll">Scroll</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-custom-select backround-size">
                                        <input readonly onfocus="this.blur()" value="cover" type="text">
                                        <input type="hidden" value="cover" data-option="size" data-group="image"
                                            data-action="themeRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="cover">Cover</li>
                                            <li data-value="contain">Contain</li>
                                            <li data-value="initial">Auto</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="contain-size-options" style="display: none;">
                                    <div class="ba-settings-item">
                                        <span>
                                            <?php echo JText::_('POSITION'); ?>
                                        </span>
                                        <div class="ba-custom-select backround-position">
                                            <input readonly onfocus="this.blur()" value="center center" type="text">
                                            <input type="hidden" value="center center" data-option="position" data-group="image"
                                                data-action="themeRules">
                                            <i class="zmdi zmdi-caret-down"></i>
                                            <ul>
                                                <li data-value="left top">Left Top</li>
                                                <li data-value="left center">Left Center</li>
                                                <li data-value="left bottom">Left Bottom</li>
                                                <li data-value="right top">Right Top</li>
                                                <li data-value="right center">Right Center</li>
                                                <li data-value="right bottom">Right Bottom</li>
                                                <li data-value="center top">Center Top</li>
                                                <li data-value="center center">Center Center</li>
                                                <li data-value="center bottom">Center Bottom</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ba-settings-item">
                                        <span>
                                            <?php echo JText::_('REPEAT'); ?>
                                        </span>
                                        <div class="ba-custom-select backround-repeat">
                                            <input readonly onfocus="this.blur()" value="no-repeat" type="text">
                                            <input type="hidden" value="no-repeat" data-option="repeat" data-group="image"
                                                data-action="themeRules">
                                            <i class="zmdi zmdi-caret-down"></i>
                                            <ul>
                                                <li data-value="repeat">Repeat</li>
                                                <li data-value="repeat-x">Repeat-x</li>
                                                <li data-value="repeat-y">Repeat-y</li>
                                                <li data-value="no-repeat">No-repeat</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gradient-options" style="display: none;">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('EFFECT'); ?>
                                    </span>
                                    <div class="ba-custom-select gradient-effect-select">
                                        <input readonly onfocus="this.blur()" value="" type="text">
                                        <input type="hidden" value="" data-property="background" data-callback="themeRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="linear">Linear</li>
                                            <li data-value="radial">Radial</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item background-linear-gradient">
                                    <span>
                                        <?php echo JText::_('ANGLE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="360" step="1">
                                        <input type="number" data-option="angle" data-group="background" data-subgroup="gradient"
                                            step="1" data-callback="themeRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('START_COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" class="minicolors-input"
                                        data-option="color1" data-group="background" data-subgroup="gradient">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('POSITION'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="100" step="1">
                                        <input type="number" data-option="position1" data-group="background" data-subgroup="gradient"
                                            step="1" data-callback="themeRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('END_COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" class="minicolors-input" data-option="color2"
                                        data-group="background" data-subgroup="gradient">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('POSITION'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="100" step="1">
                                        <input type="number" data-option="position2" data-group="background" data-subgroup="gradient"
                                            step="1" data-callback="themeRules">
                                    </div>
                                </div>
                            </div>
                            <div class="video-options desktop-only" style="display: none;">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('VIDEO_SOURCE'); ?>
                                    </span>
                                    <div class="ba-custom-select video-select">
                                        <input readonly onfocus="this.blur()" value="Youtube" type="text">
                                        <input type="hidden" value="youtube" data-option="video-type" data-group="background">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="youtube">Youtube</li>
                                            <li data-value="vimeo">Vimeo</li>
                                            <li data-value="source"><?php echo JText::_('SOURCE_FILE'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item video-id">
                                    <span>
                                        <?php echo JText::_('VIDEO_ID'); ?>
                                    </span>
                                    <input type="text" data-option="id" data-group="background"
                                        placeholder="<?php echo JText::_('VIDEO_ID'); ?>">
                                </div>
                                <div class="ba-settings-item video-source-select">
                                    <span>
                                        <?php echo JText::_('SOURCE_FILE'); ?>
                                    </span>
                                    <input type="text" class="select-input" readonly onfocus="this.blur()" data-option="source"
                                        placeholder="<?php echo JText::_('SELECT'); ?>">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                    <label class="ba-help-icon">
                                        <i class="zmdi zmdi-help"></i>
                                        <span class="ba-tooltip ba-help">
                                            <?php echo JText::_('SOURCE_FILE_TOOLTIP'); ?>
                                        </span>
                                    </label>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('MUTE'); ?>
                                    </span>
                                    <label class="ba-checkbox">
                                        <input type="checkbox" data-option="mute" data-group="background">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('START'); ?>
                                    </span>
                                    <input type="text" data-option="start" data-group="background"
                                        placeholder="<?php echo JText::_('START'); ?>">
                                </div>
                                <div class="ba-settings-item youtube-quality">
                                    <span>
                                        <?php echo JText::_('QUALITY'); ?>
                                    </span>
                                    <div class="ba-custom-select video-quality">
                                        <input readonly onfocus="this.blur()" value="720p" type="text">
                                        <input type="hidden" value="hd720" data-option="quality" data-group="background">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="hd720">720p</li>
                                            <li data-value="large">480p</li>
                                            <li data-value="medium">360p</li>
                                            <li data-value="small">240p</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group hide-megamenu-options-border">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select background-overlay-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden" data-property="overlay" data-callback="themeRules">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="color"><?php echo JText::_('COLOR'); ?></li>
                                    <li data-value="gradient"><?php echo JText::_('GRADIENT'); ?></li>
                                    <li data-value="none"><?php echo JText::_('NO_NE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay-color-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" class="minicolors-input"
                                    data-option="color" data-group="overlay">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                        </div>
                        <div class="overlay-gradient-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('EFFECT'); ?>
                                </span>
                                <div class="ba-custom-select gradient-effect-select">
                                    <input readonly onfocus="this.blur()" value="" type="text">
                                    <input type="hidden" value="" data-property="overlay" data-callback="themeRules">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="linear">Linear</li>
                                        <li data-value="radial">Radial</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ba-settings-item overlay-linear-gradient">
                                <span>
                                    <?php echo JText::_('ANGLE'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="360" step="1">
                                    <input type="number" data-option="angle" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="themeRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('START_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" class="minicolors-input"
                                    data-option="color1" data-group="overlay" data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position1" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="themeRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('END_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" class="minicolors-input" data-option="color2"
                                    data-group="overlay" data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="themeRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position2" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="themeRules">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div class="alert-backdrop"></div>
<div id="section-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#section-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#section-background-options" data-toggle="tab">
                        <?php echo JText::_('BACKGROUND'); ?>
                    </a>
                </li>
                <li>
                    <a href="#section-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="section-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group sticky-header-options">
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('OFFSET') ?></span>
                            <input type="text" class="set-value-css" data-option="offset">
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('SHOW_ON_SCROLL_UP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="set-value-css" data-option="scrollup">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group cookies-options">
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select cookies-layout-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="notification-bar"><?php echo JText::_('NOTIFICATION_BAR'); ?></li>
                                    <li data-value="lightbox"><?php echo JText::_('LIGHTBOX'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select cookies-position-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="notification-bar-top"><?php echo JText::_('TOP'); ?></li>
                                    <li data-value="notification-bar-bottom"><?php echo JText::_('BOTTOM'); ?></li>
                                    <li data-value="lightbox-top-left"><?php echo JText::_('TOP_LEFT'); ?></li>
                                    <li data-value="lightbox-top-right"><?php echo JText::_('TOP_RIGHT'); ?></li>
                                    <li data-value="lightbox-bottom-left"><?php echo JText::_('BOTTOM_LEFT'); ?></li>
                                    <li data-value="lightbox-bottom-right"><?php echo JText::_('BOTTOM_RIGHT'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item width-options">
                            <span><?php echo JText::_('WIDTH'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1170">
                                <input type="number" data-option="width" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group header-options">
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select header-layout-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('CLASSIC'); ?></li>
                                    <li data-value="sidebar-menu"><?php echo JText::_('SIDE_NAVIGATION'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item header-position">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select header-position-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="relative"><?php echo JText::_('DEFAULT'); ?></li>
                                    <li data-value="absolute"><?php echo JText::_('ABSOLUTE'); ?></li>
                                    <li data-value="fixed"><?php echo JText::_('FIXED'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group full-group">
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select megamenu-position-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('DEFAULT'); ?></li>
                                    <li data-value="megamenu-center"><?php echo JText::_('CENTER'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only full-width">
                            <span>
                                <?php echo JText::_('FULL_WIDTH'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="max-width">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('FULLSCREEN'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="fullscreen">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item desktop-only megamenu-width">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper image-width">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2500">
                                <input type="number" data-option="width" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only column-content-align">
                            <span>
                                <?php echo JText::_('CONTENT_ALIGN'); ?>
                            </span>
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('TOP'); ?></li>
                                    <li data-value="column-content-align-middle"><?php echo JText::_('MIDDLE'); ?></li>
                                    <li data-value="column-content-align-bottom"><?php echo JText::_('BOTTOM'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item flipbox-options">
                            <span><?php echo JText::_('HEIGHT'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1500">
                                <input type="number" data-option="height" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group typography-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPOGRAPHY'); ?>
                            </span>
                            <div class="ba-custom-select typography-select">
                                <input readonly onfocus="this.blur()" value="<?php echo JText::_('BASE_FONT'); ?>" type="text">
                                <input type="hidden" value="body">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="body"><?php echo JText::_('BASE_FONT'); ?></li>
                                    <li data-value="h1">H1</li>
                                    <li data-value="h2">H2</li>
                                    <li data-value="h3">H3</li>
                                    <li data-value="h4">H4</li>
                                    <li data-value="h5">H5</li>
                                    <li data-value="h6">H6</li>
                                    <li data-value="p">Paragraph</li>
                                    <li data-value="links"><?php echo JText::_('LINKS') ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="h1">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="h1" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="h1" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="h1" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="h1"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                                <div class="ba-settings-item links" style="display: none;">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="links">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item links" style="display: none;">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="hover-color" data-group="links">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-skip-next"></i>
                            <span><?php echo JText::_('ANIMATION'); ?></span>
                        </div>
                        <div class="ba-settings-item flipbox-options desktop-only">
                            <span>
                                <?php echo JText::_('EFFECT'); ?>
                            </span>
                            <div class="ba-custom-select flipbox-effect-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="vertical-flip-top"><?php echo JText::_('FLIP_TOP'); ?></li>
                                    <li data-value="horizontal-flip-right"><?php echo JText::_('FLIP_RIGHT'); ?></li>
                                    <li data-value="vertical-flip-bottom"><?php echo JText::_('FLIP_BOTTOM'); ?></li>
                                    <li data-value="horizontal-flip-left"><?php echo JText::_('FLIP_LEFT'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EFFECT'); ?>
                            </span>
                            <div class="ba-custom-select effect-select">
                                <input readonly onfocus="this.blur()" type="text" value="<?php echo JText::_('NO_NE'); ?>">
                                <input type="hidden" value="" data-option="effect" data-group="animation">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('NO_NE'); ?></li>
                                    <li data-value="bounceIn">Bounce In</li>
                                    <li data-value="bounceInLeft">Bounce In Left</li>
                                    <li data-value="bounceInRight">Bounce In Right</li>
                                    <li data-value="bounceInUp">Bounce In Up</li>
                                    <li data-value="bounceInBottom">Bounce In Bottom</li>
                                    <li data-value="fadeIn">Fade In</li>
                                    <li data-value="fadeInLeft">Fade In Left</li>
                                    <li data-value="fadeInRight">Fade In Right</li>
                                    <li data-value="fadeInUp">Fade In Up</li>
                                    <li data-value="fadeInBottom">Fade In Bottom</li>
                                    <li data-value="zoomIn">Zoom In</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DURATION'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2" step="0.1">
                                <input type="number" data-option="duration" data-group="animation" step="0.1" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item flipbox-options desktop-only">
                            <span>
                                <?php echo JText::_('3D_EFFECT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="effect3D">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DELAY'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2" step="0.1">
                                <input type="number" data-option="delay" data-group="animation" step="0.1" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only presets-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="section-background-options" class="row-fluid tab-pane">
                	<div class="ba-settings-group">
                        <div class="ba-settings-item flipbox-options">
                            <span>
                                <?php echo JText::_('SIDE'); ?>
                            </span>
                            <div class="ba-custom-select flipbox-select-side">
                                <input readonly onfocus="this.blur()"type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="frontside"><?php echo JText::_('FRONTSIDE'); ?></li>
                                    <li data-value="backside"><?php echo JText::_('BACKSIDE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select background-select" data-callback="sectionRules">
                                <input readonly onfocus="this.blur()" value="<?php echo JText::_('COLOR'); ?>" type="text">
                                <input type="hidden" value="color">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="color"><?php echo JText::_('COLOR'); ?></li>
                                    <li data-value="gradient"><?php echo JText::_('GRADIENT'); ?></li>
                                    <li data-value="image"><?php echo JText::_('IMAGE'); ?></li>
                                    <li data-value="video"><?php echo JText::_('VIDEO'); ?></li>
                                    <li data-value="none"><?php echo JText::_('NO_NE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="background-options">
                            <div class="color-options">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="background">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                            </div>
                            <div class="image-options" style="display: none;">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('UPLOAD_BG_IMAGE'); ?>
                                    </span>
                                    <input type="text" class="select-input" readonly onfocus="this.blur()"
                                        data-type="upload-image" data-option="image"
                                        data-group="image" placeholder="<?php echo JText::_('SELECT'); ?>" data-action="sectionRules">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('ATTACHMENT'); ?>
                                    </span>
                                    <div class="ba-custom-select attachment">
                                        <input readonly onfocus="this.blur()" value="fixed" type="text">
                                        <input type="hidden" value="fixed" data-option="attachment" data-group="image"
                                            data-action="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="fixed">Fixed</li>
                                            <li data-value="scroll">Scroll</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-custom-select backround-size">
                                        <input readonly onfocus="this.blur()" value="cover" type="text">
                                        <input type="hidden" value="cover" data-option="size" data-group="image"
                                            data-action="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="cover">Cover</li>
                                            <li data-value="contain">Contain</li>
                                            <li data-value="initial">Auto</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="contain-size-options" style="display: none;">
                                    <div class="ba-settings-item">
                                        <span>
                                            <?php echo JText::_('POSITION'); ?>
                                        </span>
                                        <div class="ba-custom-select backround-position">
                                            <input readonly onfocus="this.blur()" value="center center" type="text">
                                            <input type="hidden" value="center center" data-option="position" data-group="image"
                                                data-action="sectionRules">
                                            <i class="zmdi zmdi-caret-down"></i>
                                            <ul>
                                                <li data-value="left top">Left Top</li>
                                                <li data-value="left center">Left Center</li>
                                                <li data-value="left bottom">Left Bottom</li>
                                                <li data-value="right top">Right Top</li>
                                                <li data-value="right center">Right Center</li>
                                                <li data-value="right bottom">Right Bottom</li>
                                                <li data-value="center top">Center Top</li>
                                                <li data-value="center center">Center Center</li>
                                                <li data-value="center bottom">Center Bottom</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ba-settings-item">
                                        <span>
                                            <?php echo JText::_('REPEAT'); ?>
                                        </span>
                                        <div class="ba-custom-select backround-repeat">
                                            <input readonly onfocus="this.blur()" value="no-repeat" type="text">
                                            <input type="hidden" value="no-repeat" data-option="repeat" data-group="image"
                                                data-action="sectionRules">
                                            <i class="zmdi zmdi-caret-down"></i>
                                            <ul>
                                                <li data-value="repeat">Repeat</li>
                                                <li data-value="repeat-x">Repeat-x</li>
                                                <li data-value="repeat-y">Repeat-y</li>
                                                <li data-value="no-repeat">No-repeat</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('PARALLAX'); ?>
                                    </span>
                                    <label class="ba-checkbox">
                                        <input type="checkbox" data-option="enable" data-group="parallax">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="parallax-options">
                                    <div class="ba-settings-item desktop-only">
                                        <span>
                                            <?php echo JText::_('TYPE'); ?>
                                        </span>
                                        <div class="ba-custom-select parallax-type-select">
                                            <input readonly onfocus="this.blur()" value="" type="text">
                                            <input type="hidden" value="" data-action="sectionRules">
                                            <i class="zmdi zmdi-caret-down"></i>
                                            <ul>
                                                <li data-value="scroll"><?php echo JText::_('SCROLL'); ?></li>
                                                <li data-value="mousemove"><?php echo JText::_('MOUSE_MOVEMENT'); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ba-settings-item desktop-only">
                                        <span>
                                            <?php echo JText::_('PARALLAX_OFFSET'); ?>
                                        </span>
                                        <div class="ba-range-wrapper">
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-range" min="0.1" max="0.5" step="0.1">
                                            <input type="number" data-option="offset" data-group="parallax" step="0.1"
                                                data-module="loadParallax" data-callback="sectionRules">
                                        </div>
                                    </div>
                                    <div class="ba-settings-item desktop-only">
                                        <span>
                                            <?php echo JText::_('INVERT'); ?>
                                        </span>
                                        <label class="ba-checkbox">
                                            <input type="checkbox" data-option="invert" data-group="parallax">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="gradient-options" style="display: none;">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('EFFECT'); ?>
                                    </span>
                                    <div class="ba-custom-select gradient-effect-select">
                                        <input readonly onfocus="this.blur()" value="" type="text">
                                        <input type="hidden" value="" data-property="background">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="linear">Linear</li>
                                            <li data-value="radial">Radial</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item background-linear-gradient">
                                    <span>
                                        <?php echo JText::_('ANGLE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="360" step="1">
                                        <input type="number" data-option="angle" data-group="background" data-subgroup="gradient"
                                            step="1" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('START_COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color1" data-group="background"
                                        data-subgroup="gradient">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('POSITION'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="100" step="1">
                                        <input type="number" data-option="position1" data-group="background" data-subgroup="gradient"
                                            step="1" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('END_COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color2" data-group="background"
                                        data-subgroup="gradient">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('POSITION'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="100" step="1">
                                        <input type="number" data-option="position2" data-group="background" data-subgroup="gradient"
                                            step="1" data-callback="sectionRules">
                                    </div>
                                </div>
                            </div>
                            <div class="video-options desktop-only" style="display: none;">
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('VIDEO_SOURCE'); ?>
                                    </span>
                                    <div class="ba-custom-select video-select">
                                        <input readonly onfocus="this.blur()" value="Youtube" type="text">
                                        <input type="hidden" value="youtube" data-option="video-type" data-group="background">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="youtube">Youtube</li>
                                            <li data-value="vimeo">Vimeo</li>
                                            <li data-value="source"><?php echo JText::_('SOURCE_FILE'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item video-id">
                                    <span>
                                        <?php echo JText::_('VIDEO_ID'); ?>
                                    </span>
                                    <input type="text" data-option="id" data-group="background"
                                        placeholder="<?php echo JText::_('VIDEO_ID'); ?>">
                                </div>
                                <div class="ba-settings-item video-source-select">
                                    <span>
                                        <?php echo JText::_('SOURCE_FILE'); ?>
                                    </span>
                                    <input type="text" class="select-input" readonly onfocus="this.blur()" data-option="source"
                                        placeholder="<?php echo JText::_('SELECT'); ?>">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                    <label class="ba-help-icon">
                                        <i class="zmdi zmdi-help"></i>
                                        <span class="ba-tooltip ba-help">
                                            <?php echo JText::_('SOURCE_FILE_TOOLTIP'); ?>
                                        </span>
                                    </label>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('MUTE'); ?>
                                    </span>
                                    <label class="ba-checkbox">
                                        <input type="checkbox" data-option="mute" data-group="background">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('START'); ?>
                                    </span>
                                    <input type="text" data-option="start" data-group="background"
                                        placeholder="<?php echo JText::_('START'); ?>">
                                </div>
                                <div class="ba-settings-item youtube-quality">
                                    <span>
                                        <?php echo JText::_('QUALITY'); ?>
                                    </span>
                                    <div class="ba-custom-select video-quality">
                                        <input readonly onfocus="this.blur()" value="720p" type="text">
                                        <input type="hidden" value="hd720" data-option="quality" data-group="background">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            <li data-value="hd720">720p</li>
                                            <li data-value="large">480p</li>
                                            <li data-value="medium">360p</li>
                                            <li data-value="small">240p</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group hide-megamenu-options-border">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select background-overlay-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden" data-property="overlay">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="color"><?php echo JText::_('COLOR'); ?></li>
                                    <li data-value="gradient"><?php echo JText::_('GRADIENT'); ?></li>
                                    <li data-value="none"><?php echo JText::_('NO_NE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay-color-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color" data-group="overlay">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                        </div>
                        <div class="overlay-gradient-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('EFFECT'); ?>
                                </span>
                                <div class="ba-custom-select gradient-effect-select">
                                    <input readonly onfocus="this.blur()" value="" type="text">
                                    <input type="hidden" value="" data-property="overlay">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="linear">Linear</li>
                                        <li data-value="radial">Radial</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ba-settings-item overlay-linear-gradient">
                                <span>
                                    <?php echo JText::_('ANGLE'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="360" step="1">
                                    <input type="number" data-option="angle" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('START_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color1" data-group="overlay"
                                    data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position1" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('END_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color2" data-group="overlay"
                                    data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position2" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group shape-divider-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-texture"></i>
                            <span><?php echo JText::_('SHAPE_DIVIDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select shape-divider-position">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="top"><?php echo JText::_('TOP'); ?></li>
                                    <li data-value="bottom"><?php echo JText::_('BOTTOM'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="shape-divider-position-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('EFFECT'); ?>
                                </span>
                                <div class="ba-custom-select shape-divider-effect">
                                    <input readonly onfocus="this.blur()" type="text">
                                    <input type="hidden">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value=""><?php echo JText::_('NO_NE'); ?></li>
                                        <li data-value="triangle"><?php echo JText::_('TRIANGLE'); ?></li>
                                        <li data-value="triangle-right"><?php echo JText::_('TRIANGLE_RIGHT'); ?></li>
                                        <li data-value="triangle-left"><?php echo JText::_('TRIANGLE_LEFT'); ?></li>
                                        <li data-value="delta"><?php echo JText::_('DELTA'); ?></li>
                                        <li data-value="arrow"><?php echo JText::_('ARROW'); ?></li>
                                        <li data-value="zigzag"><?php echo JText::_('ZIGZAG'); ?></li>
                                        <li data-value="curve-right"><?php echo JText::_('CURVE_RIGHT'); ?></li>
                                        <li data-value="curve-left"><?php echo JText::_('CURVE_LEFT'); ?></li>
                                        <li data-value="circle"><?php echo JText::_('CIRCLE'); ?></li>
                                        <li data-value="camber"><?php echo JText::_('CAMBER'); ?></li>
                                        <li data-value="clouds"><?php echo JText::_('CLOUDS'); ?></li>
                                        <li data-value="waves"><?php echo JText::_('WAVES'); ?></li>
                                        <li data-value="spectre-right"><?php echo JText::_('SPECTRE_RIGHT'); ?></li>
                                        <li data-value="spectre-left"><?php echo JText::_('SPECTRE_LEFT'); ?></li>
                                        <li data-value="vertex"><?php echo JText::_('VERTEX'); ?></li>
                                        <li data-value="torsion"><?php echo JText::_('TORSION'); ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color" data-group="shape">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('VALUE'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="1" max="100">
                                    <input type="number" data-option="value" data-group="shape" data-callback="sectionRules">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group column-gutter desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLUMNS_GUTTER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="gutter" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group only-not-desktop mobile-column-width">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MOBILE'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLUMN_WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="1" max="12" step="1">
                                <input type="number" data-option="width" data-group="span" step="1" data-callback="sectionRules">
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('STACK_THE_COLUMNS'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group hide-megamenu-options-border">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="top">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('RIGHT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="right">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('BOTTOM'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="bottom">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('LEFT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="left">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="item-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#item-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#item-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li class="">
                    <a href="#item-layout-options" data-toggle="tab">
                        <?php echo JText::_('layout'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="item-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group items-list simple-gallery-options">
                        <div class="sorting-container">
                            
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group instagram-options desktop-only">
                        <div class="ba-settings-item">
                            <span>Access Token</span>
                            <input type="text" data-option="accessToken" data-group="instagram"
                                placeholder="Access Token">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MAX_ITEMS'); ?>
                            </span>
                            <input type="number" data-option="max" data-group="instagram" class="lightbox-settings-input" placeholder="12">
                        </div>
                    </div>
                    <div class="ba-settings-group instagram-options simple-gallery-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('NUMBER_OF_COLUMNS'); ?>
                            </span>
                            <input type="number" data-option="count" class="lightbox-settings-input set-value-css">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="10" max="1500">
                                <input type="number" data-option="height" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLUMNS_GUTTER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="gutter" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group instagram-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('LIGHTBOX'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ENABLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="popup" data-option="enable" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group hypercomments-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('APP_ID'); ?>
                            </span>
                            <input type="text" class="hypercomments-widget-id"
                                placeholder="<?php echo JText::_('APP_ID'); ?>">
                        </div>
                    </div>
                    <div class="ba-settings-group facebook-comments-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('APP_ID'); ?>
                            </span>
                            <input type="text" class="facebook-comments-app-id"
                                placeholder="<?php echo JText::_('APP_ID'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LIMIT'); ?>
                            </span>
                            <div class="ba-range-wrapper image-width">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="5" max="100">
                                <input type="number" class="facebook-comments-limit" data-callback="sectionRules">
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help"><?php echo JText::_('COMMENTS_LIMIT_TOOLTIP'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group vk-comments-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('APP_ID'); ?>
                            </span>
                            <input type="text" class="vk-comments-app-id"
                                placeholder="<?php echo JText::_('APP_ID'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LIMIT'); ?>
                            </span>
                            <div class="ba-range-wrapper image-width">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="5" max="100">
                                <input type="number" class="vk-comments-limit" data-callback="sectionRules">
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help"><?php echo JText::_('COMMENTS_LIMIT_TOOLTIP'); ?></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('AUTOPUBLISH'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="vk-comments-autopublish">
                                <span></span>
                            </label>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help"><?php echo JText::_('VK_AUTOPUBLISH_TOOLTIP'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group vk-comments-options desktop-only">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('ATTACHMENT'); ?></span>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help"><?php echo JText::_('VK_ATTACHMENT_TOOLTIP'); ?></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('GRAFFITI'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="vk-comments-attach" data-option="graffiti">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('PHOTO'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="vk-comments-attach" data-option="photo">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('AUDIO'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="vk-comments-attach" data-option="audio">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('VIDEO'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="vk-comments-attach" data-option="video">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('LINK'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="vk-comments-attach" data-option="link">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group disqus-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DISQUS_SUBDOMAIN'); ?>
                            </span>
                            <input type="text" class="disqus-subdomen"
                                placeholder="<?php echo JText::_('DISQUS_SUBDOMAIN'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('DISQUS_SUBDOMAIN_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group logo-options">
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <input type="text" readonly onfocus="this.blur()" data-option="image"
                                class="reselect-image select-input" data-action="sectionRules"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('IMAGE_ALT'); ?>
                            </span>
                            <input type="text" data-option="alt" placeholder="<?php echo JText::_('IMAGE_ALT'); ?>">
                        </div>
                    </div>
                    <div class="ba-settings-group logo-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-link"></i>
                            <span><?php echo JText::_('LINK'); ?></span>
                        </div>
                        <div class="ba-settings-item link-picker-container">
                            <span>
                                <?php echo JText::_('LINK'); ?>
                            </span>
                            <input type="text" data-option="link" data-group="link" placeholder="<?php echo JText::_('LINK'); ?>">
                            <div class="select-link">
                                <i class="zmdi zmdi-attachment-alt"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('LINK_PICKER') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only instagram-options simple-gallery-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="item-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group logo-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper image-width">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1000">
                                <input type="number" data-option="width" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-value="left" data-option="text-align" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-value="center" data-option="text-align" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-value="right" data-option="text-align" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group instagram-options simple-gallery-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('LIGHTBOX'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="lightbox" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="item-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="image-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#image-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li class="ba-image-options">
                    <a href="#image-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li class="">
                    <a href="#image-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="image-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group video-item-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIDEO_SOURCE'); ?>
                            </span>
                            <div class="ba-custom-select select-video-source">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="youtube">Youtube</li>
                                    <li data-value="vimeo">Vimeo</li>
                                    <li data-value="source"><?php echo JText::_('SOURCE_FILE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item video-id">
                            <span>
                                <?php echo JText::_('VIDEO_ID'); ?>
                            </span>
                            <input type="text" data-option="id" data-group="video"
                                placeholder="<?php echo JText::_('VIDEO_ID'); ?>">
                        </div>
                        <div class="video-youtube-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('START'); ?>
                                </span>
                                <input type="text" data-option="start" data-group="video" data-subgroup="youtube"
                                    placeholder="<?php echo JText::_('START'); ?>">
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('AUTOPLAY'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="autoplay" data-group="video" data-subgroup="youtube">
                                    <span></span>
                                </label>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('CONTROLS'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="controls" data-group="video" data-subgroup="youtube">
                                    <span></span>
                                </label>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('SHOW_INFO'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="showinfo" data-group="video" data-subgroup="youtube">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="video-vimeo-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('AUTOPLAY'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="autoplay" data-group="video" data-subgroup="vimeo">
                                    <span></span>
                                </label>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('LOOP'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="loop" data-group="video" data-subgroup="vimeo">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="video-source-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('SOURCE_FILE'); ?>
                                </span>
                                <input type="text" class="select-input" readonly onfocus="this.blur()"
                                    data-option="file" data-group="video" data-subgroup="source"
                                    placeholder="<?php echo JText::_('SELECT'); ?>">
                                <i class="zmdi zmdi-attachment-alt"></i>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('SOURCE_FILE_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('AUTOPLAY'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="autoplay" data-group="video" data-subgroup="source">
                                    <span></span>
                                </label>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('CONTROLS'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="controls" data-group="video" data-subgroup="source">
                                    <span></span>
                                </label>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('LOOP'); ?>
                                </span>
                                <label class="ba-checkbox">
                                    <input type="checkbox" data-option="loop" data-group="video" data-subgroup="source">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-image-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <input type="text" readonly onfocus="this.blur()" data-option="image"
                                class="reselect-image select-input" data-action="sectionRules"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('IMAGE_ALT'); ?>
                            </span>
                            <input type="text" data-option="alt" placeholder="<?php echo JText::_('IMAGE_ALT'); ?>">
                        </div>
                    </div>
                    <div class="ba-settings-group ba-image-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper image-width">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2500">
                                <input type="number" data-option="width" data-group="style" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-value="left" data-option="align" data-group="style" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-value="center" data-option="align" data-group="style" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-value="right" data-option="align" data-group="style" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-image-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-link"></i>
                            <span><?php echo JText::_('LINK'); ?></span>
                        </div>
                        <div class="ba-settings-item link-picker-container">
                            <span>
                                <?php echo JText::_('LINK'); ?>
                            </span>
                            <input type="text" data-option="link" data-group="link" placeholder="<?php echo JText::_('LINK'); ?>">
                            <div class="select-link">
                                <i class="zmdi zmdi-attachment-alt"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('LINK_PICKER') ?></span>
                            </div>
                            <div class="select-file">
                                <i class="zmdi zmdi-file"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('FILE_PICKER') ?></span>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TARGET'); ?>
                            </span>
                            <div class="ba-custom-select link-target-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="target" data-group="link">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="_blank"><?php echo JText::_('NEW_WINDOW'); ?></li>
                                    <li data-value="_self"><?php echo JText::_('SAME_WINDOW'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select link-type-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="type" data-group="link">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('DEFAULT'); ?></li>
                                    <li data-value="download"><?php echo JText::_('DOWNLOAD'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-image-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('LIGHTBOX'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ENABLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="popup" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="image-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('LIGHTBOX'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="lightbox" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="image-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="search-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#search-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#search-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#search-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="search-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('PLACEHOLDER'); ?>
                            </span>
                            <input type="text" placeholder="<?php echo JText::_('PLACEHOLDER'); ?>" class="search-placeholder">
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('ICON'); ?>
                            </span>
                            <input class="select-input" type="text" readonly onfocus="this.blur()"
                                data-option="icon" data-group="icon"
                                placeholder="<?php echo JText::_('ICON'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <div class="reset">
                                <i class="zmdi zmdi-close" data-group="icon" data-option="icon"
                                    data-action="sectionRules" data-callback="removeSearchIcon"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="search-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="typography" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="typography" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="h1" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-local-florist"></i>
                            <span><?php echo JText::_('ICON'); ?></span>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select search-icon-position">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="position" data-group="icons" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('BEFORE'); ?></li>
                                    <li data-value="after"><?php echo JText::_('AFTER'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icons" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                </div>
            <div id="search-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="top">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('RIGHT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="right">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('BOTTOM'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="bottom">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('LEFT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="border" data-option="left">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="headline-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#headline-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#headline-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#headline-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="headline-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group desktop-only">
                        <div class="ba-settings-item input-resize">
                            <span>
                                <?php echo JText::_('LABEL'); ?>
                            </span>
                            <input type="text" placeholder="<?php echo JText::_('LABEL'); ?>" class="headline-label">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HTML_TAG'); ?>
                            </span>
                            <div class="ba-custom-select select-headline-html-tag">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="h1">H1</li>
                                    <li data-value="h2">H2</li>
                                    <li data-value="h3">H3</li>
                                    <li data-value="h4">H4</li>
                                    <li data-value="h5">H5</li>
                                    <li data-value="h6">H6</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-skip-next"></i>
                            <span><?php echo JText::_('ANIMATION'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EFFECT'); ?>
                            </span>
                            <div class="ba-custom-select headline-effect-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('NO_NE'); ?></li>
                                    <li data-value="flip">Flip</li>
                                    <li data-value="type">Type</li>
                                    <li data-value="rotate">Rotate</li>
                                    <li data-value="slide">Slide</li>
                                    <li data-value="zoom">Zoom</li>
                                    <li data-value="scale">Scale</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DURATION'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2" step="0.1">
                                <input type="number" data-option="duration" data-group="animation" step="0.1" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="headline-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="counter">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                    <div class="reset-text-typography-wrapper" style="display: none;">
                                        <i class="zmdi zmdi-replay reset-text-typography" data-type="reset"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RESET'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                    <div class="reset-text-typography-wrapper" style="display: none;">
                                        <i class="zmdi zmdi-replay reset-text-typography" data-type="reset"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RESET'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                    <div class="reset-text-typography-wrapper" style="display: none;">
                                        <i class="zmdi zmdi-replay reset-text-typography" data-type="reset"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RESET'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="headline-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="countdown-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#countdown-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#countdown-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#countdown-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="countdown-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group tags-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('APP'); ?>
                            </span>
                            <div class="ba-custom-select tags-app-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="app">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
<?php
                                foreach ($this->apps as $value) {
                                    echo '<li data-value="'.$value->id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item tags-categories-list">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <div class="tags-categories">
                                <ul class="selected-categories">
                                    <li class="search-category">
                                        <input type="text" placeholder="<?php echo JText::_('CATEGORY'); ?>">
                                    </li>
                                </ul>
                                <ul class="all-categories-list">
<?php
                                foreach ($this->categories as $value) {
                                    echo '<li data-id="'.$value->id.'" data-app="'.$value->app_id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('TAGS_CATEGORY_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MAX_ITEMS'); ?>
                            </span>
                            <input type="number" data-option="count" class="lightbox-settings-input" placeholder="5">
                        </div>
                    </div>
                    <div class="ba-settings-group counter-options desktop-only counter-general">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TARGET_NUMBER'); ?>
                            </span>
                            <input type="text" data-option="number" placeholder="<?php echo JText::_('TARGET_NUMBER'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ANIMATION_SPEED'); ?>
                            </span>
                            <input type="text" data-option="speed" placeholder="<?php echo JText::_('ANIMATION_SPEED'); ?>">
                        </div>
                    </div>
                    <div class="ba-settings-group scroll-to-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('END_POINT'); ?>
                            </span>
                            <input type="text" readonly onfocus="this.blur()" class="select-end-point select-input"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LABEL'); ?>
                            </span>
                            <input type="text" placeholder="<?php echo JText::_('LABEL'); ?>" class="button-label">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ICON'); ?>
                            </span>
                            <input type="text" readonly onfocus="this.blur()" class="scroll-to-icon select-input"
                                placeholder="<?php echo JText::_('ICON'); ?>" data-group="icon" data-option="">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <div class="reset">
                                <i class="zmdi zmdi-close" data-group="icon" data-option="" data-action="sectionRules"
                                    data-callback="removeIcon"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('RESET'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group scrolltop-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ICON'); ?>
                            </span>
                            <input type="text" readonly onfocus="this.blur()" class="scrolltop-icon select-input"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                    </div>
                    <div class="ba-settings-group scrolltop-options scroll-to-options desktop-only scrolltop-general">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('SETTINGS'); ?></span>
                        </div>
                        <div class="ba-settings-item scrolltop-options">
                            <span>
                                <?php echo JText::_('OFFSET'); ?>
                            </span>
                            <input type="text" data-option="offset" placeholder="<?php echo JText::_('OFFSET'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('OFFSET_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SCROLLING_SPEED'); ?>
                            </span>
                            <input type="text" data-option="speed" placeholder="<?php echo JText::_('SCROLLING_SPEED'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ANIMATION'); ?>
                            </span>
                            <div class="ba-custom-select scrolltop-animation-select">
                                <input readonly onfocus="this.blur()" value="" type="text" data-option="animation">
                                <input type="hidden" value="" data-option="animation">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="easeInSine">easeInSine</li>
                                    <li data-value="easeOutSine">easeOutSine</li>
                                    <li data-value="easeOutQuad">easeOutQuad</li>
                                    <li data-value="easeOutCubic">easeOutCubic</li>
                                    <li data-value="easeInQuart">easeInQuart</li>
                                    <li data-value="easeOutQuart">easeOutQuart</li>
                                    <li data-value="easeInExpo">easeInExpo</li>
                                    <li data-value="easeOutExpo">easeOutExpo</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group icon-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ICON'); ?>
                            </span>
                            <input type="text" readonly onfocus="this.blur()"
                                class="reselect-icon select-input" data-action="sectionRules"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                    </div>
                    <div class="ba-settings-group button-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LABEL'); ?>
                            </span>
                            <input type="text" placeholder="<?php echo JText::_('LABEL'); ?>" class="button-label">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ICON'); ?>
                            </span>
                            <input class="select-input" type="text" readonly onfocus="this.blur()"
                                data-option="icon" data-group="icon"
                                placeholder="<?php echo JText::_('ICON'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                            <div class="reset">
                                <i class="zmdi zmdi-close" data-group="icon" data-option="icon"
                                    data-action="sectionRules" data-callback="removeIcon"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group icon-options button-options desktop-only button-link-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-link"></i>
                            <span><?php echo JText::_('LINK'); ?></span>
                        </div>
                        <div class="ba-settings-item link-picker-container">
                            <span>
                                <?php echo JText::_('LINK'); ?>
                            </span>
                            <input type="text" data-option="link" data-group="link" placeholder="<?php echo JText::_('LINK'); ?>">
                            <div class="select-link">
                                <i class="zmdi zmdi-attachment-alt"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('LINK_PICKER') ?></span>
                            </div>
                            <div class="select-file">
                                <i class="zmdi zmdi-file"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('FILE_PICKER') ?></span>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TARGET'); ?>
                            </span>
                            <div class="ba-custom-select link-target-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="target" data-group="link">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="_blank"><?php echo JText::_('NEW_WINDOW'); ?></li>
                                    <li data-value="_self"><?php echo JText::_('SAME_WINDOW'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select link-type-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="type" data-group="link">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('DEFAULT'); ?></li>
                                    <li data-value="download"><?php echo JText::_('DOWNLOAD'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group countdown-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TARGET_TIME'); ?>
                            </span>
                            <div class="container-icon">
                                <input type="text" id="countdown-input">
                                <div class="icons-cell" id="countdown-calendar">
                                    <i class="zmdi zmdi-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DISPLAY'); ?>
                            </span>
                            <div class="ba-custom-select countdown-display-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="full">D, H, M, S</li>
                                    <li data-value="hours">H, M, S</li>
                                    <li data-value="minutes">M, S</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HIDE_AFTER_COUNT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="hide-after">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group countdown-options constants desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-label"></i>
                            <span><?php echo JText::_('LABEL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DAYS'); ?>
                            </span>
                            <input type="text" data-option="days" placeholder="<?php echo JText::_('DAYS'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HOURS'); ?>
                            </span>
                            <input type="text" data-option="hours" placeholder="<?php echo JText::_('HOURS'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MINUTES'); ?>
                            </span>
                            <input type="text" data-option="minutes" placeholder="<?php echo JText::_('MINUTES'); ?>">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SECONDS'); ?>
                            </span>
                            <input type="text" data-option="seconds" placeholder="<?php echo JText::_('SECONDS'); ?>">
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="countdown-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group icon-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icon" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-option="text-align" data-value="left" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="center" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="right" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group scrolltop-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icons" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-toolbar desktop-only scrolltop-options">
                            <label data-option="align" data-group="text" data-value="left" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="align" data-group="text" data-value="right" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group button-options counter-options post-tags-options tags-options scroll-to-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item counter-options">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="counter">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group icon-options button-options scrolltop-options scroll-to-options
                        post-tags-options tags-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NORMAL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="normal">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background-color" data-group="normal">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group icon-options button-options scrolltop-options scroll-to-options
                        post-tags-options tags-options desktop-only">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('HOVER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="hover">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background-color" data-group="hover">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group button-options scroll-to-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-local-florist"></i>
                            <span><?php echo JText::_('ICON'); ?></span>
                        </div>
                        <div class="ba-settings-item desktop-only button-options">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select button-icon-position">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="position" data-group="icon" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('BEFORE'); ?></li>
                                    <li data-value="after"><?php echo JText::_('AFTER'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only scroll-to-options">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select scroll-to-icon-position">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="position" data-group="icons" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('BEFORE'); ?></li>
                                    <li data-value="after"><?php echo JText::_('AFTER'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icons" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group countdown-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPOGRAPHY'); ?>
                            </span>
                            <div class="ba-custom-select typography-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="counter"><?php echo JText::_('COUNTER') ?></li>
                                    <li data-value="label"><?php echo JText::_('LABEL') ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group countdown-options counter-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item background">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="background" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="countdown-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group icon-options button-options counter-options countdown-options
                        scroll-to-options post-tags-options tags-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group icon-options button-options scrolltop-options scroll-to-options
                        post-tags-options tags-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group icon-options button-options counter-options scrolltop-options
                        scroll-to-options post-tags-options tags-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="social-icons-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#social-icons-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#social-icons-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#social-icons-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="social-icons-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group items-list">
                        <div class="sorting-container">
                            
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="social-icons-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icon" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-option="text-align" data-value="left" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="center" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="right" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NORMAL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="normal">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background-color" data-group="normal">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('HOVER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="hover" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background-color" data-group="hover" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="social-icons-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="weather-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#weather-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#weather-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#weather-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="weather-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group desktop-only weather-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ENTER_LOCATION'); ?>
                            </span>
                            <input type="text" placeholder="<?php echo JText::_('ENTER_LOCATION'); ?>" class="weather-location">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('UNIT'); ?>
                            </span>
                            <div class="ba-custom-select weather-unit-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="c"><?php echo JText::_('CELSIUS'); ?></li>
                                    <li data-value="f"><?php echo JText::_('FAHRENHEIT'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group error-message-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ERROR_CODE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="code" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ERROR_MESSAGE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="message" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group weather-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('FORECAST'); ?>
                            </span>
                            <div class="ba-custom-select weather-forecast-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="view" data-option="forecast" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="0"><?php echo JText::_('NO_NE'); ?></li>
                                    <li data-value="1">1 <?php echo JText::_('DAY'); ?></li>
                                    <li data-value="2">2 <?php echo JText::_('DAYS'); ?></li>
                                    <li data-value="3">3 <?php echo JText::_('DAYS'); ?></li>
                                    <li data-value="4">4 <?php echo JText::_('DAYS'); ?></li>
                                    <li data-value="5">5 <?php echo JText::_('DAYS'); ?></li>
                                    <li data-value="6">6 <?php echo JText::_('DAYS'); ?></li>
                                    <li data-value="7">7 <?php echo JText::_('DAYS'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select weather-layout-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="view" data-option="layout" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="forecast-block"><?php echo JText::_('BLOCK'); ?></li>
                                    <li data-value="forecast-list"><?php echo JText::_('LIST'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIND'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="wind" data-group="view" class="weather-view set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HUMIDITY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="humidity" data-group="view" class="weather-view set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('PRESSURE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="pressure" data-group="view" class="weather-view set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SUNSET_SUNRISE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="sunrise-wrapper" data-group="view" class="weather-view set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only weather-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="weather-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group error-message-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPOGRAPHY'); ?>
                            </span>
                            <div class="ba-custom-select 404-typography-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="code"><?php echo JText::_('ERROR_CODE') ?></li>
                                    <li data-value="message"><?php echo JText::_('ERROR_MESSAGE') ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group error-message-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('TOP'); ?></span>
                                <input type="number" data-group="" data-option="top" data-subgroup="margin" data-callback="sectionRules">
                            </div>
                            <div>
                                <span><?php echo JText::_('BOTTOM'); ?></span>
                                <input type="number" data-group="" data-option="bottom" data-subgroup="margin" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="" data-subgroup="margin"
                                    data-action="sectionRules" data-group=""></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('RESET'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group weather-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPOGRAPHY'); ?>
                            </span>
                            <div class="ba-custom-select typography-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="city"><?php echo JText::_('CITY') ?></li>
                                    <li data-value="condition"><?php echo JText::_('CONDITION') ?></li>
                                    <li data-value="info"><?php echo JText::_('INFO') ?></li>
                                    <li data-value="forecasts"><?php echo JText::_('FORECAST') ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="weather-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="categories-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#categories-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#categories-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#categories-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="categories-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('APP'); ?>
                            </span>
                            <div class="ba-custom-select categories-app-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
<?php
                                foreach ($this->apps as $value) {
                                    echo '<li data-value="'.$value->id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SUBCATEGORIES'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="sub" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ITEMS_COUNTER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="counter" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="categories-design-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="nav-typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="nav-typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span><?php echo JText::_('COLOR'); ?></span>
                                    <input type="text" data-type="color" data-option="color" data-group="nav-typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules" min="0" max="1"
                                            step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY'); ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item hover-group">
                                    <span><?php echo JText::_('HOVER_ACTIVE') ?></span>
                                    <input type="text" data-type="color" data-option="color" data-group="nav-hover">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules" min="0" max="1"
                                            step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY'); ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span><?php echo JText::_('SIZE'); ?></span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="nav-typography" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span><?php echo JText::_('LETTER_SPACING'); ?></span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="nav-typography" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span><?php echo JText::_('LINE_HEIGHT'); ?></span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="nav-typography" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="nav-typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('UNDERLINE'); ?></span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="nav-typography" data-callback="sectionRules" class="active">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('UPPERCASE'); ?></span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="nav-typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('ITALIC'); ?></span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="nav-typography" data-callback="sectionRules" class="active">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('LEFT'); ?></span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="nav-typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('CENTER'); ?></span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="nav-typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('RIGHT'); ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="categories-layout-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="menu-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#menu-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#menu-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#menu-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
                <li>
                    <a href="#menu-mobile-options" data-toggle="tab">
                        <?php echo JText::_('MOBILE'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="menu-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group items-list one-page-options">
                        <div class="sorting-container">
                            
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group items-list menu-options">
                        <div class="sorting-container">
                            
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title one-page-options">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('SETTINGS'); ?></span>
                        </div>
                        <div class="ba-settings-item menu-options">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <input type="text" class="select-input select-mainmenu" readonly onfocus="this.blur()"
                                placeholder="<?php echo JText::_('SELECT'); ?>">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                        <div class="ba-settings-item one-page-options">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select select-one-page-type">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('CLASSIC'); ?></li>
                                    <li data-value="side-navigation-menu"><?php echo JText::_('SIDE_NAVIGATION'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item menu-layout-option">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select menu-layout-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-option="layout" data-group="layout">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('HORIZONTAL'); ?></li>
                                    <li data-value="vertical-menu"><?php echo JText::_('VERTICAL'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item one-page-options">
                            <span>
                                <?php echo JText::_('AUTOSCROLL'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="autoscroll" data-option="enable">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item one-page-options">
                            <span>
                                <?php echo JText::_('SCROLLING_SPEED'); ?>
                            </span>
                            <input type="text" data-group="autoscroll" data-option="speed" class="set-value-css"
                                placeholder="<?php echo JText::_('SCROLLING_SPEED'); ?>">
                        </div>
                        <div class="ba-settings-item one-page-options">
                            <span>
                                <?php echo JText::_('ANIMATION'); ?>
                            </span>
                            <div class="ba-custom-select one-page-animation-select">
                                <input readonly onfocus="this.blur()" value="" type="text" data-option="animation">
                                <input type="hidden" class="set-value-css" data-group="autoscroll" data-option="animation">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="easeInSine">easeInSine</li>
                                    <li data-value="easeOutSine">easeOutSine</li>
                                    <li data-value="easeOutQuad">easeOutQuad</li>
                                    <li data-value="easeOutCubic">easeOutCubic</li>
                                    <li data-value="easeInQuart">easeInQuart</li>
                                    <li data-value="easeOutQuart">easeOutQuart</li>
                                    <li data-value="easeInExpo">easeInExpo</li>
                                    <li data-value="easeOutExpo">easeOutExpo</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="menu-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group menu-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-custom-select menu-style-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="nav-menu"><?php echo JText::_('NAVIGATION'); ?></li>
                                    <li data-value="dropdown" class="desktop-only"><?php echo JText::_('DROPDOWN'); ?></li>
                                    <li data-value="sub-menu"><?php echo JText::_('SUBMENU'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group nav-menu-options sub-menu-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group nav-menu-options sub-menu-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-local-florist"></i>
                            <span><?php echo JText::_('ICON'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="nav" data-subgroup="icon" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group nav-menu-options sub-menu-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NORMAL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="nav" data-subgroup="normal">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="nav" data-subgroup="normal">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group nav-menu-options sub-menu-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('HOVER_ACTIVE'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="nav" data-subgroup="hover">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-group="nav" data-subgroup="hover" data-option="background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group nav-menu-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="nav" data-subgroup="margin" data-option="right"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="nav" data-subgroup="margin" data-option="left"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="nav" data-subgroup="margin"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group dropdown-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item background">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-group="background" data-option="color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper image-width">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1000">
                                <input type="number" data-option="width" data-group="dropdown" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group dropdown-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-skip-next"></i>
                            <span><?php echo JText::_('ANIMATION'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('EFFECT'); ?></span>
                            <div class="ba-custom-select dropdown-menu-animation">
                                <input readonly onfocus="this.blur()" type="text" value="None">
                                <input type="hidden" value="" data-option="effect" data-group="dropdown" data-subgroup="animation">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="bounceIn">Bounce In</li>
                                    <li data-value="bounceInLeft">Bounce In Left</li>
                                    <li data-value="bounceInRight">Bounce In Right</li>
                                    <li data-value="bounceInUp">Bounce In Up</li>
                                    <li data-value="fadeIn">Fade In</li>
                                    <li data-value="fadeInLeft">Fade In Left</li>
                                    <li data-value="fadeInRight">Fade In Right</li>
                                    <li data-value="fadeInUp">Fade In Up</li>
                                    <li data-value="zoomIn">Zoom In</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('DURATION'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2" step="0.1">
                                <input type="number" data-option="duration" data-group="dropdown" data-subgroup="animation"
                                    step="0.1" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('TOP'); ?></span>
                                <input type="number" data-group="nav" data-subgroup="padding" data-option="top"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span><?php echo JText::_('RIGHT'); ?></span>
                                <input type="number" data-group="nav" data-subgroup="padding" data-option="right"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span><?php echo JText::_('BOTTOM'); ?></span>
                                <input type="number" data-group="nav" data-subgroup="padding" data-option="bottom"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span><?php echo JText::_('LEFT'); ?></span>
                                <input type="number" data-group="nav" data-option="left" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="nav" data-subgroup="padding"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top"><?php echo JText::_('RESET'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group nav-menu-options sub-menu-options last-element-child">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="set-value-css" data-group="nav" data-subgroup="border" data-option="top">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('RIGHT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="set-value-css" data-group="nav" data-subgroup="border" data-option="right">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('BOTTOM'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="set-value-css" data-group="nav" data-subgroup="border" data-option="bottom">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('LEFT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="set-value-css" data-group="nav" data-subgroup="border" data-option="left">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="nav" data-subgroup="border"
                                    data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="nav" data-subgroup="border"
                                class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="nav" data-subgroup="border"
                                    data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" data-option="style" data-group="nav" data-subgroup="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group dropdown-options desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="menu-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu-mobile-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ENABLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="hamburger" data-option="enable">
                                <span></span>
                            </label>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('HAMBURGER_MENU_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item menu-options">
                            <span>
                                <?php echo JText::_('COLLAPSE_SUBMENU'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="hamburger" data-option="collapse">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select menu-position-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="ba-menu-position-left"><?php echo JText::_('LEFT'); ?></li>
                                    <li data-value="ba-menu-position-center"><?php echo JText::_('CENTER'); ?></li>
                                    <li data-value=""><?php echo JText::_('RIGHT'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('ICON_OPEN'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="open" data-group="hamburger">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-option="open-align" data-value="left" data-group="hamburger" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="open-align" data-value="center" data-group="hamburger" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-option="open-align" data-value="right" data-group="hamburger" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('ICON_CLOSE'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="close" data-group="hamburger">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-option="close-align" data-value="left" data-group="hamburger" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="close-align" data-value="center" data-group="hamburger" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-option="close-align" data-value="right" data-group="hamburger" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="hamburger" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="recent-posts-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#recent-posts-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#recent-posts-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#recent-posts-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="recent-posts-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group desktop-only">
                        <div class="ba-settings-item recent-posts-options">
                            <span>
                                <?php echo JText::_('APP'); ?>
                            </span>
                            <div class="ba-custom-select recent-posts-app-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="app">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
<?php
                                foreach ($this->apps as $value) {
                                    echo '<li data-value="'.$value->id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item recent-posts-options tags-categories-list">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <div class="tags-categories">
                                <ul class="selected-categories">
                                    <li class="search-category">
                                        <input type="text" placeholder="<?php echo JText::_('CATEGORY'); ?>">
                                    </li>
                                </ul>
                                <ul class="all-categories-list">
<?php
                                foreach ($this->categories as $value) {
                                    echo '<li data-id="'.$value->id.'" data-app="'.$value->app_id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('TAGS_CATEGORY_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item recent-posts-options">
                            <span>
                                <?php echo JText::_('SORT_BY'); ?>
                            </span>
                            <div class="ba-custom-select recent-posts-display-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="sorting">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="created"><?php echo JText::_('RECENT'); ?></li>
                                    <li data-value="hits"><?php echo JText::_('POPULAR'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item related-posts-options">
                            <span>
                                <?php echo JText::_('SORT_BY'); ?>
                            </span>
                            <div class="ba-custom-select related-posts-display-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="related">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="tags"><?php echo JText::_('TAGS'); ?></li>
                                    <li data-value="categories"><?php echo JText::_('CATEGORIES'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item recent-posts-options related-posts-options">
                            <span>
                                <?php echo JText::_('MAX_ITEMS'); ?>
                            </span>
                            <input type="number" data-option="limit" class="lightbox-settings-input recent-limit" placeholder="5">
                        </div>
                        <div class="ba-settings-item search-result-options">
                            <span>
                                <?php echo JText::_('SEARCH'); ?>
                            </span>
                            <div class="ba-custom-select search-result-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="related">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('ENTIRE_WEBSITE'); ?></li>
                                    <li data-value="app"><?php echo JText::_('APP'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item search-result-options search-result-app">
                            <span>
                                <?php echo JText::_('APP'); ?>
                            </span>
                            <div class="ba-custom-select search-result-app-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="app">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
<?php
                                foreach ($this->apps as $value) {
                                    echo '<li data-value="'.$value->id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select blog-posts-layout-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="ba-classic-layout"><?php echo JText::_('CLASSIC'); ?></li>
                                    <li data-value="ba-grid-layout"><?php echo JText::_('GRID'); ?></li>
                                    <li data-value="ba-cover-layout"><?php echo JText::_('COVER'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item blog-posts-grid-options">
                            <span>
                                <?php echo JText::_('NUMBER_OF_COLUMNS'); ?>
                            </span>
                            <input type="number" data-option="count" data-group="view" class="lightbox-settings-input set-value-css">
                        </div>
                        <div class="ba-settings-item blog-posts-cover-options">
                            <span>
                                <?php echo JText::_('COLUMNS_GUTTER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="gutter" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('IMAGE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="image" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TITLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="title" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DATE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="date" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="category" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('INTRO_TEXT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="intro" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BUTTON'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="button" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only preset-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="recent-posts-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group slideshow-design-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-custom-select ba-style-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="image"><?php echo JText::_('IMAGE'); ?></li>
                                    <li data-value="title"><?php echo JText::_('TITLE'); ?></li>
                                    <li data-value="info"><?php echo JText::_('INFO'); ?></li>
                                    <li data-value="intro"><?php echo JText::_('INTRO_TEXT'); ?></li>
                                    <li data-value="button"><?php echo JText::_('BUTTON'); ?></li>
                                    <li data-value="pagination" class="search-result-options"><?php echo JText::_('PAGINATION'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-typography-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item ba-style-typography-color">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item ba-style-typography-hover-color desktop-only" style="display: none;">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-image-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="10" max="1500">
                                <input type="number" data-option="width" data-group="image" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="10" max="1500">
                                <input type="number" data-option="height" data-group="image" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-image-options blog-posts-cover-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-group="overlay" data-option="color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-pagination-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="pagination">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HOVER_ACTIVE'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="hover" data-group="pagination">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-pagination-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ITEMS_PER_PAGE'); ?>
                            </span>
                            <input type="number" data-option="limit" class="lightbox-settings-input set-value-css" placeholder="3">
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NORMAL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="normal"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="" data-subgroup="normal"
                                class="icon-background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('HOVER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="" data-subgroup="hover"
                                class="icon-background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-intro-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MAXIMUM_LENGTH'); ?>
                            </span>
                            <input type="number" data-option="maximum" class="lightbox-settings-input" placeholder="50">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                <?php echo JText::_('MAXIMUM_LENGTH_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-margin-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="top" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="bottom" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="description" data-subgroup="margin"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="top" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="right" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="bottom" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="left" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="button" data-subgroup="padding"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-border-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-subgroup="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-subgroup="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-subgroup="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-subgroup="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-subgroup="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-subgroup="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group blog-posts-background-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item background">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="background" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="recent-posts-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group blog-posts-shadow-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="blog-posts-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#blog-posts-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#blog-posts-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#blog-posts-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="blog-posts-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select blog-posts-layout-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="ba-classic-layout"><?php echo JText::_('CLASSIC'); ?></li>
                                    <li data-value="ba-grid-layout"><?php echo JText::_('GRID'); ?></li>
                                    <li data-value="ba-cover-layout"><?php echo JText::_('COVER'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item blog-posts-grid-options">
                            <span>
                                <?php echo JText::_('NUMBER_OF_COLUMNS'); ?>
                            </span>
                            <input type="number" data-option="count" data-group="view" class="lightbox-settings-input set-value-css">
                        </div>
                        <div class="ba-settings-item blog-posts-cover-options">
                            <span>
                                <?php echo JText::_('COLUMNS_GUTTER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="gutter" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item" style="display: none;">
                            <span>
                                <?php echo JText::_('SORT_BY'); ?>
                            </span>
                            <div class="ba-custom-select blog-posts-sort-select">
                                <input readonly="" onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="created"><?php echo JText::_('RECENT'); ?></li>
                                    <li data-value="hits"><?php echo JText::_('POPULAR'); ?></li>
                                    <li data-value="order_list"><?php echo JText::_('CUSTOM'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group blog-posts-view-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('IMAGE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="image" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TITLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="title" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DATE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="date" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="category" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HITS'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="hits" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('INTRO_TEXT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="intro" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BUTTON'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="button" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="blog-posts-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group slideshow-design-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-custom-select ba-style-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="image"><?php echo JText::_('IMAGE'); ?></li>
                                    <li data-value="title"><?php echo JText::_('TITLE'); ?></li>
                                    <li data-value="info"><?php echo JText::_('INFO'); ?></li>
                                    <li data-value="intro"><?php echo JText::_('INTRO_TEXT'); ?></li>
                                    <li data-value="button"><?php echo JText::_('BUTTON'); ?></li>
                                    <li data-value="pagination"><?php echo JText::_('PAGINATION'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-typography-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item ba-style-typography-color">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item ba-style-typography-hover-color desktop-only" style="display: none;">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-pagination-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="pagination">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HOVER_ACTIVE'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="hover" data-group="pagination">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-pagination-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ITEMS_PER_PAGE'); ?>
                            </span>
                            <input type="number" data-option="limit" class="lightbox-settings-input" placeholder="3">
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-image-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="10" max="1500">
                                <input type="number" data-option="width" data-group="image" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="100" max="1500">
                                <input type="number" data-option="height" data-group="image" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-image-options blog-posts-cover-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="overlay">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NORMAL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="normal"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="" data-subgroup="normal"
                                class="icon-background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('HOVER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="" data-subgroup="hover"
                                class="icon-background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-intro-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MAXIMUM_LENGTH'); ?>
                            </span>
                            <input type="number" data-option="maximum" class="lightbox-settings-input" placeholder="50">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                <?php echo JText::_('MAXIMUM_LENGTH_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-margin-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="top" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="bottom" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="description" data-subgroup="margin"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="top" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="right" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="bottom" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="left" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="button" data-subgroup="padding"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-subgroup="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-subgroup="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-subgroup="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-subgroup="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-button-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-subgroup="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-subgroup="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group blog-posts-background-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item background">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="background" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="blog-posts-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group blog-posts-shadow-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="tabs-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tabs-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#tabs-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#tabs-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="tabs-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group items-list">
                        <div class="sorting-container">
                            
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only tabs-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select tabs-position-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="tabs-top"><?php echo JText::_('TOP'); ?></li>
                                    <li data-value="tabs-left"><?php echo JText::_('LEFT'); ?></li>
                                    <li data-value="tabs-right"><?php echo JText::_('RIGHT'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="tabs-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item tabs-options hover-group">
                                    <span>
                                        <?php echo JText::_('HOVER_ACTIVE'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="hover">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group tabs-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-top"></i>
                            <span><?php echo JText::_('HEADER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="border" data-group="header">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="header">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-local-florist"></i>
                            <span><?php echo JText::_('ICON'); ?></span>
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select tabs-icon-position">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" data-option="position" data-group="icon" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="icon-position-left"><?php echo JText::_('LEFT'); ?></li>
                                    <li class="tabs-options" data-value="icon-position-top"><?php echo JText::_('TOP'); ?></li>
                                    <li data-value=""><?php echo JText::_('RIGHT'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icon" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group tabs-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-group="background" data-option="color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group accordion-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('BACKGROUND'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEADER'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="header">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BODY'); ?>
                            </span>
                            <input type="text" data-type="color" data-group="background" data-option="color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group accordion-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-top"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input class="minicolors-top" type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="tabs-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="social-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#social-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="social-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select social-layout-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-option="layout" data-group="view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('DEFAULT'); ?></li>
                                    <li data-value="ba-social-sidebar"><?php echo JText::_('SIDEBAR'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-custom-select social-size-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-option="size" data-group="view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="ba-social-sm"><?php echo JText::_('SMALL'); ?></li>
                                    <li data-value="ba-social-md"><?php echo JText::_('MEDIUM'); ?></li>
                                    <li data-value="ba-social-lg"><?php echo JText::_('LARGE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select social-style-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-option="style" data-group="view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="ba-social-classic"><?php echo JText::_('CLASSIC'); ?></li>
                                    <li data-value="ba-social-flat"><?php echo JText::_('FLAT'); ?></li>
                                    <li data-value="ba-social-circle"><?php echo JText::_('CIRCLE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COUNTERS'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="counters" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-share"></i>
                            <span><?php echo JText::_('SOCIAL_NETWORKS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                Facebook
                            </span>
                            <label class="ba-checkbox">
                                <input class="show-social" type="checkbox" data-option="facebook">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                Twitter
                            </span>
                            <label class="ba-checkbox">
                                <input class="show-social" type="checkbox" data-option="twitter">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                Google+
                            </span>
                            <label class="ba-checkbox">
                                <input class="show-social" type="checkbox" data-option="google">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                Vkontakte
                            </span>
                            <label class="ba-checkbox">
                                <input class="show-social" type="checkbox" data-option="vk">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                LinkedIn
                            </span>
                            <label class="ba-checkbox">
                                <input class="show-social" type="checkbox" data-option="linkedin">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                Pinterest
                            </span>
                            <label class="ba-checkbox">
                                <input class="show-social" type="checkbox" data-option="pinterest">
                                <span></span>
                            </label>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('PINTEREST_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="lightbox-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#lightbox-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="lightbox-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item desktop-only lightbox-options">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select lightbox-position-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="lightbox-top-left"><?php echo JText::_('TOP_LEFT'); ?></li>
                                    <li data-value="lightbox-top-right"><?php echo JText::_('TOP_RIGHT'); ?></li>
                                    <li data-value="lightbox-center"><?php echo JText::_('CENTER'); ?></li>
                                    <li data-value="lightbox-bottom-left"><?php echo JText::_('BOTTOM_LEFT'); ?></li>
                                    <li data-value="lightbox-bottom-right"><?php echo JText::_('BOTTOM_RIGHT'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only overlay-section-options">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select overlay-section-layout-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="vertical"><?php echo JText::_('VERTICAL'); ?></li>
                                    <li data-value="horizontal"><?php echo JText::_('HORIZONTAL'); ?></li>
                                    <li data-value="lightbox"><?php echo JText::_('LIGHTBOX'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only overlay-section-options">
                            <span>
                                <?php echo JText::_('SLIDE'); ?>
                            </span>
                            <div class="ba-custom-select overlay-section-slide-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="vertical-right"><?php echo JText::_('RIGHT'); ?></li>
                                    <li data-value="vertical-left"><?php echo JText::_('LEFT'); ?></li>
                                    <li data-value="horizontal-top"><?php echo JText::_('TOP'); ?></li>
                                    <li data-value="horizontal-bottom"><?php echo JText::_('BOTTOM'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only lightbox-overlay-backdrop-color">
                            <span>
                                <?php echo JText::_('BACKGROUND_OVERLAY'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="lightbox">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item width-options">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1170">
                                <input type="number" data-option="width" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item height-options overlay-section-options">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2500">
                                <input type="number" data-option="height" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('ICON_CLOSE'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="close">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-option="text-align" data-value="left" data-group="close" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="center" data-group="close" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="right" data-group="close" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only lightbox-options lightbox-trigger-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('SETTINGS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TRIGGER'); ?>
                            </span>
                            <div class="ba-custom-select lightbox-trigger-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="time-delay"><?php echo JText::_('TIME_DELAY'); ?></li>
                                    <li data-value="scrolling"><?php echo JText::_('SCROLLING'); ?></li>
                                    <li data-value="bottom-of-page"><?php echo JText::_('BOTTOM_OF_PAGE'); ?></li>
                                    <li data-value="exit-intent"><?php echo JText::_('EXIT_INTENT'); ?></li>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('TRIGGER_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item time-delay-trigger">
                            <span>
                                <?php echo JText::_('TIME_DELAY'); ?>, ms
                            </span>
                            <input type="number" data-option="time" data-group="trigger" class="lightbox-settings-input"
                                placeholder="<?php echo JText::_('TIME_DELAY'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('TIME_DELAY_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item scrolling-trigger">
                            <span>
                                <?php echo JText::_('PERCENTAGE'); ?>, %
                            </span>
                            <input type="number" data-option="scroll" data-group="trigger" max="100" class="lightbox-settings-input"
                                placeholder="50">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('PERCENTAGE_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SHOW_ONCE_PER_SESSION'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="enable" data-group="session">
                                <span></span>
                            </label>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('SHOW_ONCE_PER_SESSION_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SESSION_DURATION'); ?>
                            </span>
                            <input type="number" data-option="duration" data-group="session" class="lightbox-settings-input"
                                placeholder="1">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('SESSION_DURATION_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="star-ratings-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#star-ratings-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#star-ratings-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#star-ratings-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="star-ratings-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('RATING'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="rating" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VOTES'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="votes" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('RICH_SNIPPETS'); ?></span>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                <?php echo JText::_('RICH_SNIPPETS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('META_IMAGE'); ?>
                            </span>
                            <input type="text" readonly="" onfocus="this.blur()" data-option="image" class="select-input" data-action="sectionRules" placeholder="Select">
                            <i class="zmdi zmdi-attachment-alt"></i>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('META_NAME'); ?>
                            </span>
                            <input type="text" data-option="name" placeholder="<?php echo JText::_('META_NAME'); ?>">
                        </div>
                        <div class="ba-settings-item input-resize">
                            <span>
                                <?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>
                            </span>
                            <textarea data-option="description" placeholder="<?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>">
                            </textarea>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="star-ratings-design-options" class="row-fluid tab-pane ">
                    <div class="ba-settings-group star-ratings-design-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-custom-select star-ratings-style-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="icon"><?php echo JText::_('ICON'); ?></li>
                                    <li data-value="info"><?php echo JText::_('INFO'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group star-ratings-icon-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="320">
                                <input type="number" data-option="size" data-group="icon" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-toolbar">
                            <label data-option="text-align" data-value="left" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-left"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="center" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-center"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('CENTER'); ?>
                                </span>
                            </label>
                            <label data-option="text-align" data-value="right" data-group="icon" data-callback="sectionRules">
                                <i class="zmdi zmdi-format-align-right"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group star-ratings-icon-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="icon">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HOVER_ACTIVE'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="hover" data-group="icon">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group star-ratings-typography-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item star-ratings-typography-color">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="star-ratings-layout-options" class="row-fluid tab-pane ">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="intro-post-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#intro-post-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#intro-post-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#intro-post-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="intro-post-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group items-list">
                        <div class="sorting-container">
                            
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('LAYOUT'); ?>
                            </span>
                            <div class="ba-custom-select intro-post-layout-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('CLASSIC'); ?></li>
                                    <li data-value="fullscreen-post"><?php echo JText::_('COVER'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group intro-post-view-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item intro-show-image">
                            <span>
                                <?php echo JText::_('IMAGE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="show" data-group="image" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TITLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="show" data-group="title" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item category-intro-view">
                            <span>
                                <?php echo JText::_('INFO'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="show" data-group="info" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item post-intro-view">
                            <span>
                                <?php echo JText::_('DATE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="date" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item post-intro-view">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="category" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item post-intro-view">
                            <span>
                                <?php echo JText::_('HITS'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="hits" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="intro-post-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group intro-post-design-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-custom-select intro-post-style-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="title"><?php echo JText::_('TITLE'); ?></li>
                                    <li data-value="info"><?php echo JText::_('INFO'); ?></li>
                                    <li data-value="image"><?php echo JText::_('IMAGE'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group intro-post-typography-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item intro-post-typography-color">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item info-post-typography-color info-hover-color">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="info" data-subgroup="hover">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group intro-post-image-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('FULLSCREEN'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="fullscreen" data-group="image" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="100" max="1500">
                                <input type="number" data-option="height" data-group="image" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ATTACHMENT'); ?>
                            </span>
                            <div class="ba-custom-select attachment">
                                <input readonly onfocus="this.blur()" value="fixed" type="text">
                                <input type="hidden" value="fixed" data-option="attachment" data-group="image"
                                    data-action="sectionRules">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="fixed">Fixed</li>
                                    <li data-value="scroll">Scroll</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-custom-select backround-size">
                                <input readonly onfocus="this.blur()" value="cover" type="text">
                                <input type="hidden" value="cover" data-option="size" data-group="image"
                                    data-action="sectionRules">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="cover">Cover</li>
                                    <li data-value="contain">Contain</li>
                                    <li data-value="initial">Auto</li>
                                </ul>
                            </div>
                        </div>
                        <div class="contain-size-options" style="display: none;">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-custom-select backround-position">
                                    <input readonly onfocus="this.blur()" value="center center" type="text">
                                    <input type="hidden" value="center center" data-option="position" data-group="image"
                                        data-action="sectionRules">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="left top">Left Top</li>
                                        <li data-value="left center">Left Center</li>
                                        <li data-value="left bottom">Left Bottom</li>
                                        <li data-value="right top">Right Top</li>
                                        <li data-value="right center">Right Center</li>
                                        <li data-value="right bottom">Right Bottom</li>
                                        <li data-value="center top">Center Top</li>
                                        <li data-value="center center">Center Center</li>
                                        <li data-value="center bottom">Center Bottom</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('REPEAT'); ?>
                                </span>
                                <div class="ba-custom-select backround-repeat">
                                    <input readonly onfocus="this.blur()" value="no-repeat" type="text">
                                    <input type="hidden" value="no-repeat" data-option="repeat" data-group="image"
                                        data-action="sectionRules">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="repeat">Repeat</li>
                                        <li data-value="repeat-x">Repeat-x</li>
                                        <li data-value="repeat-y">Repeat-y</li>
                                        <li data-value="no-repeat">No-repeat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group intro-post-image-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select background-overlay-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden" data-property="image">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="color"><?php echo JText::_('COLOR'); ?></li>
                                    <li data-value="gradient"><?php echo JText::_('GRADIENT'); ?></li>
                                    <li data-value="none"><?php echo JText::_('NO_NE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay-color-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color" data-group="image">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                        </div>
                        <div class="overlay-gradient-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('EFFECT'); ?>
                                </span>
                                <div class="ba-custom-select gradient-effect-select">
                                    <input readonly onfocus="this.blur()" value="" type="text">
                                    <input type="hidden" value="" data-property="image">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="linear">Linear</li>
                                        <li data-value="radial">Radial</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ba-settings-item overlay-linear-gradient">
                                <span>
                                    <?php echo JText::_('ANGLE'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="360" step="1">
                                    <input type="number" data-option="angle" data-group="image" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('START_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color1" data-group="image"
                                    data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position1" data-group="image" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('END_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color2" data-group="image"
                                    data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position2" data-group="image" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group intro-post-margin-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="top" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="bottom" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="description" data-subgroup="margin"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="intro-post-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="slideshow-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#slideshow-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#slideshow-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#slideshow-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="slideshow-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group items-list">
                        <div class="sorting-container">
                            
                        </div>
                        <div class="add-new-item">
                            <span>
                                <i class="zmdi zmdi-plus-circle"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('ADD_NEW_ITEM'); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group recent-posts-slider-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('APP'); ?>
                            </span>
                            <div class="ba-custom-select recent-posts-app-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="app">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
<?php
                                foreach ($this->apps as $value) {
                                    echo '<li data-value="'.$value->id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item tags-categories-list">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <div class="tags-categories">
                                <ul class="selected-categories">
                                    <li class="search-category">
                                        <input type="text" placeholder="<?php echo JText::_('CATEGORY'); ?>">
                                    </li>
                                </ul>
                                <ul class="all-categories-list">
<?php
                                foreach ($this->categories as $value) {
                                    echo '<li data-id="'.$value->id.'" data-app="'.$value->app_id.'">'.$value->title.'</li>';
                                }
?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('TAGS_CATEGORY_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SORT_BY'); ?>
                            </span>
                            <div class="ba-custom-select recent-posts-display-select">
                                <input readonly="" onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="1" data-option="sorting">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="created"><?php echo JText::_('RECENT'); ?></li>
                                    <li data-value="hits"><?php echo JText::_('POPULAR'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MAX_ITEMS'); ?>
                            </span>
                            <input type="number" data-option="limit" class="lightbox-settings-input recent-limit" placeholder="5">
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item carousel-options slideset-options">
                            <span>
                                <?php echo JText::_('IMAGES_PER_SLIDE'); ?>
                            </span>
                            <input type="number" data-option="count" data-group="slideset" class="lightbox-settings-input"
                                placeholder="3">
                        </div>
                        <div class="ba-settings-item slideshow-options">
                            <span>
                                <?php echo JText::_('FULLSCREEN'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="fullscreen" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HEIGHT'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1500">
                                <input type="number" data-option="height" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-custom-select slideshow-size-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="" data-option="size" data-group="view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="cover">Cover</li>
                                    <li data-value="contain">Contain</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only carousel-options slideset-options">
                            <span>
                                <?php echo JText::_('COLUMNS_GUTTER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="gutter" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item carousel-options">
                            <span>
                                <?php echo JText::_('OVERFLOW'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="overflow" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item recent-posts-slider-options">
                            <span>
                                <?php echo JText::_('TITLE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="title" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item recent-posts-slider-options">
                            <span>
                                <?php echo JText::_('DATE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="date" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item recent-posts-slider-options">
                            <span>
                                <?php echo JText::_('CATEGORY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="category" data-group="view" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item recent-posts-slider-options">
                            <span>
                                <?php echo JText::_('INTRO_TEXT'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="intro" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item recent-posts-slider-options">
                            <span>
                                <?php echo JText::_('BUTTON'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="button" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ARROWS'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="arrows" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('DOTS'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-group="view" data-option="dots" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only slideshow-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('SETTINGS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('AUTOPLAY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="autoplay" data-group="slideshow">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('PAUSE_ON_MOUSEOVER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="pause" data-group="slideshow">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SLIDE_DELAY'); ?>, ms
                            </span>
                            <input type="number" data-option="delay" data-group="slideshow" class="lightbox-settings-input"
                                placeholder="3000">
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('ANIMATION'); ?>
                            </span>
                            <div class="ba-custom-select slideshow-animation-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="ba-fade-in" selected="selected">Fade</li>
                                    <li data-value="ba-horizontal-fall">Horizontal Fall</li>
                                    <li data-value="ba-horizontal-in">Horizontal In</li>
                                    <li data-value="ba-horizontal-out">Horizontal Out</li>
                                    <li data-value="ba-offset-horizontal">Offset Horizontal</li>
                                    <li data-value="ba-offset-horizontal-fast">Offset Horizontal Fast</li>
                                    <li data-value="ba-offset-vertical">Offset Vertical</li>
                                    <li data-value="ba-offset-vertical-fast">Offset Vertical Fast</li>
                                    <li data-value="ba-scale-in">Scale In</li>
                                    <li data-value="ba-scale-out">Scale Out</li>
                                    <li data-value="ba-vertical-in">Vertical In</li>
                                    <li data-value="ba-vertical-out">Vertical Out</li>
                                    <li data-value="ba-ken-burns">Ken Burns</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group carousel-options slideset-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('SETTINGS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('AUTOPLAY'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="autoplay" data-group="slideset">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('PAUSE_ON_MOUSEOVER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="pause" data-group="slideset">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SLIDE_DELAY'); ?>, ms
                            </span>
                            <input type="number" data-option="delay" data-group="slideset" class="lightbox-settings-input"
                                placeholder="<?php echo JText::_('SLIDE_DELAY'); ?>">
                        </div>
                        <div class="ba-settings-item desktop-only">
                            <span>
                                <?php echo JText::_('ANIMATION'); ?>
                            </span>
                            <div class="ba-custom-select slideset-animation-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="slideset-fade">Fade</li>
                                    <li data-value="horisontal-fast">Horizontal Fast</li>
                                    <li data-value="horisontal-offset">Horizontal Offset</li>
                                    <li data-value="vertical-offset">Vertical Offset</li>
                                    <li data-value="slideset-zoom-in">Zoom In</li>
                                    <li data-value="slideset-zoom-out">Zoom Out</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ">
                        <div class="settings-group-title carousel-options slideset-options">
                            <i class="zmdi zmdi-tune"></i>
                            <span><?php echo JText::_('CAPTION'); ?></span>
                        </div>
                        <div class="ba-settings-item desktop-only carousel-options slideset-options">
                            <span>
                                <?php echo JText::_('POSITION'); ?>
                            </span>
                            <div class="ba-custom-select slideset-caption-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="caption-over"><?php echo JText::_('OVER'); ?></li>
                                    <li data-value=""><?php echo JText::_('BELOW'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item desktop-only carousel-options slideset-options">
                            <span>
                                <?php echo JText::_('DISPLAY_ON_MOUSEOVER'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="hover" data-group="caption">
                                <span></span>
                            </label>
                        </div>
                        <div class="settings-group-title slideshow-options">
                            <i class="zmdi zmdi-format-color-fill"></i>
                            <span><?php echo JText::_('OVERLAY'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('TYPE'); ?>
                            </span>
                            <div class="ba-custom-select background-overlay-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden" data-property="overlay">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="color"><?php echo JText::_('COLOR'); ?></li>
                                    <li data-value="gradient"><?php echo JText::_('GRADIENT'); ?></li>
                                    <li data-value="none"><?php echo JText::_('NO_NE'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay-color-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color" data-group="overlay">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                        </div>
                        <div class="overlay-gradient-options">
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('EFFECT'); ?>
                                </span>
                                <div class="ba-custom-select gradient-effect-select">
                                    <input readonly onfocus="this.blur()" value="" type="text">
                                    <input type="hidden" value="" data-property="overlay">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="linear">Linear</li>
                                        <li data-value="radial">Radial</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ba-settings-item overlay-linear-gradient">
                                <span>
                                    <?php echo JText::_('ANGLE'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="360" step="1">
                                    <input type="number" data-option="angle" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('START_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color1" data-group="overlay"
                                    data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position1" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('END_COLOR'); ?>
                                </span>
                                <input type="text" data-type="color" data-option="color2" data-group="overlay"
                                    data-subgroup="gradient">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                    min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                            </div>
                            <div class="ba-settings-item">
                                <span>
                                    <?php echo JText::_('POSITION'); ?>
                                </span>
                                <div class="ba-range-wrapper">
                                    <span class="ba-range-liner"></span>
                                    <input type="range" class="ba-range" min="0" max="100" step="1">
                                    <input type="number" data-option="position2" data-group="overlay" data-subgroup="gradient"
                                        step="1" data-callback="sectionRules">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="slideshow-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group recent-posts-slider-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slideshow-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group slideshow-design-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-custom-select slideshow-style-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="title"><?php echo JText::_('TITLE'); ?></li>
                                    <li data-value="description"><?php echo JText::_('DESCRIPTION'); ?></li>
                                    <li data-value="info"><?php echo JText::_('INFO'); ?></li>
                                    <li data-value="intro"><?php echo JText::_('INTRO_TEXT'); ?></li>
                                    <li data-value="button"><?php echo JText::_('BUTTON'); ?></li>
                                    <li data-value="arrows"><?php echo JText::_('ARROWS'); ?></li>
                                    <li data-value="dots"><?php echo JText::_('DOTS'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-typography-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item slideshow-typography-color">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item slideshow-typography-hover">
                                    <span>
                                        <?php echo JText::_('HOVER'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LINE_HEIGHT'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="640">
                                        <input type="number" data-option="line-height" data-group="" data-subgroup="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="left" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-left"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('LEFT'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="center" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-center"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('CENTER'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-align" data-value="right" data-group="" data-subgroup="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-align-right"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('RIGHT'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group ba-style-intro-options desktop-only">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('MAXIMUM_LENGTH'); ?>
                            </span>
                            <input type="number" data-option="maximum" class="lightbox-settings-input" placeholder="50">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                <?php echo JText::_('MAXIMUM_LENGTH_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only slideshow-animation-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-skip-next"></i>
                            <span><?php echo JText::_('ANIMATION'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('EFFECT'); ?></span>
                            <div class="ba-custom-select slideshow-item-effect-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="None">
                                <input type="hidden" value="" data-option="effect" data-group="" data-subgroup="animation">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value=""><?php echo JText::_('NO_NE'); ?></li>
                                    <li data-value="bounceIn">Bounce In</li>
                                    <li data-value="bounceInLeft">Bounce In Left</li>
                                    <li data-value="bounceInRight">Bounce In Right</li>
                                    <li data-value="bounceInUp">Bounce In Up</li>
                                    <li data-value="fadeIn">Fade In</li>
                                    <li data-value="fadeInLeft">Fade In Left</li>
                                    <li data-value="fadeInRight">Fade In Right</li>
                                    <li data-value="fadeInUp">Fade In Up</li>
                                    <li data-value="zoomIn">Zoom In</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('DURATION'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="2" step="0.1">
                                <input type="number" data-option="duration" data-group="" data-subgroup="animation"
                                    step="0.1" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-dots-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="normal"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('HOVER_ACTIVE'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1000">
                                <input type="number" data-option="size" data-group="" data-subgroup="" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-arrows-options">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SIZE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1000">
                                <input type="number" data-option="size" data-group="" data-subgroup="" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-normal-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('NORMAL'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="normal"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="" data-subgroup="normal"
                                class="icon-background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-hover-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('HOVER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="" data-subgroup="hover"
                                class="icon-color">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="" data-subgroup="hover"
                                class="icon-background">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-margin-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="top" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="description" data-option="bottom" data-subgroup="margin"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="description" data-subgroup="margin"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-button-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="top" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="right" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="bottom" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="button" data-option="left" data-subgroup="padding"
                                    data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="button" data-subgroup="padding"
                                    data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-arrows-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="1000">
                                <input type="number" data-option="padding" data-group="" data-subgroup="" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-border-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-subgroup="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-subgroup="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-subgroup="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-subgroup="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group slideshow-shadow-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-subgroup="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-subgroup="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>
<div id="progress-bar-settings-dialog" class="ba-modal-cp draggable-modal-cp modal hide">
    <div class="modal-header">
        <span class="ba-dialog-title"></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#progress-bar-general-options" data-toggle="tab">
                        <?php echo JText::_('GENERAL'); ?>
                    </a>
                </li>
                <li>
                    <a href="#progress-bar-design-options" data-toggle="tab">
                        <?php echo JText::_('DESIGN'); ?>
                    </a>
                </li>
                <li>
                    <a href="#progress-bar-layout-options" data-toggle="tab">
                        <?php echo JText::_('LAYOUT'); ?>
                    </a>
                </li>
            </ul>
            <div class="tabs-underline"></div>
            <div class="tab-content">
                <div id="progress-bar-general-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group desktop-only">
                        <div class="ba-settings-item progress-bar-options">
                            <span>
                                <?php echo JText::_('LABEL'); ?>
                            </span>
                            <input type="text" placeholder="<?php echo JText::_('LABEL'); ?>" class="progress-bar-label">
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('TARGET_NUMBER') ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="1" max="100">
                                <input type="number" class="progress-bar-target" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-desktop-windows"></i>
                            <span><?php echo JText::_('VIEW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('TARGET_NUMBER'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="target" data-group="display" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item progress-bar-options">
                            <span><?php echo JText::_('LABEL'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="label" data-group="display" class="set-value-css">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-skip-next"></i>
                            <span><?php echo JText::_('ANIMATION'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EFFECT'); ?>
                            </span>
                            <div class="ba-custom-select progress-bar-effect-select">
                                <input readonly onfocus="this.blur()" type="text">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="easeInSine">easeInSine</li>
                                    <li data-value="easeOutSine">easeOutSine</li>
                                    <li data-value="easeOutQuad">easeOutQuad</li>
                                    <li data-value="easeOutCubic">easeOutCubic</li>
                                    <li data-value="easeInQuart">easeInQuart</li>
                                    <li data-value="easeOutQuart">easeOutQuart</li>
                                    <li data-value="easeInExpo">easeInExpo</li>
                                    <li data-value="easeOutExpo">easeOutExpo</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('DURATION'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="4" step="0.1">
                                <input type="number" step="0.1" data-callback="sectionRules" class="progress-bar-duration">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-eye"></i>
                            <span><?php echo JText::_('DISABLE_ON'); ?></span>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('DESKTOP'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="desktop">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('TABLET'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="tablet">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item ba-inline-checkbox">
                            <span>
                                <?php echo JText::_('PHONE'); ?>
                            </span>
                            <label class="ba-checkbox">
                                <input type="checkbox" data-option="disable" data-group="phone">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="ba-settings-group desktop-only">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-roller"></i>
                            <span><?php echo JText::_('PRESETS'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('SELECT'); ?>
                            </span>
                            <div class="ba-lg-custom-select select-preset">
                                <input type="text" readonly onfocus="this.blur()">
                                <input type="hidden">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <div class="ba-lg-custom-select-header">
                                        <span class="create-new-preset">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('SAVE_PRESET'); ?></span>
                                        </span>
                                        <span class="edit-preset-item">
                                            <i class="zmdi zmdi-edit"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('EDIT'); ?></span>
                                        </span>
                                        <span class="delete-preset-item">
                                            <i class="zmdi zmdi-delete"></i>
                                            <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE'); ?></span>
                                        </span>
                                    </div>
                                    <div class="ba-lg-custom-select-body">
                                        <li data-value="">
                                            <label>
                                                <input type="radio" name="preset-checkbox" value="">
                                                <i class="zmdi zmdi-circle-o"></i>
                                                <i class="zmdi zmdi-check"></i>
                                            </label>
                                            <span><?php echo JText::_('NO_NE'); ?></span>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-settings"></i>
                            <span><?php echo JText::_('ADVANCED'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('EDIT'); ?>
                            </span>
                            <div class="ba-custom-select section-access-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_EDIT_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VIEW'); ?>
                            </span>
                            <div class="ba-custom-select section-access-view-select visible-select-top">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" data-group="access_view" class="set-value-css">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->access as $key => $access) {
                                        $str = '<li data-value="'.$key.'">';
                                        $str .= $access.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('ACCESS_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('CLASS_SUFFIX'); ?>
                            </span>
                            <input type="text" class="class-suffix" placeholder="<?php echo JText::_('CLASS_SUFFIX'); ?>">
                            <label class="ba-help-icon">
                                <i class="zmdi zmdi-help"></i>
                                <span class="ba-tooltip ba-help">
                                    <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="progress-bar-design-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item progress-bar-options">
                            <span><?php echo JText::_('HEIGHT'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="1" max="100">
                                <input type="number" data-option="height" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item progress-pie-options">
                            <span><?php echo JText::_('WIDTH'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="1" max="1000">
                                <input type="number" data-option="width" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item progress-pie-options">
                            <span><?php echo JText::_('BAR_WIDTH'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="1" max="100">
                                <input type="number" data-option="line" data-group="view" data-callback="sectionRules">
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-format-size"></i>
                            <span><?php echo JText::_('TYPOGRAPHY'); ?></span>
                        </div>
                        <div class="theme-typography-options">
                            <div class="typography-options">
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_FAMILY'); ?>
                                    </span>
                                    <div class="ba-custom-select font-family-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-family" data-group="typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item desktop-only">
                                    <span>
                                        <?php echo JText::_('FONT_WEIGHT'); ?>
                                    </span>
                                    <div class="ba-custom-select font-weight-select">
                                        <input readonly onfocus="this.blur()" type="text">
                                        <input type="hidden" data-option="font-weight" data-group="typography" data-callback="sectionRules">
                                        <i class="zmdi zmdi-caret-down"></i>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('COLOR'); ?>
                                    </span>
                                    <input type="text" data-type="color" data-option="color" data-group="typography">
                                    <span class="minicolors-opacity-wrapper">
                                        <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                        min="0" max="1" step="0.01">
                                        <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                                    </span>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('SIZE'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner"></span>
                                        <input type="range" class="ba-range" min="0" max="320">
                                        <input type="number" data-option="font-size" data-group="typography" data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-item">
                                    <span>
                                        <?php echo JText::_('LETTER_SPACING'); ?>
                                    </span>
                                    <div class="ba-range-wrapper">
                                        <span class="ba-range-liner letter-spacing"></span>
                                        <input type="range" class="ba-range" min="-10" max="10">
                                        <input type="number" data-option="letter-spacing" data-group="typography"
                                            data-callback="sectionRules">
                                    </div>
                                </div>
                                <div class="ba-settings-toolbar">
                                    <label data-option="text-decoration" data-value="underline" data-group="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-underlined"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UNDERLINE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="text-transform" data-value="uppercase" data-group="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-size"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('UPPERCASE'); ?>
                                        </span>
                                    </label>
                                    <label data-option="font-style" data-value="italic" data-group="typography"
                                        data-callback="sectionRules">
                                        <i class="zmdi zmdi-format-italic"></i>
                                        <span class="ba-tooltip ba-top">
                                            <?php echo JText::_('ITALIC'); ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BAR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="bar" data-group="view" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BACKGROUND'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="background" data-group="view" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="progress-bar-layout-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('MARGIN'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="margin" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="margin" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group progress-bar-options">
                        <div class="settings-group-title">
                            <span><?php echo JText::_('PADDING'); ?></span>
                        </div>
                        <div class="ba-settings-toolbar">
                            <div>
                                <span>
                                    <?php echo JText::_('TOP'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="top" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('RIGHT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="right" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('BOTTOM'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="bottom" data-callback="sectionRules">
                            </div>
                            <div>
                                <span>
                                    <?php echo JText::_('LEFT'); ?>
                                </span>
                                <input type="number" data-group="padding" data-option="left" data-callback="sectionRules">
                            </div>
                            <div>
                                <i class="zmdi zmdi-close" data-type="reset" data-option="padding" data-action="sectionRules"></i>
                                <span class="ba-tooltip ba-top">
                                    <?php echo JText::_('RESET'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group progress-bar-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-border-left"></i>
                            <span><?php echo JText::_('BORDER'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('BORDER_RADIUS'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="500">
                                <input type="number" data-option="radius" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="border">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('WIDTH'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="20">
                                <input type="number" data-option="width" data-group="border" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('STYLE'); ?>
                            </span>
                            <div class="ba-custom-select border-style-select visible-select-top">
                                <input readonly onfocus="this.blur()" value="" type="text">
                                <input type="hidden" value="" data-option="style" data-group="border">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="solid">Solid</li>
                                    <li data-value="dashed">Dashed</li>
                                    <li data-value="dotted">Dotted</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ba-settings-group progress-bar-options">
                        <div class="settings-group-title">
                            <i class="zmdi zmdi-select-all"></i>
                            <span><?php echo JText::_('SHADOW'); ?></span>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('VALUE'); ?>
                            </span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10">
                                <input type="number" data-option="value" data-group="shadow" data-callback="sectionRules">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span>
                                <?php echo JText::_('COLOR'); ?>
                            </span>
                            <input type="text" data-type="color" data-option="color" data-group="shadow" class="minicolors-top">
                            <span class="minicolors-opacity-wrapper">
                                <input type="number" class="minicolors-opacity" data-callback="sectionRules"
                                min="0" max="1" step="0.01">
                                <span class="ba-tooltip ba-top"><?php echo JText::_('OPACITY') ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <i class="zmdi zmdi-more resize-handle-bottom"></i>
            </div>
        </div>
    </div>
</div>