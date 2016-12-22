<!DOCTYPE html>
<?php
    session_start();
    include('header.php');

    // === Server-side validation ===

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
        // If everything is valid, save info to session and move to next page.
        else {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            Header("Location: userInfoForm.php");
        }
    }
 ?>
<!--<script>
    // Client-side validation
    function validateForm() {
    var valid = true;
    if (validateUsername() && validatePassword()
        && validateEmail() && validateName()
        && validateGender() && validateBirthdate()
        && validatePhone() && validateAddress() ) {
            return true;
    }
    return false;
  }

  function validateUsername() {
      if( isset(document.forms["form"]["username"]) ) {
          var username = document.forms["form"]["username"];
          // Checks that username is appropriate length and contains no spaces
          if( username.length > 20 || username.length < 4 || username.includes(' ') ) {
              return false;
          }
          return true;
      }
      return false;
  }

  function validatePassword() {
      if( isset(document.forms["form"]["password"]) ) {
          var password = document.forms["form"]["password"];
          // Checks that password is appropriate length, meets
          // basic security standards, and matches confirmation password
          if( password.lenth < 8 ) {
              return false;
          }
          if( password != document.forms["form"]["passwordConfirm"] ) {
              return false;
          }
          return true;
      }
      return false;
  }
  function validateEmail() {

  }
  function validateName() {

  }
  function validateGender() {

  }
  function validateBirthdate() {

  }
  function validatePhone() {

  }
  function validateAddress() {

  }
</script> -->

<html>
    <title>User Registration Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <!-- Functions for showing/hiding objects -->
        <script>
            function showPassHint() {
                showObj(document.getElementById('passHint'));
            }
            function hidePassHint() {
                hideObj(document.getElementById('passHint'));
            }
        </script>

        <h1>User Registration Form</h1>
        <div>
        <form action="form.php" method="post" name="form" >
            <label> Username: </label> <br /> <input type="text" name="username" /> <br />
            <label> Password: </label>
            <img onmouseover="showPassHint()" onmouseout="hidePassHint()" src="hint.jpeg" height="20px" width="20px"/> <br />
            <p style="display:none" id="passHint"> Password must be greater than 8 characters. <br /> </p>
            <input type="password" name="password" /> <br />
            <label> Confirm Password: </label> <br /> <input type="password" name="passwordConfirm" /> <br />
            <input type="submit" value="Submit" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
