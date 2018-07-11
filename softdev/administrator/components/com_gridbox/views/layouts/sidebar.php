<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
$uploading = new StdClass();
$uploading->const = JText::_('UPDATING');
$uploading->updated = JText::_('UPDATED');
$uploading->error = JText::_('UPDATED_ERROR');
$uploading->url = JUri::root();
$uploading = json_encode($uploading);
?>
<script type="text/javascript"><?php echo gridboxHelper::getGridboxLanguage(); ?></script>
<input type="hidden" value="<?php echo htmlentities($uploading); ?>" id="update-data">
<div class="tour-parent">
    <div class="product-tour sidebar-tour step-1">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('SINGLE_PAGES'); ?></p>
            <p><?php echo JText::_('CREATE_REGULAR_PAGES'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour sidebar-tour step-2">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('APPS'); ?></p>
            <p><?php echo JText::_('IMPROVE_WEBSITE_FUNCTIONALITY'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour sidebar-tour step-3">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('TRASH_FOLDER'); ?></p>
            <p><?php echo JText::_('RECOVER_DELETED_PAGES'); ?></p>
            <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
        </div>
    </div>
    <div class="product-tour sidebar-tour step-4">
        <div>
            <i class="zmdi zmdi-close"></i>
            <p class="ba-group-title"><?php echo JText::_('THEMES'); ?></p>
            <p><?php echo JText::_('FIND_THEME_FOR_WEBSITE'); ?></p>
            <a class="ba-btn close"><?php echo JText::_('CLOSE'); ?></a>
        </div>
    </div>
</div>
<div class="ba-sidebar">
    <div class="top-icons">
        <div class="scroll-sidebar">
            <span class="single-pages <?php echo gridboxHelper::checkActive('pages'); ?>">
                <a href="index.php?option=com_gridbox&view=pages">
                    <span class="zmdi zmdi-file"></span>
                    <span class="sidebar-items-title">
                        <?php echo JText::_('SINGLE_PAGES'); ?>
                    </span>
                </a>
                <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('SINGLE_PAGES'); ?></span>
            </span>
            <span class="sorting-container">
<?php
                $activeBlogs = false;
                foreach ($this->apps as $app) {
                    if ($app->type == 'blog') {
                        $activeBlogs = true;
                        break;
                    }
                }
                foreach ($this->apps as $key => $app) {
                    if ($app->type == 'tags' && !$activeBlogs) {
                        continue;
                    }
                    if ($app->type == 'tags') {
                        $title = JText::_($app->title);
                    } else {
                        $title = $app->title;
                    }
?>
                <span class="app <?php echo gridboxHelper::checkActive($app); ?>" data-id="<?php echo $app->id; ?>">
                    <a href="<?php echo gridboxHelper::getUrl($app); ?>">
                        <span class="<?php echo gridboxHelper::getIcon($app); ?>"></span>
                        <span class="sidebar-items-title">
                        <?php
                            echo $title;
                        ?>
                        </span>
                        <i class="zmdi zmdi-apps sorting-handle ba-icon-md"></i>
                    </a>
                    <span class="ba-tooltip ba-right ba-hide-element"><?php echo $title; ?></span>
                </span>
                <?php
                }
                ?>
               <span class="single-pages <?php echo gridboxHelper::checkActive('system'); ?>">
                    <a href="index.php?option=com_gridbox&view=system">
                        <span class="zmdi zmdi-alert-polygon"></span>
                        <span class="sidebar-items-title">
                            <?php echo JText::_('SYSTEM_PAGES'); ?>
                        </span>
                    </a>
                    <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('SYSTEM_PAGES'); ?></span>
                </span>
            </span>
        </div>
        <div class="ba-system-actions">
            <span class="add-new-app <?php echo gridboxHelper::appClassName(); ?>">
                <a href="#">
                    <span class="zmdi zmdi-plus-circle"></span>
                    <span class="sidebar-items-title">
                        <?php echo JText::_('ADD_NEW_APP'); ?>
                    </span>
                </a>
                <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('ADD_NEW_APP'); ?></span>
            </span>
            <span class="trashed-items <?php echo gridboxHelper::checkActive('trashed'); ?>">
                <a href="index.php?option=com_gridbox&view=trashed">
                    <span class="zmdi zmdi-delete"></span>
                    <span class="sidebar-items-title">
                        <?php echo JText::_('TRASHED_ITEMS'); ?>
                    </span>
                </a>
                <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('TRASHED_ITEMS'); ?></span>
            </span>
        </div>
        <span class="gridbox-themes <?php echo gridboxHelper::checkActive('themes'); ?>">
            <a href="index.php?option=com_gridbox&view=themes">
                <span class="zmdi zmdi-format-color-fill"></span>
                <span class="sidebar-items-title">
                    <?php echo JText::_('THEMES'); ?>
                </span>
            </a>
            <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('THEMES'); ?></span>
        </span>
    </div>
    <div class="bottom-icons">
        <span class="gridbox-help">
            <a href="#">
                <span class="zmdi zmdi-help"></span>
                <span class="sidebar-items-title">
                    <?php echo JText::_('HELP'); ?>
                </span>
            </a>
            <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('HELP'); ?></span>
        </span>
        <span class="gridbox-options">
            <a href="#">
                <span class="zmdi zmdi-settings"></span>
                <span class="sidebar-items-title">
                    <?php echo JText::_('OPTIONS'); ?>
                </span>
            </a>
            <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('OPTIONS'); ?></span>
        </span>
        <span class="sidebar-toggle">
            <a href="#">
                <span class="zmdi zmdi-chevron-right sidebar-toggle-icon"></span>
            </a>
            <span class="ba-tooltip ba-right ba-hide-element"><?php echo JText::_('OPEN'); ?></span>
        </span>
    </div>
</div>
<div class="sidebar-toggle sidebar-backdrop"></div>
<div id='login-modal' class='ba-modal-sm modal hide'>
    <div class='modal-body'>
        <div class="ba-login-dialog">
            <div class="ba-header-content">
                <h3 class='ba-modal-header'>
                    <?php echo JText::_('LOGIN'); ?>
                </h3>
                <label class="ba-help-icon">
                    <i class="zmdi zmdi-help"></i>
                    <span class="ba-tooltip ba-help ba-hide-element">
                        <?php echo JText::_('LOGIN_TOOLTIP'); ?>
                    </span>
                </label>
            </div>
            <div class="ba-body-content">
                <div class="ba-input-lg">
                    <input class='ba-username' type='text' autocomplete="off" placeholder="<?php echo JText::_('USERNAME'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <div class="ba-input-lg">
                    <input class='ba-password' type='password' name="ba-password" autocomplete="off"
                        placeholder="<?php echo JText::_('PASSWORD'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <input type="hidden" id="theme-id">
            </div>
            <div class="ba-footer-content">
                <a href="#" class="ba-btn-primary login-button active-button">
                    <?php echo JText::_('INSTALL'); ?>
                </a>
            </div>
        </div>
    </div>
</div>