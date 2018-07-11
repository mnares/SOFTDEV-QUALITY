// ----------------------------------------------------------------------------
// Assets Helper, a Javascript Assets Helper library Licensed under the MIT
// license.
// ----------------------------------------------------------------------------
// Copyright (C) Iftekher Sunny < iftekhersunny@hotmail.com >
// ----------------------------------------------------------------------------
(function ($, _) {

  /////////////////////////////////////////////////////////
  //
  // instance of global object
  //
  /////////////////////////////////////////////////////////
  var root = window;

  /////////////////////////////////////////////////////////
  //
  // instance of assets object
  //
  /////////////////////////////////////////////////////////
  var Assets = root.Assets || {
    name: "assets-helper",
    version: "0.0.0"
  };

  /////////////////////////////////////////////////////////
  //
  // instance of assets._css object
  //
  /////////////////////////////////////////////////////////
  Assets._css = {
    desktop: {},
    tablet: {},
    phone: {}
  };

  /////////////////////////////////////////////////////////
  //
  // storing responsive css rules
  //
  /////////////////////////////////////////////////////////
  Assets._responsiveCssRules = function (device, selector, rules) {
    if (!Assets._css[device][selector]) {
      Assets._css[device][selector] = '';
    }

    Assets._css[device][selector] += rules;
  }

  /////////////////////////////////////////////////////////
  //
  // storing desktop css rules
  //
  /////////////////////////////////////////////////////////
  Assets.desktop = function (selector, rules) {
    Assets._responsiveCssRules("desktop", selector, rules);
  }

  /////////////////////////////////////////////////////////
  //
  // storing tablet css rules
  //
  /////////////////////////////////////////////////////////
  Assets.tablet = function (selector, rules) {
    Assets._responsiveCssRules("tablet", selector, rules);
  }

  /////////////////////////////////////////////////////////
  //
  // storing phone css rules
  //
  /////////////////////////////////////////////////////////
  Assets.phone = function (selector, rules) {
    Assets._responsiveCssRules("phone", selector, rules);
  }


  //=============================================
  // CSS API's to use from element/node
  //=============================================

  /////////////////////////////////////////////////////////
  // Wrapper function for Assets.desktop
  // Provide clean and understanable API for dev
  /////////////////////////////////////////////////////////
  Assets.css = function (selector, prop, value) {
    if( _.isObject(value) ) return;

    Assets.desktop(selector, Assets._prop(prop, value));
  }

  // Margin (Responsive)
  //=============================================
  Assets.margin = function (selector, field) {
    Assets.desktop(selector, Assets._cssForDimensions(field, 'margin'));

    if (field.responsive) {
      Assets.tablet(selector, Assets._cssForDimensions(field.tablet, 'margin'));
      Assets.phone(selector, Assets._cssForDimensions(field.phone, 'margin'));
    }
  }

  // Padding (responsive)
  //=============================================
  Assets.padding = function (selector, field) {
    Assets.desktop(selector, Assets._cssForDimensions(field, 'padding'));

    if (field.responsive) {
      Assets.tablet(selector, Assets._cssForDimensions(field.tablet, 'padding'));
      Assets.phone(selector, Assets._cssForDimensions(field.phone, 'padding'));
    }
  }


  // Width (responsive)
  //=============================================
  Assets.width = function (selector, field, unit) {
    unit = unit || 'px';
    return Assets.responsiveCss(selector, field, 'width', unit);
  }

  // Height (responsive)
  //=============================================
  Assets.height = function (selector, field, unit) {
    unit = unit || 'px';
    
    return Assets.responsiveCss(selector, field, 'height', unit);
  }
  
  // Min Height (responsive)
  //=============================================
  Assets.minHeight = function (selector, field, unit) {
    unit = unit || 'px';
    
    return Assets.responsiveCss(selector, field, 'min-height', unit);
  }

  // Typography
  //=============================================
  Assets.typography = function (selector, field) {
    // Family
    if (!_.isEmpty(field.family)) {
      Assets.css(selector, 'font-family', field.family)
      Assets.fontWeight(selector, field.weight)

      // dynamically google fonts loading
      let fontNotLoaded = ! jQuery('link[href="http://fonts.googleapis.com/css?family=' + field.family.replace(" ", "+") + '"]').length;

      if (fontNotLoaded) {
        WebFont.load({
          google: {
            families: [`${field.family}`]
          }
        });
      }
      
    }
    // Size
    Assets.fontSize(selector, field.size)
    // Transform
    if (!_.isEmpty(field.transform)) {
      Assets.css(selector, 'text-transform', field.transform)
    }
    // Style
    if (!_.isEmpty(field.style)) {
      Assets.css(selector, 'font-style', field.style)
    }
    // Decoration
    if (!_.isEmpty(field.decoration)) {
      Assets.css(selector, 'text-decoration', field.decoration)
    }
    // Line Height
    Assets.lineHeight(selector, field.height)
    // Letter spacing
    Assets.letterSpacing(selector, field.spacing)
  }

  // Font-weight
  //=============================================
  Assets.fontWeight = function (selector, weight) {
    var fontStyle = false

    switch (weight) {
      case 'regular':
        weight = 400;
        break;
      case '100italic':
        weight = 100;
        fontStyle = true;
        break;
      case '300italic':
        weight = 300;
        fontStyle = true;
        break;
      case '500italic':
        weight = 500;
        fontStyle = true;
        break;
      case '600italic':
        weight = 600;
        fontStyle = true;
        break;
      case '700italic':
        weight = 700;
        fontStyle = true;
        break;
      case '800italic':
        weight = 800;
        fontStyle = true;
        break;
      case '900italic':
        weight = 900;
        fontStyle = true;
        break;
    }

    Assets.css(selector, 'font-weight', weight);

    if (fontStyle) {
      Assets.css(selector, 'font-style', 'italic');
    }
  }

  // Font size (responsive)
  //=============================================
  Assets.fontSize = function (selector, field) {
    Assets.responsiveCss(selector, field, 'font-size', 'px')
  }

  // line-height (responsive)
  //=============================================
  Assets.lineHeight = function (selector, field, unit) {
    unit = unit || '';
    Assets.responsiveCss(selector, field, 'line-height', unit)
  }

  // Letter spacing (responsive)
  //=============================================
  Assets.letterSpacing = function (selector, field) {
    Assets.responsiveCss(selector, field, 'letter-spacing', 'px')
  }

  // Text alignement (responsive)
  Assets.alignment = function (selector, field) {

    if (!_.isEmpty(field.desktop.value)) {
      Assets.desktop(selector, Assets._prop('text-align', field.desktop.value))
    }

    if (field.responsive) {
      if( !_.isEmpty(field.tablet.value) ) {
        Assets.tablet(selector, Assets._prop('text-align', field.tablet.value))
      }
      if( !_.isEmpty(field.phone.value) ){
        Assets.phone(selector, Assets._prop('text-align', field.phone.value))
      }
    }
  }

  // float (responsive)
  //=============================================
  Assets.float = function (selector, field) {

    if ((field.desktop == 'left') || (field.desktop == 'right')) {
      Assets.desktop(selector, Assets._prop('float', field.desktop))
    }

    if (field.responsive) {
      if ((field.tablet == 'left') || (field.tablet == 'right')) {
        Assets.tablet(selector, Assets._prop('float', field.tablet))
      }

      if ((field.phone == 'left') || (field.phone == 'right')) {
        Assets.phone(selector, Assets._prop('float', field.phone))
      }
    }
  }

  // Background
  //=============================================
  Assets.background = function (selector, field, hover_selector) {
    // Get state
    var state = field.state;

    if(!state) return;
    
    // State : Normal
    // ---------------------------------------
    var normal = state.normal
    
    // Type = Gradient
    if (normal.type == 'gradient') {
      var color_1 = normal.properties.color_1
      var color_2 = normal.properties.color_2
      // Gradient Type
      var gradient_type = normal.properties.type
      var direction = normal.properties.direction

      // Suffix position with %
      var start_position = normal.properties.start_position + '%'
      var end_position = normal.properties.end_position + '%'

      var css = color_1 + ' ' + start_position + ',' + color_2 + ' ' + end_position

      if (gradient_type == 'linear') {
        direction = direction + 'deg'
        css = direction + ', ' + css

        Assets.css(selector, 'background', 'linear-gradient(' + css + ')')
      }
      if (gradient_type == 'radial') {
        direction = 'at ' + direction
        css = direction + ', ' + css

        Assets.css(selector, 'background', 'radial-gradient(' + css + ')')
      }

    }
    // Type : Classic
    if (normal.type == 'classic') {
      
      if( !_.isEmpty(normal.properties.color)){
        Assets.css(selector, "background-color", normal.properties.color)
      }

      if (!_.isEmpty(normal.properties.src)) {

        let src = normal.properties.src;

        if ( ! _.isNull(src.url) ) {
          Assets.css(selector, 'background-image', 'url(' + src.url + ')')
        } else {
          if (src.media.type != "svg") 
            Assets.css(selector, 'background-image', 'url(' + FILE_MANAGER_ROOT_URL + src.media.image + ')')
        }
        
        Assets.css(selector, 'background-size', normal.properties.size)
        Assets.css(selector, 'background-position', normal.properties.position)
        Assets.css(selector, 'background-repeat', normal.properties.repeat)

        if (normal.properties.parallax && (normal.properties.parallax_method === 'css')) {
          Assets.css(selector, 'background-attachment', 'fixed')
        }
        if( normal.properties.blend != 'normal' ){
          Assets.css(selector, 'background-blend-mode', normal.properties.blend)
        }
      }
    }
    // Opacity
    if( normal.required_opacity ){
      Assets.css(selector, "opacity", normal.opacity)
    }

    
    // State : Hover
    // -----------------------------------
    var hover = state.hover
    
    // Sometime we need to pass hover selector 
    // Like background overlay
    if( hover_selector ){
      selector = hover_selector + ':hover ' + selector
    }else{
      selector = selector + ':hover'
    }

    // Type = Gradient
    if (hover.type == 'gradient') {
      var color_1 = hover.properties.color_1
      var color_2 = hover.properties.color_2
      // Gradient type
      var gradient_type = hover.properties.type

      var direction = hover.properties.direction

      // Suffix position with %
      var start_position = hover.properties.start_position + '%'
      var end_position = hover.properties.end_position + '%'

      var css = color_1 + ' ' + start_position + ',' + color_2 + ' ' + end_position

      if (gradient_type == 'linear') {
        direction = direction + 'deg'
        css = direction + ', ' + css

        Assets.css(selector, 'background', 'linear-gradient(' + css + ')')
      }
      if (gradient_type == 'radial') {
        direction = 'at ' + direction
        css = direction + ', ' + css

        Assets.css(selector, 'background', 'radial-gradient(' + css + ')')
      }

    }
    // Type : Image
    if (hover.type == 'classic') {
      if( !_.isEmpty(hover.properties.color)){
        Assets.css(selector, "background-color", hover.properties.color)
      }
      if (!_.isEmpty(hover.properties.src)) {
        
        let src = hover.properties.src;

        if ( !_.isNull(src.url) ) {
          Assets.css(selector, 'background-image', 'url(' + src.url + ')')
        } else {
          if (src.media.type != "svg") 
            Assets.css(selector, 'background-image', 'url(' + FILE_MANAGER_ROOT_URL + src.media.image + ')')
        }

        Assets.css(selector, 'background-size', hover.properties.size)
        Assets.css(selector, 'background-position', hover.properties.position)
        Assets.css(selector, 'background-repeat', hover.properties.repeat)
        
        if( hover.properties.blend != 'normal' ){
          Assets.css(selector, 'background-blend-mode', hover.properties.blend)
        }
      }
    }
    // Opacity
    if( hover.required_opacity ){
      Assets.css(selector, "opacity", hover.opacity)
    }
    // Transition
    if( hover.required_transition ){
      var transition = "background "+ hover.transition +"s, opacity "+hover.transition+"s"
      Assets.css(selector, "transition", transition )
    }
  }

  // Border Width
  //=============================================
  Assets.borderWidth = function (selector, field) {
    Assets.desktop(selector, Assets._cssForBorderWidth(field));

    if (field.responsive) {
      Assets.tablet(selector, Assets._cssForBorderWidth(field.tablet));
      Assets.phone(selector, Assets._cssForBorderWidth(field.phone));
    }
  }
  
  // Border Width
  //=============================================
  Assets.borderRadius = function (selector, field) {
    Assets.desktop(selector, Assets._cssForBorderRadius(field));

    if (field.responsive) {
      Assets.tablet(selector, Assets._cssForBorderRadius(field.tablet));
      Assets.phone(selector, Assets._cssForBorderRadius(field.phone));
    }
  }

  //=============================================
  // Private functions
  //=============================================

  // Generate CSS for border width
  //=============================================
  Assets._cssForBorderWidth = function (field) {
    var css = '';

    css += Assets._prop('border-top-width', field.top + 'px');
    css += Assets._prop('border-right-width', field.right + 'px');
    css += Assets._prop('border-bottom-width', field.bottom + 'px');
    css += Assets._prop('border-left-width', field.left + 'px');
    return css;
  }
  
  // Generate CSS for border radius
  //=============================================
  Assets._cssForBorderRadius = function (field) {
    var css = '';

    css += field.top ? Assets._prop('border-top-left-radius', field.top + 'px') : ''
    css += field.right ? Assets._prop('border-top-right-radius', field.right + 'px') : ''
    css += field.bottom ? Assets._prop('border-bottom-right-radius', field.bottom + 'px') : ''
    css += field.left ? Assets._prop('border-bottom-left-radius', field.left + 'px') : ''
    return css;
  }
  
  // Generate CSS for dimensions
  //=============================================
  Assets._cssForDimensions = function (field, type) {
    var css = '';

    css += Assets._prop(type + '-top', field.top + 'px');
    css += Assets._prop(type + '-right', field.right + 'px');
    css += Assets._prop(type + '-bottom', field.bottom + 'px');
    css += Assets._prop(type + '-left', field.left + 'px');

    return css;
  }

  // Create css prop : value rules
  //=============================================
  Assets._prop = function (prop, value, $boolean) {
    $boolean = $boolean || null;
   
    var zeroAllowedProp = [
      'padding-bottom',
      'padding-top',
      'padding-right',
      'padding-left',
      'margin-bottom',
      'margin-top',
      'margin-right',
      'margin-left',
      'border-width',
      'border-top-width',
      'border-bottom-width',
      'border-right-width',
      'border-left-width'
    ];

    if (
        !value || 
        (0 == value) || 
        ('0%' == value) || 
        ('0px' == value) || 
        ('0em' == value) || 
        ('0rem' == value) || 
        _.isEmpty(value)
      ){

      if (_.isNumber(value) && 0 != value) return prop + " : " + value + "; ";
      else if (zeroAllowedProp.indexOf(prop) != -1) return prop + " : " + value + "; ";
      else return "";
    }

    return value == "px" ? "" : prop + " : " + value + "; ";
  }

  // Create responsive CSS
  //=============================================
  Assets.responsiveCss = function (selector, field, prop, unit) {
    unit = unit || "";

    if ( !_.isEmpty(field.desktop) || _.isNumber(field.desktop) ) {
      Assets.desktop(selector, Assets._prop(prop, field.desktop + unit))
    } 

    if (field.responsive) {
      if (!_.isEmpty(field.tablet) || _.isNumber(field.desktop) ) {
        Assets.tablet(selector, Assets._prop(prop, field.tablet + unit))
      }
      if (!_.isEmpty(field.phone) || _.isNumber(field.desktop) ){
        Assets.phone(selector, Assets._prop(prop, field.phone + unit))
      }
    }
  }

  /////////////////////////////////////////////////////////
  //
  // appending stylesheet to the head tag
  //
  /////////////////////////////////////////////////////////
  Assets._appendStyleSheet = function (css, id, mountID) {
    var head = document.head || document.getElementsByTagName('head')[0],
      style = document.createElement('style');

    style.type = 'text/css';
    if (style.styleSheet) {
      style.styleSheet.cssText = css;
    } else {
      style.appendChild(document.createTextNode(css));
    }

    // if style already exists then remove it
    if (mountID) {
      id = mountID.replace("#", "");
      style.id = id;
      $("style#" + id).remove();
    } else {
      id = id.replace("#", "");
      style.id = id;
      $("style#" + id).remove();
    }

    // append style
    head.appendChild(style);
  }

  /////////////////////////////////////////////////////////
  //
  // loading css rules
  //
  /////////////////////////////////////////////////////////
  Assets.load = function (id, mountID) {
    var desktop = '',
      tablet = "@media (min-width: 768px) and (max-width: 1024px) { ",
      phone = "@media (max-width: 767px) { ";

    // appending all desktop rules
    for (var key in Assets._css.desktop) {
      desktop += key + " { " + Assets._css.desktop[key] + " } ";
    }

    // appending all tablet rules
    for (var key in Assets._css.tablet) {
      tablet += key + " { " + Assets._css.tablet[key] + " } ";
    }

    tablet += " } ";

    // appending all phone rules
    for (var key in Assets._css.phone) {
      phone += key + " { " + Assets._css.phone[key] + " } ";
    }

    phone += " } ";

    // appending responsive rules ( desktop, tablet, and phone ) to the style tag
    Assets._appendStyleSheet(desktop + tablet + phone, id, mountID);

    Assets._css = {
      desktop: {},
      tablet: {},
      phone: {}
    };
  }

  /////////////////////////////////////////////////////////
  //
  // assigning Assets object to the Global object
  //
  /////////////////////////////////////////////////////////
  return root.Assets = Assets;

}(

  /////////////////////////////////////////////////////////
  //
  // determine jQuery existence
  //
  /////////////////////////////////////////////////////////
  window.jQuery ? window.jQuery : undefined,

  /////////////////////////////////////////////////////////
  //
  // determine lodash existence
  //
  /////////////////////////////////////////////////////////
  window._ ? window._ : undefined)
);
// ----------------------------------------------------------------------------
// Assets Helper, a Javascript Assets Helper library
// Licensed under the MIT license.
// ----------------------------------------------------------------------------
// Copyright (C) Iftekher Sunny < iftekhersunny@hotmail.com >
// ----------------------------------------------------------------------------
(function (_) {


    /////////////////////////////////////////////////////////
    //
    // instance of global object
    //
    /////////////////////////////////////////////////////////
    var root = window;


    
    /////////////////////////////////////////////////////////
    //
    // instance of assets object
    //
    /////////////////////////////////////////////////////////
    var Assets = root.Assets || {
        name: "assets-helper",
        version: "0.0.0"
    };



    /////////////////////////////////////////////////////////
    //
    // getting image url
    //
    /////////////////////////////////////////////////////////
    Assets.image = function(path) {
        var hostname = root.location.hostname,
            port = root.location.port == 80 ? "" : ":" + root.location.port,
            protocol = root.location.protocol,
            protocols = ['http', 'https', '//'];

        
        for(key in protocols) {
            if (path.indexOf(protocols[key]) != -1) return path;
        }

       return protocol + "//" + hostname + port + "/" + path;   
    }



    /////////////////////////////////////////////////////////
    //
    // assigning Assets object to the Global object
    //
    /////////////////////////////////////////////////////////
    return root.Assets = Assets;

}(
    /////////////////////////////////////////////////////////
    //
    // determine lodash existence
    //
    /////////////////////////////////////////////////////////
    window._ ? window._ : undefined)
);
// ----------------------------------------------------------------------------
// Assets Helper, a Javascript Assets Helper library
// Licensed under the MIT license.
// ----------------------------------------------------------------------------
// Copyright (C) Iftekher Sunny < iftekhersunny@hotmail.com >
// ----------------------------------------------------------------------------
if (window.twig) {
    (function ($, _, twig) {

        /////////////////////////////////////////////////////////
        //
        // instance of global object
        //
        /////////////////////////////////////////////////////////
        var root = window;



        /////////////////////////////////////////////////////////
        //
        // instance of assets object
        //
        /////////////////////////////////////////////////////////
        var Assets = root.Assets || {
            name: "assets-helper",
            version: "0.0.0"
        };



        /////////////////////////////////////////////////////////
        //
        // an array of loaded element
        //
        /////////////////////////////////////////////////////////
        Assets.loadedElement = [];



        /////////////////////////////////////////////////////////
        //
        // init
        //
        /////////////////////////////////////////////////////////
        Assets.init = function () {
            document.createElement("QuixTemplate");
            document.createElement("QuixHtml");
            document.createElement("QuixStyle");
            document.createElement("QuixScript");

            $(function () {
                $("QuixTemplate").css({ display: "none" })
            });

            // cheat way to ignore include "global.twig" when twigjs compile
            twig({
                id: 'global.twig',
                data: ""
            });
        }



        /////////////////////////////////////////////////////////
        //
        // get html markup by the given template and data
        //
        /////////////////////////////////////////////////////////
        Assets.html = function (templateID, data, htmlRenderId) {
            data = data || {};

            // check QuixHtml tag existence
            if (!$("QuixTemplate" + templateID + " QuixHtml").html()) return;

            return twig({
                allowInlineIncludes: true,
                data: $("QuixTemplate" + templateID + " QuixHtml").html()
            })
                .renderAsync(Object.assign(data, { $: $, _: _, Assets, FILE_MANAGER_ROOT_URL }))
                .then(function (output) {
                    // console.log(
                    //     `======= DEDUG ${templateID} HTML =======`,
                    //     output,
                    //     `========================================`
                    // )

                    if (!htmlRenderId) return output;

                    $(htmlRenderId).html(output);
                })
        }



        /////////////////////////////////////////////////////////
        //
        // get css rules by the given template and data
        //
        /////////////////////////////////////////////////////////
        Assets.style = function (templateID, data, mountID) {
            data = data || {};

            // check QuixStyle tag existence
            if (!$("QuixTemplate" + templateID + " QuixStyle").html()) return;

            // making inline script content
            var script = twig({
                allowInlineIncludes: true,
                data: $("QuixTemplate" + templateID + " QuixStyle").html()
            })
                .render(Object.assign(data, { $: $, _: _, Assets, FILE_MANAGER_ROOT_URL }));

            // loading inline script
            var inlineScript = document.createElement("script");

            inlineScript.innerHTML = script;

            // if script already exists
            // then remove it
            if (mountID) {
                var id = mountID.replace("#", "");
                inlineScript.id = id;
            } else {
                var id = templateID.replace("#", "");
                inlineScript.id = id;
            }

            $("script#" + id).remove();

            document.body.appendChild(inlineScript);

            Assets.load(templateID, mountID);
        }



        /////////////////////////////////////////////////////////
        //
        // loading script by the given template and data
        //
        /////////////////////////////////////////////////////////
        Assets.script = function (templateID, data, mountID) {
            data = data || {};

            // check QuixScript tag existence
            if (!$("QuixTemplate" + templateID + " QuixScript").html()) return;

            // making inline script content
            var script = twig({
                allowInlineIncludes: true,
                data: $("QuixTemplate" + templateID + " QuixScript").html()
            })
                .render(Object.assign(data, { $: $, _: _, Assets, FILE_MANAGER_ROOT_URL }));

            // getting dependencies
            var filters = $("QuixTemplate" + templateID + " QuixScript").attr('dependencies')
                ? $("QuixTemplate" + templateID + " QuixScript").attr('dependencies').split(",")
                : [];

            // loading all dependencies of the inline script                
            if ($.inArray(templateID, Assets.loadedElement) == -1) {
                for (let key in filters) {
                    var scriptTag = document.createElement("script");
                    var src = "";

                    // if quix loaded
                    if (window.QUIX_URL) {
                        src = window.QUIX_URL + filters[key].replace(/\s/g, '');
                    }

                    scriptTag.src = src;
                    document.head.appendChild(scriptTag);
                }
            }

            // loading inline script
            var inlineScript = document.createElement("script");

            inlineScript.innerHTML = script;

            // if script already exists
            // then remove it
            if (mountID) {
                id = mountID.replace("#", "");
                inlineScript.id = id;
            } else {
                id = templateID.replace("#", "");
                inlineScript.id = id;
            }

            $("script#" + id).remove();

            document.body.appendChild(inlineScript);

            // saved loaded element
            Assets.loadedElement.push(templateID);
        }



        /////////////////////////////////////////////////////////
        //
        // rendering html template the given templateId and data
        //
        /////////////////////////////////////////////////////////
        Assets.render = function (templateID, data, mountID) {

            if (templateID.indexOf("#") == -1) {
                return twig({
                    allowInlineIncludes: true,
                    data: templateID
                })
                    .render(Object.assign(data, { $: $, _: _, Assets, FILE_MANAGER_ROOT_URL }));
            }

            var style = Assets.style(templateID, data, mountID),
                id = Math.random().toFixed(4);

            var html = Assets.html(templateID, data)

            if (_.isObject(html)) {
                html.then(function (html) {
                    var output = "" +
                        "<div id='" + templateID + "-" + id + "'>" +
                        "<div>" +
                        html +
                        "</div>" +
                        "</div>";

                    if (!mountID) return output;

                    // loading style and html    
                    $("div" + mountID).html(output);

                    // loading script
                    Assets.script(templateID, data);
                })
            } else {
                var output = "" +
                    "<div id='" + templateID + "-" + id + "'>" +
                    "<div>" +
                    html +
                    "</div>" +
                    "</div>";

                if (!mountID) return output;

                // loading style and html    
                $("div" + mountID).html(output);

                // loading script
                Assets.script(templateID, data);
            }
        }



        /////////////////////////////////////////////////////////
        //
        // calling init
        //
        /////////////////////////////////////////////////////////
        Assets.init();



        /////////////////////////////////////////////////////////
        //
        // assigning Assets object to the Global object
        //
        /////////////////////////////////////////////////////////
        return root.Assets = Assets;

    }(

        /////////////////////////////////////////////////////////
        //
        // determine jQuery existence
        //
        /////////////////////////////////////////////////////////
        window.jQuery ? window.jQuery : undefined,

        /////////////////////////////////////////////////////////
        //
        // determine lodash existence
        //
        /////////////////////////////////////////////////////////
        window._ ? window._ : undefined,

        /////////////////////////////////////////////////////////
        //
        // determine twigjs existence
        //
        /////////////////////////////////////////////////////////
        window.twig ?


            /////////////////////////////////////////////////////////
            //
            // if twigjs loaded,
            // return instance of the loaded twigjs
            //
            /////////////////////////////////////////////////////////
            window.twig : (function () {
                console.log("Unable to load Twig engine. Please contact support@themexpert.com");

                return undefined;
            }())
    ));
}
