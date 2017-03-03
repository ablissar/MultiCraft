<?php 
namespace App\Factories\Job_Books;

defined('BASEPATH') OR exit('No direct script access allowed');

class Phase_Factory extends \App\Factories\Phase_Factory
{
	protected $phase_entity = '\App\Entities\Phase';
	
	function __construct()
	{
		
	}
	
	
	public function build( $data )
	{
		
		return new $this->phase_entity( $data );
	}
}
