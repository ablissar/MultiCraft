<!DOCTYPE html>

<!-- Reset handling and server-side validation -->
<?php
    session_start();
    include('header.php');

    // If previous form hasn't been completed, return to it
    // Comment out for debugging individual page
    if( !isset($_SESSION["name"]) ) {
        Header("Location: userInfoForm.php");
    }

    // === Server-side validation ===
    // First check that variables are set (form has been submitted).
    if( isset($_POST["email"]) ) {
        // Then, sanitize each input field (sanitizeInput() can be found in 'header.php').
        $email = sanitizeInput($_POST["email"]);
        $phone = sanitizeInput($_POST["phone"]);
        $street = sanitizeInput($_POST["street"]);
        $city = sanitizeInput($_POST["city"]);
        $state = sanitizeInput($_POST["state"]);
        $zip = sanitizeInput($_POST["zip"]);

        // Checks that each field meets minimum length requirement.
        if( strlen($email) == 0 || strlen($phone) != 10 || strlen($street) == 0
            || strlen($city) == 0 || strlen($state) != 2 || strlen($zip) !=  5) {
            echo("Error: Some fields do not meet minimum length requirement.");
        }
        // If everything is valid, save info to session and move to next page.
        else {
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;
            $_SESSION["street"] = $street;
            $_SESSION["city"] = $city;
            $_SESSION["state"] = $state;
            $_SESSION["zip"] = $zip;
            Header("Location: database.php");
        }
    }
 ?>

<!--- Client-side validation -->
<script>
     // Note: all fields are required by browser, and so are assumed to be non-null.
     function validateForm() {
         var city = document.forms["form"]["city"].value;
         var state = document.forms["form"]["state"].value;
         var zip = document.forms["form"]["zip"].value;
         var valid = true;
         clearWarnings(["phone", "city", "state", "zip"]);

         valid = validatePhone();

         // Checks that city is not a number.
         if( !isNaN(city) ) {
             document.getElementById("cityWarning").innerHTML = "Warning: city must contain text.";
             valid = false;
         }
         // Checks that state code is valid.
         if( state.length != 2 || !isNaN(state[0]) || !isNaN(state[1]) ) {
             document.getElementById("stateWarning").innerHTML = "Warning: invalid state.";
             valid = false;
         }
         // Checks that zip is valid.
         if( zip.length != 5 || isNaN(zip) ) {
             document.getElementById("zipWarning").innerHTML = "Warning: invalid zip code.";
             valid = false;
         }
         if(valid) return true;
         else return false;
     }

     function validatePhone() {
         var phone = document.forms["form"]["phone"].value;
         var valid = true;
         // Checks phone number is a nubmer.
         if( isNaN(phone) ) {
             document.getElementById("phoneWarning").innerHTML = "Warning: phone number must not contain any non-numerical characters.";
             valid = false;
         }
         // Checks phone number length.
         if( phone.length != 10 ) {
             document.getElementById("phoneWarning").innerHTML = "Warning: phone number must be 10 digits.";
             valid = false;
         }
         if(valid) return true;
         else return false;
     }
 </script>

<!-- Form -->
<html>
    <title>Contact Information</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>Contact Info Form</h1>
        <div class="clearfix">
        <form action="contactInfoForm.php" method="post" name="form" onsubmit="return validateForm()">
            <label> Email: </label> <br />
                <input type="email" name="email" required/> <br />
            <label> Phone Number: </label>
                <img onmouseover="showObj(document.getElementById('phoneHint'))" onmouseout="hideObj(document.getElementById('phoneHint'))" src="hint.jpeg" height="20px" width="20px"/> <br />
                <p style="display:none" id="phoneHint"> 10 digits, format: ########## <br /> </p>
                <input type="text" name="phone" required/> <br />
                <p id="phoneWarning"></p>
            <label> Address: </label> <br />
                Street/Apartment: <br />
                    <input type="text" name="street" required/> <br />
                City: <br />
                    <input type="text" name="city" required/> <br />
                    <p id="cityWarning" > </p>
                State:
                    <img onmouseover="showObj(document.getElementById('stateHint'))" onmouseout="hideObj(document.getElementById('stateHint'))" src="hint.jpeg" height="20px" width="20px"/> <br />
                    <p style="display:none" id="stateHint"> 2 letter code (ex: AL) <br /> </p>
                    <input type="text" name="state" required/> <br />
                    <p id="stateWarning" > </p>
                Zip Code: <br />
                    <input type="text" name="zip" required/> <br />
                    <p id="zipWarning" > </p>
            <input type="submit" value="Submit" />
        </form>
        <!-- Form with hidden input to reset fields. -->
        <form action="contactInfo.php" method="post" name="resetForm">
            <input type="hidden" name="reset" value="true" />
            <input type="button" onclick="location.href='userInfoForm.php';" value="Go Back" />
            <input type="submit" value="Reset" class="reset"/>
        </form>
        <p> Page 3 of 3 </p>
        </div>
    </body>
</html>
