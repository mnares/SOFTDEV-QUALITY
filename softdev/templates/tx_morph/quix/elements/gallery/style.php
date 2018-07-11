<?php
###################################
# Responsive Fields
###################################
// Element
Css::margin("#$id", $field['margin']);
Css::padding("#$id", $field['padding']);

// Title
Css::typography("#$id .qx-fg-title", $field['title_font']);
Css::margin("#$id .qx-fg-title", $field['title_margin']);

// Content
Css::typography("#$id .qx-fg-content", $field['description_font']);

?>

#<?php echo $id?> .qx-g-items .qx-fg-item {margin-top: 30px;}
#<?php echo $id?> .qx-g-items .qx-fg-item img { max-width: 100%; }

#<?php echo $id?> .qx-fg-title {
	<?php Css::prop("color", $field['title_color'])?>
}
#<?php echo $id?> .qx-fg-content {
	<?php Css::prop("color", $field['description_color'])?>
}