<!DOCTYPE html>
<?php
    session_start();
    // Server-side validation for info from last form

    // Once info has been validated, save it to session
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION["address1"] = $_POST["address1"];
    $_SESSION["address2"] = $_POST["address2"];
    $_SESSION["address3"] = $_POST["address3"];
    $_SESSION["address4"] = $_POST["address4"];

    /* Debugging
    echo $_SESSION["username"]."<br />";
    echo $_SESSION["password"]."<br />";
    echo $_SESSION["email"]."<br />";
    echo $_SESSION["name"]."<br />";
    echo $_SESSION["gender"]."<br />";
    echo $_SESSION["birthdate"]."<br />";
    echo $_SESSION["phone"]."<br />";
    echo $_SESSION["address1"]."<br />";
    echo $_SESSION["address2"]."<br />";
    echo $_SESSION["address3"]."<br />";
    echo $_SESSION["address4"]."<br />"; */

    // At this point, the data has been validated on both
    // the client and server side and is ready to be
    // entered into the database.

    // === Database code here ===

    // Close session
    session_unset();
    session_destroy();
 ?>
