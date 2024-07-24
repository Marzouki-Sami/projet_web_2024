<?php
SESSION_START();
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];  
}  
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';

//connction a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=localhost;dbname=pweb", "root", "");
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
        //if isset nom modifier nom 
        if(isset($_POST['nom'])){
            $nom = $_POST['nom'];
            $sth = $dbco->prepare("UPDATE utilisateur SET user_nom = :nom WHERE user_id = :id");
            $sth->bindParam(':nom', $nom);
            $sth->bindParam(':id', $id);
            $sth->execute();
        }
        //if isset prenom modifier prenom
        if(isset($_POST['prenom'])){
            $prenom = $_POST['prenom'];
            $sth = $dbco->prepare("UPDATE utilisateur SET user_prenom = :prenom WHERE user_id = :id");
            $sth->bindParam(':prenom', $prenom);
            $sth->bindParam(':id', $id);
            $sth->execute();
        }
        //if isset mdp modifier mdp
        if(isset($_POST['mdp'])){
            $mdp = $_POST['mdp'];
            $sth = $dbco->prepare("UPDATE utilisateur SET user_mdp = :mdp WHERE user_id = :id");
            $sth->bindParam(':mdp', $mdp);
            $sth->bindParam(':id', $id);
            $sth->execute();
        }
        //if isset mail modifier mail
        if(isset($_POST['mail'])){
            $mail = $_POST['mail'];
            $sth = $dbco->prepare("UPDATE utilisateur SET user_mail = :mail WHERE user_id = :id");
            $sth->bindParam(':mail', $mail);
            $sth->bindParam(':id', $id);
            $sth->execute();
        }
    
    //rester sur la meme page
    echo "<script> alert('profile modifier avec succes');window.location.href='profile.php'; </script>";
}

catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>