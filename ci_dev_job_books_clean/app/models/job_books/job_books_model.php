<?php
/**
 * Job Books Model
 * 
 * Main business logic model for the Job Books application.
 * 
 * @package		Job Books
 * @author		Scott Benton
 * 
 */
namespace App\Models\Job_Books;

defined('BASEPATH') OR exit('No direct script access allowed');

//use App\Factories\Job_Books\Job_Factory;
//use App\Models\Job_Books

class Job_books_model extends \MY_Model 
{
	
	protected $job_factory;
	protected $job_model;
	
	protected $phase_factory;
	protected $phase_model;
	protected $phase_repository = '\App\Repositories\Phase_Repository';
	
	protected $customer_model;
	protected $employee_model;
	
	private $mock_job_data = [
		
	];
	
	
	private $default_filter = [
		'company_code' 	=> 'mcc',
		'division'		=> 77,
		'pagination'		=> [
			'per_page'		=> 10,
			'current_page'	=> 1
		]
	];
	
	
	/**
	 * Class constructor
	 *
	 * Initialize our factories and models?
	 * 
	 * @return 	void
	 */
	function __construct()
	{
		$this->job_factory = new \App\Factories\Job_Books\Job_Factory();
		$this->job_model = new Job_Model( $this->job_factory );
		
		$this->phase_factory = new \App\Factories\Job_Books\Phase_Factory();
		$this->phase_model = new Phase_Model( $this->phase_factory );
		
		$this->customer_model = new Customer_Model();
		$this->employee_model = new Employee_Model();
		
		parent::__construct();
	}
	
	
	
	
	/**
	 * 
	 *
	 * @return 	object[]	Array of objects.
	 */
	public function get_job_list( $filter = [] )
	{
		
		$attributes = [
			'job_number',
			'short_description',
			'customer_code',
			'status_code',
			'tax_classification_code',
			'created_date'
		];
		
		$job_list = $this->job_model->find_by_filter( $filter, $attributes );
		
		
		$this->job_model->count_filter_results( $filter );
		
		
		return $job_list;
	}
	
	public function get_job_list_row_count( $filter = [] )
	{
		return $this->job_model->count_filter_results( $filter );
	}
	
	
	/**
	 * 
	 * @param	string	$job_number	
	 * @return	object
	 */
	public function get_job( $job_number = NULL )
	{
		if ( empty( $job_number ) ) return NULL;
		
		
		
		// Create an object with mock data.
		//$job = $this->job_factory->build( [ 'job_number' => $job_number ] );
		//return $job;
		
		
		
		
		// Build the job object based on the criteria provided.
		$job = $this->job_model->find( $job_number );
		
		
		
		
		
		// TEMP: get the customer name? + employee data
		if ( $customer_name = $this->customer_model->get_customer_name_by_id( $job->customer_code, $job->company_code ) )
		{
			$job->customer_name = $customer_name;
		}
		
		if ( $employee_name = $this->employee_model->get_employee_name_by_code( $job->superintendent, $job->company_code ) )
		{
			$job->superintendent_name = $employee_name;
		}
		
		if ( $employee_name = $this->employee_model->get_employee_name_by_code( $job->estimator, $job->company_code ) )
		{
			$job->estimator_name = $employee_name;
		}
		
		if ( $employee_name = $this->employee_model->get_employee_name_by_code( $job->project_manager, $job->company_code ) )
		{
			$job->project_manager_name = $employee_name;
		}
		
		
		
		
		
		// Retrieve the phase data.
		$filter = [
			'company_code' 	=> $job->company_code,
			'job_number'		=> $job->job_number
		];
		$result = $this->phase_model->find_by_filter( $filter );
		
		// Add phase data to job object.
		foreach ( $result as $phase )
		{
			$job->phases->add( $phase );	
		}
		
		$job->phases->sort_by( [ 'phase_group' => 'ascending', 'division' => 'ascending', 'cost_type' => 'ascending' ] );
		
		//echo '<pre>'; print_r( $job ); echo '</pre>';
		
		
		
		
		// Return job object.
		return $job;
		
	}
	
	
	/**
	 * Create a new job in Spectrum via SOAP, acccording to
	 * user form input.
	 *
	 * @param	object	$user	the user object being utilized to create the job.
	 * @return 	object			a generic response object
	 */
	public function create_job( $user = NULL )
	{
		$this->load->library( 'form_validation' );
		$this->load->helper( 'state' );
		$this->load->config( 'job_books/form_validation', TRUE );
		
		// Define the validation rules, probably from the config file.
		$validation_rules = $this->config->item( 'create_job', 'job_books/form_validation' );
		
		// for testing purposes only.
		/*
		$validation_rules = [
			[
				'field' => 'job_type',
				'label' => 'Job Type',
				'rules' => 'required'
			]
		];
		*/
		$this->form_validation->set_rules( $validation_rules );
		
		// For now, just make it a generic object.
		// Revisit this with maybe a more defined "Response" value entity.
		$response = new \stdClass( [
			'status' 			=> NULL,
			'error_message'		=> NULL,
			'success_message'	=> NULL,
			'job_number'			=> NULL
		] );
		
		// Does the form validation pass?
		if ( $this->form_validation->run() )
		{
			
			// If our form validation is complete and the data is accurate...
			// then we need to try and build a SOAP request to insert it into Spectrum.
			
			
			// Then we will also need to build each SOAP request to insert each Cost Type one at a time...
			
			
			
			
			$response->status			= TRUE;
			$response->success_message	= 'Our validation ran successfully, but for testing purposes we did not attempt to insert into Spectrum.';
			//$response->success_message	= '';
		}
		else
		{
			$response->status 			= FALSE;
			$response->error_message 	= 'Form validation failed.';
			
			//echo validation_errors();
		}
		
		return $response;
	}
	
	
	
	public function update_tax_code( $user = NULL, $job = NULL )
	{
		$this->load->library( 'form_validation' );
		
		// Define the validation rules, probably from the config file.
		//$validation_rules = [];
		
		// for testing purposes only.
		$validation_rules = [
			[
				'field' => 'tax_code',
				'label' => 'Tax Classification Code',
				'rules' => 'trim|required'
			]
		];
		$this->form_validation->set_rules( $validation_rules );
		
		// For now, just make it a generic object.
		// Revisit this with maybe a more defined "Response" value entity.
		$response = new \stdClass( [
			'status' 			=> NULL,
			'error_message'		=> NULL,
			'success_message'	=> NULL
		] );
		
		// Does the form validation pass?
		if ( $this->form_validation->run() )
		{
			
			
			// If our form validation is complete and the data is accurate...
			// then we need to try and build a SOAP request to update the changes in Spectrum.
			
			
			
			
			$response->status			= TRUE;
			$response->success_message	= 'Our validation ran successfully, but for testing purposes we did not attempt to insert into Spectrum.';
			//$response->success_message	= '';
		}
		else
		{
			$response->status 			= FALSE;
			$response->error_message 	= 'Form validation failed.';
		}
		
		return $response;
	}
	
	
	
	public function create_phases( $user = NULL, $job = NULL )
	{
		$this->load->library( 'form_validation' );
		
		// Define the validation rules, probably from the config file.
		//$validation_rules = [];
		
		// for testing purposes only.
		$validation_rules = [
			[
				'field' => 'phase_group_code',
				'label' => 'Phase Group Code',
				'rules' => 'required'
			]
		];
		$this->form_validation->set_rules( $validation_rules );
		
		// For now, just make it a generic object.
		// Revisit this with maybe a more defined "Response" value entity.
		$response = new \stdClass( [
			'status' 			=> NULL,
			'error_message'		=> NULL,
			'success_message'	=> NULL
		] );
		
		// Does the form validation pass?
		if ( $this->form_validation->run() )
		{
			
			
			// If our form validation is complete and the data is accurate...
			// then we need to try and build each SOAP request to insert each Phase one at a time...
			
			
			
			
			
			$response->status			= TRUE;
			$response->success_message	= 'Our validation ran successfully, but for testing purposes we did not attempt to insert into Spectrum.';
			//$response->success_message	= '';
		}
		else
		{
			$response->status 			= FALSE;
			$response->error_message 	= 'Form validation failed.';
		}
		
		return $response;
	}
	
	
	/**
	 * Build up a filter array.
	 *
	 * @param	int		$current_page	current page being viewed
	 * @param	object	$user			user object containing preferences, maybe?
	 * @return 	array			
	 */
	public function build_filter( $current_page = 1, $user = NULL )
	{
		if ( is_string( $current_page ) && is_numeric( $current_page ) )
		{
			$current_page = intval( $current_page );	
		}
		
		// Assign filter to the default filter.
		$filter = $this->default_filter;
		
		// Update the current page from the default filter.
		$filter['pagination']['current_page'] = ( is_int( $current_page ) && $current_page > 0 ) ? $current_page : 1;
		
		// Placeholder for potentially adjusting defaults based off of user preferences.
		if ( is_object( $user ) )
		{
			
		}
		
		// Form validation stuff.
		if ( $this->input->post() )
		{
			$this->load->library( 'form_validation' );
			$validation_rules = [
				[
					'field' => 'company_code',
					'label' => 'Company Code',
					'rules' => 'required|in_list[mcc,mcs]'
				],
				[
					'field' => 'division',
					'label' => 'Department',
					'rules' => 'required|exact_length[2]|integer'
				],
				[
					'field' => 'per_page',
					'label' => 'Results Per Page',
					'rules' => 'integer'
				]
			];
			$this->form_validation->set_rules( $validation_rules );
			
			if ( $this->form_validation->run() )
			{
				if ( ! is_null( $this->input->post( 'division' ) ) )
				{
					$filter['division'] = $this->input->post( 'division' );
				}
				
				if ( ! is_null( $this->input->post( 'company_code' ) ) )
				{
					$filter['company_code'] = $this->input->post( 'company_code' );
				}
				
				if ( ! is_null( $this->input->post( 'per_page' ) ) )
				{
					$filter['pagination']['per_page'] = $this->input->post( 'per_page' );
				}
			}
			
			// Do we need to indicate some kind of error if they don't run?
		}
		
		
		return $filter;
	}
	
	
}
