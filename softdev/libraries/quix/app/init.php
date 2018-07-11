<?php

use Pimple\Container;
use ThemeXpert\Quix\Cache;
use ThemeXpert\Quix\Application;

/*****************************
 *  FILE MANAGER LIB CONFIG
 *****************************/
defined("FILE_MANAGER_ROOT") or define("FILE_MANAGER_ROOT", JPATH_ROOT . '/images');

/**
 * Define quix function.
 * 
 * @return Application
 */
if( ! function_exists("quix") ) {
    function quix() {

        // set builder type
        global $QuixBuilderType;

        if(isset($QuixBuilderType)) $builder = $QuixBuilderType;
        else $builder = "frontend";
   
        // define quix instance
        static $quix;

        if ( !isset($quix[$builder]) ) {
            $cache_time = 60 * 60 * 24;
            $should_cache = QUIX_CACHE;
            $container = new Container();

            $jcache = JFactory::getCache('quix', 'output');
            $cache = new Cache( $jcache, $cache_time, $should_cache );

            // store quix instance based on builder type
            $quix[$builder] = new Application( $container, $cache, $builder );

            if ( $builder == "classic" ) {
                $quix[$builder]->getElementsBag()->fill( QUIX_PATH . "/app/elements", QUIX_URL . "/app/elements" );
                $quix[$builder]->getNodesBag()->fill( QUIX_PATH . "/app/nodes", QUIX_URL . "/app/nodes" );

                if ( file_exists( QUIX_TEMPLATE_PATH . "/elements" ) ) {
                    $quix[$builder]->getElementsBag()->fill( QUIX_TEMPLATE_PATH . "/elements", QUIX_TEMPLATE_URL . "/elements" );
                }
                
                if ( file_exists( QUIX_TEMPLATE_PATH . "/nodes" ) ) {
                    $quix[$builder]->getNodesBag()->fill( QUIX_TEMPLATE_PATH . "/nodes", QUIX_TEMPLATE_URL . "/nodes" );
                }
                
                if( file_exists( QUIX_TEMPLATE_PATH.'/quix.php' ) ){
                    require( QUIX_TEMPLATE_PATH.'/quix.php' );
                }

                 if ( QUIX_EDITOR ) {
                    $quix[$builder]->getPresetsBag()->fill( QUIX_PATH . "/app/presets", QUIX_URL . "/app/presets" );

                    if ( file_exists( QUIX_TEMPLATE_PATH . "/presets" ) ) {
                        $quix[$builder]->getPresetsBag()->fill( QUIX_TEMPLATE_PATH . "/presets", QUIX_TEMPLATE_URL . "/presets" );
                    }
                }
            } else {
                $quix[$builder]->getElementsBag()->fill( QUIX_PATH . "/app/frontend/elements", QUIX_URL . "/app/frontend/elements", array(), $builder );
                $quix[$builder]->getNodesBag()->fill( QUIX_PATH . "/app/frontend/nodes", QUIX_URL . "/app/frontend/nodes", array(), $builder );

                if ( file_exists( QUIX_TEMPLATE_PATH . "/frontend/elements" ) ) {
                    $quix[$builder]->getElementsBag()->fill( QUIX_TEMPLATE_PATH . "/frontend/elements", QUIX_TEMPLATE_URL . "/frontend/elements", array(), $builder );
                }
                
                if ( file_exists( QUIX_TEMPLATE_PATH . "/frontend/nodes" ) ) {
                    $quix[$builder]->getNodesBag()->fill( QUIX_TEMPLATE_PATH . "/frontend/nodes", QUIX_TEMPLATE_URL . "/frontend/nodes", array(), $builder );
                }
                
                if( file_exists( QUIX_TEMPLATE_PATH.'/frontend/quix.php' ) ){
                    require( QUIX_TEMPLATE_PATH.'/frontend/quix.php' );
                }
            }
        }
        
        // returning quix instance based on builder type
        return $quix[$builder];
    }
}

/**
 * Determine frontend / classic builder
 */
if( ! function_exists("checkQuixIsVersion2") ) {
    function checkQuixIsVersion2() {
        $app = \JFactory::getApplication();
        if($app->isAdmin()) return false;
        
        $input = $app->input;
        $option = $input->get('option');
        $id = $input->get('id'); 
        $view = $input->get('view', 'page');
        

        if($option == 'com_quix' && $id)
        {
            $db = \JFactory::getDbo();
            $sql = "SELECT builder FROM " . ($view == 'page' ? "`#__quix`" : "`#__quix_collections`") . " WHERE `id` = " . $id;
            $db->setQuery($sql);
            $result = $db->loadResult();
            
            if($result == 'classic') return false;
        }
        
        return true;
    }
}


if( ! function_exists("checkQuixCollectionIsVersion2") ) {
    function checkQuixCollectionIsVersion2($id)
    {

        if ($id) {
            $db = \JFactory::getDbo();
            $sql = "SELECT builder FROM `#__quix_collections` WHERE `id` = " . $id;
            $db->setQuery($sql);
            $result = $db->loadResult();

            if ($result == 'classic') return false;
        }

        return true;
    }
}

// /**
//  * Load presets only when in editor
//  */
// if ( QUIX_EDITOR ) {
//     quix()->getPresetsBag()->fill( QUIX_PATH . "/app/presets", QUIX_URL . "/app/presets" );

//     if ( file_exists( QUIX_TEMPLATE_PATH . "/presets" ) ) {
//         quix()->getPresetsBag()->fill( QUIX_TEMPLATE_PATH . "/presets", QUIX_TEMPLATE_URL . "/presets" );
//     }
// }

// quix()->getElementsBag()->fill( QUIX_PATH . "/app/elements", QUIX_URL . "/app/elements" );
// quix()->getNodesBag()->fill( QUIX_PATH . "/app/nodes", QUIX_URL . "/app/nodes" );


// /** load elements from template if quix/elements*/
//     $uri = \JUri::getInstance(); 
// if ( strpos($uri->toString(), 'component/quix') == false ) {
// 	if ( file_exists( QUIX_TEMPLATE_PATH . "/elements" ) ) {
// 	    quix()->getElementsBag()->fill( QUIX_TEMPLATE_PATH . "/elements", QUIX_TEMPLATE_URL . "/elements" );
// 	}
	
// 	if ( file_exists( QUIX_TEMPLATE_PATH . "/nodes" ) ) {
// 	    quix()->getNodesBag()->fill( QUIX_TEMPLATE_PATH . "/nodes", QUIX_TEMPLATE_URL . "/nodes" );
// 	}
	
// 	if( file_exists( QUIX_TEMPLATE_PATH.'/quix.php' ) ){
// 	    require( QUIX_TEMPLATE_PATH.'/quix.php' );
// 	}
// }
