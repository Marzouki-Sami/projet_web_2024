
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
    <a class="navbar-brand" href="admin.php">Home</a> 
    <ul class="navbar-nav">
        <li class="nav-item"><a href="login.php" class="nav-link">déconnexion</a></ol>
        <li class="nav-item"><a diseabled class="nav-link"><?php session_start(); echo $_SESSION['mail'] ?></a></li>
        <li class="nav-item"><img width="5%" height="100%" src="export.php?mail=img@img.com"/></li>s
    </ul>
</nav>
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
    //afficher les utilisateurs
    $sth = $dbco->prepare("SELECT * FROM utilisateur where user_profession not like 'admin'");
    $sth->execute();
    $result = $sth->fetchAll();
    echo "<div class='jumbotron'>";
    echo "<h3>Toutes Les Utilisateurs</h3>";
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='7'><center>Table des Utilisateurs</center></th></tr>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nom</th>";
    echo "<th>prenom</th>";
    echo "<th>mail</th>";
    echo "<th>password</th>";
    echo "<th>profession</th>";
    echo "<th>Supprimer</th>";
    echo "</tr>";
    if(count($result) > 0){
    

    
    foreach($result as $row){
        echo "<tr>";
        echo "<td>".$row['user_id']."</td>";
        echo "<td>".$row['user_nom']."</td>";
        echo "<td>".$row['user_pnom']."</td>";
        echo "<td>".$row['user_mail']."</td>";
        echo "<td>".$row['user_mdp']."</td>";
        echo "<td>".$row['user_profession']."</td>";
        echo "<td><a class='btn btn-secondary btn-block' href='suppuser.php?id=".$row['user_id']."'>Supprimer</a></td>";
        echo "</tr>";
    }
    
    }
    else{
        echo "<tr><td colspan='7'><center>Aucun utilisateur</center></td></tr>";

    }
    echo "</table>";
    echo "</div>";

    //affichage des petitions dans un tableau
    $sth = $dbco->prepare("SELECT * FROM petition");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    //tester si resultat est vide
    if(empty($resultat)){
        echo "<div class='jumbotron'>";
        echo "<h3>Toutes Les Pétitions petition</h3>";
        echo "<table border='1' class='table table-dark table-hover'>";
        echo "<tr><th colspan='6'><center>Table des Pétitions</center></th></tr>";
        echo "<tr>";
        echo "<th>Titre</th>";
        echo "<th>Date</th>";
        echo "<th>NombreAvec</th>";
        echo "<th>NombreContre</th>";
        echo "<th>Voir+</th>";
        echo "<th>Supprimer</th>";
        echo "</tr>";
        echo "<tr><td colspan='6'><center>Aucune petition</center></td></tr>";
        echo "</table>";
        echo "</div>";

    }
    else{
        echo "<div class='jumbotron'>";
        echo "<h3>Toutes Les Pétitions petition</h3>";
        echo "<table border='1' class='table table-dark table-hover'>";
        echo "<tr><th colspan='6'><center>Table des Pétitions</center></th></tr>";
        echo "<tr>";
        echo "<th>Titre</th>";
        echo "<th>Date</th>";
        echo "<th>NombreAvec</th>";
        echo "<th>NombreContre</th>";
        echo "<th>Voir+</th>";
        echo "<th>Supprimer</th>";
        echo "</tr>";
        $i=0;
        foreach($resultat as $row){
            echo "<tr>";
            echo "<td>".$row['petition_titre']."</td>";
            echo "<td>".$row['petition_date']."</td>";
            echo "<td>".$row['avec']."</td>";
            echo "<td>".$row['contre']."</td>";
            echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";
            echo "<td><a class='btn btn-secondary btn-block' href='supppetadmin.php?id=".$row['petition_id']."'>Supprimer</a></td>";

            echo "</tr>";
            $i++;
        }
        echo "</table><br>";
        echo "</div>";


        
        //Afficher les pétitions les plus populaires dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition ORDER BY avec DESC");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>Les pétitions Trier selon le Nombres des signatures Pour</h3>";
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>Les pétitions les plus populaires</center></th></tr>";
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
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;
    }
    echo "</table><br>";
    echo "</div>";

    //Afficher les pétitions les moins populaires dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition ORDER BY avec ASC");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>Les pétitions Trier selon le Nombres des signatures Contre</h3>";
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>Les pétitions les moins populaires</center></th></tr>";
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
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;
    }
    echo "</table><br>";
    echo "</div>";
    
    //Afficher les pétitions les plus anciennes dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition ORDER BY petition_date ASC");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>Les pétitions Trier selon la Dates d'ajout</h3>";    
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>Les pétitions les plus anciennes</center></th></tr>";
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
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;
    }
    echo "</table><br>";
    echo "</div>";

    //Afficher les pétitions les plus récentes dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition ORDER BY petition_date DESC");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>Les pétitions Trier selon la Dates d'ajout</h3>";    
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>Les pétitions les plus récentes</center></th></tr>";
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
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;
    }
    echo "</table><br>";
    echo "</div>";
    //Afficher les pétitions les plus signalées avec dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition where avec =(select max(avec) from petition);");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>La pétition Qui a le plus nombres de signature Pour</h3>";    
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>La pétition la plus signalée avec</center></th></tr>";
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
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;
    }
    echo "</table><br>";
    echo "</div>";

    //Afficher les pétitions les plus contre dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition where contre = (select max(contre) from petition);");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>La pétition Qui a le plus nombres de signature Pour</h3>";    
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>La pétition la plus signalée contre</center></th></tr>";
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
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;
    }
    echo "</table><br>";
    echo "</div>";

    //Afficher le taux de participation des pétitions dans un table.
    $sth = $dbco->prepare("SELECT * FROM petition ;");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='jumbotron'>";
    echo "<h3>Les pétitions avec leur avec le Pourcentage Pour et Pourcentage Contre</h3>";    
    echo "<table border='1' class='table table-dark table-hover'>";
    echo "<tr><th colspan='6'><center>Le taux de participation des pétitions</center></th></tr>";
    echo "<tr>";
    echo "<th>Titre</th>";
    echo "<th>Date</th>";
    echo "<th>NombreAvec</th>";
    echo "<th>NombreContre</th>";
    echo "<th>pourcentage avec</th>";
    echo "<th>pourcentage contre</th>";
    echo "<th>Voir+</th>";
    echo "</tr>";
    $i=0;
    foreach($resultat as $row){
        echo "<tr>";
        echo "<td>".$row['petition_titre']."</td>";
        echo "<td>".$row['petition_date']."</td>";
        echo "<td>".$row['avec']."</td>";
        echo "<td>".$row['contre']."</td>";
        try{
        //pourcentage avec
        $avec = $row['avec'];
        $contre = $row['contre'];
        if($avec == 0 && $contre == 0){
            $pourcentageavec = 0;
        }
        else {
            $pourcentageavec = ($avec*100)/($avec+$contre);
        }
        echo "<td>".round($pourcentageavec)."%</td>";
        //pourcentage contre
        if($avec == 0 && $contre == 0){
            $pourcentagecontre = 0;
        }
        else {
            $pourcentagecontre = ($contre*100)/($avec+$contre);
        }
        echo "<td>".round($pourcentagecontre)."%</td>";
        }catch(Exception $e){
            echo "Erreur";
        }
        echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

        echo "</tr>";
        $i++;       
    }   
    echo "</table><br>";
    echo "</div>";

    echo"<center>";
    echo "<div class='jumbotron'>";
    echo "<h3>Filtrage des pétition selon un mot clè</h3>";
    echo "<form action='admin.php' method='post'>";
    echo "<input type='text' name='mot_cle' size='50'><br><br>";
    echo "<input type='submit' name='submit' value='Rechercher' class='btn btn-secondary '>";  
    echo "</div>";
    echo "</form>";
    echo"</center>";

    //Afficher les pétitions selon le mot clé dans un table.
    if(isset($_POST['submit'])){
        $mot_cle = $_POST['mot_cle'];
        $sth = $dbco->prepare("SELECT * FROM petition where petition_titre like '%$mot_cle%' ;");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='jumbotron'>";
        echo "<h3>Les pétitions avec le mot clé '$mot_cle' dans leur titre</h3>";    
        echo "<table border='1' class='table table-dark table-hover'>";
        echo "<tr><th colspan='6'><center>Les pétitions avec le mot clé '$mot_cle'</center></th></tr>";
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
            echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

            echo "</tr>";
            $i++;
        }
        echo "</table><br>";
        echo "</div>";
    }


    //Afficher les pétitions selon le mot clé dans un table.
    if(isset($_POST['submit'])){
        $mot_cle = $_POST['mot_cle'];
        $sth = $dbco->prepare("SELECT * FROM petition where petition_text like '%$mot_cle%' ;");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='jumbotron'>";
        echo "<h3>Les pétitions avec le mot clé '$mot_cle' dans leur contenu</h3>";    
        echo "<table border='1' class='table table-dark table-hover'>";
        echo "<tr><th colspan='6'><center>Les pétitions avec le mot clé '$mot_cle'</center></th></tr>";
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
            echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";

            echo "</tr>";
            $i++;
        }
        echo "</table><br>";
        echo "</div>";
    }
    echo "</div>";

    //
    echo"<center>";
    echo "<div class='jumbotron'>";
    echo "<h3>Filtrage des pétition selon un id d'un utilisateur</h3>";
    echo "<form action='admin.php' method='post'>";
    echo "<input type='text' name='idcreateur' size='50'><br><br>";
    echo "<input type='submit' name='submit1' value='Rechercher' class='btn btn-secondary '>";  
    echo "</div>";
    echo "</form>";
    echo"</center>";
    //Afficher les pétitions selon l'id du createur dans un table.
    if(isset($_POST['submit1'])){   
        $idcreateur = $_POST['idcreateur'];
        $sth = $dbco->prepare("SELECT * FROM petition where user_id = '$idcreateur' ;");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='jumbotron'>";
        echo "<h3>Les pétitions de l'utilisateur '$idcreateur'</h3>";
        echo "<table border='1' class='table table-dark table-hover'>";
        echo "<tr><th colspan='6'><center>Les pétitions de l'utilisateur '$idcreateur'</center></th></tr>";
        echo "<tr>";
        echo "<th>Titre</th>";
        echo "<th>Date</th>";
        echo "<th>NombreAvec</th>";
        echo "<th>NombreContre</th>";
        echo "<th>Voir+</th>";
        echo "<th>Supprimer</th>";
        echo "</tr>";
        $i=0;
        foreach($resultat as $row){
            echo "<tr>";
            echo "<td>".$row['petition_titre']."</td>";
            echo "<td>".$row['petition_date']."</td>";
            echo "<td>".$row['avec']."</td>";
            echo "<td>".$row['contre']."</td>";
            echo "<td><a class='btn btn-secondary btn-block' href='voirpetadmin.php?id=".$row['petition_id']."'>Voir</a></td>";
            echo "<td><a class='btn btn-secondary btn-block' href='supppetadmin.php?id=".$row['petition_id']."'>Supprimer</a></td>";
            echo "</tr>";
            $i++;

        }
    }


    echo"<center>";
    echo "<div class='jumbotron'>";
    echo "<h3>Supprimer les pétition selon l'id d'un utilisateur</h3>";
    echo "<form action='admin.php' method='post'>";
    echo "<input type='text' name='idcreateur' size='50'><br><br>";
    echo "<input type='submit' name='submit2' value='Supprimer' class='btn btn-secondary '>";  
    echo "</div>";
    echo "</form>";
    echo"</center>";
    //supprimer tous les petition de l'utilisateur qui  selon idcreateur
    if(isset($_POST['submit2'])){
        $idcreateur = $_POST['idcreateur'];
        $sth = $dbco->prepare("DELETE FROM petition where user_id = '$idcreateur' ;");
        $sth->execute();
        echo "<div class='jumbotron'>";
        echo "<h3>Les pétitions de l'utilisateur '$idcreateur' ont été supprimées</h3>";
        echo "</div>";
    }
}
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>