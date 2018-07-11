/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

!function ($) {
    
    var slideset = function (element, options) {
        this.parent = $(element);
        this.options = options;
        this.options.count *= 1;
        this.currentIndex = 0;
        this.childrens = this.parent.find('.slideshow-content').children();
        this.startCoords = {};
        this.endCoords = {};
        this.allowSlide = true;
        this.flag = true;
    }
    
    slideset.prototype = {
        init : function(){
            var $this = this,
                dots = this.parent.find('.ba-slideset-dots');
            dots.empty();
            if (this.options.pause) {
                this.parent.on('mouseenter.slideset', $.proxy(this.pause, this)).on('mouseleave.slideset', $.proxy(this.cycle, this));
            }
            if (this.options.mode == 'set') {
                this.childCount = Math.floor(this.childrens.length / this.options.count);
                if (this.childCount < this.childrens.length / this.options.count) {
                    this.childCount++;
                }
            } else {
                this.lastActive = new Array();
                this.childCount = this.childrens.length;
            }
            for (var i = 0; i < this.childCount; i++) {
                dots.append('<div data-ba-slide-to="'+i+'" class="zmdi zmdi-circle"></div>');
            }
            this.parent.find('.active').removeClass('active');
            for (var i = 0; i < this.options.count; i++) {
                $(this.childrens[i]).addClass('active');
            }
            this.parent.find('.active').first();
            $('.ba-slideset-dots .active').removeClass('active');
            this.clearAnimation();
            $('.ba-slideset-dots [data-ba-slide-to="'+this.currentIndex+'"]').addClass('active');
            this.setLeft();
            this.setHeight();
            this.cycle();
            this.parent.addClass('slideset-loaded');
            this.parent.find('[data-ba-slide-to]').on('click.slideset', function(event){
                event.preventDefault();
                var index = $(this).attr('data-ba-slide-to');
                $this.to(index);
            });
            this.parent.find('[data-slide]').on('click.slideset',  function(event){
                event.preventDefault();
                var action = $(this).attr('data-slide');
                $this[action]();
            });
            this.parent.on('touchstart.slideset', function(event){
                $this.endCoords = event.originalEvent.targetTouches[0];
                $this.startCoords = event.originalEvent.targetTouches[0];
            });
            this.parent.on('touchmove.slideset', function(event){
                $this.endCoords = event.originalEvent.targetTouches[0];
            });
            this.parent.on('touchend.slideset', function(event){
                var hDistance = $this.endCoords.pageX - $this.startCoords.pageX,
                    xabs = Math.abs($this.endCoords.pageX - $this.startCoords.pageX),
                    yabs = Math.abs($this.endCoords.pageY - $this.startCoords.pageY);
                if(hDistance >= 100 && xabs >= yabs * 2) {
                    $this.parent.find('[data-slide="prev"]').trigger('click');
                } else if (hDistance <= -100 && xabs >= yabs * 2) {
                    $this.parent.find('[data-slide="next"]').trigger('click');
                }
            });
        },
        cycle: function (event){
            if (this.options.autoplay == 1) {
                this.flag = true;
                if (this.interval) {
                    clearInterval(this.interval);
                }
                this.interval = setInterval($.proxy(this.slide, this), this.options.delay);
                return this;
            }
        },
        pause: function() {
            if (this.interval) {
                clearInterval(this.interval);
            }
            this.interval = null;
            this.flag = false;
        },
        delete: function(){
            clearInterval(this.interval);
            this.interval = null;
            this.clearAnimation();
            this.parent.off('mouseenter.slideset mouseleave.slideset');
            this.parent.find('[data-slide]').off('click.slideset');
            this.parent.find('[data-ba-slide-to]').off('click.slideset');
            this.parent.off('touchstart.slideset touchmove.slideset touchend.slideset');
        },
        to: function (pos){
            pos = pos*1;
            if (pos != this.currentIndex) {
                if (this.interval) {
                    clearInterval(this.interval);
                }
                this.clearAnimation();
                if (this.options.mode == 'set') {
                    var flag,
                        nFlag;
                    if (this.currentIndex == 0 && pos == this.childCount - 1) {
                            flag = 'left-animation';
                            nFlag = 'prev-animation';
                        } else if (this.currentIndex == this.childCount - 1 && pos == 0) {
                            flag = 'right-animation';
                            nFlag = 'next-animation';
                        } else if (this.currentIndex < pos) {
                            flag = 'right-animation';
                            nFlag = 'next-animation';
                        } else {
                            flag = 'left-animation';
                            nFlag = 'prev-animation';
                        }
                    this.parent.find('.ba-slideset-dots .active').removeClass('active');
                    this.parent.find('li.active').removeClass('active').addClass(nFlag);
                    for (var i = pos * this.options.count; i < pos * this.options.count + this.options.count; i++) {
                        $(this.childrens[i]).addClass('active').addClass(flag);
                    }
                    this.setLeft();
                } else {
                    this.parent.find('.ba-slideset-dots .active').removeClass('active');
                    this.lastActive = this.parent.find('li.active');
                    this.parent.find('li.active').removeClass('active');
                    if (this.childCount - pos < this.options.count) {
                        var ind = 0,
                            count = this.options.count,
                            margin = this.options.gutter ? 30 : 0;
                        for (var i = pos; i < this.childCount; i++) {
                            $(this.childrens[i]).addClass('active').css({
                                'left' : 'calc(((100% - '+(margin * (count - 1))+'px)/'+count+')*'+ind+' + '+margin+'px*'+ind+')'
                            });
                            ind++;
                        }
                        for (var i = 0; i < this.options.count - (this.childCount - pos); i++) {
                            $(this.childrens[i]).addClass('active').css({
                                'left' : 'calc(((100% - '+(margin * (count - 1))+'px)/'+count+')*'+ind+' + '+margin+'px*'+ind+')'
                            });
                            ind++;
                        }
                    } else {
                        for (var i = pos; i < pos + this.options.count; i++) {
                            $(this.childrens[i]).addClass('active');
                            this.setLeft();
                        }
                    }
                    var array = this.parent.find('.active');
                    for (var i = 0; i < this.lastActive.length; i++) {
                        if ($.inArray(this.lastActive[i], array) < 0) {
                            if (this.currentIndex == 0 && pos == this.childCount - 1) {
                                $(this.lastActive[i]).addClass('left-animation');
                            } else if (this.currentIndex == this.childCount - 1 && pos == 0) {
                                $(this.lastActive[i]).addClass('right-animation');
                            } else if (this.currentIndex < pos) {
                                $(this.lastActive[i]).addClass('right-animation');
                            } else {
                                $(this.lastActive[i]).addClass('left-animation');
                            }
                        }
                        if ($.inArray(array[i], this.lastActive) < 0) {
                            if (this.currentIndex == 0 && pos == this.childCount - 1) {
                                $(array[i]).addClass('prev-animation');
                            } else if (this.currentIndex == this.childCount - 1 && pos == 0) {
                                $(array[i]).addClass('next-animation');
                            } else if (this.currentIndex < pos) {
                                $(array[i]).addClass('next-animation');
                            } else {
                                $(array[i]).addClass('prev-animation');
                            }
                        }
                    }
                }
                var parent = this.parent,
                    that = this;
                setTimeout(function(){
                    that.clearAnimation();
                    that.allowSlide = true;
                }, 700);
                this.setHeight();
                this.currentIndex = pos;
                this.parent.find('.ba-slideset-dots [data-ba-slide-to="'+this.currentIndex+'"]').addClass('active');
                if (this.flag) {
                    this.cycle();
                }
            }
        },
        clearAnimation: function(){
            this.parent.find('.left-animation').removeClass('left-animation');
            this.parent.find('.right-animation').removeClass('right-animation');
            this.parent.find('.prev-animation').removeClass('prev-animation');
            this.parent.find('.next-animation').removeClass('next-animation');
        },
        setHeight: function(){
            var height = 0;
            this.parent.find('.active').each(function(){
                if ($(this).height() > height) {
                    height = $(this).height();
                }
            });
            this.parent.find('.slideshow-content').height(height);
        },
        next : function(){
            if (this.allowSlide) {
                var pos = this.currentIndex + 1;
                if (pos > this.childCount -1) {
                    pos = 0;
                }
                this.to(pos);
                this.allowSlide = false;
            }
        },
        prev : function(){
            if (this.allowSlide) {
                var pos = this.currentIndex - 1;
                if (pos < 0) {
                    pos = this.childCount - 1;
                }
                this.to(pos);
                this.allowSlide = false;
            }
        },
        setLeft: function(){
            var count = this.options.count,
                margin = this.options.gutter ? 30 : 0;
            this.parent.find('li.active').each(function(ind, el){
                $(this).css({
                    'left' : 'calc(((100% - '+(margin * (count - 1))+'px)/'+count+')*'+ind+' + '+margin+'px*'+ind+')'
                });
            });
        },
        slide: function (){
            var pos = this.currentIndex + 1;
            if (pos > this.childCount -1) {
                pos = 0;
            }
            this.to(pos);
        }
    }
    
    $.fn.slideset = function(option){
        return this.each(function(){
            var $this = $(this),
                data = $this.data('slideset'),
                options = $.extend({}, $.fn.slideset.defaults, typeof option == 'object' && option);
            if (data) {
                data.delete();
                $this.removeData();
            }
            $this.data('slideset', (data = new slideset(this, options)));
            data.init();
        });
    }
    
    $.fn.slideset.defaults = {
        delay: 3000,
        autoplay: true,
        pause: false,
        mode: 'set',
        gutter: true,
        count: 3
    }
}(window.$g ? window.$g : window.jQuery);