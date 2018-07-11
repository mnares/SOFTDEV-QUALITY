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
$this->language = $doc->language;
$this->direction = $doc->direction;
$id = 1;
JLoader::register('gridboxHelper', JPATH_ROOT . '/components/com_gridbox/helpers/gridbox.php');
gridboxHelper::checkSystemTheme(1);
gridboxHelper::setBreakpoints();
gridboxHelper::checkResponsive();
gridboxHelper::checkGridboxLanguage();
$id = gridboxHelper::getTheme(1, false, 'system');
$data = array('id' => 1, 'theme' => $id, 'edit_type' => 'system');
$page = new stdClass();
$page->option = 'com_gridbox';
$page->view = 'page';
$page->id = 1;
$data['page'] = $page;
$this->params = gridboxHelper::getThemeParams($id);
$params = $this->params->get('params');
gridboxHelper::prepareParentFonts($params);
gridboxHelper::checkSystemCss(1);
$error = gridboxHelper::getSystemParams(1);
$error->html = gridboxHelper::checkModules($error->html, $error->items);
$code = $this->error->getCode();
$message = $this->error->getMessage();
$error->html = str_replace('{gridbox_error_code}', $code, $error->html);
$error->html = str_replace('{gridbox_error_message}', $message, $error->html);
$time = $this->params->get('time', '');
if (!empty($time)) {
    $time = '?'.$time;
}
$error->options = json_decode($error->page_options);
if ($error->options->enable_header == 1) {
    $footer = $this->params->get('footer');
    $header = $this->params->get('header');
    $layout = $this->params->get('layout');
    $fonts = $this->params->get('fonts');
} else {
    $fonts = '{}';
}
$fonts = gridboxHelper::prepareFonts($fonts, 'com_gridbox', 1, 'system');
$style = gridboxHelper::checkCustom($id, 'page', $time);
$website = gridboxHelper::getWebsiteCode();
if ($error->options->enable_header == 1) {
    $footer->html = gridboxHelper::checkModules($footer->html, $footer->items);
    $header->html = gridboxHelper::checkModules($header->html, $header->items);
    gridboxHelper::checkMoreScripts($footer->html);
    gridboxHelper::checkMoreScripts($header->html);
}
$doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
$doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
$doc->addScriptDeclaration("var JUri = '".JUri::root()."';");
$doc->addScript($this->baseurl . '/templates/gridbox/js/gridbox.js');
$doc->addScriptDeclaration("var themeData = ".json_encode($data).";");
$doc->addStyleSheet($this->baseurl . '/templates/gridbox/css/gridbox.css');
$doc->addStyleSheet($this->baseurl . '/templates/gridbox/css/storage/responsive.css'.$time);
$doc->addStyleSheet(JUri::root().'templates/gridbox/css/storage/style-'.$id.'.css'.$time);
$doc->addStyleSheet(JUri::root().'templates/gridbox/css/storage/error.css'.$time);
if (!empty($fonts)) {
    $doc->addStyleSheet($fonts);
}
$breakpoints = json_encode(gridboxHelper::$breakpoints);
$disable_responsive = gridboxHelper::$website->disable_responsive == 1 ? 'true' : 'false';
$doc->addScriptDeclaration("var breakpoints = ".$breakpoints.";");
$doc->addScriptDeclaration("var menuBreakpoint = ".gridboxHelper::$menuBreakpoint.";");
$doc->addScriptDeclaration("var disableResponsive = ".$disable_responsive.";");
$stylesheets = gridboxHelper::returnSystemStyle($doc);

gridboxHelper::createFavicon();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>"
    dir="<?php echo $this->direction; ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
<?php
    if (!(bool)gridboxHelper::$website->disable_responsive) {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
    } else {
?>
    <meta name="viewport" content="width=device-width">
<?php
    }
?>
    <?php echo $stylesheets; ?>
    <?php if ($this->direction == 'rtl') : ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/jui/css/bootstrap-rtl.css" type="text/css" />
    <?php endif; ?>
    <link href="<?php echo $this->baseurl; ?>/templates/gridbox/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <?php echo "\n".$website->header_code; ?>
<?php
    echo $style."\n";
?>
</head>
<body class="com_gridbox page">
    <div class="ba-overlay"></div>
<?php
if ($error->options->enable_header == 1) {
?>
    <header class="header <?php echo $layout; ?>">
        <?php echo $header->html; ?>
    </header>
<?php
}
?>
    <div class="body">
        <div class="row-fluid main-body">
            <div class="span12">
<?php
if (JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
?>
            <a class="edit-page-btn" target="_blank"
               href="<?php echo JUri::root().'index.php?option=com_gridbox&view=editor&edit_type=system&tmpl=component&id=1'; ?>">
               <i class="zmdi zmdi-settings"></i>
               <p class="edit-page"><?php echo JText::_('EDIT_PAGE'); ?></p>
            </a>
<?php
}
            echo $error->html;
?>
            </div>
        </div>
    </div>
<?php
if ($error->options->enable_header == 1) {
?>
    <footer class="footer">
        <?php echo $footer->html; ?>
    </footer>
<?php
}
if ($params->desktop->background->type == 'video') {
?>
    <div class="ba-video-background global-video-bg"></div>
<?php
}
?>
<?php
echo $website->body_code."\n";
?>
</body>
</html>
