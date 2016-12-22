<!DOCTYPE html>
<?php
    session_start();
    // Server-side validation for info from last form
    function validateVariable($var) {
        if( !isset($_SESSION[$var]) ) return false;
        if( strlen($_SESSION[$var]) == 0 ) return false;
        return true;
    }

    function sanitizeInput($input) {
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
    }

    // Debugging
    echo $_SESSION["username"]."<br />";
    echo $_SESSION["password"]."<br />";
    echo $_SESSION["name"]."<br />";
    echo $_SESSION["gender"]."<br />";
    echo $_SESSION["birthdate"]."<br />";
    echo $_SESSION["email"]."<br />";
    echo $_SESSION["phone"]."<br />";
    echo $_SESSION["street"]."<br />";
    echo $_SESSION["city"]."<br />";
    echo $_SESSION["state"]."<br />";
    echo $_SESSION["zip"]."<br />";

    // At this point, the data has been validated on both
    // the client and server side and is ready to be
    // entered into the database.

    // === Database code here ===

    // Close session
    session_unset();
    session_destroy();
 ?>
 <html>
    <body>
        <a href="form.php"> Start </a>
    </body>
 </html>
