<?php
   session_start();
   session_unset();
   session_destroy();
  
   
   echo 'Logging Out.....';
   header('Refresh: 2; URL = login.php');
?>