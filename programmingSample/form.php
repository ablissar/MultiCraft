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
        <form action="database.php" method="post" name="form" >
            <label> Username: </label> <br /> <input type="text" name="username" /> <br />
            <label> Password: </label> <br /> <input type="password" name="password" /> <br />
            <label> Confirm Password: </label> <br /> <input type="password" name="passwordConfirm" /> <br />
            <label> Email: </label> <br /> <input type="email" name="email" /> <br />
            <label> Name: </label> <br /> <input type="text" name="name" /> <br />
            <label> Gender: </label> <br />
            Male: <input type="radio" name="gender" value="Male" />
            Female: <input type="radio" name="gender" value="Female"  />
            Other: <input type="radio" name="gender" value="Other"  /> <br />
            <label> Birthdate: </label> <br /> <input type="text" name="birthdate" /> <br />
            <label> Phone Number: </label> <br /> <input type="text" name="phone" /> <br />
            <label> Address: </label> <br /> <input type="text" name="address" /> <br />
            <input type="submit" value="Submit" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
