<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$isEnabled = gridboxHelper::getSystemPlugin();
?>
<div id="ba-notification">
    <i class="zmdi zmdi-close"></i>
    <h4><?php echo JText::_('ERROR'); ?></h4>
    <p></p>
</div>
<?php if (!$isEnabled) { ?>
    <div id="not-default-dialog" class="ba-modal-sm modal hide in">
    <div class="modal-body">
        <p><?php echo JText::_('ENABLE_GRIDBOX_SYSTEM_PLUGIN'); ?></p>
    </div>
    <div class="modal-footer">
        <form action="index.php?option=com_plugins&view=plugins" method="post" name="setSystemPlugin" style="display: none;">
            <input type="hidden" name="filter[search]" value="Gridbox - System">
        </form>
        <a href="#" onclick="document.forms.setSystemPlugin.submit();" class="ba-btn"><?php echo JText::_('CLOSE') ?></a>
    </div>
</div>
<div class="ba-modal-backdrop"></div>
<?php } ?>
<div id="export-dialog" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-header">
        <h3 class="ba-modal-header"><?php echo JText::_('EXPORT'); ?></h3>
    </div>
    <div class="modal-body">
        <div>
            <ul>
                <li>
                    <label>
                        <?php echo JText::_('PAGES'); ?>
                    </label>
                    <label class="ba-checkbox ba-hide-checkbox">
                        <input type="checkbox" checked disabled>
                        <i class="zmdi zmdi-check"></i>
                        <span></span>
                    </label>
                </li>
                <li>
                    <label>
                        <?php echo JText::_('THEME'); ?>
                    </label>
                    <label class="ba-checkbox ba-hide-checkbox">
                        <input type="checkbox" checked disabled>
                        <i class="zmdi zmdi-check"></i>
                        <span></span>
                    </label>
                </li>
                <li class="export-apps">
                    <label>
                        <?php echo JText::_('APP'); ?>
                    </label>
                    <label class="ba-checkbox ba-hide-checkbox">
                        <input type="checkbox" checked disabled>
                        <i class="zmdi zmdi-check"></i>
                        <span></span>
                    </label>
                </li>
                <li>
                    <label>
                        <?php echo JText::_('COM_MENUS'); ?>
                    </label>
                    <label class="ba-checkbox ba-hide-checkbox">
                        <input type="checkbox" class="menu-export">
                        <i class="zmdi zmdi-check"></i>
                        <span></span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
        <a href="#" class="ba-btn-primary apply-export"><?php echo JText::_('JTOOLBAR_APPLY') ?></a>
    </div>
</div>
<div id="about-dialog" class="ba-modal-md modal hide" style="display:none">
    <div class="modal-header">
        <a class="zmdi zmdi-close" data-dismiss="modal"></a>
        <h3><?php echo JText::_('ABOUT') ?></h3>
    </div>
    <div class="modal-body">
        <div id="form-about">
            <div class="about-element">
                <label><?php echo JText::_('WEBSITE') ?>:</label>
                <a target="_blank" href="<?php echo $this->about->authorUrl; ?>">www.balbooa.com</a>
            </div>
            <div class="about-element">
                <label><?php echo JText::_('LICENSE') ?>:</label>
                GNU Public License version 2.0.
            </div>
            <div class="about-element">
                <label><?php echo JText::_('COPYRIGHT') ?>:</label>
                © <?php echo date('Y'); ?> Balbooa All Rights Reserved.
            </div>
            <div class="about-element">
                <label><?php echo JText::_('EMAIL') ?>:</label>
                <?php echo $this->about->authorEmail; ?>
            </div>
            <div class="about-element">
                <label><?php echo JText::_('VERSION') ?>:</label>
                <span class="update"><?php echo $this->about->version; ?></span>
            </div>
        </div>
    </div>
</div>