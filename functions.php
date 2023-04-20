<?php

//Prevent direct access to the wordpress directory

if(!defined('ABSPATH')){
    exit;
}

//Import further additional custom functions

require_once('includes/style.php');
require_once('includes/submit.php');

//Setup theme support

function fc_theme_setup(){
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    remove_theme_support('core-block-patterns');
    load_theme_textdomain('fc-theme', trailingslashit(get_template_directory()) . 'languages');
}

add_action('after_setup_theme', 'fc_theme_setup');

// Enqueue admin scripts and styles

function fc_theme_enqueue_admin_scripts_styles(){
    wp_enqueue_style('fc-theme-admin-default-style', trailingslashit(get_template_directory_uri()) . 'assets/css/admin-default-style.css', array(), false, 'all');
    wp_enqueue_script('fc-theme-admin-default-script', trailingslashit(get_template_directory_uri()). 'assets/js/admin-default-script.js', array(
        'jquery'
    ), '1.0', true);
}

add_action('admin_enqueue_scripts', 'fc_theme_enqueue_admin_scripts_styles');

// Enqueue required libraries, scripts and styles

function fc_theme_enqueue_scripts_styles() {
	wp_enqueue_style('slick-carousel-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css', array(), '1.8.1', 'all');
	wp_enqueue_style('swipebox-style', '//cdn.jsdelivr.net/npm/jquery.swipebox@1.4.4/src/css/swipebox.min.css', array(), '1.4.4', 'all');
	wp_enqueue_style('text-security', '//cdn.jsdelivr.net/npm/text-security@3.1.1/text-security.min.css', array(), '3.1.1', 'all');
	wp_enqueue_style('fc-theme-default-webfonts', trailingslashit(get_template_directory_uri()) . 'assets/css/default-webfonts.css', array(), false, 'all');
	wp_enqueue_style('fc-theme-default-style', trailingslashit(get_template_directory_uri()) . 'assets/css/default-style.css', array(
		'text-security'
	), false, 'all');
	wp_enqueue_script('js-cookie', '//cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min.js', array(
		'jquery'
	), '2.2.1', true);
	wp_enqueue_script('jquery.lazy', '//cdn.jsdelivr.net/npm/jquery-lazy@1.7.11/jquery.lazy.min.js', array(
		'jquery'
	), '1.7.11', true);
	wp_enqueue_script('jquery.lazy.plugins', '//cdn.jsdelivr.net/npm/jquery-lazy@1.7.11/jquery.lazy.plugins.min.js', array(
		'jquery',
		'jquery.lazy'
	), '1.7.11', true);
	wp_enqueue_script('object-fit-images', '//cdn.jsdelivr.net/npm/object-fit-images@3.2.4/dist/ofi.min.js', array(
		'jquery'
	), '3.2.4', true);
	wp_enqueue_script('url-search-params', '//cdn.jsdelivr.net/npm/url-search-params-polyfill@8.0.0/index.min.js', array(
		'jquery'
	), '8.0.0', true);
	wp_enqueue_script('jquery-validation', '//cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js', array(
		'jquery'
	), '1.19.3', true);
	wp_enqueue_script('jquery-validation-de', '//cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/localization/messages_de.min.js', array(
		'jquery',
		'jquery-validation'
	), '1.19.3', true);
	wp_enqueue_script('fSelect', '//cdn.jsdelivr.net/gh/mgibbs189/fSelect@1.0/fSelect.min.js', array(
		'jquery'
	), '1.0', true);
	wp_enqueue_script('flatpickr', '//cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js', array(
		'jquery'
	), '4.6.9', true);
	wp_enqueue_script('flatpickr-de', '//cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/de.min.js', array(
		'jquery',
		'flatpickr'
	), '4.6.9', true);
	wp_enqueue_script('slick-carousel-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(
		'jquery'
	), '1.8.1', true);
	wp_enqueue_script('swipebox-script', '//cdn.jsdelivr.net/npm/jquery.swipebox@1.4.4/src/js/jquery.swipebox.min.js', array(
		'jquery'
	), '1.4.4', true);
	wp_enqueue_script( 'fc-theme-default-script', trailingslashit(get_template_directory_uri()) . 'assets/js/default-script.js', array(
		'jquery',
		'js-cookie',
		'jquery.lazy',
		'jquery.lazy.plugins',
		'object-fit-images',
		'url-search-params',
		'jquery-validation',
		'jquery-validation-de',
		'fSelect',
		'flatpickr',
		'flatpickr-de',
		'slick-carousel-script',
		'swipebox-script'
	), '1.0', true);
}

add_action( 'wp_enqueue_scripts', 'fc_theme_enqueue_scripts_styles' );