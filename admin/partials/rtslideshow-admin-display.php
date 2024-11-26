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
                    $template_file = plugin_dir_path( __DIR__ ) . 'templates/rtslideshow-image-item.php';
                    
                    if ( file_exists( $template_file ) ) {
                        
                        set_query_var( 'image_url', $image_url );
                        load_template( $template_file, false );
                    }
                }
            }
            ?>
        </ul>
    </div>
    <button id="add-image-button" class="button"><?php esc_html_e( 'Add Image', 'rtslideshow' ); ?></button>
    <button id="save-images-button" class="button button-primary"><?php esc_html_e( 'Save Changes', 'rtslideshow' ); ?></button>
</div>

