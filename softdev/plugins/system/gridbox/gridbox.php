<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport( 'joomla.plugin.plugin' );
 
class plgSystemGridbox extends JPlugin
{
    public function __construct( &$subject, $config )
    {
        $path = JPATH_ROOT . '/components/com_gridbox/helpers/gridbox.php';
        JLoader::register('gridboxHelper', $path);
        parent::__construct( $subject, $config );
    }

    public function onAfterRoute()
    {
        $app = JFactory::getApplication();
        if ($app->isSite()) {
            $option = $app->input->getCmd('option', '');
            if ($option == 'com_gridbox') {
                $view = $app->input->getCmd('view', '');
                $db = JFactory::getDbo();
                if ($view == 'blog' || $view == 'page' || $view == 'gridbox') {
                    $blog = false;
                    $edit_type = $app->input->get('edit_type', '');
                    if ($view == 'blog' || $edit_type == 'blog') {
                        $blog = true;
                    }
                    $id = $app->input->get('id');
                    if ($view == 'blog') {
                        $id = $app->input->get('app');
                    }
                    $theme = gridboxHelper::getTheme($id, $blog, $edit_type);
                } else {
                    $theme = 0;
                }
                $params = gridboxHelper::getThemeParams($theme);
                $app->setTemplate('gridbox', $params);
            }
        }
    }

    public function onAfterRender()
    {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        $view = $app->input->get('view');
        $params = JComponentHelper::getParams('com_gridbox');
        $email_encryption = $params->get('email_encryption', '0');
        if ($app->isSite() && $doc->getType() == 'html') {
            $html = $app->getBody();
            $str = gridboxHelper::checkMeta();
            $html = str_replace('</head>', $str.'</head>', $html);
            $app->setBody($html);
        }
        if ($app->isSite() && $doc->getType() == 'html' && $email_encryption == 1 && $view != 'gridbox') {
            $body = $app->getBody();
            if (strpos($body, '@') !== false) {
                $body = $this->EncryptEmails($body);
                $app->setBody($body);
            }
        }
    }

    public function getPattern($link, $html)
    {
        $pattern = '~(?:<a ([^>]*)href\s*=\s*"mailto:'.$link.'"([^>]*))>'.$html.'</a>~i';

        return $pattern;
    }

    public function addEmailAttributes($email, $before, $after)
    {
        if ($before !== '') {
            $before = str_replace("'", "\'", $before);
            $email = str_replace(".innerHTML += '<a '", ".innerHTML += '<a {$before}'", $email);
        }
        if ($after !== '') {
            $after = str_replace("'", "\'", $after);
            $email = str_replace("'\'>'", "'\'{$after}>'", $email);
        }

        return $email;
    }

    public function EncryptEmails($html)
    {
        $regEmail = '([\w\.\'\-\+]+\@(?:[a-z0-9\.\-]+\.)+(?:[a-zA-Z0-9\-]{2,10}))';
        $regEmailLink = $regEmail.'([?&][\x20-\x7f][^"<>]+)';
        $regText = '((?:[\x20-\x7f]|[\xA1-\xFF]|[\xC2-\xDF][\x80-\xBF]|[\xE0-\xEF][\x80-\xBF]{2}|[\xF0-\xF4][\x80-\xBF]{3})[^<>]+)';
        $regImage = '(<img[^>]+>)';
        $regTextSpan = '(<span[^>]+>|<span>|<strong>|<strong><span[^>]+>|<strong><span>)'.$regText.'(</span>|</strong>|</span></strong>)';
        $regEmailSpan = '(<span[^>]+>|<span>|<strong>|<strong><span[^>]+>|<strong><span>)'.$regEmail.'(</span>|</strong>|</span></strong>)';
        $pattern = $this->getPattern($regEmail, $regEmail);
        $pattern = str_replace('"mailto:', '"http://mce_host([\x20-\x7f][^<>]+/)', $pattern);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[3][0];
            $emailText = $matches[5][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = $this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]);
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regText);
        $pattern = str_replace('"mailto:', '"http://mce_host([\x20-\x7f][^<>]+/)', $pattern);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[3][0];
            $emailText = $matches[5][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = $this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]);
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regEmail);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = $matches[4][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = $this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]);
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regEmailSpan);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = $matches[4][0] . $matches[5][0] . $matches[6][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regTextSpan);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = $matches[4][0] . addslashes($matches[5][0]) . $matches[6][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regText);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = addslashes($matches[4][0]);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = $this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]);
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regImage);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = $matches[4][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regImage.$regEmail);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = $matches[4][0] . $matches[5][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmail, $regImage.$regText);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0];
            $emailText = $matches[4][0] . addslashes($matches[5][0]);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[3][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regEmail);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0] . $matches[3][0];
            $emailText = $matches[5][0];
            $email = str_replace('&amp;', '&', $email);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = $this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]);
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regText);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0] . $matches[3][0];
            $emailText = addslashes($matches[5][0]);
            $email = str_replace('&amp;', '&', $email);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = $this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]);
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regEmailSpan);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0] . $matches[3][0];
            $emailText = $matches[5][0] . $matches[6][0] . $matches[7][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regTextSpan);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[2][0] . $matches[3][0];
            $emailText = $matches[5][0] . addslashes($matches[6][0]) . $matches[7][0];
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regImage);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[1][0] . $matches[2][0] . $matches[3][0];
            $emailText = $matches[5][0];
            $email = str_replace('&amp;', '&', $email);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regImage.$regEmail);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[1][0] . $matches[2][0] . $matches[3][0];
            $emailText = $matches[4][0] . $matches[5][0] . $matches[6][0];
            $email = str_replace('&amp;', '&', $email);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = $this->getPattern($regEmailLink, $regImage . $regText);
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[1][0] . $matches[2][0] . $matches[3][0];
            $emailText = $matches[4][0] . $matches[5][0] . addslashes($matches[6][0]);
            $email = str_replace('&amp;', '&', $email);
            $replacement = JHtml::_('email.cloak', $email, true, $emailText, 0);
            $replacement = html_entity_decode($this->addEmailAttributes($replacement, $matches[1][0], $matches[4][0]));
            $html = substr_replace($html, $replacement, $matches[0][1], strlen($matches[0][0]));
        }
        $pattern = '~(?![^<>]*>)'.$regEmail.'~i';
        while (preg_match($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $email = $matches[1][0];
            $replacement = JHtml::_('email.cloak', $email, false);
            $html = substr_replace($html, $replacement, $matches[1][1], strlen($email));
        }

        return $html;
    }
}