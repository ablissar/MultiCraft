<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Job Books Form - "Create Job" Configuration
| -------------------------------------------------------------------
| 
*/


$config['search_filter'] = [
	'company_code' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'company_code',
				'id'			=> 'company_code',
				'class'		=> '',
				'options'	=> [
					'mcc'	=> 'MCC',
					'mcs'	=> 'MCS'
				],
				'selected'	=> 'mcc'
			],
		],
		'label'	=> [
			'text'			=> 'Company Code',
			'attributes'	 	=> [
				'for'	=> 'company_code',
			]
		]
	],

	'division' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'division',
				'id'			=> 'division',
				'class'		=> '',
				'options'	=> [
					60	=> 'Commercial',
					44	=> 'Crane',
					77	=> 'Electrical + Panel Shop',
					55	=> 'Fabrication',
					66	=> 'Mechanical',
					50	=> 'Robotics',
					88	=> 'Service',
					99	=> 'Sheet Metal'
				],
				'selected'	=> 77
			],
		],
		'label'	=> [
			'text'			=> 'Division',
			'attributes'	 	=> [
				'for'	=> 'division',
			]
		]
	]
];

$config['advanced_search_filter'] = [
	
	'company_code[mcc]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'company_code[]',
				'class'		=> '',
				'value'		=> 'mcc',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'MCC',
			'attributes'	 	=> [
			]
		]
	],
	
	'company_code[mcs]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'company_code[]',
				'class'		=> '',
				'value'		=> 'mcs',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'MCS',
			'attributes'	 	=> [
			]
		]
	],
	
	'job_type[contract]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'job_type[]',
				'class'		=> '',
				'value'		=> 'CN',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Contract',
			'attributes'	 	=> [
			]
		]
	],
	
	'job_type[time_and_material]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'job_type[]',
				'class'		=> '',
				'value'		=> 'TM',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Time & Material',
			'attributes'	 	=> [
			]
		]
	],
	
	'job_status[active]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'job_status[]',
				'class'		=> '',
				'value'		=> 'A',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Active',
			'attributes'	 	=> [
				'class'	=> 'nested-label'
			]
		]
	],
	
	'job_status[inactive]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'job_status[]',
				'class'		=> '',
				'value'		=> 'I',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Inactive',
			'attributes'	 	=> [
				'class'	=> 'nested-label'
			]
		]
	],
	
	'job_status[closed]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'job_status[]',
				'class'		=> '',
				'value'		=> 'C',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Closed',
			'attributes'	 	=> [
				'class'	=> 'nested-label'
			]
		]
	],
	
	'tax_code[empty]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'tax_code[]',
				'class'		=> '',
				'value'		=> 'empty',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Empty',
			'attributes'	 	=> [
			]
		]
	],
	
	'tax_code[not_empty]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'tax_code[]',
				'class'		=> '',
				'value'		=> 'not_empty',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Not Empty',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[commercial]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '60',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Commercial',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[crane]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '44',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Crane',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[electrical]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '66',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Electrical + Panel Shop',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[fabrication]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '55',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Fabrication',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[mechanical]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '66',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Mechanical',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[robotics]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '50',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Robotics',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[service]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '88',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Service',
			'attributes'	 	=> [
			]
		]
	],
	
	'division[sheet-metal]' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'division[]',
				'class'		=> '',
				'value'		=> '99',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Sheet Metal',
			'attributes'	 	=> [
			]
		]
	],
	
	
	
	'job_number' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'job_number',
				'id'			=> 'job_number',
				'class'		=> '',
				'value'		=> ''
			],
		],
		'label'	=> [
			'text'			=> 'Job Number Contains',
			'attributes'	 	=> [
				'for'	=> 'job_number',
			]
		]
	],
	
	'customer_code' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'customer_code',
				'id'			=> 'customer_code',
				'class'		=> '',
				'value'		=> ''
			],
		],
		'label'	=> [
			'text'			=> 'Customer Code Contains',
			'attributes'	 	=> [
				'for'	=> 'customer_code',
			]
		]
	],
	
	'created' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'created',
				'id'			=> 'created',
				'class'		=> '',
				'options'	=> [
					'after'		=> 'After',
					'before'	=> 'Before',
					'between'	=> 'Between'
				],
				'selected'	=> 'after'
			],
		],
		'label'	=> [
			'text'			=> 'Created',
			'attributes'	 	=> [
				'for'	=> 'company_code',
			]
		]
	],
	
	'created_before' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'created_before',
				'id'			=> 'created_before',
				'class'		=> 'hidden',
				'value'		=> ''
			],
		]
	],
	
	'created_after' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'created_after',
				'id'			=> 'created_after',
				'class'		=> '',
				'value'		=> ''
			],
		]
	]
];

$config['tax_code'] = [

	'tax_code' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'tax_code',
				'id'			=> 'tax_code',
				'class'		=> '',
				'value'		=> ''
			],
		],
		'label'	=> [
			'text'			=> 'Tax Classification Code',
			'attributes'	 	=> [
				'for'	=> 'tax_code',
			]
		]
	],

	'taxable_yes' => [
		'input'	=> [
			'type'		=> 'radio',
			'options' 	=> [
				'name'		=> 'taxable',
				'class'		=> '',
				'value'		=> 'yes',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Yes',
			'attributes'	 	=> [
			]
		]
	],
	
	'taxable_no' => [
		'input'	=> [
			'type'		=> 'radio',
			'options' 	=> [
				'name'		=> 'taxable',
				'class'		=> '',
				'value'		=> 'no',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'No',
			'attributes'	 	=> [
			]
		]
	],
	
	'activate_job' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'activate_job',
				'class'		=> '',
				'value'		=> TRUE,
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Activate Job',
			'attributes'	 	=> [
			]
		]
	],
];


$config['create_phases'] = [

	'division' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'department',
				'id'			=> 'department',
				'class'		=> '',
				'options'	=> [
					60	=> 'Commercial',
					44	=> 'Crane',
					77	=> 'Electrical + Panel Shop',
					55	=> 'Fabrication',
					66	=> 'Mechanical',
					50	=> 'Robotics',
					88	=> 'Service',
					99	=> 'Sheet Metal'
				],
				'selected'	=> 77
			],
		],
		'label'	=> [
			'text'			=> 'Division',
			'attributes'	 	=> [
				'for'	=> 'department',
			]
		]
	],
	
	'phase_group_code_label' => [
		'label'	=> [
			'text'			=> 'Phase Code',
			'attributes'	 	=> [
				'for'	=> 'phase_group_code',
			]
		]
	],
	
	'phase_group_code' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'phase_group_code',
				'id'			=> 'phase_group_code',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '6',
				'size'		=> '6'
			]
		]
	],
	
	'description' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'description',
				'id'			=> 'description',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '25',
				'size'		=> '25'
			],
		],
		'label'	=> [
			'text'			=> 'Description',
			'attributes'	 	=> [
				'for'	=> 'description'
			]
		]
	],
	
	'cost_type_field' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[field][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Field Labor [F]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_field' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[field][estimated_cost]',
				'id'			=> 'estimated_cost_field',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_field'
			]
		]
	],
	
	'estimated_hours_field' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[field][estimated_hours]',
				'id'			=> 'estimated_hours_field',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Hours',
			'attributes'	 	=> [
				'for'	=> 'estimated_hours_field'
			]
		]
	],
	
	'cost_type_shop' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[shop][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Shop Labor [H]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_shop' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[shop][estimated_cost]',
				'id'			=> 'estimated_cost_shop',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_shop'
			]
		]
	],
	
	'estimated_hours_shop' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[shop][estimated_hours]',
				'id'			=> 'estimated_hours_shop',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Hours',
			'attributes'	 	=> [
				'for'	=> 'estimated_hours_shop'
			]
		]
	],
	
	'cost_type_drivetime' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[drivetime][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Drive Time [?]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_drivetime' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[drivetime][estimated_cost]',
				'id'			=> 'estimated_cost_drivetime',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_drivetime'
			]
		]
	],
	
	'estimated_hours_drivetime' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[drivetime][estimated_hours]',
				'id'			=> 'estimated_hours_drivetime',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Hours',
			'attributes'	 	=> [
				'for'	=> 'estimated_hours_drivetime'
			]
		]
	],
	
	
	'cost_type_direct' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[direct][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Direct Cost [D]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_direct' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[direct][estimated_cost]',
				'id'			=> 'estimated_cost_direct',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_direct'
			]
		]
	],
	
	
	'cost_type_equipment' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[equipment][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Equipment Rental [E]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_equipment' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[equipment][estimated_cost]',
				'id'			=> 'estimated_cost_equipment',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_equipment'
			]
		]
	],
	
	
	'cost_type_material' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[material][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Material Cost [M]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_material' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[material][estimated_cost]',
				'id'			=> 'estimated_cost_material',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_material'
			]
		]
	],
	
	
	'cost_type_other' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[other][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Other [O]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_other' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[other][estimated_cost]',
				'id'			=> 'estimated_cost_other',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_other'
			]
		]
	],
	
	
	'cost_type_internal_subcontractor' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[internal_subcontractor][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Internal Subcontractors [Q]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_internal_subcontractor' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[internal_subcontractor][estimated_cost]',
				'id'			=> 'estimated_cost_internal_subcontractor',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_internal_subcontractor'
			]
		]
	],
	
	
	'cost_type_external_subcontractor' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[external_subcontractor][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'External Subcontractors [S]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_external_subcontractor' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[external_subcontractor][estimated_cost]',
				'id'			=> 'estimated_cost_external_subcontractor',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_external_subcontractor'
			]
		]
	]
];


$config['create_job'] = [
	'company_code' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'company_code',
				'id'			=> 'company_code',
				'class'		=> '',
				'options'	=> [
					'mcc'	=> 'MCC',
					'mcs'	=> 'MCS'
				],
				'selected'	=> 'mcc'
			],
		],
		'label'	=> [
			'text'			=> 'Company Code',
			'attributes'	 	=> [
				'for'	=> 'company_code',
			]
		]
	],
	
	'department' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'department',
				'id'			=> 'department',
				'class'		=> '',
				'options'	=> [
					'commercial'	=> 'Commercial',
					'crane'			=> 'Crane',
					'electrical'	=> 'Electrical',
					'fabrication'	=> 'Fabrication',
					'mechanical'	=> 'Mechanical',
					'panel-shop'	=> 'Panel Shop',
					'robotics'		=> 'Robotics',
					'service'		=> 'Service',
					'sheet-metal'	=> 'Sheet Metal'
				],
				'selected'	=> 'electrical'
			],
		],
		'label'	=> [
			'text'			=> 'Department',
			'attributes'	 	=> [
				'for'	=> 'department',
			]
		]
	],
	
	'contract_job_type' => [
		'input'	=> [
			'type'		=> 'radio',
			'options' 	=> [
				'name'		=> 'job_type',
				'class'		=> '',
				'value'		=> 'contract',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Contract',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'contract_amount' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'contract_amount',
				'id'			=> 'contract_amount',
				'class'		=> '',
				'value'		=> ''
			],
		],
		'label'	=> [
			'text'			=> 'Amount',
			'attributes'	 	=> [
				'for'	=> 'contract_amount'
			]
		]
	],
	
	
	
	'time_and_material_job_type' => [
		'input'	=> [
			'type'		=> 'radio',
			'options' 	=> [
				'name'		=> 'job_type',
				'class'		=> '',
				'value'		=> 'time_and_material',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Time &amp; Material',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'not_to_exceed' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'not_to_exceed',
				'id'			=> 'not_to_exceed',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Not to Exceed',
			'attributes'	 	=> [
				'for'	=> 'not_to_exceed'
			]
		]
	],
	
	
	'customer_code' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'customer_code',
				'id'			=> 'customer_code',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '10',
				'required'	=> 'required',
				'size'		=> '10'
			],
		],
		'label'	=> [
			'text'			=> 'Customer Code',
			'attributes'	 	=> [
				'for'	=> 'customer_code'
			]
		]
	],
	
	'contract_number' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'contract_number',
				'id'			=> 'contract_number',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '30',
				'size'		=> '30'
			],
		],
		'label'	=> [
			'text'			=> 'Purchase Order #',
			'attributes'	 	=> [
				'for'	=> 'contract_number'
			]
		]
	],
	
	'new_substantial_modification' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'new_substantial_modification',
				'class'		=> '',
				'value'		=> TRUE,
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Work performed on this job is part of a new construction project or substantially modifies the pre-existing architecture of a building.',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'wrap_report' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'wrap_report',
				'class'		=> '',
				'value'		=> TRUE,
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'This job has special insurance provisions that require us to be enrolled in an insurance program, and will be included in the Wrap Reporting process.',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'certified_payroll' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'certified_payroll',
				'class'		=> '',
				'value'		=> TRUE,
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'This is a Certified Payroll job which requires labor hours and rates to be reported.',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'davis_bacon_wage_designation' => [
		'input'	=> [
			'type'		=> 'radio',
			'options' 	=> [
				'name'		=> 'wage_designation',
				'class'		=> '',
				'value'		=> 'davis_bacon',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Davis-Bacon &mdash; Funded by Federal Government',
			'attributes'	 	=> [
			]
		]
	],
	
	'prevailing_wage_wage_designation' => [
		'input'	=> [
			'type'		=> 'radio',
			'options' 	=> [
				'name'		=> 'wage_designation',
				'class'		=> '',
				'value'		=> 'prevailing_wage',
				'checked'	=> FALSE
			],
		],
		'label'	=> [
			'text'			=> 'Prevailing Wage &mdash; Funded by State / Couny / Local Government',
			'attributes'	 	=> [
			]
		]
	],
	
	
	'description' => [
		'input'	=> [
			'type'		=> 'textarea',
			'options' 	=> [
				'name'		=> 'description',
				'id'			=> 'description',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '250',
			],
		],
		'label'	=> [
			'text'			=> 'Description',
			'attributes'	 	=> [
				'for'	=> 'description'
			]
		]
	],
	
	'short_description' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'short_description',
				'id'			=> 'short_description',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '25',
				'size'		=> '25'
			],
		],
		'label'	=> [
			'text'			=> 'Short Description',
			'attributes'	 	=> [
				'for'	=> 'short_description'
			]
		]
	],
	
	
	'superintendent' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'superintendent',
				'id'			=> 'superintendent',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '15',
				'size'		=> '15'
			],
		],
		'label'	=> [
			'text'			=> 'Superintendent',
			'attributes'	 	=> [
				'for'	=> 'superintendent'
			]
		]
	],
	
	'estimator' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'estimator',
				'id'			=> 'estimator',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '15',
				'size'		=> '15'
			],
		],
		'label'	=> [
			'text'			=> 'Estimator',
			'attributes'	 	=> [
				'for'	=> 'estimator'
			]
		]
	],
	
	
	'project_manager' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'project_manager',
				'id'			=> 'project_manager',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '15',
				'size'		=> '15'
			],
		],
		'label'	=> [
			'text'			=> 'Project Manager',
			'attributes'	 	=> [
				'for'	=> 'project_manager'
			]
		]
	],
	
	
	'estimated_start_date' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'type'		=> 'date',
				'name'		=> 'estimated_start_date',
				'id'			=> 'estimated_start_date',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Estimated Start Date',
			'attributes'	 	=> [
				'for'	=> 'estimated_start_date'
			]
		]
	],
	
	
	'estimated_complete_date' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'type'		=> 'date',
				'name'		=> 'estimated_complete_date',
				'id'			=> 'estimated_complete_date',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Estimated Complete Date',
			'attributes'	 	=> [
				'for'	=> 'estimated_complete_date'
			]
		]
	],
	
	
	'note' => [
		'input'	=> [
			'type'		=> 'textarea',
			'options' 	=> [
				'name'		=> 'note',
				'id'			=> 'note',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Notes (Optional)',
			'attributes'	 	=> [
				'for'	=> 'note'
			]
		]
	],
	
	'address_line_1' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'address_line_1',
				'id'			=> 'address_line_1',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '30',
				'size'		=> '30'
			],
		],
		'label'	=> [
			'text'			=> 'Address Line 1 (Street Address, P.O. Box, Company Name, etc.)',
			'attributes'	 	=> [
				'for'	=> 'address_line_1'
			]
		]
	],
	
	'address_line_2' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'address_line_2',
				'id'			=> 'address_line_2',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '30',
				'size'		=> '30'
			],
		],
		'label'	=> [
			'text'			=> 'Address Line 2 (Apartment, Suite, Unit, Building, Floor, etc.)',
			'attributes'	 	=> [
				'for'	=> 'address_line_2'
			]
		]
	],
	
	'city' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'city',
				'id'			=> 'city',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '25',
				'size'		=> '25'
			],
		],
		'label'	=> [
			'text'			=> 'City',
			'attributes'	 	=> [
				'for'	=> 'city'
			]
		]
	],
	
	'state' => [
		'input'	=> [
			'type'		=> 'dropdown',
			'options' 	=> [
				'name'		=> 'state',
				'id'			=> 'state',
				'class'		=> '',
				'options'	=> [],
				'options_callback'	=> 'get_state_codes_array',
				'selected'	=> 'AR'
			]
		],
		'label'	=> [
			'text'			=> 'State',
			'attributes'	 	=> [
				'for'	=> 'state'
			]
		]
	],
	
	'zipcode' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'zip_code',
				'id'			=> 'zip_code',
				'class'		=> '',
				'value'		=> '',
				'maxlength'	=> '10',
				'size'		=> '10'
			],
		],
		'label'	=> [
			'text'			=> 'Zip Code',
			'attributes'	 	=> [
				'for'	=> 'zip_code'
			]
		]
	],
	
	'cost_type_field' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[field][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Field Labor [F]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_field' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[field][estimated_cost]',
				'id'			=> 'estimated_cost_field',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_field'
			]
		]
	],
	
	'estimated_hours_field' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[field][estimated_hours]',
				'id'			=> 'estimated_hours_field',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Hours',
			'attributes'	 	=> [
				'for'	=> 'estimated_hours_field'
			]
		]
	],
	
	'cost_type_shop' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[shop][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Shop Labor [H]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_shop' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[shop][estimated_cost]',
				'id'			=> 'estimated_cost_shop',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_shop'
			]
		]
	],
	
	'estimated_hours_shop' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[shop][estimated_hours]',
				'id'			=> 'estimated_hours_shop',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Hours',
			'attributes'	 	=> [
				'for'	=> 'estimated_hours_shop'
			]
		]
	],
	
	'cost_type_drivetime' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[drivetime][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Drive Time [?]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_drivetime' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[drivetime][estimated_cost]',
				'id'			=> 'estimated_cost_drivetime',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_drivetime'
			]
		]
	],
	
	'estimated_hours_drivetime' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[drivetime][estimated_hours]',
				'id'			=> 'estimated_hours_drivetime',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Hours',
			'attributes'	 	=> [
				'for'	=> 'estimated_hours_drivetime'
			]
		]
	],
	
	
	'cost_type_direct' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[direct][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Direct Cost [D]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_direct' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[direct][estimated_cost]',
				'id'			=> 'estimated_cost_direct',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_direct'
			]
		]
	],
	
	
	'cost_type_equipment' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[equipment][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Equipment Rental [E]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_equipment' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[equipment][estimated_cost]',
				'id'			=> 'estimated_cost_equipment',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_equipment'
			]
		]
	],
	
	
	'cost_type_material' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[material][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Material Cost [M]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_material' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[material][estimated_cost]',
				'id'			=> 'estimated_cost_material',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_material'
			]
		]
	],
	
	
	'cost_type_other' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[other][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Other [O]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_other' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[other][estimated_cost]',
				'id'			=> 'estimated_cost_other',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_other'
			]
		]
	],
	
	
	'cost_type_internal_subcontractor' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[internal_subcontractor][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'Internal Subcontractors [Q]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_internal_subcontractor' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[internal_subcontractor][estimated_cost]',
				'id'			=> 'estimated_cost_internal_subcontractor',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_internal_subcontractor'
			]
		]
	],
	
	
	'cost_type_external_subcontractor' => [
		'input'	=> [
			'type'		=> 'checkbox',
			'options' 	=> [
				'name'		=> 'cost_type[external_subcontractor][selected]',
				'id'			=> '',
				'class'		=> '',
				'value'		=> TRUE,
			],
		],
		'label'	=> [
			'text'			=> 'External Subcontractors [S]',
			'attributes'	 	=> [
				'class' 	=> 'nested-label flex-container'
			]
		]
	],
	
	'estimated_cost_external_subcontractor' => [
		'input'	=> [
			'type'		=> 'input',
			'options' 	=> [
				'name'		=> 'cost_type[external_subcontractor][estimated_cost]',
				'id'			=> 'estimated_cost_external_subcontractor',
				'class'		=> '',
				'value'		=> '',
			],
		],
		'label'	=> [
			'text'			=> 'Cost',
			'attributes'	 	=> [
				'for'	=> 'estimated_cost_external_subcontractor'
			]
		]
	]
];