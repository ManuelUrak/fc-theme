<?php 

//Prevent direct access to the file

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Add Google Webfonts API to Wordpress transient

function fc_theme_load_google_webfonts() {
	$webfonts_api = wp_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAPspnPYeknRPJsVyEw-v4-JyHEO7C9NEo' );
	if ( !empty( $webfonts_api ) && !is_wp_error( $webfonts_api ) ) {
		$webfonts_api_decoded = json_decode( $webfonts_api[ 'body' ], true );
		set_transient( 'webfonts_api', json_encode( $webfonts_api_decoded[ 'items' ] ) );
	}
}
add_action( 'admin_init', 'fc_theme_load_google_webfonts' );

// Set ACF field values as WP-SCSS variables

function fc_theme_set_wp_scss_variables() {
	$fields = array(
		'colors_background_colors_header' => 'field_60797c754a7fb',
		'colors_background_colors_body' => 'field_606d81cb7a3fe',
		'colors_background_colors_footer' => 'field_60797c6e4a7fa',
		'colors_background_colors_images' => 'field_607984da4a7fc',
		'colors_background_colors_overlays' => 'field_607ec544f361d',
		'typography_general_font_family' => 'field_606d74f1ceced',
		'typography_general_font_weight' => 'field_606d74f1cecee',
		'typography_general_font_size' => 'field_606d74f1cecef',
		'typography_general_line_height' => 'field_606d74f1cecf0',
		'typography_general_letter_spacing' => 'field_606d74f1cecf1',
		'typography_general_color' => 'field_606d74f1cecf2',
		'typography_h1_font_family' => 'field_606d6521dde9b',
		'typography_h1_font_weight' => 'field_606d65afdde9c',
		'typography_h1_font_size' => 'field_606d6727dde9d',
		'typography_h1_line_height' => 'field_606d67e7dde9f',
		'typography_h1_letter_spacing' => 'field_606d684bddea0', 
		'typography_h1_color' => 'field_606d675cdde9e',
		'typography_h2_font_family' => 'field_606d798fcecf4',
		'typography_h2_font_weight' => 'field_606d798fcecf5',
		'typography_h2_font_size' => 'field_606d798fcecf6',
		'typography_h2_line_height' => 'field_606d798fcecf7',
		'typography_h2_letter_spacing' => 'field_606d798fcecf8',
		'typography_h2_color' => 'field_606d798fcecf9',
		'typography_h3_font_family' => 'field_606d799acecfb',
		'typography_h3_font_weight' => 'field_606d799acecfc',
		'typography_h3_font_size' => 'field_606d799acecfd',
		'typography_h3_line_height' => 'field_606d799acecfe',
		'typography_h3_letter_spacing' => 'field_606d799acecff',
		'typography_h3_color' => 'field_606d799aced00'
	);
	if ( !empty( $webfonts_json = get_transient( 'webfonts_api' ) ) ) {
		$webfonts = json_decode( $webfonts_json, true );
		foreach ( $fields as $field_name => $field_key ) {
			$field_object = ( get_field_object( 'options_' . $field_name, 'option' ) ?: get_field_object( $field_key, 'option' ) );
			if ( $field_object[ '_name' ] == 'font_family' && !empty( $search_key = array_search( ( $field_object[ 'value' ] ?: $field_object[ 'default_value' ] ), array_column( $webfonts, 'family' ) ) ) ) {
				$variables[ $field_name ] = ( $field_object[ 'value' ] ?: $field_object[ 'default_value' ] ) . ', ' . $webfonts[ $search_key ][ 'category' ];
			} else {
				$variables[ $field_name ] = ( $field_object[ 'value' ] ?: $field_object[ 'default_value' ] ) . ( isset( $field_object[ 'append' ] ) ? $field_object[ 'append' ] : '' );
			}
		}
		return $variables;
	}
}
add_filter( 'wp_scss_variables', 'fc_theme_set_wp_scss_variables' );

// Dynamically populate ACF select field’s choices

function fc_theme_acf_select_choices( $field ) {
	$field[ 'choices' ] = array();
	if ( !empty( $webfonts_json = get_transient( 'webfonts_api' ) ) ) {
		$webfonts = json_decode( $webfonts_json, true );
		foreach ( $webfonts as $webfont ) {
			$field[ 'choices' ][ $webfont[ 'family' ] ] = $webfont[ 'family' ];
		}
	}
	return $field;
}
add_filter( 'acf/load_field/name=font_family', 'fc_theme_acf_select_choices' );

// Enqueue custom inline styles

function fc_theme_enqueue_inline_styles() {
	$field_group = acf_get_field_group( 'group_606d62b8584e1' );
	if ( !$field_group[ 'active' ] ) {
		return;
	}
	if ( !empty( $webfonts_json = get_transient( 'webfonts_api' ) ) ) {
		$webfonts = json_decode( $webfonts_json, true );
		$fields = array(
			'typography_general' => 'field_606d74f1cecec',
			'typography_h1' => 'field_606d6328dde9a',
			'typography_h2' => 'field_606d798fcecf3',
			'typography_h3' => 'field_606d799acecfa'
		);
		foreach ( $fields as $field_name => $field_key ) {
			$field_object = ( get_field_object( 'options_' . $field_name, 'option' ) ?: get_field_object( $field_key, 'option' ) );
			foreach ( $field_object[ 'sub_fields' ] as $sub_field_key => $sub_field_value ) {
				if ( empty( $sub_field_value[ 'value' ] ) ) {
						$sub_field_value[ 'value' ] = ( $field_object[ 'value' ][ $sub_field_value[ '_name' ] ] ?: $sub_field_value[ 'default_value' ] );
					if ( in_array( $sub_field_value[ '_name' ], array( 'font_family', 'font_weight' ) ) ) {
						$field_objects[ $field_name ][ $sub_field_value[ '_name' ] ] = $sub_field_value[ 'value' ];
					}
				}
			}
		}
		$field_objects = array_unique( $field_objects, SORT_REGULAR );
		foreach ( $field_objects as $field_object ) {
			if ( !empty( $search_key = array_search( $field_object[ 'font_family' ], array_column( $webfonts, 'family' ) ) ) ) {
				if ( in_array( ( $field_object[ 'font_weight' ] == '400' ? 'regular' : $field_object[ 'font_weight' ] ), $webfonts[ $search_key ][ 'variants' ] ) ) {
					$field_object[ 'font_file' ] = str_replace( 'http://', 'https://', $webfonts[ $search_key ][ 'files' ][ ( $field_object[ 'font_weight' ] == '400' ? 'regular' : $field_object[ 'font_weight' ] ) ] );
					$font_styles[] = sprintf( '@font-face{font-family:"%s";font-weight:%s;font-display:swap;src:url("%s");}', esc_html( $field_object[ 'font_family' ] ), $field_object[ 'font_weight' ], esc_url( $field_object[ 'font_file' ] ) );
				}
			}
		}
	}
	wp_add_inline_style( 'fc-theme-default-style', implode( '', $font_styles ) );
}
add_action( 'wp_enqueue_scripts', 'fc_theme_enqueue_inline_styles', 20 );

?>