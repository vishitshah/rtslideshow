<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://vishitshah.com
 * @since      1.0.0
 *
 * @package    Rtslideshow
 * @subpackage Rtslideshow/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h1><?php esc_html_e( 'My Slideshow Settings', 'rtslideshow' ); ?></h1>
    <div id="slideshow-images-container">
        <ul id="slideshow-images">
            <?php
            $images = get_option( 'rtslideshow_images', [] );
            if ( is_array( $images ) ) { // Ensure $images is an array
                foreach ( $images as $image_url ) {
                    $image_url = esc_url( $image_url ); // Escape URL before output
                    ?>
                        <li class="slideshow-image" data-url="<?php echo esc_attr( $image_url ); ?>">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr__( 'Slideshow Image', 'rtslideshow' ); ?>" />
                            <button class="remove-image"><?php esc_html_e( 'Remove', 'rtslideshow' ); ?></button>
                        </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <button id="add-image-button" class="button"><?php esc_html_e( 'Add Image', 'rtslideshow' ); ?></button>
    <button id="save-images-button" class="button button-primary"><?php esc_html_e( 'Save Changes', 'rtslideshow' ); ?></button>
</div>

