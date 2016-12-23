<!DOCTYPE html>

<!-- Reset handling and server-side validation -->
<?php
    session_start();
    include('header.php');

    // If previous form hasn't been completed, return to it
    // Comment out for debugging individual page
    if( !isset($_SESSION["username"]) ) {
        Header("Location: form.php");
    }

    // Check if reset button has been pressed
    if( isset($_POST["reset"]) ) {
        unset($_SESSION["name"]);
        unset($_SESSION["gender"]);
        unset($_SESSION["birthdate"]);
    }

    // === Server-side validation ===
    // First check that variables are set (form has been submitted).
    if( isset($_POST["name"]) ) {
        if( isset($_POST["gender"]) ) {
            // Then, sanitize each input field (sanitizeInput() can be found in 'header.php').
            $name = sanitizeInput($_POST["name"]);
            $gender = sanitizeInput($_POST["gender"]);
            $birthdate = sanitizeInput($_POST["birthdate"]);

            // Checks that each field meets minimum length requirement.
            if( strlen($name) == 0 || strlen($gender) == 0 || strlen($birthdate) != 10 ) {
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

<!--- Client-side validation -->
<script>
     // Note: all fields are required by browser, and so are assumed to be non-null.
     function validateForm() {
         var birthdate = document.forms["form"]["birthdate"].value;

         // Checks that birthdate format is correct (only needed for Firefox).
         if( -1 == birthdate.indexOf("-") ) {
             document.getElementById("birthWarning").innerHTML = "Warning: incorrect format.";
             return false;
         }
         birthdate = birthdate.split("-");
         if( birthdate.length < 3 ) {
             document.getElementById("birthWarning").innerHTML = "Warning: incorrect format.";
             return false;
         }
         if( birthdate[0].length != 4 || birthdate[1].length != 2 || birthdate[2].length != 2
                || isNaN(birthdate[0]) || isNaN(birthdate[1]) || isNaN(birthdate[2]) ) {
             document.getElementById("birthWarning").innerHTML = "Warning: incorrect format.";
             return false;
         }

         return true;
     }
 </script>

<!-- Form -->
<html>
    <title>Basic Information</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>Basic Information</h1>
        <div class="clearfix">
        <form action="userInfoForm.php" method="post" name="form" onsubmit="return validateForm()" >
            <label> Name: </label> <br />
                <input type="text" name="name" value="<?php echoVar('name')?>" required/> <br />
            <label> Gender: </label> <br />
                Male: <input type="radio" name="gender" value="Male" required/>
                Female: <input type="radio" name="gender" value="Female" />
                Other: <input type="radio" name="gender" value="Other" /> <br />
            <label> Birthdate: </label>
                <img onmouseover="showObj(document.getElementById('birthHint'))" onmouseout="hideObj(document.getElementById('birthHint'))" src="hint.jpeg" height="20px" width="20px"/> <br />
                <p style="display:none" id="birthHint"> Format: yyyy-mm-dd <br /> </p>
                <input type="date" name="birthdate" value="<?php echoVar('birthdate')?>" required/> <br />
                <p id="birthWarning">  </p>
            <input type="submit" value="Submit" />
        </form>
        <!-- Form with hidden input to reset fields. -->
        <form action="userInfoForm.php" method="post" name="resetForm">
            <input type="hidden" name="reset" value="true" />
            <input type="button" onclick="location.href='form.php';" value="Go Back" />
            <input type="submit" value="Reset" class="reset"/>
        </form>
        <p> Page 2 of 3 </p>
        </div>
    </body>
</html>
