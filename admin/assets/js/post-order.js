jQuery(document).ready(function($) {
	$('#the-list').sortable({
		axis: 'y',
		cursor: 'pointer',
		items: 'tr',
		update: function(event, ui) {
			$.ajax({
				type: 'POST',
				url: post_order.ajaxurl,
				data: {
					action: 'change_post_order',
					security: post_order.nonce,
					order: $('#the-list').sortable('serialize'),
					paged: post_order.paged,
					post_type: $('[name="post_type"]').val()
				}
			});
		}
	});
});
