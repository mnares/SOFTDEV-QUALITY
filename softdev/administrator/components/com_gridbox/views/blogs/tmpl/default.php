<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
$sortFields = $this->getSortFields();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$state = $this->state->get('filter.state');
$user = JFactory::getUser();
$create = $user->authorise('core.create', 'com_gridbox');
$limit = $this->pagination->limit;
$pagLimit = array(
    5 => 5,
    10 => 10,
    15 => 15,
    20 => 20,
    25 => 25,
    30 => 30,
    50 => 50,
    100 => 100,
    0 => JText::_('JALL'),
);
if (!isset($pagLimit[$limit])) {
    $limit = 0;
}
if ($listDirn == 'asc') {
    $dirn = JText::_('JGLOBAL_ORDER_ASCENDING');
} else {
    $listDirn = 'desc';
    $dirn = JText::_('JGLOBAL_ORDER_DESCENDING');
}
$order = $sortFields[$listOrder];
if ($state == '') {
    $status = JText::_('JSTATUS');
} else if ($state == '1') {
    $status = JText::_('JPUBLISHED');
} else if ($state == '0') {
    $status = JText::_('JUNPUBLISHED');
}
if (isset($_GET['category'])) {
    $url = JUri::root(). 'index.php?option=com_gridbox&view=editor&app_id=';
    $url .= $this->blog->id.'&name='.urlencode($user->username);
    $url .= '&category='.$this->category.'&tmpl=component&id=';
}
$catUrl = 'index.php?option=com_gridbox&view=blogs&id='.$this->blog->id.'&category=';
$editBlog = JUri::root(). 'index.php?option=com_gridbox&view=editor&edit_type=blog&name=';
$editBlog .= urlencode($user->username).'&tmpl=component&id='.$this->blog->id;
?>
<script type="text/javascript" src="<?php echo JUri::root(true); ?>/media/system/js/calendar.js"></script>
<script type="text/javascript" src="<?php echo JUri::root(true); ?>/media/system/js/calendar-setup.js"></script>
<script type="text/javascript"><?php echo gridboxHelper::setCalendar(); ?></script>
<link rel="stylesheet" href="<?php echo JUri::root(true); ?>/media/system/css/calendar-jos.css">
<script src="components/com_gridbox/assets/js/ba-admin.js?<?php echo $this->about->version; ?>" type="text/javascript"></script>
<script src="<?php echo JUri::root(); ?>administrator/components/com_gridbox/assets/js/sortable.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.4.7/full/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery('#toolbar-download, #toolbar-settings, #toolbar-delete').find('button').removeAttr('onclick');
    jQuery('#toolbar-settings span')[0].className = 'icon-options';
    jQuery('#toolbar-delete button').addClass('blog-delete');
</script>
<?php
include(JPATH_COMPONENT.'/views/layouts/notification.php');
include(JPATH_COMPONENT.'/views/layouts/update-message.php');
?>
<input type="hidden" value="<?php echo JText::_('JLIB_HTML_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST'); ?>" class="jlib-selection">
<input type="hidden" value="<?php echo JText::_('SUCCESS_UPLOAD'); ?>" id="upload-const">
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
<div id="uploader-modal" class="ba-modal-lg modal ba-modal-dialog hide" style="display:none" data-check="single">
    <div class="modal-body">
        <iframe src="javascript:''" name="uploader-iframe"></iframe>
        <input type="hidden" data-dismiss="modal">
    </div>
</div>
<div class="tour-parent">
    <div class="product-tour blogs-tour step-1">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('STEP_1'); ?></p>
            <p><?php echo JText::_('CREATE_NEW_CATEGORY'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour blogs-tour step-2">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('STEP_2'); ?></p>
            <p><?php echo JText::_('CREATE_NEW_PAGE'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour blogs-tour step-3">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('STEP_3'); ?></p>
            <p><?php echo JText::_('CONFIGURE_APP_LAYOUT'); ?></p>
            <a class="ba-btn close"><?php echo JText::_('CLOSE'); ?></a>
        </div>
    </div>
</div>
<div id="cke-image-modal" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3><?php echo JText::_('ADD_IMAGE'); ?></h3>
        <div>
            <input type="text" class="cke-upload-image" readonly placeholder="<?php echo JText::_('BROWSE_PICTURE'); ?>">
            <span class="focus-underline"></span>
            <i class="zmdi zmdi-camera"></i>
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
            <input type="text" class="cke-image-align" data-value="" readonly=""
                placeholder="<?php echo JText::_('ALIGNMENT'); ?>">
            <ul class="select-no-scroll">
                <li data-value=""><?php echo JText::_('NONE_SELECTED'); ?></li>
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
            <?php echo JText::_('JTOOLBAR_APPLY') ?>
        </a>
    </div>
</div>
<form action="<?php echo JUri::root().'administrator/index.php?option=com_gridbox&view=blogs&id='.$this->blog->id; ?>" method="post"
    name="adminForm" id="adminForm" autocomplete="off">
    <div id="create-new-app-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-header">
            <h3 class="ba-modal-header"><?php echo JText::_('CREATE_AN_APP'); ?></h3>
        </div>
        <div class="modal-body">
            <input type="text" name="app_name" id="app-name" placeholder="<?php echo JText::_('ENTER_APP_NAME'); ?>">
            <span class="focus-underline"></span>
            <input type="hidden" name="app_type" id="app-type">
            <input type="hidden" name="ba_view" value="blogs&id=<?php echo $this->blog->id; ?>">
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary create-app"><?php echo JText::_('JTOOLBAR_APPLY') ?></a>
        </div>
    </div>
    <div id="create-category-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('CREATE_CATEGORY'); ?></h3>
            <input type="text" class="category-name" name="category_name" placeholder="<?php echo JText::_('CATEGORY_NAME') ?>">
            <span class="focus-underline"></span>
            <input type="hidden" name="parent_id" class="parent-id">
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary" id="create-new-category">
                <?php echo JText::_('JTOOLBAR_APPLY') ?>
            </a>
        </div>
    </div>
    <div id="move-to-modal" class="ba-modal-md modal hide" style="display:none">
        <div class="modal-body">
            <div class="ba-modal-header">
                <h3><?php echo JText::_('MOVE_TO'); ?></h3>
                <i data-dismiss="modal" class="zmdi zmdi-close"></i>
            </div>
            <div class="availible-folders">
                <ul class="root-list">
                    
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary apply-move">
                <?php echo JText::_('JTOOLBAR_APPLY') ?>
            </a>
        </div>
    </div>
    <div id="settings-dialog" class="ba-modal-lg modal hide" style="display:none">
        <div class="modal-header">
            <span class="ba-dialog-title"><?php echo JText::_('SETTINGS'); ?></span>
            <div class="modal-header-icon">
                <i class="zmdi zmdi-check settings-apply"></i>
                <i class="zmdi zmdi-close" data-dismiss="modal"></i>
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
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JGLOBAL_TITLE'); ?>
                                </label>
                                <input type="hidden" name="ba_id" class="page-id">
                                <input type="text" name="page_title" class="page-title"
                                    placeholder="<?php echo JText::_('JGLOBAL_TITLE'); ?>">
                                <div class="ba-alert-container" style="display: none;">
                                    <i class="zmdi zmdi-alert-circle"></i>
                                    <span></span>
                                    <span class="ba-tooltip ba-top ba-hide-element">
                                        <?php echo JText::_('REQUIRED_FIELD'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>
                                </label>
                                <input type="text" name="page_alias" class="page-alias"
                                    placeholder="<?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>">
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('INTRO_TEXT'); ?>
                                </label>
                                <textarea placeholder="<?php echo JText::_('INTRO_TEXT'); ?>"
                                    name="intro_text" class="intro-text"></textarea>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('CATEGORY'); ?>
                                </label>
                                <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" type="text" value="">
                                <input type="hidden" id="page-category" name="page_category" value="">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($this->categoryList as $key => $category) {
                                        $str = '<li data-value="'.$category->id.'">';
                                        $str .= $category->title.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <div class="ba-tags">
                                    <label>
                                        <?php echo JText::_('TAGS'); ?>
                                    </label>
                                    <div class="meta-tags">
                                        <select style="display: none;" name="meta_tags[]" class="meta_tags" multiple></select>
                                        <ul class="picked-tags">
                                            <li class="search-tag">
                                                <input type="text" placeholder="<?php echo JText::_('TAGS'); ?>">
                                            </li>
                                        </ul>
                                        <ul class="all-tags">
                                            <?php foreach ($this->tags as $tag) {
                                                echo '<li data-id="'.$tag->id.'" style="display:none;">'.$tag->title.'</li>';
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
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_ACCESS_LABEL'); ?>
                                </label>
                                <div class="ba-custom-select access-select">
                                    <input readonly value="" type="text">
                                    <input type="hidden" name="access" id="access" value="">
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
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('JFIELD_ACCESS_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('START_PUBLISHING'); ?>
                                </label>
                                <div class="container-icon">
                                    <input type="text" name="published_on" id="published_on">
                                    <div class="icons-cell" id="calendar-button">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                    </div>
                                </div>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('START_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('END_PUBLISHING'); ?>
                                </label>
                                <div class="container-icon">
                                    <input type="text" name="published_down" id="published_down">
                                    <div class="icons-cell" id="calendar-down-button">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                    </div>
                                </div>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('END_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_LANGUAGE_LABEL'); ?>
                                </label>
                                <div class="ba-custom-select language-select visible-select-top">
                                    <input readonly value="" type="text">
                                    <input type="hidden" name="language" id="language" value="">
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
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('LANGUAGE_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('THEME'); ?>
                                </label>
                                <div class="ba-custom-select theme-select visible-select-top">
                                    <input readonly value="" type="text">
                                    <input type="hidden" name="theme_list" class="theme-list" value="">
                                    <ul>
                                        <?php
                                        foreach ($this->themes as $theme) {
                                            $str = '<li data-value="'.$theme->id.'">';
                                            $str .= $theme->title.'</li>';
                                            echo $str;
                                        }
                                        ?>
                                    </ul>
                                    <i class="zmdi zmdi-caret-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="media-options" class="row-fluid tab-pane">
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('IMAGE'); ?>
                                </label>
                                <input type="text" readonly class="intro-image select-intro-image" name="intro_image"
                                    placeholder="<?php echo JText::_('SELECT'); ?>">
                                <i class="zmdi zmdi-attachment-alt"></i>
                                <div class="reset disabled-reset reset-page-intro-image">
                                    <i class="zmdi zmdi-close"></i>
                                    <span class="ba-tooltip ba-hide-element ba-top">
                                        <?php echo JText::_('RESET'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="seo-options" class="row-fluid tab-pane">
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('BROWSER_PAGE_TITLE'); ?>
                                </label>
                                <input type="text" name="page_meta_title" class="page-meta-title"
                                    placeholder="<?php echo JText::_('BROWSER_PAGE_TITLE'); ?>">
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('BROWSER_PAGE_TITLE_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>
                                </label>
                                <textarea name="page_meta_description" class="page-meta-description"
                                    placeholder="<?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>"></textarea>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('JFIELD_META_DESCRIPTION_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_META_KEYWORDS_LABEL'); ?>
                                </label>
                                <textarea name="page_meta_keywords" class="page-meta-keywords"
                                    placeholder="<?php echo JText::_('JFIELD_META_KEYWORDS_LABEL'); ?>"></textarea>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
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
    <div id="category-settings-dialog" class="ba-modal-lg modal hide" style="display:none">
        <div class="modal-header">
            <span class="ba-dialog-title"><?php echo JText::_('SETTINGS'); ?></span>
            <div class="modal-header-icon">
                <i class="zmdi zmdi-check apply-blog-settings"></i>
                <i class="zmdi zmdi-check category-settings-apply"></i>
                <i class="zmdi zmdi-close" data-dismiss="modal"></i>
            </div>
        </div>
        <div class="modal-body">
            <div class="general-tabs">
                <ul class="nav nav-tabs uploader-nav">
                    <li class="active">
                        <a href="#category-general-options" data-toggle="tab">
                            <i class="zmdi zmdi-settings"></i>
                            <?php echo JText::_('GENERAL'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#category-media-options" data-toggle="tab">
                            <i class="zmdi zmdi-collection-image"></i>
                            <?php echo JText::_('MEDIA'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#category-seo-options" data-toggle="tab">
                            <i class="zmdi zmdi-globe"></i>
                            SEO
                        </a>
                    </li>
                </ul>
                <div class="tabs-underline"></div>
                <div class="tab-content">
                    <div id="category-general-options" class="row-fluid tab-pane active">
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JGLOBAL_TITLE'); ?>
                                </label>
                                <input type="text" name="category_title" class="category-title"
                                    placeholder="<?php echo JText::_('JGLOBAL_TITLE'); ?>">
                                    <input type="hidden" name="category-id" class="category-id">
                                    <input type="hidden" name="category_parent" class="category-parent">
                                <div class="ba-alert-container" style="display: none;">
                                    <i class="zmdi zmdi-alert-circle"></i>
                                    <span></span>
                                    <span class="ba-tooltip ba-top ba-hide-element">
                                        <?php echo JText::_('REQUIRED_FIELD'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>
                                </label>
                                <input type="text" name="category_alias" class="category-alias"
                                    placeholder="<?php echo JText::_('JFIELD_ALIAS_LABEL'); ?>">
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JTOOLBAR_PUBLISH'); ?>
                                </label>
                                <label class="ba-checkbox ba-hide-checkbox">
                                    <input type="checkbox" name="category_publish" class="category-publish" value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_ACCESS_LABEL'); ?>
                                </label>
                                <div class="ba-custom-select category-access-select">
                                    <input readonly value="" type="text">
                                    <input type="hidden" name="category_access" id="category-access" value="">
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
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('JFIELD_ACCESS_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_LANGUAGE_LABEL'); ?>
                                </label>
                                <div class="ba-custom-select category-language-select">
                                    <input readonly value="" type="text">
                                    <input type="hidden" name="category_language" id="category-language" value="">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <?php
                                        foreach ($this->languages as $key => $language) {
                                            $str = '<li data-value="'.$key.'">';
                                            $str .= $language.'</li>';
                                            echo $str;
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('LANGUAGE_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('THEME'); ?>
                                </label>
                                <div class="ba-custom-select blog-theme-select visible-select-top">
                                    <input readonly value="" type="text">
                                    <input type="hidden" name="blog_theme" class="blog-theme" value="">
                                    <ul>
                                        <?php
                                        foreach ($this->themes as $theme) {
                                            $str = '<li data-value="'.$theme->id.'">';
                                            $str .= $theme->title.'</li>';
                                            echo $str;
                                        }
                                        ?>
                                    </ul>
                                    <i class="zmdi zmdi-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <p class="ba-group-title"><?php echo JText::_('DESCRIPTION'); ?></p>
                        <div class="ba-options-group">
                            <div class="ba-group-element cke-editor-container">
                                <textarea class="category-descriprion" name="category_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="category-media-options" class="row-fluid tab-pane">
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('IMAGE'); ?>
                                </label>
                                <input type="text" readonly class="category-intro-image select-category-intro-image"
                                    name="category_intro_image" placeholder="<?php echo JText::_('SELECT'); ?>">
                                <i class="zmdi zmdi-attachment-alt"></i>
                                <div class="reset disabled-reset reset-category-intro-image">
                                    <i class="zmdi zmdi-close"></i>
                                    <span class="ba-tooltip ba-hide-element ba-top">
                                        <?php echo JText::_('RESET'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="category-seo-options" class="row-fluid tab-pane">
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('BROWSER_PAGE_TITLE'); ?>
                                </label>
                                <input type="text" name="category_meta_title" class="category-meta-title"
                                    placeholder="<?php echo JText::_('BROWSER_PAGE_TITLE'); ?>">
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('BROWSER_PAGE_TITLE_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>
                                </label>
                                <textarea name="category_meta_description" class="category-meta-description"
                                    placeholder="<?php echo JText::_('JFIELD_META_DESCRIPTION_LABEL'); ?>"></textarea>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
                                        <?php echo JText::_('JFIELD_META_DESCRIPTION_DESC'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <label>
                                    <?php echo JText::_('JFIELD_META_KEYWORDS_LABEL'); ?>
                                </label>
                                <textarea name="category_meta_keywords" class="category-meta-keywords"
                                    placeholder="<?php echo JText::_('JFIELD_META_KEYWORDS_LABEL'); ?>"></textarea>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help ba-hide-element">
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
                        <div class="pagination-limit">
                            <div class="ba-custom-select">
                                <input readonly value="<?php echo $pagLimit[$limit]; ?>" type="text">
                                <input type="hidden" name="limit" id="limit" value="<?php echo $limit; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($pagLimit as $key => $lim) {
                                        $str = '<li data-value="'.$key.'">';
                                        if ($key == $limit) {
                                            $str .= '<i class="zmdi zmdi-check"></i>';
                                        }
                                        $str .= $lim.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="sorting-direction">
                            <div class="ba-custom-select">
                                <input readonly value="<?php echo $dirn; ?>" type="text">
                                <input type="hidden" name="directionTable" id="directionTable" value="<?php echo $listDirn; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="asc" >
                                        <?php echo $listDirn == 'asc' ? '<i class="zmdi zmdi-check"></i>' : ''; ?>
                                        <?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?>
                                    </li>
                                    <li data-value="desc">
                                        <?php echo $listDirn == 'desc' ? '<i class="zmdi zmdi-check"></i>' : ''; ?>
                                        <?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sorting-table">
                            <div class="ba-custom-select">
                                <input readonly value="<?php echo $order; ?>" type="text">
                                <input type="hidden" name="sortTable" id="sortTable" value="<?php echo $listOrder; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                    foreach ($sortFields as $key => $field) {
                                        $str = '<li data-value="'.$key.'">';
                                        if ($key == $listOrder) {
                                            $str .= '<i class="zmdi zmdi-check"></i>';
                                        }
                                        $str .= $field.'</li>';
                                        echo $str;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-state">
                            <div class="ba-custom-select">
                                <input readonly value="<?php echo $status; ?>" type="text">
                                <input type="hidden" name="filter_state" value="<?php echo $state; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="">
                                        <?php echo $state == '' ? '<i class="zmdi zmdi-check"></i>' : ''; ?>
                                        <?php echo JText::_('JSTATUS');?>
                                    </li>
                                    <li data-value="1" >
                                        <?php echo $state == '1' ? '<i class="zmdi zmdi-check"></i>' : ''; ?>
                                        <?php echo JText::_('JPUBLISHED');?>
                                    </li>
                                    <li data-value="0">
                                        <?php echo $listDirn == '0' ? '<i class="zmdi zmdi-check"></i>' : ''; ?>
                                        <?php echo JText::_('JUNPUBLISHED');?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="blog-header">
                            <span class="blog-title"><?php echo $this->blog->title; ?></span>
                            <span class="blog-icons">
                                <span>
                                    <i class="zmdi zmdi-settings blog-settings"></i>
                                    <span class="ba-tooltip ba-bottom ba-hide-element"><?php echo JText::_('SETTINGS'); ?></span>
                                </span>
                                <span>
                                    <a href="<?php echo $editBlog; ?>" target="_blank">
                                        <i class="zmdi zmdi-desktop-windows"></i>
                                    </a>
                                    <span class="ba-tooltip ba-bottom ba-hide-element"><?php echo JText::_('LAYOUT_EDITING'); ?></span>
                                </span>
                                <span>
                                    <i class="zmdi zmdi-copy app-duplicate"></i>
                                    <span class="ba-tooltip ba-bottom ba-hide-element"><?php echo JText::_('JTOOLBAR_DUPLICATE'); ?></span>
                                </span>
                            </span>
                        </div>
                        <div class="category-list">
                            <a class="create-categery" href="#">
                                + <?php echo JText::_('CATEGORY'); ?>
                            </a>
                            <ul class="root-list">
                                <li class="root <?php echo $this->root; ?>">
                                    <a href="index.php?option=com_gridbox&view=blogs&id=<?php echo $this->blog->id; ?>">
                                        <label>
                                            <i class="zmdi zmdi-folder"></i>
                                        </label>
                                        <span><?php echo JText::_('ROOT'); ?></span>
                                    </a>
                                    <?php echo $this->drawCategoryList($this->categories); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="span9 blog-layout">
                        <?php if ($this->count > 0) { ?>
                        <div class="main-table pages-list">
                            <div class="table-header">
                                <div>
                                    <label class="ba-hide-checkbox">
                                        <input type="checkbox" name="checkall-toggle" value=""
                                               title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                                        <i class="zmdi zmdi-check-circle check-all"></i>
                                    </label>
                                </div>
                                <div>
                                     <?php echo JText::_('JSTATUS'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('JGLOBAL_TITLE'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('CATEGORY'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('DATE'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('THEME'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('JFIELD_ACCESS_LABEL'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('JGLOBAL_HITS'); ?>
                                </div>
                                <div>
                                    <?php echo JText::_('ID'); ?>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <tbody class="<?php echo isset($_GET['category']) ? str_replace('_', '-', $listOrder) : 'root'; ?>-sorting">
                                   <?php foreach ($this->items as $i => $item) { 
                                            $str = json_encode($item);
                                            $timestamp = strtotime($item->created);
                                            $date = date('Y-m-d', $timestamp);
                                            $canChange = $user->authorise('core.edit.state', 'com_gridbox'); ?>
                                    <tr>
                                        <td class="select-td">
                                            <label class="ba-hide-checkbox">
                                                <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                                                <i class="zmdi zmdi-circle-o ba-icon-md"></i>
                                                <i class="zmdi zmdi-check ba-icon-md"></i>
                                            </label>
                                            <input type="hidden"
                                                   value='<?php echo htmlspecialchars($str, ENT_QUOTES); ?>'>
                                        </td>
                                        <td class="status-td">
                                            <?php echo JHtml::_('gridboxhtml.jgrid.published', $item->published, $i, 'blogs.', $canChange); ?>
                                        </td>
                                        <td class="title-cell">
                                            <a target="_blank"
                                               href="<?php echo JRoute::_('index.php?option=com_gridbox&task=gridbox.edit&id='. $item->id); ?>">
                                                <?php echo $item->title; ?>
                                                <input type="hidden" name="order[]" value="<?php echo $item->order_list; ?>">
                                            </a>
                                        </td>
                                        <td class="category-cell">
                                            <?php echo $item->category; ?>
                                        </td>
                                        <td class="date-cell">
                                            <?php echo $date; ?>
                                        </td>
                                        <td class="page-theme" data-theme="<?php echo $item->theme; ?>">
                                            <?php echo $item->themeName; ?>
                                        </td>
                                        <td class="access-cell">
                                            <?php
                                                echo $this->access[$item->page_access];
                                            ?>
                                        </td>
                                        <td class="hits-cell">
                                            <?php echo $item->hits; ?>
                                        </td>
                                        <td>
                                            <?php echo $item->id; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo $this->pagination->getListFooter(); ?>
                        <?php
                        }
                        if ($create && isset($_GET['category'])) { ?>
                        <div class="ba-create-item">
                            <a href="<?php echo $url; ?>" target="_blank">
                                <i class="zmdi zmdi-file"></i>
                            </a>
                            <span class="ba-tooltip ba-top ba-hide-element align-center">
                                <?php echo JText::_('ADD_NEW_ITEM'); ?>
                            </span>
                        </div>
                        <?php } 
                        if ($create && !isset($_GET['category'])) { ?>
                        <div class="ba-create-item ba-uncategorised">
                            <a href="#" onclick="return false;">
                                <i class="zmdi zmdi-file"></i>
                            </a>
                            <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('ADD_NEW_ITEM'); ?></span>
                        </div>
                        <?php } ?>
                    </div>
                    <div>
                        <input type="hidden" name="context-item" value="" id="context-item" />
                        <input type="hidden" name="blog" value="<?php echo $this->blog->id; ?>" />
                        <input type="hidden" name="task" value="" />
                        <input type="hidden" value='<?php echo htmlspecialchars(json_encode($this->blog), ENT_QUOTES); ?>' id="blog-data">
                        <input type="hidden" name="boxchecked" value="0" />
                        <input type="hidden" name="ba_category" value="<?php echo $this->category; ?>">
                        <input type="hidden" name="category_order_list" value="1">
                        <input type="hidden" name="app_order_list" value="1">
                        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
                        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
                        <?php echo JHtml::_('form.token'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="ba-context-menu page-context-menu" style="display: none">
    <span class="page-settings"><i class="zmdi zmdi-settings"></i><?php echo JText::_('SETTINGS'); ?></span>
    <span class="blog-duplicate"><i class="zmdi zmdi-copy"></i><?php echo JText::_('DUPLICATE'); ?></span>
    <span class="page-move"><i class="zmdi zmdi-forward"></i><?php echo JText::_('MOVE_TO'); ?>...</span>
    <span class="blog-trash ba-group-element"><i class="zmdi zmdi-delete"></i><?php echo JText::_('TRASH'); ?></span>
</div>
<div class="ba-context-menu category-context-menu" style="display: none">
    <span class="category-settings"><i class="zmdi zmdi-settings"></i><?php echo JText::_('SETTINGS'); ?></span>
    <span class="category-duplicate"><i class="zmdi zmdi-copy"></i><?php echo JText::_('DUPLICATE'); ?></span>
    <span class="category-move"><i class="zmdi zmdi-forward"></i><?php echo JText::_('MOVE_TO'); ?>...</span>
    <span class="category-delete ba-group-element"><i class="zmdi zmdi-delete"></i><?php echo JText::_('DELETE'); ?></span>
</div>
<?php include(JPATH_COMPONENT.'/views/layouts/context.php'); ?>
<?php include(JPATH_COMPONENT.'/views/layouts/photo-editor.php'); ?>