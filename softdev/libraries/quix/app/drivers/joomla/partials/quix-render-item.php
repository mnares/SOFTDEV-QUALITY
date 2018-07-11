<?php

/**
 * getting user agent from mobil detector
 */
function getUserAgent() {
  $device = new Mobile_Detect();
  $UserAgent = $device->getUserAgent();
  $UserAgent = explode("(", $UserAgent);
  $UserAgent = explode(";", $UserAgent[1]);
  $UserAgent = str_replace(" ", "_", strtolower(trim($UserAgent[0])));
  
  return str_replace(".", "_", $UserAgent);
}

/**
 * Quix render item
 */
function quixRenderItem( $item ) {

  JPluginHelper::importPlugin('content');

  // user agent
  $UserAgent = getUserAgent();

  // getting data from item 
  // else setting default data
  if(isset($item->data))
  {
    $data = $item->data;
  }
  else
  {
    $data = $item;

    $item = new stdClass();
    $item->id   = 0;
    $item->type = 'section';
    $item->builder = 'classic';
  }

  // type
  $type = property_exists($item, 'type')? $item->type : "";

  // set builder type ( frontend or classic )
  quix()->getEngineTracker()->set($item->id, $type, $item->builder);
  global $QuixBuilderType;
  $QuixBuilderType = $item->builder;
  
  $currentTime = JFactory::getDate()->Format('%Y-%m-%d - %H:%M');
  $pageModifiedTimeStamp = (isset($item->modified) ? $item->modified : $currentTime);
  $type = (isset($item->type) ? $item->type : 'section');

  $app = \JFactory::getApplication();
  $document = \JFactory::getDocument();

  if(is_string($data)) $data = json_decode($data, true);

  $user  = JFactory::getUser();
  $canCreateRecords = $user->authorise('core.edit', 'com_quix') || count($user->getAuthorisedCategories('com_quix', 'core.edit')) > 0;

  ob_start();
  ?>
  <div class="qx quix<?php echo ($canCreateRecords) ? ' qx-can-edit' : '' ?>">
    <?php if($item->builder != 'classic' && $canCreateRecords && $app->input->get('view') == 'page'): ?>
      <a class="qx-btn qx-btn-edit" href="<?php echo JRoute::_('index.php?option=com_quix&task=page.edit&id=' . $item->id); ?>" class="label">Edit Page</a>
    <?php endif; ?>
    <div class="qx-inner <?php echo $UserAgent; ?>">

      <?php $quix = quix(); ?>
      <?php
         $webFontsRenderer = $quix->getWebFontsRenderer();
         $fonts = $webFontsRenderer->getUsedFonts( $data );
         $fontsWeight = $webFontsRenderer->getUsedFontsWeight();
      ?>

      <?php 
      if($item->builder == "frontend") { Assets::bulkJsMinifier($pageModifiedTimeStamp, "(function(){
        {$quix->getStyleRenderer()->render( $data, null, $item->builder )}
      }());", $type,  $item->id);  Assets::load($item->builder);}
      else Assets::bulkCssMinifier(
          $pageModifiedTimeStamp,
          $quix->getStyleRenderer()->render( $data, null, $item->builder ),
          $type,
          $item->id
      );
      
      ?>

      <?php $view = $quix->getViewRenderer()->render( $data , null, $item->builder ); ?>

      <?php if ( count( $fonts ) ):

        /**
         * Dynamically generate font families name string.
         */
        $fontFamilies = '';

        $count = count($fonts);

        foreach($fonts as $font) {

            $weights = isset($fontsWeight[$font])
                        ? ":" . implode(",", $fontsWeight[$font])
                        : "";

          if($count > 1) {
            $fontFamilies .= "'{$font}" . $weights . "', ";
          } else {
            $fontFamilies .= "'{$font}" . $weights . "'";
          }
          $count-- ;
        }
      ?>
        <?php $document->addScript( "https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js" ); ?>
        <?php $document->addScriptDeclaration( "
        if(typeof(WebFont) !== 'undefined'){
          WebFont.load({
            google: {
              families: [" . $fontFamilies ."]
            }
          });
        }"); ?>
      <?php endif; ?>

      <?php echo $view;?>
    </div>
  </div>
  <?php

  return ob_get_clean();
}