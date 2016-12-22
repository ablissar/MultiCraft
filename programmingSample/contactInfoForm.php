<!DOCTYPE html>
<?php
    session_start();
    include('header.php');

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
        if( strlen($email) == 0 || strlen($phone) == 0 || strlen($street) == 0
            || strlen($city) == 0 || strlen($state) == 0 || strlen($zip) == 0 ) {
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

<html>
    <title>Contact Info Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>Contact Info Form</h1>
        <div>
        <form action="contactInfoForm.php" method="post" name="form" >
            <label> Email: </label> <br /> <input type="email" name="email" /> <br />
            <label> Phone Number: </label> <br /> <input type="text" name="phone" /> <br />
            <label> Address: </label> <br />
            Street/Apartment: <br /> <input type="text" name="street" /> <br />
            City: <br /> <input type="text" name="city" /> <br />
            State: <br /> <input type="text" name="state" /> <br />
            Zip Code: <br /> <input type="text" name="zip" /> <br />
            <input type="submit" value="Submit" />
            <input type="button" onclick="location.href='userInfoForm.php';" value="Go Back" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
