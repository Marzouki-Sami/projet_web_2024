<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
    <a class="navbar-brand" href="home.php">Home</a> 
    <ul class="navbar-nav">
        <li class="nav-item"><a href="profile.php" class="nav-link">profile</a></ol>
        <li class="nav-item"><a href="login.php" class="nav-link">déconnexion</a></ol>
        <li class="nav-item"><a diseabled class="nav-link"><?php session_start(); echo $_SESSION['mail'] ?></a></li>
        <li class="nav-item"><img width="10%" height="100%" src="export.php?mail=samy@gmail.com"/></li>
      </ul>
</nav>
<div class="jumbotron">
    <center><h2>Ajouter une pétition</h2></center>
    <form name="fpet" method="post" action="petition.php">
<div class="form-group">
        <label for="titre">Titre de pétition:</label><br>
        <input type="text" name="titre" id="titre" class="form-control" placeholder="tapez le titre de votre pétition"><br>
</div>
<div class="form-group">
        <label for="text">contenu de pétition:</label><br>
        <textarea name="contenu" rows="5" id="contenu" class="form-control" placeholder="tapez le contenu de votre pétition"></textarea>
</div>
<div class="form-group">
        <input type="submit" value="envoyer" name="submit" class="btn btn-primary btn-lg">
        <input type="reset" value="annuler" class="btn btn-secondary btn-lg">
</div>
    </form>
</div>
<div class="jumbotron">
    <center><h2>Afficher les pétitions</h2></center>
    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pweb';
    try{

      $email = $_SESSION['mail'];
      $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //recuper l'id de l'utilisateur connecté
      $sth = $dbco->prepare("SELECT user_id FROM utilisateur WHERE user_mail = :email");
      $sth->bindParam(':email', $email);
      $sth->execute();
      $identificateur = $sth->fetch(PDO::FETCH_ASSOC)['user_id'];
      

      //tester si l'utilisateur est un etudiant ou un prof
      $sth = $dbco->prepare("SELECT * FROM utilisateur where user_id = :id");
      $sth->bindParam(':id', $identificateur);
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      if($result['user_profession'] == 'etudiant'){
        echo"<form name='affp' method='post' action='petaff.php'>".
        "<input type='submit' value='afficher les pétitions' name='submit' class='btn btn-primary btn-block btn-lg'>".
        "</form>";
      }
      else if($result['user_profession'] == 'prof'){
        echo"<form name='affp' method='post' action='petaffprof.php'>".
        "<input type='submit' value='afficher les pétitions' name='submit' class='btn btn-primary btn-block btn-lg'>".
        "</form>";
      }

    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <!--
    <form name="affp" method="post" action="petaff.php">
        <input type="submit" value="afficher les pétitions" name="submit" class="btn btn-primary btn-block btn-lg">
    </form>
    -->
    <!--
</div>
<div class="jumbotron">
    <center><h2>Modifier une pétition</h2></center>
    <form name="fpetmod" method="post" action="petmod.php">
    <div class="form-group">
        <label for=idmod>id de la pétition:</label><br>
        <input type="text" name="idmod" id="idmod" class="form-control" placeholder="tapez l'id de votre pétition"><br>
</div>
<div class="form-group">
        <label for="titre">Titre de pétition:</label><br>
        <input type="text" size="50px" name="titremod" id="titremod" class="form-control" placeholder="tapez le titre de votre pétition" ><br>
        <input type="button" value="modifier" name="modtitre" class="btn btn-info"><br>
</div>
<div class="form-group ">
        <label for="text">Contenu de pétition:</label><br>
        <textarea name="contenumod" rows="5" id="contenumod" class="form-control" placeholder="tapez le contenu de votre pétition" ></textarea><br>
        <input type="button" value="modifier" name="modtitre" class="btn btn-info"><br><br>
<div class="form-group">
<div class="form-group">
        <input type="submit" value="envoyer" name="submit" class="btn btn-primary btn-lg">
        <input type="reset" value="annuler" class="btn btn-secondary btn-lg">
</div>    
    </form>
    </div>
  -->



<div class="jumbotron">
    <center><h2>Modifier les pétitions</h2></center>
    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pweb';
    try{

      $email = $_SESSION['mail'];
      $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //recuper l'id de l'utilisateur connecté
      $sth = $dbco->prepare("SELECT user_id FROM utilisateur WHERE user_mail = :email");
      $sth->bindParam(':email', $email);
      $sth->execute();
      $identificateur = $sth->fetch(PDO::FETCH_ASSOC)['user_id'];
      

      //tester si l'utilisateur est un etudiant ou un prof
      $sth = $dbco->prepare("SELECT * FROM utilisateur where user_id = :id");
      $sth->bindParam(':id', $identificateur);
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      if($result['user_profession'] == 'etudiant'){
        echo"<form name='affp' method='post' action='modifpet.php'>".
        "<input type='submit' value='modifier les pétitions' name='submit' class='btn btn-primary btn-block btn-lg'>".
        "</form>";
      }
      else if($result['user_profession'] == 'prof'){
        echo"<form name='affp' method='post' action='modifpetprof.php'>".
        "<input type='submit' value='modifier les pétitions' name='submit' class='btn btn-primary btn-block btn-lg'>".
        "</form>";
      }

    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    ?>
    

    <!-- Footer -->
<footer class="bg-light text-center ">
  <!-- Grid container -->
  <div class="container p-4">

    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

      <!-- Twitter -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>

      <!-- Google -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>

      <!-- Instagram -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>

      <!-- Linkedin -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
      <!-- Github -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
    </section>
    <!-- Section: Social media -->



    <!-- Section: Text -->
    <section class="mb-4">
      <p>
      </p>
    </section>
    <!-- Section: Text -->


  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(49, 120, 255, 0.42)">
    © 2020 Copyright:
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</div>

    <script type="text/javascript" src="modificationpet.js"></script>
</body>
</html>