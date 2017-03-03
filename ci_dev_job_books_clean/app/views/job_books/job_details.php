<header class='page-header'>
	<nav>
		<?= $job_list_anchor ?>
	</nav>
	<h1 class='page-title'><?= $job_number ?></h1>
	<h5 class='page-subtitle'><?= $short_description ?></h5>
</header>

<main class='flex-container flex-wrap flex-space-between gutter-s'>
	
	<?= isset( $notification_message ) ? $notification_message : '' ?>
	
	<article class='block'>
		<header>
			<h2>Basic Job Information</h2>
		</header>
		<section>
			<div class='flex-container' >
				<label>Job Status</label>
				<div class=''>
					<p><?= $job_status ?></p>
				</div>
			</div>
			
			<div class='flex-container'>
				<label>Customer</label>
				<p><?= $customer ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Description</label>
				<p><?= $description ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Site Address</label>
				<div class='address-display' >
					<p class='address_line_1'><?= $address_1 ?></p>
					<p class='address_line_2'><?= $address_2 ?></p>
					<p><span class='city'><?= $city ?></span>, <span class='state'><?= $state ?></span> <span class='zip_code'><?= $zip_code ?></span></p>
				</div>
			</div>
			
			<hr>
			
			<div class='flex-container'>
				<label>Superintendent</label>
				<p><?= $superintendent ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Project Manager</label>
				<p><?= $project_manager ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Estimator</label>
				<p><?= $estimator ?></p>
			</div>
		</section>
	</article>
	
	<article class='block'>
		<header>
			<h2>Detailed Information</h2>
		</header>
		<section>
			<div class='flex-container'>
				<label>Company Code</label>
				<p><?= $company_code ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Division</label>
				<p><?= $division ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Job Type</label>
				<p><?= $job_type ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Amount</label>
				<p><?= $original_contract_amount ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Customer Code</label>
				<p><?= $customer_code ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Contract #</label>
				<p><?= $contract_number ?></p>
			</div>
			
			<div class='flex-container'>
				<label>Tax Code</label>
				<div class=''>
					<p><?= $tax_classification_code ?></p>
					
					<? if ( ! empty( $tax_code_form ) ): ?>
					<?= $tax_code_form['show_form_button'] ?>
					<article class='block block-information hidden'>
						<header>
							<p>Add Tax Code</p>
						</header>
						<section>
							<?= $tax_code_form['form_open'] ?>
							
							<div class='form-component'>
								<?= $tax_code_form['taxable'] ?>
								<?= $tax_code_form['taxable_yes'] ?>
								<?= $tax_code_form['taxable_no'] ?>
							</div>
							
							<div class='form-component'><?= $tax_code_form['tax_code'] ?></div>
							
							<? if( isset( $tax_code_form['activate_job'] ) ): ?>
							<div class='form-component'><?= $tax_code_form['activate_job'] ?></div>
							<? endif; ?>
							
							<?= $tax_code_form['submit_button'] ?>
							<?= $tax_code_form['close_button'] ?>
							<?= $tax_code_form['form_close'] ?>
						</section>
					</article>
					<? endif; ?>
				</div>
			</div>
			
			<div class='flex-container'>
				<label>Created On</label>
				<p><?= $created_date ?></p>
			</div>
			
		</section>
	</article>
	
	<article class='block'>
		<header>
			<h2>Phases / Extras</h2>
		</header>
		<section>
			<?= $phase_table ?>
			
			<?= $create_phase_button ?>
			
			
			<?= $create_phases_form['form_open'] ?>
			<article class='form-group'>
				<header>
					<h3>Add New Phases</h3>
				</header>
				<section>
					<div class='form-component'><?= $create_phases_form['division'] ?></div>
					<div class='form-component form-component-block flex-container flex-wrap'>
						<?= $create_phases_form['phase_group_code_label'] ?>
						<div class='input-prefix phase-code-division'><?= $create_phases_form['phase_input_prefix_value'] ?></div>
						<?= $create_phases_form['phase_group_code'] ?>
					</div>
					<div class='form-component'><?= $create_phases_form['description'] ?></div>
					
					
					
					<div class='form-component'>
						<?= $create_phases_form['phase_setup'] ?>
						<?= $create_phases_form['cost_type_field'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_field'] ?></div>
						<div class='form-component'><?= $create_phases_form['estimated_hours_field'] ?></div>
					</div>
				
					<div class='form-component'>
						<?= $create_phases_form['cost_type_shop'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_shop'] ?></div>
						<div class='form-component'><?= $create_phases_form['estimated_hours_shop'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_drivetime'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_drivetime'] ?></div>
						<div class='form-component'><?= $create_phases_form['estimated_hours_drivetime'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_direct'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_direct'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_equipment'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_equipment'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_material'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_material'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_other'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_other'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_internal_subcontractor'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_internal_subcontractor'] ?></div>
					</div>
					
					<div class='form-component'>
						<?= $create_phases_form['cost_type_external_subcontractor'] ?>
						<div class='form-component'><?= $create_phases_form['estimated_cost_external_subcontractor'] ?></div>
					</div>
					
				</section>
			</article>
			<?= $create_phases_form['submit_button'] ?>
			<?= $create_phases_form['close_button'] ?>
			<?= $create_phases_form['form_close'] ?>
		</section>
	</article>
</main>

<script>
var show_tax_form = document.getElementsByName( 'show_tax_form' )[0];
if ( typeof( show_tax_form ) !== 'undefined' && show_tax_form != null )
{
	var tax_form_container = show_tax_form.nextElementSibling;
}
var tax_form = document.getElementsByName( 'add_tax_form' )[0];
var close_tax_form = document.getElementsByName( 'close_tax_form' )[0];

var show_phase_form = document.getElementsByName( 'show_phase_form' )[0];
var phase_form = document.getElementsByName( 'add_phase_form' )[0];
var close_phase_form = document.getElementsByName( 'close_phase_form' )[0];


var tax_form_department_select = document.getElementsByName( 'department' )[0];
var phase_group_prefix = document.getElementsByClassName( 'phase-code-division' )[0];


if ( typeof( tax_form_department_select ) !== 'undefined' && tax_form_department_select != null )
{
	tax_form_department_select.addEventListener( 'change', function() {
		phase_group_prefix.innerHTML = this.value;
	});
}

if ( typeof( show_tax_form ) !== 'undefined' && show_tax_form != null )
{
	show_tax_form.addEventListener( 'click', function() {
		toggle_visibility( tax_form_container );
		toggle_visibility( this );
	});
	
	close_tax_form.addEventListener( 'click', function() {
		toggle_visibility( show_tax_form );
		toggle_visibility( tax_form_container );
		tax_form.reset();
	});
}

show_phase_form.addEventListener( 'click', function() {
	toggle_visibility( phase_form );
	toggle_visibility( this );
});

close_phase_form.addEventListener( 'click', function() {
	toggle_visibility( show_phase_form );
	toggle_visibility( phase_form );
	phase_form.reset();
});

function toggle_visibility( $element ) {
	$element.classList.toggle( 'hidden' );
}
</script>