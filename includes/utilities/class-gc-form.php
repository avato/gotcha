<?php
/**
 * Avato form helper
 *
 * @package    Avato
 * @author     Ava.to
 * @author     AJ Kotze  a@ava.to
 * @version    1.0
 * @link       http://ava.to
 * @since      1.0
 */
if ( ! defined( 'WPINC' ) ) die;

if ( ! class_exists( 'GC_Form' ) ) :

	class GC_Form {

		/** @var array all possible formparts that is available */
		private $formarray = array('wrap_before','before_label','label','before_type',
            'type','id','class','placeholder','data','min','max','step','disabled','name', 
            'autocomplete', 'autocapitalize','autocorrect', 'before_value', 'value', 'after_close',
            'description','wrap_after');


        private $mobileset = array('on','off');


        /** @var class alias */
        private $class_alias = 'hk';


		/** @var array holds an instance of the formpart */
		public $formparts = array();


        /** output of the form */
        public $formoutput;



        public function __construct($formparts){
            $this->formparts  = $formparts;
            $this->set_defaults();
        }


        /** test the validity of a formpart */
        private function test($part){
            return isset( $this->formparts[$part] )? true : false;
        }


        /** ensure that the required parts are set */
        public function set_defaults(){
            if ( !$this->test('id') ) $this->formparts['id'] = sanitize_html_class( $this->formparts['name'] );
            if ( !$this->test('class') ) $this->formparts['class'] = '';
            $this->formparts['before_label'] = '';
            $this->formparts['before_type']  = '';
            $this->formparts['after_close']  = '';
        }

 
 		/** returns the form for inclusion **/
        public function get_form() {
            return $this->process_form();  
        }


        /**
         * updateform updates the fom with content
         * @param  mixed $text text to add
         */
        private function update_form($text){
            $this->formoutput = $this->formoutput . ' ' . $text;
            return;
        }


        /**
         * processform process the form for return
         * @return html
         */
        private function process_form(){

            // loop the available formparts
            foreach ( $this->formarray as $formnodes ){

                // switch the available formparts
                if ( $this->test($formnodes) ){
                    call_user_func( array($this, 'get_' . $formnodes) );
                }
            }
            return $this->formoutput;   
        }



        /** wrap in front **/
        private function get_wrap_before(){
            if ( $this->test('wrap_before') ) $this->update_form( $this->formparts['wrap_before'] );
            return;
        }



        /** html before the label **/
        private function get_before_label(){
            switch ($this->formparts['type']) {
                case 'checkbox':
                    $this->update_form('<span class="' . $this->class_alias . '-checkbox cf">');
                    break;                        
            }
            return;
        }


        /** format a label **/
        private function get_label(){
            if ( $this->test('label') ){
                $this->update_form(  
                    sprintf( '<label for"%s">%s</label>',  
                             sanitize_html_class( $this->formparts['id'] ), 
                             esc_attr( $this->formparts['label'] ) 
                    ) 
                );
            }       
            return;
        }


       /** html before type **/
        private function get_before_type(){
            return;
        }


        /** manage autocomplete for mobile **/
        private function get_autocomplete(){
            if (  !in_array( $this->formparts['autocomplete'], $this->mobileset ) ) return;
            $this->update_form( sprintf('autocomplete="%s"', $this->formparts['autocomplete'] )  );
            return;
        }


        /** manage autocapitalize for mobile **/
        private function get_autocapitalize(){
            if (  !in_array( $this->formparts['autocapitalize'], $this->mobileset )  ) return;
            $this->update_form( sprintf('autocapitalize="%s"', $this->formparts['autocapitalize'] )  );
            return;
        }


        /** manage autocorrect for mobile **/
        private function get_autocorrect(){
            if (  !in_array( $this->formparts['autocorrect'], $this->mobileset )  ) return;
            $this->update_form( sprintf('autocorrect="%s"', $this->formparts['autocorrect'] )  );
            return;
        }


        /** start a input **/
        private function get_type(){
            $return = '';
            $standard = array('text','hidden','checkbox','number','password');

            if ( in_array( $this->formparts['type'], $standard ) ){
                $return = sprintf( '<input type="%s" ', $this->formparts['type'] );
            } else {

                switch ( $this->formparts['type'] ) {
                    case 'textarea': $return =  '<textarea '; break;
                    case 'select'  : $return =  '<select '; break;
                }

            }

            $this->update_form( $return );
            return;
        }


        /** sformat an id **/
        private function get_id(){
            $this->update_form(  sprintf( 'id="%s"' , sanitize_html_class( $this->formparts['id'] ) ) );
            return;
        }


        /** sformat a class **/
        private function get_class(){
            $classelements = array();
            $class   = array($this->class_alias . '-' . $this->formparts['type'] . '-formcomponent');
            if ( $this->formparts['class'] != ''){
                $classelements = array_map( function($v) { return sanitize_html_class( $v ); }, explode(' ', $this->formparts['class'] ) );
            } 
            $class = array_merge( $class,$classelements );
            $this->update_form(  sprintf( 'class="%s"' , implode(' ', $class ) ) );
            return;
        }



        /** placeholder part of a form */
        private function get_placeholder(){
            if ( in_array( $this->formparts['type'], array('color','number','slider','radio','checkbox') ) ) return;

            $this->update_form(  sprintf( ' placeholder="%s" ' , sanitize_text_field( $this->formparts['placeholder'] ) ) );
            return;
        }



        /** data part of a form */
        private function get_data() {
            $result = '';

            foreach ( $this->formparts['data'] as $datakey => $datavalue ){
                if ( isset($datakey) && !is_int($datakey) && isset( $datavalue ) )
                    $result  .=  sanitize_html_class($datakey) . '="' . esc_attr( $datavalue ) . '" ';
            }

            $this->updateform(  $result );
            return;
        }


        /** minimum input */
        private function get_min(){
            if ( !$this->test['number'] ) return;

            $this->update_form(  sprintf( 'min="%d"' , esc_attr( $this->formparts['min'] ) ) );
            return; 
        }


        /** maximum input */
        private function get_max(){
            if ( !$this->test['number'] ) return '';

            $this->update_form(  sprintf( 'max="%d"' , esc_attr( $this->formparts['max'] ) ) );
            return; 
        }


        /** step input */
        private function get_step(){
            if ( !$this->formparts['type'] == 'number') return '';

            $this->update_form(  sprintf( 'step="%d"' , esc_attr( $this->formparts['step'] ) ) );
            return;
        }


       /** disabled input */
        private function get_disabled(){
            $this->update_form( 'disabled' );
            return;
        }

        /** name of a form */
        private function get_name(){
            $this->update_form(  sprintf( 'name="%s"', $this->formparts['name'] ) );
            return;
        }


        /** additional settings before value */
        private function get_before_value(){
            if ( $this->test[ 'wrap_before' ] ) $this->updateform( $this->formparts['wrap_before'] );
            return;
        }


        /** value part of form */
        private function get_value(){
            if ( in_array( $this->formparts['type'], array('radio') ) ) return;
            $return = '';
            $default = (  $this->test('default') )? $this->formparts['default'] : '' ;
            $value   = (  $this->test('value') )? $this->formparts['value'] : $default ;

            switch ( $this->formparts['type'] ) {
                case 'text'     :    $return = sprintf( 'value="%s" >' , sanitize_text_field( $value ) ); break;
                case 'hidden'   :    $return = sprintf( 'value="%s" >' , sanitize_text_field( $value ) ); break;
                case 'textarea' :    $return = sprintf( '> %s </textarea>' , sanitize_text_field( $value ) ); break;
                case 'checkbox' :    $return = sprintf( '%s value="on" >' , checked( 'on', $this->formparts['value'], false ) ); break;
                case 'select'   :    $return = sprintf( ' >%s</select>', $this->formatselect() ); break;
                case 'image'    :    $return = sprintf( ' value="%s" ></section>', sanitize_text_field( $value ) ); break;
                case 'number'   :    $return = sprintf( 'value="%s" >' , sanitize_text_field( $value ) ); break;
                case 'mp3'      :    $return = sprintf( 'value="%s" >' , esc_attr( $value ) ); break;
                case 'video'    :    $return = sprintf( 'value="%s" >' , esc_attr( $value ) ); break;
            }

            $this->update_form( $return );
        }


        /** formatselect formats a selectbox */
        private function formatselect() {
            $html = '';
            foreach ( $this->formparts['option'] as $node ){
                $html .= sprintf('<option value="%s" %s >%s</option>',$node['value'], selected($node['value'], $this->formparts['value'], false  ), $node['name'] );
            }
            return $html;
        }


       /** additional settings before value */
        private function get_after_close(){
            switch ($this->formparts['type']) {
                case 'checkbox':
                    $this->update_form('<span  class="holderspan"></span></span>');
                    break;                        
            }
            return;
        }

        /**
         * format a description
         */
        private function get_description(){
            $this->updateform( sprintf( '<span class="avi-formpart-description">%s</span>' , $this->validate('description') )  );
        	return;
        }

        /** wrap in front **/
        private function get_wrap_after(){
            if ( $this->test('wrap_after') ) $this->update_form( $this->formparts['wrap_after'] );
            return;
        }



        /**
         * testForm test the validity of a collection of formparts
         * @param  array  $parts parts ot test
         * @return bool
         */
        private function test_form( $parts = array() ){
        	$return = false;

        	if (array_intersect( $parts, array_keys( $this->formparts ) ) ==  $parts ) $return = true;

        	return $return;
        }
 
    }
endif; // End if class_exists check