<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
$array = array('SUBSCRIPTION_EXPIRED' => JText::_('SUBSCRIPTION_EXPIRED'),
	'INCORRECT_USERNAME_PASSWORD' => JText::_('INCORRECT_USERNAME_PASSWORD'));
?>
<input type="hidden" id="current-version" value="<?php echo $this->about->version; ?>">
<input type="hidden" id="response-constant" value="<?php echo htmlentities(json_encode($array)); ?>">
<div class="ba-update-message" id="ba-update-message">
    <h3><?php echo JText::_('UPDATE_AVAILABLE'); ?></h3>
    <p><?php echo JText::_('UPDATE_MESSAGE'); ?></p>
    <a class="update-link ba-btn-primary">
        <span>
            <?php echo JText::_('UPDATE'); ?>
        </span>
    </a>
</div>