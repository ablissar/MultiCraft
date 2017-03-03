<?php
/**
 * Form Builder Class
 *
 * This class enables to dynamically build form components
 * based on options passed in from a config file.
 * 
 * @package		
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Scott Benton
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Builder {
	
	protected $CI;
	
	protected $input_types = [
		'text_element' => [
			'hidden',
			'input',
			'password',
			'upload',
			'textarea',
		],
		'select_element' => [
			'dropdown',
			'multiselect'
		],
		'checkable_element' => [
			'checkbox',
			'radio'
		]
	];
	
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		 // Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		// Insure that the form helper has been loaded.
		$this->CI->load->helper( 'form' );
		
		log_message( 'info', 'Form Builder Class Initialized' );
	}
	
	// --------------------------------------------------------------------

	/**
	 * Build the form component.
	 *
	 * Builds the input and label based off of parameters provided and 
	 * returns the resulting string.
	 *
	 * @param	string	$input_type 	form input type
	 * @param	array	$input_options	options used to construct the element
	 * @param	string	$label_text		text for the label or FALSE for no label 
	 * @param	string	$label_options	method to call and apply to the result
	 * @return	string
	 */
	public function build_component( $input_type = '', $input_options = [], $label_text = FALSE, $label_options = [], $inline_error = FALSE )
	{
		$method 		= NULL;
		$input 		= NULL;
		$label 		= NULL;
		$component 	= '';
		$has_label 	= is_string( $label_text );
		
		// Retrieve the method for building the input.
		if ( ! $method = $this->get_element_method( $input_type ) )
		{
			return FALSE;
		}
		
		// Check to see if our input will be nested inside of the label.
		$input_in_label = ( $method === 'checkable_element' );
		
		// Build the input.
		if ( ! empty( $method ) && method_exists( $this, $method ) )
		{
			$input = $this->$method( $input_type, $input_options );
		}
		
		// Build a label for the input if options provided.
		if ( $has_label )
		{
			$label_content = $label_text;
			
			// Wrap the label around the input.
			if ( $input_in_label === TRUE && is_string( $input ) )
			{
				$label_content = $input . $label_content;
			}
			
			// Create the label.
			if ( $label = $this->label( $label_content, $label_options ) )
			{
				$component .= $label;	
			}
		}
		
		// Assemble the component.
		if ( ! is_null( $input ) )
		{
			if ( $has_label && ! is_null( $label ) )
			{
				if ( $input_in_label )
				{
					$component = $label;
				}
				else
				{
					$component = $label . $input;
				}
			}
			else
			{
				$component = $input;
			}
		}
		
		return $component;
	}
	
	
	
	// --------------------------------------------------------------------

	/**
	 * Build the text input form component.
	 *
	 * Builds the input based off of parameters provided and 
	 * returns the resulting string.
	 *
	 * @param	string	$input_type 	form input type
	 * @param	array	$input_options	alias to return
	 * @return	string
	 */
	protected function text_element( $input_type = '', $input_options = [] )
	{
		$element 	= '';
		$function 	= 'form_' . $input_type;
		$value 		= '';
		$extra 		= '';
		
		if ( isset( $input_options['value'] ) )
		{
			$value = $input_options['value'];
			unset( $input_options['value'] );
		}
		
		if ( isset( $input_options['extra'] ) )
		{
			$extra = $input_options['extra'];
			unset( $input_options['extra'] );
		}
		
		if ( function_exists( $function ) )
		{
			$element = $function( $input_options, $value, $extra );
		}
		
		return $element;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Build the select form component.
	 *
	 * Builds the input based off of parameters provided and 
	 * returns the resulting string.
	 *
	 * @param	string	$input_type 	form input type
	 * @param	array	$input_options	options to construct the element with
	 * @return	string
	 */
	protected function select_element( $input_type = '', $input_options = [] )
	{
		$element 	= '';
		$function 	= 'form_' . $input_type;
		$options	= '';
		$selected	= '';
		$extra		= '';
		$callback	= '';
		
		if ( isset( $input_options['options'] ) )
		{
			$options = $input_options['options'];
			unset( $input_options['options'] );
		}
		
		if ( isset( $input_options['selected'] ) )
		{
			$selected = $input_options['selected'];
			unset( $input_options['selected'] );
		}
		
		if ( isset( $input_options['extra'] ) )
		{
			$extra = $input_options['extra'];
			unset( $input_options['extra'] );
		}
		
		//echo $input_options['options_callback'];
		//var_dump( is_callable( $input_options['options_callback'] ) );
		if ( isset( $input_options['options_callback'] ) && is_callable( $input_options['options_callback'] ) )
		{
			
			$callback = $input_options['options_callback'];
			$options = $callback();
			unset( $input_options['options_callback'] );
		}
		
		if ( function_exists( $function ) )
		{
			$element = $function( $input_options, $options, $selected, $extra );	
		}
		
		return $element;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Build the checkbox/radio form components.
	 *
	 * Builds the input based off of parameters provided and 
	 * returns the resulting string.
	 *
	 * @param	string	$input_type 	form input type
	 * @param	array	$input_options	options to construct the element with
	 * @return	string
	 */
	protected function checkable_element( $input_type = '', $input_options = [] )
	{
		$element 	= '';
		$function 	= 'form_' . $input_type;
		$value 		= '';
		$checked	= FALSE;
		$extra		= '';
		
		if ( isset( $input_options['value'] ) )
		{
			$value = $input_options['value'];
			unset( $input_options['value'] );
		}
		
		if ( isset( $input_options['checked'] ) )
		{
			$checked = $input_options['checked'];
			unset( $input_options['checked'] );
		}
		
		if ( isset( $input_options['extra'] ) )
		{
			$extra = $input_options['extra'];
			unset( $input_options['extra'] );
		}
		
		if ( function_exists( $function ) )
		{
			$element = $function( $input_options, $value, $checked, $extra );	
		}
		
		return $element;
	}
	
	
	
	protected function label( $content, $options = [] )
	{
		$label 	= '';
		$for 	= '';
		
		if ( isset( $options['for'] ) )
		{
			$for = $options['for'];
			unset( $options['for'] );
		}
		
		if ( function_exists( 'form_label' ) )
		{
			$label = form_label( $content, $for, $options );
		}
		
		return $label;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Retrieves the method that is responsible for handling the input type.
	 *
	 * @param	string	$input_type 	form input type
	 * @return	string
	 */
	protected function get_element_method( $input_type = '' )
	{
		if ( ! is_string( $input_type ) || empty( $this->input_types ) )
		{
			return FALSE;	
		}
		
		$method = FALSE;
		
		foreach ( $this->input_types as $element => $valid_types )
		{
			if ( in_array( $input_type, $valid_types ) )
			{
				$method = $element;
			}
		}
		
		return $method;
	}
}