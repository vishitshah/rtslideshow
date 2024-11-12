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
    <h1><?php echo esc_html__( 'My Slideshow Settings', 'rtslideshow' ); ?></h1>
    <div id="slideshow-images-container">
        <ul id="slideshow-images">
            <?php
            $images = get_option( 'rtslideshow_images', [] );
            if ( is_array( $images ) ) { // Ensure $images is an array
                foreach ( $images as $image_url ) {
                    $image_url = esc_url( $image_url ); // Escape URL before output
                    echo '<li class="slideshow-image" data-url="' . esc_attr( $image_url ) . '">
                            <img src="' . esc_url( $image_url ) . '" style="max-width: 100px;" alt="' . esc_attr__( 'Slideshow Image', 'rtslideshow' ) . '" />
                            <button class="remove-image">' . esc_html__( 'Remove', 'rtslideshow' ) . '</button>
                          </li>';
                }
            }
            ?>
        </ul>
    </div>
    <button id="add-image-button" class="button"><?php echo esc_html__( 'Add Image', 'rtslideshow' ); ?></button>
    <button id="save-images-button" class="button button-primary"><?php echo esc_html__( 'Save Changes', 'rtslideshow' ); ?></button>
</div>

