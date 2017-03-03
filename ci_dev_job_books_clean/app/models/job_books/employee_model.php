<?php
/**
 * Employee Model
 * 
 * 
 * 
 * @package		Job Books
 * @author		Scott Benton
 * 
 */
namespace App\Models\Job_Books;

defined('BASEPATH') OR exit('No direct script access allowed');

//use App\Factories\Job_Books\Job_Factory;
//use App\Models\Job_Books

class Employee_model extends \MY_Model 
{
	protected $table = '';
	protected $allowed_fields = [
		'company_code',
		'employee_code',
		'employee_name',
		'first_name',
		'middle_name',
		'last_name'
	];
	
	protected $default_select = [
		'employee_name',
		'first_name',
		'middle_name',
		'last_name'
	];
	
	/**
	 * Are we running in mock mode? 
	 * If so, fake database results.
	 * @var boolean
	 */
	protected $mock = FALSE;
	
	function __construct(  )
	{
		parent::__construct();
		
		//$this->factory = $factory;
		
		// If not running in production, nothing further to do.
		//$this->mock = ENVIRONMENT != 'production';
		if ( $this->mock )
		{
			return;
		}
		
		$this->load->config( 'spectrum', TRUE );
		$this->column_rules = $this->config->item( 'employee_columns', 'spectrum' );
		$this->load->library( 'query_translator' );
		$this->load->database( 'spectrum' );
	}
	
	
	
	// temporary function (probably?) for pulling the customer name from an employee code
	public function get_employee_name_by_code( $employee_code = '', $company_code = 'mcc' )
	{
		$employee_name = NULL;

		if ( ! empty( $employee_code ) )
		{
			$select = [];
			$requested_attributes = $this->validate_attributes( [ $employee_code, $company_code ] );
			$columns = empty( $requested_attributes ) ? $this->default_select : $requested_attributes;
			
			if ( $translated_columns = $this->query_translator->translate_columns( $columns, $this->column_rules ) )
			{
				$select = $translated_columns;
			}
			
			$query = $this->db->select( $select )
							->from( $this->table )
							->like( $this->column_rules['employee_code']['column_name'], $employee_code )
							->where( $this->column_rules['company_code']['column_name'], $company_code )
							->get();
							
			$row = $query->row_array();
			
			$name = '';
			
			if ( ! empty( $row['first_name'] ) )
			{
				$name .=	 $row['first_name'];
			}
			
			if ( ! empty( $row['middle_name'] ) )
			{
				$name .= ' ' . $row['middle_name'];	
			}
			
			if ( ! empty( $row['last_name'] ) )
			{
				$name .= ' ' . $row['last_name'];
			}
			/*
			if ( ! empty( $row['employee_name'] ) )
			{
				$employee_name = $row['employee_name'];
			}
			*/
			if ( ! empty( $name ) )
			{
				$employee_name = $name;
			}
		}
		
		return $employee_name;
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