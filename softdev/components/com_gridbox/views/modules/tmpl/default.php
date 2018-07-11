<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$search = '';
$ordering = 'id';
$direction = 'desc';
$type = '';
$position = '';
if (isset($_COOKIE["modules_type"])) {
    $type = $_COOKIE["modules_type"];
}
if (isset($_COOKIE["modules_position"])) {
    $position = $_COOKIE["modules_position"];
}
if (isset($_COOKIE["modules_search"])) {
    $search = $_COOKIE["modules_search"];
}
if (isset($_COOKIE["modules_ordering"])) {
    $ordering = $_COOKIE["modules_ordering"];
}
if (isset($_COOKIE["modules_direction"])) {
    $direction = $_COOKIE["modules_direction"];
}
$directTitle = array('desc' => JText::_('DESCENDING'), 'asc' => JText::_('ASCENDING'));
$orderTitle = array('title' => JText::_('TITLE'), 'id' => 'ID', 'module' => JText::_('TYPE'), 'position' => JText::_('POSITION'));
?>
<script type="text/javascript">
    jQuery(window).on('keydown', function(event){
        window.parent.$g(window.parent).trigger(event);
    });
</script>
<link rel="stylesheet" href="components/com_gridbox/assets/css/ba-style.css" type="text/css"/>
<div id="ba-media-manager" class="modules ba-integration-plugin" data-type="modules">
    <form  target="form-target" action=""
        method="post" autocomplete="off" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
        <div class ="row-fluid">
            <div class="row-fluid ba-media-header">
                <div class="span12">
                    <span class="ba-dialog-title"><?php echo JText::_('JOOMLA_MODULES'); ?></span>
                    <i class="zmdi zmdi-fullscreen media-fullscrean"></i>
                    <i class="close-media zmdi zmdi-close"></i>
                </div>
                <div class="span12">
                    <div id="filter-bar">
                        <input type="text" data-pages="search" value="<?php echo $search; ?>"
                            placeholder="<?php echo JText::_('JSEARCH_FILTER') ?>">
                        <i class="zmdi zmdi-search"></i>
                        <div class="sorting-direction">
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" value="<?php echo $directTitle[$direction]; ?>"
                                    size="<?php echo strlen($directTitle[$direction]); ?>" type="text">
                                <input type="hidden" data-pages="direction" value="<?php echo $direction; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="asc">
                                        <?php echo JText::_('ASCENDING')?>
                                    </li>
                                    <li data-value="desc">
                                        <?php echo JText::_('DESCENDING')?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sorting-table">
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" value="<?php echo $orderTitle[$ordering]; ?>"
                                    size="<?php echo strlen($orderTitle[$ordering]); ?>" type="text">
                                <input type="hidden" data-pages="ordering" value="<?php echo $ordering; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="title"><?php echo JText::_('TITLE'); ?></li>
                                    <li data-value="module"><?php echo JText::_('TYPE'); ?></li>
                                    <li data-value="position"><?php echo JText::_('POSITION'); ?></li>
                                    <li data-value="id">ID</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sorting-position">
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" value="<?php echo $this->positions[$position]; ?>"
                                    size="<?php echo strlen($this->positions[$position]); ?>" type="text">
                                <input type="hidden" data-pages="position" value="<?php echo $position; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <?php
                                foreach ($this->positions as $key => $position) {
?>
                                    <li data-value="<?php echo $key ?>">
                                        <?php echo $position; ?>
                                    </li>
<?php
                                }
?>
                                </ul>
                            </div>
                        </div>
                        <div class="sorting-type">
                            <div class="ba-custom-select">
                                <input readonly onfocus="this.blur()" value="<?php echo $this->types[$type]; ?>"
                                    size="<?php echo strlen($this->types[$type]); ?>" type="text">
                                <input type="hidden" data-pages="type" value="<?php echo $type; ?>">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
<?php
                                foreach ($this->types as $key => $type) {
?>
                                    <li data-value="<?php echo $key ?>">
                                        <?php echo $type; ?>
                                    </li>
<?php
                                }
?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fonts-table">
                <div class="ba-group-wrapper">
                    <p class="ba-group-title">
                        <span class="title"><?php echo JText::_('TITLE'); ?></span>
                        <span class="type"><?php echo JText::_('TYPE'); ?></span>
                        <span class="position"><?php echo JText::_('POSITION'); ?></span>
                        <span class="id">ID</span>
                    </p>
<?php
                foreach ($this->items as $item) {
?>
                    <div class="ba-options-group">
                        <div class="ba-group-element">
                            <label class="element-title">
                                <span data-id="<?php echo $item->id; ?>">
                                    <?php echo $item->title; ?>
                                </span>
                            </label>
                            <label class="element-type">
                                <?php echo $item->module; ?>
                            </label>
                            <label class="element-position">
                                <?php echo $item->position; ?>
                            </label>
                            <label class="element-id">
                                <?php echo $item->id; ?>
                            </label>
                        </div>
                    </div>
<?php
                }
?>
                </div>
            </div>
        </div>
    </form>
</div>