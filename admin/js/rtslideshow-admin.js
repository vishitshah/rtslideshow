( function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$( document ).ready( function($) {
		
		var frame;
		$( '#add-image-button' ).on( 'click', function(e) {
			e.preventDefault();
			if ( frame ) {
				frame.open();
				return;
			}
			frame = wp.media({
				title: 'Select or Upload Images',
				button: {
					text: 'Add to Slideshow'
				},
				multiple: true
			});
			frame.on( 'select', function() {
				var attachments = frame.state().get( 'selection' ).toArray();
				attachments.forEach( function( attachment ) {
					var url = attachment.attributes.url;
					$( '#slideshow-images' ).append(`
						<li class="slideshow-image" data-url="${url}">
							<img src="${url}" style="max-width: 100px;" />
							<button class="remove-image">Remove</button>
						</li>
					`);
				});
			});
			frame.open();
		});
	
		$( '#slideshow-images' ).on( 'click', '.remove-image', function() {
			$( this ).closest( '.slideshow-image' ).remove();
		});
	
		$( '#slideshow-images' ).sortable();


		$( '#save-images-button' ).on('click', function() {
			const imagesArray = []; // Populate this array with the image URLs as needed

			// Collect each image URL from the data-url attribute
			$( '#slideshow-images .slideshow-image' ).each( function() {
				imagesArray.push( $( this ).data( 'url' ));
			});

			// Check if there are any images to save
			if ( imagesArray.length === 0 ) {
				alert( rtslideshowData.no_img_message );
				return;
			}
	
			$.post(rtslideshowData.ajax_url, {
				action: 'rtslideshow_save_images',
				images: imagesArray,
				nonce: rtslideshowData.nonce // Use the nonce here
			})
			.done( function( response ) {
				if ( response.success ) {
					alert( response.data ); // Success message
				} else {
					alert( response.data ); // Error message
				}
			})
			.fail(function() {
				alert( rtslideshowData.fail_message );
			});
		});
	});

})( jQuery );
