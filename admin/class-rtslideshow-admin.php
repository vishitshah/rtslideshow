<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://vishitshah.com
 * @since      1.0.0
 *
 * @package    Rtslideshow
 * @subpackage Rtslideshow/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rtslideshow
 * @subpackage Rtslideshow/admin
 * @author     Vishit Shah <vishit99@gmail.com>
 */
class Rtslideshow_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rtslideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rtslideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtslideshow-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rtslideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rtslideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtslideshow-admin.js', array( 'jquery' ), $this->version, false );

		// Localize script with AJAX URL, nonce, and a translatable message
		wp_localize_script( $this->plugin_name, 'rtslideshowData', array(
			'ajax_url'       => admin_url( 'admin-ajax.php' ),
			'nonce'          => wp_create_nonce( 'rtslideshow_save_images_nonce' ),
			'no_img_message' => esc_html__( 'No images to save.', 'rtslideshow' ),
			'fail_message' 	 => esc_html__( 'Request failed.', 'rtslideshow' )
		));

	}

	/**
	 * To display the admin side page to upload images
	 *
	 * @since    1.0.0
	 */
	public function rtslideshow_display_admin_page() {

		add_menu_page(
			esc_html__( 'Upload Images', 'rtslideshow' ), // Page title with escaping
			esc_html__( 'Upload Images', 'rtslideshow' ), // Menu title with escaping
			'manage_options', // Capability
			'upload-images-admin', // Slug
			array( $this, 'rtslideshow_showpage' ) // Display function
		);
	}

	/**
	 * Helper function that loads the admin page to display
	 *
	 * @since    1.0.0
	 */
	public function rtslideshow_showpage() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rtslideshow-admin-display.php';

	}

	/**
	 * Register the media uploader and sortable scripts/styles for admin area
	 *
	 * @since    1.0.0
	 */
	public function rtslideshow_media_and_sortable_scripts() {

		wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui-sortable' );
	}

	/**
	 * Handles the saving of slideshow images via AJAX.
	 *
	 * @since 1.0.0
	 */
	function rtslideshow_save_images() {

		// Ensure the nonce is unslashed and verified correctly
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'rtslideshow_save_images_nonce' ) ) {
			wp_send_json_error( esc_html__( 'Invalid request.', 'rtslideshow' ) );
			wp_die(); // Terminate the script to avoid further execution
		}


		// Check if images data is provided and is an array
		if ( isset( $_POST['images'] ) && is_array( $_POST['images'] ) ) {

			// Unsplash the images array to prevent slashes being added
			$images = wp_unslash( $_POST['images'] );

			// Sanitize each image URL
			$sanitized_images = array_map( 'esc_url_raw', $images );

			// Update the option with sanitized data
			update_option( 'rtslideshow_images', $sanitized_images );

			// Send success response
			wp_send_json_success( esc_html__( 'Images saved successfully!', 'rtslideshow' ) );
		} else {
			wp_send_json_error( esc_html__( 'No images provided.', 'rtslideshow' ) );
		}

	}

}
