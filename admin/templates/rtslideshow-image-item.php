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
 * @subpackage Rtslideshow/admin/templates
 */


$image_url = get_query_var( 'image_url', '' ); // Default empty if not set
?>

<li class="slideshow-image" data-url="<?php echo esc_attr( $image_url ); ?>">
    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr__( 'Slideshow Image', 'rtslideshow' ); ?>" />
    <button class="remove-image"><?php esc_html_e( 'Remove', 'rtslideshow' ); ?></button>
</li>