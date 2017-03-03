<?php
namespace App\Interfaces;
defined('BASEPATH') OR exit('No direct script access allowed');

interface Factory {
	
	function build( $data );
	
}