/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
console.log = function(){
    return false;
};
(function($){
    $(document).on('ready', function(){
        var delay,
            notification = window.parent.document.getElementById('ba-notification'),
            click = true;

        $('body').addClass('component');

        function initTooltip(element)
        {
            element.on('mouseenter', function(){
                var tooltip = element.find('.ba-tooltip'),
                    coord = window.parent.document.getElementById('icon-upload-dialog').getBoundingClientRect(),
                    data = tooltip.html(),
                    className = tooltip[0].className,
                    span = document.createElement('span'),
                    top = coord.top,
                    center = coord.right;
                span.className = className;
                span.innerHTML = data;
                span.addEventListener('mousedown', function(event){
                    event.stopPropagation();
                });
                window.parent.document.body.appendChild(span);
                var tooltip = $(span),
                    width = tooltip.outerWidth(),
                    height = tooltip.outerHeight();
                if (tooltip.hasClass('ba-top') || tooltip.hasClass('ba-help')
                    || tooltip.hasClass('tooltip-delay') || tooltip.hasClass('add-section-tooltip')) {
                    top -= (15 + height);
                    center -= (width / 2);
                }
                if (tooltip.hasClass('ba-bottom')) {
                    top += 10;
                    center -= (width / 2)
                }
                span.style.top = top+'px';
                span.style.left = center+'px';
            }).on('mouseleave', function(){
                var tooltip = window.parent.document.querySelectorAll('body > .ba-tooltip');
                if (tooltip) {
                    $(tooltip).remove();
                }
            });
        }

        function showNotice(message)
        {
            if (notification.className == 'notification-in') {
                setTimeout(function(){
                    notification.className = 'animation-out';
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
            notification.lastElementChild.innerText = message;
            notification.className = 'notification-in';
            setTimeout(function(){
                notification.className = 'animation-out';
            }, 3000);
        }

        $('.ba-tooltip').each(function(){
            initTooltip($(this).parent());
        });

        $('.tab-content').on('click', '.ba-group-element', function(){
            var icon = $(this).find('i')[0].className;
            window.parent.postMessage(icon, "*");
        });

        $('.search-wrapper input[type="text"]').on('input', function(){
            var $this = this;
            clearTimeout(delay);
            delay = setTimeout(function(){
                var search = $this.value.toLowerCase();
                if (!search) {
                    $('.row-fluid.tab-pane.active .ba-options-group > *').show();
                } else {
                    $('.row-fluid.tab-pane.active .ba-options-group').each(function(){
                        var count = 0,
                            elements = $(this).find('.ba-group-element');
                        elements.each(function(){
                            var value = $(this).find('span').text().toLowerCase();
                            value = $.trim(value);
                            if (value.indexOf(search) < 0) {
                                this.style.display = 'none';
                                count++;
                            } else {
                                this.style.display = 'block';
                            }
                        });
                        if (count == elements.length) {
                            $(this).find('p').hide();
                        } else {
                            $(this).find('p').show();
                        }
                    });
                }
            }, 300);
        });

        $('a[data-toggle="tab"]').on('shown', function(event){
            $(event.relatedTarget.hash).find('[style="display: none;"]').show();
            $('.search-wrapper input[type="text"]').val('');
        });
    });
})(jQuery);