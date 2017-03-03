<?php 
namespace App\Repositories;

defined('BASEPATH') OR exit('No direct script access allowed');

class Phase_Repository
{
	
	protected $collection_object = '\App\Collections\Phase_Collection';
	
	protected $phase_groups = [];
	
	function __construct()
	{
		
	}
	
	public function add_phase_entity( \App\Entities\Phase $phase )
	{
		// Try to see if we have an existing collection for this phase.
		$phase_group = $phase->phase_group;
		
		if ( $this->collection_exists( $phase_group ) )
		{
			$this->phase_groups[ $phase_group ]->add( $phase );
			//echo '<pre>'; print_r( $this->phase_groups[ $phase_group ] ); echo '</pre>';
		}
		else
		{
			$collection = $this->create_collection();
			$collection->add( $phase );
			$this->add_phase_collection( $collection );
		}
		
	}
	
	
	public function add_phase_collection( \App\Collections\Phase_Collection $collection )
	{
		$phase_group = $collection->phase_group;
		//echo $phase_group;
		
		if ( ! $this->collection_exists( $phase_group ) )
		{
			$this->phase_groups[ $phase_group ] = $collection;	
		}
		else
		{
			// We still need to try and go through each of the phases to try and add them.
			foreach ( $collection as $phase )
			{
				$this->add_phase_entity( $phase );	
			}
		}
	}
	
	
	public function find_collection( $phase_group = '' )
	{
		$collection = FALSE;
		
		if ( isset( $phase_groups[ $phase_group ] ) )
		{
			// Not entirely sure if we want to pass by reference or not. 
			$collection =& $phase_groups[ $phase_group ];
		}
		
		return $collection;
	}
	
	
	
	public function collection_exists( $phase_group = '' )
	{
		return ( ! empty( $phase_group ) ) ? isset( $this->phase_groups[ $phase_group ] ) : FALSE;
	}
	
	
	
	
	
	protected function create_collection()
	{
		return new $this->collection_object();
	}
	
	
	
	
	
	
	public function get_phases()
	{
		$phases = [];
		
		foreach ( $this->phase_groups as $collection )
		{
			$phases = array_merge( $phases, $collection->get_phases() );
		}
		
		return $phases;
	}
	
	
	public function sort_by( $criteria = [] )
	{
		
		if ( isset( $criteria['phase_group'] ) )
		{
			if ( $criteria['phase_group'] === 'descending' )
			{
				krsort( $this->phase_groups );
			}
			else
			{
				ksort( $this->phase_groups );	
			}
			
			unset( $criteria['phase_group'] );
		}
		
		foreach ( $this->phase_groups as $collection )
		{
			$collection->sort_by( $criteria );
		}		
	}
	
	
	public function __call( $method, $arguments )
	{
		if ( $method === 'add' )
		{
			$parameter = $arguments[0];
			// is this... appropriate? seems clunky to have to refer to the arguments directly like this.
			//if ( $arguments[0]
			if ( $parameter instanceof $this->collection_object )
			{
				return call_user_func_array( [ $this, 'add_phase_collection' ], $arguments );
			}
			
			if ( $parameter instanceof \App\Entities\Phase )
			{
				return call_user_func_array( [ $this, 'add_phase_entity'] , $arguments );	
			}
		}
		
		if ( ! method_exists( $this, $method ) )
		{
			trigger_error( 'Call to undefined method ' .__CLASS__. '::' . $method . '()', E_USER_ERROR);
		}
	}
}
