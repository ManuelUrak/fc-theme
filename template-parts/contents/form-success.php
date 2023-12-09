<div class="form-response form-success content" id="form-response">
	<p class="h2"><?php echo esc_html( btb__( 'Vielen Dank!' ) ); ?></p>
	<p><?php echo esc_html( btb__( 'Das Formular wurde erfolgreich versendet.' ) . ( $_GET[ 'confirmation' ] === 'true' ? ' ' . btb__( 'Bitte bestätigen Sie Ihre E-Mail Adresse mit einem Klick auf den Bestätigungslink, den wir Ihnen per E-Mail gesendet haben. (Sollten Sie keine E-Mail erhalten haben, kontrollieren Sie bitte Ihren Spam-Ordner.)' ) : '' ) ); ?></p>
</div>