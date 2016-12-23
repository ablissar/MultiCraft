<?php
    function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    function echoVar($name) {
        if(isset($_SESSION[$name])) {
            echo $_SESSION[$name];
        }
        else {
            echo "";
        }
    }
 ?>

 <script>
     function showObj(obj) {
         obj.style.display="inline";
     }
     function hideObj(obj) {
         obj.style.display="none";
     }
     function clearWarnings(arr) {
         for (var i = 0; i < arr.length; i++) {
             document.getElementById(arr[i]+"Warning").innerHTML="";
         }
     }
 </script>
