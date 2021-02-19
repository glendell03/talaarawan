<?php

session_start();


$_SESSION = array();

session_destroy();


header("location: ../public/auth/login.php");
exit;
