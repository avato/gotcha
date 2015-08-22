<?php
/**
 * Gotcha admin settigns page
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Gotcha
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'GC_Admin_Settings' ) ) :

	class GC_Admin_Settings{


		/**
	    * Settings page.
	    *
	    * Handles the display of the main woocommerce settings page in admin.
	    */
	    public static function output() {
	    	// Include settings pages
			self::get_settings_pages();
	    }


	   


	    /**
	    * Include the settings page classes
	    */
	    public static function get_settings_pages() {

	    	print_r($_POST);


	    	if ( ! empty( $_POST ) ) {
				self::save();
			}

			echo 'hi');


	    	$manage_page =  gc_start_class('Admin_Page_Manager');
	    	include_once( 'template/html-gc-settings-page.php' );
	    }
	}

endif; // End if class_exists check