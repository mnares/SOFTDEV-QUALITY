<?php

/**
 * Bind QUIX data with JS global variable
 */
function quix_js_data($builder = 'admin') {
  $url = QUIX_SITE_URL;
  $quix = quix();
  $input = JFactory::getApplication()->input;

  // fetching required data
  $id = array_get( $_GET, 'id' );
  $presets = $quix->getPresets();
  $nodes = $quix->getNodes();

  $model = $input->get('view');

  if($builder == 'admin'){
    $api = 'index.php?option=com_quix&task=' . $model . '.apply';
  }else{
    $api = 'index.php?option=com_quix&task='. $input->get('type', 'page') .'.apply';
  }

  $collections = qxGetCollections( true );
  $_token = JSession::getFormToken();
  $blocks = qxGetBlocks($builder);
  
  if(property_exists($blocks, "success") and !$blocks->success) $blocks = json_encode([]);

  $elements = $quix->getElements();
  $type = array_get( $_GET, 'type' );

  // check for safemode for low memory server
  $params = JComponentHelper::getParams('com_quix');
  $safemode = $params->get('safemode', 0);
  if($safemode)
  {
    $collections = [];
    $presets = [];
  }

  // encoding data
  $quixData = json_encode( compact(
    'type',
    '_token',
    'collections',
    'model',
    'id',
    'api',
    'url',
    'blocks',
    'presets'
    // 'nodes',
    // 'elements'
  ) );

  // binding quix data to the JS variables
  ?>

  <script>
    var qx_site_url = '<?php echo $url ?>';
    var qx_elements = <?php echo json_encode( $elements ) ?>;
    var qx_nodes = <?php echo json_encode( $nodes ) ?>;
    var quix = <?php echo $quixData; ?>;
  </script>  


  <?php
}