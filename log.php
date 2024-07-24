<?php
//recuperation des donnees
if(isset($_POST['mail']))
    $mail = $_POST['mail'];
if(isset($_POST['mdp']))
    $mdp = $_POST['mdp'];
SESSION_START();
$_SESSION['mail'] = $mail;
//information de connexion
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';

//connction a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //tester si un utilisateur existe déjà selon le mail dans la table users 
    $sth = $dbco->prepare("SELECT user_mail,user_mdp FROM utilisateur");
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    $existe = false;
    foreach($resultat as $row){
        if($row['user_mail'] == $mail && $row['user_mdp'] == $mdp){
            $existe = true;
            break;
        }
        else{
            $existe = false;
        }
    }
    //si il existe on le redirige vers la page home.php avec le mail et l'id de l'utilisateur
    if($existe){
        //select l'id de l'utilisateur qui a le mail
        $sth = $dbco->prepare("SELECT user_id,user_profession FROM utilisateur WHERE user_mail = :mail");
        $sth->bindParam(':mail', $mail);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultat as $row){
            $id = $row['user_id'];
            $profession = $row['user_profession'];
        }
        $_SESSION['mail'] = $mail;
        $_SESSION['id'] = $id;
        if($profession == "admin"){
            header("Location: admin.php");
        }
        else if($profession == "etudiant"){
            header("Location: home.php");
        }
        else if($profession == "prof"){
            header("Location: home.php");
        }
    }
    else{
        //rester sur la meme page
        echo "<script> alert('mail ou mdp inccorecte');window.location.href='login.php'; </script>";
    }
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>