<?php
/**
 * @version    1.8.0
 * @package    com_quix
 * @author     ThemeXpert <info@themexpert.com>
 * @copyright  Copyright (C) 2015. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access

defined('_JEXEC') or die;
// Load jQUery
JHtml::_('jquery.framework');
// Load Bootstrap 3
JHtml::_('bootstrap.framework');
// Keep alive
JHtml::_('behavior.keepalive');

jimport( "quix.app.bootstrap" );
// jimport( "quix.app.init" )

// // Builder css
JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qxbs.css' );
JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qx-fb.css' );
JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qxui.css' );
JFactory::getDocument()->addStylesheet( QUIX_URL . '/assets/css/qxicon.css' );


// Load js 
JFactory::getDocument()->addScript( QUIX_URL . '/assets/js/cookies.js');
JFactory::getDocument()->addScript( QUIX_URL . '/assets/js/react-ace.js');
JFactory::getDocument()->addScript( JUri::root(true) . '/media/quix/assets/iframe.js');
JFactory::getDocument()->addScript( QUIX_URL . '/assets/js/jquery-ui.js');
// JFactory::getDocument()->addScript( "//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" );


// Summernote Editor
JFactory::getDocument()->addScript( QUIX_URL . '/assets/js/summernote.js' );

JFactory::getDocument()->addStyleDeclaration('
  .modal[aria-hidden="false"] {
    display: none;
  }
');


?>
<script>
setInterval(function() {
  var req = jQuery.ajax({type:"get",url:"index.php?option=com_quix&task=live"});
  req.done(function(){ /*console.log("Request successful!");*/ });
}, 1000 * 60 * 5);
jQuery(window).bind("load", function() { 
  jQuery(".preloader").fadeOut('slow');
});

window.FILE_MANAGER_ROOT_URL = "<?php echo JURI::root() . 'images' ?>"

</script>

<!-- Preloader -->
<div class="preloader">
  <div class="wrap">
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <p class="text">Loading...</p>
  </div>
</div>
<!-- Preloader -->

<div class="qx-fb-frame">

  <div id="qx-fb-frame-toolbar"></div>
  <div class="qx-fb-frame-preview" data-preview="desktop">
    <iframe
      src="<?php echo JUri::root() . 'index.php?option=com_quix&view=form&layout=iframe&builder=frontend&type='.$this->type.'&id=' . (int) $this->item->id; ?><?php echo (JFactory::getApplication()->input->get('output', 'html') == 'component' ? '&tmpl=component' : '' ); ?>" 
      frameborder="0"
      style="width:100%;height: 100vh;"
      name="quixframe"
      id="quix-iframe-wrapper">
    </iframe>
  </div>
  <form 
    action="<?php echo JRoute::_('index.php?option=com_quix&view='.$this->type.'&id=' . (int) $this->item->id); ?>"
    method="post" enctype="multipart/form-data" 
    name="adminForm" 
    id="adminForm" 
    class="qx-fb form-validate">
    <input type="hidden" name="jform[id]" id="jform_id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" id="jform_Itemid" value="<?php echo $this->Itemid;?>" />

    <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
    <input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
    <input type="hidden" id="jform_task" name="task" value="" />
    <input type="hidden" id="jform_type" name="type" value="<?php echo $this->type ?>" />
    <input type="hidden" id="jform_return" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_quix&view='.$this->type.'&id=' . (int) $this->item->id . ($this->Itemid ? '&Itemid=' . $this->Itemid : ''))); ?>" />
    
    <?php if(isset($this->item->type)): ?>
      <input type="hidden" id="jform_template_type" name="jform[type]" value="<?php echo $this->item->type ?>" />
    <?php endif; ?>

    <input type="hidden" id="jform_token" name="<?php echo JSession::getFormToken(); ?>" value="1" />

  </form>
</div>
