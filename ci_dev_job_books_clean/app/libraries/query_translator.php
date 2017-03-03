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

class Query_Translator {
	
	
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message( 'info', 'Query Translator Class Initialized' );
	}
	
	// --------------------------------------------------------------------

	/**
	 * Translate the column name.
	 *
	 * Applies the provided options to the original parameters and returns
	 * the translated attribute.
	 *
	 * @param	string	$column_name	the column parameter to translate
	 * @param	string	$alias			alias to return
	 * @param	string	$prefix			prefix 
	 * @param	string	$method			method to call and apply to the result
	 * @return	string
	 */
	public function translate_column( $column_name = '', $alias = '', $prefix = '', $method = '' )
	{
		if ( empty( $column_name ) || ! is_string( $column_name ) )
		{
			return FALSE;
		}
		
		$attribute = $column_name;
		
		if ( is_string( $prefix ) && ! empty( $prefix ) )
		{
			$attribute = $prefix . '.' . $attribute;
		}
		
		if ( ! empty( $method ) && method_exists( $this, $method ) )
		{
			$attribute = $this->$method( $attribute );
		}
		
		if ( is_string( $alias ) && ! empty( $alias ) )
		{
			$attribute .= ' AS "' . $alias . '"';
		}
		
		return $attribute;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Translate multiple column names.
	 *
	 * Applies the provided rules to the original parameters and returns
	 * the translated attributes.
	 *
	 * @param	array	$columns		the column parameter to translate
	 * @param	array	$rules			ruleset to use when translating columns
	 * @param	string	$prefix			prefix to apply to the parameter
	 * @return	array
	 */
	public function translate_columns( $columns = [], $rules = [], $prefix = '' )
	{
		is_array( $columns ) 	|| $columns	= [ $columns ];
		is_array( $rules ) 		|| $rules 	= [ $rules ];
		is_string( $prefix )		|| $prefix	= '';
		
		if ( empty( $columns ) || empty( $rules ) )
		{
			return FALSE;
		}
		
		$translated_data = [];
		
		foreach ( $columns as $column )
		{
			$column_name	= '';
			$alias 			= '';
			$function		= '';
			
			if ( isset( $rules[ $column ] ) )
			{
				if ( ! empty( $rules[ $column ]['column_name'] ) )
				{
					$column_name = $rules[ $column ]['column_name'];
				}
				
				if ( ! empty( $rules[ $column ]['function'] ) )
				{
					$function = $rules[ $column ]['function'];
				}
				
				$alias = $column;
				
				if ( $attribute = $this->translate_column( $column_name, $alias, $prefix, $function ) )
				{
					$translated_data[] = $attribute;
				}
			}
		}
		
		return $translated_data;
	}
		
	// --------------------------------------------------------------------

	/**
	 * Applies the MSSQL "trim" equivalent to the string.
	 *
	 * @param	string	$attribute	string being modified
	 * @return	string
	 */
	protected function mssql_trim( $attribute = '' )
	{
		return 'LTRIM( RTRIM( ' . $attribute . ' ) )';
	}
}