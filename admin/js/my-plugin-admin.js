(function( $ ) {
	'use strict';

	$(function() {

		// Tab Switching Logic
		$('.nav-tab-wrapper a').on('click', function(e) {
			e.preventDefault();
			
			const target = $(this).attr('href');
			
			$('.nav-tab').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			
			$('.my-plugin-tab-content').hide();
			$(target).show();
		});

		// AJAX Example
		$('#my-plugin-ajax-test').on('click', function(e) {
			e.preventDefault();
			
			const $btn = $(this);
			const $spinner = $('#my-plugin-spinner');
			const $response = $('#my-plugin-ajax-response');
			
			$btn.prop('disabled', true);
			$spinner.addClass('is-active');
			$response.html('');

			$.ajax({
				url: myPluginAdmin.ajaxUrl,
				type: 'POST',
				data: {
					action: 'my_plugin_example_action',
					nonce: myPluginAdmin.nonce,
					id: 1, // Example ID
					content: 'Updated content from AJAX'
				},
				success: function(response) {
					if (response.success) {
						$response.html('<div class="notice notice-success inline"><p>' + response.data.message + '</p></div>');
					} else {
						$response.html('<div class="notice notice-error inline"><p>' + response.data.message + '</p></div>');
					}
				},
				error: function() {
					$response.html('<div class="notice notice-error inline"><p>An unknown error occurred.</p></div>');
				},
				complete: function() {
					$btn.prop('disabled', false);
					$spinner.removeClass('is-active');
				}
			});
		});

	});

})( jQuery );
