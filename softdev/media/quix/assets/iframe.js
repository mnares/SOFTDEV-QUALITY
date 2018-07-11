/**
 * @copyright  Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
(function($, window, document) {
  "use strict";

  window.updateQuixPageData = function() {
      var f = window.frames.quixframe;
      var value = f.getQuixPageData();

      jQuery('#jform_data').val(value);
      return true;
  };

  window.updateResponsiveDeviceCookie = function(device) {
      Cookies.set('qx-device', device);
      return true;
  }

  window.getResponsiveDeviceCookie = function(device) {
      return Cookies.get('qx-device', 'desktop');
  }

  // Update body class
  window.updateBodyDeviceClass = function(currentDevice) {
      var device = Cookies.get('qx-device'),
        iframeWrapper = jQuery('.qx-fb-frame-preview'),
        iframe = jQuery('#quix-iframe-wrapper'),
        deviceSize = {
          desktop : jQuery(window).width(),
          tablet : '768px',
          mobile : '480px'
        }
      iframeWrapper.attr('data-preview', device);
      // Resize iframe
      iframeWrapper.css({
        'width': deviceSize[device]
      });

      return;
  }

  window.ajaxPageSaveQuix = function() {
    $.when( function(){
      var url = Joomla.getOptions('system.paths').root + '/index.php?option=com_quix&task=page.save';
      var data = $('#adminForm').serialize();
      console.log(data);
      $.ajax({
        data, url, type: 'POST',
        success: function (res) {
          res = JSON.parse(res);

          if (!res.success) {
            return reject(res);
          }

          return resolve(res);
        }
      });
      //TODO:: previous comment
    }() ).done(function(response) {
      console.log(response);
    });
  }


  $(function() {
    
      var currentDevice = 'desktop';

      // Update browser class based on cookie device name
      window.updateBodyDeviceClass(currentDevice);
  });

  // Summernote editor
  window.loadEditor = function (selector, callback, content) {
    jQuery(selector).summernote({
      callbacks: {
        onChange: callback
      }
    });

    setTimeout(function () { 
        jQuery(selector).summernote('code', content);
    }, 100);
  }

  window.destroyEditor = function (selector) {
    jQuery(selector).summernote('destroy');
  }

  window.getEditorValue = function (selector) {
    return jQuery(selector).summernote('code');
  }


})(window.jQuery, window, document);
// The global jQuery object is passed as a parameter