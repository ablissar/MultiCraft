<!DOCTYPE html>

<!-- Reset handling and server-side validation -->
<?php
    session_start();
    include('header.php');

    // Check if reset button has been pressed
    if( isset($_POST["reset"]) ) {
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
    }

    // Server-side validation
    // First check that variables are set (form has been submitted).
    if( isset($_POST["username"]) ) {
        // Then, sanitize each input field (sanitizeInput() can be found in 'header.php').
        $username = sanitizeInput($_POST["username"]);
        $password = sanitizeInput($_POST["password"]);
        $passwordConfirm = sanitizeInput($_POST["passwordConfirm"]);

        // Checks that each field meets minimum length requirement.
        if( strlen($username) == 0 || strlen($password) < 8 || strlen($passwordConfirm) == 0 ) {
            echo("Error: Some fields do not meet minimum length requirement.");
        }
        // Checks that password matches confirmation field.
        else if( $password != $passwordConfirm ) {
            echo ("Error: Passwords must match.");
        }
        /* Check for password complexity.
        else if( preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) ) {
            echo ("Error: Password must contain at least one letter and one number.");
        }*/
        // If everything is valid, save info to session and move to next page.
        else {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            Header("Location: userInfoForm.php");
        }
    }
 ?>

<!--- Client-side validation -->
<script>
    // Note: all fields are required by browser, and so are assumed to be non-null.
    function validateForm() {
        var password = document.forms["form"]["password"].value;
        var passwordConfirm = document.forms["form"]["passwordConfirm"].value;
        var valid = true;

        // Checks that passwords are equal.
        if( password != passwordConfirm ) {
            document.getElementById("passwordWarning").innerHTML = "Warning: passwords must match.";
            valid = false;
        }
        // Checks that password meets length requirements.
        if( password.length < 8) {
            document.getElementById("passwordWarning").innerHTML = "Warning: password is too short.";
            valid = false;
        }
        if(valid) return true;
        else return false;
    }
</script>

<!-- Form -->
<html>
    <title>User Registration Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>User Registration Form</h1>
        <div class="clearfix">
        <form action="form.php" method="post" name="form" onsubmit="return validateForm()">
            <label> Username: </label> <br />
                <input type="text" name="username" value="<?php echoVar('username')?>" required/> <br />
                <p id="usernameWarning"></p>
            <label> Password: </label>
                <img onmouseover="showObj(document.getElementById('passHint'))" onmouseout="hideObj(document.getElementById('passHint'))" src="hint.jpeg" height="20px" width="20px"/> <br />
                <p style="display:none" id="passHint"> Password must be greater than 8 characters and contain at least one letter and one number. <br /> </p>
                <input type="password" name="password" value="<?php echoVar('password')?>" required/> <br />
                <p id="passwordWarning"></p>
            <label> Confirm Password: </label> <br />
                <input type="password" name="passwordConfirm" required/> <br />
            <input type="submit" value="Submit"/>
        </form>
        <!-- Form with hidden input to reset fields. -->
        <form action="form.php" method="post" name="resetForm">
            <input type="hidden" name="reset" value="true" />
            <input type="submit" value="Reset" class="reset" />
        </form>
        </div>
    </body>
</html>
