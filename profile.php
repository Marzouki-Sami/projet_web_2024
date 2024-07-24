<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" type="text/css" href="logloglog.css" >
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
    <a class="navbar-brand" href="home.php">Home</a> 
    <ul class="navbar-nav">
        <li class="nav-item"><a href="profile.php" class="nav-link">profile</a></ol>
        <li class="nav-item"><a href="login.php" class="nav-link">déconnexion</a></ol>
        <li class="nav-item"><a diseabled class="nav-link"><?php session_start(); echo $_SESSION['mail'] ?></a></li>
        <li class="nav-item"><img width="5%" height="100%" src="export.php?mail=img@img.com"/></li>
    </ul>
</nav>
<div class="jumbotron">
    <form name="fprofile" method="post" action="pro.php" class="was-validated">
    <div class="form-group">
        <label for="nom">Nom:</label><br>
        <input type="text" name="nom" id="nom" class="form-control" disabled><br>
        <input type="button" value="modifier" name="modifnom" id="modifnom" class="btn btn-secondary"><br>
    </div>
    <div class="form-group">
        <label for="pnom">Prénom:</label><br>
        <input type="text" name="pnom" id="pnom" class="form-control" disabled><br>
        <input type="button" value="modifier" name="modifpnom" id="modifpnom" class="btn btn-secondary"><br>
    </div>
    <div class="form-group">
        <label for="mail">E-mail:</label><br>
        <input type="email" name="mail" id="mail" class="form-control" disabled><br>
        <input type="button" value="modifier" name="modifmail" id="modifmail" class="btn btn-secondary"><br>
    </div>
    <div class="form-group"></div>   
        <label for="mdp">Mot de passe:</label><br>
        <input type="password" name="mdp" id="mdp" class="form-control" disabled><br>
        <input type="button" value="modifier" name="modifmdp" id="modifmdp" class="btn btn-secondary"><br><br>
        <center>
            <input type="submit" name="envoyer" value="Valider" id="envoyer" class="btn btn-primary btn-lg">
            <input type="reset" name="annuler" value="annuler" id="annuler" class="btn btn-primary btn-lg">
        </center>
    </div>
    
    </form>
</div>
    <script type="text/javascript" src="profile.js"></script>
</body>
</html>