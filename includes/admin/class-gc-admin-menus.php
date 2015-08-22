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

		public static $message = '';


		public function __construct() {
			add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );		
		}



		/**
	    * Add sub menu item
	    */
	    public function settings_menu() {
	    	$settings_page = add_users_page( __( 'Gotcha Settings', 'gotcha' ), __( 'Gotcha Settings', 'gotcha' ) , 'manage_options', 'gotcha-settings', array( $this, 'settings_page' ) );
	    }



	     public static function save(){
	    	$settings = get_option('Gotcha');
	    	$to_save = array('mask-opacity','mask-color','show-register','show-login', 'form-bg', 
	    					'label-col', 'subm-bg', 'subm-col');

	    	if ( ! isset( $_POST['gc-security'] ) || !wp_verify_nonce( $_POST['gc-security'], 'gc-admin-actions' ) ) return;



	    	foreach( $to_save as $name){

	    		if ( isset( $_POST[ $name ] ) ){
	    			$settings[$name] = sanitize_text_field( $_POST[ $name ] );
	    		} else {
	    			$settings[$name] = '';
	    		}

	    	}

	    	self::$message = __('Settings Save','gotcha');

	    	flush_rewrite_rules();

	    	update_option( 'Gotcha', $settings );
	    }


	    /**
	    * Init the settings page
	    */
	    public function settings_page() {

	    	self::$message = '';

	    	if ( ! empty( $_POST ) ) {
				self::save();
			}

			if ( self::$message != '' ) {
				echo '<div class="gotcha-update_message">' .  __('Changes Saved','avato') . '</div>';
			}


	    	$set_page =  gc_start_class('Admin_Page_Manager');
	    	include_once( 'template/html-gc-settings-page.php' );
	    }
	}

endif; // End if class_exists check



return new GC_Admin_Menus();