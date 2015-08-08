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



/**
 * Get all screen ids
 *
 * @return array
 */
function gc_get_screen_ids() {
	$screen_ids   = array(
		'users_page_gotcha-settings'
	);	
	return apply_filters( 'gc_screen_ids', $screen_ids );
}


/**
 * Retur nan instance of a class
 *
 * @return array
 */
function gc_start_class($classname) {
	$class_name = 'GC_' . $classname;
	$class_path = 'class-gc-' . strtolower( str_replace('_','-',$classname) ) . '.php';
	if ( ! class_exists( $class_name ) ) include $class_path;

	$newclass = new $class_name;

	return $newclass::instance();
}