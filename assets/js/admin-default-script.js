jQuery(document).ready(function($) {

	acf.add_filter('select2_args', function(args, $select, settings, $field) {
		if ($field.hasClass('select2-search-disabled')) {
			args['minimumResultsForSearch'] = -1;
		}
		if ($field.hasClass('acf-hidden-softly')) {
			if ($field.hasClass('acf-hidden')) {
				args['disabled'] = true;
			} else {
				args['disabled'] = false;
			}
		}
		return args;			
	});

	$('[data-copy-clipboard]').on('click', function() {
		var clipboardValue = $(this).data('copy-clipboard');
		var $temporaryInput = $('<input>');
		$('body').append($temporaryInput);
		$temporaryInput.val(clipboardValue).select();
		document.execCommand('copy');
		$temporaryInput.remove();
	})

});