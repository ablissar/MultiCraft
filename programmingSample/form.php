<!DOCTYPE html>

<script>
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
</script>

<html>
    <title>User Registration Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>User Registration Form</h1>
        <div>
        <form action="userInfoForm.php" method="post" name="form" >
            <label> Username: </label> <br /> <input type="text" name="username" /> <br />
            <label> Password: </label> <br /> <input type="password" name="password" /> <br />
            <label> Confirm Password: </label> <br /> <input type="password" name="passwordConfirm" /> <br />
            <input type="submit" value="Submit" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
