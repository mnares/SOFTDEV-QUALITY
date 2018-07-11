<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$str = '<div class="ba-edit-section row-fluid" id="ba-edit-section">'.stripcslashes($this->item->params).'</div>';
$this->pageLayout = gridboxHelper::setBlogPageLayout($this->item, $this->pageLayout);
?>
<div class="row-fluid">
    <?php if (JFactory::getUser()->authorise('core.edit', 'com_gridbox')) { ?>
        <a class="edit-page-btn" target="_blank"
           href="<?php echo JUri::root().'index.php?option=com_gridbox&view=editor&tmpl=component&id='.$this->item->id; ?>">
           <i class="zmdi zmdi-settings"></i>
           <p class="edit-page"><?php echo JText::_('EDIT_PAGE'); ?></p>
        </a>
    <?php } ?>
    <div class="ba-gridbox-page row-fluid">
<?php
	    echo str_replace('[blog_content]', $str, $this->pageLayout);
?>
    </div>
</div>