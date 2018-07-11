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
if ($listOrder == 'app_id') {
    $order = JText::_('APP');
} else if ($listOrder == 'title') {
    $order = JText::_('JGLOBAL_TITLE');
} else if ($listOrder == 'theme') {
    $order = JText::_('THEME');
} else if ($listOrder == 'hits') {
    $order = JText::_('JGLOBAL_HITS');
} else {
    $order = JText::_('JGRID_HEADING_ID');
}
?>
<script src="<?php echo JUri::root(); ?>components/com_gridbox/libraries/sortable/sortable.js" type="text/javascript"></script>
<script src="components/com_gridbox/assets/js/ba-admin.js?<?php echo $this->about->version; ?>" type="text/javascript"></script>
<script type="text/javascript">
    Joomla.orderTable = function() {
        table = document.getElementById("sortTable");
        direction = document.getElementById("directionTable");
        order = table.value;
        if (order != '<?php echo $listOrder; ?>') {
            dirn = 'asc';
        } else {
            dirn = direction.value;
        }
        Joomla.tableOrdering(order, dirn, '');
    }    
</script>
<?php
include(JPATH_COMPONENT.'/views/layouts/notification.php');
include(JPATH_COMPONENT.'/views/layouts/update-message.php');
?>
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
<div id="about-dialog" class="ba-modal-md modal hide" style="display:none">
    <div class="modal-header">
        <a class="zmdi zmdi-close" data-dismiss="modal"></a>
        <h3><?php echo JText::_('ABOUT') ?></h3>
    </div>
    <div class="modal-body">
        <div id="form-about">
            <div class="about-element">
                <label><?php echo JText::_('WEBSITE') ?>:</label>
                <a target="_blank" href="<?php echo $this->about->authorUrl; ?>">www.balbooa.com</a>
            </div>
            <div class="about-element">
                <label><?php echo JText::_('LICENSE') ?>:</label>
                GNU Public License version 2.0.
            </div>
            <div class="about-element">
                <label><?php echo JText::_('COPYRIGHT') ?>:</label>
                © 2016 Balbooa All Rights Reserved.
            </div>
            <div class="about-element">
                <label><?php echo JText::_('EMAIL') ?>:</label>
                <?php echo $this->about->authorEmail; ?>
            </div>
            <div class="about-element">
                <label><?php echo JText::_('VERSION') ?>:</label>
                <span class="update"><?php echo $this->about->version; ?></span>
            </div>
        </div>
    </div>
</div>
<form autocomplete="off" action="<?php echo JRoute::_('index.php?option=com_gridbox&view=trashed'); ?>"
    method="post" name="adminForm" id="adminForm">
    <div id="create-new-app-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-header">
            <h3 class="ba-modal-header"><?php echo JText::_('CREATE_AN_APP'); ?></h3>
        </div>
        <div class="modal-body">
            <input type="text" name="app_name" id="app-name" placeholder="<?php echo JText::_('ENTER_APP_NAME'); ?>">
            <span class="focus-underline"></span>
            <input type="hidden" name="app_type" id="app-type">
            <input type="hidden" name="ba_view" value="trashed">
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
                    <li></li>
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
                    <?php if (count($this->items) != 0) { ?>
                    <div class="main-table trashed-list">
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
                                <?php echo JText::_('APP'); ?>
                            </div>
                            <div>
                                <?php echo JText::_('THEME'); ?>
                            </div>
                            <div>
                                <?php echo JText::_('JGLOBAL_HITS'); ?>
                            </div>
                            <div>
                                <?php echo JText::_('ID'); ?>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <tbody>
                               <?php foreach ($this->items as $i => $item) { 
                                        $str = json_encode($item);
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
                                    <td class="title-cell">
                                        <a target="_blank"
                                           href="<?php echo JRoute::_('index.php?option=com_gridbox&task=gridbox.edit&id='. $item->id); ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    </td>
                                    <td class="app-cell">
                                        <?php
                                            echo $item->app_name;
                                        ?>
                                    </td>
                                    <td class="page-theme" data-theme="<?php echo $item->theme; ?>">
                                        <?php echo $item->themeName; ?>
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
                    <?php 
                    echo $this->pagination->getListFooter();
                    } else { ?>
                    <div class="empty-list">
                        <i class="zmdi zmdi-alert-polygon"></i>
                        <p><?php echo JText::_('NO_ITEMS_HERE'); ?></p>
                    </div>
                    <?php
                    }
                    ?>
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
    <span class="trashed-restore">
        <i class="zmdi zmdi-time-restore"></i>
        <?php echo JText::_('RESTORE'); ?>
    </span>
    <span class="trashed-delete ba-group-element">
        <i class="zmdi zmdi-delete"></i>
        <?php echo JText::_('DELETE'); ?>
    </span>
</div>
<?php include(JPATH_COMPONENT.'/views/layouts/context.php'); ?>