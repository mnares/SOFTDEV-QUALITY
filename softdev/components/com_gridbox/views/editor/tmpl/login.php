<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
$type = gridboxHelper::checkCreatePage($this->app);
if ($type == 'blog' && empty($this->category)) {
    $categories = $this->get('Categories');
    foreach ($categories as $key => $category) {
        if ($category->app_id != $this->app) {
            unset($categories[$key]);
        }
    }
}
?>
<script type="text/javascript">
jQuery(document).on('ready', function(){
    
    var notification = jQuery('#ba-notification'),
        loginclk = true;

    function showNotice(message)
    {
        if (notification.hasClass('notification-in')) {
            setTimeout(function(){
                notification.removeClass('notification-in').addClass('animation-out');
                setTimeout(function(){
                    addNoticeText(message);
                }, 400);
            }, 2000);
        } else {
            addNoticeText(message);
        }
    }

    function addNoticeText(message)
    {
        notification.find('p').text(message);
        notification.removeClass('animation-out').addClass('notification-in');
        setTimeout(function(){
            notification.removeClass('notification-in').addClass('animation-out');
        }, 3000);
    }

    jQuery('.ba-tooltip').each(function(){
        jQuery(this).parent().children().first().on('mouseenter', function(){
            var coord = this.getBoundingClientRect(),
                top = coord.top,
                data = jQuery(this).parent().find('.ba-tooltip').html(),
                center = (coord.right - coord.left) / 2;
                className = jQuery(this).parent().find('.ba-tooltip')[0].className;
            center = coord.left + center;
            if (jQuery(this).parent().find('.ba-tooltip').hasClass('ba-bottom')) {
                top = coord.bottom;
            }
            jQuery('body').append('<span class="'+className+'">'+data+'</span>');
             var tooltip = jQuery('body > .ba-tooltip').last(),
                width = tooltip.outerWidth(),
                height = tooltip.outerHeight();
            if (tooltip.hasClass('ba-top') || tooltip.hasClass('ba-help')) {
                top -= (15 + height);
                center -= (width / 2)
            }
            if (tooltip.hasClass('ba-bottom')) {
                top += 10;
                center -= (width / 2)
            }
            tooltip.css({
                'top' : top+'px',
                'left' : center+'px'
            });
        }).on('mouseleave', function(){
            var tooltip = jQuery('body').find(' > .ba-tooltip');
            tooltip.addClass('tooltip-hidden');
            setTimeout(function(){
                tooltip.remove();
            }, 500);
        });
    });

    jQuery('.ba-custom-select > i, div.ba-custom-select input').on('click', function(event){
        event.stopPropagation()
        var $this = jQuery(this),
            parent = $this.parent();
        jQuery('.visible-select').removeClass('visible-select');
        parent.find('ul').addClass('visible-select');
        parent.find('li').one('click', function(){
            var text = jQuery.trim(jQuery(this).text()),
                val = jQuery(this).attr('data-value');
            parent.find('input[type="text"]').val(text);
            parent.find('input[type="hidden"]').val(val).trigger('change');
        });
        parent.trigger('show');
        setTimeout(function(){
            jQuery('body').one('click', function(){
                jQuery('.visible-select').parent().trigger('customHide');
                jQuery('.visible-select').removeClass('visible-select');
            });
        }, 50);
    });

    jQuery('div.ba-custom-select').on('show', function(){
        var $this = jQuery(this),
            ul = $this.find('ul'),
            value = $this.find('input[type="hidden"]').val();
        ul.find('i').remove();
        ul.find('.selected').removeClass('selected');
        ul.find('li[data-value="'+value+'"]').addClass('selected').prepend('<i class="zmdi zmdi-check"></i>');
    });

    if (jQuery('div.ba-login-dialog').length > 0) {
        jQuery('div.ba-create-page').hide();
        jQuery('.ba-login-dialog input').on('keydown', function(e){
            if (e.keyCode == 13) {
                login();
            }
        });
        jQuery('.login-button').on('click', function(event){
            event.preventDefault();
            login();
        });
    }

    function login()
    {
        if (loginclk) {
            loginclk = false;
            var login = jQuery('.ba-username').val(),
                pas =  jQuery('.ba-password').val();
            jQuery.ajax({
                type : "POST",
                dataType : 'text',
                url : "index.php?option=com_gridbox&task=gridbox.login",
                data : {
                    ba_login : login,
                    ba_password : pas,
                },
                complete : function(msg){
                    if (msg.responseText) {
                        showNotice(msg.responseText);
                    } else if (jQuery('.ba-create-page').length > 0) {
                        jQuery('div.ba-login-dialog').addClass('ba-login-dialog-out');
                        setTimeout(function(){
                            jQuery('div.ba-login-dialog').removeClass('ba-login-dialog-out').hide();
                            jQuery('div.ba-create-page').show();
                        }, 300);
                        
                    } else {
                        window.location.href = window.location.href
                    }
                    loginclk = true;
                }
            });
        }
    }

    if (jQuery('.ba-create-page').length > 0) {
        jQuery('#ba-title').on('input', function(){
            var val = this.value.trim(),
                flag = true;
            if (jQuery('.blog-category-select').length > 0) {
                if (!document.getElementById('category').value.trim()) {
                    flag = false;
                }
            }
            if (val && flag) {
                jQuery('.create-button').addClass('active-button');
            } else {
                jQuery('.create-button').removeClass('active-button');
            }
        });

        jQuery('#category').on('change', function(){
            var val = this.value.trim(),
                value  = document.getElementById('ba-title').value.trim();
            if (val && value) {
                jQuery('.create-button').addClass('active-button');
            } else {
                jQuery('.create-button').removeClass('active-button');
            }
        });

        jQuery('.create-button').on('click', function(event){
            event.preventDefault();
            if (jQuery(this).hasClass('active-button')) {
                jQuery.ajax({
                    type : "POST",
                    dataType : 'text',
                    url : "index.php?option=com_gridbox&task=gridbox.createPage",
                    data : {
                        app_id : jQuery('#app_id').val(),
                        category : jQuery('#category').val(),
                        'ba-title' : jQuery('#ba-title').val(),
                        page_theme : jQuery('.page-theme').val(),
                    },
                    complete : function(msg){
                        window.location.href = window.location.href+msg.responseText;
                    }
                });
            }
        });
    }
});
</script>
<div id="ba-notification" class="ba-alert">
    <i class="zmdi zmdi-close"></i>
    <h4><?php echo JText::_('ERROR'); ?></h4>
    <p></p>
</div>
<div id='login-modal' class='ba-modal-sm modal ba-modal-dialog in'>
    <div class='modal-body'>
<?php
if (!JFactory::getUser()->authorise('core.edit', 'com_gridbox')) {
?>
        <div class="ba-login-dialog">
            <div class="ba-header-content">
                <h3 class='ba-modal-title'>
                    <?php echo JText::_('LOGIN'); ?>
                </h3>
                <label class="ba-help-icon">
                    <i class="zmdi zmdi-help"></i>
                    <span class="ba-tooltip ba-help">
                        <?php echo JText::_('LOGIN_TOOLTIP'); ?>
                    </span>
                </label>
            </div>
            <div class="ba-body-content">
                <div class="ba-input-lg">
                    <input class='ba-username reset-input-margin' type='text' placeholder="<?php echo JText::_('USERNAME'); ?>">
                    <span class="focus-underline"></span>
                </div>
                <div class="ba-input-lg">
                    <input class='ba-password' type='password' placeholder="<?php echo JText::_('PASSWORD'); ?>">
                    <span class="focus-underline"></span>
                </div>
            </div>
            <div class="ba-footer-content">
                <a href="#" class="ba-btn-primary login-button active-button">
                    <?php echo JText::_('NEXT'); ?>
                </a>
            </div>
        </div>
<?php
}
if (empty($this->item->title)) {
?>
        <div class="ba-create-page">
            <div class="ba-header-content">
                <h3 class='ba-modal-title'>
                    <?php echo JText::_('NEW_PAGE'); ?>
                </h3>
            </div>
            <div class="ba-body-content">
                <form name="create_form" id="create_form" method='post'>
                    <div class="ba-input-lg">
                        <input class="reset-input-margin" name='ba-title' type='text' id='ba-title'
                            placeholder="<?php echo JText::_('PAGE_TITLE'); ?>">
                        <span class="focus-underline"></span>
                    </div class="ba-input-lg">
<?php
                if ($type == 'blog' && empty($this->category)) {
?>
                    <div class="ba-custom-select blog-category-select">
                        <input class="reset-input-margin" readonly onfocus="this.blur()"
                            placeholder="<?php echo JText::_('CATEGORY') ?>" type="text">
                        <input type="hidden" id="category" value="">
                        <ul>
                            <?php
                            foreach ($categories as $category) {
                                $str = '<li data-value="'.$category->id.'">';
                                $str .= $category->title.'</li>';
                                echo $str;
                            }
                            ?>
                        </ul>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
<?php
                }
?>
                    <div class="ba-custom-select blog-theme-select">
                        <input readonly onfocus="this.blur()" value="<?php echo $this->themes[0]->title; ?>" type="text">
                        <input type="hidden" name="page_theme" class="page-theme" value="<?php echo $this->themes[0]->id; ?>">
                        <ul>
                            <?php
                            foreach ($this->themes as $theme) {
                                $str = '<li data-value="'.$theme->id.'">';
                                $str .= $theme->title.'</li>';
                                echo $str;
                            }
                            ?>
                        </ul>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                    <input type="hidden" id="app_id" value="<?php echo $this->app; ?>">
<?php
                    if ($type == 'blog' && empty($this->category)) {} else {
?>
                    <input type="hidden" id="category" value="<?php echo $this->category; ?>">
<?php
                    }
?>
                </form>
            </div>
            <div class="ba-footer-content">
                <a href="#" class="ba-btn-primary create-button disable-button">
                    <?php echo JText::_('NEXT'); ?>
                </a>
            </div>
        </div>
<?php 
        }
?>
    </div>
</div>