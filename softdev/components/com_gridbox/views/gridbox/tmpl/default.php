<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
if (!empty($this->edit_type)) {
?>
<script type="text/javascript">
    themeData.edit_type = '<?php echo $this->edit_type; ?>';
</script>
<?php
}
include(JPATH_COMPONENT.'/views/system/gridbox.php');
?>
<div class="row-fluid">
    <div class="ba-edit-section row-fluid" id="ba-edit-section">
<?php
        echo stripcslashes($this->item->params);
?>
    </div>
<?php
if ($this->edit_type != 'blog') {
?>
    <div class="ba-add-section">
        <i class="zmdi zmdi-plus"></i>
        <span class="ba-tooltip add-section-tooltip">
            <?php echo JText::_('NEW_SECTION'); ?>
        </span>
    </div>
<?php
}
?>
</div>