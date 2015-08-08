<?php
/**
 * Gotcha functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           WHMCS-press
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;





/**
 * Retur nan instance of a class
 *
 * @return array
 */
function gc_fetch_form($args) {

	if ( ! class_exists( 'GC_Form' ) ) include 'utilities/class-gc-form.php';

	$newclass = new GC_Form($args);

	return $newclass->get_form();
}