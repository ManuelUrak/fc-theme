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

function fc_theme_enqueue_scripts_styles(){
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

add_action( 'wp_enqueue_scripts', 'fc_theme_enqueue_scripts_styles');

// Dequeue Gutenberg block styles

function fc_theme_dequeue_block_styles(){
	wp_dequeue_style('wp-block-library');
}

add_action('wp_print_styles', 'fc_theme_dequeue_block_styles', 100);

// Setup jQuery

function fc_theme_dequeue_jquery(){
	wp_deregister_script('jquery');
	wp_deregister_script('jquery-migrate');
	wp_enqueue_script('jquery', '//cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js', array(), '3.5.1', true);
	wp_enqueue_script('jquery-migrate', '//cdn.jsdelivr.net/npm/jquery-migrate@3.3.1/dist/jquery-migrate.min.js', array(), '3.3.1', true);
}

add_action( 'wp_enqueue_scripts', 'fc_theme_dequeue_jquery');

// Deregister Wordpress WP Embed

function fc_theme_deregister_wp_embed(){
	wp_deregister_script('wp-embed');
}

add_action('wp_footer', 'fc_theme_deregister_wp_embed');

// Remove Wordpress WP Emoji

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// Disable Wordpress application password

add_filter('wp_is_application_passwords_available', '__return_false');

// Disable Wordpress XML Sitemap

add_filter('wp_sitemaps_enabled', '__return_false');

// Hide Wordpress admin bar

add_filter('show_admin_bar', '__return_false');

// Hide Wordpress theme editor

function fc_theme_hide_theme_editor(){
	define('DISALLOW_FILE_EDIT', true);
}

add_action('init', 'fc_theme_hide_theme_editor');

// Remove Wordpress admin bar nodes

function fc_theme_remove_admin_bar_nodes(){
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	if(is_multisite()){
		foreach ((array) $wp_admin_bar->user->blogs as $blog){
			$menu_id = 'blog-' . $blog->userblog_id;
			$wp_admin_bar->remove_menu( $menu_id  . '-c');
		}
	}
}

add_action('wp_before_admin_bar_render', 'fc_theme_remove_admin_bar_nodes');

// Remove Wordpress admin menu pages

function fc_theme_remove_admin_menu_pages(){
	remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'fc_theme_remove_admin_menu_pages');

// Remove Wordpress dashboard meta boxes

function fc_theme_remove_dashboard_meta_boxes(){
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}

add_action('admin_init', 'fc_theme_remove_dashboard_meta_boxes');

// Remove Wordpress post type supports

function fc_theme_remove_post_type_supports(){
	remove_post_type_support('page', 'comments');
	remove_post_type_support('page', 'trackbacks');
	remove_post_type_support('post', 'comments');
	remove_post_type_support('post', 'trackbacks');
}

add_action('init', 'fc_theme_remove_post_type_supports', 100);

// Hide/close existing Wordpress comments

add_filter('comments_array', '__return_empty_array', 10, 2);
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Remove Wordpress category paragraphs

remove_filter('term_description', 'wpautop');
remove_filter('get_the_post_type_description', 'wpautop');

// Remove Wordpress title prefixes

function fc_theme_remove_title_prefixes($title){
	if(is_category()){
		$title = single_cat_title('', false);
	}elseif(is_tag()){
		$title = single_tag_title('', false);
	}elseif(is_post_type_archive()){
		$title = post_type_archive_title('', false);
	}elseif(is_tax()){
		$title = single_term_title('', false);
	}

	return $title;
}

add_filter('get_the_archive_title', 'fc_theme_remove_title_prefixes');

// Reorder Wordpress admin menu

function fc_theme_reorder_admin_menu($menu_ord){
	$plugins = array_diff($menu_ord, array( 
		'edit.php',
		'edit.php?post_type=forms',
		'edit.php?post_type=page',
		'index.php',
		'options-general.php',
		'plugins.php',
		'separator-last',
		'separator1',
		'separator2',
		'themes.php',
		'tools.php',
		'upload.php',
		'users.php'
	));
	if(!empty($plugins)){
		sort($plugins);
		$menu_ord = array_merge($menu_ord, $plugins);
	}

	return $menu_ord;
}

if(!function_exists('fc_theme_child_reorder_admin_menu')){
	add_filter('menu_order', 'fc_theme_reorder_admin_menu');
}

add_filter('custom_menu_order', '__return_true');

// Edit default Wordpress post type support

function fc_theme_edit_post_type_support($args, $post_type){
	if($post_type === 'post'){
		$args['show_in_nav_menus'] = false;
		$args['menu_position'] = 19;
	}

	return $args;
}

add_filter('register_post_type_args', 'fc_theme_edit_post_type_support', 20, 2);

// Unregister default Wordpress post type taxonomies

function fc_theme_unregister_post_type_taxonomies(){
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

add_action('init', 'fc_theme_unregister_post_type_taxonomies');

// Disable Wordpress author archive page

function fc_theme_disable_author_archive(){
	if(is_author()){
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
	}
}

add_action('wp', 'fc_theme_disable_author_archive');

// Set Wordpress archive query args

function fc_theme_archive_query_args( $query ) {
	if ( !is_admin() && $query->is_front_page() && $query->is_main_query() ) {
		$query->set( 'post_type', 'post' );
		$query->set( 'posts_per_page', -1 );
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
	}
}

add_action( 'pre_get_posts', 'fc_theme_archive_query_args' );
	
// Register Wordpress custom menu

function fc_theme_register_custom_menus() {
	register_nav_menu( 'main-menu', esc_html( btb__( 'Main-Menü' ) ) );
	register_nav_menu( 'footer-menu', esc_html( btb__( 'Footer-Menü' ) ) );
}

add_action( 'init', 'fc_theme_register_custom_menus' );

// Add active class to Wordpress menus

function fc_theme_add_menu_css_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-ancestor', $classes ) ) {
		$classes[] = 'active';
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'fc_theme_add_menu_css_class', 10, 2 );

// Remove empty Wordpress menu links

function fc_theme_remove_empty_menu_links( $menu ) {
	return preg_replace( '/<a href=\"#\">(.+?)<\/a>/is', '<span class="sub-menu-parent" >$1</span>', $menu );
}

add_filter( 'wp_nav_menu_items', 'fc_theme_remove_empty_menu_links' );

// Set default Wordpress image size

update_option( 'thumbnail_size_w', '150', 'yes' );
update_option( 'thumbnail_size_h', '150', 'yes' );
update_option( 'thumbnail_crop', '0', 'yes' );
update_option( 'medium_size_w', '480', 'yes' );
update_option( 'medium_size_h', '0', 'yes' );
update_option( 'medium_large_size_w', '768', 'yes' );
update_option( 'medium_large_size_h', '0', 'yes' );
update_option( 'large_size_w', '1024', 'yes' );
update_option( 'large_size_h', '0', 'yes' );

// Add custom Wordpress image size

add_image_size( 'lazy-loading', 50, 50, false );

// Generate responsive Wordpress images 
//TODO: Delete this function after after all dependend child themes are upgraded. Since it's now deprecated.

function fc_theme_responsive_image( $attachment_id, $size, $max_width ) {
	return sprintf( 
		'src="%s" data-src="%s" data-srcset="%s" data-sizes="(max-width:%4$s) 100vw, %4$s"', 
		esc_url( wp_get_attachment_image_url( $attachment_id, 'lazy-loading' ) ), 
		esc_url( wp_get_attachment_image_url( $attachment_id, $size ) ), 
		esc_attr( wp_get_attachment_image_srcset( $attachment_id, $size ) ), 
		esc_attr( $max_width ) 
	);
}

// Function to render images 

function fc_theme_render_image($imgsrc, $class = '', $alt = '', $title = ''){
	$img_url = wp_get_attachment_image_url($imgsrc, 'medium');

	if(empty($alt)){
		$alt = get_post_meta($imgsrc, '_wp_attachment_image_alt', true);
	}

	if(empty($title)){
		$attachment = get_post($imgsrc);
		$title = $attachment ? $attachment -> post_title : '';
	}

	$img_url = esc_url($img_url);
	$class = esc_attr($class);
	$alt = esc_attr($alt);
	$title = esc_attr($title);

	$image = sprintf(
        '<div class="img-container img-container--contain lazy %s">
            <div class="img-container__inner">
                <img src="%s" data-src="%s" alt="%s" title="%s" class="lazyload"/>
            </div>
        </div>',

		$class,
		$img_url,
		$img_url,
		$alt,
		$title
	);

	return $image;
}

// Set maximum Wordpress image size

function fc_theme_max_image_size() {
	return 2048;
}
add_filter( 'fc_theme_responsive_image', 'fc_theme_max_image_size', 10, 2 );

// Change default Wordpress outgoing sender information

function fc_theme_modify_sender_email( $original_email_address ) {
	$site_url = parse_url( get_bloginfo( 'url' ) );
	$sender_email = sanitize_email( 'no-reply@' . preg_replace( '#^www\.(.+\.)#i', '$1', $site_url[ 'host' ] ) );
	return $sender_email;
}
add_filter( 'wp_mail_from', 'fc_theme_modify_sender_email' );

function fc_theme_modify_sender_name( $original_email_from ) {
	$sender_name = sanitize_text_field( get_bloginfo( 'name' ) );
	return $sender_name;
}
add_filter( 'wp_mail_from_name', 'fc_theme_modify_sender_name' );

// Add custom Wordpress shortcode

function fc_theme_add_custom_shortcode( $atts ) {
	$shortcode_atts = shortcode_atts( array(
		'type' => false
	), $atts );
	if ( !empty( $shortcode_atts[ 'type' ] ) ) {
		$content = get_template_part( 'template-parts/contents/shortcode', $shortcode_atts[ 'type' ], $shortcode_atts );
	}
	return $content;
}
add_shortcode( 'fc_shortcode', 'fc_theme_add_custom_shortcode' );

// Set WP-SCSS options

function fc_theme_wpscss_compile_options() {
	if ( !empty( $user = wp_get_current_user() ) ) {
		if ( !is_admin() && $user->user_login === 'admin' ) {
			define( 'WP_SCSS_ALWAYS_RECOMPILE', true );
		}
	}
}
add_action( 'init', 'fc_theme_wpscss_compile_options' );
$wpscss_options_defaults = array(
	'base_compiling_folder' => ( is_child_theme() ? 'Child Theme' : 'Current Theme' ),
	'scss_dir' => '/assets/scss/',
	'css_dir' => '/assets/css/',
	'compiling_options' => 'ScssPhp\ScssPhp\Formatter\Compressed',
	'sourcemap_options' => 'SOURCE_MAP_NONE',
	'errors' => 'show',
	'enqueue' => 0,
	'recompile' => 0
);
update_option( 'wpscss_options', $wpscss_options_defaults, true );

// Save/Update ACF JSON file

function fc_theme_save_acf_json( $path ) {
	$path = trailingslashit( get_template_directory() ) . 'includes/advanced-custom-fields';
	return $path;
}
add_filter( 'acf/settings/save_json', 'fc_theme_save_acf_json' );

// Load ACF JSON file

function fc_theme_load_acf_json( $paths ) {
	$paths[] = trailingslashit( get_template_directory() ) . 'includes/advanced-custom-fields';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'fc_theme_load_acf_json' );

// Register ACF options page

function fc_theme_register_acf_options() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		$options_pages = array(
			array(
				'page_title' => esc_html( btb__( 'Theme-Einstellungen' ) ),
				'menu_title' => esc_html( btb__( 'Einstellungen' ) ),
				'menu_slug' => 'theme-settings',
				'parent_slug' => 'themes.php',
				'icon_url' => '',
				'update_button' => esc_html( btb__( 'Aktualisieren' ) ),
				'updated_message' => esc_html( btb__( 'Einstellungen aktualisiert' ) )
			),
			array(
				'page_title' => esc_html( btb__( 'Formular-Einstellungen' ) ),
				'menu_title' => esc_html( btb__( 'Einstellungen' ) ),
				'menu_slug' => 'form-settings',
				'parent_slug' => 'edit.php?post_type=forms',
				'icon_url' => '',
				'update_button' => esc_html( btb__( 'Aktualisieren' ) ),
				'updated_message' => esc_html( btb__( 'Einstellungen aktualisiert' ) )
			)
		);
		foreach ( $options_pages as $options_page ) {
			acf_add_options_page( $options_page );
		}
	}
}
add_action( 'acf/init', 'fc_theme_register_acf_options' );

// Edit ACF WYSIWYG-Editor fields

function fc_theme_acf_wysiwyg_editor( $toolbars ) {
	if ( ( $key = array_search( 'numlist', $toolbars[ 'Full' ][ 1 ] ) ) != false ) {
		unset( $toolbars[ 'Full' ][ 1 ][ $key ] );
	}
	if ( ( $key = array_search( 'blockquote', $toolbars[ 'Full' ][ 1 ] ) ) != false ) {
		unset( $toolbars[ 'Full' ][ 1 ][ $key ] );
	}
	if ( ( $key = array_search( 'wp_more', $toolbars[ 'Full' ][ 1 ] ) ) != false ) {
		unset( $toolbars[ 'Full' ][ 1 ][ $key ] );
	}
	if ( ( $key = array_search( 'indent', $toolbars[ 'Full' ][ 2 ] ) ) != false ) {
		unset( $toolbars[ 'Full' ][ 2 ][ $key ] );
	}
	if ( ( $key = array_search( 'outdent', $toolbars[ 'Full' ][ 2 ] ) ) != false ) {
		unset( $toolbars[ 'Full' ][ 2 ][ $key ] );
	}
	if ( ( $key = array_search( 'wp_help', $toolbars[ 'Full' ][ 2 ] ) ) != false ) {
		unset( $toolbars[ 'Full' ][ 2 ][ $key ] );
	}
	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars', 'fc_theme_acf_wysiwyg_editor' );

add_filter( 'tiny_mce_before_init', function( $settings ) {
	$settings[ 'block_formats' ] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3';
	return $settings;
} );

add_filter( 'quicktags_settings', function( $qtInit ) {
	$qtInit[ 'buttons' ] = 'strong,em,link,ul,li,close,fullscreen';
	return $qtInit;
} );

// Allow specific Gutenberg blocks

function fc_theme_allowed_block_types() {
	return array(
		'acf/button',
		'acf/form',
		//'acf/hero',
		//'acf/icon',
		'acf/image',
		'acf/image-gallery',
		'acf/image',
		'acf/paragraph',
		'acf/paragraph-image',
		'acf/posts',
		'acf/quote',
		'acf/separator',
		'acf/shortcode',
		'acf/video',
		'core/block'
	);
}
if ( !function_exists( 'fc_theme_child_allowed_block_types' ) ) {
	add_filter( 'allowed_block_types_all', 'fc_theme_allowed_block_types' );
}

// Lock ACF field for Wordpress non-admin users

function fc_theme_lock_acf_field( $field ) {
	$user = wp_get_current_user();
	if ( empty( $user->roles ) || !in_array( 'administrator', $user->roles ) ) {
		$field[ 'readonly' ] = true;
	} else {
		$field[ 'readonly' ] = false;
	}
	return $field;
}
add_filter( 'acf/load_field/key=field_607ed024f0383', 'fc_theme_lock_acf_field' );

// Block Icon

$block_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
					width="493.000000pt" height="418.000000pt" viewBox="0 0 493.000000 418.000000"
					preserveAspectRatio="xMidYMid meet">

					<g transform="translate(0.000000,418.000000) scale(0.100000,-0.100000)"
					fill="#000000" stroke="none">
					<path d="M390 4174 c-25 -2 -89 -9 -142 -15 -111 -13 -100 2 -119 -158 -15
					-134 -7 -466 15 -581 49 -269 152 -486 299 -633 59 -59 60 -61 48 -91 -102
					-252 -143 -522 -121 -800 6 -76 10 -139 8 -140 -2 -1 -41 -17 -88 -35 -70 -28
					-256 -115 -268 -126 -2 -2 10 -30 27 -63 l31 -61 122 58 c120 57 196 87 203
					79 1 -1 15 -47 29 -100 15 -54 29 -105 32 -113 5 -11 -4 -19 -27 -27 -44 -15
					-278 -132 -303 -150 -17 -14 -17 -17 15 -69 18 -30 34 -56 35 -57 1 -2 31 12
					66 31 66 37 248 117 265 117 6 0 23 -28 37 -63 15 -34 56 -111 91 -170 304
					-513 792 -858 1383 -978 151 -31 508 -38 673 -14 677 98 1268 534 1556 1148
					20 42 41 77 46 77 17 0 200 -81 265 -117 35 -19 65 -33 66 -31 1 1 17 27 35
					57 32 52 32 55 15 69 -25 18 -259 135 -303 150 -23 8 -32 16 -27 27 3 8 17 59
					32 113 14 53 28 99 29 100 7 8 83 -22 203 -79 l122 -58 31 61 c17 33 29 61 27
					63 -12 11 -198 98 -268 126 -47 18 -86 34 -88 35 -2 1 2 63 8 137 22 277 -20
					553 -120 802 -12 29 -11 32 50 95 150 155 246 359 296 627 22 118 30 449 15
					584 -19 160 -7 145 -124 160 -126 16 -433 16 -547 0 -214 -30 -401 -92 -539
					-178 -96 -60 -231 -190 -322 -309 l-70 -91 -62 13 c-315 66 -888 66 -1229 0
					l-68 -13 -69 92 c-91 118 -226 248 -322 308 -136 85 -304 142 -507 172 -98 15
					-360 26 -442 19z m428 -160 c207 -30 386 -99 517 -199 79 -60 181 -175 268
					-301 35 -50 65 -84 75 -84 9 0 44 7 77 14 347 81 904 84 1285 6 54 -11 103
					-20 109 -20 5 0 37 40 71 89 78 114 188 238 265 297 123 96 310 167 522 200
					113 17 423 23 499 10 l41 -7 7 -61 c10 -104 6 -338 -8 -448 -40 -299 -124
					-482 -302 -655 l-102 -100 31 -60 c76 -151 123 -332 137 -540 9 -117 0 -338
					-13 -351 -3 -3 -31 2 -63 10 -180 46 -473 59 -673 31 -231 -33 -451 -102 -671
					-212 -80 -39 -151 -76 -159 -81 -11 -8 -8 -20 18 -66 18 -31 35 -56 38 -56 2
					0 73 34 156 75 427 209 853 266 1268 169 l67 -16 -14 -61 c-13 -55 -43 -158
					-49 -165 -1 -1 -44 9 -96 23 -397 105 -769 97 -1074 -24 -78 -31 -216 -116
					-222 -136 -2 -6 16 -32 40 -59 l43 -49 49 38 c195 150 532 200 910 135 122
					-21 260 -54 283 -69 28 -17 -135 -301 -258 -451 -257 -314 -611 -543 -995
					-643 -178 -47 -285 -60 -485 -60 -310 0 -538 51 -818 184 -315 149 -582 381
					-775 674 -72 110 -161 285 -150 295 14 12 161 48 288 70 376 65 715 14 910
					-135 l49 -38 43 49 c24 27 42 53 40 59 -6 20 -144 105 -222 136 -305 121 -684
					129 -1074 23 -51 -14 -94 -24 -96 -22 -6 7 -36 108 -49 165 l-14 61 67 16
					c126 29 187 37 331 43 318 12 617 -55 937 -212 83 -41 154 -75 156 -75 3 0 20
					25 38 56 37 66 49 52 -121 138 -446 226 -926 293 -1365 191 -32 -8 -61 -13
					-63 -10 -2 2 -8 52 -13 112 -23 259 31 564 135 772 l35 69 -79 72 c-44 40
					-101 100 -126 133 -104 137 -179 352 -204 584 -13 114 -10 456 3 469 25 25
					366 24 545 -2z"/>
					<path d="M1415 2656 c-104 -27 -170 -71 -212 -143 -24 -42 -28 -58 -28 -128 0
					-87 17 -131 79 -208 40 -50 144 -118 226 -148 54 -20 84 -24 180 -24 106 0
					120 2 178 29 148 69 206 204 150 353 -28 77 -127 177 -218 221 -115 56 -250
					74 -355 48z m203 -120 c42 -61 65 -136 65 -209 0 -60 -5 -78 -39 -145 -21 -41
					-44 -77 -51 -79 -13 -5 -55 63 -78 127 -20 55 -22 142 -6 195 13 41 71 145 81
					145 3 0 15 -15 28 -34z"/>
					<path d="M3180 2654 c-137 -29 -276 -127 -334 -234 -81 -148 -23 -313 136
					-386 59 -27 71 -29 183 -28 136 1 200 18 293 80 234 155 258 414 49 529 -98
					54 -201 67 -327 39z m87 -136 c75 -128 74 -244 -3 -376 -14 -24 -31 -41 -37
					-39 -7 2 -30 38 -51 79 -34 67 -39 85 -39 145 0 46 7 86 21 122 20 52 62 121
					72 121 3 0 20 -24 37 -52z"/>
					<path d="M2245 1870 c-40 -13 -72 -31 -95 -55 -31 -32 -35 -42 -34 -85 1 -85
					81 -181 187 -225 l38 -16 -3 -317 c-3 -314 -3 -317 -26 -350 -39 -53 -94 -76
					-187 -76 -194 0 -391 128 -485 317 -22 43 -40 86 -40 93 0 8 -3 14 -6 14 -9 0
					-129 -31 -132 -35 -8 -8 53 -144 91 -203 193 -298 600 -424 816 -252 l41 31
					45 -35 c71 -53 133 -71 250 -70 80 1 115 6 177 27 207 71 379 235 454 433 14
					37 23 68 22 69 -5 5 -116 35 -127 35 -6 0 -11 -6 -11 -13 0 -7 -15 -44 -34
					-82 -94 -197 -292 -329 -491 -329 -93 0 -148 23 -187 76 -23 33 -23 36 -26
					350 l-3 317 46 20 c59 26 101 61 141 118 79 110 34 210 -111 248 -83 21 -234
					19 -310 -5z"/>
					</g>
				</svg>';

// Register custom Gutenberg blocks

function fc_theme_register_blocks() {
	global $block_icon;

	if ( function_exists( 'acf_register_block' ) ) {
		acf_register_block_type(array(
			'name' => 'fc-button-link',
			'title' => 'Button-Link',
			'render_template' => 'template-parts/blocks/fc-block-button-link.php',
			'category' => 'design',
			'icon' => $block_icon,
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false 
			),
			'keywords' => array(
				'button',
				'link',
				'button link'
			)
		));
	}
}
add_action( 'acf/init', 'fc_theme_register_blocks' );

// Theme required plugins

require_once trailingslashit( get_template_directory() ) . 'includes/tgm/class-tgm-plugin-activation.php';
function fc_theme_required_plugins() {
	$plugins = array(
		array(
			'name' => 'ACF Options for Polylang',
			'slug' => 'acf-options-for-polylang',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Advanced Access Manager',
			'slug' => 'advanced-access-manager',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Advanced Custom Fields',
			'slug' => 'advanced-custom-fields',
			'required' => true,
			'force_activation' => true,
			'force_deactivation' => false
		),
		array(
			'name' => 'Advanced Custom Fields PRO',
			'slug' => 'advanced-custom-fields-pro',
			'source' => trailingslashit( get_template_directory() ) . 'includes/tgm/plugins/advanced-custom-fields-pro.zip',
			'required' => true,
			'force_activation' => true,
			'force_deactivation' => false
		),
		array(
			'name' => 'All-in-One WP Migration',
			'slug' => 'all-in-one-wp-migration',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'All-in-One WP Migration (Unlimited Extension)',
			'slug' => 'all-in-one-wp-migration-unlimited-extension',
			'source' => trailingslashit( get_template_directory() ) . 'includes/tgm/plugins/all-in-one-wp-migration-unlimited-extension.zip',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Custom Post Type UI',
			'slug' => 'custom-post-type-ui',
			'required' => true,
			'force_activation' => true,
			'force_deactivation' => false
		),
		array(
			'name' => 'Duplicate Post',
			'slug' => 'duplicate-post',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'EWWW Image Optimizer',
			'slug' => 'ewww-image-optimizer',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'FacetWP',
			'slug' => 'facetwp',
			'source' => trailingslashit( get_template_directory() ) . 'includes/tgm/plugins/facetwp.zip',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Favicon by RealFaviconGenerator',
			'slug' => 'favicon-by-realfavicongenerator',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'GDPR Cookie Compliance',
			'slug' => 'gdpr-cookie-compliance',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Hummingbird – Speed Up WordPress',
			'slug' => 'hummingbird-performance',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Polylang',
			'slug' => 'polylang',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'ACF Post-2-Post',
			'slug' => 'post-2-post-for-acf',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Safe SVG',
			'slug' => 'safe-svg',
			'required' => true,
			'force_activation' => true,
			'force_deactivation' => false
		),
		array(
			'name' => 'Bild ersetzen',
			'slug' => 'replace-image',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'WP-SCSS',
			'slug' => 'wp-scss',
			'required' => true,
			'force_activation' => true,
			'force_deactivation' => false
		)
	);
	$config = array(
		'id' => 'tgmpa',
		'menu' => 'tgmpa-install-plugins',
		'parent_slug' => 'themes.php',
		'capability' => 'install_plugins',
		'has_notices' => true,
		'dismissable' => true,
		'is_automatic' => true
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'fc_theme_required_plugins' );

// Additional custom functions

function html_element( $element = 'article', $echo = true ) {
	$element = esc_attr( $element );
	if ( $echo === true ) {
		echo $element;
	} else {
		return $element;
	}
}

function html_class( $default, array $custom, $echo = true ) {
	if ( !empty( $custom = array_filter( $custom ) ) ) {
		$classes = array_map( function( $value ) use ( $default ) { return ( $default . '--' . $value ); }, $custom );
		array_unshift( $classes, $default );
		$classes = 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
	} else {
		$classes = 'class="' . $default . '"';
	}
	if ( $echo === true ) {
		echo $classes;
	} else {
		return $classes;
	}
}

function btb__( $string ) {
	if ( in_array( 'polylang-pro/polylang.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$translation = pll__( $string );
	} else {
		$translation = __( $string, 'fc_theme' );
	}
	return $translation;
}