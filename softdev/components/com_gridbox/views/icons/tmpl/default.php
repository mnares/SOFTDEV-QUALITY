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
<div class="general-tabs ba-icons-wrapper">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#outline-icons" data-toggle="tab">
                <i class="zmdi zmdi-texture"></i>
                Outline
            </a>
        </li>
        <li>
            <a href="#material-icons" data-toggle="tab">
                <i class="zmdi zmdi-android"></i>
                Material
            </a>
        </li>
        <li>
            <a href="#fontawesome-icons" data-toggle="tab">
                <i class="zmdi zmdi-flag"></i>
                Font Awesome
            </a>
        </li>
    </ul>
    <div class="tabs-underline"></div>
    <div class="toolbar-wrapper">
        <div class="search-wrapper">
            <input type="text" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>">
            <div class="ba-icon-search">
                <i class="zmdi zmdi-search"></i>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div id="outline-icons" class="row-fluid tab-pane active">
            <?php include_once 'outline.php'; ?>
        </div>
        <div id="material-icons" class="row-fluid tab-pane">
            <?php include_once 'material-icons.php'; ?>
        </div>
        <div id="fontawesome-icons" class="row-fluid tab-pane">
            <?php include_once 'fontawesome.php'; ?>
        </div>
    </div>
</div>