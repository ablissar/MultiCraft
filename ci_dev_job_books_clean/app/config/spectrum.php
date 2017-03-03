<?php defined('BASEPATH') OR exit('No direct script access allowed');




// config containing the jc_job_master_mc column rules?
// need a better name for these
$config['job_columns'] = [
	
	'company_code' => [
		'column_name'	=> 'Company_Code',
		'function'		=> ''
	],
	
	'job_number' => [
		'column_name' 	=> 'Job_Number',
		'function' 		=> 'mssql_trim'
	],
	
	'division' => [
		'column_name'	=> 'Division',
		'function'		=> 'mssql_trim'
	],
	
	'short_description' => [
		'column_name'	=> 'Job_Description',
		'function'		=> 'mssql_trim'
	],
	
	'address_1' => [
		'column_name'	=> 'Address_1',
		'function'		=> 'mssql_trim'
	],
	
	'address_2' => [
		'column_name'	=> 'Address_2',
		'function'		=> 'mssql_trim'
	],
	
	'city' => [
		'column_name'	=> 'City',
		'function'		=> 'mssql_trim'
	],
	
	'state' => [
		'column_name'	=> 'State',
		'function'		=> ''
	],
	
	'zip_code' => [
		'column_name'	=> 'Zip_Code',
		'function'		=> 'mssql_trim'
	],
	
	'superintendent' => [
		'column_name'	=> 'Superintendent',
		'function'		=> 'mssql_trim'
	],
	
	'estimator' => [
		'column_name'	=> 'Estimator',
		'function'		=> 'mssql_trim'
	],
	
	'project_manager' => [
		'column_name'	=> 'Project_Manager',
		'function'		=> 'mssql_trim'
	],
	
	'certified_flag' => [
		'column_name'	=> 'Certified_Flag',
		'function'		=> ''
	],
	
	'contract_number' => [
		'column_name'	=> 'Contract_Number',
		'function'		=> 'mssql_trim'
	],
	
	'status_code' => [
		'column_name'	=> 'Status_Code',
		'function'		=> ''
	],
	
	'complete_date' => [
		'column_name'	=> 'Complete_Date',
		'function'		=> ''
	],
	
	'start_date' => [
		'column_name'	=> 'Start_Date',
		'function'		=> ''
	],
	
	'estimated_complete_date' => [
		'column_name'	=> 'Est_Complete_Date',
		'function'		=> ''
	],
	
	'estimated_start_date' => [
		'column_name'	=> 'Est_Start_Date',
		'function'		=> ''
	],
	
	'customer_code' => [
		'column_name'	=> 'Customer_Code',
		'function'		=> 'mssql_trim'
	],
	
	'job_type' => [
		'column_name'	=> 'Job_Type',
		'function'		=> 'mssql_trim'
	],
	
	'original_contract_amount' => [
		'column_name'	=> 'Original_Contract',
		'function'		=> ''
	],
	
	'taxable_flag' => [
		'column_name'	=> 'Taxable_Flag',
		'function'		=> ''
	],
	
	'price_method_code' => [
		'column_name'	=> 'Price_Method_Code',
		'function'		=> ''
	],
	
	'tax_classification_code' => [
		'column_name'	=> 'Tax_Class_Code',
		'function'		=> 'mssql_trim'
	],
	
	'track_prevailing_wage' => [
		'column_name'	=> 'Track_Prevailing_Wage',
		'function'		=> ''
	],
	
	'track_davis_bacon' => [
		'column_name'	=> 'Track_Davis_Bacon',
		'function'		=> ''
	],
	
	'projected_complete_date' => [
		'column_name'	=> 'Projected_Complete_Date',
		'function'		=> ''
	],
	
	'latitude' => [
		'column_name'	=> 'Latitude',
		'function'		=> ''
	],
	
	'longitude' => [
		'column_name'	=> 'Longitude',
		'function'		=> ''
	],
	
	'created_date' => [
		'column_name'	=> 'Create_Date',
		'function'		=> ''
	],
	
	'description' => [
		'column_name'	=> 'Comment',
		'function'		=> 'mssql_trim'
	]
];


$config['phase_columns'] = [

	'company_code' => [
		'column_name'	=> 'Company_Code',
		'function'		=> ''
	],
	
	'job_number' => [
		'column_name'	=> 'Job_Number',
		'function'		=> 'mssql_trim'
	],

	'phase_code' => [
		'column_name'	=> 'Phase_Code',
		'function'		=> 'mssql_trim'
	],
	
	'division' => [
		'column_name'	=> 'Major_Group_Code',
		'function'		=> 'mssql_trim'
	],
	
	'phase_group' => [
		'column_name'	=> 'Minor_Group_Code',
		'function'		=> 'mssql_trim'
	],
	
	'alternate_phase_code' => [
		'column_name'	=> 'Alt_Phase_Code',
		'function'		=> 'mssql_trim'
	],
	
	'status_code' => [
		'column_name'	=> 'Status_Code',
		'function'		=> ''
	],
	
	'description' => [
		'column_name'	=> 'Description',
		'function'		=> 'mssql_trim'
	],
	
	'cost_type' => [
		'column_name'	=> 'Cost_Type',
		'function'		=> 'mssql_trim'
	],
	
	'price_method_code' => [
		'column_name'	=> 'Price_Method_Code',
		'function'		=> ''
	],
	
	'start_date' => [
		'column_name'	=> 'Start_Date',
		'function'		=> ''
	],
	
	'end_date' => [
		'column_name'	=> 'End_Date',
		'function'		=> ''
	],
	
	'complete_date' => [
		'column_name'	=> 'Complete_Date',
		'function'		=> ''
	],
	
	'lead_time_days' => [
		'column_name'	=> 'Lead_Time_Days',
		'function'		=> ''
	],
	
	'original_estimated_cost' => [
		'column_name'	=> 'Original_Est_Cost',
		'function'		=> ''
	],
	
	'original_estimated_hours' => [
		'column_name'	=> 'Original_Est_Hours',
		'function'		=> ''
	]
];

$config['customer_columns'] = [
	
	'company_code'	=> [
		'column_name'	=> 'Company_Code',
		'function'		=> ''
	],
	
	
	'customer_code'	=> [
		'column_name'	=> 'Customer_Code',
		'function'		=> 'mssql_trim'
	],
	
	'customer_name' => [
		'column_name'	=> 'Name',
		'function'		=> 'mssql_trim'
	]
	
];

$config['employee_columns'] = [
	
	'company_code'	=> [
		'column_name'	=> 'Company_Code',
		'function'		=> ''
	],
	
	'employee_code'	=> [
		'column_name'	=> 'Employee_Code',
		'function'		=> 'mssql_trim'
	],
	
	'employee_name' => [
		'column_name'	=> 'Employee_Name',
		'function'		=> 'mssql_trim'
	],
	
	'first_name' => [
		'column_name'	=> 'First_Name',
		'function'		=> 'mssql_trim'
	],
	
	'middle_name' => [
		'column_name'	=> 'Middle_Name',
		'function'		=> 'mssql_trim'
	],
	
	'last_name' => [
		'column_name'	=> 'Last_Name',
		'function'		=> 'mssql_trim'
	]
];