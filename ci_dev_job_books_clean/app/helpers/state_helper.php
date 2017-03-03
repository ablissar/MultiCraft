<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * US States Helper
 *
 * @package		
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Scott Benton
 */

// ------------------------------------------------------------------------

if ( ! function_exists( 'state_code_to_name' ) )
{
	/**
	 * Convert from abbreviation.
	 * 
	 * Convert a state abbreviation to the full state name.
	 * 
	 * @param	string	$code	Two-letter abbreviation
	 * @return	string
	 */
	function state_code_to_name( $code )
	{
		$states 	= get_states_array();
		$code	= strtoupper( $code );
		
		return isset( $states[ $code ] )
				? $states[ $code ]
				: FALSE;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'state_name_to_code' ) )
{
	/**
	 * Convert to abbreviation.
	 * 
	 * Convert a full state name to the state abbreviation code.
	 * 
	 * @param	string	$name	Full state name
	 * @return	string
	 */
	function state_name_to_code( $name )
	{
		$states 	= get_states_array();
		$name	= ucwords( strtolower( $code ) );
		
		return array_search( $name, $states );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'is_valid_state' ) )
{
	/**
	 * Check for valid state
	 * 
	 * Check to see if a provided state exists, with option to select a
	 * specific format to validate against.
	 * 
	 * @param	string	$string 	State Code or Full State Name
	 * @param	string	$mode 		'code', 'name', 'both'
	 * @return	bool
	 */
	function is_valid_state( $string, $mode = 'both' )
	{
		$valid 	= FALSE;
		$states 	= get_states_array();
		
		if ( $mode === 'code' )
		{
			$valid = array_key_exists( strtoupper( $string ), $states );
		}
		elseif ( $mode === 'name' )
		{
			$valid = in_array( ucwords( strtolower( $string ) ), $states );
		}
		elseif ( $mode === 'both' )
		{
			$valid = is_valid_state( $string, 'code' ) || is_valid_state( $string, 'name' );
		}
		
		return $valid;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'get_states_array' ) )
{
	/**
	 * Get State Array
	 * 
	 * Return an associated array of states with their abbreviation as the key.
	 * 
	 * @return	array
	 */
 	function get_states_array()
	{
		$state_list = [
			'AL' => 'Alabama',
			'AK' => 'Alaska',
			'AZ' => 'Arizona',
			'AR' => 'Arkansas',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DE' => 'Delaware',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'HI' => 'Hawaii',
			'ID' => 'Idaho',
			'IL' => 'Illinois',
			'IN' => 'Indiana',
			'IA' => 'Iowa',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'ME' => 'Maine',
			'MD' => 'Maryland',
			'MA' => 'Massachusetts',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MS' => 'Mississippi',
			'MO' => 'Missouri',
			'MT' => 'Montana',
			'NE' => 'Nebraska',
			'NV' => 'Nevada',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NY' => 'New York',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma',
			'OR' => 'Oregon',
			'PA' => 'Pennsylvania',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VT' => 'Vermont',
			'VA' => 'Virginia',
			'WA' => 'Washington',
			'WV' => 'West Virginia',
			'WI' => 'Wisconsin',
			'WY' => 'Wyoming'
		];
		
		return $state_list;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'get_state_codes_array' ) )
{
	/**
	 * Get State Codes Array
	 * 
	 * Return an associated array of states with their abbreviation as 
	 * the key and value.
	 * 
	 * @return	array
	 */
 	function get_state_codes_array()
	{
		$state_code_list = [
			'AL' => 'AL',
			'AK' => 'AK',
			'AZ' => 'AZ',
			'AR' => 'AR',
			'CA' => 'CA',
			'CO' => 'CO',
			'CT' => 'CT',
			'DE' => 'DE',
			'FL' => 'FL',
			'GA' => 'GA',
			'HI' => 'HI',
			'ID' => 'ID',
			'IL' => 'IL',
			'IN' => 'IN',
			'IA' => 'IA',
			'KS' => 'KS',
			'KY' => 'KY',
			'LA' => 'LA',
			'ME' => 'ME',
			'MD' => 'MD',
			'MA' => 'MA',
			'MI' => 'MI',
			'MN' => 'MN',
			'MS' => 'MS',
			'MO' => 'MO',
			'MT' => 'MT',
			'NE' => 'NE',
			'NV' => 'NV',
			'NH' => 'NH',
			'NJ' => 'NJ',
			'NM' => 'NM',
			'NY' => 'NY',
			'NC' => 'NC',
			'ND' => 'ND',
			'OH' => 'OH',
			'OK' => 'OK',
			'OR' => 'OR',
			'PA' => 'PA',
			'RI' => 'RI',
			'SC' => 'SC',
			'SD' => 'SD',
			'TN' => 'TN',
			'TX' => 'TX',
			'UT' => 'UT',
			'VT' => 'VT',
			'VA' => 'VA',
			'WA' => 'WA',
			'WV' => 'WV',
			'WI' => 'WI',
			'WY' => 'WY'
		];
		
		return $state_code_list;
	}
}