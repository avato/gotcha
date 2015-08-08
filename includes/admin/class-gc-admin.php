<?php
/**
 * Gotcha admin functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Gotcha
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'GC_Admin' ) ) :

	class GC_Admin{


		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );
		}


		/**
	    * Include any classes we need within admin.
	    */
	    public function includes() {
	    	include_once( 'class-gc-admin-menus.php' );
	    	include_once( 'class-gc-admin-assets.php' );
	    	include_once( 'gc-admin-functions.php' );
	    }


	}

endif; // End if class_exists check



return new GC_Admin();