<div class="checkbox-wrapper">
	<label class="checkbox-label" for="checkbox-privacy">
		<input class="checkbox" type="checkbox" name="checkbox_privacy" value="privacy_accept" id="checkbox-privacy" required>
		<span></span>
		<?php echo wp_kses( sprintf( btb__( 'Ich habe die %s zur Kenntnis genommen und stimme zu, dass meine Daten zur Kontaktaufnahme und Zuordnung für eventuelle Rückfragen gespeichert werden.' ), sprintf( '<a href="%s" target="_blank" rel="noopener">%s</a>', esc_url( get_privacy_policy_url() ), btb__( 'Datenschutzerklärung' ) ) ), array( 'a' => array( 'href' => true, 'target' => true, 'rel' => true ) ) ); ?>
		<span aria-hidden="true">*</span>
	</label>
</div>
<div class="note-wrapper note-wrapper--small content">
	<p><?php echo wp_kses( '*' . btb__( 'Pflichfelder' ) . '. ' . sprintf( btb__( 'Dieses Formular ist durch reCAPTCHA geschützt. Es gelten die Google %s und %s.' ), sprintf( '<a href="https://policies.google.com/privacy" target="_blank" rel="noopener">%s</a>', btb__( 'Datenschutzbestimmungen' ) ), sprintf( '<a href="https://policies.google.com/terms" target="_blank" rel="noopener">%s</a>', btb__( 'Nutzungsbedingungen' ) ) ), array( 'a' => array( 'href' => true, 'target' => true, 'rel' => true ) ) ); ?></p>
</div>
<div class="submit-interim">
	<button class="button button--primary" type="submit" >
		<span><?php echo esc_html( btb__( 'Senden' ) ); ?></span>
	</button>
</div>
<div class="note-wrapper note-wrapper--error content">
	<p><?php echo esc_html( btb__( 'Bitte überprüfen Sie Ihre Eingaben und füllen Sie alle Felder vollständig aus.' ) ); ?></p>
</div>
<?php
	if ( !empty( $args[ 'inputs' ] ) && in_array( 'tab', array_column( $args[ 'inputs' ], 'acf_fc_layout' ) ) ) {
		echo '</div>';
	}
?>
<script src="<?php echo esc_url( add_query_arg( 'render', get_field( 'options_recaptcha_keys_public', 'option' ), 'https://www.google.com/recaptcha/api.js' ) ); ?>"></script>