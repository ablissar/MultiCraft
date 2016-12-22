<!DOCTYPE HTML>
<?php
    session_start();
    // Server-side validation for info from last form

    // If the variables are unset, return to previous page and set error flag.
    if( !isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["passwordConfirm"]) ) {
        $_SESSION["emptyFields"] = true;
        Header("Location: form.php");
    }
    // If they are set, sanitize them.
    else {
        $username = sanitizeInput($_POST["username"]);
        $password = sanitizeInput($_POST["password"]);
        $passwordConfirm = sanitizeInput($_POST["passwordConfirm"]);
    }

    // Checks that each field meets minimum length requirement.
    if( strlen($username) == 0 || strlen($password) < 8 || strlen($passwordConfirm) == 0 ) {
        $_SESSION["emptyFields"] = true;
        Header("Location: form.php");
    }
    // Checks that password matches confirmation field.
    else if( $password != $passwordConfirm ) {
        $_SESSION["passwordMismatch"] = true;
        Header("Location: form.php");
    }
    // If everything is valid, set error flags to false and save info to session.
    else {
        $_SESSION["emptyFields"] = false;
        $_SESSION["passwordMismatch"] = false;
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

    }

    function sanitizeInput($input) {
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
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
        <form action="contactInfoForm.php" method="post" name="form" >
            <label> Email: </label> <br /> <input type="email" name="email" /> <br />
            <label> Name: </label> <br /> <input type="text" name="name" /> <br />
            <label> Gender: </label> <br />
            Male: <input type="radio" name="gender" value="Male" />
            Female: <input type="radio" name="gender" value="Female"  />
            Other: <input type="radio" name="gender" value="Other"  /> <br />
            <label> Birthdate: </label> <br /> <input type="text" name="birthdate" /> <br />
            <input type="submit" value="Submit" />
            <input type="button" onclick="location.href='form.php';" value="Go Back" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
