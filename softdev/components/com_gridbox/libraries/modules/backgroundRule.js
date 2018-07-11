/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.backgroundRule = function(obj, selector){
    var str = '';
    str += selector+" > .ba-overlay {background-color: ";
    if (!obj.overlay.type || obj.overlay.type == 'color') {
        str += getCorrectColor(obj.overlay.color)+";";
        str += 'background-image: none;';
    } else if (obj.overlay.type == 'none') {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: none;';
    } else {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: '+obj.overlay.gradient.effect+'-gradient(';
        if (obj.overlay.gradient.effect == 'linear') {
            str += obj.overlay.gradient.angle+'deg';
        } else {
            str += 'circle';
        }
        str += ', '+getCorrectColor(obj.overlay.gradient.color1)+' ';
        str += obj.overlay.gradient.position1+'%, '+getCorrectColor(obj.overlay.gradient.color2);
        str += ' '+obj.overlay.gradient.position2+'%);';
        str += 'background-attachment: scroll;';
    }
    str += "}";
    str += selector+" > .ba-video-background {display: ";
    if (obj.background.type == 'video') {
        str += 'block';
    } else {
        str += 'none';
    }
    str += ";}";
    if (obj.background && obj.background.type) {
        str += selector+" {";
        switch (obj.background.type) {
            case 'image' :
                if (obj.background.image) {
                    var image = obj.background.image.image;
                    if (obj.image) {
                        image = obj.image.image;
                    }
                    if (image.indexOf('balbooa.com') != -1) {
                        str += "background-image: url("+image+");";
                    } else {
                        str += "background-image: url("+JUri+encodeURI(image)+");";
                    }
                    for (var key in obj.background.image) {
                        if (key == 'image') {
                            continue;
                        }
                        str += "background-"+key+": "+obj.background.image[key]+";";
                    }
                }
                str += "background-color: rgba(0, 0, 0, 0);";
                break;
            case 'gradient' :
                str += 'background-image: '+obj.background.gradient.effect+'-gradient(';
                if (obj.background.gradient.effect == 'linear') {
                    str += obj.background.gradient.angle+'deg';
                } else {
                    str += 'circle';
                }
                str += ', '+getCorrectColor(obj.background.gradient.color1)+' ';
                str += obj.background.gradient.position1+'%, '+getCorrectColor(obj.background.gradient.color2);
                str += ' '+obj.background.gradient.position2+'%);';
                str += "background-color: rgba(0, 0, 0, 0);";
                str += 'background-attachment: scroll;';
                break;
            case 'color' :
                str += "background-color: "+getCorrectColor(obj.background.color)+";";
                str += "background-image: none;";
                break;
            default :
                str += "background-image: none;";
                str += "background-color: rgba(0, 0, 0, 0);";
                
        }
        if (obj.shadow) {
            str += "box-shadow: 0 "+(obj.shadow.value * 10);
            str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
        }
        str += "}";
    }
    
    return str;
}

function getCorrectColor(key)
{
    return app.theme.colorVariables[key] ? app.theme.colorVariables[key].color : key;
}

function getFontUrl()
{
    var str = '';
    for (var key in app.fonts) {
        str += key+':';
        for (var i = 0; i < app.fonts[key].length; i++) {
            str += app.fonts[key][i];
            if (i != app.fonts[key].length - 1) {
                str += ',';
            } else {
                str += '%7C';
            }
        }
    }
    if (str) {
        app.setNewFont = false;
        str = '//fonts.googleapis.com/css?family='+str.slice(0, -3);
        str += '&subset=latin,cyrillic,greek,latin-ext,greek-ext,vietnamese,cyrillic-ext';
        var file = document.createElement('link');
        file.rel = 'stylesheet';
        file.type = 'text/css';
        file.href = str;
        document.getElementsByTagName('head')[0].appendChild(file);
    }
    prepareCustomFonts();
}

function prepareCustomFonts()
{
    var str = '';
    for (var ind in app.customFonts) {
        var url = '',
            obj = app.customFonts[ind];
        for (var key in obj) {
            var family = ind.replace(/\+/g, ' ');
            str += "@font-face {font-family: '"+family+"'; ";
            str += "font-weight: "+key+"; ";
            str += "src: url("+JUri+"templates/gridbox/library/fonts/"+obj[key]+");} "; 
        }
    }
    if (str) {
        var file = document.createElement('style');
        file.innerHTML = str;
        document.getElementsByTagName('head')[0].appendChild(file);
    }
}

function getTextParentFamily(obj, key)
{
    var family = obj[key]['font-family'];
    if (family == '@default') {
        family = obj.body['font-family'];
    }

    return family;
}

function getTextParentWeight(obj, key)
{
    var weight = obj[key]['font-weight'];
    if (weight == '@default') {
        weight = obj.body['font-weight'];
    }

    return weight;
}

function getTextParentCustom(obj, key)
{
    var custom = obj[key].custom,
        family = obj[key]['font-family'];
    if (family == '@default') {
        custom = obj.body.custom;
    }

    return custom;
}

function getTypographyRule(obj, not, key)
{
    var str = "",
        object = app.theme,
        family, weight, custom,
        font = 'body';
    if (app.itemType && ($g('#'+app.itemType).closest('footer.footer').length > 0 ||
        ($g('#'+app.itemType).length == 0 && app.edit && typeof(app.edit) == 'string' &&
            app.edit != 'body' && $g('#'+app.edit).closest('footer.footer').length > 0))) {
        object = app.footer;
    }
    if (app.itemType && key) {
        font = key;
    }
    for (var ind in obj) {
        if (ind != not)  {
            if (ind == 'font-family') {
                family = obj[ind];
                if (family == '@default') {
                    family = getTextParentFamily(object.desktop, font)
                }
                str += ind+" : '"+family.replace(/\+/g, ' ')+"'";
            } else if (ind == 'font-weight') {
                weight = obj[ind];
                if (weight == '@default') {
                    weight = getTextParentWeight(object.desktop, font);
                }
                str += ind+" : "+weight.replace('i', '');
            } else if (ind == 'color') {
                str += 'color:'+getCorrectColor(obj[ind]);
            } else if (ind != 'custom') {
                str += ind+" : "+obj[ind];
            } else if (ind == 'custom') {
                custom = obj[ind]
            }
            if (ind == 'letter-spacing' || ind == 'font-size' || ind == 'line-height') {
                if (obj[ind] === '') {
                    str += '0';
                }
                str += "px";
            }
            str += ";";
        }
    }
    if (obj['font-family'] && obj['font-family'] == '@default') {
        custom = getTextParentCustom(object.desktop, font);
    }
    if (app.setNewFont && family) {
        if (custom) {
            if (!app.customFonts[family]) {
                app.customFonts[family] = {};
            }
            if (!app.customFonts[family][weight]) {
                app.customFonts[family][weight] = custom;
            }
        } else {
            if (!app.fonts[family]) {
                app.fonts[family] = new Array();
            }
            if ($g.inArray(weight, app.fonts[family]) == -1) {
                app.fonts[family].push(weight);
            }
        }
    }
    
    return str;
}

if (app.blogEditor) {
    app.fonts = {};
    for (var key in app.theme.desktop) {
        switch (key) {
            case 'h1' :
            case 'h2' :
            case 'h3' :
            case 'h4' :
            case 'h5' :
            case 'h6' :
            case 'p' :
            case 'body' :
                if (!app.fonts[app.theme.desktop[key]['font-family']]) {
                    app.fonts[app.theme.desktop[key]['font-family']] = new Array();
                }
                if ($g.inArray(app.theme.desktop[key]['font-weight'], app.fonts[app.theme.desktop[key]['font-family']]) == -1) {
                    app.fonts[app.theme.desktop[key]['font-family']].push(app.theme.desktop[key]['font-weight']);
                }
                break
        }
    }
}
app.setNewFont = true;
app.fonts = {};
app.customFonts = {};
app.checkModule('themeRules');
app.checkModule('sectionRules');
app.checkModule('siteRules');