<?php $confirmation_status = form_submit_confirmation_update( $_GET[ 'post_id' ], $_GET[ 'confirmation_id' ] ); ?>
<div class="form-response form-confirmation content" id="form-response">
	<p class="h2">
		<?php
			echo esc_html( match( $confirmation_status ) {
				'success', 'expired' => btb__( 'Vielen Dank!' ),
				default => btb__( 'Tut uns leid!' )
			} );
		?>
	</p>
	<p>
		<?php
			echo esc_html( match( $confirmation_status ) {
				'success' => btb__( 'Ihre E-Mail Adresse wurde erfolgreich bestätigt.' ),
				'expired' => btb__( 'Ihre E-Mail Adresse wurde bereits erfolgreich bestätigt.' ),
				default => btb__( 'Leider ist ein Fehler aufgetreten. Bitte versuchen Sie es später noch einmal.' )
			} );
		?>
	</p>
</div>