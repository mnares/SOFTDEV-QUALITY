<?php 
###############
# Responsive #
##############

// Element
Css::margin("#$id", $field['margin']);
// Button Font
Css::typography("#$id .qx-btn .btn-text", $field['font']);
Css::typography("#$id .qx-btn span", $field['pre_font']);
// Icon
Css::margin("#$id .qx-btn i", $field['icon_margin']);
// Alignment
Css::alignment("#$id", $field['alignment']);

?>

#<?php echo $id?> .qx-btn i {
  transition: all .3s ease;
color: rgba(255, 255, 255, 1);
display: inline-block;
float: left;
font-size: <?php echo $field['icon_font_size']?>px;
}

#<?php echo $id?> .qx-btn span {
display: block;
text-align: left;
}
  
#<?php echo $id;?> .qx-btn + .qx-btn{ margin-left: <?php echo $field['button_spacing']?>px; }

<?php foreach($field['buttons'] as $i => $button):?>
  <?php if($button['custom_style']):?>
    <?php
      // Responsive
      Css::padding("#$id .qx-btn-$i", $button['padding']);
    ?>
    #<?php echo $id;?> .qx-btn-<?php echo $i?>{
      <?php Css::prop('color', $button['text_color']);?>
      <?php Css::prop('background', $button['bg_color']);?>

      <?php if($button['border']):?>
        border-width: <?php echo $button['border_width']?>px;
        <?php Css::prop('border-style', $button['border_style']);?>
        <?php Css::prop('border-color', $button['border_color']);?>
        <?php if($button['border_radius']):?>
        border-radius: <?php echo $button['border_radius']?>px;
        <?php endif;?>
      <?php endif;?>
    }  
    <?php if( $button['text_color_hover'] OR $button['bg_color_hover'] ):?>
      #<?php echo $id;?> .qx-btn-<?php echo $i?>:hover{
        <?php Css::prop('color', $button['text_color_hover']);?>
        <?php Css::prop('background', $button['bg_color_hover']);?>
      }
    <?php endif;?>
    <?php if($button['button_icon_color']):?>
      #<?php echo $id;?> .qx-btn-<?php echo $i?> i{
        <?php Css::prop('color', $button['button_icon_color']);?>
      }
    <?php endif;?>
    <?php if($button['button_icon_color_hover']):?>
      #<?php echo $id;?> .qx-btn-<?php echo $i?>:hover i{
        <?php Css::prop('color', $button['button_icon_color_hover']);?>
      }
    <?php endif;?>
  <?php endif;?>
<?php endforeach;?>