<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
session_start();
//information de connexion
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';
//connction a la base de donnees et verification de la connexion
try{
    $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $idp = $_SESSION['idp'];
        $idu = $_SESSION['idu'];

        /* if($_POST['signe'] == 'avec')
            $signe = ;
        if($_POST['signe'] == 'contre')
            $signe = false; */ 
        $signe = $_POST['signe'];
        $commentaire = $_POST['commentaire'];

        $sth = $dbco->prepare("INSERT INTO petuser (user_id, petition_id, choix, commentaire) VALUES (:idu, :idp, :signe, :commentaire)");
        $sth->bindParam(':idp', $idp);
        $sth->bindParam(':idu', $idu);
        $sth->bindParam(':signe', $signe);
        $sth->bindParam(':commentaire', $commentaire);
        $sth->execute();
        //si le boutton est clique on incremente le nombre de signatures de la table petition
        if($signe == "avec"){
            $sth = $dbco->prepare("UPDATE petition SET avec = avec + 1 WHERE petition_id = :idp");
            $sth->bindParam(':idp', $idp);
            $sth->execute();
        }
        else{
            $sth = $dbco->prepare("UPDATE petition SET contre = contre + 1 WHERE petition_id = :idp");
            $sth->bindParam(':idp', $idp);
            $sth->execute();
        }
        //select la petition
        $sth = $dbco->prepare("SELECT * FROM petition WHERE petition_id = :idp");
        $sth->bindParam(':idp', $idp);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        //redirection vers la page de la petition
        echo "<script> alert('petition signer avec succes');window.location.href='petaff.php' </script>";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?> 