<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://vishitshah.com
 * @since      1.0.0
 *
 * @package    Rtslideshow
 * @subpackage Rtslideshow/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rtslideshow
 * @subpackage Rtslideshow/public
 * @author     Vishit Shah <vishit99@gmail.com>
 */
class Rtslideshow_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtslideshow-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtslideshow-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the shortcode
	 *
	 * @since    1.0.0
	 */
    public function rtslideshow_register_shortcodes() {

        add_shortcode( 'myslideshow', array( $this, 'rtslideshow_slideshow_shortcode' ) );
    }

    /**
	 * Define the output of the shortcode
	 *
	 * @since    1.0.0
	 */
    public function rtslideshow_slideshow_shortcode( $atts ) {
        
		ob_start();
		$images = get_option( 'my_slideshow_images', [] );

		if ( empty( $images ) ) {
			echo esc_html__('No images in the slideshow.', 'rtslideshow');
		} else {
			include plugin_dir_path(__FILE__) . 'partials/rtslideshow-public-display.php';
		}
		return ob_get_clean();

    }

}
