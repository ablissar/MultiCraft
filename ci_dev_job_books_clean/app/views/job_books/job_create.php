


<header class='page-header'>
	<nav>
		<?= $job_list_anchor ?>
	</nav>
	<h1 class='page-title'>Create Job</h1>
</header>

<main>
	
	<?= isset( $notification_message ) ? $notification_message : '' ?>
	
	<?= $form['form_open'] ?>
	<article class='form-group progress-step'>
		<header>
			<h2>Basic Information</h2>
		</header>
		<section>
			<div class='form-component'>
				<?= $form['company_code'] ?>
				<?= form_error( 'company_code' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['department'] ?>
				<?= form_error( 'department' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['job_type'] ?>
				<?= form_error( 'job_type' ) ?>
				
				<?= $form['contract_job_type'] ?>
				<div class='form-component hidden'>
					<?= $form['contract_amount'] ?>
					<?= form_error( 'contract_amount' ) ?>
				</div>
				
				<?= $form['time_and_material_job_type'] ?>
				<div class='form-component hidden'>
					<?= $form['not_to_exceed'] ?>
					<?= form_error( 'not_to_exceed' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['customer_code'] ?>
				<div class='form-control-icon'></div>
				<div class='form-control-message'>
					<?= form_error( 'customer_code' ) ?>
				</div>
			</div>
			<div class='form-component'>
				<?= $form['contract_number'] ?>
				<?= form_error( 'contract_number' ) ?>
			</div>
		</section>
	</article>
	
	
	<article class='form-group progress-step'>
		<header>
			<h2>Detailed Information</h2>
		</header>
		<section>
			<div class='form-component'><?= $form['new_substantial_modification'] ?></div>
			<div class='form-component'><?= $form['wrap_report'] ?></div>
			<div class='form-component'>
				<?= $form['certified_payroll'] ?>
				<?= form_error( 'wage_designation' ) ?>
				
				<div class='form-component hidden'>
					<?= $form['davis_bacon_wage_designation'] ?>
					<?= $form['prevailing_wage_wage_designation'] ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['description'] ?>
				<?= form_error( 'description' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['short_description'] ?>
				<?= form_error( 'short_description' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['superintendent'] ?>
				<?= form_error( 'superintendent' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['estimator'] ?>
				<?= form_error( 'estimator' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['project_manager'] ?>
				<?= form_error( 'project_manager' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['estimated_start_date'] ?>
				<?= form_error( 'estimated_start_date' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['estimated_complete_date'] ?>
				<?= form_error( 'estimated_complete_date' ) ?>
			</div>
			<div class='form-component'>
				<?= $form['note'] ?>
				<?= form_error( 'note' ) ?>
			</div>
		</section>
	</article>
	
	<article class='form-group progress-step'>
		<header>
			<h2>Job Location</h2>
		</header>
		<section>
			
			<?php if ( ! empty( $form['customer_location_options'] ) ): ?>
			<article class='block'>
				<header class='flex-container flex-space-between'>
					<p>Customer Locations (1 Result)</p>
					<?= $customer_address_toggle_button ?>
				</header>
				<section id='customer_location_options' class='hidden'>
					<?php foreach( $form['customer_location_options'] as $option ): ?>
						<?= $option ?>
					<?php endforeach; ?>
				</section>
			</article>
			<?php endif; ?>
			
			<section class='address-input'>
				<div class='form-component'>
					<?= $form['address_line_1'] ?>
					<?= form_error( 'address_line_1' ) ?>
				</div>
				<div class='form-component'>
					<?= $form['address_line_2'] ?>
					<?= form_error( 'address_line_2' ) ?>
				</div>
				<div class='form-component'>
					<?= $form['city'] ?>
					<?= form_error( 'city' ) ?>
				</div>
				<div class='form-component'>
					<?= $form['state'] ?>
					<?= form_error( 'state' ) ?>
				</div>
				<div class='form-component'>
					<?= $form['zipcode'] ?>
					<?= form_error( 'zipcode' ) ?>
				</div>
			</section>
			
			<section class='card address-card hidden'>
				<div class='address-display' >
					<p class='address_line_1'></p>
					<p class='address_line_2'></p>
					<p><span class='city'></span>, <span class='state'></span> <span class='zip_code'></span></p>
				</div>
				
				<?= form_button( [ 'type' => 'button', 'name' => 'modify-address-input', 'class' => 'button-text info', 'content' => 'Modify' ] ) ?>
				<?= form_button( [ 'type' => 'button', 'name' => 'remove-selected-address', 'class' => 'button-text danger', 'content' => 'Remove' ] ) ?>
			</section>
		</section>
	</article>
	
	<article class='form-group progress-step'>
		<header>
			<h2>Phase Setup</h2>
		</header>
		<section>
			<div class='form-component'>
				<?= $form['cost_type_field'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_field'] ?>
					<?= form_error( 'estimated_cost_field' ) ?>
				</div>
				<div class='form-component hidden'>
					<?= $form['estimated_hours_field'] ?>
					<?= form_error( 'estimated_hours_field' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_shop'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_shop'] ?>
					<?= form_error( 'estimated_cost_shop' ) ?>
				</div>
				<div class='form-component hidden'>
					<?= $form['estimated_hours_shop'] ?>
					<?= form_error( 'estimated_hours_shop' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_drivetime'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_drivetime'] ?>
					<?= form_error( 'estimated_cost_drivetime' ) ?>
				</div>
				<div class='form-component hidden'>
					<?= $form['estimated_hours_drivetime'] ?>
					<?= form_error( 'estimated_hours_drivetime' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_direct'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_direct'] ?>
					<?= form_error( 'estimated_cost_direct' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_equipment'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_equipment'] ?>
					<?= form_error( 'estimated_cost_equipment' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_material'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_material'] ?>
					<?= form_error( 'estimated_cost_material' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_other'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_other'] ?>
					<?= form_error( 'estimated_cost_other' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_internal_subcontractor'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_internal_subcontractor'] ?>
					<?= form_error( 'estimated_cost_internal_subcontractor' ) ?>
				</div>
			</div>
			
			<div class='form-component'>
				<?= $form['cost_type_external_subcontractor'] ?>
				
				<div class='form-component hidden'>
					<?= $form['estimated_cost_external_subcontractor'] ?>
					<?= form_error( 'estimated_cost_external_subcontractor' ) ?>
				</div>
			</div>
		</section>
	</article>
	
	<?= $form['submit_button'] ?>
	<?= $form['form_close'] ?>
</main>


<script>
// Show / hide nested input elements.
var job_contract_options = document.getElementsByName( 'job_type' );
var contract_amount_container = document.getElementsByName( 'contract_amount' )[0].parentElement;
var not_to_exceed_container = document.getElementsByName( 'not_to_exceed' )[0].parentElement;

for ( var i = 0, length = job_contract_options.length; i < length; i++ )
{
	job_contract_options[i].addEventListener( 'change', function() {
		
		if ( this.value === 'contract' )
		{
			contract_amount_container.classList.toggle( 'hidden', false );
			not_to_exceed_container.classList.toggle( 'hidden', true );
		}
		else if ( this.value === 'time_and_material' )
		{
			contract_amount_container.classList.toggle( 'hidden', true );
			not_to_exceed_container.classList.toggle( 'hidden', false );
		}
	});
}

var certified_payroll_input = document.getElementsByName( 'certified_payroll' )[0];
var wage_designation_container = document.getElementsByName( 'wage_designation' )[0].parentElement.parentElement;

certified_payroll_input.addEventListener( 'change', function() {
	
	wage_designation_container.classList.toggle( 'hidden', ! this.checked );
	
	
});

var cost_type_checkbox_inputs = document.querySelectorAll( 'input[type="checkbox"][name*=cost_type]' );

for ( var i = 0, length = cost_type_checkbox_inputs.length; i < length; i++ )
{
	cost_type_checkbox_inputs[i].addEventListener( 'change', function() {
		
		var nested_elements = this.parentElement.parentElement.getElementsByClassName( 'form-component' );
		
		for ( var i = 0, length = nested_elements.length; i < length; i++ )
		{
			nested_elements[i].classList.toggle( 'hidden', ! this.checked );
		}
	});
}
// end of show/hide nested input elements


var customer_code = document.getElementsByName( 'customer_code' )[0];
var customer_code_form_control_message = '';
var customer_code_form_control_icon = '';
if ( typeof( customer_code ) !== 'undefined' && customer_code != null )
{
	customer_code_form_control_message 	= customer_code.parentElement.getElementsByClassName( 'form-control-message' )[0];
	customer_code_form_control_icon 	= customer_code.parentElement.getElementsByClassName( 'form-control-icon' )[0];
	//customer_code.nextElementSibling;
}
var timeout = null;

customer_code.onkeyup = function( e ) {
	clearTimeout( timeout );
	
	timeout = setTimeout( function() {
		
		valid = validate_customer_code( customer_code.value );
		set_dynamic_validation_status( customer_code, valid );
		
		if ( valid === true )
		{
			customer_code_form_control_icon.innerHTML = '&#x2714;';
			customer_code_form_control_icon.classList.toggle( 'success', true );
			customer_code_form_control_message.innerHTML = '';
		}
		else
		{
			customer_code_form_control_icon.classList.toggle( 'success', false );
			customer_code_form_control_icon.innerHTML = '';
			customer_code_form_control_message.innerHTML = '<div class="danger">Invalid customer code.</div>';
		}
	}, 500);
};

function set_dynamic_validation_status( element, valid )
{
	element.classList.toggle( 'danger', valid === false );
	element.classList.toggle( 'success', valid === true );
}

function validate_customer_code( customer_code )
{
	if ( customer_code === 'MULTME' )
	{
		return true;
	}
	
	return false;
}

var customer_location_toggle = document.getElementsByName( 'customer_location_toggle' )[0];
var customer_location_content = document.getElementById( 'customer_location_options' );

if ( typeof( customer_location_toggle ) !== 'undefined' && customer_location_toggle != null )
{
	customer_location_toggle.addEventListener( 'click', function() {
		
		toggle_visibility( customer_location_content );
	
		if ( customer_location_content.classList.contains( 'hidden' ) )
		{
			this.innerHTML = '&darr;';
		}
		else
		{
			this.innerHTML = '&uarr;';
		}
	});
}


var customer_location_radio_input = document.getElementsByName( 'customer_location_address' );
var address_input = document.getElementsByClassName( 'address-input' );
var address_card = document.getElementsByClassName( 'address-card' )[0];

var input_address_line_1 = document.getElementsByName( 'address_line_1' )[0];
var input_address_line_2 = document.getElementsByName( 'address_line_2' )[0];
var input_city = document.getElementsByName( 'city' )[0];
var input_state = document.getElementsByName( 'state' )[0];
var input_zip_code = document.getElementsByName( 'zip_code' )[0];

for( var i = 0, length = customer_location_radio_input.length; i < length; i++ )
{
	customer_location_radio_input[i].addEventListener( 'change', address_selector_listener );
}

function address_selector_listener() 
{
	address_input[0].classList.toggle( 'hidden', true );
	address_card.classList.toggle( 'hidden', false );
	
	console.log( customer_location_radio_input[ this.value ] );
	address_card.getElementsByClassName( 'address_line_1' )[0].innerHTML = customer_location_radio_input[ this.value ].nextElementSibling.getElementsByClassName( 'address_1' )[0].innerHTML;
	address_card.getElementsByClassName( 'address_line_2' )[0].innerHTML = customer_location_radio_input[ this.value ].nextElementSibling.getElementsByClassName( 'address_2' )[0].innerHTML;
	address_card.getElementsByClassName( 'city' )[0].innerHTML = customer_location_radio_input[ this.value ].nextElementSibling.getElementsByClassName( 'city' )[0].innerHTML;
	address_card.getElementsByClassName( 'state' )[0].innerHTML = customer_location_radio_input[ this.value ].nextElementSibling.getElementsByClassName( 'state' )[0].innerHTML;
	address_card.getElementsByClassName( 'zip_code' )[0].innerHTML = customer_location_radio_input[ this.value ].nextElementSibling.getElementsByClassName( 'zip_code' )[0].innerHTML;
};


var modify_address_button = document.getElementsByName( 'modify-address-input' )[0];
var remove_address_button = document.getElementsByName( 'remove-selected-address' )[0];

modify_address_button.addEventListener( 'click', function() {
	
	uncheck_customer_location_radio_input();
	address_input[0].classList.toggle( 'hidden', false );
	address_card.classList.toggle( 'hidden', true );
	
	input_address_line_1.value = address_card.getElementsByClassName( 'address_line_1' )[0].innerHTML;
	input_address_line_2.value = address_card.getElementsByClassName( 'address_line_2' )[0].innerHTML;
	input_city.value = address_card.getElementsByClassName( 'city' )[0].innerHTML;
	input_state.value = address_card.getElementsByClassName( 'state' )[0].innerHTML;
	input_zip_code.value = address_card.getElementsByClassName( 'zip_code' )[0].innerHTML;
});

remove_address_button.addEventListener( 'click', function() {
	
	uncheck_customer_location_radio_input();
	address_input[0].classList.toggle( 'hidden', false );
	address_card.classList.toggle( 'hidden', true );
	
	input_address_line_1.value = '';
	input_address_line_2.value = '';
	input_city.value = '';
	input_state.value = 'AR';
	input_zip_code.value = '';
	
});

function uncheck_customer_location_radio_input()
{
	for( var i = 0, length = customer_location_radio_input.length; i < length; i++ )
	{
		customer_location_radio_input[i].checked = false;
	}
}


function toggle_visibility( $element ) 
{
	$element.classList.toggle( 'hidden' );
}
</script>