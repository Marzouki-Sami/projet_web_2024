<?php
if(isset($_POST['nom']) and isset($_POST['pnom']) and isset($_POST['mail']) and isset($_POST['mdp']) and isset($_POST['epa'])) {
//recuperation des donnees de la formilaire
$nom = $_POST['nom'];
$pnom = $_POST['pnom'];
$mail = $_POST['mail'];
$mdp = $_POST['mdp'];
$epa = $_POST['epa'];
if(isset($_POST['photo']))
    $img = $_POST['photo'];
else
    $img = null;
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';
//connction a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Sélectionne toutes les mail dans la table users
    $sth = $dbco->prepare("SELECT user_mail FROM utilisateur");
    $sth->execute();

    //Retourne un tableau associatif pour chaque entrée de notre table avec le nom des colonnes sélectionnées en clefs
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    //tester si un utilisateur existe déjà selon le mail dans la table users si oui on ne le crée pas sinon on le crée
    $existe = false;
    foreach($resultat as $row){
        if($row['user_mail'] == $mail){
            $existe = true;
        }
    }

    if($existe == false){
        $sth = $dbco->prepare("INSERT INTO utilisateur (user_nom,user_pnom,user_mail,user_mdp,user_profession) VALUES (:nom,:pnom,:mail,:mdp,:epa)");
        $sth->bindParam(':nom', $nom);
        $sth->bindParam(':pnom', $pnom);
        $sth->bindParam(':mail', $mail);
        $sth->bindParam(':mdp', $mdp);
        $sth->bindParam(':epa', $epa);
        $sth->execute();

        $sth = $dbco->prepare("INSERT INTO table_img (mail,type,taille,bin) VALUES (?,?,?,?)");
        $sth->execute(array($mail,$_FILES['photo']['type'],$_FILES['photo']['size'],file_get_contents($_FILES['photo']['tmp_name'])));
        //redirection vers la page login
        header("Location:login.php");
    }
    else{
        //stay on the same page
        echo "<script> alert('mail deja utilisé');window.location.href='signin.php'; </script>";
    }
}             
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
} 
}
?>