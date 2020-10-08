<?php 

//recupere les paramettre
$utilisateur_id=$_GET['id'];
$token = $_GET['token'];
require 'database.php';

$req=$pdo->prepare('SELECT * from utilisateur where id= ?');
$req->execute([$utilisateur_id]);
$utilisateur=$req->fetch();

session_start();

if ($utilisateur && $utilisateur->confirmation_token=$token) {
	//connecter l'utlisateur
	
	$pdo->prepare('UPDATE utilisateur SET confirmation_token=null, confirmed_at=now() where id=?')->execute([$utilisateur_id]); 
	$_SESSION['flah']['succes']='votre compte a ete valider';
	$_SESSION['auth']=$utilisateur;
	header('location: account.php');
	die('ok');
	# code...
}else{
	$_SESSION['flash']['danger']="ce toke n'est plus valide ";
	header('location:login.php');
}


?>