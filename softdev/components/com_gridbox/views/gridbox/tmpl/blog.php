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
include(JPATH_COMPONENT.'/views/system/gridbox.php');
?>
<div id="blog-layout" class="row-fluid">
<?php
    echo str_replace('[blog_content]', $str, $this->pageLayout);
?>
</div>
<div class="ba-edit-blog-post">
    <i class="zmdi zmdi-edit"></i>
    <span class="ba-tooltip add-section-tooltip">
        <?php echo JText::_('EDIT_BLOG_POST'); ?>
    </span>
</div>