
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<pre>
<?php
    session_start();
    if(isset($_SESSION['id'])){
        $idu = $_SESSION['id'];
    }
    if(isset($_GET['id'])){
        $idp = $_GET['id'];

    //information de connexion
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pweb';
    //connction a la base de donnees et verification de la connexion
    try{
        $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //tester si la petition existe selon l'id
        $sth = $dbco->prepare("SELECT * FROM petition WHERE petition_id = :idp");
        $sth->bindParam(':idp', $idp);
        $sth->execute();
        $result = $sth->fetchAll();
        if(count($result) == 0){
            $msgpetition = "Petition inexistante";
            header("Location: home.php");
        }
        else{
            //recuperation des donnees
            $titre = $result[0]['petition_titre'];
            $contenu = $result[0]['petition_text'];
            $date = $result[0]['petition_date'];
            $avec = $result[0]['avec'];
            $contre = $result[0]['contre'];
            //$idu = $result[0]['user_id'];
            //recuperation des donnees de la table users
            $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE user_id = :idu");
            $sth->bindParam(':idu', $idu);
            $sth->execute();
            $result = $sth->fetchAll();
            $nom = $result[0]['user_nom'];
            $prenom = $result[0]['user_pnom'];
            $mail = $result[0]['user_mail'];
            $profession = $result[0]['user_profession'];
            //recuperation des donnees de la table petition
            $sth = $dbco->prepare("SELECT * FROM petition WHERE (user_id = :idu) AND (petition_id = :idp)");
            $sth->bindParam(':idp', $idp);
            $sth->bindParam(':idu', $idu);
            $sth->execute();
            $result = $sth->fetchAll();            
        }            
                //afficher la petition
                echo "<center>";
                echo "<div class='jumbotron'>";
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                echo "<h1>Titre: $titre</h1>";
                echo "<p>Contenu:<br> $contenu</p>";
                echo "<p>Date de création: $date</p>";
                echo "<p>Nom et Prénom: $nom $prenom</p>";
                echo "<p>Mail de créateur: $mail</p>";
                echo "<p>Profession: $profession</p>";
                echo "<p>Nombres Pour: $avec</p>";
                echo "<p>Nombres Contre: $contre</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                
                //table pour
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr><th colspan='3'><center>Table Pour</center></th></tr>";
                echo "<tr>";
                echo "<th scope='col'>Nom</th>";
                echo "<th scope='col'>Prénom</th>";
                echo "<th scope='col'>Commentaire</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $sth = $dbco->prepare("SELECT * FROM petuser WHERE petition_id = :idp and choix = 'avec'");
                $sth->bindParam(':idp', $idp);
                $sth->execute();
                $result = $sth->fetchAll();

                foreach($result as $row){
                    $iduu = $row['user_id'];
                    $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE user_id = :idu");
                    $sth->bindParam(':idu', $iduu);
                    $sth->execute();
                    $result = $sth->fetchAll();
                    $nom = $result[0]['user_nom'];
                    $prenom = $result[0]['user_pnom'];
                    $commentaire = $row['commentaire'];
                    echo "<tr>";
                    echo "<td>$nom</td>";
                    echo "<td>$prenom</td>";
                    echo "<td>$commentaire</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo"<br><br>";
                
                //table contre
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr><th colspan='3'><center>Table Contre</center></th></tr>";
                echo "<tr>";
                echo "<th scope='col'>Nom</th>";
                echo "<th scope='col'>Prénom</th>";
                echo "<th scope='col'>Commentaire</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $sth = $dbco->prepare("SELECT * FROM petuser WHERE petition_id = :idp and choix = 'contre'");
                $sth->bindParam(':idp', $idp);
                $sth->execute();
                $result = $sth->fetchAll();

                foreach($result as $row){
                    $iduuu = $row['user_id'];
                    $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE user_id = :idu");
                    $sth->bindParam(':idu', $iduuu);
                    $sth->execute();
                    $result = $sth->fetchAll();
                    $nom = $result[0]['user_nom'];
                    $prenom = $result[0]['user_pnom'];
                    $commentaire = $row['commentaire'];
                    echo "<tr>";
                    echo "<td>$nom</td>";
                    echo "<td>$prenom</td>";
                    echo "<td>$commentaire</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                echo "</div>";
                echo "</div>";


                //formulaire pour signer
                echo '<form name="fpetmod" method="post" action="petmod.php">';
                echo '<div class="form-group">';
                echo '<label for="titre">Titre de pétition:</label><br>';
                echo '<input type="text" size="50px" name="titremod" id="titremod" class="form-control" placeholder="tapez le titre de votre pétition" ><br>';
                echo '<input type="button" value="modifier" name="modtitre" class="btn btn-info"><br>';
                echo '</div>';
                echo '<div class="form-group ">';
                echo '<label for="text">Contenu de pétition:</label><br>';
                echo '<textarea name="contenumod" rows="5" id="contenumod" class="form-control" placeholder="tapez le contenu de votre pétition" ></textarea><br>';
                echo '<input type="button" value="modifier" name="modtitre" class="btn btn-info"><br><br>';
                echo '<div class="form-group">';
                echo '<div class="form-group">';
                echo '<input type="submit" value="envoyer" name="submit" class="btn btn-primary btn-lg">';
                echo '<input type="reset" value="annuler" class="btn btn-secondary btn-lg">';
                echo '</div>';    
                echo '</form>';
                echo "<a href='modifpet.php' class='btn btn-primary'>Retour</a>";
                echo "</div>";
                echo "</center>";
                //creation d'une session pour garder l'id de la petition et l'id de l'utilisateur
                $_SESSION['idu'] = $idu;
                $_SESSION['idp'] = $idp;

    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}

?>
</pre>