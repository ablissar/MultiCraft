<?php
/**
 * Query Parameter Translator Class
 *
 * This class enables translating a query parameter with 
 * additional options.
 *
 * @package		
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Scott Benton
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_Validation  {
	
	public function __construct( $rules = [] )
	{
		parent::__construct( $rules );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Float
	 *
	 * @param	string
	 * @return	bool
	 */
	public function float( $str )
	{
		$float = filter_var( $str, FILTER_VALIDATE_FLOAT );		
		return ( is_float( $float ) ? TRUE : is_int( $float ) );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Required If
	 * 
	 * Requires this value if the indicated field has been set, or if the field
	 * has been set and matches the indicated value. Comma-delimited parameters
	 * to compensate with CI's inability for multiple parameters.
	 *
	 * @param	string	$str
	 * @param	string	$parameters	Field or field + value to look at.
	 * @return	bool
	 */
	public function required_with( $str, $parameters )
	{
		$parameters 	= explode( ',', $parameters );
		$field 		= $parameters[0];
		$value 		= isset( $parameters[1] ) ? $parameters[1] : NULL;
		//var_dump( $this->_field_data[ $field ] );
		
		//echo $str;
		//$present = $this->required( $this->_field_data[ $str ] );
		
		if ( isset( $this->_field_data[ $field ], $this->_field_data[ $field ]['postdata'] ) )
		{
			if ( empty( $value ) || $value === $this->_field_data[ $field ]['postdata'] )
			{
				//echo $field;
				return $this->required( $str );
			}
		}
		 
		return TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Valid Date
	 * 
	 * Checks whether the value is a valid date according to the strtotime 
	 * PHP function.
	 *
	 * @param	string	$str
	 * @return	bool
	 */
	public function valid_date( $str )
	{
		if ( ! is_string( $str ) || ! is_numeric( $str ) || strtotime( $str ) === FALSE )
		{
			return FALSE;
		}
		
		$date = date_parse( $str );
		
		return checkdate($date['month'], $date['day'], $date['year']);
	}
}