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



if ( ! class_exists( 'GC_Assets' ) ) :

	class GC_Assets{


		public $settings;


		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'site_styles'   )  );	
			add_action( 'wp_enqueue_scripts', array( $this, 'site_scripts'  )  );	
			add_action( 'wp_footer',          array( $this, 'gc_modal_html' )  );

			$this->settings = get_option('Gotcha');
		}


		/**
		 * admin_styles enqueue admin styles
		 */
		public function site_styles() {		
			wp_enqueue_style( 'gc_frontend_styles', GOTCHA_URL . 'assets/style.css', array(), GOTCHA_VERSION );

			wp_add_inline_style( 'gc_frontend_styles', $this->plugin_css() );
		}



		/**
	 	* Enqueue scripts
	 	*/
		public function site_scripts() {
			wp_register_script( 'gc_frontend', GOTCHA_URL . 'assets/js/gc_script.js', array( 'jquery' ), GOTCHA_VERSION, true );

			wp_enqueue_script( 'gc_frontend' );
				
			$params = array( 'security'  => wp_create_nonce( "gc-frontend-actions" ) );

			wp_localize_script( 'gc_frontend', 'gc_frontend_values', $params );
		}


		public function plugin_css(){

				$css_settings = array('');
				$opacity      = ( isset( $this->settings['mask-opacity'] ) && is_numeric( $this->settings['mask-opacity'] )     )? $this->settings['mask-opacity']  : '0.5' ;
				$base_color   = ( isset( $this->settings['mask-color'] )   && $this->check_hex( $this->settings['mask-color'] ) )? $this->settings['mask-color']    : '#000000' ;

				$form_bg      = ( isset( $this->settings['form-bg'] )      && $this->check_hex( $this->settings['form-bg'] )    )? $this->settings['form-bg']       : '#ffffff' ;
				$form_label   = ( isset( $this->settings['label-col'] )    && $this->check_hex( $this->settings['label-col'] )  )? $this->settings['label-col']     : '#000000' ;

				$subm_bg      = ( isset( $this->settings['subm-bg'] )      && $this->check_hex( $this->settings['subm-bg'] )    )? $this->settings['subm-bg']       : '#000000' ;
				$subm_col     = ( isset( $this->settings['subm-col'] )    && $this->check_hex( $this->settings['subm-col'] )  )? $this->settings['subm-col']        : '#ffffff' ;
				
				$mask_color   = $this->hex_2_rgba($base_color, $opacity );

				return ' .gc-modalbox{background:  ' . $mask_color . ';} 
						 .gc-login-wrapper{ background: '  .  $form_bg .  ';} 
						 .gc-login-wrapper label{ color: '  .  $form_label .  ';}
						 .gc-login-wrapper input[type=submit]{ color: '  .  $subm_col .  ';}
						 .gc-login-wrapper input[type=submit]{ background: '  .  $subm_bg .  ';}
						 ' ;
		}



		public function hex_2_rgba($color, $opacity){
			list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");

			return 'rgba(' . $r . ','  . $g . ','  .  $b . ',' . $opacity . ')';

		}


		public function check_hex($colorCode) {
			$colorCode = ltrim($colorCode, '#');

			if ( ctype_xdigit($colorCode) && (strlen($colorCode) == 6 || strlen($colorCode) == 3)) return true;
			return false;
		}




		public function gc_modal_html(){

			print_r($this->settings);



			include('template/html-gc-modal.php');

		}


	}

endif; // End if class_exists check



return new GC_Assets();