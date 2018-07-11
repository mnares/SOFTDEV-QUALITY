<?php
/**
* @package   Gridbox template
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$menus = $app->getMenu('site');
$menu = $menus->getActive();
$pageclass = '';
$id = 0;
if (is_object($menu)) {
    $pageclass = $menu->params->get('pageclass_sfx');
    $id = $menu->template_style_id;
} else {
    $lang = JFactory::getLanguage()->getTag();
    $default = $menus->getDefault($lang);
    $id = $default->template_style_id;
}
JLoader::register('gridboxHelper', JPATH_ROOT . '/components/com_gridbox/helpers/gridbox.php');
gridboxHelper::setBreakpoints();
$gridboxId = $app->input->get('id');
if (!empty($gridboxId)) {
    $id = gridboxHelper::getTheme($gridboxId);
    $this->params = gridboxHelper::getThemeParams($id);
}
if ($id == 0) {
    $id = gridboxHelper::getValidId();
}
if (isset($gridboxId)) {
    $data = array('id' => $gridboxId, 'theme' => $id);
} else {
    $data = array('id' => 0, 'theme' => $id);
}
$page = new stdClass();
$page->option = $app->input->getCmd('option', 'option');
$page->view = $app->input->getCmd('view', 'view');
$page->id = $app->input->getCmd('id', 'id');
$data['page'] = $page;
$params = $this->params->get('params');
$time = $this->params->get('time', '');
if (!empty($time)) {
    $time = '?'.$time;
}
$fonts = $this->params->get('fonts');
$fonts = gridboxHelper::prepareFonts($fonts, $option, $app->input->get('id', 0), $edit_type);
$style = gridboxHelper::checkCustom($id, $view, $time);
$doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
$doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
$doc->addScriptDeclaration("
    console.log = function(){
        return false;
    };
");
$doc->addScriptDeclaration("var themeData = ".json_encode($data).";");
$doc->addStyleSheet($this->baseurl . '/templates/gridbox/css/gridbox.css');
$doc->addStyleSheet($this->baseurl . '/templates/gridbox/css/storage/responsive.css'.$time);
$doc->addStyleSheet(JUri::root().'templates/gridbox/css/storage/style-'.$id.'.css'.$time);
$doc->addStyleSheet($fonts);
$breakpoints = json_encode(gridboxHelper::$breakpoints);
$disable_responsive = gridboxHelper::$website->disable_responsive == 1 ? 'true' : 'false';
$doc->addScriptDeclaration("var breakpoints = ".$breakpoints.";");
$doc->addScriptDeclaration("var menuBreakpoint = ".gridboxHelper::$menuBreakpoint.";");
$doc->addScriptDeclaration("var disableResponsive = ".$disable_responsive.";");
$doc->addScriptDeclaration("var JUri = '".JUri::root()."';");
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $this->language; ?>"
    dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php gridboxHelper::checkMeta(); ?>
    <jdoc:include type="head" />
    <?php if ($this->direction == 'rtl') { ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/jui/css/bootstrap-rtl.css" type="text/css" />
    <?php } ?>
</head>
<body class="<?php echo $option. ' '. $view . ' ' .htmlspecialchars($pageclass); ?> blog-editor">
    <div class="ba-overlay"></div>
    <div class="body">
        <div class="row-fluid main-body">
            <div class="span12">
                <jdoc:include type="message"/>
                <jdoc:include type="component"/>
            </div>
        </div>
    </div>
<?php
if ($params->desktop->background->type == 'video') {
?>
    <div class="ba-video-background global-video-bg"></div>
<?php
}
?>
<?php
    echo $style."\n";
?>
</body>
</html>