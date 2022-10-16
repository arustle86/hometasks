(function ($) {
	"use strict";
	$(document).ready(function () {
		var menuImageUpdate = function( item_id, thumb_id ) {
			wp.media.post( 'rdtheme-set-menu-icon', {
				json:         true,
				post_id:      item_id,
				thumbnail_id: thumb_id,
				_wpnonce:     rdthemeNavIcon.nonce
			}).done( function( html ) {
				$('#menu-item-' + item_id + ' .field-image').html( html );
			});
		};

		$('#menu-to-edit')
		.on('click', '.menu-item .set-post-thumbnail', function (e) {
			e.preventDefault();
			e.stopPropagation();

			var item_id = $(this).parents('.field-image').siblings('input.menu-item-data-db-id').val(),
			is_hover = $(this).hasClass('hover-image'),
			uploader = wp.media({
						title: rdthemeNavIcon.uploaderTitle, // todo: translate
						button: { text: rdthemeNavIcon.uploaderButtonText },
						multiple: false
					}).on('select', function () {
						var attachment = uploader.state().get('selection').first().toJSON();
						menuImageUpdate( item_id, attachment.id );
					}).open();
				})
		.on('click', '.menu-item .remove-post-thumbnail', function (e) {
			e.preventDefault();
			e.stopPropagation();

			$(this).prev().css('display', 'inline-block');;
			$(this).hide();

			var item_id = $(this).parents('.field-image').siblings('input.menu-item-data-db-id').val();
			menuImageUpdate( item_id, -1 );
		});
	});
})(jQuery);