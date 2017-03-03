<?php 
/**
 * Class Phase Collection
 *
 * Entity for a Phase Value Object
 *
 * @package 	App\Collections
 * @category 	
 * @author		Scott Benton
 */
namespace App\Collections;

defined('BASEPATH') OR exit('No direct script access allowed');

class Phase_Collection {
	
	protected $phase_group;
	protected $phases = [];
	
	
	
	public function add( \App\Entities\Phase $phase )
	{
		if ( ! isset( $this->phase_group ) )
		{
			$this->phase_group = $phase->phase_group;
		}
		
		if ( ! $this->phase_exists( $phase ) )
		{
			$this->add_phase( $phase );
		}
	}
	
	
	public function get_phases()
	{
		return $this->phases;
	}
	
	
	
	protected function phase_exists( \App\Entities\Phase $phase )
	{
		$criteria = [
			'phase_code' 	=> $phase->phase_code,
			'cost_type'		=> $phase->cost_type
		];
		
		foreach ( $this->phases as $existing_phase )
		{
			if ( $existing_phase->matches( $criteria ) )
			{
				return TRUE;	
			}
		}
		
		return FALSE;
	}
	
	
	
	protected function add_phase( \App\Entities\Phase $phase )
	{
		$this->phases[] = $phase;
	}
	
	
	
	public function sort_by( $criteria = [] )
	{
		usort( $this->phases, $this->_phase_entity_sort( $criteria ) );
	}
	
	
	
	private function _phase_entity_sort( $criteria = [] )
	{
		return function( $a, $b ) use ( $criteria ) {
			
			// make this a loop instead?
			
			if ( isset( $criteria['division'] ) )
			{
				$c = strcmp( $a->division, $b->division );
				
				if ( $criteria['division'] === 'descending' )
				{
					$c *= -1;	
				}
				
				if ( $c !== 0 )
				{
					return $c;
				}
			}
			
			if ( isset( $criteria['cost_type'] ) )
			{
				$c = strcmp( $a->cost_type, $b->cost_type );
				
				if ( $criteria['cost_type'] === 'descending' )
				{
					$c *= -1;	
				}
				
				if ( $c !== 0 )
				{
					return $c;
				}
			}
			
			return 0;
		};
	}
	
	//--------------------------------------------------------------------
    // Magic Methods
    //--------------------------------------------------------------------
	
	/**
	 * Allows Models to be able to get any class properties that are
     * stored on this class.
	 *
	 * For flexibility, child classes can create `get*()` methods
     * that will be used in place of getting the value directly.
     * For example, a `created_at` property would have a `created_at`
     * method.
	 * 
	 * @param	string  $key
	 * @return	mixed
	 */
	public function __get( /* string */ $key )
	{
		// If a get* method exists for this key, use that method to get this value.
		if ( method_exists( $this, $key ) )
		{
			return $this->$key();
		}
		
		if ( isset( $this->$key ) )
		{
			return $this->$key;
		}
	}
	
	//--------------------------------------------------------------------
}