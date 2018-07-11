<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class gridboxViewFonts extends JViewLegacy
{
    protected $item;
    protected $googleFont;
    protected $customStr;
    
    public function display($tpl = null)
    {
        if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
            JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return;
        }
        $app = JFactory::getApplication();
        $input = JFactory::getApplication()->input;
        $doc = JFactory::getDocument();
        $doc->setTitle('Gridbox Editor');
        $doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
        $doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
        $doc->addScript(JURI::root() . 'components/com_gridbox/assets/js/ba-fonts.js');
        $doc->addStyleSheet(JURI::root() . 'components/com_gridbox/assets/css/ba-style.css');
        $this->item = $this->get('Item');
        $this->googleFont = $this->get('GoogleFonts');
        $fonts = new StdClass();
        if (!empty($this->item)) {
            $link = 'https://fonts.googleapis.com/css?family=';
            $sublink = '';
            $this->customStr = '';
            foreach ($this->item as $key => $item) {
                $customFlag = false;
                if (!empty($item->custom_src)) {
                	$str = "@font-face {font-family: '".str_replace('+', ' ', $item->font)."'; ";
	               	$str .= "font-weight: ".$item->styles."; ";
	                $str .= "src: url(".JUri::root()."templates/gridbox/library/fonts/".$item->custom_src.");}";
	                $this->customStr .= $str;
                    $customFlag = true;
                }
                if (!isset($fonts->{$item->font})) {
                    if (!empty($sublink) && !$customFlag) {
                        $sublink .= '%7C';
                    }
                    $fonts->{$item->font} = array();
                    if (!$customFlag) {
                        $sublink .= $item->font.':'.$item->styles;
                    }
                } else {
                    if (!$customFlag) {
                        $sublink .= ','.$item->styles;
                    }
                }
                $fonts->{$item->font}[] = $item;
            }
            $link .= $sublink.'&subset=latin,cyrillic,greek,latin-ext,greek-ext,vietnamese,cyrillic-ext';
            $doc->addStyleSheet($link);
        }
        $this->item = $fonts;
        foreach ($this->item as $key => $value) {
            usort($value, function($a, $b){
                if ($a->styles == $b->styles) {
                    return 0;
                }

                return ($a->styles < $b->styles) ? -1 : 1;
            });
            $this->item->{$key} = $value;
        }
        
        parent::display($tpl);
    }
}