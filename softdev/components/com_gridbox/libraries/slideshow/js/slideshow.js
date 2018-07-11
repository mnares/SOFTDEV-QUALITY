/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

!function ($) {
    
    var slideshow = function(element, options) {
        this.parent = $(element);
        this.dots = this.parent.find('.ba-slideshow-dots');
        this.options = options;
        this.startCoords = {};
        this.endCoords = {};
        this.flag = true;
    }
    
    slideshow.prototype = {
        init : function() {
            var $this = this;
            if (this.options.pause) {
                this.parent.on('mouseenter', $.proxy(this.pause, this))
                           .on('mouseleave', $.proxy(this.cycle, this));
            }
            if (this.options.navigation && this.dots.find('> div').length > 1) {
                this.setNavigation();
            }
            this.dots.empty();
            for (var i = 0; i < this.parent.find('.slideshow-content').children().length; i++) {
                this.dots.append('<div data-ba-slide-to="'+i+'" class="zmdi zmdi-circle"></div>');
            }
            this.parent.find('.active').removeClass('active');
            this.parent.find('.item').first().addClass('active');
            this.dots.find(' > div').first().addClass('active');
            this.cycle();
            this.parent.find('[data-ba-slide-to]').on('click.slideshow', function(event){
                event.preventDefault();
                var index = $(this).attr('data-ba-slide-to');
                $this.to(index);
            });
            this.parent.find('[data-slide]').on('click.slideshow',  function(event){
                event.preventDefault();
                var action = $(this).attr('data-slide');
                $this[action]();
            });            
            this.parent.on('touchstart.slideshow', function(event){
                $this.endCoords = event.originalEvent.targetTouches[0];
                $this.startCoords = event.originalEvent.targetTouches[0];
            });
            this.parent.on('touchmove.slideshow', function(event){
                $this.endCoords = event.originalEvent.targetTouches[0];
            });
            this.parent.on('touchend.slideshow', function(event){
                var hDistance = $this.endCoords.pageX - $this.startCoords.pageX,
                    xabs = Math.abs($this.endCoords.pageX - $this.startCoords.pageX),
                    yabs = Math.abs($this.endCoords.pageY - $this.startCoords.pageY);
                if(hDistance >= 100 && xabs >= yabs * 2) {
                    $this.parent.find('[data-slide="prev"]').trigger('click');
                } else if (hDistance <= -100 && xabs >= yabs * 2) {
                    $this.parent.find('[data-slide="next"]').trigger('click');
                }
            });
            var event = $.Event('slide', {
                prevItem : null,
                currentItem : this.parent.find('.item').first()[0]
            });
            this.parent.trigger(event);
        },
        cycle: function() {
            if (this.options.autoplay) {
                this.flag = true;
                if (this.interval) {
                    clearInterval(this.interval);
                }
                this.interval = setInterval($.proxy(this.next, this), this.options.delay);
                return this;
            }
        },
        setNavigation: function(){
            this.parent.addClass('navigation-style');
            var active = this.getActiveIndex(),
                items = this.parent.find('.item'),
                ind = active - 1,
                div = document.createElement('div'),
                h3 = document.createElement('h3'),
                img;
            if (ind < 0 ) {
                ind = items.length - 1;
            }
            img = $(items[ind]).find('.ba-slide-img').attr('data-img-url');
            this.parent.find('.navigation-prev-content, .navigation-next-content').remove();
            if (img) {
                $(h3).css(this.options.style);
                $(h3).text($(items[ind]).find('.ba-slideshow-title').text());
                div.className = 'navigation-prev-content';
                div.style.backgroundImage = 'url('+img+')';
                div.appendChild(h3);
                this.parent.find('.slideshow-btn-prev').after(div);
            }
            ind = active * 1 + 1;
            if (ind == items.length) {
                ind = 0;
            }
            img = $(items[ind]).find('.ba-slide-img').attr('data-img-url');
            if (img) {
                div = document.createElement('div');
                h3 = document.createElement('h3')
                div.className = 'navigation-next-content';
                div.style.backgroundImage = 'url('+img+')';
                $(h3).css(this.options.style);
                $(h3).text($(items[ind]).find('.ba-slideshow-title').text());
                div.appendChild(h3);
                this.parent.find('.slideshow-btn-next').after(div);
            }
            var $this = this;
            $('.navigation-prev-content').on('click', function(){
                $this.parent.find('.slideshow-btn-prev').trigger('click');
            });
            $('.navigation-next-content').on('click', function(){
                $this.parent.find('.slideshow-btn-next').trigger('click');
            });
        },
        delete: function(){
            if (this.interval) {
                clearInterval(this.interval);
            }
            this.interval = null;
            this.parent.find('[data-slide]').off('click.slideshow');
            this.parent.find('[data-ba-slide-to]').off('click.slideshow');
            this.parent.off('touchstart.slideshow touchmove.slideshow touchend.slideshow');
            this.parent.removeClass('navigation-style');
            this.parent.find('.navigation-prev-content, .navigation-next-content').remove();
            this.parent.find('.ba-next').removeClass('ba-next');
            this.parent.find('.ba-prev').removeClass('ba-prev');
            this.parent.find('.ba-left').removeClass('ba-left');
            this.parent.find('.ba-right').removeClass('ba-right');
            this.parent.find('.burns-out').removeClass('burns-out');
            this.parent.off('mouseenter mouseleave');
        },
        getActiveIndex: function () {
            this.active = this.parent.find('.item.active');
            this.items = this.active.parent().find('li');
            return this.items.index(this.active);
        },
        to: function (pos) {
            var activeIndex = this.getActiveIndex();
            if (activeIndex == pos) {
                return this.cycle();
            }
            if (this.interval) {
                clearInterval(this.interval);
            }
            return this.slide(pos > activeIndex ? 'next' : 'prev', $(this.items[pos]));
        },
        next: function () {
            if (this.interval) {
                clearInterval(this.interval);
            }
            return this.slide('next');
        },
        pause: function() {
            if (this.interval) {
                clearInterval(this.interval);
            }
            this.interval = null;
            this.flag = false;
        },
        prev: function () {
            if (this.interval) {
                clearInterval(this.interval);
            }
            return this.slide('prev');
        },
        slide: function (type, next) {
            var active = this.parent.find('.item.active'),
                $next = next || active[type](),
                fallback  = type == 'next' ? 'first' : 'last',
                event,
                parent = this.parent;
            this.parent.removeClass('first-load-slideshow');
            if ($next.length) {
                $next = $next;
            } else {
                $next = parent.find('.item')[fallback]();
            }
            parent.find('.select-animation').removeClass('select-animation');
            event = $.Event('slide', {
                prevItem : active[0],
                currentItem : $next[0]
            });
            if ($next.hasClass('active')) {
                return;
            }
            parent.find('.ba-next').removeClass('ba-next');
            parent.find('.ba-prev').removeClass('ba-prev');
            parent.find('.ba-left').removeClass('ba-left');
            parent.find('.ba-right').removeClass('ba-right');
            if (fallback == 'first') {
                active.addClass('ba-next').addClass('burns-out');
                $next.addClass('ba-right');
            } else {
                active.addClass('ba-prev').addClass('burns-out');
                $next.addClass('ba-left');
            }
            setTimeout(function(){
                active.removeClass('burns-out');
            }, 600);
            active.removeClass('active');
            $next.addClass('active');
            this.dots.find('.active').removeClass('active');
            $(this.dots.children()[this.getActiveIndex()]).addClass('active');
            parent.trigger(event);
            if (this.flag) {
                this.cycle();
            }
            if (this.options.navigation && this.dots.find('> div').length > 1) {
                this.setNavigation();
            }
            return this;
        }
    }
    
    $.fn.slideshow = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('slideshow'),
                options = $.extend({}, $.fn.slideshow.defaults, typeof option == 'object' && option);
            if (data) {
                data.delete();
                $this.removeData();
            }
            $this.data('slideshow', (data = new slideshow(this, options)));
            data.init();
        });
    }
    
    $.fn.slideshow.defaults = {
        delay : 3000,
        autoplay : true,
        pause : false,
        navigation : false
    }
    
    $.fn.slideshow.Constructor = slideshow;

}(window.$g ? window.$g : window.jQuery);