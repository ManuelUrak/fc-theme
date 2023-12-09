<?php
	echo '<p>' . sprintf( esc_html( btb__( 'Auf %s wurde ein neuer Formular-Eintrag hinzugefügt. Klicken Sie auf folgenden Link um den Eintrag anzusehen:' ) ), esc_url( home_url() ) ) . '</p>';
	printf( '<p><a href="%1$s" target="_blank" rel="noopener">%1$s</a></p>', esc_url_raw( add_query_arg( array( 'post' => $args[ 'post_id' ], 'action' => 'edit' ), admin_url( '/post.php' ) ) ) );