<nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
    <a class="navbar-brand" href="home.php">Home</a> 
    <ul class="navbar-nav">
        <li class="nav-item"><a href="profile.php" class="nav-link">profile</a></ol>
        <li class="nav-item"><a href="login.php" class="nav-link">déconnexion</a></ol>
        <li class="nav-item"><a diseabled class="nav-link"><?php session_start(); echo $_SESSION['mail'] ?></a></li>
        <li class="nav-item"><img width="5%" height="100%" src="export.php?mail=img@img.com"/></li>
    </ul>
</nav>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php 
//information de connexion
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';

//connection a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $dbco->prepare("SELECT * FROM petition where user_id in (SELECT user_id FROM utilisateur WHERE user_profession = :profession)");
    $sth->bindValue(':profession', "etudiant");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    //tester si resultat est vide
    if(empty($resultat)){
        echo "Aucune petition n'a été créée";
    }
    else{
        echo "<div class='jumbotron'>";
        echo "<h3>Les Pétitions Des Etudiant</h3>";
        echo "<br>";
        echo "<table border='1' class='table table-dark table-hover'>";
        echo "<tr><th colspan='6'><center>Table des Pétitions</center></th></tr>";
        echo "<tr>";
        echo "<th>Titre</th>";
        echo "<th>Date</th>";
        echo "<th>NombreAvec</th>";
        echo "<th>NombreContre</th>";
        echo "<th>Voir+</th>";
        echo "</tr>";
        $i=0;
        foreach($resultat as $row){
            echo "<tr>";
            echo "<td>".$row['petition_titre']."</td>";
            echo "<td>".$row['petition_date']."</td>";
            echo "<td>".$row['avec']."</td>";
            echo "<td>".$row['contre']."</td>";
            echo "<td><a class='btn btn-secondary btn-block' href='voirpet.php?id=".$row['petition_id']."'>Voir</a></td>";
            echo "</tr>";
            $i++;
        }
        echo "</table><br>";
        //boutton pour retour
        echo "<a href='home.php' class='btn btn-primary'>Retour</a>";
        echo "</div>";
    }   
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>