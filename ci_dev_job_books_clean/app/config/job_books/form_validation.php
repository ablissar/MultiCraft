<?php defined('BASEPATH') OR exit('No direct script access allowed');




$config['create_job'] = [
	[
		'field' => 'company_code',
		'label' => '',
		'rules' => 'required'
	],
	[
		'field' => 'department',
		'label' => '',
		'rules' => 'required'
	],
	[
		'field' => 'job_type',
		'label' => '',
		'rules' => 'required'
	],
	[
		'field' => 'contract_amount',
		'label' => 'Contract Amount',
		'rules' => 'required_with[job_type,contract]|float',
		'errors'	=> [
			'required_with'	=> 'The {field} field is required if the Contract job type is selected.'
		]
	],
	[
		'field' => 'not_to_exceed',
		'label' => 'Not to Exceed',
		'rules' => 'required_with[job_type,time_and_material]|float',
		'errors'	=> [
			'required_with'	=> 'The {field} field is required if the Time & Material job type is selected.'
		]
	],
	[
		'field' => 'customer_code',
		'label' => 'Customer Code',
		'rules' => 'required|trim'
	],
	[
		'field' => 'contract_number',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'new_substation_modification',
		'label' => '',
		'rules' => 'trim'
	],
	[
		'field' => 'wrap_report',
		'label' => '',
		'rules' => 'trim'
	],
	[
		'field' => 'certified_payroll',
		'label' => 'Certified Payroll',
		'rules' => 'trim'
	],
	[
		'field' => 'wage_designation',
		'label' => 'Wage Designation',
		'rules' => 'required_with[certified_payroll]',
		'errors'	=> [
			'required_with'	=> 'The {field} field is required if Certified Payroll is selected.'
		]
	],
	[
		'field' => 'description',
		'label' => 'Description',
		'rules' => 'required|max_length[250]|trim'
	],
	[
		'field' => 'short_description',
		'label' => 'Short Description',
		'rules' => 'required|max_length[25]|trim'
	],
	[
		'field' => 'superintendent',
		'label' => 'Superintendent',
		'rules' => 'required|max_length[15]|trim'
	],
	[
		'field' => 'estimator',
		'label' => 'Estimator',
		'rules' => 'required|max_length[15]|trim'
	],
	[
		'field' => 'project_manager',
		'label' => 'Project Manager',
		'rules' => 'required|max_length[15]|trim'
	],
	[
		'field' => 'estimated_start_date',
		'label' => 'Estimated Start Date',
		'rules' => 'required|valid_date|trim'
	],
	[
		'field' => 'estimated_complete_date',
		'label' => 'Estimated Complete Date',
		'rules' => 'required|valid_date|trim'
	],
	[
		'field' => 'note',
		'label' => 'Notes',
		'rules' => 'max_length[1000]|trim'
	],
	[
		'field' => 'address_line_1',
		'label' => 'Address Line 1',
		'rules' => 'required|max_length[30]'
	],
	[
		'field' => 'address_line_2',
		'label' => 'Address Line 2',
		'rules' => 'required|max_length[30]'
	],
	[
		'field' => 'city',
		'label' => 'City',
		'rules' => 'required|max_length[25]'
	],
	[
		'field' => 'state',
		'label' => 'State',
		'rules' => 'required|is_valid_state[code]',
	],
	[
		'field' => 'zipcode',
		'label' => 'Zipcode',
		'rules' => 'required'
	],
	[
		'field' => 'cost_type[field][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[field][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[field][estimated_hours]',
		'label' => 'Estimated Hours (Field)',
		'rules' => 'max_length[10]'
	],
	[
		'field' => 'cost_type[shop][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[shop][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[shop][estimated_hours]',
		'label' => '',
		'rules' => 'numeric|max_length[10]'
	],
	[
		'field' => 'cost_type[drivetime][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[drivetime][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[drivetime][estimated_hours]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[direct][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[direct][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[equipment][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[equipment][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[material][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[material][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[other][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[other][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[internal_subcontractor][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[internal_subcontractor][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	],
	[
		'field' => 'cost_type[external_subcontractor][selected]',
		'label' => '',
		'rules' => ''
	],
	[
		'field' => 'cost_type[external_subcontractor][estimated_cost]',
		'label' => '',
		'rules' => 'max_length[12]'
	]
];