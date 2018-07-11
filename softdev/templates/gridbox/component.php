<?php
/**
* @package   Gridbox template
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$option = $app->input->getCmd('option', '');
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/gridbox.css');
$doc->addStyleSheet('//fonts.googleapis.com/css?family=Roboto:300,400,500,700');
$doc->addScript(JUri::root(true) . '/media/jui/js/jquery.min.js');
$doc->addScript(JUri::root(true) . '/media/jui/js/bootstrap.min.js');
JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<jdoc:include type="head" />
</head>
<body class="contentpane modal <?php echo $option; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
