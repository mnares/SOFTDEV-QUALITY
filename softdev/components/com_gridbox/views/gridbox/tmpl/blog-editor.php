<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
include(JPATH_COMPONENT.'/views/system/gridbox.php');
?>
<div class="row-fluid">
    <div class="ba-edit-section row-fluid" id="ba-edit-section">
<?php
        echo stripcslashes($this->item->params);
?>
    </div>
</div>