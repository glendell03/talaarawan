<?php

session_start();
 

$_SESSION = array();

session_destroy();
 

header("location: ../public/pages/login.php");
exit;
?>