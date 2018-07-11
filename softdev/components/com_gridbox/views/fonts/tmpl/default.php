<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

?>
<script type="text/javascript">
    jQuery(window).on('keydown', function(event){
        window.parent.$g(window.parent).trigger(event);
    });
</script>
<div id="add-google-font-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <div>
            <h3 class="ba-modal-title"><?php echo JText::_('ADD_GOOGLE_FONTS'); ?></h3>
            <span class="refresh-fonts">
                <i class="zmdi zmdi-refresh"></i>
                <span class="ba-tooltip ba-top">
                    <?php echo JText::_('REFRESH_FONT_LIST'); ?>
                </span>
            </span>
        </div>
        <div class="ba-custom-select fonts-select">
            <ul>
<?php
                echo gridboxHelper::createFontString($this->googleFont);
?>
            </ul>
            <input placeholder="<?php echo JText::_('FONT_FAMILY'); ?>" type="text" class="font-search reset-input-margin">
            <input type="hidden" value="" id="font-family">
            <i class="zmdi zmdi-caret-down"></i>
            <i class="zmdi zmdi-search"></i>
        </div>
        <div class="ba-custom-select fonts-style-select">
            <input readonly onfocus="this.blur()" placeholder="<?php echo JText::_('FONT_WEIGHT'); ?>" type="text">
            <input type="hidden" value="" id="font-style">
            <i class="zmdi zmdi-caret-down"></i>
            <ul>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
        <a href="#" class="ba-btn-primary install-font disable-button"><?php echo JText::_('SAVE') ?></a>
    </div>
</div>
<div id="add-custom-font-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <div>
            <h3 class="ba-modal-title"><?php echo JText::_('UPLOAD_CUSTOM_FONTS'); ?></h3>
            <label class="ba-help-icon">
                <i class="zmdi zmdi-help"></i>
                <span class="ba-tooltip ba-help">
                    <?php echo JText::_('CUSTOM_FONTS_TOOLTIP'); ?>
                </span>
            </label>
        </div>
        <div class="ba-input-lg">
            <input type="text" class="custom-font-title reset-input-margin" placeholder="<?php echo JText::_('TITLE'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-input-lg">
            <input type="text" class="custom-font-select reset-input-margin" readonly="" onfocus="this.blur()"
                placeholder="<?php echo JText::_('SELECT_FONT_FILE'); ?>">
            <i class="zmdi zmdi-attachment-alt"></i>
        </div>
        <div class="ba-custom-select custom-fonts-style-select visible-select-top">
            <input readonly onfocus="this.blur()" placeholder="<?php echo JText::_('FONT_WEIGHT'); ?>" type="text">
            <input type="hidden" value="" class="custom-font-style">
            <i class="zmdi zmdi-caret-down"></i>
            <ul>
                <li data-value="100">100 Thin</li>
                <li data-value="200">200 Extra-Light</li>
                <li data-value="300">300 Light</li>
                <li data-value="400">400 Regular</li>
                <li data-value="500">500 Medium</li>
                <li data-value="600">600 Semi-Bold</li>
                <li data-value="700">700 Bold</li>
                <li data-value="800">800 Extra-Bold</li>
                <li data-value="900">900 Black</li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
        <a href="#" class="ba-btn-primary install-custom-font disable-button"><?php echo JText::_('SAVE') ?></a>
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
<div class="fonts-layout">
    <div class="fonts-toolbar">
        <input type="text" class="filter-search" placeholder="<?php echo JText::_('JSEARCH_FILTER') ?>">
        <i class="zmdi zmdi-search"></i>
        <div class="new-font-wrapper">
            <a href="#" class="add-new-font">
                <i class="zmdi zmdi-collection-text"></i>
                <span class="ba-tooltip ba-bottom"><?php echo JText::_('ADD_GOOGLE_FONTS') ?></span>
            </a>
            <a href="#" class="add-custom-font">
                <i class="zmdi zmdi-cloud-upload"></i>
                <span class="ba-tooltip ba-bottom"><?php echo JText::_('UPLOAD_CUSTOM_FONTS') ?></span>
            </a>
            <a href="#" class="delete-fonts disable-button">
                <i class="zmdi zmdi-delete"></i>
                <span class="ba-tooltip ba-bottom"><?php echo JText::_('DELETE') ?></span>
            </a>
        </div>
    </div>
    <div class="fonts-table">
        <div id="fonts-list">
        <style type="text/css"><?php echo $this->customStr; ?></style>
<?php
        foreach ($this->item as $font => $item) {
            ksort($item);
?>
            <div class="ba-options-group" data-font="<?php echo str_replace('+', ' ', $font); ?>">
                <p class="ba-group-title">
                <?php echo str_replace('+', ' ', $font); ?>
                </p>
<?php
            foreach ($item as $key => $obj) {
                $id = $obj->id;
                $weight = str_replace('i', '', $obj->styles);
                if (strpos($obj->styles, 'i') !== false) {
                    $style = 'italic';
                } else {
                    $style = 'normal';
                }
?>
                <div class="ba-group-element">
                    <div class="font-style">
                        <?php echo $weight; ?>
                    </div>
                    <div contenteditable="true" class="font-preview-text"
                        style="font-family: '<?php echo str_replace('+', ' ', $font); ?>';
                        font-weight: <?php echo $weight; ?>;
                        font-style: <?php echo $style; ?>;">
                        Quality is Much Better Than Quantity
                    </div>
                    <label class="font-checkbox">
                        <input type="checkbox" value="<?php echo $id; ?>" >
                        <i class="zmdi zmdi-circle-o"></i>
                        <i class="zmdi zmdi-check"></i>
                    </label>
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
<form name="custom_fonts" style="display: none;">
    <input type="file" class="custom-fonts-files" name="custom-files">
</form>