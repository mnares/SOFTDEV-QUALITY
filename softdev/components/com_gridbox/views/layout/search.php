<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

ob_start();
$result = 'item-'.$now++;
$obj->items->{$result} = gridboxHelper::getOptions('search-result');
$obj->items->{'item-'.$now} = gridboxHelper::getOptions('search');
?>
<div class="ba-item-search ba-item" id="item-<?php echo $now; ?>">
	<div class="ba-search-wrapper">
        <input type="text" placeholder="Search...">
        <i class="zmdi zmdi-search"></i>
    </div>
	<div class="ba-edit-item">
        <span class="ba-edit-wrapper edit-settings">
            <i class="zmdi zmdi-settings"></i>
            <span class="ba-tooltip tooltip-delay">
                <?php echo JText::_("ITEM"); ?>
            </span>
        </span>
        <div class="ba-buttons-wrapper">
            <span class="ba-edit-wrapper">
                <i class="zmdi zmdi-open-in-new open-search-results"></i>
                <span class="ba-tooltip tooltip-delay settings-tooltip">
                    <?php echo JText::_("OPEN"); ?>
                </span>
            </span>
            <span class="ba-edit-wrapper">
                <i class="zmdi zmdi-edit edit-item"></i>
                <span class="ba-tooltip tooltip-delay settings-tooltip">
                    <?php echo JText::_("EDIT"); ?>
                </span>
            </span>
            <span class="ba-edit-wrapper">
                <i class="zmdi zmdi-copy copy-item"></i>
                <span class="ba-tooltip tooltip-delay settings-tooltip">
                    <?php echo JText::_("COPY"); ?>
                </span>
            </span>
            <span class="ba-edit-wrapper">
                <i class="zmdi zmdi-globe add-library"></i>
                <span class="ba-tooltip tooltip-delay settings-tooltip">
                    <?php echo JText::_("ADD_TO_LIBRARY"); ?>
                </span>
            </span>
            <span class="ba-edit-wrapper">
                <i class="zmdi zmdi-delete delete-item"></i>
                <span class="ba-tooltip tooltip-delay settings-tooltip">
                    <?php echo JText::_("DELETE"); ?>
                </span>
            </span>
            <span class="ba-edit-text">
                <?php echo JText::_("ITEM"); ?>
            </span>
        </div>
    </div>
    <div class="ba-search-result-modal" data-id="item-<?php echo $now; ?>">
        <i class="zmdi zmdi-close"></i>
        <div class="ba-search-result-body ba-container">
            <h6 class="search-result-title">
                <?php echo JText::_('SEARCH_RESULTS_FOR'); ?>
            </h6>
            <div class="ba-item-search-result ba-item" id="<?php echo $result; ?>">
                <div class="ba-blog-posts-wrapper ba-grid-layout">
                    [ba_search_result]
                </div>
                [ba_search_result_paginator]
                <div class="ba-edit-item">
                    <span class="ba-edit-wrapper edit-settings">
                        <i class="zmdi zmdi-settings"></i>
                        <span class="ba-tooltip tooltip-delay">
                            <?php echo JText::_("ITEM"); ?>
                        </span>
                    </span>
                    <div class="ba-buttons-wrapper">
                        <span class="ba-edit-wrapper">
                            <i class="zmdi zmdi-edit edit-item"></i>
                            <span class="ba-tooltip tooltip-delay settings-tooltip">
                                <?php echo JText::_("EDIT"); ?>
                            </span>
                        </span>
                        <span class="ba-edit-text">
                            <?php echo JText::_("ITEM"); ?>
                        </span>
                    </div>
                </div>
                <div class="ba-box-model">
                </div>
            </div>
            <div class="ba-search-preloader">
                <img src="components/com_gridbox/assets/images/reload.svg">
            </div>
        </div>
    </div>
    <div class="ba-box-model">
        
    </div>
</div>
<?php
$out = ob_get_contents();
ob_end_clean();