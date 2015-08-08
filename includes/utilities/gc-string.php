<?php
/**
 * Gotcha string utilities
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Gotcha
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;


/**
* isUrl test a string for a valid url
* @param  string  $text [description]
*/
function gc_is_url( $text )  {  
   return filter_var( $text, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false;  
}