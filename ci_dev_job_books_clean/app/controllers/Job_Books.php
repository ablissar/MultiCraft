<?php 
/**
 * Job Books Controller
 * 
 * 
 * 
 * @package		Job Books
 * @author		Scott Benton
 * 
 */
//namespace App\Controllers\Job_Books;
//use App\Factories\Job_Books\Job_Factory;
use App\Models\Job_Books\Job_Books_Model;

defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Books extends MY_Controller 
{
	
	private $app_model;
	
	/**
	 * Class constructor
	 *
	 * @return 	void
	 */
	function __construct()
	{
		parent::__construct();
		
		//echo '<pre>'; print_r( get_declared_classes() ); echo '</pre>';
		$this->app_model = new Job_Books_Model();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Default page for the Job Books application.
	 * Show an overview listing of jobs based on filter criteria.
	 *
	 * @return 	void
	 */
	
	public function index( $current_page = 1 )
	{
		$current_page = intval( $current_page );
		$this->load->library( 'session' );
		$this->load->helper( 'form' );
		$this->load->library( 'form_builder' );
		$this->config->load( 'forms/job_books', TRUE );
		
		$data = [];
		
		$data['page_title'] = 'Job List';
		
		if ( ! is_int( $current_page ) || $current_page < 1 )
		{
			//$current_page = 1;	
		}
		
		
		
		if ( is_null( $this->session->job_books['search_filter'] ) || $this->input->post() )
		{
			$filter = $this->app_model->build_filter( $current_page );
			$_SESSION['job_books']['search_filter'] = $filter;
		}
		else
		{
			$filter = $this->session->job_books['search_filter'];
			$filter['pagination']['current_page'] = $current_page;
		}
		
		
		// search form
		// !!!!! refactor this entire section later.
		$data['form']['form_open'] = form_open( 'job_books/' . ( $current_page > 1 ? 'page/' . $current_page : '' ), [ 'method' => 'post', 'class' => 'inline-form' ] );
		
		// Build up the form data.
		$form_components = $this->config->item( 'search_filter', 'forms/job_books' );
		
		foreach ( $form_components as $name => $component )
		{
			$input 			= isset( $component['input'] ) 	? $component['input'] 	: NULL;
			$label 			= isset( $component['label'] ) 	? $component['label'] 	: NULL;
			$input_type 		= isset( $input['type'] ) 		? $input['type'] 		: NULL;
			$input_options 	= isset( $input['options'] ) 	? $input['options'] 		: NULL;
			$label_text 		= isset( $label['text'] ) 		? $label['text'] 		: FALSE;
			$label_options 	= isset( $label['attributes'] ) 	? $label['attributes'] 	: NULL;
			
			if ( ! is_null( $input ) )
			{
				if ( $input_type === 'checkbox' || $input_type === 'radio' )
				{
					$set_function 	= 'set_' . $input_type;
					$default 		= isset( $input_options['checked'] ) ? $input_options['checked'] : FALSE;
					$value			= isset( $input_options['value'] ) ? $input_options['value'] : '';
					$input_options['checked'] = $set_function( $input_options['name'], $value, $default );
				}
				elseif ( $input_type === 'dropdown' || $input_type === 'multiselect' )
				{
					$default = isset( $input_options['selected'] ) ? $input_options['selected'] : '';
					
					if ( isset( $filter[ $name ] ) )
					{
						$default = $filter[ $name ];
					}
					
					$input_options['selected'] = set_value( $input_options['name'], $default );
					// Optionally add code here to populate the options parameter from a config file or something?
				}
				else
				{
					$default = isset( $input_options['value'] ) ? $input_options['value'] : '';
					$input_options['value'] = set_value( $input_options['name'], $default );
				}
			}
			
			$data['form'][ $name ] = $this->form_builder->build_component( $input_type, $input_options, $label_text, $label_options );
			//echo $data['form'][ $name ] . '<br />';
		}
		
		
		$data['form']['submit_button'] = form_button( [ 'name' => 'update_search_filter', 'type' => 'submit', 'content' => 'Update Filter', 'class' => 'button-small' ] );
		$data['form']['form_close'] = form_close();
		$data['form']['show_advanced_search_button'] = form_button( [ 'name' => 'show_advanced_search_options', 'type' => 'button', 'content' => 'Show Advanced Options', 'class' => 'button-text' ] );
		
		
		// advanced search form
		$advanced_search_components = $this->config->item( 'advanced_search_filter', 'forms/job_books' );
		
		foreach ( $advanced_search_components as $name => $component )
		{
			$input 			= isset( $component['input'] ) 	? $component['input'] 	: NULL;
			$label 			= isset( $component['label'] ) 	? $component['label'] 	: NULL;
			$input_type 		= isset( $input['type'] ) 		? $input['type'] 		: NULL;
			$input_options 	= isset( $input['options'] ) 	? $input['options'] 		: NULL;
			$label_text 		= isset( $label['text'] ) 		? $label['text'] 		: FALSE;
			$label_options 	= isset( $label['attributes'] ) 	? $label['attributes'] 	: NULL;
			
			if ( ! is_null( $input ) )
			{
				if ( $input_type === 'checkbox' || $input_type === 'radio' )
				{
					$set_function 	= 'set_' . $input_type;
					$default 		= isset( $input_options['checked'] ) ? $input_options['checked'] : FALSE;
					$value			= isset( $input_options['value'] ) ? $input_options['value'] : '';
					$input_options['checked'] = $set_function( $input_options['name'], $value, $default );
				}
				elseif ( $input_type === 'dropdown' || $input_type === 'multiselect' )
				{
					$default = isset( $input_options['selected'] ) ? $input_options['selected'] : '';
					
					if ( isset( $filter[ $name ] ) )
					{
						$default = $filter[ $name ];
					}
					
					$input_options['selected'] = set_value( $input_options['name'], $default );
					// Optionally add code here to populate the options parameter from a config file or something?
				}
				else
				{
					$default = isset( $input_options['value'] ) ? $input_options['value'] : '';
					$input_options['value'] = set_value( $input_options['name'], $default );
				}
			}
			
			$data['advanced_search_form'][ $name ] = $this->form_builder->build_component( $input_type, $input_options, $label_text, $label_options );
		}
		
		$data['advanced_search_form']['company_code'] = form_label( 'Company Code' );
		$data['advanced_search_form']['job_type'] = form_label( 'Job Type' );
		$data['advanced_search_form']['job_status'] = form_label( 'Status' );
		$data['advanced_search_form']['tax_code'] = form_label( 'Tax Code' );
		$data['advanced_search_form']['division'] = form_label( 'Division' );
		
		
		$data['advanced_search_form']['form_open'] = form_open( 'job_books/' . ( $current_page > 1 ? 'page/' . $current_page : '' ), [ 'method' => 'post', 'class' => '', 'name' => 'advanced_search_filter' ] );
		$data['advanced_search_form']['submit_button'] = form_button( [ 'name' => 'update_advanced_search_filter', 'type' => 'submit', 'content' => 'Update Filter', 'class' => 'button-small' ] );
		$data['advanced_search_form']['form_close'] = form_close();
		
		
		
		
		$this->load->library( 'pagination' );
		
		$pagination_config = [];
		$pagination_config['base_url'] = '/job_books/page/';
		$pagination_config['first_url'] = $pagination_config['base_url'] . '1';
		$pagination_config['cur_tag_open'] = '<a href="" class="pagination-active">';
		$pagination_config['cur_tag_close'] = '</a>';
		$pagination_config['prev_link'] = '&larr; Prev';
		$pagination_config['next_link'] = 'Next &rarr;';
		
		// Rows per page
		$pagination_config['per_page'] = $filter['pagination']['per_page'];
		
		
		
		// Retrieve the job objects that matches the parameters.
		$job_list = $this->app_model->get_job_list( $filter );
		$total_rows = $this->app_model->get_job_list_row_count( $filter );
		$pagination_config['total_rows'] = $total_rows;
		//echo '<pre>'; print_r( $job_list ); echo '</pre>';
		
		$pagination_offset_start 	= ( $current_page - 1 ) * $pagination_config['per_page'] + 1;
		//$pagination_offset_start 	= ( is_int( $current_page ) && $current_page > 1 ) ? ( $current_page - 1 ) * $pagination_config['per_page'] : 1;
		$pagination_offset_end		= $pagination_offset_start + ( $pagination_config['per_page'] - 1 );
		
		if ( $pagination_offset_end > $total_rows )
		{
			$pagination_offset_end = $total_rows;	
		}
		
		$data['pagination_results_display'] = 'Showing ' . $pagination_offset_start . ' to ' . $pagination_offset_end . ' of ' . $total_rows . ' results.';
		
		// temporary variable for testing purposes.
		$parameters_to_show = [ 
			'job_number' => 'Job #', 
			'short_description' => 'Description', 
			'customer_code' => 'Customer Code', 
			'status' => 'Status',
			'tax_classification_code' => 'Tax Code',
			'created_date' => 'Created'
		];
		
		$heading = [];
		
		foreach ( $parameters_to_show as $key => $value )
		{
			$heading[] = [
				'data' 	=> $value,
				'class' => $key,
			];	
		}
		
		$this->load->library( 'table' );
		$this->table->set_template( [
			'table_open' => '<table class="job_list striped bordered-horizontal">'
		] );
		$this->table->set_heading( $heading );
		// Build the table results?
		$table_data = [];
		
		foreach ( $job_list as $job )
		{
			$row = [];
			
			foreach ( array_keys( $parameters_to_show ) as $attribute )
			{
				$content = $job->$attribute;
				
				if ( $attribute === 'job_number' )
				{
					$content = anchor( 'job_books/job/' . $content, $content );
				}
				
				if ( $attribute === 'created_date' )
				{
					$content = $job->$attribute( 'm/d/Y H:i A' );
				}
				
				$row[] = [
					'data' => $content,
					'class' => $attribute
				];
			}
			
			$this->table->add_row( $row );
		}
		
		$this->pagination->initialize( $pagination_config );
		$data['pagination'] = $this->pagination->create_links();
		
		
		
		/*
		$this->load->library( 'parser' );
		$this->parser->parse( 'templates/job_books/job_list', $data );
		*/
		
		$data['job_list_table'] = $this->table->generate();
		$data['create_new_job'] = anchor( 'job_books/create', 'Create New Job', [ 'class' => 'button' ] );
		//echo $this->table->generate();
		
		
		$this->load->view( '_blocks/_header', $data );
		$this->load->view( 'job_books/job_list', $data );
		
		
		
		
		//echo $this->pagination->create_links();
		
		
		//echo anchor( 'job_books/create', 'Create New Job' );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Display the detailed job information.
	 * 
	 * @param	string	$job_number		Job Number
	 * @return 	void
	 */
	
	public function job( $job_number = NULL )
	{
		// If no parameter provided, redirect back to index page.
		( ! empty( $job_number ) ) || redirect( '/job_books/' );
		
		$this->load->library( 'session' );
		$this->load->helper( 'form' );
		$this->load->library( 'form_builder' );
		$this->config->load( 'forms/job_books', TRUE );
		
		$data = [];
		$data['body_class'] = 'body-bg';
		$data['job_list_anchor'] = anchor( 'job_books/', '&larr; Return to Job List' );
		
		
		// Retrieve the permissions for the user accessing the page.
		
		
		// Retrieve the job object that matches the parameter.
		if ( $job = $this->app_model->get_job( $job_number ) )
		{
			// Check for form submission.
			if ( $this->input->post() )
			{
				$form_method = '';
				// Determine which form was being submitted?
				if ( $this->input->post( 'update_tax_code' ) )
				{
					$form_method = 'update_tax_code';
				}
				
				if ( $this->input->post( 'create_phases' ) )
				{
					$form_method = 'create_phases';
				}
				
				if ( method_exists( $this->app_model, $form_method ) )
				{
					$response = $this->app_model->$form_method();
					
					if ( $response->status === TRUE )
					{
						$success_message 	= isset( $response->success_message ) ? $response->success_message : NULL;
					
						// Set the flashdata?
						if ( is_string( $success_message ) && ! empty( $success_message ) )
						{
							$this->session->set_flashdata( 'success_message', $response->success_message );
						}
						
						// Reload the view to retrieve fresh data and prevent form resubmission.
						redirect( 'job_books/job/' . $job->job_number );
					}
					else
					{
						$error_message	= isset( $response->error_message ) ? $response->error_message : NULL;
						
						
						// Do we want the error message in flash data if we're only going to display it on this page load?
						// It will persist when you reload the page because accessing it when you define it doesn't count as a request.
						// So, probably not...
						
						// Set the flashdata?
						if ( is_string( $error_message ) && ! empty( $error_message ) )
						{
							$this->session->set_flashdata( 'error_message', $response->error_message );
						}
					}
				}
			}
			
			
			// Start populating values into the $data array.
			// Use permissions where needed to determine results?
			
			$data['job_number'] = $job->job_number;
			$data['description'] = $job->description;
			$data['short_description'] = $job->short_description;
			$data['job_status'] = $job->status;
			$data['customer'] = $job->customer_name;
			$data['address_1'] = $job->address_1;
			$data['address_2'] = $job->address_2;
			$data['city'] = $job->city;
			$data['state'] = $job->state;
			$data['zip_code'] = $job->zip_code;
			$data['superintendent'] = $job->superintendent_name;
			$data['project_manager'] = $job->project_manager_name;
			$data['estimator'] = $job->estimator_name;
						
			$data['company_code'] = $job->company_code;
			$data['division'] = $job->division;
			$data['job_type'] = $job->job_type;
			$data['original_contract_amount'] = $job->original_contract_amount;
			$data['customer_code'] = $job->customer_code;
			$data['contract_number'] = $job->contract_number;
			$data['tax_classification_code'] = $job->tax_classification_code; // Look at changing functionality of this. NULL if not set instead?
			$data['created_date'] = $job->created_date;
			
			
			// Tax Code Permissions? 
			$show_tax_code_form = FALSE;
			$tax_code_permissions = TRUE; // Placeholder functionality for permissions.
			if ( $tax_code_permissions && $job->tax_classification_code === '---' ) 
			{
				$show_tax_code_form = TRUE;
			}
			
			
			// Phase Table
			$parameters_to_show = [
				'phase_code' 	=> 'Phase Code',
				'cost_type' 		=> 'Cost Type',
				'status'			=> 'Status',
				'description' 	=> 'Description'
			];
			
			$heading = [];
		
			foreach ( $parameters_to_show as $key => $value )
			{
				$heading[] = [
					'data' 	=> $value,
					'class' => $key,
				];	
			}
			
			$this->load->library( 'table' );
			$this->table->set_template( [
				'table_open' => '<table class="phase_list striped bordered-horizontal">'
			] );
			$this->table->set_heading( $heading );
			// Build the table results?
			$table_data = [];
			
			foreach ( $job->phases->get_phases() as $phase )
			{
				$row = [];
			
				foreach ( array_keys( $parameters_to_show ) as $attribute )
				{
					$content = $phase->$attribute;
					
					
					if ( $attribute === 'created_date' )
					{
						$content = $job->$attribute( 'm/d/Y H:i A' );
					}
					
					$row[] = [
						'data' => $content,
						'class' => $attribute
					];
				}
				
				$this->table->add_row( $row );
			}
			
			$data['phase_table'] = $this->table->generate();
			$data['create_phase_button'] = form_button( [ 'name' => 'show_phase_form', 'type' => 'button', 'content' => 'Add New Phases' ] );
			
			
			
			// Tax Code Section 
			if ( $show_tax_code_form )
			{
				// Add Tax Code Button
				$data['tax_code_form']['show_form_button'] = form_button( [ 'name' => 'show_tax_form', 'type' => 'button', 'content' => '&plus; Add Tax Code', 'class' => 'button-block' ] );
				
				// Tax Code Form
				$data['tax_code_form']['form_open'] = form_open( 'job_books/job/' . $job->job_number, [ 'method' => 'post', 'class' => '', 'name' => 'add_tax_form' ] );
				$data['tax_code_form']['taxable'] = form_label( 'Taxable' );
			
				// Build up the form data.
				$form_components = $this->config->item( 'tax_code', 'forms/job_books' );
				
				if ( $job->status_code !== 'I' )
				{
					unset( $form_components['activate_job'] );	
				}
				
				foreach ( $form_components as $name => $component )
				{
					
					$input 			= isset( $component['input'] ) 	? $component['input'] 	: NULL;
					$label 			= isset( $component['label'] ) 	? $component['label'] 	: NULL;
					$input_type 	= isset( $input['type'] ) 		? $input['type'] 		: NULL;
					$input_options 	= isset( $input['options'] ) 	? $input['options'] 		: NULL;
					$label_text 	= isset( $label['text'] ) 		? $label['text'] 		: FALSE;
					$label_options 	= isset( $label['attributes'] ) 	? $label['attributes'] 	: NULL;
					
					if ( ! is_null( $input ) )
					{
						if ( $input_type === 'checkbox' || $input_type === 'radio' )
						{
							$set_function 	= 'set_' . $input_type;
							$default 		= isset( $input_options['checked'] ) ? $input_options['checked'] : FALSE;
							$value			= isset( $input_options['value'] ) ? $input_options['value'] : '';
							$input_options['checked'] = $set_function( $input_options['name'], $value, $default );
						}
						elseif ( $input_type === 'dropdown' || $input_type === 'multiselect' )
						{
							$default = isset( $input_options['selected'] ) ? $input_options['selected'] : '';
							$input_options['selected'] = set_value( $input_options['name'], $default );
							// Optionally add code here to populate the options parameter from a config file or something?
						}
						else
						{
							$default = isset( $input_options['value'] ) ? $input_options['value'] : '';
							$input_options['value'] = set_value( $input_options['name'], $default );
						}
					}
					
					$data['tax_code_form'][ $name ] = $this->form_builder->build_component( $input_type, $input_options, $label_text, $label_options );
					//echo $data['form'][ $name ] . '<br />';
				}
				
				
				$data['tax_code_form']['submit_button'] = form_button( [ 'name' => 'update_tax_code', 'type' => 'submit', 'value' => TRUE, 'content' => 'Update Job', 'class' => 'button-block' ] );
				$data['tax_code_form']['close_button'] = form_button( [ 'name' => 'close_tax_form', 'type' => 'button', 'content' => 'Cancel', 'class' => 'button-block' ] );
				$data['tax_code_form']['form_close'] = form_close();
			}
			
			
			
			
			
			// Phase Creation Form
			$data['create_phases_form']['form_open'] = form_open( 'job_books/job/' . $job->job_number, [ 'method' => 'post', 'name' => 'add_phase_form', 'class' => 'hidden' ] );
			$data['create_phases_form']['phase_setup'] = form_label( 'Phases / Cost Types' );
		
			// Build up the form data.
			$form_components = $this->config->item( 'create_phases', 'forms/job_books' );
			
			foreach ( $form_components as $name => $component )
			{
				
				$input 			= isset( $component['input'] ) 	? $component['input'] 	: NULL;
				$label 			= isset( $component['label'] ) 	? $component['label'] 	: NULL;
				$input_type 		= isset( $input['type'] ) 		? $input['type'] 		: NULL;
				$input_options 	= isset( $input['options'] ) 	? $input['options'] 		: NULL;
				$label_text 		= isset( $label['text'] ) 		? $label['text'] 		: FALSE;
				$label_options 	= isset( $label['attributes'] ) 	? $label['attributes'] 	: NULL;
				
				if ( $name === 'division' )
				{
					$input_options['selected'] = $job->division;
				}
				
				if ( ! is_null( $input ) )
				{
					if ( $input_type === 'checkbox' || $input_type === 'radio' )
					{
						$set_function 	= 'set_' . $input_type;
						$default 		= isset( $input_options['checked'] ) ? $input_options['checked'] : FALSE;
						$value			= isset( $input_options['value'] ) ? $input_options['value'] : '';
						$input_options['checked'] = $set_function( $input_options['name'], $value, $default );
					}
					elseif ( $input_type === 'dropdown' || $input_type === 'multiselect' )
					{
						$default = isset( $input_options['selected'] ) ? $input_options['selected'] : '';
						$input_options['selected'] = set_value( $input_options['name'], $default );
						// Optionally add code here to populate the options parameter from a config file or something?
					}
					else
					{
						$default = isset( $input_options['value'] ) ? $input_options['value'] : '';
						$input_options['value'] = set_value( $input_options['name'], $default );
					}
				}
				
				$data['create_phases_form'][ $name ] = $this->form_builder->build_component( $input_type, $input_options, $label_text, $label_options );
				//echo $data['form'][ $name ] . '<br />';
			}
			
			// hard coding this to add a prefix...
			$data['create_phases_form']['phase_group_code_label'] = form_label( $form_components['phase_group_code_label']['label']['text'], $form_components['phase_group_code_label']['label']['attributes']['for'], $form_components['phase_group_code_label']['label']['attributes']['for'] );
			$data['create_phases_form']['phase_input_prefix_value'] = $job->division;
			
			$data['create_phases_form']['submit_button'] = form_button( [ 'name' => 'create_phases', 'type' => 'submit', 'value' => TRUE, 'content' => 'Create Phases' ] );
			$data['create_phases_form']['close_button'] = form_button( [ 'name' => 'close_phase_form', 'type' => 'button', 'content' => 'Cancel', 'class' => '' ] );
			$data['create_phases_form']['form_close'] = form_close();
			
			
			
			//echo '<pre>'; print_r( $data['form'] ); echo '</pre>';
			//echo $this->session->flashdata( 'error_message' );
			
			
			
			
		}
		else
		{
			echo 'No data found for Job Number: ' . $job_number . '.';
		}
		
		/*
		foreach ( $data['tax_code_form'] as $key => $value )
		{
			echo $value . '<br />';	
		}
		
		echo $this->table->generate();
		
		foreach ( $data['create_phases_form'] as $key => $value )
		{
			echo $value . '<br />';	
		}
		*/
		
		$this->load->view( '_blocks/_header', $data );
		$this->load->view( 'job_books/job_details', $data );
	}
	 
	// --------------------------------------------------------------------
	
	/**
	 * Show the job creation form and redirect to job view after creating
	 * a new job.
	 * 
	 * @return 	void
	 */
	
	public function create()
	{
		$this->load->library( 'session' );
		$this->load->helper( [ 'form', 'state' ] );
		$this->load->library( 'form_builder' );
		$this->config->load( 'forms/job_books', TRUE );
		
		// Check for form submission.
		if ( $this->input->post() )
		{
			$response = $this->app_model->create_job();
			
			if ( is_object( $response ) && isset( $response->status ) )
			{
				if ( $response->status === TRUE )
				{
					$success_message 	= isset( $response->success_message ) ? $response->success_message : NULL;
					$job_number			= isset( $response->job_number ) ? $response->job_number : '';
					
					// Set the flashdata?
					if ( is_string( $success_message ) && ! empty( $success_message ) )
					{
						$this->session->set_flashdata( 'success_message', $response->success_message );
					}
					
					// Redirect to job view of the newly created job.
					if ( is_string( $job_number ) )
					{
						redirect( 'job_books/job/' . $job_number );
					}
				}
				else
				{
					$error_message	= isset( $response->error_message ) ? $response->error_message : NULL;
					
					
					// Do we want the error message in flash data if we're only going to display it on this page load?
					// It will persist when you reload the page because accessing it when you define it doesn't count as a request.
					// So, probably not...
					
					// Set the flashdata?
					if ( is_string( $error_message ) && ! empty( $error_message ) )
					{
						$this->session->set_flashdata( 'error_message', $response->error_message );
					}
				}
			}
		}
		
		$data = [];
		$data['job_list_anchor'] = anchor( 'job_books/', '&larr; Return to Job List' );
		$data['form']['job_type'] = form_label( 'Job Type' );
		$data['form']['form_open'] = form_open( 'job_books/create', [ 'method' => 'post', 'novalidate' => 'novalidate' ] );
		
		if ( $message = $this->session->flashdata( 'error_message' ) )
		{
			$data['notification_message'] = '<div class="error_message">' . $message . '</div>';
		}
		
		// Build up the form data.
		$form_components = $this->config->item( 'create_job', 'forms/job_books' );
		
		foreach ( $form_components as $name => $component )
		{
			$input 			= isset( $component['input'] ) 	? $component['input'] 	: NULL;
			$label 			= isset( $component['label'] ) 	? $component['label'] 	: NULL;
			$input_type 		= isset( $input['type'] ) 		? $input['type'] 		: NULL;
			$input_options 	= isset( $input['options'] ) 	? $input['options'] 		: NULL;
			$label_text 		= isset( $label['text'] ) 		? $label['text'] 		: FALSE;
			$label_options 	= isset( $label['attributes'] ) 	? $label['attributes'] 	: NULL;
			$inline_errors	= TRUE;
			
			if ( ! is_null( $input ) )
			{
				if ( $input_type === 'checkbox' || $input_type === 'radio' )
				{
					$set_function 	= 'set_' . $input_type;
					$default 		= isset( $input_options['checked'] ) ? $input_options['checked'] : FALSE;
					$value			= isset( $input_options['value'] ) ? $input_options['value'] : '';

					$input_options['checked'] = $set_function( $input_options['name'], $value, $default );
				}
				elseif ( $input_type === 'dropdown' || $input_type === 'multiselect' )
				{
					$default = isset( $input_options['selected'] ) ? $input_options['selected'] : '';
					$input_options['selected'] = set_value( $input_options['name'], $default );
					// Optionally add code here to populate the options parameter from a config file or something?
				}
				else
				{
					$default = isset( $input_options['value'] ) ? $input_options['value'] : '';
					$input_options['value'] = set_value( $input_options['name'], $default, FALSE );
				}
			}
			
			$data['form'][ $name ] = $this->form_builder->build_component( $input_type, $input_options, $label_text, $label_options );
		}
		
		
		// !! only doing this here for demo purposes.	
		$data['customer_address_toggle_button'] = form_button( [ 'name' => 'customer_location_toggle', 'content' => '&darr;', 'class' => 'button-text' ] );
		$customer_address_options = [];
		$customer_address_options[] = [
			'address_1' => 'Multi-Craft Contractors, Inc.',
			'address_2' => '2300 North Lowell Road',
			'city' 		=> 'Springdale',
			'state'		=> 'AR',
			'zipcode'	=> '72765'
		];
		
		foreach ( $customer_address_options as $key => $address_option )
		{
			$input = form_radio( [ 'name' => 'customer_location_address', 'value' => $key, 'class' => '' ] );
			$address = '<section class="address">';
			$address .= '<p class="address_1">' . $address_option['address_1'] . '</p>';
			$address .= '<p class="address_2">' . $address_option['address_2'] . '</p>';
			$address .= '<p><span class="city">' . $address_option['city'] . '</span>, <span class="state">' . $address_option['state'] . '</span> <span class="zip_code">' . $address_option['zipcode'] . '</span></p>';
			$address .= '</section>';
			$label = form_label( $input . $address, '', [ 'class' => 'card flex-container flex-vertical-center' ] ); 
			
			$data['form']['customer_location_options'][ $key ] = $label;
		}
		
		$data['form']['submit_button'] = form_button( [ 'name' => 'create_job', 'type' => 'submit', 'content' => 'Create Job' ] );
		$data['form']['form_close'] = form_close();
		
		
		
		$this->load->view( '_blocks/_header', $data );
		$this->load->view( 'job_books/job_create', $data );
	}
}
