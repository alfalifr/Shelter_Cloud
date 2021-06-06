<?php
session_start();
unset($_SESSION['PHPSESSID']);
unset($_SESSION['mail']);
unset($_SESSION['currloc']);
unset($_SESSION['name']);

//Alihkan Ke Home
session_destroy();
header('location: index.php');
?>