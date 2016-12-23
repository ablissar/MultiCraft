<!DOCTYPE html>
<?php
    session_start();

    // Debugging
    echo "Testing <br / />";
    if( isset($_SESSION["username"]) && isset($_SESSION["name"]) && isset($_SESSION["email"]) ) {
        echo "Username: ".$_SESSION["username"]."<br />";
        echo "Password hash: ".$_SESSION["passwordHash"]."<br />";
        echo "Name: ".$_SESSION["name"]."<br />";
        echo "Gender: ".$_SESSION["gender"]."<br />";
        echo "Birthdate: ".$_SESSION["birthdate"]."<br />";
        echo "Email: ".$_SESSION["email"]."<br />";
        echo "Phone: ".$_SESSION["phone"]."<br />";
        echo "Street: ".$_SESSION["street"]."<br />";
        echo "City: ".$_SESSION["city"]."<br />";
        echo "State: ".$_SESSION["state"]."<br />";
        echo "Zip: ".$_SESSION["zip"]."<br />";
    }
    else {
        echo "Error: form not completed successfully. <br />";
    }

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
        <!-- Link to put you back to start page (for testing) -->
        <a href="form.php"> Start </a>
    </body>
 </html>
