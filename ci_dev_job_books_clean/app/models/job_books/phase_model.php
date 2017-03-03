<?php
/**
 * Phase Model
 * 
 * 
 * 
 * @package		Job Books
 * @author		Scott Benton
 * 
 */
namespace App\Models\Job_Books;

defined('BASEPATH') OR exit('No direct script access allowed');

class Phase_model extends \MY_Model 
{
	protected $factory; // still not sure if this is the correct word we need to be using...
	
	protected $table = '';
	protected $allowed_fields = [
		'company_code',
		'job_number',
		'phase_code',
		'division',
		'phase_group',
		'alternate_phase_code',
		'status_code',
		'description',
		'cost_type',
		'price_method_code',
		'start_date',
		'end_date',
		'complete_date',
		'lead_time_days',
		'original_estimated_cost',
		'original_estimated_hours'
	];
	
	protected $default_select = [
		'company_code',
		'job_number',
		'phase_code',
		'division',
		'phase_group',
		'alternate_phase_code',
		'status_code',
		'description',
		'cost_type',
		'price_method_code',
		'complete_date',
		'original_estimated_cost',
		'original_estimated_hours'
	];
	
	
	function __construct( $factory )
	{
		$this->factory = $factory;
		
		$this->load->config( 'spectrum', TRUE );
		$this->column_rules = $this->config->item( 'phase_columns', 'spectrum' );
		$this->load->library( 'query_translator' );
		$this->load->database( 'spectrum' );
	}
	
	// --------------------------------------------------------------------
	
	
	
	
	public function find_by_filter( $filter = [], $requested_attributes = [] )
	{
		if ( ! is_array( $filter ) )
		{
			return FALSE;	
		}
		
		$requested_attributes = $this->validate_attributes( $requested_attributes );
		$response = [];
		
		// Get the translated select portion of the query.
		$select = [];
		$columns = empty( $requested_attributes ) ? $this->default_select : $requested_attributes;
		
		if ( $translated_columns = $this->query_translator->translate_columns( $columns, $this->column_rules ) )
		{
			$select = $translated_columns;
		}
		
		$query = $this->db->select( $select );
		$query = $this->build_filter( $query, $filter );
		
		$query = $this->db->get( $this->table );
		
		foreach ( $query->result_array() as $row_array )
		{
			if ( $phase = $this->factory->build( $row_array ) )
			{
				$response[] = $phase;
			}
		}
		
		return $response;
	}
	
	// --------------------------------------------------------------------
	
	
	
	protected function build_filter( $query = NULL, $filter = [] )
	{
		if ( is_null( $query ) )
		{
			$query = $this->db;	
		}
		
		
		if ( isset( $filter['job_number'] ) )
		{
			if ( is_string( $filter['job_number'] ) )
			{
				$query->like( $this->column_rules['job_number']['column_name'], $filter['job_number'] );
			}
			elseif ( is_array( $filter['job_number'] ) )
			{
				$query->group_start();
				
				foreach ( $filter['job_number'] as $value )
				{
					$query->or_like( $this->column_rules['job_number']['column_name'], $value );	
				}
					
				$query->group_end();
			}
		}
		
		if ( isset( $filter['company_code'] ) )
		{
			if ( is_string( $filter['company_code'] ) )
			{
				$query->where( $this->column_rules['company_code']['column_name'], $filter['company_code'] );
			}
			elseif ( is_array( $filter['company_code'] ) )
			{
				$query->where_in( $this->column_rules['company_code']['column_name'], $filter['company_code'] );
			}
		}
		
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
	
	// --------------------------------------------------------------------
	
}
