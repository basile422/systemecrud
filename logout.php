<?php
session_start();
$_SESSION['flash']['succes']='vous etes deconecter';
unset($_SESSION['auth']);
header('location:login.php')

?>