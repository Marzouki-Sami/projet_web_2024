<?php

if(isset($_GET['id'])){
    $idp = $_GET['id'];
    //information de connexion  
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pweb';
    //connection a la base de donnees et verification de la connexion
    try{
        $dbco = new PDO("mysql:host=localhost;dbname=pweb", "root", "");
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //supprimer la petition avec l'id
        $sth = $dbco->prepare("DELETE FROM petition WHERE petition_id = :id");
        $sth->bindParam(':id', $idp);
        $sth->execute();
        //rester sur la meme page
        echo "<script> alert('petition supprimer avec succes');window.location.href='admin.php' </script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
?>