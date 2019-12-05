<?php
define('TEMPLATE_URI', get_template_directory_uri());

if (!function_exists('mimi_theme_setup')) {
  function mimi_theme_setup() {
    load_theme_textdomain('mimi', TEMPLATE_URI . '/languages');

    add_theme_support('automatic-feed-links');

    register_nav_menu('primary-menu', __('Primary Menu', 'mimi'));
  }
  add_action('after_theme_setup', 'mimi_theme_setup');
}