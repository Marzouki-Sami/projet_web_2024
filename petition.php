<?php
SESSION_START();
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];  
}  
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

// recuperation des donnees du formulaire
if(isset($_POST['titre']))
    $titre = $_POST['titre'];
if(isset($_POST['contenu']))
    $contenu = $_POST['contenu'];   
//information de connexion
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';

//connction a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //tester si la petition existe
    $sth = $dbco->prepare("SELECT * FROM petition");    
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    $existe = false;
    foreach($resultat as $row){
        if($row['petition_id'] == $id){
            $existe = true;
            break;
        }
    }

    if(!$existe){
        //insertion une nouvelle petition avec la date systeme et les donnees recuperees et l'id de l'utilisateur
    $sth = $dbco->prepare("INSERT INTO petition (petition_titre, petition_text, petition_date, user_id) VALUES (:titre, :contenu, NOW(), :id)");
    $sth->bindParam(':titre', $titre);
    $sth->bindParam(':contenu', $contenu);
    $sth->bindParam(':id', $id);
    $sth->execute();
    }
    echo "<script> alert('petition cree avec succes');window.location.href='home.php'; </script>";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>