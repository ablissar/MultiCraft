<?php
/**
 * Job Model
 * 
 * 
 * 
 * @package		Job Books
 * @author		Scott Benton
 * 
 */
namespace App\Models\Job_Books;

defined('BASEPATH') OR exit('No direct script access allowed');



class Job_model extends \MY_Model 
{
	protected $factory; // factory the right word, or no?
	
	
	protected $table = '';
	protected $allowed_fields = [
		'company_code',
		'job_number',
		'division',
		'short_description',
		'address_1',
		'address_2',
		'city',
		'state',
		'zip_code',
		'superintendent',
		'estimator',
		'project_manager',
		'certified_flag',
		'contract_number',
		'status_code',
		'complete_date',
		'start_date',
		'estimated_complete_date',
		'estimated_start_date',
		'customer_code',
		'job_type',
		'original_contract_amount',
		'taxable_flag',
		'price_method_code',
		'tax_classification_code',
		'track_prevailing_wage',
		'track_davis_bacon',
		'projected_complete_date',
		'latitude',
		'longitude',
		'created_date',
		'description'
	];
	
	protected $default_select = [
		'company_code',
		'job_number',
		'division',
		'short_description',
		'description',
		'address_1',
		'address_2',
		'city',
		'state',
		'zip_code',
		'superintendent',
		'tax_classification_code',
		'customer_code',
		'status_code',
		'created_date'
	];
	
	protected $default_job_select = [
		'company_code',
		'job_number',
		'division',
		'short_description',
		'address_1',
		'address_2',
		'city',
		'state',
		'zip_code',
		'superintendent',
		'estimator',
		'project_manager',
		'certified_flag',
		'contract_number',
		'status_code',
		'complete_date',
		'start_date',
		'estimated_complete_date',
		'estimated_start_date',
		'customer_code',
		'job_type',
		'original_contract_amount',
		'taxable_flag',
		'price_method_code',
		'tax_classification_code',
		'track_prevailing_wage',
		'track_davis_bacon',
		'projected_complete_date',
		'latitude',
		'longitude',
		'created_date',
		'description'
	];
	
	// maybe have some protected parameters for the translated bits?
	// would simplify usage to "$this->company_code", right?
	
	/**
	 * Are we running in mock mode? 
	 * If so, fake database results.
	 * @var boolean
	 */
	protected $mock = FALSE;
	
	/**
	 * Are we running in mock mode? 
	 * If so, fake database results.
	 * @var array
	 */
	protected $mockData = [
		'16TT001' => [
			'Company_Code' => 'MCC',
			'Job_Number' => '16TT001',
			'Division' => '11 ',
			'Job_Description' => 'TEST',
			'Address_1' => 'line 1                      ',
			'Address_2' => 'line 2               ',
			'City' => 'springdale                 ',
			'State' => 'AR',
			'Zip_Code' => '72765',
			'Superintendent' => 'n/a        ',
			'Estimator' => 'n/a        ',
			'Certified_Flag' => ' ',
			'Contract_Number' => 'n/a                       ',
			'Status_Code' => 'A',
			'Complete_Date' => '',
			'Start_Date' => 'Nov 21 2016 12:00:00:000AM',
			'Est_Complete_Date' => '',
			'Est_Start_Date' => '',
			'Customer_Code' => 'test    ',
			'Job_Type' => 'TM        ',
			'Original_Contract' => '0',
			'Taxable_Flag' => 'N',
			'Price_Method_Code' => 'T',
			'Project_Manager' => 'n/a        ',
			'Tax_Class_Code' => 'n/a           ',
			'Track_Prevailing_Wage' => ' ',
			'Track_Davis_Bacon' => ' ',
			'Cost_Center' => '          ',
			'Projected_Complete_Date' => '',
			'Latitude' => 0,
			'Longitude' => 0,
			'Create_Date' => 'Nov 21 2016 12:00:00:000AM',
			'Comment' => ''
		],
		'16MT851' => [
			'Company_Code' => 'MCC',
			'Job_Number' => '   16MT851',
			'Division' => '66   ',
			'Job_Description' => 'MULTRO-RMV FENCE, RETOOL ',
			'Address_1' => 'DCM # 63                      ',
			'Address_2' => 'PACE INDUSTRIES               ',
			'City' => 'HARRISON                 ',
			'State' => 'AR',
			'Zip_Code' => '          ',
			'Superintendent' => 'TEFFCD6        ',
			'Estimator' => 'TEFFCD6        ',
			'Certified_Flag' => ' ',
			'Contract_Number' => '16AC039                       ',
			'Status_Code' => 'A',
			'Complete_Date' => '',
			'Start_Date' => 'Nov 21 2016 12:00:00:000AM',
			'Est_Complete_Date' => '',
			'Est_Start_Date' => '',
			'Customer_Code' => 'MULTRO    ',
			'Job_Type' => 'TM        ',
			'Original_Contract' => '0',
			'Taxable_Flag' => 'N',
			'Price_Method_Code' => 'T',
			'Project_Manager' => 'TEFFCD6        ',
			'Tax_Class_Code' => 'ASD7           ',
			'Track_Prevailing_Wage' => ' ',
			'Track_Davis_Bacon' => ' ',
			'Cost_Center' => '          ',
			'Projected_Complete_Date' => '',
			'Latitude' => 0,
			'Longitude' => 0,
			'Create_Date' => 'Nov 21 2016 12:00:00:000AM',
			'Comment' => ''
		],
		'16MT850' => [
			'Company_Code' => 'MCC',
			'Job_Number' => '   16MT850',
			'Division' => '66   ',
			'Job_Description' => 'GATESS-QMT REPAIR 11-19  ',
			'Address_1' => '                              ',
			'Address_2' => '1801 North Lincoln            ',
			'City' => 'Siloam Springs           ',
			'State' => 'AR',
			'Zip_Code' => '72761     ',
			'Superintendent' => 'SIZEMJ6        ',
			'Estimator' => 'SIZEMJ6        ',
			'Certified_Flag' => ' ',
			'Contract_Number' => 'SS167146                      ',
			'Status_Code' => 'A     ',
			'Complete_Date' => '',
			'Start_Date' => 'Nov 21 2016 12:00:00:000AM',
			'Est_Complete_Date' => '',
			'Est_Start_Date' => '',
			'Customer_Code' => 'GATESS    ',
			'Job_Type' => 'TM        ',
			'Original_Contract' => '0',
			'Taxable_Flag' => 'N',
			'Price_Method_Code' => 'T',
			'Project_Manager' => 'SIZEMJ6        ',
			'Tax_Class_Code' => 'ASS6             ',
			'Track_Prevailing_Wage' => ' ',
			'Track_Davis_Bacon' => ' ',
			'Latitude' => '0',
			'Longitude' => '0',
			'Create_Date' => 'Nov 21 2016 12:00:00:000AM',
			'Comment' => ''
		],
		'16FM074' => [
			'Company_Code' => 'MCC',
			'Job_Number' => '   16FM074',
			'Division' => '55   ',
			'Job_Description' => 'KRAFBA-COOLER INSUL/PAINT',
			'Address_1' => '                              ',
			'Address_2' => 'KRAFT                         ',
			'City' => 'FT SMITH                 ',
			'State' => 'AR',
			'Zip_Code' => '.         ',
			'Superintendent' => 'JERRY STEPHENSO',
			'Estimator' => 'JERRY STEPHENSO',
			'Certified_Flag' => ' ',
			'Contract_Number' => '                              ',
			'Status_Code' => 'A',
			'Complete_Date' => '',
			'Start_Date' => '',
			'Est_Complete_Date' => '',
			'Est_Start_Date' => '',
			'Customer_Code' => 'KRAFBA    ',
			'Job_Type' => 'CN        ',
			'Original_Contract' => '180124',
			'Taxable_Flag' => 'N',
			'Price_Method_Code' => 'F',
			'Project_Manager' => 'JERRY STEPHENSO',
			'Tax_Class_Code' => 'ASD6           ',
			'Track_Prevailing_Wage' => ' ',
			'Track_Davis_Bacon' => ' ',
			'Latitude' => '0',
			'Longitude' => '0',
			'Create_Date' => 'Nov 22 2016 12:00:00:000AM',
			'Comment' => ''
		]
	];
	
	function __construct( $factory )
	{
		parent::__construct();
		
		$this->factory = $factory;
		
		// If not running in production, nothing further to do.
		//$this->mock = ENVIRONMENT != 'production';
		if ( $this->mock )
		{
			return;
		}
		
		$this->load->config( 'spectrum', TRUE );
		$this->column_rules = $this->config->item( 'job_columns', 'spectrum' );
		$this->load->library( 'query_translator' );
		$this->load->database( 'spectrum' );
	}
	
	
	/**
	 * 
	 * @param	mixed|array	$id	One primary key or an array of primary keys.	
	 * @return	object
	 */
	public function find( $id, $requested_attributes = [] )
	{		
		// If not running in production, return the mock data.
		if ( $this->mock )
		{
			$result = $this->mockData[ $id ];
			return $this->factory->build( $result );
		}

		$select = [];
		$requested_attributes = $this->validate_attributes( $requested_attributes );
		$columns = empty( $requested_attributes ) ? $this->default_job_select : $requested_attributes;
		
		if ( $translated_columns = $this->query_translator->translate_columns( $columns, $this->column_rules ) )
		{
			$select = $translated_columns;
		}
		
		$query = $this->db->select( $select )
						->from( $this->table )
						->like( $this->column_rules['job_number']['column_name'], $id )
						->get();
		
		$row = $query->row_array();
		
		return ( isset( $row ) ) ? $this->factory->build( $row ) : NULL;
	}
	
	
	public function find_by_filter( $filter = [], $requested_attributes = [] )
	{
		if ( ! is_array( $filter ) )
		{
			return FALSE;	
		}
		
		$requested_attributes = $this->validate_attributes( $requested_attributes );
		$response = [];
		/*
		if ( $this->mock )
		{
			$result = $this->mockData;
			
			// Let's assume our factory is only supposed to make one at a time?
			foreach( $result as $row_array )
			{
				// translate array keys from the result so that it's properly useable for the entity?
				// for now, just lower case everything.
				// this is super ugly. ideally our query needs to just cast the names to what we want.
				foreach ( $row_array as $key => $value )
				{
					$row_array[ strtolower( $key ) ] = $value;
					unset( $row_array[ $key ] );
				}
				
				if ( $job = $this->factory->build( $row_array ) )
				{
					$response[] = $job;
				}
			}
			
			return $response;
		}
		*/
		
		
		
		// Get the translated select portion of the query.
		$select = [];
		$columns = empty( $requested_attributes ) ? $this->default_select : $requested_attributes;
		
		if ( $translated_columns = $this->query_translator->translate_columns( $columns, $this->column_rules ) )
		{
			$select = $translated_columns;
		}
		
		// translate parameters in advance... is this the best option?
		$this->_division = $this->column_rules['division']['column_name'];
		$this->_company_code = $this->column_rules['company_code']['column_name'];
		$this->_create_date = $this->column_rules['created_date']['column_name'];
		$this->_job_number = $this->column_rules['job_number']['column_name'];
		
		// Temporary quick filter.
		/*
		$query = $this->db->select( $select )
							->like( $this->_division, $filter['division'] )
							->where_in( $this->_company_code, 'MCC' )
							->limit( 10, 30 )
							->order_by( $this->_create_date, 'DESC' )
							->order_by( $this->_job_number, 'DESC' )
							->get_compiled_select( $this->table, FALSE );
		
		echo $query;
		*/
		
		
		// "dynamically" build the filter
		$query = $this->db->select( $select );
		
		$query = $this->build_filter( $query, $filter );
		
		
		
		$query->order_by( $this->_create_date, 'DESC' )
				->order_by( $this->_job_number, 'DESC' );
		
		$query = $this->db->get( $this->table );
		
		foreach ( $query->result_array() as $row_array )
		{
			//echo '<pre>'; print_r( $row_array ); echo '</pre>';
			
			/*
			foreach ( $row_array as $key => $value )
			{
				$row_array[ strtolower( $key ) ] = trim( $value );
				unset( $row_array[ $key ] );
			}
			*/
			
			//echo '<pre>'; print_r( $row_array ); echo '</pre>';
			
			if ( $job = $this->factory->build( $row_array ) )
			{
				$response[] = $job;	
			}
		}
		
		
		return $response;
	}
	
	
	public function count_filter_results( $filter = [] )
	{
		$query = $this->db->from( $this->table );
		$query = $this->build_filter( $query, $filter );
		
		return $query->count_all_results();
	}
	
	
	/*
	public function find_by_job_number( $job_number = NULL )
	{
		
	}
	*/
	
	
	
	
	
	private function create( $job_entity )
	{
		
	}
	
	
	private function update( $job_entity )
	{
		
	}
	
	
	
	protected function build_filter( $query = NULL, $filter = [] )
	{
		if( is_null( $query ) )
		{
			$query = $this->db;
		}
		
		$query->like( 'LTRIM( RTRIM( ' . $this->_job_number . ' ))', '_______', NULL, FALSE );
		
		
		if ( isset( $filter['division'] ) )
		{
			if ( is_string( $filter['division'] ) || is_int( $filter['division'] ) )
			{
				$query->like( $this->_division, $filter['division'] );
			}
			elseif ( is_array( $filter['division'] ) )
			{
				$query->group_start();
				
				foreach ( $filter['division'] as $value )
				{
					$query->or_like( $this->_division, $value );	
				}
					
				$query->group_end();
			}
		}
		
		if ( isset( $filter['company_code'] ) )
		{
			if ( is_string( $filter['company_code'] ) )
			{
				$query->where( $this->_company_code, $filter['company_code'] );
			}
			elseif ( is_array( $filter['company_code'] ) )
			{
				$query->where_in( $this->_company_code, $filter['company_code'] );
			}
		}
		
		
		if ( isset( $filter['limit'] ) )
		{
			if ( is_int( $filter['limit'] ) )
			{
				$query->limit( $filter['limit'] );	
			}
		}
		
		if ( isset( $filter['offset'] ) )
		{
			if ( is_int( $filter['offset'] ) )
			{
				$query->offset( $filter['offset'] );	
			}
		}
		
		
		if ( isset( $filter['pagination'] ) )
		{
			$per_page 		= $filter['pagination']['per_page'];
			$current_page 	= $filter['pagination']['current_page'];
			$offset			= $per_page * ( $current_page - 1 );
			
			$query->limit( $per_page, $offset );
		}
		//echo '<pre>'; print_r( $query ); echo '</pre>';
		return $query;
	}
	
	
	// --------------------------------------------------------------------

	/**
	 * Validates attributes against the allowed attributes.
	 *
	 * @param	array	$attributes 	attributes to validate against
	 * @return	array
	 */
	protected function validate_attributes( $attributes = [] )
	{
		is_array( $attributes ) || $attributes = [ $attributes ];
		
		$valid_attributes = [];
		
		foreach ( $attributes as $attribute ) 
		{
			$attribute = trim( $attribute );
			if ( in_array( $attribute, $this->allowed_fields ) )
			{
				$valid_attributes[] = $attribute;
			}
		}
		
		return $valid_attributes;
	}
}
