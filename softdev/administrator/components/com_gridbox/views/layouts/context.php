<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
?>
<div class="ba-context-menu add-context-menu" style="display: none">
    <span class="add-single-pages" data-type="single">
        <i class="zmdi zmdi-file"></i>
        <?php echo JText::_('SINGLE_PAGES'); ?>
    </span>
    <span class="add-blog" data-type="blog">
        <i class="zmdi zmdi-format-color-text"></i>
        <?php echo JText::_('BLOG'); ?>
    </span>
</div>
<div class="ba-context-menu help-context-menu" style="display: none">
    <span class="about-gridbox">
        <i class="zmdi zmdi-star"></i>
        <?php echo JText::_('ABOUT'); ?>
    </span>
    <span class="gridbox-languages">
        <i class="zmdi zmdi-globe"></i>
        <?php echo JText::_('LANGUAGES'); ?>
    </span>
    <span class="documentation">
        <a target="_blank" href="http://www.balbooa.com/gridbox-documentation/basics/key-features">
            <i class="zmdi zmdi-info"></i><?php echo JText::_('DOCUMENTATION'); ?>
        </a>
    </span>
    <span class="support">
        <a target="_blank" href="http://support.balbooa.com/forum/gridbox">
            <i class="zmdi zmdi-help"></i><?php echo JText::_('SUPPORT'); ?>
        </a>
    </span>
    <span class="love-gridbox ba-group-element">
        <i class="zmdi zmdi-favorite"></i><?php echo JText::_('LOVE_GRIDBOX'); ?>
    </span>
</div>
<div class="ba-context-menu options-context-menu" style="display: none">
    <span class="export-gridbox">
        <i class="zmdi zmdi-download"></i>
        <?php echo JText::_('EXPORT'); ?>
    </span>
    <span class="options">
        <a href="<?php echo $this->preferences(); ?>">
            <i class="zmdi zmdi-settings"></i><?php echo JText::_('OPTIONS'); ?>
        </a>
    </span>
</div>
<div id="languages-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <div class="languages-wrapper">

        </div>
    </div>
</div>
<input type="hidden" id="installing-const" value="<?php echo JText::_('INSTALLING'); ?>">