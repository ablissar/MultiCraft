<?php
    function sanitizeInput($input) {
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
  }
 ?>

 <script>
     function showObj(obj) {
         obj.style.display="inline";
     }
     function hideObj(obj) {
         obj.style.display="none";
     }
 </script>
