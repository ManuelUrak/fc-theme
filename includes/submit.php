<?php 

//Prevent direct access to the file

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register custom Wordpress meta boxes

function fc_theme_register_meta_box() {
	add_meta_box( 'form_data', esc_html( btb__( 'Formulardaten' ) ), 'fc_theme_callback_meta_box_form_data', 'form_submissions', 'normal', 'high' );
	add_meta_box( 'form_attachments', esc_html( btb__( 'Formulardateien' ) ), 'fc_theme_callback_meta_box_form_attachments', 'form_submissions', 'normal' );
	add_meta_box( 'form_source', esc_html( btb__( 'Formularquelle' ) ), 'fc_theme_callback_meta_box_form_source', 'form_submissions', 'normal' );
	add_meta_box( 'confirmation_time', esc_html( btb__( 'Bestätigung' ) ), 'fc_theme_callback_meta_box_confirmation_time', 'form_submissions', 'side', 'high' );
	add_meta_box( 'confirmation_id', esc_html( btb__( 'Bestätigungscode' ) ), 'fc_theme_callback_meta_box_confirmation_id', 'form_submissions', 'side' );
}
add_action( 'add_meta_boxes', 'fc_theme_register_meta_box' );

// Remove default Wordpress bulk actions

function fc_theme_remove_bulk_actions( $actions ) {
	unset( $actions[ 'edit' ] );
	return $actions;
}
add_filter( 'bulk_actions-edit-form_submissions', 'fc_theme_remove_bulk_actions' );

// Remove default Wordpress meta boxes

function fc_theme_remove_meta_box() {
	remove_meta_box( 'submitdiv' , 'form_submissions' , 'normal' ); 
}
add_action( 'admin_menu' , 'fc_theme_remove_meta_box' );

// Edit Wordpress custom admin columns

function fc_theme_edit_posts_admin_columns( $columns ) {
	unset( $columns[ 'date' ] );
	$columns[ 'form_source' ] = esc_html( btb__( 'Formularquelle' ) );
	$columns[ 'confirmation' ] = esc_html( btb__( 'Bestätigung' ) );
	return $columns;
}
add_filter( 'manage_form_submissions_posts_columns', 'fc_theme_edit_posts_admin_columns' );

// Add Wordpress custom admin columns values

function fc_theme_edit_posts_admin_columns_values( $column_name, $post_id ) {
	if ( $column_name === 'form_source' ) {
		if ( !empty( $form_source = get_post_meta( $post_id, 'form_source', true ) ) ) {
			$value = sprintf( '<a href="%s" rel="noopener">%s</a>', esc_url_raw( add_query_arg( array( 'post' => $form_source, 'action' => 'edit' ), admin_url( '/post.php' ) ) ), esc_html( get_the_title( $form_source ) ) );
		} else {
			$value = sprintf( '<span aria-hidden="true">&#8212;</span><span class="screen-reader-text">%s</span>', esc_html( btb__( 'Keine Formularquelle' ) ) );
		}
		echo $value;
	}
	if ( $column_name === 'confirmation' ) {
		$form_data = get_post_meta( $post_id, 'form_data', true );
		if ( !empty( $form_data[ 'email' ] ) ) {
			$confirmation_time = get_post_meta( $post_id, 'confirmation_time', true );
			if ( !empty( $confirmation_time ) ) {
				$value = '<span class="meta-confirmation-time meta-confirmation-time--confirmed">' . esc_html( btb__( 'E-Mail Adresse bestätigt' ) ) . '</span>';
			} else {
				$value = '<span class="meta-confirmation-time meta-confirmation-time--unconfirmed">'. esc_html( btb__( 'E-Mail Adresse nicht bestätigt' ) ) . '</span>';
			}
		} else {
			$value = '<span aria-hidden="true">&#8212;</span><span class="screen-reader-text">' . esc_html( btb__( 'Keine E-Mail Adresse vorhanden' ) ) . '</span>';
		}
		echo $value;
	}
}
add_filter( 'manage_form_submissions_posts_custom_column', 'fc_theme_edit_posts_admin_columns_values', 10, 2 );

// Add Wordpress custom admin columns 

function fc_themer_activate_posts_admin_columns_sort( $columns ) {
	$columns[ 'form_source' ] = 'form_source';
	return $columns;
}
add_filter( 'manage_edit-form_submissions_sortable_columns', 'fc_theme_activate_posts_admin_columns_sort' );

// Add Wordpress posts custom query var

function fc_theme_add_posts_custom_query_vars( $vars ) {
	$vars[] .= 'form_source';
	return $vars;
}
add_filter( 'query_vars', 'fc_theme_add_posts_custom_query_vars' );

// Add Wordpress custom admin column filter

function fc_theme_add_custom_admin_column_filter( $post_type ) {
	if ( $post_type === 'form_submissions' && !empty( get_posts( $post_type ) ) ) {
		global $wpdb;
		$post_ids = $wpdb->get_col(
			$wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE pm.meta_key = '%s'
				AND p.post_status IN ('publish', 'draft')
				ORDER BY pm.meta_value", 
				'form_source'
			)
		);
		echo '<select id="form-source" name="form_source">';
		echo '<option value="0">' . esc_html( btb__( 'Alle Formularquellen' ) ) . ' </option>';
		foreach ( $post_ids as $post_id ) {
			printf( '<option value="%s"%s>%s</option>', esc_attr( $post_id ), ( $_REQUEST[ 'form_source' ] == $post_id ? ' selected' : '' ), esc_html( get_the_title( $post_id ) ) );
		}
	}
}
add_action( 'restrict_manage_posts', 'fc_theme_add_custom_admin_column_filter', 10 );

// Filter Wordpress posts by custom query

function fc_theme_filter_posts_custom_query( $query ) {
	if ( is_admin() && $query->query[ 'post_type' ] === 'form_submissions' ) {
		if ( $query->query_vars[ 'form_source' ] ) {
			$query->set( 'meta_key', 'form_source' );
			$query->set( 'meta_value', $query->query_vars[ 'form_source' ] );
		}
	}
}
add_action( 'pre_get_posts', 'fc_theme_filter_posts_custom_query' );

// Callback custom Wordpress meta boxes

function fc_theme_callback_meta_box_form_data( $post ) {
	$form_data = get_post_meta( $post->ID, 'form_data', true );
	get_template_part( 'template-parts/contents/meta-form', '', array( 'form_data' => $form_data ) );
}

function fc_theme_callback_meta_box_form_attachments( $post ) {
	if ( !empty( $form_attachments = get_post_meta( $post->ID, 'form_attachments', true ) ) ) {
		foreach ( $form_attachments as $key => $value ) {
			$form_attachments[ $key ] = wp_kses( sprintf( '<a href="%s" target="_blank" rel="noopener" download>%s (%s)</a>', wp_get_attachment_url( $value ), basename( get_attached_file( $value ) ), size_format( filesize( get_attached_file( $value ) ), 1 ) ), array( 'a' => array( 'href' => true, 'target' => true, 'rel' => true ) ) );
		}
		echo '<p>' . implode( '</br>', $form_attachments ) . '</p>';
	} else {
		echo '<p>' . esc_html( btb__( 'Keine Formulardateien vorhanden' ) ) . '</p>';
	}
}

function fc_theme_callback_meta_box_form_source( $post ) {
	if ( !empty( $form_source = get_post_meta( $post->ID, 'form_source', true ) ) ) {
		printf( '<p><a href="%s" target="_blank" rel="noopener">%s</a></p>', esc_url_raw( add_query_arg( array( 'post' => $form_source, 'action' => 'edit' ), admin_url( '/post.php' ) ) ), esc_html( get_the_title( $form_source ) ) );
	} else {
		echo '<p>' . esc_html( btb__( 'Keine Formularquelle vorhanden' ) ) . '</p>';
	}
}

function fc_theme_callback_meta_box_confirmation_time( $post ) {
	$form_data = get_post_meta( $post->ID, 'form_data', true );
	if ( !empty( $form_data[ 'email' ] ) ) {
		if ( !empty( $confirmation_time = get_post_meta( $post->ID, 'confirmation_time', true ) ) ) {
			echo '<div class="meta-confirmation-time meta-confirmation-time--confirmed">';
			echo '<span class="meta-confirmation-time__headline">' . esc_html( btb__( 'E-Mail Adresse bestätigt' ) ) . '</span>';
			echo '<span class="meta-confirmation-time__text">(' . esc_html( $confirmation_time ) . ')</span>';
			echo '</div>';
		} else {
			echo '<div class="meta-confirmation-time meta-confirmation-time--unconfirmed">';
			echo '<span class="meta-confirmation-time__headline">' . esc_html( btb__( 'E-Mail Adresse nicht bestätigt' ) ) . '</span>';
			echo '</div>';
		}
	} else {
		echo '<span aria-hidden="true">&#8212;</span><span class="screen-reader-text">' . esc_html( btb__( 'Keine E-Mail Adresse vorhanden' ) ) . '</span>';
	}
}

function fc_theme_callback_meta_box_confirmation_id( $post ) {
	$form_data = get_post_meta( $post->ID, 'form_data', true );
	if ( !empty( $form_data[ 'email' ] ) ) {
		$confirmation_id = get_post_meta( $post->ID, 'confirmation_id', true );
		echo '<p>' . esc_html( $confirmation_id ) . '</p>';
		echo '<p>' . sprintf( '<span data-copy-clipboard="%s">%s</span>', esc_url_raw( add_query_arg( array( 'post' => 'confirm', 'post_id' => $post->ID, 'confirmation_id' => $confirmation_id ), $form_data[ 'action_link' ] ) ), __( 'Bestätigungslink in Zwischenablage kopieren' ) ) . '</p>';
	} else {
		echo '<span aria-hidden="true">&#8212;</span><span class="screen-reader-text">' . esc_html( btb__( 'Keine E-Mail Adresse vorhanden' ) ) . '</span>';
	}
}

// Remove Wordpress quick edit link

function fc_theme_remove_quick_edit_link( $actions, $post ) {
	if ( get_post_type( $post ) == 'form_submissions' ) {
		unset( $actions[ 'inline hide-if-no-js' ] );
	}
	return $actions;
}
add_filter( 'post_row_actions', 'fc_theme_remove_quick_edit_link', 10, 2 );
add_filter( 'page_row_actions', 'fc_theme_remove_quick_edit_link', 10, 2 );

// Create custom upload directory for form attachments

function fc_theme_custom_upload_dir( $dir_data ) {
	$custom_dir = ( is_multisite() ? 'sites/' . esc_html( get_current_blog_id() ) . '/' : '' ) . 'forms-attachments';
	$dir_data[ 'path' ] = $dir_data[ 'basedir' ] . '/' . $custom_dir;
	$dir_data[ 'url' ] = $dir_data[ 'baseurl' ] . '/' . $custom_dir;
	$dir_data[ 'subdir' ] = '';
	return $dir_data;
}

// Hide form attachments in media library

function fc_theme_hide_media_library_folder( $where ) {
	if ( is_admin() ) {
		if ( $_POST[ 'action' ] == 'query-attachments' ) {
			$where .= ' AND guid NOT LIKE "%/forms-attachments/%"';
		}
	}
	return $where;
}
add_filter( 'posts_where', 'fc_theme_hide_media_library_folder' );

// Protect form attachments folder access

function fc_theme_protect_media_folder_access() {
	$upload_dir = wp_get_upload_dir();
	$folder_path = $upload_dir[ 'basedir' ] . '/' . ( is_multisite() ? 'sites/' . esc_html( get_current_blog_id() ) . '/' : '' ) . 'forms-attachments';
	if ( !is_dir( $folder_path ) ) {
		mkdir( $folder_path );
	}
	$contents = 'SetEnvIf Referer "^' . home_url( '/' ) . '" letitpass' . PHP_EOL;
	$contents .= 'Order Deny,Allow' . PHP_EOL;
	$contents .= 'Deny from all' . PHP_EOL;
	$contents .= 'Allow from env=letitpass';
	file_put_contents( $folder_path . '/.htaccess', $contents );
}
add_action( 'after_setup_theme', 'fc_theme_protect_media_folder_access' );

// Handle form builder submissions

function fc_theme_form_builder_submit() {
	$redirection_url = add_query_arg( 'post', 'error', $_SERVER[ 'HTTP_REFERER' ] );
	if ( !empty( $data = $_POST ) ) {
		if ( !empty( $data[ 'g-recaptcha-response' ] ) ) {
			if ( validate_recaptcha( $data[ 'g-recaptcha-response' ] ) >= 0.5 ) {
				$is_sent = array();
				$confirmation_id = wp_generate_uuid4();
				$post_data = array(
					'post_title' => '#' . get_unique_post_count() . ' – ' . current_time( 'd.m.Y, H:i' ),
					'post_type' => 'form_submissions',
					'post_status' => 'publish',
					'meta_input' => array(
						'form_data' => $data,
						'form_source' => $data[ 'action_post_id' ],
						'confirmation_id' => $confirmation_id
					)
				);
				if ( !empty( $post_id = wp_insert_post( $post_data ) ) ) {
					if ( !empty( $files = $_FILES[ 'files' ] ) ) {
						foreach ( $files[ 'name' ] as $key => $value ) {
							if ( !empty( $files[ 'name' ][ $key ] ) ) {
								$file = array(
									'name' => $files[ 'name' ][ $key ],
									'type' => $files[ 'type' ][ $key ],
									'tmp_name' => $files[ 'tmp_name' ][ $key ],
									'error' => $files[ 'error' ][ $key ],
									'size' => $files[ 'size' ][ $key ]
								);
								$_FILES = array( 'upload_file' => $file );
								add_filter( 'upload_dir', 'fc_theme_custom_upload_dir' );
								$attachments[] = media_handle_upload( 'upload_file', $post_id );
								remove_filter( 'upload_dir', 'fc_theme_custom_upload_dir' );
							}
						}
						if ( !empty( $attachments ) ) {
							add_post_meta( $post_id, 'form_attachments', $attachments );
						}
					}
					if ( !empty( $data[ 'email' ] ) ) {
						$confirmation_data = array(
							'form_data' => $data,
							'post_id' => $post_id,
							'confirmation_id' => $confirmation_id
						);
						$is_sent[ 'confirmation' ] = form_submit_confirmation( $confirmation_data );
					}
					$is_sent[ 'notification' ] = form_submit_notification( $post_id );
				}
				if ( !empty( $is_sent ) && !in_array( false, $is_sent, true ) ) {
					add_post_meta( $post_id, 'ip_address', get_user_ip_address() );
					setcookie( 'form_builder_submitted_' . $data[ 'action_post_id' ], 'true', time() + ( 365 * 24 * 60 * 60 ), '/' );
					$redirection_url = add_query_arg( array( 'post' => 'success', 'confirmation' => ( !empty( $data[ 'email' ] ) ? 'true' : 'false' ) ), $data[ 'action_link' ] );
				}
			}
		}
	}
	wp_safe_redirect( esc_url_raw( $redirection_url ) );
	exit();
}
add_action( 'admin_post_nopriv_form_builder', 'fc_theme_form_builder_submit' );
add_action( 'admin_post_form_builder', 'fc_theme_form_builder_submit' );

// Additional custom functions

function form_submit_confirmation( $confirmation_data ) {
	if ( empty( $confirmation_data ) ) {
		return;
	}
	ob_start();
	get_template_part( 'template-parts/contents/meta-confirmation', '', array( 'confirmation_data' => $confirmation_data ) );
	get_template_part( 'template-parts/contents/meta-footer' );
	$html = ob_get_clean();
	if ( empty( $email = sanitize_email( $confirmation_data[ 'form_data' ][ 'email' ] ) ) ) {
		return;
	}
	$subject = esc_html( sprintf( btb__( '%s: Formularbestätigung' ), get_bloginfo( 'name' ) ) );
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	return wp_mail( $email, $subject, $html, $headers );
}

function form_submit_notification( $post_id ) {
	if ( empty( $post_id ) ) {
		return;
	}
	ob_start();
	get_template_part( 'template-parts/contents/meta-notification', '', array( 'post_id' => $post_id ) );
	get_template_part( 'template-parts/contents/meta-footer' );
	$html = ob_get_clean();
	if ( empty( $emails = get_field( 'options_notifications_emails', 'option' ) ) ) {
		return true;
	}
	$emails = array_map( 'sanitize_email', explode( ',', $emails ) );
	$subject = esc_html( sprintf( btb__( '%s: Formular ausgefüllt' ), get_bloginfo( 'name' ) ) );
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	return wp_mail( $emails, $subject, $html, $headers );
}

function form_submit_confirmation_update( $post_id, $confirmation_id ) {
	if ( empty( $post_id ) || empty( $confirmation_id ) ) {
		return;
	}
	if ( $confirmation_id === get_post_meta( $post_id, 'confirmation_id', true ) ) {
		if ( empty( get_post_meta( $post_id, 'confirmation_time', true ) ) ) {
			if ( update_post_meta( $post_id, 'confirmation_time', current_time( 'd.m.Y, H:i' ) ) ) {
				$confirmation_status = 'success';
			}
		} else {
			$confirmation_status = 'expired';
		}
	}
	return $confirmation_status;
}

function is_form_locked( $post_id ) {
	if ( empty( get_field( 'form_options_prevent_multiple_submissions', $post_id ) ) ) {
		return;
	}
	if ( !empty( get_posts( array( 'post_type' => 'form_submissions', 'posts_per_page' => 1, 'meta_query' => array( array( 'key' => 'ip_address', 'value' => get_user_ip_address() ) ) ) ) ) || isset( $_COOKIE[ 'form_builder_submitted_' . get_the_ID() ] ) ) {
		return true;
	}
}

function validate_recaptcha( $response_token, $score = 0.5 ) {
	if ( !$response_token ) {
		return;
	}
	$recaptcha_response_json = wp_remote_get( esc_url_raw( add_query_arg( array( 'secret' => esc_attr( get_field( 'options_recaptcha_keys_secret', 'option' ) ), 'response' => $response_token ), 'https://www.google.com/recaptcha/api/siteverify' ) ) );
	if ( empty( $recaptcha_response_json ) || is_wp_error( $recaptcha_response_json ) ) {
		return;
	}
	$recaptcha_response = json_decode( $recaptcha_response_json[ 'body' ], true );
	if ( $recaptcha_response[ 'success' ] === false || $recaptcha_response[ 'score' ] < $score ) {
		return;
	}
	return true;
}

function get_user_ip_address() {
	$ip_address = sanitize_text_field( ( isset( $_SERVER[ 'HTTP_CLIENT_IP' ] ) ? $_SERVER[ 'HTTP_CLIENT_IP' ] : ( isset( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ? $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] : $_SERVER[ 'REMOTE_ADDR' ] ) ) );
	return $ip_address;
}

function get_unique_post_count() {
	if ( !empty( $count = get_option( 'unique_post_count' ) ) ) {
		$count++;
		update_option( 'unique_post_count', $count );
	} else {
		$count = 1;
		add_option( 'unique_post_count', $count );
	}
	return $count;
}

?>