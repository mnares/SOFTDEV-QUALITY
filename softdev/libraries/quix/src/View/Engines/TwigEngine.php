<?php

namespace ThemeXpert\View\Engines;

use Exception;
use Twig\Environment;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use Twig_Extension_Debug;
use Twig\Loader\ArrayLoader;

class TwigEngine implements EngineInterface
{
    /**
     * Get the evaluated contents of the view.
     *
     * @param  string $path
     * @param  array  $data
     *
     * @return string
     */
    public function get($path, array $data = array())
    {
        $output = '';
        $path = $this->getPath($path);

        if(is_array($path)) {
            foreach($path as $p) {
                $output .= $this->getContent($p, $data) . ";";
            }
        
            return $output;
        } else {
            return $this->getContent($path, $data);
        }
    }

    /**
     * get content
     */
    protected function getContent($path, $data)
    { 
        if(!file_exists($path)) {
            return "";
        }

        // form data...
        $data = array_merge($data, $data['field']);
        unset($data['field']);
        
        $visibility = '';

        foreach($data['visibility'] as $key => $vs) {
            if($vs) $visibility .= $key . " ";
        }

        $data['visibility'] = $visibility;

        $data['grid'] = $this->getGrid($data);

        $data['FILE_MANAGER_ROOT_URL'] = \JURI::root() . "images";
        
        // twig loading....
        $loader = new ArrayLoader(array(
            'view_content' => "{% autoescape false %} " . file_get_contents($path) . " {% endautoescape %} ",
            'global.twig' => "{% autoescape false %} \n" . file_get_contents(QUIX_PATH . "/app/frontend/global.twig") . " \n {% endautoescape %} "
        ));

        $twig = new Environment($loader, ['debug' => true, 'cache' => false]);
        $twig->addExtension(new Twig_Extension_Debug());

        // register field function
        $twig->addFunction($this->getFieldFunction($data));
        $twig->addFunction($this->getImageFunction($data));
        $twig->addFunction($this->getClassNamesFunction($data));
        $twig->addFunction($this->getRawFunction($data));
        $twig->addFunction($this->getStartsWithFunction($data));
        $twig->addFunction($this->getJoomlaModuleFunction($data));
        $twig->addFunction($this->getGetOpacityFunction($data));
        $twig->addFunction($this->getGetQuixElementPathFunction($data));

        // register with filter
        $twig->addFilter($this->getWrapFilter($data));
        $twig->addFilter($this->getLinkFilter($data));

        return $rendered = $twig->render(
        'view_content',
        $data);
    }

    /**
     * Get wrap filter.
     * 
     * @param $data data of field
     */
    protected function getWrapFilter($data)
    {
        return new Twig_SimpleFilter('wrap', function ($value, $tag) use ( $data ) {
            return "<$tag> $value </$tag>"; 
        });
    }

    /**
     * Get image source link
     */
    protected function getSrcLink($src) {
        if(
            preg_match('/^(https?:\/\/)|(http?:\/\/)|(\/\/)|([a-z0-9-].)+(:[0-9]+)(\/.*)?$/', $src)
        ) {
            return $src;
        }

        return \JURI::root() . '/images' . $src;
    }

    /**
     * Get image function.
     * 
     * @param $data data of field
     */
    protected function getImageFunction($data)
    {
        return new Twig_SimpleFunction('image', function ($src, $alt) use ( $data ) {
            if( strpos($src, 'libraries') === false ){
                $src = $this->getSrcLink($src);
            }else{
                $src = \JURI::root() . '/' . $src;
            }

            return "<img src='{$src}' alt='$alt' />";
        });
    }

    /**
     * Get classNames function.
     * 
     * @param $data data of field
     */
    protected function getClassNamesFunction($data)
    {
        return new Twig_SimpleFunction('classNames', function () use ( $data ) {
            return call_user_func_array("classNames", func_get_args());
        });
    }

    /**
     * Get raw function.
     * 
     * @param $data data of field
     */
    protected function getRawFunction($data)
    {
        return new Twig_SimpleFunction('raw', function ($source) use ( $data ) {
            return file_get_contents(QUIX_PATH . $source);
        });
    }

    /**
     * Get quix element path function.
     * 
     * @param $data data of field
     */
    protected function getGetQuixElementPathFunction($data)
    {
        return new Twig_SimpleFunction('getQuixElementPath', function ($source) use ( $data ) {
            return QUIX_ELEMENTS_PATH;
        });
    }

    /**
     * Get starts with function.
     * 
     * @param $data data of field
     */
    protected function getStartsWithFunction($data)
    {
        return new Twig_SimpleFunction('startsWith', function ($str, $subStr) use ( $data ) {
            return substr($str, 0, strlen($subStr)) === $subStr;
        });
    }

    /**
     * Get link filter.
     * 
     * @param $data data of field
     */
    protected function getLinkFilter($data)
    {
        return new Twig_SimpleFilter('link', function () use ( $data ) {
            $args = func_get_args();

            $value = isset($args[0])? $args[0] : null;
            $options = isset($args[1])? $args[1] : [];
            $classes = isset($args[2])? $args[2] : null;
            
            $url = empty($options["url"])? null : $options["url"];
            $class = null; $target = ''; $rel = '';

            if(isset($classes)) {
                $class = "class='{$classes}'";
            }

            if(isset($options["target"])) $target = "target='_blank'";

            if(isset($options["nofollow"])) $rel = "rel='nofollow'"; 

            if(! is_null($url)) {
                return "<a $class href='$url' $target $rel> $value </a>";
            } else {
                return "$value";
            }
        });
    }

    /**
     * Get field function.
     * 
     * @param $data data of field
     */
    protected function getFieldFunction($data)
    {
        return new Twig_SimpleFunction('field', function ($field) use ( $data ) {
            return $this->getFieldData($field, $data);
        });
    }

    /**
     * Get opacity from background overlay.
     * 
     * @param $data data of field
     */
    protected function getGetOpacityFunction($data)
    {
        return new Twig_SimpleFunction('getOpacity', function ($background, $type) use ( $data ) {
            return $background['state'][$type]['opacity'];
        });
    }
    
    /**
     * Get Joomla Module
     * 
     * @param $data data of field
     */
    protected function getJoomlaModuleFunction($data)
    {
      return new Twig_SimpleFunction('getJoomlaModule', function ($id, $style='raw') use ( $data ) {

        $db = \JFactory::getDBo();
        $query = $db->getQuery( true );
        $query->select( '*' )
            ->from( '#__modules' )
            ->where( 'published = ' . 1 )
            ->where( 'id = ' . $id );
        $db->setQuery( $query );
        $module = $db->loadObject();
        
        // check if module not found
        if(!isset($module->id)) return;

        $mparams = json_decode($module->params);
        $params = array( 'style' => ( isset($mparams->style) ? $mparams->style : $style) );
        $enabled = \JModuleHelper::isEnabled( $module->module);

        if($enabled){
          $moduleinfo = \JModuleHelper::getModule( $module->module, $module->title );
          $info = (object) array_merge((array) $moduleinfo, (array) $module);
          
          return \JModuleHelper::renderModule( $info, $params );
        }
        else{
          return;
        }
      });
    }

    /**
     * Get bootstrap grid
     */
    protected function getGrid($node)
    {
        return implode( " ", array_map( function ( $device, $size ) {
            switch($device) {
                case "xs":
                    $class = "qx-col-";
                    break;
                case "sm":
                    $class = "qx-col-sm-";
                    break;
                case "md":
                    $class = "qx-col-md-";
                    break;
                case "lg":
                    $class = "qx-col-lg-";
            }

            return $class . ceil( $size * 12 );
        }, array_keys( $node['size'] ), $node['size'] ) );
    }

    /**
     * get path
     */
    protected function getPath($path)
    {
        $path = str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $path);

        $splitPath = explode(DIRECTORY_SEPARATOR, $path);

        $fileName = $splitPath[sizeof($splitPath)-1];

        if($fileName == "view.php") {
            $fileName = "html.twig";
        }

        array_pop($splitPath);

        $subDir = $splitPath[sizeof($splitPath)-1];
        
        array_pop($splitPath);
        
        $dir = $splitPath[sizeof($splitPath)-1];
        
        array_pop($splitPath);

        if(
            $splitPath[sizeof($splitPath)-3] == "libraries"
            or
            $splitPath[sizeof($splitPath)-4] == "libraries"
        ) {
            if($fileName == "style.php") {
                $joinedPath = str_replace("frontend", "", implode(DIRECTORY_SEPARATOR, $splitPath));
                $path = [];
                $path[] = $joinedPath . DIRECTORY_SEPARATOR . "frontend" . DIRECTORY_SEPARATOR .  $dir . DIRECTORY_SEPARATOR . $subDir . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . "style.twig" ;
                $path[] = $joinedPath . DIRECTORY_SEPARATOR . "frontend" . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $subDir . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . "script.twig";
            } else {
                $path = str_replace("frontend", "", implode(DIRECTORY_SEPARATOR, $splitPath));
                $path =  $path . DIRECTORY_SEPARATOR . "frontend" . DIRECTORY_SEPARATOR .  $dir . DIRECTORY_SEPARATOR . $subDir . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . $fileName;
            }
        }        

        return $path;
    }

    /**
     * Get field data by the given field name.
     */
    public function getFieldData($field, $data)
    {
        $id = $data['identifier'][1]['value'];
        
        try {
            $fieldData = quix()->container[ $id ];
            
            return isset($fieldData[ $field ]) ? $fieldData[ $field ] : "";
        } catch(\Exception $e) {
            $fieldData = [];
            $formData = $data['node']['form'];

            // looping through form data
            foreach($formData as $data) {

                // making field data
                array_map(function($fields, $index) use (&$fieldData ) {
                    
                  // if fields data isn't array
                  if(!is_array($fields)) $fieldData[$index] = $fields;
                  
                  // if fields data is an array
                  else {
                    
                    // storing form data into field data  
                    foreach($fields as $f) {
                      if(isset($f['name'])) {
                        $fieldData[$f['name']] = $f['value'];
                      } else {
                        $fieldData["id"] = $f;
                      }
                    }
                  }
                }, $data, array_keys($data));
            }
         
            quix()->container[ $id ] = $fieldData;

            return quix()->container[ $id ][ $field ];
        }
    }
}