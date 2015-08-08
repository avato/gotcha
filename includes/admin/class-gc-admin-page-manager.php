<?php
/**
 * Gotcha admin asset functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           WHMCS-press
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'GC_Admin_Page_Manager' ) ) :

	class GC_Admin_Page_Manager{

		/** @var array array of all admin options. */
		public $options	= null;

		/**
	    * @var MCSP_Admin_Page_Manager The single instance of the class
	    */
	    protected static $_instance = null;


	    public $user;


	    /**
	    * Main GC_Admin_Page_Manager Instance
	    *
	    * Ensures only one instance of WC_Shipping is loaded or can be loaded.
	    *
	    * @since 0.1
	    * @static
	    * @return GC_Admin_Page_Manager
	    */
	    public static function instance() {
	    	if ( is_null( self::$_instance ) )
	    		self::$_instance = new self();
	    	return self::$_instance;
	    }


		public function __construct() {
			$this->init();			
		}


		/**
        * init function.
        */
        public function init() {
		     $this->options = get_option('Gotcha');
	    }



	    public function fetch_option($name){
	    	if ( !isset( $this->options[$name] ) ) return '';
	    	return $this->options[$name];
	    }


	    /**
	     * set a textinput field for the admin section
	     * @param string $name        field name
	     * @param string $label       input label
	     * @param string $placeholder input placeholder
	     */
	    public function set_textinput($name, $label, $placeholder, $cust_args = array()){


	    	$args = array(
	    		'label'          => $label,
	    		'name'           => $name,
	    		'value'          => $this->fetch_option($name),
	    		'default'        => '',
	    		'placeholder'    => $placeholder,
	    		'type'           => 'text',
	    		'autocorrect'    => 'off',
	    		'autocapitalize' => 'off',
	    		'autocomplete'   => 'off',
	    		'wrap_before'    => '<p>',
	    		'wrap_after'     => '</p>'
	    	);

	    	if ($placeholder != '') $args['placeholder'] = $placeholder;

	    	return gc_fetch_form( array_merge($args, $cust_args) );	    	
	    }


	    /**
	     * set a color field for the admin section
	     * @param string $name        field name
	     * @param string $label       input label
	     */
	    public function set_color($name, $label){
	    	$args = array('class' => 'gc-color-picker', 'default' => '#000000');

	    	return $this->set_textinput($name, $label, '', $args);   	
	    }

	    /**
	     * set a select field for the admin section
	     * @param string $name        field name
	     * @param string $label       input label
	     * @param string $placeholder input placeholder
	     */
	    public function set_select($name, $label, $option){

	    	$args = array(
	    		'label'          => $label,
	    		'name'           => $name,
	    		'value'          => $this->fetch_option($name),
	    		'default'        => 0.5,
	    		'option'         => $option,
	    		'type'           => 'select',
	    		'wrap_before'    => '<p>',
	    		'wrap_after'     => '</p>'
	    	);

	    	return gc_fetch_form($args);	    	
	    }

	    /**
	     * set a checkbox fields
	     * @param string $name        field name
	     * @param string $label       input label
	     */
	    public function set_check($name, $label){

	    	$args = array(
	    		'label'          => $label,
	    		'name'           => $name,
	    		'value'          => $this->fetch_option($name),
	    		'default'        => '',
	    		'type'           => 'checkbox',
	    		'wrap_before'    => '<p>',
	    		'wrap_after'     => '</p>'
	    	);

	    	return gc_fetch_form($args);	    	
	    }



	}

endif; // End if class_exists check
