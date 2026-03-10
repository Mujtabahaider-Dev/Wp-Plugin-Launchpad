(function( $ ) {
	'use strict';

	$(function() {

		// Public Action Example
		$('#my-plugin-public-action').on('click', function(e) {
			e.preventDefault();
			
			const $btn = $(this);
			const $response = $('#my-plugin-public-response');
			
			$btn.prop('disabled', true);
			$response.html('Processing...');

			$.ajax({
				url: myPluginPublic.ajaxUrl,
				type: 'POST',
				data: {
					action: 'my_plugin_example_action',
					nonce: myPluginPublic.nonce,
					id: 1,
					content: 'Publicly updated content'
				},
				success: function(response) {
					if (response.success) {
						$response.html('<span style="color:green;">' + response.data.message + '</span>');
					} else {
						$response.html('<span style="color:red;">' + response.data.message + '</span>');
					}
				},
				error: function() {
					$response.html('<span style="color:red;">An unknown error occurred.</span>');
				},
				complete: function() {
					$btn.prop('disabled', false);
				}
			});
		});

	});

})( jQuery );
