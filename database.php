<?php
//creation de la base de  donee
$pdo= new PDO('mysql:dbname:opismscrud; host=localhost','root','');
//definir quelqs attribu a pdo
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


?>