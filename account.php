
<?php session_start();
require'function.php';
logged_only();
	# code...

?>
<?php
//rediriger l'utilisateur vers accoount une connecter.

require 'header.php';
?>
<h1>Bonjour<?=$_SESSION['auth']->username;?> </h1>

<form action="" method="post">
<div class="form-group">
	<input class="form-control" type="password" name="password" placeholder="changer votre mot de passe "/>
	
</div>
div class="form-group">
	<input class="form-control" type="password" name="password_confirm" placeholder="changer votre mot de passe "/>
	
</div>
<button class="btn btn-primary">changer mon mot de passe</button>
	<form>


<?php debug ($_SESSION); ?>
