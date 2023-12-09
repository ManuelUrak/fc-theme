jQuery(document).ready(function($) {

	$('body').removeClass('loading');

	$('.img-container.lazy:not(.callable) img').lazy({
		visibleOnly: true,
		afterLoad: function(element) {
			objectFitImages(element);
			element.closest('.img-container').addClass('loaded');
		},
	});

	$('.vid-container.lazy:not(.callable) video, .vid-container.lazy:not(.callable) iframe').lazy({
		visibleOnly: true,
		afterLoad: function(element) {
			element.closest('.vid-container').addClass('loaded');
		},
	});

	$('.swipebox').swipebox({
		loopAtEnd: true,
		beforeOpen: function() {
			lockBody();
		},
		afterClose: function() {
			unlockBody();
		}
	});

	$(function() {
		$(document).on('keyup', function(e) {
			if (e.which === 9) {
				$('body').addClass('tabbing');
			}
		});
		$(document).on('mousedown', function() {
			$('body').removeClass('tabbing');
		});
	});

	$('.content-video .video__overlay').on('click', function() {
		playVideo($(this));
	});

	$('.tab-link').on('click', function() {
		$(this).addClass('active').siblings().removeClass('active');
		$('#' + $(this).data('tab-index')).addClass('active').siblings().removeClass('active');
	});

	$('.form-builder .checkbox-wrapper').each(function() {
		let $checkboxValidation = $(this).find('.checkbox-validation');
		if ($checkboxValidation.length && $(this).find('.checkbox').length >= 1 ) {
			$(this).find('.checkbox').on('change keyup', function() {
				if ($(this).closest('.checkbox-wrapper').find('.checkbox:checked').length) {
					$checkboxValidation.val('true').valid();
				} else {
					$checkboxValidation.val('').valid();
				}
			});
		}
	});

	$('.form-builder .select-wrapper .fselect select').each(function() {
		$(this).fSelect({
			showSearch: $(this).data('fselect-search'),
			noResultsText: $(this).data('fselect-results-text'),
			searchText: $(this).data('fselect-search-text')
		});
		$(this).on('change', function() {
			$(this).valid();
		});
	});

	$('.form-builder .file-wrapper input').on('load propertychange change input paste', function() {
		let $inputTitle = $(this).siblings('.filename');
		if ($(this).val()) {
			const files = $(this)[0].files;
			var size = 0;
			var name = '';
			for (var i = 0; i < files.length; i++) {
				size += files[i].size;
					name += (i > 0 ? ', ' : '') + files[i].name;
			}
			if (size > ($(this).data('file-size')) || ($(this).data('file-length') && files.length > $(this).data('file-length'))) {
				$(this).val('');
				$inputTitle.text($inputTitle.data('placeholder')).addClass('empty');
				alert($(this).data('file-alert'));
			} else {
				$inputTitle.text(name).removeClass('empty');
			}
		} else {
			$inputTitle.text($inputTitle.data('placeholder')).addClass('empty');
		}
		$(this).valid();
	});

	$('.form-builder .file-wrapper .upload-area').on('click', function(e) {
		if (e.target != this) {
			return;
		}
		$(this).find('input').trigger('click');
	});

	$(function() {
		const flatpickr = {};
		$('.form-builder .date-wrapper .flatpickr input').each(function() {
			let inputId = $(this).attr('id');
			let currentDate = new Date();
			flatpickr[(inputId ? inputId.replace(/-/g, '_') : i)] = $(this).flatpickr({
				altFormat: 'd.m.Y',
				altInput: true,
				allowInput: ($(this).data('flatpickr-input') ?? false),
				dateFormat: 'Y-m-d',
				disableMobile: true,
				static: true,
				locale: 'de',
				monthSelectorType: 'static',
				yearSelectorType: 'static',
				maxDate: ($(this).data('flatpickr-max-date') === true ? currentDate.setDate(currentDate.getDate() - 1) : null),
				minDate: ($(this).data('flatpickr-min-date') === false ? null : currentDate),
				position: 'below left',
				onChange: [
					function(selectedDates, dateStr, instance) {
						let linkedInput = $(instance.input).data('flatpickr-link');
						if (linkedInput) {
							flatpickr[linkedInput.replace(/-/g, '_')].set('minDate', dateStr);
						}
						$(instance.input).valid();
					}
				],
				onOpen: [
					function(selectedDates, dateStr, instance) {
						let inputWidth = $(instance.altInput).outerWidth(true) + 'px';
						$(instance.calendarContainer).css('max-width',inputWidth);
					}
				],
			});
		});
	});

	$(window).resize(function() {
		let inputWidth = $('.flatpickr input.form-control.active').outerWidth(true) + 'px';
		$('.flatpickr-calendar.open').css('max-width', inputWidth);
	});

	$('.form-builder form').validate({
		errorContainer: '.note-wrapper--error',
		focusInvalid: false,
		ignore: 'input.form-control,.flatpickr input.numInput',
		rules: {
			email: {
				validateEmail: true
			}
		},
		onfocusout: false,
		onkeyup: function(element, event) {
			if (event.which != 9) {
				$(element).valid();
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo($(element).closest('.input-wrapper,.checkbox-wrapper,.radio-wrapper,.select-wrapper,.date-wrapper,.file-wrapper'));
		},
		highlight: function(element) {
			$(element).closest('.input-wrapper,.checkbox-wrapper,.radio-wrapper,.select-wrapper,.date-wrapper,.file-wrapper').addClass('error');
		},
		unhighlight: function(element) {
			$(element).closest('.input-wrapper,.checkbox-wrapper,.radio-wrapper,.select-wrapper,.date-wrapper,.file-wrapper').removeClass('error');
		},
		submitHandler: function(form) {
			if ($(form).data('captcha-done') === true) {
				form.submit();
				$(form).addClass('submitted');
			} else {
				executeCaptcha(form);
			}
		}
	});

	$.validator.addMethod('validateEmail', function(value, element) {
		if (!value || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
			return true;
		} else {
			return false;
		}
	}, $.validator.messages.email);

	function executeCaptcha(form) {
		grecaptcha.ready(function() {
			let key = $(form).data('captcha-key');
			grecaptcha.execute(key, {
				action: 'submit'
			}).then(function(token) {
				$(form).prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">').data('captcha-done', true).submit();
			});
		});
	};

	function playVideo($videoContainer) {
		setTimeout(function() { 
			$videoContainer.closest('.video').addClass('playing');
		}, 100);
		let $videoPlayer = $videoContainer.siblings('.vid-container').find('video, iframe');
		if ($videoPlayer.is('video')) {
			$videoPlayer[0].play();
		} else if ($videoPlayer.is('iframe')) {
			$videoPlayer.attr('src', $videoPlayer[0].src + '?autoplay=1');
		}
	};

	function setUrlParameter(key, value) {
		if (history.pushState) {
			let params = new URLSearchParams(window.location.search);
			if (value === '') {
				params.delete(key);
			} else {
				params.set(key, value);
			}
			let newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + (params.toString() ? '?' + params.toString() : '');
			window.history.pushState({
				path: newUrl
			}, '', newUrl);
		}
	};

	function getUrlParameter(key) {
		if (history.pushState) {
			let params = new URLSearchParams(window.location.search);
			let value = params.get(key);
			return value;
		}
	};

	function lockBody() {
		$('body').toggleClass('locked');
	};

	function unlockBody() {
		$('body').removeClass('locked');
	};

});

jQuery.event.special.touchstart = {
	setup: function(_, ns, handle) {
		if (ns.includes('noPreventDefault')) {
			this.addEventListener('touchstart', handle, {passive: false});
		} else {
			this.addEventListener('touchstart', handle, {passive: true});
		}
	}
};