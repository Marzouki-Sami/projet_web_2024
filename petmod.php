<?php
SESSION_START();

if(isset($_SESSION['id'])){
    $idu = $_SESSION['id'];
}

if(isset($_SESSION['idp'])){
    $id = $_SESSION['idp'];
}

// recuperation des donnees du formulaire
if(isset($_POST['titremod']))
    $titre = $_POST['titremod'];
if(isset($_POST['contenumod']))
    $contenu = $_POST['contenumod'];   
    

//information de connexion
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';
//connction a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //modification de petition
    //si la petition existe selon l'id alors on test si le titre et le contenu ne son pas vide on les modifie siono on affiche un message d'erreur
    if(isset($_POST['titremod']) && isset($_POST['contenumod'])){
        //selction tous les petitions
        $sth = $dbco->prepare("SELECT * FROM petition");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        $existe = false;
        foreach($resultat as $row){
            if($row['petition_id'] == $id && $row['user_id'] == $idu){
                $existe = true;
                
                    $sth = $dbco->prepare("UPDATE petition SET petition_titre = :titre WHERE petition_id = :id");
                    $sth->bindParam(':titre', $titre);
                    $sth->bindParam(':id', $id);
                    $sth->execute();
                
                    $sth = $dbco->prepare("UPDATE petition SET petition_text = :contenu WHERE petition_id = :id");
                    $sth->bindParam(':contenu', $contenu);
                    $sth->bindParam(':id', $id);
                    $sth->execute();
                    echo "<script> alert('petition modifier avec succes');window.location.href='home.php'; </script>";
                    
                break;
            }
        }
        if(!$existe){
            echo "<script> alert('vous ne pouvez pas modifier cette petition');window.location.href='home.php'; </script>";
            
        }
    }  
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>