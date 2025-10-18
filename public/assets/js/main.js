/*
Template Name: Billig - Invoice HTML Template
Author: Webartinfo
Version: 0.1
*/


!(function($) {
  "use strict";

  // Preloader
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });

})(jQuery);