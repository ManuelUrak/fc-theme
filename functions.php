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

// Register custom Worpdress post types

function fc_theme_register_custom_post_types(){
	$post_types = array(
		'forms' => array(
			'label' => esc_html(btb__('Formulare')),
			'labels' => array(
				'name' => esc_html(btb__('Formulare')),
				'singular_name' => esc_html( btb__( 'Formular' ) ),
				'add_new_item' => esc_html( btb__( 'Neues Formular hinzufügen' ) ),
				'edit_item' => esc_html( btb__( 'Formular bearbeiten' ) ),
				'new_item' => esc_html( btb__( 'Neues Formular' ) ),
				'view_item' => esc_html( btb__( 'Formular ansehen' ) ),
				'view_items' => esc_html( btb__( 'Formulare ansehen' ) ),
				'search_items' => esc_html( btb__( 'Formulare durchsuchen' ) ),
				'not_found' => esc_html( btb__( 'Keine Formulare gefunden.' ) ),
				'not_found_in_trash' => esc_html( btb__( 'Keine Formulare im Papierkorb gefunden.' ) ),
				'all_items' => esc_html( btb__( 'Alle Formulare' ) ),
				'archives' => esc_html( btb__( 'Formular-Archiv' ) ),
				'attributes' => esc_html( btb__( 'Formular-Attribute' ) ),
				'item_published' => esc_html( btb__( 'Formular veröffentlicht.' ) ),
				'item_published_privately' => esc_html( btb__( 'Formular privat veröffentlicht.' ) ),
				'item_reverted_to_draft' => esc_html( btb__( 'Formular auf Entwurf zurückgesetzt.' ) ),
				'item_scheduled' => esc_html( btb__( 'Formular geplant.' ) ),
				'item_updated' => esc_html( btb__( 'Formular aktualisiert.' ) )
			),
			'description' => '',
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'has_archive' => false, 
			'show_in_menu' => true,
			'menu_position' => 70,
			'show_in_nav_menus' => false,
			'delete_with_user' => false,
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'capabilities' => array(
				'edit_post' => 'manage_forms',
				'read_post' => 'manage_forms',
				'delete_post' => 'manage_forms',
				'edit_posts' => 'manage_forms',
				'edit_others_posts' => 'manage_forms',
				'delete_posts' => 'manage_forms',
				'publish_posts' => 'manage_forms',
				'read_private_posts' => 'manage_forms'
			),
			'map_meta_cap' => false,
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'forms',
				'with_front' => true
			),
			'query_var' => true,
			'menu_icon' => 'dashicons-forms',
			'supports' => array(
				'title',
				'revisions'
			)
		),
		'form_submissions' => array(
			'label' => esc_html( btb__( 'Formular-Einträge' ) ),
			'labels' => array(
				'name' => esc_html( btb__( 'Formular-Einträge' ) ),
				'singular_name' => esc_html( btb__( 'Formular-Eintrag' ) ),
				'edit_item' => esc_html( btb__( 'Formular-Eintrag ansehen' ) ),
				'view_item' => esc_html( btb__( 'Formular-Eintrag ansehen' ) ),
				'view_items' => esc_html( btb__( 'Formular-Einträge ansehen' ) ),
				'search_items' => esc_html( btb__( 'Formular-Einträge durchsuchen' ) ),
				'not_found' => esc_html( btb__( 'Keine Formular-Einträge gefunden.' ) ),
				'not_found_in_trash' => esc_html( btb__( 'Keine Formular-Einträge im Papierkorb gefunden.' ) ),
				'all_items' => esc_html( btb__( 'Formular-Einträge' ) ),
				'archives' => esc_html( btb__( 'Formular-Einträge-Archiv' ) ),
				'attributes' => esc_html( btb__('Formular-Einträge-Attribute' ) ),
				'item_published' => esc_html( btb__( 'Formular-Eintrag veröffentlicht.' ) ),
				'item_published_privately' => esc_html( btb__( 'Formular-Eintrag privat veröffentlicht.' ) ),
				'item_reverted_to_draft' => esc_html( btb__( 'Formular-Eintrag auf Entwurf zurückgesetzt.' ) ),
				'item_scheduled' => esc_html( btb__( 'Formular-Eintrag geplant.' ) ),
				'item_updated' => esc_html( btb__( 'Formular-Eintrag aktualisiert.' ) )
			),
			'description' => '',
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'has_archive' => false, 
			'show_in_menu' => 'edit.php?post_type=forms',
			'show_in_nav_menus' => false,
			'delete_with_user' => false,
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'capabilities' => array(
				'create_posts' => 'do_not_allow'
			),
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'form_submissions',
				'with_front' => true
			),
			'query_var' => true,
			'supports' => false
		)
	);

	foreach($post_types as $post_type => $args){
		register_post_type($post_type, $args);
	}
}

add_action('init', 'fc_theme_register_custom_post_types');

function fc_theme_edit_post_updated_messages( $messages ) {
	global $post;
	$messages[ 'forms' ] = array(
		0 => '',
		1 => esc_html( btb__( 'Formular aktualisiert.' ) ),
		2 => esc_html( btb__( 'Benutzerdefiniertes Feld aktualisisert.' ) ),
		3 => esc_html( btb__( 'Benutzerdefiniertes Feld gelöscht' ) ),
		4 => esc_html( btb__( 'Formular aktualisiert.' ) ),
		5 => ( isset( $_GET[ 'revision' ] ) ? sprintf( esc_html( btb__( 'Formular aus Revision vom %s wiederhergestellt.' ) ), wp_post_revision_title( (int) $_GET[ 'revision' ], false ) ) : false ),
		6 => esc_html( btb__( 'Formular veröffentlicht.' ) ),
		7 => esc_html( btb__( 'Formular gespeichert.' ) ),
		8  => esc_html( btb__( 'Formular abgeschickt.' ) ),
		9 => esc_html( btb__( 'Formular geplant.' ) ),
		10 => esc_html( btb__( 'Formular aktualisiert.' ) )
	);

	return $messages;
}

add_filter( 'post_updated_messages', 'fc_theme_edit_post_updated_messages' );

function fc_theme_add_custom_post_type_caps() {
	$role = get_role( 'administrator' );
	$role->add_cap( 'manage_forms' ); 
}

add_action( 'init', 'fc_theme_add_custom_post_type_caps' );

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

function fc_theme_responsive_image( $attachment_id, $size, $max_width ) {
	return sprintf( 
		'src="%s" data-src="%s" data-srcset="%s" data-sizes="(max-width:%4$s) 100vw, %4$s"', 
		esc_url( wp_get_attachment_image_url( $attachment_id, 'lazy-loading' ) ), 
		esc_url( wp_get_attachment_image_url( $attachment_id, $size ) ), 
		esc_attr( wp_get_attachment_image_srcset( $attachment_id, $size ) ), 
		esc_attr( $max_width ) 
	);
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

// Register custom Gutenberg blocks

function fc_theme_register_blocks() {
	if ( function_exists( 'acf_register_block' ) ) {
		acf_register_block_type( array(
			'name' => 'button',
			'title' => esc_html( btb__( 'Button' ) ),
			'render_template' => 'template-parts/blocks/block-button.php',
			'category' => 'design',
			'icon' => 'button',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'button'
			)
		) );
		acf_register_block_type( array(
			'name' => 'form',
			'title' => esc_html( btb__( 'Formular' ) ),
			'render_template' => 'template-parts/blocks/block-form.php',
			'category' => 'widgets',
			'icon' => 'forms',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false,
				'multiple' => false
			),
			'keywords' => array(
				'form',
				'formular'
			)
		) );
		acf_register_block_type( array(
			'name' => 'hero',
			'title' => esc_html( btb__( 'Hero' ) ),
			'render_template' => 'template-parts/blocks/block-hero.php',
			'category' => 'design',
			'icon' => 'superhero-alt',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'hero'
			)
		) );
		acf_register_block_type( array(
			'name' => 'icon',
			'title' => esc_html( btb__( 'Icon' ) ),
			'render_template' => 'template-parts/blocks/block-icon.php',
			'category' => 'design',
			'icon' => 'carrot',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'icon'
			)
		) );
		acf_register_block_type( array(
			'name' => 'image',
			'title' => esc_html( btb__( 'Bild' ) ),
			'render_template' => 'template-parts/blocks/block-image.php',
			'category' => 'media',
			'icon' => 'format-image',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'image',
				'bild'
			)
		) );
		acf_register_block_type( array(
			'name' => 'image-gallery',
			'title' => esc_html( btb__( 'Bildergalerie' ) ),
			'render_template' => 'template-parts/blocks/block-image-gallery.php',
			'category' => 'media',
			'icon' => 'format-gallery',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'image-gallery',
				'bildergalerie'
			)
		) );
		acf_register_block_type( array(
			'name' => 'paragraph',
			'title' => esc_html( btb__( 'Absatz' ) ),
			'render_template' => 'template-parts/blocks/block-paragraph.php',
			'category' => 'text',
			'icon' => 'editor-alignleft',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'paragraph',
				'absatz'
			)
		) );
		acf_register_block_type( array(
			'name' => 'paragraph-image',
			'title' => esc_html( btb__( 'Absatz (Bild)' ) ),
			'render_template' => 'template-parts/blocks/block-paragraph-image.php',
			'category' => 'text',
			'icon' => 'align-right',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'paragraph (image)',
				'absatz (bild)'
			)
		) );
		acf_register_block_type( array(
			'name' => 'posts',
			'title' => esc_html( btb__( 'Beiträge' ) ),
			'render_template' => 'template-parts/blocks/block-posts.php',
			'category' => 'widgets',
			'icon' => 'format-aside',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'posts',
				'beiträge'
			)
		) );
		acf_register_block_type( array(
			'name' => 'quote',
			'title' => esc_html( btb__( 'Zitat' ) ),
			'render_template' => 'template-parts/blocks/block-quote.php',
			'category' => 'design',
			'icon' => 'format-quote',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'quote',
				'zitat'
			)
		) );
		acf_register_block_type( array(
			'name' => 'separator',
			'title' => esc_html( btb__( 'Trennlinie' ) ),
			'render_template' => 'template-parts/blocks/block-separator.php',
			'category' => 'design',
			'icon' => 'minus',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'separator',
				'trennlinie'
			)
		) );
		acf_register_block_type( array(
			'name' => 'shortcode',
			'title' => esc_html( btb__( 'Shortcode' ) ),
			'render_template' => 'template-parts/blocks/block-shortcode.php',
			'category' => 'widgets',
			'icon' => 'shortcode',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,
				'mode' => false
			),
			'keywords' => array(
				'shortcode'
			)
		) );
		acf_register_block_type( array(
			'name' => 'video',
			'title' => esc_html( btb__( 'Video' ) ),
			'render_template' => 'template-parts/blocks/block-video.php',
			'category' => 'media',
			'icon' => 'format-video',
			'mode' => 'edit',
			'supports' => array(
				'align' => false,	
				'mode' => false
			),
			'keywords' => array(
				'video'
			)
		) );
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