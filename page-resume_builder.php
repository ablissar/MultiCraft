<?php

/* Template Name: Resumé Builder */
$data 	= [];
$errors 	= [];

// Check to see if we need to evaluate form validation.
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
{
	// Clean $_POST Data
	// Modified the input data function to also trim the data - but I have reservations on doing so.
	if ( is_array( $_POST ) )
	{
		foreach ( $_POST as $key => $val )
		{
			$_POST[ _clean_input_keys( $key ) ] = _clean_input_data( $val );
		}
	}


	// Initialize the variables that we're going to be validating against.
	// The simple parameters.
	$name 	= ( ! empty( $_POST['rb_name'] ) ) 		? $_POST['rb_name'] 	: '';
	$email 	= ( ! empty( $_POST['rb_email'] ) ) 	? $_POST['rb_email'] 	: '';
	$phone 	= ( ! empty( $_POST['rb_phone'] ) ) 	? $_POST['rb_phone'] 	: '';
	$street = ( ! empty( $_POST['rb_street'] ) ) 	? $_POST['rb_street'] 	: '';
	$city	= ( ! empty( $_POST['rb_city'] ) ) 		? $_POST['rb_city'] 	: '';
	$state	= ( ! empty( $_POST['rb_state'] ) ) 	? $_POST['rb_state'] 	: '';
	$zip	= ( ! empty( $_POST['rb_zip'] ) ) 		? $_POST['rb_zip'] 		: '';
	$goals	= ( ! empty( $_POST['rb_goals'] ) )		? $_POST['rb_goals'] 	: '';


	// These are tentative. These are the ones that need a lot more work put in.
	$work_history 	= ( ! empty( $_POST['rb_work_history'] ) ) 		? $_POST['rb_work_history']		: [];
	$education 		= ( ! empty( $_POST['rb_education'] ) ) 		? $_POST['rb_education'] 		: [];
	$certifications = ( ! empty( $_POST['rb_certifications'] ) ) 	? $_POST['rb_certifications'] 	: [];
	$references 	= ( ! empty( $_POST['rb_references'] ) ) 		? $_POST['rb_references'] 		: [];



	// Name
	if ( empty( $name ) || ! valid_name( $name ) )
	{
		$errors['name'] = 'Invalid name.';
	}
	else
	{
		$data['name'] = $name;
	}


	// Email
	if ( empty( $name ) || ! valid_email( $email ) )
	{
		$errors['email'] = 'Invalid email.';
	}
	else
	{
		$data['email'] = $email;
	}


	// Phone Number
	if ( empty( $phone) || ! valid_phone_number( $phone ) )
	{
		//$errors['phone'] = 'Invalid phone.';
		$errors['phone'] = $phone;
	}
	else
	{
		$data['phone'] = $phone;
	}


	// Address (Street)
	if( empty( $phone ) || ! is_string( $street ) )
	{
		$errors['street'] = 'Invalid street.';
	}
	else
	{
		$data['street'] = $street;
	}


	// Address (City)
	if( empty( $city ) || ! is_string( $city ) )
	{
		$errors['city'] = 'Invalid city.';
	}
	else
	{
		$data['city'] = $city;
	}


	// Address (State): we want to validate that in case they change the value on the client.
	// You can use the state helper
	if( empty( $state ) || ! valid_state( $state, 'code' ) )
	{
		$errors['state'] = 'Invalid state.';
	}
	else
	{
		$data['state'] = $state;
	}


	// Address (Zipcode)
	if( empty( $zip ) || ! valid_zipcode( $zip ) )
	{
		$errors['zip'] = 'Invalid zip.';
	}
	else
	{
		$data['zip'] = $zip;
	}


	// Goals
	if( empty( $goals ) || ! is_string( $goals ) )
	{
		$errors['goals'] = 'Invalid goals.';
	}
	else
	{
		$data['goals'] = $goals;
	}

	// Work History Section
	foreach ( $work_history as $index => $input_row )
	{
		$valid_row = TRUE;
		$row = [];


		$start_date 	= ( ! empty( $input_row['start_date'] ) ) 	? $input_row['start_date'] 		: '';
		$end_date		= ( ! empty( $input_row['end_date'] ) ) 	? $input_row['end_date'] 		: '';
		$position		= ( ! empty( $input_row['position'] ) ) 	? $input_row['position'] 		: '';
		$company		= ( ! empty( $input_row['company'] ) ) 		? $input_row['company'] 		: '';
		$description	= ( ! empty( $input_row['description'] ) ) 	? $input_row['description'] 	: '';

		// Example Error:
		// $errors['work_history'][ $index ]['{field}'] = '{message}';

		// If each section is empty, skip row.
		if( empty($start_date) && empty($end_date) && empty($position) && empty($company) && empty($description) )
		{
			continue;
		}

		// Start date
		if( empty($start_date) || ! valid_date($start_date) )
		{
			$errors['work_history'][$index]['start_date'] = 'Invalid start date.';
			$valid_row = FALSE;
		}
		else
		{
			// If start date is valid, create new DateTime object and validate end date.
			$start_date = new DateTime($start_date);
			$row['start_date'] = $start_date->format('M Y');
		}

		// End date
		if( empty($end_date) || ! valid_date($end_date) )
		{
			$errors['work_history'][$index]['end_date'] = 'Invalid end date.';
			$valid_row = FALSE;
		}
		else
		{
			$end_date = new DateTime($end_date);
			$row['end_date'] = $end_date->format('M Y');
		}

		// If dates are out of order, create errors for both date fields.
		if ( $valid_row && $start_date > $end_date )
		{
			$errors['work_history'][$index]['start_date'] = 'Invalid date range.';
			$errors['work_history'][$index]['end_date'] = 'Invalid date range.';
		}

		// Position
		if( empty($position) || ! is_string($position) )
		{
			$errors['work_history'][$index]['position'] = 'Invalid position.';
		}
		else
		{
			$row['position'] = $position;
		}

		// Company
		$row['company'] = $company;

		// Description
		$row['description'] = $description;


		if ( $valid_row )
		{
			$data['work_history'][ $index ] = $row;
		}
	}


	// Education Section
	// Thought: if each section in a row is empty (excluding type), then just ignore it? we don't need to force their hand to delete extra fields.
	foreach ( $education as $index => $input_row )
	{
		$valid_row = TRUE;
		$row = [];

		$type 				= ( ! empty( $input_row['type'] ) ) 				? $input_row['type'] 				: '';
		$name 				= ( ! empty( $input_row['name'] ) ) 				? $input_row['name'] 				: '';
		$start_date 		= ( ! empty( $input_row['start_date'] ) ) 			? $input_row['start_date'] 			: '';
		$end_date			= ( ! empty( $input_row['end_date'] ) ) 			? $input_row['end_date'] 			: '';
		$study_description 	= ( ! empty( $input_row['study_description'] ) ) 	? $input_row['study_description'] 	: '';
		$graduated			= isset( $input_row['graduated'] )	? TRUE : FALSE;


		// Type


		// School Name
		if ( empty( $name ) || ! valid_name( $name ) )
		{

		}

		// Start Date


		// End Date


		// Areas of Study Description



		if ( $valid_row )
		{
			$data['education'][ $index ] = $row;
		}
	}


	// Certifications & Skills Section
	foreach ( $certifications as $index => $input_row )
	{
		$valid_row = TRUE;
		$row = [];

		$title 			= ( ! empty( $input_row['title'] ) ) 			? $input_row['title'] 		: '';
		$description 	= ( ! empty( $input_row['description'] ) ) 	? $input_row['description'] 	: '';


		// Title


		// Description



		if ( $valid_row )
		{
			$data['certifications'][ $index ] = $row;
		}
	}


	// References Section
	foreach ( $references as $index => $input_row )
	{
		$valid_row = TRUE;
		$row = [];

		$name 				= ( ! empty( $input_row['name'] ) ) 				? $input_row['name'] 				: '';
		$phone 				= ( ! empty( $input_row['phone'] ) ) 				? $input_row['phone'] 				: '';
		$company 			= ( ! empty( $input_row['company'] ) ) 			? $input_row['company'] 				: '';
		$years_acquainted 	= ( ! empty( $input_row['years_acquainted'] ) ) 	? $input_row['years_acquainted'] 	: '';


		// Name
		if ( empty( $name ) || ! valid_name( $name ) )
		{
			$errors['references'][$index]['name'] = 'Invalid name.';
		}
		else
		{
			$row['name'] = $name;
		}

		// Phone
		if ( empty( $phone ) || ! valid_phone_number( $phone ) )
		{
			$errors['references'][$index]['phone'] = 'Invalid phone number.';
		}
		else
		{
			$row['phone'] = $phone;
		}

		// Company
		if ( empty( $company ) || ! vallid_name( $company ) )
		{
			$errors['references'][$index]['company'] = 'Invalid company name.';
		}
		else
		{
			$row['company'] = $company;
		}

		// Years Known
		if ( empty( $years_acquainted ) || ! valid_years_acquainted( $years_acquainted ) )
		{
			$errors['references'][$index]['years_acquainted'] = 'Invalid number of years.';
		}
		else
		{
			$row['years_acquainted'] = $years_acquainted;
		}


		if ( $valid_row )
		{
			$data['references'][ $index ] = $row;
		}
	}


	// If everything is valid, then we need to start building the HTML email components with the data.
	// placeholder: generate_html_email_content( $data );
}

// Temporary just for the sake of testing.
echo '<pre>'; print_r( $data ); echo '</pre>';
echo '<pre>'; print_r( $errors ); echo '</pre>';


?>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>
	* {
		box-sizing: border-box;
	}

	.resume-form label {
		display: block;
		margin-bottom: 0.125em;
	}

	.resume-form p {
		margin: 0;
	}

	.resume-form input[type='text'], .resume-form input[type='number'], .resume-form select, .ui-datepicker select, .resume-form textarea {
		background-color: #fff;
		border: 1px solid #999;
		color: #333;
		font-size: 1em;
		height: auto;
		line-height: normal;
		margin: 0;
		padding: 0.5em 0.5em;
		width: auto;
	}

	.resume-form textarea {
		width: 50%;
	}

	.resume-form section + section {
		margin-top: 2.5em;
	}

	.resume-form header h3 {
		font-size: 1.5em;
		margin: 0;
	}

	.resume-form .resume-table {
		border: none;
		margin: 0;
	}

	.resume-form td > input[type='text'] {
		max-width: 100%;
		width: 100%;
	}

	.resume-form th {
		padding: 0.5em;
		text-align: left;
	}

	.resume-form td {
		padding: 0.5em;
	}

	.resume-form td > input[type='text'], .resume-form input[type='number'] {
		margin: 0;
		width: 100%;
	}

	.resume-form td > input[type='text'].datepicker {
		width: 6em;
		text-align: center;
	}

	.resume-form select[name='state'] {
		background-position: 80% center;
		padding-right: 2em;
	}

	.resume-form td > select,  .ui-datepicker select {
		background-position: 95% center;
		margin: 0;
		padding-right: 2em;
	}

	.resume-form td > select {
		min-width: 100%;
	}

	.ui-datepicker select {
		background-position: 85% center;
	}


	.certification-control,
	.work-history-control,
	.education-control,
	.education-title,
	.education-date,
	.education-graduated,
	.references-control,
	.references-years-acquainted,
	.work-history-date {
		min-width: 2.675em;
		width: 1%;
		white-space: nowrap;
	}

	.education-graduated, .references-years-acquainted > input[type='number'] {
		text-align: center;
	}


	.references-phone-number,
	.form-personal-details .form-component .form-phone-number {
		width: 10em;
	}


	.certification-title {
		width: 300px;
	}

	.resume-table {
		margin: 0;
	}

	.resume-table, .resume-table tr, .resume-table th, .resume-table td {
		border: none;
	}

	.resume-table th {
		background-color: transparent;
		border-bottom: 2px solid #0738a8;
	}


	.resume-table tbody tr {
		border-bottom: 1px solid #ccc;
		border-left: 1px solid transparent;
		border-right: 1px solid transparent;
	}

	.resume-table tr:nth-child(even) {
		background-color: #efefef;
		border-color: #ccc;
	}

	.resume-table tr + tr {
		border-top: 1px solid #ccc;
	}

	button, .button {
		background-color: #fff;
		border: 1px solid #ccc;
		border-radius: 4px;
		cursor: pointer;
		color: #666;
		font-size: 1em;
		text-align: center;
		text-decoration: none;
	}

	button:not(.button-remove), .button {
		line-height: 1.375;
		padding: 0.5em 1em;

	}

	button:hover, .button:hover {
		background-color: #e5e5e5;
	}

	button:not(.button-remove):active, .button:active {
		-moz-box-shadow: inset 0 1px 3px 0 rgba(0, 0, 0, 0.25 );
		-webkit-box-shadow: inset 0 1px 3px 0 rgba(0, 0, 0, 0.25 );
		box-shadow: inset 0 1px 3px 0 rgba(0, 0, 0, 0.25 );
	}

	.button-small {
		font-size: 0.875em;
		line-height: 1.15;
	}

	.button-large {
		font-size: 1.25em;
		line-height: 1.3;
	}

	.button-block {
		display: block;
		width: 100%;
	}

	.resume-form .button-remove, .resume-form .button-remove:hover, .resume-form .button-remove:active {
		background-color: transparent;
		border: none;
		color: #a90000;
		font-size: 1.5em;
	}


	button.primary {
		background-color: #0738a8;
		border-color: #0738a8;
		color: #fff;
	}

	button.primary:hover {
		background-color: #0843c9;
	}

	button.secondary {
		background-color: #bebebe;
		border-color: #aaa;
		color: #333;
	}


	.flex-container {
		display: flex;
		justify-content: flex-start;
	}

	.flex-container > .form-component + .form-component,
	.flex-container > .form-group + .form-group {
		margin: 0 0 0 1em;
	}


	.form-personal-details {
		margin-right: 10em;
		width: 250px;
	}

	.form-phone-number {
		width: 10em;
	}

	.form-address {
		width: 40%;
	}

	.form-address .form-component input,
	.form-personal-details .form-component input {
		max-width: 100%;
		width: 100%;
	}

	.form-address .form-city {
		flex: 1 0 auto;
	}

	.form-address .form-zipcode {
		width: 4.5em;
	}


	.form-group + .form-group {
		margin-top: 2em;
	}

	.form-group > header {
		font-size: 16px;
		margin-bottom: 0.5em;
	}

	.form-component + .form-component,
	.form-component + button {
		margin-top: 1em;
	}


	.progress-step {
		border-left: 2px solid transparent;
		position: relative;
		margin: 0 0 0 1em;
		padding-left: 2em;
	}

	.progress-step:after {
		content: '';

		background-color: #fff;
		border: 2px solid #ccc;
		border-radius: 50%;


		position: absolute;
		top: 0;
		left: -1.125em;

		height: 2em;
		width: 2em;

	}

	.progress-step:not(:last-of-type) {
		border-color: #ccc;
		padding-bottom: 2em;
	}

	.progress-step + .progress-step {
		margin-top: 0;
	}




	.ui-datepicker-calendar
	{
		display: none;
	}

	.ui-datepicker-title {
		display: flex;
		justify-content: space-between;
	}

	.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
		top: auto;
		height: 44px;
	}
</style>

<div id="content">
	<div class="bluebartitle">
		<div class="wrap"></div>
	</div>

	<div id="inner-content" class="wrap cf">

		<div id="main" class="m-all cf" role="main">

			<div class="servicesnav">
			</div> <!-- /servicesnav -->

			<section class="entry-content cf" itemprop="articleBody">
			<h1>Resum&eacute; Builder</h1>
			<p>{verbiage}</p>

			<form action='' name="resume-builder" method='post' class='resume-form'>

				<article class='form-group progress-step'>
					<header>
						<h3>Personal Information</h3>
					</header>
					<section>
						<div class='flex-container form-component'>
							<div class='form-group form-personal-details'>
								<div class='form-component'>
									<label for="name">Name:</label>
									<input type="text" id="name" name="rb_name" value='<?php echo set_value( $data, 'name' ); ?>' required >
									<?php echo form_error( $errors, 'name' ); ?>
								</div>

								<div class='form-component'>
									<label for="email">Email:</label>
									<input type="text"  id="email" name="rb_email" value='<?php echo set_value( $data, 'email' ); ?>' required >
									<?php echo form_error( $errors, 'email' ); ?>
								</div>

								<div class='form-component'>
									<label for="phone">Phone Number:</label>
									<input type="text" id="phone" name="rb_phone" value='<?php echo set_value( $data, 'phone' ); ?>' class='form-phone-number' required>
									<?php echo form_error( $errors, 'phone' ); ?>
								</div>
							</div>

							<div class='form-group form-address'>
								<div class='form-component'>
									<label for="street">Street:</label>
									<input type="text" id="street"  name="rb_street"  value='<?php echo set_value( $data, 'street' ); ?>'>
									<?php echo form_error( $errors, 'street' ); ?>
								</div>

								<div class='form-component flex-container'>
									<div class='form-component form-city'>
										<label for="city" >City:</label>
										<input type="text" id="city" name="rb_city"  value='<?php echo set_value( $data, 'city' ); ?>'>
										<?php echo form_error( $errors, 'city' ); ?>
									</div>

									<div class='form-component form-state'>
										<label for="state">State:</label>
										<select id='state' name='rb_state'>
										<?php
										$state_codes = get_state_codes_array();
										$option_format = '<option value="{key}" {selected}>{value}</option>';
										$option_search = [ '{key}', '{value}', '{selected}' ];
										foreach ( $state_codes as $key => $val )
										{
											$selected = ( $key === set_value( $data, 'state', 'AR' ) ) ? 'selected="selected"' : '';
											$option_replace = [ $key, $val, $selected ];
											echo str_replace( $option_search, $option_replace, $option_format );
										}
										echo form_error( $errors, 'state' );
										/*
										?>

											<option value="AL">AL</option>
											<option value="AK">AK</option>
											<option value="AZ">AZ</option>
											<option value="AR" selected="selected">AR</option>
											<option value="CA">CA</option>
											<option value="CO">CO</option>
											<option value="CT">CT</option>
											<option value="DE">DE</option>
											<option value="FL">FL</option>
											<option value="GA">GA</option>
											<option value="HI">HI</option>
											<option value="ID">ID</option>
											<option value="IL">IL</option>
											<option value="IN">IN</option>
											<option value="IA">IA</option>
											<option value="KS">KS</option>
											<option value="KY">KY</option>
											<option value="LA">LA</option>
											<option value="ME">ME</option>
											<option value="MD">MD</option>
											<option value="MA">MA</option>
											<option value="MI">MI</option>
											<option value="MN">MN</option>
											<option value="MS">MS</option>
											<option value="MO">MO</option>
											<option value="MT">MT</option>
											<option value="NE">NE</option>
											<option value="NV">NV</option>
											<option value="NH">NH</option>
											<option value="NJ">NJ</option>
											<option value="NM">NM</option>
											<option value="NY">NY</option>
											<option value="NC">NC</option>
											<option value="ND">ND</option>
											<option value="OH">OH</option>
											<option value="OK">OK</option>
											<option value="OR">OR</option>
											<option value="PA">PA</option>
											<option value="RI">RI</option>
											<option value="SC">SC</option>
											<option value="SD">SD</option>
											<option value="TN">TN</option>
											<option value="TX">TX</option>
											<option value="UT">UT</option>
											<option value="VT">VT</option>
											<option value="VA">VA</option>
											<option value="WA">WA</option>
											<option value="WV">WV</option>
											<option value="WI">WI</option>
											<option value="WY">WY</option>
										<?php
										*/
										?>
										</select>
									</div>

									<div class='form-component form-zipcode'>
										<label for="zipcode">Zipcode:</label>
										<input type="text" id="zipcode" name="rb_zip"  value='<?php echo set_value( $data, 'zip' ); ?>' >
										<?php echo form_error( $errors, 'zip' ); ?>
									</div>
								</div>
							</div>
						</div>

						<div class='form-component'>
							<label for="goals">What do you want out of your career?</label>
							<textarea id='goals' name='rb_goals'><?php echo set_value( $data, 'goals' ); ?></textarea>
							<?php echo form_error( $errors, 'goals' ); ?>
						</div>
					</section>
				</article>

				<article class='form-group progress-step'>
					<header>
						<h3>Work History</h3>
					</header>
					<section>

						<p>{verbiage}</p>

						<table class='resume-table'>
							<thead>
								<tr>
									<th class='work-history-control'></th>
									<th class='work-history-date'>From</th>
									<th class='work-history-date'>To</th>
									<th class='work-history-position'>Position</th>
									<th class='work-history-company'>Company</th>
									<th class='work-history-description'>Job Description</th>
								</tr>
							</thead>
							<tfoot>
								<tr class='work-history'>
									<td class='work-history-control'></td>
									<td colspan='5'>
										<button type='button' class='secondary' name='add-row' >+ Add Row</button>
									</td>
								</tr>
							</tfoot>
							<tbody>
								<tr class='work-history-row'>
									<td class='work-history-control'>

									</td>
									<td class='work-history-date'>
										<input type='text' name='rb_work_history[0][start_date]' class='datepicker'>
									</td>
									<td class='work-history-date'>
										<input type='text' name='rb_work_history[0][end_date]' class='datepicker'>
									</td>

									<td class='work-history-position'>
										<input type='text' name='rb_work_history[0][position]' class=''>
									</td>

									<td class='work-history-company'>
										<input type='text' name='rb_work_history[0][company]' class=''>
									</td>

									<td class='work-history-description'>
										<input type='text' name='rb_work_history[0][description]' class=''>
									</td>
								</tr>

								<tr class='work-history-row'>
									<td class='work-history-control'>
										<button type='button' class='button-remove' name='remove-row'>&times;</button>
									</td>
									<td class='work-history-date'>
										<input type='text' name='rb_work_history[1][start_date]' class='datepicker'>
									</td>
									<td class='work-history-date'>
										<input type='text' name='rb_work_history[1][end_date]' class='datepicker'>
									</td>

									<td class='work-history-position'>
										<input type='text' name='rb_work_history[1][position]' class=''>
									</td>

									<td class='work-history-company'>
										<input type='text' name='rb_work_history[1][company]' class=''>
									</td>

									<td class='work-history-description'>
										<input type='text' name='rb_work_history[1][description]' class=''>
									</td>
								</tr>
							</tbody>
						</table>
					</section>
				</article>


				<article class='form-group progress-step'>
					<header>
						<h3>Education</h3>
					</header>
					<section>
						<p>{verbiage}</p>
						<table class='resume-table'>
							<thead>
								<tr>
									<th class='education-control'></th>
									<th class='education-type'>Type</th>
									<th class='education-school'>School</th>
									<th class='education-start-date'>From</th>
									<th class='education-end-date'>To</th>
									<th class='education-graduated'>Graduated?</th>
									<th class='education-studied'>Areas of Study</th>
								</tr>
							</thead>
							<tfoot>
								<tr class='education'>
									<td class='education-control'></td>
									<td colspan='6'>
										<button type='button' class='secondary' name='add-row' >+ Add Row</button>
									</td>
								</tr>
							</tfoot>
							<tbody>
								<tr class='education-row'>
									<td class='education-control'></td>

									<td class='education-title'>
										<select name='rb_education[0]["type"]'>
											<option value='high-school' >High School</option>
											<option value='college' >College</option>
											<option value='trade-school' >Trade/Business School</option>
										</select>
									</td>

									<td class='education-school'>
										<input type='text' name='rb_education[0][name]'>
									</td>

									<td class='education-date'>
										<input type='text' name='rb_education[0][start_date]' class='datepicker'>
									</td>

									<td class='education-date'>
										<input type='text' name='rb_education[0][end_date]' class='datepicker'>
									</td>


									<td class='education-graduated'>
										<input type='checkbox' name='rb_education[0][graduated]' value='1' class=''>
									</td>

									<td class='education-studied'>
										<input type='text' name='rb_education[0][study_description]' class=''>
									</td>
								</tr>

								<tr class='education-row'>
									<td class='education-control'>
										<button type='button' class='button-remove' name='remove-row'>&times;</button>
									</td>

									<td class='education-title'>
										<select name='rb_education[1]["type"]'>
											<option value='high-school' >High School</option>
											<option value='college' >College</option>
											<option value='trade-school' >Trade/Business School</option>
										</select>
									</td>

									<td class='education-school'>
										<input type='text' name='rb_education[1][name]'>
									</td>

									<td class='education-date'>
										<input type='text' name='rb_education[1][start_date]' class='datepicker'>
									</td>

									<td class='education-date'>
										<input type='text' name='rb_education[1][end_date]' class='datepicker'>
									</td>

									<td class='education-graduated'>
										<input type='checkbox' name='rb_education[1][graduated]' value='1' class=''>
									</td>

									<td class='education-studied'>
										<input type='text' name='rb_education[1][study_description]' class=''>
									</td>
								</tr>

								<tr class='education-row'>
									<td class='education-control'>
										<button type='button' class='button-remove' name='remove-row'>&times;</button>
									</td>

									<td class='education-title'>
										<select name='education[2]["type"]'>
											<option value='high-school' >High School</option>
											<option value='college' >College</option>
											<option value='trade-school' >Trade/Business School</option>
										</select>
									</td>

									<td class='education-school'>
										<input type='text' name='rb_education[2][name]'>
									</td>

									<td class='education-date'>
										<input type='text' name='rb_education[2][start_date]' class='datepicker'>
									</td>

									<td class='education-date'>
										<input type='text' name='rb_education[2][end_date]' class='datepicker'>
									</td>

									<td class='education-graduated'>
										<input type='checkbox' name='rb_education[2][graduated]' value='1'>
									</td>

									<td class='education-studied'>
										<input type='text' name='rb_education[2][study_description]' class=''>
									</td>
								</tr>
							</tbody>
						</table>
					</section>
				</article>

				<article class='form-group progress-step'>
					<header>
						<h3>Certifications &amp; Skills</h3>
					</header>
					<section>

						<p>{verbiage}</p>
						<table class='resume-table'>
							<thead>
								<tr>
									<th class='certification-control'></th>
									<th class='certification-title'>Title</th>
									<th class='certification-description'>Description</th>
								</tr>
							</thead>
							<tfoot>
								<tr class='certification'>
									<td class='certification-control'></td>
									<td colspan='2'>
										<button type='button' class='secondary' name='add-row' >+ Add Row</button>
									</td>
								</tr>
							</tfoot>
							<tbody>
								<tr class='certification-row'>
									<td class='certification-control'>

									</td>
									<td class='certification-title'>
										<input type='text' name='rb_certifications[0][title]' class=''>
									</td>
									<td class='certification-description'>
										<input type='text' name='rb_certifications[0][description]' class=''>
									</td>
								</tr>

								<tr class='certification-row'>
									<td class='certification-control'>
										<button type='button' class='button-remove' name='remove-row'>&times;</button>
									</td>
									<td class='certification-title'>
										<input type='text' name='rb_certifications[1][title]' class=''>
									</td>
									<td class='certification-description'>
										<input type='text' name='rb_certifications[1][description]' class=''>
									</td>
								</tr>
							</tbody>

						</table>
					</section>
				</article>

				<article class='form-group progress-step'>
					<header>
						<h3>References</h3>
					</header>
					<section>
						<p>{verbiage}</p>
						<table class='resume-table'>
							<thead>
								<tr>
									<th class='references-control'></th>
									<th class='references-name'>Name</th>
									<th class='references-phone-number'>Phone #</th>
									<th class='references-business'>Business</th>
									<th class='references-years-acquainted'>Years Acquainted</th>
								</tr>
							</thead>
							<tfoot>
								<tr class='references'>
									<td class='references-control'></td>
									<td colspan='4'>
										<button type='button' class='secondary' name='add-row' >+ Add Row</button>
									</td>
								</tr>
							</tfoot>
							<tbody>
								<tr class='references-row'>
									<td class='references-control'>
									</td>

									<td class='references-name'>
										<input type='text' name='rb_references[0][name]' class=''>
									</td>

									<td class='references-phone-number'>
										<input type='text' name='rb_references[0][phone]' class=''>
									</td>

									<td class='references-business'>
										<input type='text' name='rb_references[0][company]' class=''>
									</td>

									<td class='references-years-acquainted'>
										<input type='number' name='rb_references[0][years_acquainted]' min='0' step='0.5' >
									</td>
								</tr>

								<tr class='references-row'>
									<td class='references-control'>
										<button type='button' class='button-remove' name='remove-row'>&times;</button>
									</td>

									<td class='references-name'>
										<input type='text' name='rb_references[1][name]' class=''>
									</td>

									<td class='references-phone-number'>
										<input type='text' name='rb_references[1][phone]' class=''>
									</td>

									<td class='references-business'>
										<input type='text' name='rb_references[1][company]' class=''>
									</td>

									<td class='references-years-acquainted'>
										<input type='number' name='rb_references[1][years_acquainted]' min='0' step='0.5' >
									</td>
								</tr>
							</tbody>

						</table>
					</section>
				</article>

				<button type='submit' class='primary'>Create Resum&eacute;</button>
			</form>

			</section>

		</div> <!-- /main -->

	</div> <!-- /inner-content -->

</div> <!-- /content -->

<script>
$( function() {

	// Handle jQuery datepicker
	$( document ).on( 'focus', '.datepicker', function() {
		$(this).datepicker({
			dateFormat: "M yy",
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,

			onClose: function(dateText, inst)
			{
				function is_done_pressed()
				{
					return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
				}

				if (is_done_pressed())
				{
					var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
					var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
					$(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');

					$('.date-picker').focusout()//Added to remove focus from datepicker input box on selecting date
				}
			},

			beforeShow : function(input, inst)
			{
				inst.dpDiv.addClass('month_year_datepicker')

				if ((datestr = $(this).val()).length > 0)
				{
					year = datestr.substring(datestr.length-4, datestr.length);
					month = datestr.substring(0, 2);
					$(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
					$(this).datepicker('setDate', new Date(year, month-1, 1));
					$(".ui-datepicker-calendar").hide();
				}
			}
		});
	});

	// Event handler for removing a form row.
	$( 'form[name="resume-builder"]' ).on( 'click', 'button[name="remove-row"]', function() {
		remove_form_row( $(this).closest( 'tr' ) );
	});

	// Event handler for adding a form row.
	$( 'form[name="resume-builder"]' ).on( 'click', 'button[name="add-row"]', function() {

		var $row_type = $(this).closest( 'tr' ).attr( 'class' );
		var $tbody = $(this).closest( 'table' ).children( 'tbody' );

		// Extracts highest number from name of last input field
		var $input_name = $tbody.children( 'tr:last-child' ).find( 'input' )[0].name;
		var $row_number = parseInt( $input_name.match( /\d+/ )[0], 10 );

		var $row = generate_row( $row_type, $row_number + 1 );

		// Append the row to the table body.
		$tbody.append( $row );
	});

	// Event handler for phone number masking.
	$( document ).ready( function() {
		document.getElementById('phone').addEventListener('input', function (e) {
		  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
		  e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
		});
	});
});

var $remove_form_row_buttons = document.getElementsByName( 'remove-row' );

// jQuery function to remove a provided element.
function remove_form_row( $row )
{
	$row.remove();
}


// Add Row Logic
var $remove_row_button = '<button type="button" class="button-remove" name="remove-row">&times;</button>';
var $education_options = '<option value="high-school">High School</option>' +
						 '<option value="college">College</option>' +
						 '<option value="trade-school">Trade/Business School</option>';
var $row_config = {
	'work-history'	: [
		'<td class="work-history-control">' + $remove_row_button + '</td>',
		'<td class="work-history-date"><input type="text" name="rb_work_history[{row_number}][start_date]" class="datepicker"></td>',
		'<td class="work-history-date"><input type="text" name="rb_work_history[{row_number}][end_date]" class="datepicker"></td>',
		'<td class="work-history-position"><input type="text" name="rb_work_history[{row_number}][position]" class=""></td>',
		'<td class="work-history-company"><input type="text" name="rb_work_history[{row_number}][company]" class=""></td>',
		'<td class="work-history-description"><input type="text" name="rb_work_history[{row_number}][description]" class=""></td>'
	],
	'education'	: [
		'<td class="education-control">' + $remove_row_button + '</td>',
		'<td class="education-title"><select name="rb_education[{row_number}][type]" >' + $education_options + '</select></td>',
		'<td class="education-school"><input type="text" name="rb_education[{row_number}][name]" class=""></td>',
		'<td class="education-date"><input type="text" name="rb_education[{row_number}][start_date]" class="datepicker"></td>',
		'<td class="education-date"><input type="text" name="rb_education[{row_number}][end_date]" class="datepicker"></td>',
		'<td class="education-graduated"><input type="checkbox" name="rb_education[{row_number}][graduated]" value="1" class=""></td>',
		'<td class="education-studied"><input type="text" name="rb_education[{row_number}][study_description]" class=""></td>'
	],
	'certification'	: [
		'<td class="certification-control">' + $remove_row_button + '</td>',
		'<td class="certification-title"><input type="text" name="rb_certification[{row_number}][title]" class=""></td>',
		'<td class="certification-school"><input type="text" name="rb_certification[{row_number}][description]" class=""></td>'
	],
	'references'	: [
		'<td class="references-control">' + $remove_row_button + '</td>',
		'<td class="references-name"><input type="text" name="rb_references[{row_number}][name]" class=""></td>',
		'<td class="references-phone-number"><input type="text" name="rb_references[{row_number}][phone]" class=""></td>',
		'<td class="references-business"><input type="text" name="rb_references[{row_number}][company]" class=""></td>',
		'<td class="references-years-acquainted"><input type="number" name="rb_references[{row_number}][years_acquainted]" min="0" step="0.5"></td>',
	],
};

// Genereate Row Element with Contents
function generate_row( $row_type, $row_count )
{
	// Create a new TR element to return.
	var $row = document.createElement( 'tr' );

	// Check to make sure we have a valid use-case.
	if ( $row_config[ $row_type ] !== 'undefined' && $row_config[ $row_type ].length )
	{
		// Set the row name.
		$row.className = $row_type + '-row';

		// Loop through each of the corresponding cells from the config file.
		// Replace string with matching row number and then append child to the row.
		$.each( $row_config[ $row_type ], function( index, value ) {

			$row.appendChild( $( value.replace( '{row_number}', $row_count ) )[0] );

		});
	}

	return $row;
}

</script>


<?php

// --------------------------------------------------------------------

// quick function for setting the value of a field? need to play with for arrays.
function set_value( $data_array = [], $field = '', $default = '' )
{
	if ( ! isset( $data_array[ $field ] ) )
	{
		return $default;
	}

	return $data_array[ $field ];
}

// --------------------------------------------------------------------

// not sure how these would work with the dynamic arrays, really? need to play with.
function form_error( $error_array = [], $field = '', $prefix = '', $suffix = '' )
{
	if ( empty( $error_array[ $field ] ) )
	{
		return '';
	}

	// Set defaults for prefix/suffix?

	return $prefix . $error_array[ $field ] . $suffix;
}

// --------------------------------------------------------------------

/**
 * Clean Input Data (stolen from codeigniter)
 *
 * Internal method that aids in escaping data and
 * standardizing newline characters to PHP_EOL.
 *
 * @param	string|string[]	$str	Input string(s)
 * @return	string
 */
function _clean_input_data( $value )
{
	// recursive checking
	if ( is_array( $value ) )
	{
		$new_array = [];
		foreach ( array_keys( $value ) as $key )
		{
			$new_array[ $key ] = _clean_input_data( $value[ $key ] );
		}
		return $new_array;
	}

	// Remove control characters
	$value = remove_invisible_characters( $value, FALSE );

	// CUSTOM: let's go ahead and tell it to TRIM the data too?
	$value = trim( $value );

	return $value;
}

// --------------------------------------------------------------------

/**
 * Clean Keys
 *
 * Internal method that helps to prevent malicious users
 * from trying to exploit keys we make sure that keys are
 * only named with alpha-numeric text and a few other items.
 *
 * @param	string	$str	Input string
 * @param	bool	$fatal	Whether to terminate script exection
 *				or to return FALSE if an invalid
 *				key is encountered
 * @return	string|bool
 */
function _clean_input_keys( $str, $fatal = TRUE )
{
	if ( ! preg_match('/^[a-z0-9:_\/|-]+$/i', $str ) )
	{
		if ( $fatal === TRUE )
		{
			return FALSE;
		}
	}

	return $str;
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @param	string
 * @param	bool
 * @return	string
 */
function remove_invisible_characters( $str, $url_encoded = TRUE )
{
	$non_displayables = array();

	// every control character except newline (dec 10),
	// carriage return (dec 13) and horizontal tab (dec 09)
	if ($url_encoded)
	{
		$non_displayables[] = '/%0[0-8bcef]/i';	// url encoded 00-08, 11, 12, 14, 15
		$non_displayables[] = '/%1[0-9a-f]/i';	// url encoded 16-31
	}

	$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

	do
	{
		$str = preg_replace($non_displayables, '', $str, -1, $count);
	}
	while ($count);

	return $str;
}


// --------------------------------------------------------------------

/**
 * Valid Email
 *
 * @param	string
 * @return	bool
 */
function valid_email( $str )
{
	return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
}

// --------------------------------------------------------------------

/**
 * Valid Name
 *
 * @param	string
 * @return	bool
 */
function valid_name( $str )
{
	return (bool) preg_match('/^[a-zA-Z\'\-\040]+$/i', $str );
}


// ------------------------------------------------------------------------

/**
 * Valid zip code
 *
 *@param  string
 *@return bool
 */
function valid_zipcode( $str )
{
	return (bool) preg_match( '/^\d{5}(-\d{4})?$/', $str );
}

// ------------------------------------------------------------------------

/**
 * Valid years acquainted
 *
 * Returns true if $str is numberic, between 1 and 99
 *
 *@param  string
 *@return bool
 */
function valid_years_acquainted( $str )
{
	return (bool) preg_match( '/^(0?[1-9]|[1-9][0-9])$/', $str );
}

// ------------------------------------------------------------------------

/**
 * Valid phone number
 *
 *@param  string
 *@return bool
 */
function valid_phone_number( $str )
{
	$clean_phone = preg_replace('/[^0-9]/', '', strval($str) );
	return (bool) (strlen($clean_phone) >= 7);
}

// ------------------------------------------------------------------------

/**
 * Valid Date
 *
 * Checks whether the value is a valid date according to the strtotime
 * PHP function.
 *
 * @param	string	$str
 * @return	bool
 */
function valid_date( $str )
{
	/*
	if ( ! is_string( $str ) || ! is_numeric( $str ) ||  strtotime( $str ) === FALSE )
	{
		return FALSE;
	}*/

	if ( ! is_string( $str ) )
	{
		echo "not string";
		return FALSE;
	}
	else if ( strtotime( $str ) === FALSE )
	{
		echo "not time";
		return FALSE;
	}

	$date = date_parse( $str );
	//var_dump($date);
	return checkdate($date['month'], 1, $date['year']);
}

// ------------------------------------------------------------------------

/**
 * Check for valid state
 *
 * Check to see if a provided state exists, with option to select a
 * specific format to validate against.
 *
 * @param	string	$string 	State Code or Full State Name
 * @param	string	$mode 		'code', 'name', 'both'
 * @return	bool
 */
function valid_state( $string, $mode = 'both' )
{
	$valid 	= FALSE;
	$states = get_states_array();

	if ( $mode === 'code' )
	{
		$valid = array_key_exists( strtoupper( $string ), $states );
	}
	elseif ( $mode === 'name' )
	{
		$valid = in_array( ucwords( strtolower( $string ) ), $states );
	}
	elseif ( $mode === 'both' )
	{
		$valid = valid_state( $string, 'code' ) || valid_state( $string, 'name' );
	}

	return $valid;
}

// ------------------------------------------------------------------------

/**
 * Get State Array
 *
 * Return an associated array of states with their abbreviation as the key.
 *
 * @return	array
 */
function get_states_array()
{
	$state_list = [
		'AL' => 'Alabama',
		'AK' => 'Alaska',
		'AZ' => 'Arizona',
		'AR' => 'Arkansas',
		'CA' => 'California',
		'CO' => 'Colorado',
		'CT' => 'Connecticut',
		'DE' => 'Delaware',
		'FL' => 'Florida',
		'GA' => 'Georgia',
		'HI' => 'Hawaii',
		'ID' => 'Idaho',
		'IL' => 'Illinois',
		'IN' => 'Indiana',
		'IA' => 'Iowa',
		'KS' => 'Kansas',
		'KY' => 'Kentucky',
		'LA' => 'Louisiana',
		'ME' => 'Maine',
		'MD' => 'Maryland',
		'MA' => 'Massachusetts',
		'MI' => 'Michigan',
		'MN' => 'Minnesota',
		'MS' => 'Mississippi',
		'MO' => 'Missouri',
		'MT' => 'Montana',
		'NE' => 'Nebraska',
		'NV' => 'Nevada',
		'NH' => 'New Hampshire',
		'NJ' => 'New Jersey',
		'NM' => 'New Mexico',
		'NY' => 'New York',
		'NC' => 'North Carolina',
		'ND' => 'North Dakota',
		'OH' => 'Ohio',
		'OK' => 'Oklahoma',
		'OR' => 'Oregon',
		'PA' => 'Pennsylvania',
		'RI' => 'Rhode Island',
		'SC' => 'South Carolina',
		'SD' => 'South Dakota',
		'TN' => 'Tennessee',
		'TX' => 'Texas',
		'UT' => 'Utah',
		'VT' => 'Vermont',
		'VA' => 'Virginia',
		'WA' => 'Washington',
		'WV' => 'West Virginia',
		'WI' => 'Wisconsin',
		'WY' => 'Wyoming'
	];

	return $state_list;
}

// ------------------------------------------------------------------------

/**
 * Get State Codes Array
 *
 * Return an associated array of states with their abbreviation as
 * the key and value.
 *
 * @return	array
 */
function get_state_codes_array()
{
	$state_code_list = [
		'AL' => 'AL',
		'AK' => 'AK',
		'AZ' => 'AZ',
		'AR' => 'AR',
		'CA' => 'CA',
		'CO' => 'CO',
		'CT' => 'CT',
		'DE' => 'DE',
		'FL' => 'FL',
		'GA' => 'GA',
		'HI' => 'HI',
		'ID' => 'ID',
		'IL' => 'IL',
		'IN' => 'IN',
		'IA' => 'IA',
		'KS' => 'KS',
		'KY' => 'KY',
		'LA' => 'LA',
		'ME' => 'ME',
		'MD' => 'MD',
		'MA' => 'MA',
		'MI' => 'MI',
		'MN' => 'MN',
		'MS' => 'MS',
		'MO' => 'MO',
		'MT' => 'MT',
		'NE' => 'NE',
		'NV' => 'NV',
		'NH' => 'NH',
		'NJ' => 'NJ',
		'NM' => 'NM',
		'NY' => 'NY',
		'NC' => 'NC',
		'ND' => 'ND',
		'OH' => 'OH',
		'OK' => 'OK',
		'OR' => 'OR',
		'PA' => 'PA',
		'RI' => 'RI',
		'SC' => 'SC',
		'SD' => 'SD',
		'TN' => 'TN',
		'TX' => 'TX',
		'UT' => 'UT',
		'VT' => 'VT',
		'VA' => 'VA',
		'WA' => 'WA',
		'WV' => 'WV',
		'WI' => 'WI',
		'WY' => 'WY'
	];

	return $state_code_list;
}
?>
