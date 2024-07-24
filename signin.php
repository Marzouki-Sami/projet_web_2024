<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Signin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<center>
	<div class="jumbotron">

    <h1 class="display-1">Signin</h1><br><br>
		<form name="fsign" method="POST" action="sig.php" enctype="multipart/form-data">
            <label for="nom">Nom:</label><br>
            <input type="text" required name="nom" size="50px" id="nom"/><br>
            <label for="pnom">Prénom:</label><br>
            <input type="text" required name="pnom" size="50px" id="pnom"/><br>
            <label for="mail">E-mail:</label><br>
            <input type="email" required name="mail" size="50px" id="mail" placeholder="mail@serveur.com"/><br>
            <label for="mdp">Mot de passe:</label><br>
            <input type="password" required name="mdp" size="50px" id="mdp"/><br>
            <label for="cmdp">Confirmer mot de passe:</label><br>
            <input type="password" required name="cmdp" size="50px" id="cmdp"/><br>
            <label for="etud">Etudiant</label>
            <input type="radio" name="epa" id="etud" value="etudiant" checked /><br>
            <label for="prof">prof</label>
            <input type="radio" name="epa" id="prof" value="prof"/><br>
            <label for="admin">admin</label>
            <input type="radio" name="epa" id="admin" value="admin"/><br>
            <input type="file" name="photo" id="photo"/><br><br>
            <input type="submit" name="envoyer" value="Envoyer" id="envoyer" class="btn btn-primary"/>
            <input type="reset" name="annuler" value="Annuler" id="annuler" class="btn btn-secondary"/><br>
            <a id="log" href="login.php">login</a>
        </form>
	</div>
    </center>
    <script type="text/javascript" src="signin.js"></script>
</body>
</html>