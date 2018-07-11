/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

(function($){
    $(document).on('ready', function(){
        var delay,
            notification = window.parent.document.getElementById('ba-notification'),
            click = true,
            files = new Array();

        $('body').addClass('component');

        function initTooltip(element)
        {
            element.off('mouseenter mouseleave').on('mouseenter', function(){
                var tooltip = element.find('.ba-tooltip'),
                    coord = element[0].getBoundingClientRect(),
                    top = coord.top,
                    data = tooltip.html(),
                    center = (coord.right - coord.left) / 2;
                    className = tooltip[0].className,
                    span = document.createElement('span');
                center = coord.left + center;
                if (tooltip.hasClass('ba-bottom')) {
                    top = coord.bottom;
                }
                top += 80;
                span.className = className;
                span.innerHTML = data;
                span.addEventListener('mousedown', function(event){
                    event.stopPropagation();
                });
                window.parent.document.body.appendChild(span);
                var tooltip = $(span),
                    width = tooltip.outerWidth(),
                    height = tooltip.outerHeight(),
                    margin = window.parent.document.getElementById('fonts-editor-dialog').getBoundingClientRect();
                if (tooltip.hasClass('ba-top') || tooltip.hasClass('ba-help')
                    || tooltip.hasClass('tooltip-delay') || tooltip.hasClass('add-section-tooltip')) {
                    top -= (5 + height);
                    center -= (width / 2);
                    span.style.marginTop = (margin.top - 51)+'px';
                }
                if (tooltip.hasClass('ba-bottom')) {
                    top += 10;
                    center -= (width / 2);
                    span.style.marginTop = (margin.top - 29)+'px';
                }
                span.style.top = top+'px';
                span.style.left = center+'px';
                span.style.marginLeft = margin.left+'px';
                
            }).on('mouseleave', function(){
                var tooltip = window.parent.document.querySelectorAll('body > .ba-tooltip');
                if (tooltip) {
                    $(tooltip).remove();
                }
            });
        }

        function deleteFont()
        {
            $('.font-checkbox input').on('change', function(){
                var checked = false;
                $('.font-checkbox input').each(function(){
                    if (this.checked) {
                        checked = true;
                        return false;
                    }
                });
                if (checked) {
                    $('.delete-fonts').removeClass('disable-button');
                } else {
                    $('.delete-fonts').addClass('disable-button');
                }
            });
        }

        function refreshFontsList()
        {
            $.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=fonts.getFonts",
                complete: function(msg){
                    window.parent.fontsLibrary = JSON.parse(msg.responseText);
                }
            });
        }

        function previewAction()
        {
            $('.font-preview-text').on('input', function(){
                var $this = this,
                    text = this.innerText;
                clearTimeout(delay);
                delay = setTimeout(function(){
                    $('.font-preview-text').not($this).text(text);
                }, 300);
            });
        }

        $('.ba-tooltip').each(function(){
            initTooltip($(this).parent());
        });

        $('.ba-custom-select > i, div.ba-custom-select > input').on('mousedown', function(event){
            event.stopPropagation();
            var $this = $(this),
                parent = $this.closest('.ba-custom-select');
            $('.visible-select').removeClass('visible-select');
            parent.find('ul').addClass('visible-select').off('mousedown').on('mousedown', 'li', function(e){
                var text = $.trim($(this).text()),
                    val = $(this).attr('data-value');
                parent.find('> input[type="text"]').val(text);
                parent.find('> input[type="hidden"]').val(val).trigger('change');
            });
            parent.trigger('show');
        });

        $('body').on('mousedown', function(){
            $('.visible-select').parent().trigger('customHide');
            $('.visible-select').removeClass('visible-select');
        });

        $('.modal').on('hide', function(){
            $(this).addClass('ba-modal-close');
            setTimeout(function(){
                $('.ba-modal-close').removeClass('ba-modal-close');
            }, 500);
        });

        $('input.filter-search').on('input', function(){
            var search = this.value.toLowerCase();
            clearTimeout(delay);
            delay = setTimeout(function(){
                if (!search) {
                    $('.ba-options-group').show();
                } else {
                    $('.ba-options-group').each(function(){
                        var font = this.dataset.font.toLowerCase();
                        if (font.indexOf(search) < 0) {
                            this.style.display = 'none';
                        } else {
                            this.style.display = 'block';
                        }
                    });
                }
            }, 300);
        });

        previewAction();
        deleteFont();

        $('.font-search').on('input', function(){
            var search = this.value.toLowerCase();
            clearTimeout(delay);
            delay = setTimeout(function(){
                if (!search) {
                    $('div.fonts-select li[data-value]').show();
                } else {
                    $('div.fonts-select li[data-value]').each(function(){
                        var font = this.dataset.value.toLowerCase();
                        if (font.indexOf(search) < 0) {
                            this.style.display = 'none';
                        } else {
                            this.style.display = 'block';
                        }
                    });
                }
            }, 300);
        });

        $('div.fonts-select').on('customHide', function(){
            var font = $(this).find('input[type="hidden"]').val(),
                styles = $(this).find('li[data-value="'+font+'"]')[0],
                str = '';
            if (styles) {
                styles = styles.dataset.style;
                styles = JSON.parse(styles);
                for (var i = 0; i < styles.length; i++) {
                    if (styles[i] == 'italic') {
                        styles[i] = '400italic';
                    }
                    str += '<li data-value="'+styles[i].replace('talic', '')+'">';
                    str +=styles[i].replace('italic', ' Italic')+'</li>';
                }
                $('.fonts-style-select ul').html(str);
                $('.fonts-style-select').addClass('active');
                $('.install-font').removeClass('active-button');
            }
            $('.fonts-style-select input').val('');
        });

        $('div.fonts-style-select').on('customHide', function(){
            var font = $(this).find('input[type="hidden"]').val(),
                style = $(this).find('li[data-value="'+font+'"]')[0];
            if (style) {
                $('.install-font').addClass('active-button');
            }
        });

        $('.install-font').on('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            var family = $('#font-family').val(),
                style = $('#font-style').val();
            if (family && style && click) {
                click = false;
                $.ajax({
                    type:"POST",
                    dataType:'text',
                    url:"index.php?option=com_gridbox&task=fonts.addFont",
                    data:{
                        font_family : family,
                        font_style : style
                    },
                    complete: function(msg){
                        var obj = JSON.parse(msg.responseText),
                            link;
                        window.parent.app.showNotice(obj.msg, obj.type);
                        click = true;
                        if (obj.type != 'ba-alert') {
                            var file = document.createElement('link'),
                                text = $('.font-preview-text').first().text();
                            link = 'https://fonts.googleapis.com/css?family='+family+':'+style;
                            link += '&subset=latin,cyrillic,greek,latin-ext,greek-ext,vietnamese,cyrillic-ext';
                            file.rel = 'stylesheet';
                            file.href = link;
                            document.getElementsByTagName('head')[0].appendChild(file);
                            $('.fonts-table').load(window.location.href+' #fonts-list', function(){
                                $('.font-preview-text').text(text);
                                $('#add-google-font-dialog').modal('hide');
                                previewAction();
                                deleteFont();
                                refreshFontsList();
                            });
                        }
                    }
                });
            }
        });

        $('div.ba-custom-select').on('show', function(){
            var $this = $(this),
                ul = $this.find('ul'),
                value = $this.find('input[type="hidden"]').val();
            ul.find('i').remove();
            ul.find('.selected').removeClass('selected');
            ul.find('li[data-value="'+value+'"]').addClass('selected').prepend('<i class="zmdi zmdi-check"></i>');
        });

        $('a.add-new-font').on('click', function(event){
            event.preventDefault();
            $('#add-google-font-dialog').modal();
        });

        $('a.add-custom-font').on('click', function(event){
            event.preventDefault();
            $('.custom-font-title, .custom-font-select').val('');
            $('.custom-fonts-style-select input, .custom-fonts-files').val('');
            $('.custom-fonts-style-select .selected i').remove();
            $('.custom-fonts-style-select .selected').removeClass('selected');
            $('.install-custom-font').removeClass('active-button');
            $('#add-custom-font-dialog').modal();
        });

        $('.custom-font-style, .custom-font-select').on('change', function(){
            $('.install-custom-font').addClass('active-button');
            $('.custom-font-title, .custom-font-select, .custom-font-style').each(function(){
                if (!this.value.trim()) {
                    $('.install-custom-font').removeClass('active-button');
                    return false;
                }
            });
        });

        $('.custom-font-title').on('input', function(){
            $('.install-custom-font').addClass('active-button');
            $('.custom-font-title, .custom-font-select, .custom-font-style').each(function(){
                if (!this.value.trim()) {
                    $('.install-custom-font').removeClass('active-button');
                    return false;
                }
            });
        });

        $('.custom-font-select').on('click', function(){
            $('.custom-fonts-files').trigger('click');
        });

        $('.custom-fonts-files').on('change', function(event){
            files = event.target.files;
            var types = new Array('woff', 'ttf', 'svg', 'eot', 'otf'),
                flag = true,
                nameStr = '';
            if (files.length != 0) {
                for (var i = 0; i < files.length; i++) {
                    if (nameStr) {
                        nameStr += ', ';
                    }
                    nameStr += files[i].name;
                    var name = files[i].name.split('.'),
                        ext = name[name.length - 1].toLowerCase();
                    if ($.inArray(ext, types) == -1) {
                        flag = false;
                        break;
                    }
                }
                if (flag) {
                    $('.custom-font-select').val(nameStr).trigger('change');
                } else {
                    $('.custom-font-select').val('').trigger('change');
                    window.parent.app.showNotice(window.parent.gridboxLanguage['NOT_SUPPORTED_FILE']);
                }
            }
        });

        $('.install-custom-font').on('click', function(event){
            event.preventDefault();
            if (this.classList.contains('active-button') && click) {
                click = false;
                var formData = new FormData(document.forms.custom_fonts),
                    XHR = new XMLHttpRequest(),
                    str = window.parent.gridboxLanguage['LOADING']+'<img src="';
                formData.append("font_family", $('.custom-font-title').val());
                formData.append("font_style", $('.custom-font-style').val());                
                str += 'components/com_gridbox/assets/images/reload.svg"></img>';
                window.parent.app.showNotice(str);
                XHR.onreadystatechange = function(e) {
                    if (XHR.readyState == 4) {
                        click = true;
                        var obj = JSON.parse(XHR.responseText);
                        if (obj.type != 'ba-alert') {
                            var text = $('.font-preview-text').first().text();
                            $('.fonts-table').load(window.location.href+' #fonts-list', function(){
                                window.parent.app.showNotice(obj.msg, obj.type);
                                $('.font-preview-text').text(text);
                                $('#add-custom-font-dialog').modal('hide');
                                previewAction();
                                deleteFont();
                                refreshFontsList();
                            });
                        } else {
                            window.parent.app.showNotice(obj.msg, obj.type);
                        }
                    }
                }
                XHR.open("POST", "index.php?option=com_gridbox&task=fonts.addCustomFont");
                XHR.send(formData);
            }
        });

        $('.refresh-fonts').on('click', function(){
            if (click) {
                click = false;
                $(this).find('i').addClass('zmdi-hc-spin');
                setTimeout(function(){
                    $('.refresh-fonts i').removeClass('zmdi-hc-spin');
                }, 1500);
                $.ajax({
                    type : "POST",
                    dataType : 'text',
                    url : "index.php?option=com_gridbox&task=fonts.refreshList",
                    complete : function(msg){
                        var obj = JSON.parse(msg.responseText);
                        window.parent.app.showNotice(obj.msg);
                        $('.fonts-select ul').html(obj.str);
                        click = true;
                    }
                });
            }
        });

        $('.delete-fonts').on('click', function(event){
            event.preventDefault();
            if (!this.classList.contains('disable-button')) {
                $("#delete-dialog").modal();
            }
        });

        $('#apply-delete').on('click', function(event){
            event.preventDefault();
            var array = new Array();
            $('.font-checkbox input').each(function(){
                if (this.checked) {
                    array.push(this.value);
                }
            });
            $.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=fonts.delete",
                data:{
                    font_id : array
                },
                complete: function(msg){
                    window.parent.app.showNotice(msg.responseText);
                    $("#delete-dialog").modal('hide');
                    $('.delete-fonts').addClass('disable-button');
                    $('.font-checkbox input').each(function(){
                        if (this.checked) {
                            $(this).closest('.ba-group-element').remove();
                        }
                    });
                    $('.ba-options-group').each(function(){
                        if ($(this).find('.ba-group-element').length == 0) {
                            $(this).remove();
                        }
                    });
                    refreshFontsList();
                }
            });
        });
    })
})(jQuery);