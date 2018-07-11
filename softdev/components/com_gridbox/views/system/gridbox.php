<link rel="stylesheet" href="<?php echo JURI::root(). 'components/com_gridbox/libraries/animation/css/animate.css';?>" type="text/css" />
<script type="text/javascript" src="<?php echo JURI::root(). 'components/com_gridbox/libraries/sortable/sortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::root(). 'components/com_gridbox/libraries/columnResizer/columnResizer.js';?>"></script>
<?php
if (empty($this->layout)) {
?>
<script type="text/javascript" src="<?php echo JURI::root(). 'components/com_gridbox/assets/js/ba-grid.js'; ?>"></script>
<?php
} else {
?>
<script type="text/javascript" src="<?php echo JURI::root(). 'components/com_gridbox/assets/js/ba-blog-editor.js'; ?>"></script>
<?php
}
?>
<div id="global-css-sheets">
    <style type="text/css"></style>
</div>
<div id="custom-css-editor">
    <style type="text/css"><?php echo $this->custom->code; ?></style>
</div>
<textarea id="code-css-value" style="display:none;"><?php echo $this->custom->code; ?></textarea>
<textarea id="code-js-value" style="display:none;"><?php echo $this->custom->js; ?></textarea>
<div class="notification-backdrop">
    <div class="ba-notification-message">
        <h4><?php echo JText::_('SELECT_END_POINT'); ?></h4>
        <p><?php echo JText::_('CLICK_TO_SELECT_END_POINT'); ?></p>
    </div>
    <div class="notification-placeholder"></div>
</div>
<div id="library-backdrop"></div>
<div id="library-placeholder" style="display: none;"><div></div></div>
<form method="post" id="ba-grid-form" enctype="multipart/form-data" data-emailprotector="{emailprotector=off}"
      action="<?php echo JUri::base() ?>index.php?option=com_gridbox&task=gridbox.save">
    <input type="hidden" name="grid_id" id="grid_id" value="<?php echo $this->item->id ?>">
    <input type="hidden" name="page_theme" id="page_theme" value="<?php echo $this->item->theme; ?>">
</form>