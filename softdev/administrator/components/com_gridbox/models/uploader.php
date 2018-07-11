<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class gridboxModelUploader extends JModelLegacy
{
    protected $_parent;
    protected $_folders;
    
    public function getParent()
    {
        return $this->_parent;
    }

    public function getFolderList()
    {
        $dir = $this->_folders;
        $name = str_replace(JPATH_ROOT. '/images', '', $dir);
        $folders = JFolder::folders($dir);
        $items = array();
        foreach ($folders as $folder) {
            $fold = new stdClass();
            $fold->path = $name. '/' .$folder;
            $fold->name = $folder;
            $this->_folders = $dir. '/' .$folder;
            $fold->childs = $this->getFolderList();
            $items[] = $fold;
        }

        return $items;
    }

    public function getBreadcrumb()
    {
        $dir = JPATH_ROOT. '/images';
        $this->_folders = $dir;
        $input = JFactory::getApplication()->input;
        $name = $input->get('folder', '', 'string');
        if ($name == "undefined") {
            $name = '';
        }
        if (!empty($name)) {
            $dir .= $name;
        }
        $fold = '';
        if ($dir != JPATH_ROOT. '/images') {
            $fold = new stdClass();
            $pat = '';
            $prepath = str_replace(JPATH_ROOT. '/', '', $dir);
            $prepath = explode('/', $prepath);
            $fold->curr = $prepath[count($prepath) - 1];
            unset($prepath[count($prepath) - 1]);
            for ($i = 0; $i < count($prepath); $i++) {
                if ($prepath[$i] != 'images') {
                    $pat .= '/' .$prepath[$i];
                }
                $path[] = $pat;
            }
            $fold->par = $prepath;
            $fold->path = $path;
            $fold->name = "../";
        }
        return $fold;
    }
    
    public function getFolders()
    {
        $dir = JPATH_ROOT. '/images';
        $this->_folders = $dir;
        $input = JFactory::getApplication()->input;
        $name = $input->get('folder', '', 'string');
        if ($name == "undefined") {
            $name = '';
        }
        if (!empty($name)) {
            $dir .= $name;
        }
        $items = array();
        if ($dir != JPATH_ROOT. '/images') {
            $this->_parent = $dir;
        }
        $folders = JFolder::folders($dir);
        if (!empty($folders)) {
            foreach ($folders as $folder) {
                $fold = new stdClass();
                $fold->path = $name. '/' .$folder;
                $fold->name = $folder;
                $items[] = $fold;
            }
        }

        return $items;
    }

    public function getImages()
    {
        $dir = JPATH_ROOT. '/images';
        $url = JUri::root(). 'images';
        $input = JFactory::getApplication()->input;
        $name = $input->get('folder', '', 'string');
        if ($name == "undefined") {
            $name = '';
        }
        if (!empty($name)) {
            $dir .= $name;
            $url .= $name;
        }
        $files  = JFolder::files($dir);
        $images = array();
        $types = $this->getFiletypes();
        if (!empty($files)) {
            foreach ($files as $file) {
                $ext = strtolower(JFile::getExt($file));
                if (in_array($ext, $types)) {
                    $image = new stdClass();
                    $image->ext = $ext;
                    $image->name = $file;
                    $image->path = $name. '/' .$file;
                    $image->size = filesize($dir.'/'.$file);
                    $image->url = $url. '/' .$file;
                    $images[] = $image;
                }
            }
        }
        return $images;
    }

    public function getFiletypes()
    {
        $params = JComponentHelper::getParams('com_gridbox');
        $def = 'csv,doc,gif,ico,jpg,jpeg,pdf,png,txt,xls,svg,mp4';
        $files = $params->get('file_types', $def);
        $array = explode(',', $files);
        foreach ($array as $key => $value) {
            $value = trim($value);
            $value = strtolower($value);
            $array[$key] = $value;
        }

        return $array;
    }
    
    public function checkExt($ext)
    {
        switch($ext) {
            case 'jpg':
            case 'png':
            case 'gif':
            case 'svg':
            case 'jpeg':
            case 'ico':
                return true;
            default:
                return false;
        }
    }
}
