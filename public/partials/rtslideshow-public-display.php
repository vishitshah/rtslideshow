<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://vishitshah.com
 * @since      1.0.0
 *
 * @package    Rtslideshow
 * @subpackage Rtslideshow/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="my-slideshow">
    <?php foreach ( $images as $image_url ): ?>
        <img src="<?php echo esc_url( $image_url ); ?>" style="width: 100%; display: none;">
    <?php endforeach; ?>
</div>