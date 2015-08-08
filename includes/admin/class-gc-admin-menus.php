<?php
/**
 * Gotcha admin menu functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Gotcha
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'GC_Admin_Menus' ) ) :

	class GC_Admin_Menus{


		public function __construct() {
			add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );		
		}



		/**
	    * Add sub menu item
	    */
	    public function settings_menu() {
	    	$settings_page = add_users_page( __( 'Gotcha Settings', 'gotcha' ), __( 'Gotcha Settings', 'gotcha' ) , 'manage_options', 'gotcha-settings', array( $this, 'settings_page' ) );
	    }



	    /**
	    * Init the settings page
	    */
	    public function settings_page() {
	    	$set_page =  gc_start_class('Admin_Page_Manager');
	    	include_once( 'template/html-gc-settings-page.php' );
	    }
	}

endif; // End if class_exists check



return new GC_Admin_Menus();