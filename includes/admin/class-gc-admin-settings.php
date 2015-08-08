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


	    public static function save(){
	    	$settings = get_option('Gotcha');
	    	$to_save = array('mask-opacity','mask-color','show-register','show-login');

	    	if ( ! isset( $_POST['gc-security'] ) || ! wp_verify_nonce( $_POST['gc-security'], 'gc-admin-actions' ) return;


	    	foreach( $to_save as $name){

	    		if isset( $_POST[ $name ] ){
	    			$settings[$name] = sanitize_text_field( $_POST[ $name ] );
	    		}

	    	}

	    	flush_rewrite_rules();

	    	update_option( 'Gotcha', $settings );
	    }


	    /**
	    * Include the settings page classes
	    */
	    public static function get_settings_pages() {


	    	if ( ! empty( $_POST ) ) {
				self::save();
			}


	    	$manage_page =  gc_start_class('Admin_Page_Manager');
	    	include_once( 'template/html-gc-settings-page.php' );
	    }
	}

endif; // End if class_exists check