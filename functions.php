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

add_action( 'wp_enqueue_scripts', 'fc_theme_builder_dequeue_jquery');

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