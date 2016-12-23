<!DOCTYPE HTML>
<?php
    session_start();
    include('header.php');

    // === Server-side validation ===
    // First check that variables are set (form has been submitted).
    if( isset($_POST["name"]) ) {
        if( isset($_POST["gender"]) ) {
            // Then, sanitize each input field (sanitizeInput() can be found in 'header.php').
            $name = sanitizeInput($_POST["name"]);
            $gender = sanitizeInput($_POST["gender"]);
            $birthdate = sanitizeInput($_POST["birthdate"]);

            // Checks that each field meets minimum length requirement.
            if( strlen($name) == 0 || strlen($gender) == 0 || strlen($birthdate) == 0 ) {
                echo("Error: Some fields do not meet minimum length requirement.");
            }
            // If everything is valid, save info to session and move to next page.
            else {
                $_SESSION["name"] = $name;
                $_SESSION["gender"] = $gender;
                $_SESSION["birthdate"] = $birthdate;
                Header("Location: contactInfoForm.php");
            }
        }
        else {
            echo("Error: Some fields not set.");
        }
    }
 ?>

<html>
    <title>Basic Info Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>Basic Info Form</h1>
        <div>
        <form action="userInfoForm.php" method="post" name="form" >
            <label> Name: </label> <br />
                <input type="text" name="name" value="<?php echoVar('name')?>"/> <br />
            <label> Gender: </label> <br />
                Male: <input type="radio" name="gender" value="Male" />
                Female: <input type="radio" name="gender" value="Female" />
                Other: <input type="radio" name="gender" value="Other" /> <br />
            <label> Birthdate: </label> <br />
                <input type="text" name="birthdate" value="<?php echoVar('birthdate')?>" /> <br />
            <input type="submit" value="Submit" />
            <input type="button" onclick="location.href='form.php';" value="Go Back" />
        </form>
        </div>
    </body>
</html>
