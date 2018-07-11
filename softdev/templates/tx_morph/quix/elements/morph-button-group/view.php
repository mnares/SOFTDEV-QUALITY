<?php
$classes = classNames( "qx-element qx-element-{$type} {$field['class']}", $visibilityClasses, [
  "wow {$field['animation']}" => $field['animation']
] );
  // Animation delay
  $animation_delay = '';
  if ($field['animation'] and array_key_exists('animation_delay', $field)) {
    $animation_delay = 'data-wow-delay="' . $field['animation_delay'] . 's"';
  }
?>

<div id="<?php echo $id; ?>" class="<?php echo $classes ?>" <?php echo $animation_delay; ?>>
  <?php foreach($field['buttons'] as $i => $button):
    // New icon system. Since @1.7
    $icon = get_icon($button);
  ?>
    <a href="<?php echo $button['button']['url'] ?>" <?php echo ( $button['button']['target'] ) ? ' target="_blank"' : '' ?>
      class="qx-btn <?php echo $button['style']?> qx-btn-<?php echo $i?>">
      <?php if ( ( $button['icon'] ) AND ( $button['icon_placement'] == 'left' ) ): ?>
        <i class="<?php echo $icon['class']?>"><?php echo $icon['content']?></i>
      <?php endif; ?>
        <span class="btn-pre-text"><?php echo $button['button_pre_text'];?></span>
      <span class="btn-text"><?php echo $button['button']['text'] ?></span>
      <?php if ( ( $button['icon'] ) AND ( $button['icon_placement'] == 'right' ) ): ?>
        <i class="<?php echo $icon['class']?>"><?php echo $icon['content']?></i>
      <?php endif; ?>
    </a>
  <?php endforeach;?>
</div>
<!-- qx-element-button-group -->
