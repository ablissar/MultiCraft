<?php 
/**
 * Class Job
 *
 * Entity for a Job Value Object
 *
 * @package 	App\Entities
 * @category 	
 * @author		Scott Benton
 */
namespace App\Entities;

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends Entity {
	
	protected $company_code;
	protected $customer_code; // Customer Object?
	protected $customer_name;
	protected $job_number;
	protected $division;
	protected $job_type;
	protected $status_code;
	protected $description;
	protected $short_description;
	protected $comment;
	
	// Location Parameters
	protected $address_1;
	protected $address_2;
	protected $city;
	protected $state;
	protected $zip_code;
	protected $latitude;
	protected $longitude;
	
	// Employees in Spectrum?
	protected $superintendent;
	protected $superintendent_name;
	protected $estimator;
	protected $estimator_name;
	protected $project_manager;
	protected $project_manager_name;
	
	
	// Tax stuff?
	protected $tax_classification_code;
	protected $taxable_flag;
	protected $certified_flag;
	protected $track_davis_bacon;
	protected $track_prevailing_wage;
	
	
	protected $price_method_code;
	protected $contract_number;
	protected $original_contract_amount;
	
	protected $complete_date;
	protected $start_date;
	protected $estimated_complete_date;
	protected $estimated_start_date;
	protected $created_date;
	
	// Questionable usefulness
	protected $master_job; // a parent entity, perhaps? or just a job number?
	protected $owner_name;
	
	
	// Custom stuff for our entity? Not sure if we need to have it here, or make another composite entity instead.
	protected $phase_repository = '\App\Repositories\Phase_Repository';
	protected $phases;
	
	
	private $_job_types = [
		'CN'	 => 'Contract',
		'TM' => 'Time &amp; Material'
	];
	
	private $_status_codes = [
		'A'	=> 'Active',
		'I'	=> 'Inactive',
		'C'	=> 'Closed'
	];

	
	
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
		
		// Create the phase repository here?
		$this->phases = new $this->phase_repository();
	}
	
	
	
	
	// --------------------------------------------------------------------
	
	
	//--------------------------------------------------------------------
    // Getters
    //--------------------------------------------------------------------
	
	
	/**
	 * Returns the human-readable version of the job_type field as a 
	 * string, and provides a value if status_code is not set.
	 * 
	 * @return 	string
	 */
	public function job_type()
	{
		$job_type = 'Undefined';
		
		if ( isset( $this->job_type ) && isset( $this->_job_types[ $this->job_type ] ) )
		{
			$job_type = $this->_job_types[ $this->job_type ];	
		}
		
		return $job_type;
	}
	
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
	
	// --------------------------------------------------------------------
	
	/**
	 * Returns the original_contract_amount field value as a money 
	 * formatted string. If $locale is TRUE, the underlying float option
	 * will be returned instead.
	 * 
	 * @param	string	$locale 	locale flag to set
	 * 	
	 * @return 	mixed	
	 */
	public function original_contract_amount( $locale = 'en_US' )
	{
		setlocale( LC_MONETARY, $locale );
		
		return 	$locale === TRUE
			?	$this->original_contract_amount
			:	money_format( '%.2n', $this->original_contract_amount );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Returns the tax_classification_code value if it exists, otherwise
	 * returns a string representing a missing value.
	 * 
	 * @return 	string
	 */
	public function tax_classification_code()
	{
		return $this->tax_classification_code ?: '---';
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * 	
	 * @return 	string
	 */
	public function created_date( $format = 'Y-m-d H:i:s' )
	{
		return ( $format === TRUE || is_null( $this->created_date ) )
			? $this->created_date
			: $this->created_date->format( $format );
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
	 * 	
	 * @return 	string
	 */
	protected function set_created_date( $datetime = NULL )
	{
		$this->created_date = ( is_null( $datetime ) ) ? NULL : new \DateTime( $datetime, new \DateTimeZone( 'UTC' ) );
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * 	
	 * @return 	string
	 */
	
	public function set_job_type( $job_type = '' )
	{
		$this->job_type = strtoupper( $job_type );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * 	
	 * @return 	string
	 */
	
	public function set_customer_name( $customer_name = '' )
	{
		$this->customer_name = ucwords( strtolower( $customer_name ) );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * 	
	 * @return 	string
	 */
	
	public function set_superintendent_name( $name = '' )
	{
		$this->superintendent_name = ucwords( strtolower( $name ) );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * 	
	 * @return 	string
	 */
	
	public function set_estimator_name( $name = '' )
	{
		$this->estimator_name = ucwords( strtolower( $name ) );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * A
	 * 
	 * B
	 * 
	 * @param	string
	 * 	
	 * @return 	string
	 */
	
	public function set_project_manager_name( $name = '' )
	{
		$this->project_manager_name = ucwords( strtolower( $name ) );
	}
	
	// --------------------------------------------------------------------
	
}
