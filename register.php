

<?php 
  require 'function.php';
  session_start();

if (!empty($_POST)) {
	$error = array();

require_once 'database.php';

	if (empty($_POST['username'])|| !preg_match('/^[a-zA-Z_]+$/', $_POST ['username'])) {
		$error['username']="votre Pseudo n'est pas valide (alphanumerique)";
		# code...
	}
	//verifier si l'utilisateur n'existe pas deja dans la bd
	else {
		$req=$pdo->prepare('select id from utilisateur where username=?');
		$req->execute([$_POST['username']]);
		$utilisateur = $req->fetch();
		 
		 if ($utilisateur) {
		 	$error['username']='ce pseudo existe deja ';
		 	# code...
		 }

		# code...
	}
//verifier le fomat de l'email

	if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$error['email']="vote email n'est pas valide ";
		# code...
	}
	else {
		$req=$pdo->prepare('select id from utilisateur where email=?');
		$req->execute([$_POST['email']]);
		$utilisateur = $req->fetch();
		 
		 if ($utilisateur) {
		 	$error['username']='cet E-mail est deja utiliser ';
		 	# code...
		 }

		# code...
	}

	//valider le mot de passe et comparer le mot de pass entrer aves cel de confirm.
	if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
		$error['password']='vous devrez entrer un mot de passe valide ';
		# code...
	}

	 

if (empty($error)) {
	# code...
 
	 //requette pour inserrer l'utlisateur
	 $req=$pdo->prepare("INSERT INTO utilisateur set username=? , password=?, email=? , confirmation_token=?, confirmed_at=?");

	 //execution et hachage d mot de passe dans la base de donnee

	 $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

      $token = str_random(50);
      debug($token);
      die();

	 $req->execute([$_POST['username'] , $password , $_POST['email'] ,$token]);
	 //envoyer le code de confimation par mail

	 $utlisateur_id=$pdo->lastInsertId();
	 main($_POST ['email'],'confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien\n\n http\\localhost/systemcrud/comfirm.php? id=$utlisateur_id$token=$token");
	    $_SESSION['flah']['succes']='un email de confirmation vous a ete envoyer pour valider votre compte';
	 //rediriger l'utilisateur vers la page de conexion une que so compte est creer.
	 header('location: login.php');
	  exit();
 }
?>
<?php require 'header.php';?>


<?php 
if (!empty($error)):?>
	<div class="alerte alert-danger"> <p>vous n'avez pas rempli le formulaire correctement</p>
<ul>
	<?php foreach($error as $errors):?>
		<li><?=$errors;?></li>
	<?php endforeach;?>
</ul>

	</div>
<?php endif;?>


<body>

<h1>INSCRIPTON</h1>
<form action="" method="POST">
	<div class="form-group">
		<label for="">Pseudo</label>
		<input type="text" name="username" class="form-group">
		
	</div>
	<div class="form-group">
		<label for="">Email</label>
		<input type="mail" name="email" class="form-group">
		
	</div>
	<div class="form-group">
		<label for="">Mots de passe</label>
		<input type="password" name="password" class="form-group">
		
	</div>
	<div class="form-group">
		<label for="">Confirmer votre mot de passe</label>
		<input type="password" name="password_confirm" class="form-group">

		
	</div>
	<button type="submit" class="btn btn-primary">M'inscrire</button>
</form>
</body>