<?php 
/**
 * Class Phase
 *
 * Entity for a Phase Value Object
 *
 * @package 	App\Entities
 * @category 	
 * @author		Scott Benton
 */
namespace App\Entities;

defined('BASEPATH') OR exit('No direct script access allowed');

class Phase extends Entity {
	
	protected $company_code;
	protected $job_number;
	protected $phase_code;		// Phase Number
	protected $division;
	protected $phase_group;
	protected $alternate_phase_code;
	protected $status_code;
	protected $description;
	protected $cost_type;
	protected $price_method_code;
	
	
	protected $start_date;
	protected $end_date;
	protected $complete_date;
	protected $lead_time_days;
	
	//protected $comment; // potential for short description/long description here too, maybe?
	
	// Estimates
	protected $original_estimated_cost;
	protected $original_estimated_hours;
	
	
	private $_status_codes = [
		'A'	=> 'Active',
		'I'	=> 'Inactive',
		'C'	=> 'Closed'
	];

	
	/**
	 * 
	 * 
	 * @return void
	 */
	function __construct( array $data = NULL )
	{
		//parent::__construct();
		if ( ! is_null( $data ) )
		{
			foreach ( $data as $attribute => $value )
			{
				$method = 'set_' . $attribute;
				
				if ( method_exists( $this, $method ) )
				{
					$this->$method( $value );	
				}
				elseif ( property_exists( $this, $attribute ) )
				{
					$this->$attribute = $value;
				}
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	
	
	public function matches( $criteria = [] )
	{
		$result = TRUE;
		
		foreach ( $criteria as $attribute => $value )
		{
			if ( $this->$attribute !== $value )
			{
				$result = FALSE;
			}
		}
		
		return $result;
	}
	
	
	
	
	
	
	//--------------------------------------------------------------------
    // Getters
    //--------------------------------------------------------------------
	
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Returns the human-readable version of the status_code field as a 
	 * string, and provides a value if status_code is not set.
	 * 
	 * @return 	string
	 */
	
	public function status()
	{
		$status = 'Undefined';
		
		if ( isset( $this->status_code ) && isset( $this->_status_codes[ $this->status_code ] ) )
		{
			$status = $this->_status_codes[ $this->status_code ];
		}
		
		return $status;
	}
	
	
	
	
	
	
	
	
	
	//--------------------------------------------------------------------
    // Setters
    //--------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * @return 	string
	 */
	protected function set_start_date( $datetime = NULL )
	{
		$this->start_date = ( is_null( $datetime ) ) ? NULL : new \DateTime( $datetime, new \DateTimeZone( 'UTC' ) );
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * @return 	string
	 */
	protected function set_end_date( $datetime = NULL )
	{
		$this->end_date = ( is_null( $datetime ) ) ? NULL : new \DateTime( $datetime, new \DateTimeZone( 'UTC' ) );
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * @return 	string
	 */
	protected function set_complete_date( $datetime = NULL )
	{
		$this->complete_date = ( is_null( $datetime ) ) ? NULL : new \DateTime( $datetime, new \DateTimeZone( 'UTC' ) );
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	
	
}