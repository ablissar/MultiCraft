<!-- Validation -->
<?php
	// Array to hold validated data
	$data = [];
	// Array to hold any generated errors
	$errors = [];

	$work_history = [];
	$work_history_errors = [];
	$education = [];
	$certifications = [];
	$references = [];

	// Returns true if date is invalid
	function invalid_date( $input_date )
	{
		$input_date = explode( '/', $input_date);
		$month = $input_date[0];
		$year = $input_date[1];

		// Since these dates don't have a day associated with them, but checkdate
		// requires a day, use 1 as stand-in.
		return !checkdate( $month, 1, $year );
	}

	// Returns true if phone number is invalid
	function invalid_phone( $input_phone )
	{
		// Strip variable of all non-numeric characters
		$input_phone = preg_replace("/[^0-9]/", "", strval($input_phone) );

		// Check length of phone number
		return strlen( strval($input_phone) ) == 10;
	}

	// Returns true if street is invalid
	function invalid_street( $input_street )
	{
		$containsLetter = preg_match('/[a-zA-Z]/', strval($_POST['street']) );
		$containsNumber = preg_match('/\d/', strval($_POST['street']) );

		// Checks that input contains at least one letter and one number
		return (!$containsLetter || !$containsNumber);
	}

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		// Check for empty name
		if( empty($_POST['name']) ) {
			$errors['name'] = "The name field is required.";
		}
		// Check if name contains only letters and spaces
		else if( ctype_alpha(str_replace(' ', '', $_POST['name'])) == false ) {
			$errors['name'] = "The name field must be a valid name.";
		}
		// Name is valid
		else {
			$data['name'] = trim($_POST['name']);
		}

		// Check for empty email
		if( empty($_POST['email']) ) {
			$errors['email'] = "The email field is required.";
		}
		// Use php filter to validate email
		else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
			$errors['email'] = "The email field must be a valid email.";
		}
		// Email is valid
		else {
			$data['email'] = trim($_POST['email']);
		}

		// Check for empty phone number
		if( empty($_POST['phone']) ) {
			$errors['phone'] = "The phone number field is required.";
		}
		// Check that phone number is 10 numeric digits
		else if( invalid_phone($_POST['phone']) ) {
			$errors['phone'] = "The phone number field must be a valid phone number.";
		}
		// Phone is valid
		else {
			$data['phone'] = trim($phone);
		}

		// Check for empty street
		if( empty($_POST['street']) ) {
			$errors['street'] = "The street field is required.";
		}
		// Check that street has at least one letter and one number
		else if( invalid_street($_POST['street']) ) {
			$errors['street'] = "The street field is invalid.";
		}
		// Street is valid
		else {
			$data['street'] = trim($_POST['street']);
		}

		// Check for empty city
		if( empty($_POST['city']) ) {
			$errors['city'] = "The city field is required.";
		}
		// Check that city contains only letters and spaces
		else if( ctype_alpha(str_replace(' ', '', $_POST['city'])) == false ) {
			$errors['city'] = "The city field is invalid.";
		}
		// City is valid
		else {
			$data['city'] = trim($_POST['city']);
		}

		// Check for empty zip code
		if( empty($_POST['zip']) ) {
			$errors['zip'] = "The zip code field is required.";
		}
		// Check that zip code contains five numeric digits
		else if( !is_numeric($_POST['zip']) || strlen( strval($_POST['zip']) ) != 5  ) {
			$errors['zip'] = "The zip code field is invalid.";
		}
		// Zip code is valid
		else {
			$data['zip'] = trim($_POST['zip']);
		}

		// Work history validation
		if( empty($_POST['work_history']) ) {
			$work_history = NULL;
		}
		else {
			foreach( $_POST['work_history'] as $row_index => $row)
			{
				$start_date = ( !empty($row['start_date']) ) ? $row['start_date'] : NULL;
				$end_date = ( !empty($row['end_date']) ) ? $row['end_date'] : NULL;
				$company = ( !empty($row['company']) ) ? $row['company'] : NULL;
				$position = ( !empty($row['position']) ) ? $row['position'] : NULL;
				$description = ( !empty($row['description']) ) ? $row['description'] : NULL;

				$work_history_is_valid = true;

				// Validate start date
				if( empty($start_date) ) {
					$work_history_errors[$row_index]['start_date'] = "The start date field is required.";
					$work_history_is_valid = false;
				}
				else if( invalid_date($start_date) ) {
					$work_history_errors[$row_index]['start_date'] = "The start date field is invalid.";
					$work_history_is_valid = false;
				}
				else {
					$work_history[$row_index]['start_date'] = trim($start_date);
				}

				// Validate end date
				if( empty($end_date) ) {
					$work_history_errors[$row_index]['end_date'] = "The end date field is required.";
					$work_history_is_valid = false;
				}
				else if( invalid_date($end_date) ) {
					$work_history_errors[$row_index]['end_date'] = "The end date field is invalid.";
					$work_history_is_valid = false;
				}
				else {
					$work_history[$row_index]['end_date'] = trim($end_date);
				}

				// Validate company
				if( empty($company) ) {
					$work_history_errors[$row_index]['company'] = "The company field is required.";
					$work_history_is_valid = false;
				}
				else if( !is_string($company) ) {
					$work_history_errors[$row_index]['company'] = "The company field is invalid.";
					$work_history_is_valid = false;
				}
				else {
					$work_history[$row_index]['company'] = trim($company);
				}

				// Validate position
				if( empty($position) ) {
					$work_history_errors[$row_index]['position'] = "The position field is required.";
					$work_history_is_valid = false;
				}
				else if( !is_string($position) ) {
					$work_history_errors[$row_index]['position'] = "The position field is invalid.";
					$work_history_is_valid = false;
				}
				else {
					$work_history[$row_index]['position'] = trim($position);
				}

				// Validate description
				if( empty($description) ) {
					$work_history_errors[$row_index]['description'] = "The description field is required.";
					$work_history_is_valid = false;
				}
				else if( !is_string($description) ) {
					$work_history_errors[$row_index]['description'] = "The description field is invalid.";
					$work_history_is_valid = false;
				}
				else {
					$work_history[$row_index]['description'] = trim($description);
				}

				if( $work_history_is_valid ) {
					$data['work_history'] = $work_history;
				}
				$errors['work_history'] = $work_history_errors;
			}
		}

		/*
		echo "<pre>";
		print_r($data);
		print_r($errors);
		echo "</pre>";
		*/

	}
 ?>
