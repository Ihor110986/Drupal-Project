/**
 * @file
 * My custom theme behaviors.
 */
(function (Drupal) {

  'use strict';

  Drupal.behaviors.myCustomTheme = {
    attach: function (context, settings) {

      console.log('It works!');

    }
  };

} (Drupal));
