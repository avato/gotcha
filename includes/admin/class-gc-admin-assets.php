<?php
/**
 * Gotcha admin asset functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Gotcha
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'GC_Admin_Assets' ) ) :

	class GC_Admin_Assets{


		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );	
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );	
		}


		/**
		 * admin_styles enqueue admin styles
		 */
		public function admin_styles() {
			
			// enqueue admin screen styles
			$screen = get_current_screen();

			if ( in_array( $screen->id, gc_get_screen_ids() ) ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'google_fonts', "//fonts.googleapis.com/css?family=Chewy", array(), null );
				wp_enqueue_style( 'gc_admin_styles', GOTCHA_URL . 'assets/admin.css', array(), GOTCHA_VERSION );
			}
		}



		/**
	 	* Enqueue scripts
	 	*/
		public function admin_scripts() {

			// enqueue admin screen styles
			$screen = get_current_screen();


			if ( in_array( $screen->id, gc_get_screen_ids() ) ) {


				wp_register_script( 'gc_admin', GOTCHA_URL . 'assets/js/gc_admin.js', array( 'jquery', 'wp-color-picker' ), GOTCHA_VERSION );


				wp_enqueue_script( 'gc_admin' );
				
				$params = array(
					'security'  => wp_create_nonce( "gc-admin-actions" )
				);

				wp_localize_script( 'gc_admin', 'gc_admin_values', $params );


			}
		}
	}

endif; // End if class_exists check



return new GC_Admin_Assets();