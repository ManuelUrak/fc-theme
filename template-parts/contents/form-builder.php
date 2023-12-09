<?php
	if ( get_post_status( ( $args[ 'post_id' ] ) ) === 'publish' ) {
		printf( '<div class="form-builder" id="%s">', esc_attr( 'form-' . ( $args[ 'post_id' ] ) ) );
		if ( $_GET[ 'post' ] === 'success' ) {
			get_template_part( 'template-parts/contents/form-success' );
		} elseif ( $_GET[ 'post' ] === 'confirm' ) {
			get_template_part( 'template-parts/contents/form-confirmation' );
		} elseif ( $_GET[ 'post' ] === 'error' ) {
			get_template_part( 'template-parts/contents/form-error' );
		} elseif ( is_form_locked( $args[ 'post_id' ] ) ) {
			get_template_part( 'template-parts/contents/form-locked' );
		} else {
			if ( !empty( $tab_links = array_filter( get_field( 'form_builder_inputs', $args[ 'post_id' ] ), function( $input ) { if ( $input[ 'acf_fc_layout' ] === 'tab' ) { return true; } } ) ) ) {
				echo '<div class="tab-links">';
				echo '<ul class="tab-links__inner">';
				$i = 1; foreach ( $tab_links as $key => $value ) {
					printf( '<li class="tab-link%s" data-tab-index="tab-%s"><span class="position">%s</span><span class="title">%s</span></li>', ( $i <= 1 ) ? ' active' : '', $key + 1, $i, esc_html( $value[ 'title' ] ) );
					$i++;
				}
				unset( $i );
				echo '</ul>';
				echo '</div>';
			}
			printf( '<form action="%s" method="post" enctype="multipart/form-data" autocomplete="off" data-captcha-key="%s">', esc_url( admin_url( 'admin-post.php' ) ), esc_attr( get_field( 'options_recaptcha_keys_public', 'option' ) ) );
			echo '<input type="hidden" name="action" value="form_builder">';
			printf( '<input type="hidden" name="action_link" value="%s">', esc_url( get_permalink() ) );
			printf( '<input type="hidden" name="action_post_id" value="%s">', esc_attr( get_the_ID() ) );
			if ( have_rows( 'form_builder_inputs', $args[ 'post_id' ] ) ) {
				while ( have_rows( 'form_builder_inputs', $args[ 'post_id' ] ) ) {
					the_row(); 
					if ( get_row_layout() ) {
						if ( get_row_layout() === 'tab' ) {
							$i = $i ?: 0;
							if ( $i >= 1 ) {
								echo '</div>';
							}
							printf( '<div class="tab%s" id="tab-%s">', ( $i <= 0 ) ? ' active' : '', get_row_index() );
							$i++;
						} elseif ( get_row_layout() === 'separator' ) {
							echo '<hr>';
						} else {
							get_template_part( 'template-parts/contents/input-' . get_row_layout() );
						}
					}
				}
			}
			get_template_part( 'template-parts/contents/input-submit', '', array( 'inputs' => get_field( 'form_builder_inputs', $args[ 'post_id' ] ) ) );
			if ( !empty( in_array( 'tab', array_column( get_field( 'form_builder_inputs', $args[ 'post_id' ] ), 'acf_fc_layout' ) ) ) ) {
				echo '</div>';
			}
			echo '</form>';
		}
		echo '</div>';
	}