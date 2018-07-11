/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var parseXml,
    app = {},
    $g = jQuery;
if (typeof window.DOMParser != "undefined") {
    parseXml = function(xmlStr) {
        return ( new window.DOMParser() ).parseFromString(xmlStr, "text/xml");
    };
} else if (typeof window.ActiveXObject != "undefined" &&
       new window.ActiveXObject("Microsoft.XMLDOM")) {
    parseXml = function(xmlStr) {
        var xmlDoc = new window.ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = "false";
        xmlDoc.loadXML(xmlStr);
        return xmlDoc;
    };
} else {
    throw new Error("No XML parser found");
}

function setCookie(name, value, options) {
    options = options || {};
    var expires = options.expires;
    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }
    value = encodeURIComponent(value);
    var updatedCookie = name + "=" + value;
    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }
    document.cookie = updatedCookie;
}

function deleteCookie(name)
{
    setCookie(name, "", {
        expires: -1
    });
}

function showNotice(message, className)
{
    if (!className) {
        className = '';
    }
    if (notification.hasClass('notification-in')) {
        setTimeout(function(){
            notification.removeClass('notification-in').addClass('animation-out');
            setTimeout(function(){
                addNoticeText(message, className);
            }, 400);
        }, 2000);
    } else {
        addNoticeText(message, className);
    }
}

function addNoticeText(message, className)
{
    var time = 3000;
    if (className) {
        time = 6000;
    }
    notification.find('p').html(message);
    notification.addClass(className).removeClass('animation-out').addClass('notification-in');
    setTimeout(function(){
        notification.removeClass('notification-in').addClass('animation-out');
        setTimeout(function(){
            notification.removeClass(className);
        }, 400);
    }, time);
}

function checkModule(module)
{
    if (!(module in app)) {
        loadModule(module);
    } else {
        app[module]();
    }
}

function loadModule(module)
{
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'components/com_gridbox/assets/js/'+module+'.js';
    document.getElementsByTagName('head')[0].appendChild(script);
}

function rangeAction(range, callback)
{
    var $this = $g(range),
        max = $this.attr('max') * 1,
        min = $this.attr('min') * 1,
        number = $this.next();
    number.on('input', function(){
        var value = this.value * 1;
        if (max && value > max) {
            this.value = value = max;
        }
        if (min && value < min) {
            value = min;
        }
        $this.val(value);
        setLinearWidth($this);
        callback(number);
    });
    $this.on('input', function(){
        var value = this.value * 1;
        number.val(value).trigger('input');
    });
}

function inputCallback(input)
{
    var callback = input.attr('data-callback');
    app[callback]();
}

function setLinearWidth(range)
{
    var max = range.attr('max') * 1,
        value = range.val() * 1,
        sx = ((Math.abs(value) * 100) / max) * range.width() / 100,
        linear = range.prev();
    if (value < 0) {
        linear.addClass('ba-mirror-liner');
    } else {
        linear.removeClass('ba-mirror-liner');
    }
    if (linear.hasClass('letter-spacing')) {
        sx = sx / 2;
    }
    linear.width(sx);
}

(function($){

    app.showSystemSettings = function(obj){
        obj.options = JSON.parse(obj.page_options);
        $g('.system-page-title').val(obj.title);
        $g('.system-page-theme-select input[type="hidden"]').val(obj.theme);
        $g('.system-page-theme-select input[type="text"]').val(obj.themeName);
        $g('#system-settings-dialog .ba-checkbox-parent').css('display', '');
        if ('enable_header' in obj.options) {
            $g('.page-enable-header').prop('checked', obj.options.enable_header);
        } else {
            $g('#system-settings-dialog .ba-checkbox-parent').hide();
        }
        $g('.apply-system-settings').removeClass('active-button').addClass('disabled-button').attr('data-id', obj.id);
        $g('#system-settings-dialog').modal();
    }

    function productTour(sidebar, tour)
    {
        $(tour+'.step-1').addClass('visible');
        var span = sidebar.pop();
        span.addClass('active-product-tour');
        $('body').append('<div class="saving-backdrop"></div>');
        $('.tour-parent .next').on('click', function(event){
            event.preventDefault();
            $(this).closest('.product-tour').removeClass('visible').next().addClass('visible');
            $('.active-product-tour').removeClass('active-product-tour');
            var span = sidebar.pop();
            span.addClass('active-product-tour');
        });
        $('.tour-parent .close, .tour-parent i.zmdi.zmdi-close').on('click', function(event){
            event.preventDefault();
            $(this).closest('.product-tour').removeClass('visible');
            $('.active-product-tour').removeClass('active-product-tour');
            $('.saving-backdrop').addClass('animation-out');
            $('.sidebar-tour').parent().addClass('animation-out');
            setTimeout(function(){
                $('.saving-backdrop').remove();
                $('.sidebar-tour').parent().removeClass('active-tour');
            }, 400);
        });
    }

    function displayLanguages()
    {
        if (window.gridboxApi) {
            gridboxApi.languages.forEach(function(el, ind){
                var str = '<div class="language-line"><span class="language-img"><img src="'+el.flag+'">';
                str += '</span><span class="language-title" data-key="'+ind+'">'+el.title;
                str += '</span><span class="language-code">'+el.code+'</span></div>';
                $('#languages-dialog .languages-wrapper').append(str);
            });
        }
    }

    function displayThemes()
    {
        var div = document.getElementById('upload-theme');
        if (window.gridboxApi && div) {
            var str = '';
            gridboxApi.themes.forEach(function(el, ind){
                str += '<label><div class="image-container"><img src="'+el.image+'">';
                str += '</div><input type="radio" name="theme-id" value="'+ind;
                str += '" class="ba-hide-element"><p><span>'+el.title+'</span></p></label>';
            });
            div.innerHTML = str;
        }
    }

    $.ajax({
        type : "POST",
        dataType : 'text',
        url : "index.php?option=com_gridbox&task=pages.checkSidebarTour&tmpl=component",
        success : function(msg){
            if (msg == 'true') {
                var sidebar = new Array();
                sidebar.push($('.ba-sidebar span.gridbox-themes'));
                sidebar.push($('.ba-sidebar span.trashed-items'));
                sidebar.push($('.ba-sidebar span.add-new-app'));
                sidebar.push($('.ba-sidebar span.single-pages'));
                $('.sidebar-tour').parent().addClass('active-tour');
                productTour(sidebar, '.sidebar-tour');
            }
        }
    });
    if ($('body').hasClass('view-blogs')) {
        $.ajax({
            type : "POST",
            dataType : 'text',
            url : "index.php?option=com_gridbox&task=pages.checkBlogsTour&tmpl=component",
            success : function(msg){
                if (msg == 'true') {
                    var sidebar = new Array();
                    sidebar.push($('.blog-icons .zmdi-desktop-windows'));
                    sidebar.push($('.ba-create-item.ba-uncategorised'));
                    sidebar.push($('a.create-categery'));
                    productTour(sidebar, '.blogs-tour');
                }
            }
        });
        $('#toolbar-download button').on('click', function(event){
            event.preventDefault();
            $('li.export-apps').hide();
            $('#export-dialog').modal();
            $('.apply-export').attr('data-export', 'app');
        });
    }

    $(window).on('load', function(){
        if ($('#not-default-dialog').length > 0) {
            return false;
        }
        $.ajax({
            type : "POST",
            dataType : 'text',
            url : "index.php?option=com_gridbox&task=pages.checkRate&tmpl=component",
            success : function(msg){
                if (msg == 'true') {
                    $('#love-gridbos-modal').modal();
                }
            }
        });
    });

    $(document).ready(function(){
        if (window.installedPlugins) {
            for (var key in window.gridboxApi.plugins) {
                for (var ind in window.gridboxApi.plugins[key]) {
                    if (installedPlugins[ind]) {
                        delete(window.gridboxApi.plugins[key][ind]);
                    }
                }
            }
            var del = true;
            for (var key in window.gridboxApi.plugins) {
                del = true;
                for (var ind in window.gridboxApi.plugins[key]) {
                    del = false;
                }
                if (del) {
                    delete(window.gridboxApi.plugins[key])
                }
            }
            del = true;
            for (var key in window.gridboxApi.plugins) {
                del = false;
                break;
            }
            if (del) {
                delete(window.gridboxApi.plugins)
            }
        }
        if (window.gridboxApi) {
            var version = document.getElementById('current-version').value.replace(/\./g, ''),
                newVersion = gridboxApi.version.replace(/\./g, '');
            version = version / Math.pow(10, version.length);
            newVersion = newVersion / Math.pow(10, newVersion.length);
            if (newVersion > version) {
                document.getElementById('ba-update-message').classList.add('active');
            }
        }
        displayLanguages();
        displayThemes();

        Joomla.submitbutton = function(task) {
            if (task == 'pages.export') {
                exportId = new Array();
                $('.table-striped tbody tr').find('input[type="checkbox"]').each(function(){
                    if ($(this).prop('checked')) {
                        var id = $(this).val();
                        exportId.push(id);
                    }
                });
                $('li.export-apps').hide();
                $('#export-dialog').modal();
                $('.apply-export').attr('data-export', 'pages');
            } else if (task == 'themes.delete') {
                var def = 0;
                $('#installed-themes-view label').each(function(){
                    if ($(this).find('input[type="checkbox"]').prop('checked')) {
                        def = $(this).find('p').attr('data-default');
                        if (def == 1) {
                            return false;
                        }
                    }
                });
                if (def == 1) {
                    $('#default-message-dialog').modal();
                } else {
                    deleteMode = 'array';
                    $('#delete-dialog').modal();
                }
                return false;
            } else if (task == 'blogs.addTrash' || task == 'pages.addTrash' || task == 'tags.delete') {
                deleteMode = task;
                $('#delete-dialog').modal();
            } else {
                Joomla.submitform(task);
            }
        }

        Joomla.submitform = function(task)
        {
            $('.status-td i').trigger('mouseleave');
            var form = document.getElementById("adminForm"),
                obj = {
                    'cid' : new Array(),
                    'meta_tags' : new Array()
                },
                src = form.action;
            if (!task) {
                form.submit();
                return false;
            }
            $(form).find('[name]').not('[name="cid[]"]').not('[name="meta_tags[]"]').each(function(){
                if (this.name == 'task') {
                    obj['task'] = task;
                } else if (this.type == 'radio' || this.type == 'checkbox') {
                    if ($(this).prop('checked')) {
                        obj[this.name] = this.value;
                    }
                } else {
                    obj[this.name] = this.value;
                }
            });
            obj.cid = [];
            $('[name="cid[]"]').each(function(){
                if ($(this).prop('checked')) {
                    obj.cid.push(this.value);
                }
            });
            obj.meta_tags = [];
            $('[name="meta_tags[]"] option').each(function(){
                obj.meta_tags.push(this.value);
            });
            $.ajax({
                type : "POST",
                dataType : 'text',
                url : src,
                data : obj,
                success: function(msg){
                    if (task == 'blogs.addCategory') {
                        var obj = JSON.parse(msg);
                        if ($('li.root li.active').length > 0) {
                            var blog = $('input[name="blog"]').val(),
                                category = $('li.root  li.active')[0].dataset.id;
                                setCookie('blog'+blog+'id'+category, 1);
                        }
                        $('#gridbox-container').load(form.action+'&category='+obj.id+' #gridbox-content', function(){
                            loadPage();
                            showNotice(obj.msg, '');
                        });
                    } else if (task == 'pages.addApp') {
                        var obj = JSON.parse(msg);
                        showNotice(obj.msg, '');
                        window.location.href = obj.url;
                    } else {
                        reloadPage(msg);
                    }
                }
            });
        }

        Joomla.orderTable = function() {
            table = document.getElementById("sortTable");
            direction = document.getElementById("directionTable");
            order = table.value;
            if (order != $('[name="filter_order"]').val()) {
                dirn = 'asc';
            } else {
                dirn = direction.value;
            }
            $('[name="filter_order"]').val(order);
            $('[name="filter_order_Dir"]').val(dirn);
            createAjax();
        }

        var update = jQuery('#update-data').val();
        update = JSON.parse(update);

        function getCSSrulesString()
        {
            var str = 'body.cke_editable';
            str += ' {font-family: sans-serif, Arial, Verdana, "Trebuchet MS";}';
            return str;
        }

        setInterval(function(){
            $.ajax({
                type : "POST",
                dataType : 'text',
                url : "index.php?option=com_gridbox&task=gridbox.getSession&tmpl=component",
                success : function(msg){
                }
            });
        }, 600000);

        var massage = '',
            sortableInd = $('.category-list ul.root-list .ba-category').length + 1,
            sortableAppInd = $('.ba-sidebar .sorting-container span.app').length + 1,
            pageId,
            item,
            CKE,
            submitTask = '',
            themeTitle = '',
            flag = true,
            uploadMode,
            exportId = new Array(),
            currentContext,
            deleteMode,
            moveTo = '',
            oldTitle = '';

        window.notification = $('#ba-notification');

        $g('.system-page-title').on('input', function(){
            if (this.value.trim()) {
                $g('.apply-system-settings').addClass('active-button').removeClass('disabled-button');
            } else {
                $g('.apply-system-settings').removeClass('active-button').addClass('disabled-button');
            }
        });

        $g('.page-enable-header').on('change', function(){
            $g('.apply-system-settings').addClass('active-button').removeClass('disabled-button');
        });

        $g('.system-page-theme-select').on('customAction', function(){
            $g('.apply-system-settings').addClass('active-button').removeClass('disabled-button');
        });

        $g('.apply-system-settings').on('click', function(event){
            event.preventDefault();
            var options = {};
            if ($g('.page-enable-header').closest('.ba-checkbox-parent')[0].style.display != 'none') {
                options.enable_header = $g('.page-enable-header').prop('checked');
            }
            if (this.classList.contains('active-button')) {
                var data = {
                    title: $g('.system-page-title').val().trim(),
                    theme: $g('.system-page-theme-select input[type="hidden"]').val(),
                    options: JSON.stringify(options),
                    id: this.dataset.id
                }
                $.ajax({
                    type : "POST",
                    dataType : 'text',
                    url : 'index.php?option=com_gridbox&task=system.applySettings',
                    data : data,
                    success: function(msg){
                        reloadPage(msg);
                        $g('#system-settings-dialog').modal('hide');
                    }
                });
            }
        })

        $g('.ba-range-wrapper input[type="range"]').each(function(){
            rangeAction(this, inputCallback);
        });

        $g('.ba-settings-toolbar input[type="number"]').on('input', function(){
            inputCallback($g(this));
        });

        notification.find('.zmdi.zmdi-close').on('click', function(){
            notification.removeClass('notification-in').addClass('animation-out');
        });

        $('.single-pages a, .trashed-items a, .gridbox-themes a').on('click', function(event){
            if ($(this).closest('span').hasClass('active-product-tour')) {
                event.preventDefault();
                event.stopPropagation();
            }
        });

        function reloadPage(message, type)
        {
            if (submitTask == 'pages.deleteApp') {
                showNotice(message);
                window.location.href = 'index.php?option=com_gridbox'
            } else {
                $('#gridbox-container').load(window.location.href+' #gridbox-content', function(){
                    loadPage();
                    showNotice(message, type);
                });
            }
        }

        function checkContext(context, deltaY, deltaX)
        {
            if (deltaX - context.width() < 0) {
                context.addClass('ba-left');
            } else {
                context.removeClass('ba-left');
            }
            if (deltaY - context.height() < 0) {
                context.addClass('ba-top');
            } else {
                context.removeClass('ba-top');
            }
        }

        function checkIframe(modal, view)
        {
            var iframe = modal.find('iframe');
            if (iframe.attr('src').indexOf('view='+view) == -1) {
                iframe[0].src = 'index.php?option=com_gridbox&view='+view+'&tmpl=component';
                iframe[0].onload = function(){
                    modal.modal();
                }
            } else {
                modal.modal();
            }
        }

        function listenMessage(event)
        {
            if (uploadMode == 'introImage') {
                var img = 'images'+event.data.path;
                $('.intro-image').val(img);
                $('#uploader-modal').modal('hide');
                showNotice($('#upload-const').val());
            } else if (uploadMode == 'catintroImage') {
                var img = 'images'+event.data.path;
                $('.category-intro-image').val(img);
                $('#uploader-modal').modal('hide');
                showNotice($('#upload-const').val());
            } else if (uploadMode == 'reloadPage') {
                reloadPage(event.data);
            } else if (uploadMode == 'CKEImage') {
                var url = event.data.url;
                $('.cke-upload-image').val(url);
                $('#add-cke-image').addClass('active-button');
                $('#uploader-modal').modal('hide');
            } else if (uploadMode == 'themeImage') {
                var img = 'images'+event.data.path;
                $('.theme-image').val(img);
                $('.theme-apply').addClass('active-button');
                $('#uploader-modal').modal('hide');
            }
        }

        function setTabsUnderline()
        {
            $('.general-tabs ul li.active a').each(function(){
                var coord = this.getBoundingClientRect();
                $(this).closest('.general-tabs').find('div.tabs-underline').css({
                    'left' : coord.left,
                    'right' : document.documentElement.clientWidth - coord.right,
                }); 
            });
        }

        function showContext(event, context)
        {
            event.stopPropagation();
            event.preventDefault();
            $('.context-active').removeClass('context-active');
            currentContext.addClass('context-active');
            var deltaX = document.documentElement.clientWidth - event.pageX,
                deltaY = document.documentElement.clientHeight - event.clientY;
            setTimeout(function(){
                context.css({
                    'top' : event.pageY,
                    'left' : event.pageX,
                }).show();
                checkContext(context, deltaY, deltaX);
            }, 50);
        }

        function showPageSettings(obj)
        {
            $('#published_on').val(obj.created);
            var end = obj.end_publishing;
            if (end == '0000-00-00 00:00:00') {
                end = '';
            }
            $('#published_down').val(end);
            $('#access').val(obj.page_access);
            var access = $('.access-select li[data-value="'+obj.page_access+'"]').text();
            access = $.trim(access);
            $('.access-select input[type="text"]').val(access);
            $('#language').val(obj.language);
            var language = $('.language-select li[data-value="'+obj.language+'"]').text();
            language = $.trim(language);
            $('.language-select input[type="text"]').val(language);
            $('.theme-list').val(obj.theme);
            var theme = $('.theme-select li[data-value="'+obj.theme+'"]').text(),
                modalFlag = true;
            theme = $.trim(theme);
            $('.theme-select input[type="text"]').val(theme);
            $('#settings-dialog .ba-alert-container').hide();
            if ($('.meta-tags').length > 0) {
                $('#page-category').val(obj.page_category).prev().val(obj.category);
                $.ajax({
                    type:"POST",
                    dataType:'text',
                    async: false,
                    url:"index.php?option=com_gridbox&task=blogs.getTags",
                    success: function(msg){
                        var tags = JSON.parse(msg);
                        $('.meta-tags .all-tags').empty();
                        tags.forEach(function(el){
                            $('.meta-tags .all-tags').append('<li data-id="'+el.id+'" style="display:none;">'+el.title+'</li>');
                        });
                    }
                });
                $.ajax({
                    type:"POST",
                    dataType:'text',
                    url:"index.php?option=com_gridbox&task=gridbox.getPageTags",
                    data : {
                        page_id : pageId
                    },
                    success: function(msg){
                        msg = JSON.parse(msg);
                        $('select.meta_tags').empty()
                        if (msg) {
                            $('.picked-tags .tags-chosen').remove();
                            $('select[name="meta_tags"]').empty();
                            $('.all-tags li').removeClass('selected-tag');
                            for (var i = 0; i < msg.length; i++) {
                                var title = msg[i].title,
                                    tagId = msg[i].id,
                                    str = '<li class="tags-chosen"><span>';
                                $('.all-tags li[data-id="'+tagId+'"]').addClass('selected-tag');
                                str += title+'</span><i class="zmdi zmdi-close" data-remove="'+tagId+'"></i></li>';
                                $('.picked-tags .search-tag').before(str);
                                str = '<option value="'+tagId+'" selected>'+title+'</option>';
                                $('select.meta_tags').append(str);
                            }
                            $('.meta-tags .picked-tags .search-tag input').val('');
                            $('.all-tags li').hide();
                        }
                    }
                });
            }
            $('#settings-dialog .page-id').val(pageId);
            $('#settings-dialog .page-title').val(obj.title);
            $('#settings-dialog .page-meta-title').val(obj.meta_title);
            $('#settings-dialog .page-meta-description').val(obj.meta_description);
            $('#settings-dialog .page-meta-keywords').val(obj.meta_keywords);
            $('#settings-dialog .page-alias').val(obj.page_alias);
            $('#settings-dialog .intro-text').val(obj.intro_text);
            $('#settings-dialog .intro-image').val(obj.intro_image);
            $('.settings-apply').removeClass('disabled-button');
            $('#settings-dialog').modal();
        }

        function drawBlogMoveTo(array)
        {
            var str = '',
                type = 'blog';
            if (!currentContext.hasClass('ba-category')) {
                var obj = currentContext.find('.select-td input[type="hidden"]').val();
                obj = JSON.parse(obj);
                type = obj.app_type;
            }
            array.forEach(function(el, i){
                if (el.type == type) {
                    str += '<li class="root '+el.type+'"><label><i class="zmdi zmdi-folder"></i>';
                    str += el.title+'<input type="radio" style="display:none;"';
                    str += " name='category_id' value='{\"id\":0, \"app_id\":"+el.id+"}'></label>";
                    if (el.categories.length > 0) {
                        var catStr = drawRestoreBlog(el.categories, el.id);
                        if (catStr != '<ul></ul>') {
                            str += catStr;
                            str += '<i class="zmdi zmdi-chevron-right ba-icon-md"></i>';
                        }
                    }
                    str += '</li>';
                }
            });

            return str;
        }

        function drawRestoreBlog(array, app_id)
        {
            var str = '<ul>',
                id = 0;
            if (currentContext.hasClass('ba-category')) {
                id = currentContext.attr('data-id');
            }
            array.forEach(function(el, i){
                if (id != el.id) {
                    str += '<li><label><i class="zmdi zmdi-folder"></i>';
                    str += el.title+'<input type="radio" style="display:none;"';
                    str += " name='category_id' value='{\"id\":"+el.id+", \"app_id\":"+app_id+"}'></label>";
                    if (el.child.length > 0) {
                        var catStr = drawRestoreBlog(el.child, app_id);
                        if (catStr != '<ul></ul>') {
                            str += catStr;
                            str += '<i class="zmdi zmdi-chevron-right ba-icon-md"></i>';
                        }
                    }
                    str += '</li>';
                }
            });
            str += '</ul>';

            return str;
        }

        function createAjax()
        {
            var form = document.getElementById('adminForm'),
                view = $('[name="ba_view"]').val(),
                src = form.action,
                obj = {
                    'filter_search' : $('[name="filter_search"]').val(),
                    'filter_state' : $('[name="filter_state"]').val(),
                    'filter_order' : $('[name="filter_order"]').val(),
                    'filter_order_Dir' : $('[name="filter_order_Dir"]').val(),
                    'limit' : $('[name="limit"]').val()
                };
            view = view.split('&');
            obj['view'] = view[0];
            view = '&task=pages.setFilters';
            $.ajax({
                type : "POST",
                dataType : 'text',
                url : src+view,
                data : obj,
                success: function(msg){
                    $('#gridbox-container').load(src+' #gridbox-content', function(){
                        loadPage();
                    });
                }
            });
        }

        if (typeof(Calendar) == 'function') {
            if (document.getElementById('published_on')) {
                Calendar.setup({
                    inputField: 'published_on',
                    ifFormat: "%Y-%m-%d %H:%M:%S",
                    button : 'calendar-button',
                    align: "Tl",
                    singleClick: true,
                    firstDay: 0
                });
            }
            if (document.getElementById('published_on')) {
                Calendar.setup({
                    inputField: 'published_down',
                    ifFormat: "%Y-%m-%d %H:%M:%S",
                    button : 'calendar-down-button',
                    align: "Tl",
                    singleClick: true,
                    firstDay: 0
                });
            }
        }

        $('#settings-dialog, #category-settings-dialog, #photo-editor-dialog').on('shown', function(){
            setTabsUnderline();
        });

        function loadPage()
        {
            if ($('.general-tabs').length > 0) {
                setTabsUnderline();
                $('.general-tabs ul.uploader-nav').off('show').on('show', function(event){
                    event.stopPropagation();
                    var ind = new Array(),
                        ul = $(event.currentTarget),
                        id = $(event.relatedTarget).attr('href'),
                        aId = $(event.target).attr('href');
                    ul.find('li a').each(function(i){
                        if (this == event.target) {
                            ind[0] = i;
                        }
                        if (this == event.relatedTarget) {
                            ind[1] = i;
                        }
                    });
                    if (ind[0] > ind[1]) {
                        $(id).addClass('out-left');
                        $(aId).addClass('right');
                        setTimeout(function(){
                            $(id).removeClass('out-left');
                            $(aId).removeClass('right');
                        }, 500);
                    } else {
                        $(id).addClass('out-right');
                        $(aId).addClass('left');
                        setTimeout(function(){
                            $(id).removeClass('out-right');
                            $(aId).removeClass('left');
                        }, 500);
                    }
                    var coord = event.target.getBoundingClientRect();
                    ul.next().css({
                        'left' : coord.left,
                        'right' : document.documentElement.clientWidth - coord.right,
                    });
                });
            }

            $('#theme-import-file').on('change', function(){
                if (this.files.length > 0) {
                    var data = new FormData(),
                        url = document.getElementById("adminForm").action+"&task=themes.uploadTheme&file="+this.files[0].name,
                        installing = $('#installing-const').val();
                    installing += '<img src="components/com_gridbox/assets/images/reload.svg"></img>';
                    notification[0].className = 'notification-in';
                    notification.find('p').html(installing);
                    data.append('file', this.files[0]);
                    $.ajax({
                        url: url,
                        data: data,
                        type: 'post',
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(msg){
                            var type = '';
                            if (msg.indexOf('ba-alert') === 0) {
                                type = 'ba-alert';
                                msg = msg.replace('ba-alert', '');
                            }
                            setTimeout(function(){
                                notification.removeClass('notification-in').addClass('animation-out');
                                setTimeout(function(){
                                    showNotice(msg, type);
                                    setTimeout(function(){
                                        window.location.href = window.location.href;
                                    }, 400);
                                }, 400);
                            }, 2000);
                        }
                    });
                    /*
                    var XHR = new XMLHttpRequest(),
                        url = document.getElementById("adminForm").action+"&task=themes.uploadTheme&file="+this.files[0].name,
                        installing = $('#installing-const').val();
                    installing += '<img src="components/com_gridbox/assets/images/reload.svg"></img>';
                    notification[0].className = 'notification-in';
                    notification.find('p').html(installing);
                    XHR.onreadystatechange = function(e) {
                        if (XHR.readyState == 4) {
                            var type = '',
                                msg = XHR.responseText;
                            if (msg.indexOf('ba-alert') === 0) {
                                type = 'ba-alert';
                                msg = msg.replace('ba-alert', '');
                            }
                            setTimeout(function(){
                                notification.removeClass('notification-in').addClass('animation-out');
                                setTimeout(function(){
                                    showNotice(msg, type);
                                    setTimeout(function(){
                                        window.location.href = window.location.href;
                                    }, 400);
                                }, 400);
                            }, 2000);
                        }
                    };
                    XHR.open("POST", url, true);
                    XHR.send(this.files[0]);
                    */
                }
            });

            $('#theme-import-trigger').on('click', function(){
                document.getElementById('theme-import-file').click()
            });

            if ($('#upload-theme').length > 0) {
                displayThemes();
            }

            $('#upload-theme').on('click', 'input', function(){
                $('#theme-id').val(this.value);
                $('.ba-username').val('');
                $('.ba-password').val('');
                $('.login-button').attr('data-task', 'getThemeLicense');
                $('#login-modal').modal();
            });
            $('.login-button.active-button').on('click', function(event){
                event.preventDefault();
                if (!$(this).attr('data-submit')) {
                    $(this).attr('data-submit', 'false');
                    var url = 'https://www.balbooa.com/demo/index.php?',
                        $this = this;
                    url += 'option=com_baupdater&task=gridbox.'+this.dataset.task;
                    url += '&login='+window.btoa($('.ba-username').val().trim());
                    url += '&password='+window.btoa($('.ba-password').val().trim());
                    url += '&theme_id='+$('#theme-id').val();
                    var script = document.createElement('script');
                    script.src = url;
                    script.onload = function(){
                        if (typeof(themeResponse) == 'string') {
                            var cArray = document.getElementById('response-constant').value;
                            cArray = JSON.parse(cArray);
                            showNotice(cArray[themeResponse], 'ba-alert');
                        } else if ($this.dataset.task == 'getThemeLicense') {
                            var installing = $('#installing-const').val();
                            installing += '<img src="components/com_gridbox/assets/images/reload.svg"></img>';
                            notification[0].className = 'notification-in';
                            notification.find('p').html(installing);
                            $('#login-modal').modal('hide');
                            if (window.gridboxApi.plugins) {
                                $.ajax({
                                    type:"POST",
                                    dataType:'text',
                                    url:"index.php?option=com_gridbox&task=pages.addPlugins&tmpl=component",
                                    data:{
                                        'plugins' : JSON.stringify(window.gridboxApi.plugins)
                                    },
                                    async : false
                                });
                            }
                            var data = window.atob(themeResponse.data),
                                XHR = new XMLHttpRequest(),
                                url = "index.php?option=com_gridbox&task=themes.downloadTheme";
                            //data = parseXml(data);
                            XHR.onreadystatechange = function(e) {
                                if (XHR.readyState == 4) {
                                    if (XHR.status == 200) {
                                        setTimeout(function(){
                                            notification.removeClass('notification-in').addClass('animation-out');
                                            setTimeout(function(){
                                                showNotice(XHR.responseText);
                                                setTimeout(function(){
                                                    window.location.href = window.location.href;
                                                }, 400);
                                            }, 400);
                                        }, 2000);
                                    } else {
                                        $.ajax({
                                            type:"POST",
                                            dataType:'text',
                                            url:"index.php?option=com_gridbox&task=themes.downloadThemeCurl",
                                            data: {
                                                url : themeResponse.url
                                            },
                                            success : function(msg){
                                                setTimeout(function(){
                                                    notification.removeClass('notification-in').addClass('animation-out');
                                                    setTimeout(function(){
                                                        showNotice(msg);
                                                        setTimeout(function(){
                                                            window.location.href = window.location.href;
                                                        }, 400);
                                                    }, 400);
                                                }, 2000);
                                            }
                                        });
                                    }
                                }
                            }
                            XHR.open("POST", url, true);
                            //XHR.setRequestHeader("Content-Type", "text/xml");
                            XHR.send(data);
                        } else {
                            $.ajax({
                                type:"POST",
                                dataType:'text',
                                url:"index.php?option=com_gridbox&task=pages."+$this.dataset.task,
                                data:themeResponse,
                                success : function(msg){
                                    $('#login-modal').modal('hide');
                                    $('.disabled-apps').removeClass('disabled-apps');
                                    showNotice(msg);
                                }
                            });
                        }
                        $('.login-button.active-button').removeAttr('data-submit');
                    }
                    document.head.appendChild(script);
                }
            });

            $('.ba-username, .ba-password').on('keyup', function(event){
                if (event.keyCode == 13) {
                    document.querySelector('.login-button.active-button').click();
                }
            });

            $('#filter_search').on('keydown', function(event){
                if (event.keyCode == 13) {
                    createAjax();
                }
            });

            $('[name="filter_state"], #limit').on('change', function(event){
                var text = $(this).parent().find('input[type="text"]');
                createAjax();
            });

            $('#directionTable, #sortTable').on('change', function(event){
                var text = $(this).parent().find('input[type="text"]');
                Joomla.orderTable();
            });

            $('.ba-custom-select > i, div.ba-custom-select input').on('click', function(event){
                event.stopPropagation()
                var $this = $(this),
                    parent = $this.parent();
                $('.visible-select').removeClass('visible-select');
                parent.find('ul').addClass('visible-select');
                parent.find('li').off('click').one('click', function(){
                    var text = $.trim($(this).text()),
                        val = $(this).attr('data-value');
                    parent.find('input[type="text"]').val(text);
                    parent.find('input[type="hidden"]').val(val).trigger('change');
                    parent.trigger('customAction');
                });
                parent.trigger('show');
                setTimeout(function(){
                    $('body').one('click', function(){
                        $('.visible-select').parent().trigger('customHide');
                        $('.visible-select').removeClass('visible-select');
                    });
                }, 50);
            });

            $('.create-categery').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                if ($(this).hasClass('active-product-tour')) {
                    return false;
                }
                var id = 0,
                    $this = $('.category-list > ul').find('li.active');
                if ($this.hasClass('ba-category')) {
                    var obj = $this.find('> a input[type="hidden"]').val();
                    obj = JSON.parse(obj);
                    id = obj.id;
                }
                $('.parent-id').val(id);
                $('.category-name').val('');
                $('#create-category-modal').modal();
            });

            $('div.ba-custom-select').on('show', function(){
                var $this = $(this),
                    ul = $this.find('ul'),
                    value = $this.find('input[type="hidden"]').val();
                ul.find('i').remove();
                ul.find('.selected').removeClass('selected');
                ul.find('li[data-value="'+value+'"]').addClass('selected').prepend('<i class="zmdi zmdi-check"></i>');
            });

            $('.ba-tooltip').each(function(){
                $(this).parent().off('mouseenter mouseleave').on('mouseenter', function(){
                    if (document.body.classList.contains('sidebar-open') && $(this).closest('.ba-sidebar').length > 0) {
                        $(this).trigger('mouseleave');
                        return false;
                    }
                    var coord = this.getBoundingClientRect(),
                        top = coord.top,
                        data = $(this).find('.ba-tooltip').html(),
                        center = (coord.right - coord.left) / 2;
                        className = $(this).find('.ba-tooltip')[0].className;
                    center = coord.left + center;
                    if ($(this).find('.ba-tooltip').hasClass('ba-bottom')) {
                        top = coord.bottom;
                    }
                    $('body').append('<span class="'+className+'">'+data+'</span>');
                    var tooltip = $('body > .ba-tooltip').last(),
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
                    var tooltip = $('body').find(' > .ba-tooltip');
                    tooltip.addClass('tooltip-hidden');
                    setTimeout(function(){
                        tooltip.remove();
                    }, 500);
                });
            });

            $('ul.root-list').off('click').on('click', 'i.zmdi-chevron-right', function(){
                var $this = $(this).parent(),
                    blog = $('input[name="blog"]').val(),
                    category = this.parentNode.dataset.id;
                if ($this.hasClass('visible-branch')) {
                    $this.removeClass('visible-branch');
                    deleteCookie('blog'+blog+'id'+category);
                } else {
                    $this.addClass('visible-branch');
                    setCookie('blog'+blog+'id'+category, 1);
                }
            });

            $('.main-table tbody.order-list-sorting').sortable({
                handle : '> tr > td',
                selector : '> tr',
                change: function(element){
                        var cid = new Array(),
                            order = new Array(),
                            type = 'pages';
                        $('.order-list-sorting tr').each(function(){
                            cid.push($(this).find('.select-td input[type="checkbox"]').val());
                            order.push($(this).find('.title-cell input[type="hidden"]').val())
                        });
                        order.sort(function(a, b){
                            return a * 1 > b * 1 ? 1 : -1;
                        });
                        var asc = $('#directionTable').val();
                        if (asc != 'asc') {
                            order.reverse();
                        }
                        if ($('.main-table').hasClass('tags-table')) {
                            type = 'tags';
                        }
                        $.ajax({
                            type : "POST",
                            dataType : 'text',
                            url : 'index.php?option=com_gridbox&task=pages.orderPages&tmpl=component',
                            data : {
                                cid : cid,
                                type: type,
                                order: order
                            }
                        });
                    },
                group: 'pages'
            });

            $('input[name="category_order_list"]').val(sortableInd);

            $('.category-list ul.root-list .root ul').each(function(ind){
                $(this).sortable({
                    handle : '> .ba-category > .sorting-handle',
                    selector : '> .ba-category',
                    change: function(element){
                        sortableInd = 1;
                        var data = new Array();
                        $('.category-list ul.root-list .ba-category').each(function(){
                            var obj = {
                                id : this.dataset.id,
                                order_list : sortableInd++
                            }
                            data.push(obj);
                        });
                        $('input[name="category_order_list"]').val(sortableInd);
                        $.ajax({
                            type : "POST",
                            dataType : 'text',
                            url : 'index.php?option=com_gridbox&task=blogs.orderCategories&tmpl=component',
                            data : {
                                data : JSON.stringify(data)
                            },
                            success: function(msg){
                                
                            }
                        });
                    },
                    group : 'categories-'+ind
                });
            });

            $('input[name="app_order_list"]').val(sortableAppInd);

            $('.ba-sidebar .sorting-container').sortable({
                handle : '.sorting-handle',
                selector : '> span.app',
                change: function(element){
                    sortableAppInd = 1;
                    var data = new Array();
                    $('.ba-sidebar .sorting-container span.app').each(function(){
                        var obj = {
                            id : this.dataset.id,
                            order_list : sortableAppInd++
                        }
                        data.push(obj);
                    });
                    $('input[name="app_order_list"]').val(sortableAppInd);
                    $.ajax({
                        type : "POST",
                        dataType : 'text',
                        url : 'index.php?option=com_gridbox&task=pages.orderApps&tmpl=component',
                        data : {
                            data : JSON.stringify(data)
                        },
                        success: function(msg){
                        }
                    });
                },
                group : 'app'
            });

            $('ul.root-list a').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                var src = this.href;
                window.history.pushState(null, null, src);
                $('#gridbox-container').load(src+' #gridbox-content', function(){
                    loadPage();
                });
            });

            $('ul.root-list li.ba-category ').on('contextmenu', function(event){
                currentContext = $(this);
                showContext(event, $('.category-context-menu'));
            });

            $('#installed-themes-view label').on('contextmenu', function(event){
                currentContext = $(this);
                showContext(event, $('.theme-context-menu'));
            });

            $('.main-table tr').on('contextmenu', function(event){
                currentContext = $(this);
                showContext(event, $('.page-context-menu'));
            });
            $('.gridbox-help').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                var coor = this.getBoundingClientRect();
                $('div.help-context-menu').css({
                    'top' : coor.bottom,
                    'left' : coor.right,
                }).show();
            });
            $('.gridbox-options').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                var coor = this.getBoundingClientRect();
                $('div.options-context-menu').css({
                    'top' : coor.bottom,
                    'left' : coor.right,
                }).show();
            });
            $('.sidebar-toggle').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                var classList = document.body.classList,
                    icon = document.querySelector('.sidebar-toggle-icon');
                if (classList.contains('sidebar-open')) {
                    icon.classList.remove('zmdi-chevron-left');
                    icon.classList.add('zmdi-chevron-right');
                    classList.remove('sidebar-open');
                } else {
                    icon.classList.remove('zmdi-chevron-right');
                    icon.classList.add('zmdi-chevron-left');
                    classList.add('sidebar-open');
                }
            });

            $('.ba-create-tags').on('mousedown', function(){
                $('#tag-name').val('');
                $('.create-new-tag').removeClass('active-button');
                $('#create-new-tag-modal').modal();
            });

            $('#app-name, #tag-name').off('input').on('input', function(){
                var value = this.value.trim();
                if (value) {
                    $(this).closest('.modal').find('.ba-btn-primary').addClass('active-button');
                } else {
                    $(this).closest('.modal').find('.ba-btn-primary').removeClass('active-button');
                }
            });
            

            $('span.add-new-app').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                if ($(this).hasClass('active-product-tour')) {
                    return false;
                }
                if (this.classList.contains('disabled-apps')) {
                    $('.ba-username').val('');
                    $('.ba-password').val('');
                    $('.login-button').attr('data-task', 'getAppLicense');
                    $('#login-modal').modal();
                    return false;
                }
                var coor = this.getBoundingClientRect();
                $('div.add-context-menu').css({
                    'top' : coor.bottom,
                    'left' : coor.right,
                }).show();
            });

            $('.blog-settings').on('click', function(){
                var obj = $('#blog-data').val(),
                    theme;
                obj = JSON.parse(obj);
                $('.category-title').val(obj.title);
                $('.category-id').val(obj.id);
                $('.category-alias').val(obj.alias);
                $('.apply-blog-settings').css('display', '');
                $('.category-settings-apply').hide();
                $('.blog-theme-select').closest('.ba-options-group').css('display', '');
                $('#category-settings-dialog .cke-editor-container').closest('.ba-options-group')
                    .hide().prev().hide();
                $('.category-access-select input[type="hidden"]').val(obj.access);
                var access = $('.category-access-select li[data-value="'+obj.access+'"]').text().trim(),
                    language = $('.category-language-select li[data-value="'+obj.language+'"]').text().trim();
                $('.category-access-select input[type="text"]').val(access);
                $('.category-language-select input[type="hidden"]').val(obj.language);
                $('.category-language-select input[type="text"]').val(language);
                theme = $('.blog-theme-select li[data-value="'+obj.theme+'"]').text();
                $('.blog-theme-select input[type="hidden"]').val(obj.theme);
                $('.blog-theme-select input[type="text"]').val($.trim(theme));
                $('.category-intro-image').val(obj.image);
                $('.category-meta-title').val(obj.meta_title);
                $('.category-meta-description').val(obj.meta_description);
                $('.category-meta-keywords').val(obj.meta_keywords);
                if (obj.published == 1) {
                    $('.category-publish').attr('checked', true);
                } else {
                    $('.category-publish').removeAttr('checked');
                }
                $('i.zmdi-check.disabled-button').removeClass('disabled-button');
                $('.ba-alert-container').hide();
                $('#category-settings-dialog').modal();
            });

            $('.single-settings').on('click', function(){
                var blog = $('#blog-data').val();
                blog = JSON.parse(blog);
                oldTitle = blog.title;
                $('.blog-title').val(blog.title);
                $('.apply-single-settings').removeClass('active-button');
                $('#single-settings-modal').modal();
            });
            $('.blog-delete').on('click', function(event){
                event.preventDefault();
                deleteMode = 'pages.deleteApp';
                $('#delete-dialog').modal()
            });
            $('.app-duplicate').on('click', function(){
                $(this).off('click');
                var str = document.getElementById('installing-const').value+'<img src="'+update.url;
                str += 'administrator/components/com_gridbox/assets/images/reload.svg"></img>';
                notification[0].className = 'notification-in';
                notification.find('p').html(str);
                Joomla.submitbutton('pages.duplicateApp');
            });
        }

        $('.modal').on('hide', function(){
            $(this).addClass('ba-modal-close');
            setTimeout(function(){
                $('.ba-modal-close').removeClass('ba-modal-close');
            }, 500);
        });

        setTimeout(function(){
            $('.alert.alert-success').addClass('animation-out');
        }, 2000);

        $('.add-context-menu span').on('mousedown', function(){
            var type = $(this).attr('data-type');
            $('#app-name').val('');
            $('#app-type').val(type);
            $('.create-app').removeClass('active-button');
            $('#create-new-app-modal').modal();
        });

        $('.create-app').on('click', function(event){
            event.preventDefault();
            if ($(this).hasClass('active-button')) {
                $('#create-new-app-modal').modal('hide');
                Joomla.submitbutton('pages.addApp');
            }
        });

        $('.create-new-tag').on('click', function(event){
            event.preventDefault();
            if ($(this).hasClass('active-button')) {
                $('#create-new-tag-modal').modal('hide');
                Joomla.submitbutton('tags.addTag');
            }
        });

        $('body').on('mousedown', function(){
            $('.context-active').removeClass('context-active');
            $('.ba-context-menu').hide();
        });

        $('.ba-context-menu .documentation, .ba-context-menu .support, .ba-context-menu .options').on('mousedown', function(event){
            if (event.button > 1) {
                return false;
            }
            event.stopPropagation();
            setTimeout(function(){
                $('div.help-context-menu').hide();
            }, 150);
        });

        $('.export-page').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            exportId = new Array(id);
            $('li.export-apps').hide();
            $('#export-dialog').modal();
            $('.apply-export').attr('data-export', 'pages');
        });

        $('.export-gridbox').on('mousedown', function(){
            exportId = new Array();
            $('li.export-apps').css('display', '');
            $('#export-dialog').modal();
            $('.apply-export').attr('data-export', 'gridbox');
        });
        
        $('span.about-gridbox').on('mousedown', function(){
            $('#about-dialog').modal();
        });

        $('span.gridbox-languages').on('mousedown', function(){
            $('#languages-dialog').modal();
        });

        $('#languages-dialog .languages-wrapper').on('click', 'span.language-title', function(){
            $('#languages-dialog').modal('hide');
            var installing = $('#installing-const').val();
            installing += '<img src="components/com_gridbox/assets/images/reload.svg"></img>';
            notification[0].className = 'notification-in';
            notification.find('p').html(installing);
            $.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=pages.addLanguage&tmpl=component",
                data:{
                    url: gridboxApi.languages[this.dataset.key].url,
                    zip: gridboxApi.languages[this.dataset.key].zip,
                },
                success: function(msg){
                    showNotice(msg);
                }
            });
        });

        $('.ba-context-menu .love-gridbox').on('mousedown', function(event){
            if (event.button > 1) {
                return false;
            }
            $('#love-gridbox-modal').modal();
        });

        $('.select-intro-image').on('click', function(){
            checkIframe($('#uploader-modal'), 'uploader');
            uploadMode = 'introImage';
        });

        $('.reset-page-intro-image').on('click', function(){
            $('input.intro-image').val('');
        });

        $('.reset-category-intro-image').on('click', function(){
            $('input.category-intro-image').val('');
        });

        $('.select-category-intro-image').on('click', function(){
            checkIframe($('#uploader-modal').modal(), 'uploader');
            uploadMode = 'catintroImage';
        });

        if (window.addEventListener) {
            window.addEventListener("message", function(event){listenMessage(event)}, false);
        } else {
            window.attachEvent("onmessage", function(event){listenMessage(event)});
        }

        $('.blog-title').on('input', function(){
            var val = $(this).val();
            val = $.trim(val);
            if (val && val != oldTitle) {
                $(this).closest('.modal').find('.ba-btn-primary').addClass('active-button');
            } else {
                $(this).closest('.modal').find('.ba-btn-primary').removeClass('active-button');
            }
        });

        $('.apply-blog-settings').on('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            $('#category-settings-dialog').modal('hide');
            Joomla.submitbutton('blogs.applySettings');
        });

        $('.apply-single-settings').on('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            if (!$(this).hasClass('active-button')) {
                return false;
            }
            $('#single-settings-modal').modal('hide');
            Joomla.submitbutton('pages.applySingle');
        });
        
        $('.update-link').on('click', function(){
            $('.ba-update-message').removeClass('active').addClass('animation-out');
            setTimeout(function(){
                var str = update.const+'<img src="'+update.url;
                str += 'administrator/components/com_gridbox/assets/images/reload.svg"></img>';
                notification[0].className = 'notification-in';
                notification.find('p').html(str);
            }, 400);
            var XHR = new XMLHttpRequest(),
                url = 'index.php?option=com_gridbox&task=pages.updateGridbox&tmpl=component';
            XHR.onreadystatechange = function(e) {
                if (XHR.readyState == 4) {
                    $("#about-dialog .update").text(gridboxApi.version);
                    setTimeout(function(){
                        notification[0].className = 'animation-out';
                        setTimeout(function(){
                            notification.find('p').html(update.updated);
                            notification[0].className = 'notification-in';
                            setTimeout(function(){
                                notification[0].className = 'animation-out';
                            }, 3000);
                        }, 400);
                    }, 2000);
                }
            };
            XHR.open("POST", url, true);
            XHR.send(gridboxApi.package);
        });
        
        $('.apply-export').on('click', function(event){
            event.preventDefault();
            if (this.dataset.export == 'app') {
                exportId = new Array($('input[name="blog"]').val());
            }
            var exportPages = {
                "id" : exportId,
                type : this.dataset.export,
                "menu" : $('.menu-export').prop('checked')
            }
            $.ajax({
                type : "POST",
                dataType : 'text',
                url : "index.php?option=com_gridbox&view=pages&task=pages.exportXML",
                data : {
                    'export_data' : JSON.stringify(exportPages)
                },
                success: function(msg){
                    var msg = JSON.parse(msg);
                    if (msg.success) {
                        var iframe = $('<iframe/>', {
                            name:'download-target',
                            id : 'download-target',
                            src : 'index.php?option=com_gridbox&view=pages&task=pages.download&tmpl=component&file='+msg.message,
                            style : 'display:none'
                        });
                        $('#download-target').remove();
                        $('body').append(iframe);
                    }
                }
            });
            $('#export-dialog').modal('hide');
        });

        if (typeof(CKEDITOR) != 'undefined') {
            CKE = CKEDITOR.replace('category_description');
            if ($('html').attr('dir') == 'rtl') {
                CKEDITOR.config.contentsLangDirection = 'rtl';
            }
            CKE.setUiColor('#fafafa');
            CKE.config.allowedContent = true;
            CKEDITOR.dtd.$removeEmpty.span = 0;
            CKEDITOR.dtd.$removeEmpty.i = 0;
            CKE.config.toolbar_Basic =
            [
                { name: 'document',    items : [ 'Source' ] },
                { name: 'styles',      items : [ 'Styles','Format' ] },
                { name: 'colors',      items : [ 'TextColor' ] },
                { name: 'clipboard',   items : [ 'Undo','Redo' ] },            
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent',
                                                'Indent','-','Blockquote','-','JustifyLeft',
                                                'JustifyCenter','JustifyRight','JustifyBlock','-' ] },
                { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
                { name: 'insert',      items : [ 'myImage','Table','HorizontalRule'] }
            ];
            CKE.config.toolbar = 'Basic';
            CKEDITOR.config.removePlugins = 'image';
            CKE.addCommand("imgComand", {
                exec: function(edt) {
                    $('#add-cke-image').removeClass('active-button');
                    var align = src = w = h = alt = label = '',
                        selected = CKE.getSelection().getSelectedElement()
                    if (selected && selected.$.localName == 'img') {
                        ckeImage = selected.$;
                        src = ckeImage.src;
                        alt = ckeImage.alt;
                        w = ckeImage.style.width.replace('px', '');
                        h = ckeImage.style.height.replace('px', '');
                        align = ckeImage.style.float;
                        label = $('.cke-image-align').parent().find('li[data-value="'+align+'"]').text();
                        label = $.trim(label);
                    } else {
                        ckeImage = '';
                    }
                    $('.cke-upload-image').val(src);
                    $('.cke-image-alt').val(alt);
                    $('.cke-image-width').val(w);
                    $('.cke-image-height').val(h);
                    $('.cke-image-align').attr('data-value', align);
                    $('.cke-image-align').val(label);
                    $('#cke-image-modal').modal();
                }
            });
            CKE.ui.addButton('myImage', {
                label: "Image",
                command: 'imgComand',
                toolbar: 'insert',
                icon: 'image'
            });

            $('.cke-upload-image').on('mousedown', function(){
                checkIframe($('#uploader-modal'), 'uploader');
                uploadMode = 'CKEImage';
            });

            CKEDITOR.config.contentsCss = [getCSSrulesString()];

            $('.cke-image-alt, .cke-image-width, .cke-image-height').on('input', function(){
                if ($('.cke-upload-image').val()) {
                    $('#add-cke-image').addClass('active-button');
                }
            });

            $('.cke-image-select').on('customHide', function(){
                if ($('.cke-upload-image').val()) {
                    $('#add-cke-image').addClass('active-button');
                }
            });

            $('#add-cke-image').on('click', function(event){
                event.preventDefault();
                if (jQuery(this).hasClass('active-button')) {
                    var url = $('.cke-upload-image').val(),
                        alt = $('.cke-image-alt').val(),
                        width = $('.cke-image-width').val(),
                        height = $('.cke-image-height').val(),
                        align = $('.cke-image-align').val(),
                        img = '',
                        doc = $('.cke-editor-container iframe')[0].contentDocument;
                    if (width) {
                        width += 'px';
                    }
                    if (height) {
                        height += 'px';
                    }
                    if (ckeImage) {
                        ckeImage.src = url;
                        ckeImage.alt = $.trim(alt);
                        ckeImage.style.width = width;
                        ckeImage.style.height = height;
                        ckeImage.style.float = align;
                    } else {
                        img = document.createElement('img');
                        img.src = url;
                        img.alt = $.trim(alt);
                        img.style.width = width;
                        img.style.height = height;
                        img.style.float = align;
                        if (doc.getSelection().rangeCount > 0) {
                            var range = doc.getSelection().getRangeAt(0);
                            range.insertNode(img);
                        } else {
                            var data = CKE.getData();
                            data += img.outerHTML;
                            CKE.setData(data);
                        }
                    }
                    $('#cke-image-modal').modal('hide');
                }
            });
        }

        $('span.category-settings').on('mousedown', function(){
            var obj = currentContext.find('> a input').val();
            obj = JSON.parse(obj);
            $('.category-title').val(obj.title);
            $('.category-id').val(obj.id);
            $('.category-parent').val(obj.parent);
            $('.category-alias').val(obj.alias);
            $('.apply-blog-settings').hide();
            $('.category-settings-apply').css('display', '');
            $('.blog-theme-select').closest('.ba-options-group').hide();
            $('#category-settings-dialog .cke-editor-container').closest('.ba-options-group')
                .css('display', '').prev().css('display', '');
            $('.category-access-select input[type="hidden"]').val(obj.access);
            var access = $('.category-access-select li[data-value="'+obj.access+'"]').text(),
                language = $('.category-language-select li[data-value="'+obj.language+'"]').text();
            access = $.trim(access);
            language = $.trim(language);
            $('.category-access-select input[type="text"]').val(access);
            $('.category-language-select input[type="hidden"]').val(obj.language);
            $('.category-language-select input[type="text"]').val(language);
            CKE.setData(obj.description);
            $('.category-intro-image').val(obj.image);
            $('.category-meta-title').val(obj.meta_title);
            $('.category-meta-description').val(obj.meta_description);
            $('.category-meta-keywords').val(obj.meta_keywords);
            if (obj.published == 1) {
                $('.category-publish').attr('checked', true);
            } else {
                $('.category-publish').removeAttr('checked');
            }
            $('i.zmdi-check.disabled-button').removeClass('disabled-button');
            $('.ba-alert-container').hide();
            $('#category-settings-dialog').modal();
        });

        $('span.tags-settings').on('mousedown', function(){
            var obj = currentContext.find('.select-td input[type="hidden"]').val();
            obj = JSON.parse(obj);
            $('.category-title').val(obj.title);
            $('.category-id').val(obj.id);
            $('.category-alias').val(obj.alias);
            $('#category-settings-dialog .cke-editor-container');
            $('.category-access-select input[type="hidden"]').val(obj.access);
            var access = $('.category-access-select li[data-value="'+obj.access+'"]').text().trim(),
                language = $('.category-language-select li[data-value="'+obj.language+'"]').text().trim();
            $('.category-access-select input[type="text"]').val(access);
            $('.category-language-select input[type="hidden"]').val(obj.language);
            $('.category-language-select input[type="text"]').val(language);
            CKE.setData(obj.description);
            $('.category-intro-image').val(obj.image);
            $('.category-meta-title').val(obj.meta_title);
            $('.category-meta-description').val(obj.meta_description);
            $('.category-meta-keywords').val(obj.meta_keywords);
            if (obj.published == 1) {
                $('.category-publish').prop('checked', true);
            } else {
                $('.category-publish').prop('checked', false);
            }
            $('i.zmdi-check.disabled-button').removeClass('disabled-button');
            $('.ba-alert-container').hide();
            $('#category-settings-dialog').modal();
        });

        $('.tags-settings-apply').on('click', function(){
            if ($(this).hasClass('disabled-button')) {
                return false;
            }
            var description = CKE.getData();
            $('.category-descriprion').val(description);
            $('#category-settings-dialog').modal('hide');
            Joomla.submitbutton('tags.updateTags');
        });

        $('.category-settings-apply').on('click', function(){
            if ($(this).hasClass('disabled-button')) {
                return false;
            }
            var description = CKE.getData();
            $('.category-descriprion').val(description);
            $('#category-settings-dialog').modal('hide');
            Joomla.submitbutton('blogs.updateCategory');
        });

        $('span.category-delete').on('mousedown', function(){
            var obj = currentContext.find('> a input[type="hidden"]').val();
            $('#context-item').val(obj);
            deleteMode = 'blogs.deleteCategory'
            $('#delete-dialog').modal();
        });

        $('span.category-duplicate').on('mousedown', function(){
            var id = currentContext.attr('data-id');
            $('#context-item').val(id);
            Joomla.submitbutton('blogs.categoryDuplicate');
        });

        $('span.category-move').on('mousedown', function(){
            var id = currentContext.attr('data-id');
            moveTo = 'blogs.categoryMoveTo';
            $('#context-item').val(id);
            showMoveTo();
        });

        function showMoveTo()
        {
            $.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=trashed.getCategories",
                data:{
                },
                success: function(msg){
                    msg = JSON.parse(msg);
                    var str = drawBlogMoveTo(msg),
                        ul = $('#move-to-modal .availible-folders ul.root-list');
                    if (currentContext.hasClass('ba-category')) {
                        ul.addClass('ba-move-category');
                    } else {
                        ul.removeClass('ba-move-category');
                    }
                    ul.html(str);
                    $('.apply-move').removeClass('active-button');
                    $('#move-to-modal').modal();
                }
            });
        }

        $('span.page-move').on('mousedown', function(){
            var obj = currentContext.find('.select-td input[type="hidden"]').val();
            obj = JSON.parse(obj)
            moveTo = 'blogs.pageMoveTo';
            $('#context-item').val(obj.id);
            showMoveTo();
        });

        $('span.page-move-single').on('mousedown', function(){
            var obj = currentContext.find('.select-td input[type="hidden"]').val();
            obj = JSON.parse(obj)
            moveTo = 'trashed.restoreSingle';
            $('#context-item').val(obj.id);
            showMoveTo();
        });

        $('span.page-duplicate').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            Joomla.submitbutton('pages.contextDuplicate');
        });

        $('span.tags-duplicate').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            Joomla.submitbutton('tags.contextDuplicate');
        });

        $('span.page-trash').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            deleteMode = 'pages.contextTrash';
            $('#delete-dialog').modal();
        });

        $('span.tags-delete').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            deleteMode = 'tags.contextDelete';
            $('#delete-dialog').modal();
        });

        $('span.blog-duplicate').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            Joomla.submitbutton('blogs.contextDuplicate');
        });

        $('span.blog-trash').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            deleteMode = 'blogs.contextTrash';
            $('#delete-dialog').modal();
        });

        $('span.theme-delete').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val(),
                def = currentContext.find('p').attr('data-default');
            if (def == 1) {
                $('#default-message-dialog').modal();
                return false;
            }
            $('#context-item').val(id);
            deleteMode = 'single';
            $('#delete-dialog').modal();
        });

        $('input.category-name').on('input', function(){
            if ($.trim($(this).val())) {
                $('#create-new-category').addClass('active-button');
            } else {
                $('#create-new-category').removeClass('active-button');
            }
        });

        $('#create-new-category').on('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            if (!$(this).hasClass('active-button')) {
                return false;
            }
            $('#create-category-modal').modal('hide');
            Joomla.submitbutton('blogs.addCategory')
        })

        $('#apply-delete').on('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            if (deleteMode == 'single') {
                Joomla.submitbutton('themes.contextDelete');
            } else if (deleteMode == 'array') {
                Joomla.submitform('themes.delete');
            } else if (deleteMode == 'blogs.addTrash' || deleteMode == 'pages.addTrash' || deleteMode == 'tags.delete') {
                Joomla.submitform(deleteMode);
            } else {
                submitTask = deleteMode;
                Joomla.submitbutton(deleteMode);
            }
            $('#delete-dialog').modal('hide');
        });

        $('span.theme-duplicate').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            Joomla.submitbutton('themes.contextDuplicate');
        });

        $('span.page-delete').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            Joomla.submitbutton('pages.contextDelete');
        });

        $('span.trashed-delete').on('mousedown', function(){
            var id = currentContext.find('input[type="checkbox"]').val();
            $('#context-item').val(id);
            deleteMode = 'trashed.contextDelete'
            $('#delete-dialog').modal();
        });

        $('span.trashed-restore').on('mousedown', function(){
            var obj = currentContext.find('.select-td input[type="hidden"]').val();
            obj = JSON.parse(obj);
            $('#context-item').val(obj.id);
            if (obj.app_type == 'single') {
                moveTo = 'trashed.restoreSingle';
            } else if (obj.app_type == 'blog') {
                moveTo = 'trashed.restoreBlog';
            }
            showMoveTo();
        });

        $('#move-to-modal .availible-folders').on('change', '[name="category_id"]', function(event){
            event.stopPropagation();
            if ($(this).closest('li').hasClass('blog') && !currentContext.hasClass('ba-category')) {
                return false;
            }
            $('#move-to-modal .availible-folders > ul .active').removeClass('active');
            $(this).closest('li').addClass('active');
            $('#move-to-modal .apply-move').addClass('active-button');
        });

        $('#move-to-modal .apply-move').on('click', function(){
            if (!$(this).hasClass('active-button')) {
                return false;
            }
            $('#move-to-modal').modal('hide');
            Joomla.submitbutton(moveTo);
        });

        $('span.page-settings').on('mousedown', function(){
            var obj = currentContext.find('.select-td input[type="hidden"]').val();
            pageId = currentContext.find('.select-td input[type="checkbox"]').val();
            obj = JSON.parse(obj);
            item = $(this);
            if (!this.dataset.callback) {
                showPageSettings(obj);
            } else {
                app[this.dataset.callback](obj);
            }
        });

        $('#toolbar-settings').on('click', function(){
            var options = new Array(),
                obj,
                message = $('.jlib-selection').val();
            $('.table-striped tbody input[type="checkbox"]').each(function(){
                if ($(this).prop('checked')) {
                    pageId = $(this).val();
                    obj = $(this).closest('td').find('input[type="hidden"]').val();
                    item = $(this);
                    options.push('option');
                }
            });
            if (options.length == 0 || options.length > 1) {
                alert(message);
                return false;
            }
            obj = JSON.parse(obj);
            if (!this.dataset.callback) {
                showPageSettings(obj);
            } else {
                app[this.dataset.callback](obj);
            }
        });

        $('.meta-tags .picked-tags .search-tag input').on('keydown', function(event){
            var title = $(this).val().trim();
            $('ul.all-tags').css({
                'left': this.parentNode.offsetLeft
            });
            if (event.keyCode == 13) {
                if (!title) {
                    $(this).val('');
                    return false;
                }
                var str = '<li class="tags-chosen"><span>',
                    tagId = 'new$'+title;
                $('.all-tags li').each(function(){
                    var search = $(this).text();
                    search = $.trim(search);
                    search = search.toLowerCase();
                    if (title.toLowerCase() == search) {
                        $(this).addClass('selected-tag');
                        tagId = $(this).attr('data-id');
                        return false;
                    }
                });
                if ($('.picked-tags .tags-chosen i[data-remove="'+tagId+'"]').length > 0) {
                    return false;
                }
                str += title+'</span><i class="zmdi zmdi-close" data-remove="'+tagId+'"></i></li>';
                $('.picked-tags .search-tag').before(str);
                str = '<option value="'+tagId+'" selected>'+title+'</option>';
                $('select.meta_tags').append(str);
                $(this).val('');
                $('.all-tags li').hide();
                event.stopPropagation();
                event.preventDefault();
                return false;
            } else {
                title = title.toLowerCase();
                $('.all-tags li').each(function(){
                    var search = $(this).text();
                    search = $.trim(search);
                    search = search.toLowerCase();
                    if (search.indexOf(title) < 0 || title == '') {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            }
        });

        $('.all-tags').on('click', 'li', function(){
            if ($(this).hasClass('selected-tag')) {
                return false;
            }
            var title = $(this).text(),
                tagId = $(this).attr('data-id');
            title = $.trim(title);
            var str = '<li class="tags-chosen"><span>';
            str += title+'</span><i class="zmdi zmdi-close" data-remove="'+tagId+'"></i></li>';
            $('.picked-tags .search-tag').before(str);
            str = '<option value="'+tagId+'" selected>'+title+'</option>';
            $('select.meta_tags').append(str);
            $('.meta-tags .picked-tags .search-tag input').val('');
            $('.all-tags li').hide();
            $(this).addClass('selected-tag');
        });

        $('.meta-tags .picked-tags').on('click', '.zmdi.zmdi-close', function(){
            var del = $(this).attr('data-remove');
            $('select.meta_tags option[value="'+del+'"]').remove();
            $(this).closest('li').remove();
            $('.all-tags li[data-id="'+del+'"]').removeClass('selected-tag');
            $('.all-tags li').hide();
        });
        
        $('.settings-apply').on('click', function(event){
            event.stopPropagation();
            event.preventDefault();
            var title = $('#settings-dialog .page-title').val().replace(new RegExp(";",'g'), '')
            title = $.trim(title);
            if (!title) {
                return false;
            }
            $('#settings-dialog').modal('hide');
            Joomla.submitbutton('gridbox.updateParams');
        });

        $('.modal .page-title, .modal .category-title').on('input', function(event){
            event.stopPropagation();
            event.preventDefault();
            var $this = $(this),
                title = $this.val();
            title = $.trim(title);
            if (!title) {
                $this.closest('.modal').find('.modal-header i.zmdi-check').addClass('disabled-button');
                $this.parent().find('.ba-alert-container').show();
            } else {
                $this.closest('.modal').find('.modal-header i.zmdi-check').removeClass('disabled-button');
                $this.parent().find('.ba-alert-container').hide();
            }
        });

        function setThemeSettings(obj)
        {
            $('#theme-edit-dialog .theme-name').val(obj.name);
            $('#theme-edit-dialog .theme-image').val(obj.image);
            if (obj.default == 1) {
                $('#theme-edit-dialog .theme-default').attr('checked', true);
                $('#theme-edit-dialog .theme-default').attr('disabled', true);
            } else {
                $('#theme-edit-dialog .theme-default').removeAttr('checked');
                $('#theme-edit-dialog .theme-default').removeAttr('disabled');
            }
            if (obj.image != 'components/com_gridbox/assets/images/default-theme.png') {
                $('#theme-edit-dialog .theme-image + i')[0].className = 'zmdi zmdi-close';
            } else {
                $('#theme-edit-dialog .theme-image + i')[0].className = 'zmdi zmdi-attachment-alt';
            }
            $('.theme-apply').removeClass('active-button');
            $('#theme-edit-dialog').modal();
        }

        $('.theme-image + i').on('click', function(){
            if (this.classList.contains('zmdi-close')) {
                $('#theme-edit-dialog .theme-image').val('components/com_gridbox/assets/images/default-theme.png');
                $('.theme-apply').addClass('active-button');
            }
        });

        $('span.theme-settings').on('mousedown', function(){
            item = currentContext.find('input[type="checkbox"]');
            var obj = {
                id : item.val(),
                name : currentContext.find('p > span').not('.default-theme').text(),
                default : currentContext.find('p').attr('data-default'),
                image : currentContext.find('.image-container').attr('data-image')
            };
            pageId = obj.id;
            themeTitle = obj.name;
            setThemeSettings(obj);
        });
        
        $('#toolbar-theme-settings').on('click', function(){
            var options = new Array(),
                message = $('.jlib-selection').val();
            $('#installed-themes-view input[type="checkbox"]').each(function(){
                if ($(this).prop('checked')) {
                    item = $(this);
                    var label = item.closest('label'),
                        obj = {
                            id : $(this).val(),
                            name : label.find('p > span').not('.default-theme').text(),
                            default : label.find('p').attr('data-default'),
                            image : label.find('.image-container').attr('data-image')
                        };
                    options.push(obj);
                }
            });
            if (options.length == 0 || options.length > 1) {
                alert(message);
            } else {
                pageId = options[0].id;
                setThemeSettings(options[0]);
            }
        });

        $('.theme-image').on('click', function(){
            uploadMode = 'themeImage';
            checkIframe($('#uploader-modal'), 'uploader');
        });

        $('.theme-name').on('input', function(event){
            event.stopPropagation();
            event.preventDefault();
            var val = $(this).val();
            val = $.trim(val);
            if (val && themeTitle != val) {
                $('.theme-apply').addClass('active-button');
            } else {
                $('.theme-apply').removeClass('active-button');
            }
        });

        $('.theme-default').on('change', function(event){
            event.stopPropagation();
            event.preventDefault();
            var val = this.value.trim();
            if (val && themeTitle != val) {
                $('.theme-apply').addClass('active-button');
            } else {
                $('.theme-apply').removeClass('active-button');
            }
        });

        $('.theme-apply').on('click', function(event){
            event.stopPropagation();
            event.preventDefault();
            if (!$(this).hasClass('active-button')) {
                return false;
            }
            var name = $('#theme-edit-dialog .theme-name').val(),
                image = $('.theme-image').val();
                defaultTheme = 0,
                oldDefault = 0;
            if ($('#theme-edit-dialog .theme-default').prop('disabled')) {
                oldDefault = 1;
            }
            if ($('#theme-edit-dialog .theme-default').prop('checked')) {
                defaultTheme = 1;
            }
            $.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=theme.updateParams",
                data:{
                    ba_id: pageId,
                    image : image,
                    theme_title: name,
                    default_theme: defaultTheme,
                    old_default: oldDefault
                },
                success: function(msg){
                    showNotice(msg)
                    if (defaultTheme == 1) {
                        var i = $('#installed-themes-view span.default-theme');
                        $('#installed-themes-view label').each(function(){
                            $(this).find('p').attr('data-default', 0);
                        });
                        item.closest('label').find('p').attr('data-default', 1).prepend(i);
                    }
                    item.closest('label').find('.image-container').attr('data-image', image);
                    if (image.indexOf('balbooa.com') !== -1) {
                        item.closest('label').find('.image-container').css('background-image', 'url('+image+')');
                    } else {
                        item.closest('label').find('.image-container').css('background-image', 'url(../'+image+')');
                    }
                    item.closest('label').find('p span').not('.default-theme').text(name);
                    $('#theme-edit-dialog').modal('hide');
                }
            });
        });

        loadPage();
    });
})(jQuery);