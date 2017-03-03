<?php 
/**
 * Class Entity
 *
 * A base class for entities that provides some convenience methods
 * that make working with entities a little simpler.
 *
 * @package 	App\Entities
 * @category 	
 */
namespace App\Entities;

defined('BASEPATH') OR exit('No direct script access allowed');

class Entity {
	
	/**
     * Given an array of key/value pairs, will fill in the
     * data on this instance with those values. Only works
     * on fields that exist.
     *
     * @param array $data
     */
	public function fill( array $data )
	{
		foreach ( $data as $key => $value )
		{
			// If a fill* method exists for this key, use that method to insert this value.
			// A simple insert on existing keys otherwise.
			
			// [11-11-16] Q: Would it be better to try and call the __get() 
			// methods instead of assiging directly here?
			$method = 'fill_' . $key;
			
			if ( method_exists( $this, $method ) )
			{
				$this->$method( $value );
			}
			elseif ( property_exists( $this, $key ) )
			{
				$this->$key = $value;
			}
		}
	}
	
	
	//--------------------------------------------------------------------
	
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
	
	/**
	 * Allows Models to be able to set any class properties from the result set.
	 *
	 * For flexibility, child classes can create `set*()` methods
     * to provide custom setters for keys. For example, a field
     * named `created_at` would have a `set_created_at` method.
	 * 
	 * @param	string	$key
	 * @param	null	$value
	 */
	public function __set( /* string */ $key, $value = NULL )
	{
		// If a set* method exists for this key, use that method to insert this value.
		// A simple insert on existing keys otherwise.
		$method = 'set_' . $key;
		
		if ( method_exists( $this, $method ) )
		{
			$this->$method( $value );	
		}
		elseif ( isset( $this->$key ) )
		{
			$this->$key = $value;
		}
	}
	
	//--------------------------------------------------------------------
}