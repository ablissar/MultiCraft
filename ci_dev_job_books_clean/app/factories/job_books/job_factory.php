<?php 
namespace App\Factories\Job_Books;

defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Factory extends \App\Factories\Job_Factory
{
	protected $job_entity = '\App\Entities\Job';
	
	function __construct()
	{
		
	}
	
	
	public function build( $data )
	{
		
		return new $this->job_entity( $data );
	}
}
