<?php
/**
* @package   gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$sortFields = $this->getSortFields();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$user = JFactory::getUser();
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
$editPage = JUri::root(). 'index.php?option=com_gridbox&view=editor&edit_type=system&name=';
$editPage .= urlencode($user->username).'&tmpl=component&id=';
?>

<script type="text/javascript" src="<?php echo JUri::root(true); ?>/media/system/js/calendar.js"></script>
<script type="text/javascript" src="<?php echo JUri::root(true); ?>/media/system/js/calendar-setup.js"></script>
<script type="text/javascript"><?php echo gridboxHelper::setCalendar(); ?></script>
<link rel="stylesheet" href="<?php echo JUri::root(true); ?>/media/system/css/calendar-jos.css">
<script src="<?php echo JUri::root(); ?>administrator/components/com_gridbox/assets/js/sortable.js" type="text/javascript"></script>
<script src="components/com_gridbox/assets/js/ba-admin.js?<?php echo $this->about->version; ?>" type="text/javascript"></script>
<script type="text/javascript">
    var str = "<div class='btn-wrapper' id='toolbar-settings' data-callback='showSystemSettings'>";
    str += "<button class='btn btn-small'><span class='icon-options'>";
    str += "</span><?php echo JText::_('SETTINGS') ?></button></div>";
    jQuery('#toolbar').append(str);
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
<form autocomplete="off" action="<?php echo JRoute::_('index.php?option=com_gridbox&view=system'); ?>" method="post" name="adminForm"
    id="adminForm">
    <div id="create-new-app-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-header">
            <h3 class="ba-modal-header"><?php echo JText::_('CREATE_AN_APP'); ?></h3>
        </div>
        <div class="modal-body">
            <input type="text" name="app_name" id="app-name" placeholder="<?php echo JText::_('ENTER_APP_NAME'); ?>">
            <span class="focus-underline"></span>
            <input type="hidden" name="app_type" id="app-type">
            <input type="hidden" name="ba_view" value="system">
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary create-app"><?php echo JText::_('JTOOLBAR_APPLY') ?></a>
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
    <div id="system-settings-dialog" class="ba-modal-sm modal hide" style="display: none;" aria-hidden="false">
        <div class="modal-header">
            <h3><?php echo JText::_('SETTINGS'); ?></h3>
        </div>
        <div class="modal-body">
            <input type="text" class="system-page-title" placeholder="<?php echo JText::_('JGLOBAL_TITLE'); ?>">
            <span class="focus-underline"></span>
            <div class="ba-custom-select system-page-theme-select visible-select-top">
                <input readonly value="" type="text">
                <input type="hidden" >
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
            <div class="ba-checkbox-parent">
                <label class="ba-checkbox ba-hide-checkbox">
                    <input type="checkbox" class="page-enable-header">
                    <span></span>
                </label>
                <label><?php echo JText::_('ENABLE_HEADER_FOOTER') ?></label>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary apply-system-settings"><?php echo JText::_('JTOOLBAR_APPLY') ?></a>
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
                    </div>
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
                                <?php echo JText::_('JGLOBAL_TITLE'); ?>
                            </div>
                            <div>
                                <?php echo JText::_('THEME'); ?>
                            </div>
                            <div>
                                <?php echo JText::_('ID'); ?>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <tbody class="<?php echo str_replace('_', '-', $listOrder); ?>-sorting">
<?php
                                foreach ($this->items as $i => $item) { 
                                    $str = json_encode($item);
?>
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
                                    <td class="title-cell">
                                        <a target="_blank"
                                           href="<?php echo $editPage.$item->id; ?>">
                                            <?php echo $item->title; ?>
                                            <input type="hidden" name="order[]" value="<?php echo $item->order_list; ?>">
                                        </a>
                                    </td>
                                    <td class="page-theme" data-theme="<?php echo $item->theme; ?>">
                                        <?php echo $item->themeName; ?>
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
                    <div>
                        <input type="hidden" name="context-item" value="" id="context-item" />
                        <input type="hidden" name="task" value="" />
                        <input type="hidden" name="boxchecked" value="0" />
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
    <span class="page-settings" data-callback="showSystemSettings">
        <i class="zmdi zmdi-settings"></i>
        <?php echo JText::_('SETTINGS'); ?>
    </span>
</div>
<?php include(JPATH_COMPONENT.'/views/layouts/context.php'); ?>
<?php include(JPATH_COMPONENT.'/views/layouts/photo-editor.php'); ?>