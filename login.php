<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body><center>
    <div class="jumbotron">
        <h1 class="display-1">Login</h1><br><br>
        <form name="flog" method="post" action="log.php">
        <div class="form-group">
            <label for="mail">E-mail:</label><br>
            <input type="email"  required name="mail" id="mail"  size="50px" placeholder="mail@serveur.com"/>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe:</label><br>
            <input type="password" required name="mdp" id="mdp"  size="50px" oncopy="return false" onpaste="return false" oncut="return false"/>
        </div>
            <input type="submit" name="submit" value="LogIn" id="submit" class="btn btn-primary"/>
            <input type="reset" name="annuler" value="Annuler" id="annuler" class="btn btn-secondary"/><br>
            <a id="inscri" href="signin.php">or signin</a>
        </form> 
    </div>
    </center>
    <script type="text/javascript" src="login.js"></script>    
</body>
</html>