<?php
/**
 * @version    CVS: 1.0.0
 * @package    com_quix
 * @author     ThemeXpert <info@themexpert.com>
 * @copyright  Copyright (C) 2015. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;
JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
// JHtml::_('formbehavior.chosen', 'select');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
// Quix autoloader
jimport( 'quix.vendor.autoload' );
// Live Builder asset
loadLiveBuilderAssets();
// Joomla editor.js
JFactory::getDocument()->addScript( JUri::root(true) . '/media/quix/assets/editor.js');
?>
<?php
  // loading shape divider svg
  $svgFiles = [];

  $shapesPath = QUIX_PATH . "/assets/images/shapes";

  $files = JFolder::files($shapesPath);

  foreach($files as $file) {
    $key = str_replace(".svg", "", $file);
    
    $svgFiles[ $key ] = base64_encode( file_get_contents("$shapesPath/$file") );
  }

?>
<script>
  window.section = [];
  window.row = [];
  window.column = [];
  window.QUIX_URL = "<?php echo QUIX_URL ?>"
  window.QUIX_VERSION = "<?php echo QUIX_VERSION ?>"
  window.QUIX_SHAPES = '<?php echo json_encode($svgFiles) ?>'
  window.FILE_MANAGER_ROOT_URL = "<?php echo JURI::root() . 'images' ?>"
</script>
<div id="quix-templates-wrapper" style="display: none;">
<?php 
  $elements = quix()->getElements();
  $nodes = quix()->getNodes();

  foreach ($elements as $key => $element) {
    echo Quix()->getTemplateRenderer()->renderElementNode($element);
  }
  foreach ($nodes as $key => $node) {
      echo Quix()->getTemplateRenderer()->renderNodeNode($node);
  }
?>
</div>
<script>
window.PageChanged = false;
jQuery( document ).ready(function() {
  document.getElementById('adminForm').addEventListener('change', function(){
    window.PageChanged = true;
  });
});

window.addEventListener("beforeunload", function (e) { 
  if(window.PageChanged == true){
    var confirmationMessage = 'It looks like you have been editing something. ';
    confirmationMessage += 'If you leave before saving, your changes will be lost.';
    
    (e || window.event).returnValue = confirmationMessage; //Gecko + IE
    return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
  }else{
    return undefined;
  }
});
</script>
<form 
  action="<?php echo JRoute::_('index.php?option=com_quix&view=form&layout=edit&builder=frontend&tmpl=component&id=' . (int) $this->item->id); ?>"
  method="post" enctype="multipart/form-data" 
  name="adminForm" 
  id="adminForm" 
  class="qx-fb form-validate">

  <div class="app-mount">
    <div id='qx-fb-mount'></div>
    <?php echo $this->form->getInput('data'); ?>
  </div>
  
  <?php echo $this->loadTemplate('options'); ?>
  <?php echo $this->loadTemplate('seo'); ?>
  <?php echo $this->loadTemplate('menu'); ?>

  <input type="hidden" name="jform[id]" id="jform_id" value="<?php echo (int) $this->item->id; ?>" />
  <input type="hidden" name="jform[title]" id="jform_title_hidden" value="<?php echo $this->item->title; ?>" />
  <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
  <input type="hidden" id="jform_Itemid" value="<?php echo $this->Itemid;?>" />

  <?php if(empty($this->item->created_by)){ ?>
  <input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
  <?php } else{ ?>
  <input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
  <?php } ?>
  <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
  <input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
  <input type="hidden" id="jform_task" name="task" value="" />
  <input type="hidden" id="jform_type" name="type" value="<?php echo $this->type ?>" />
  <input type="hidden" id="return_url" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_quix&view='.$this->type.'&id=' . (int) $this->item->id . ($this->Itemid ? '&Itemid=' . $this->Itemid : ''))); ?>" />

  <?php if(isset($this->item->type)): ?>
    <input type="hidden" id="jform_template_type" name="jform[type]" value="<?php echo $this->item->type ?>" />
  <?php endif; ?>

  <input type="hidden" id="jform_token" name="<?php echo JSession::getFormToken(); ?>" value="1" />
</form>
<?php echo loadLiveBuilderReactScripts(); ?>
