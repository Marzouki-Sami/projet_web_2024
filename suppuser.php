<?php

if(isset($_GET['id'])){
    $idu = $_GET['id'];
    //information de connexion  
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pweb';
    //connection a la base de donnees et verification de la connexion
    try{
        $dbco = new PDO("mysql:host=localhost;dbname=pweb", "root", "");
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //supprimer l'utilisateur avec l'id
        $sth = $dbco->prepare("DELETE FROM utilisateur WHERE user_id = :id");
        $sth->bindParam(':id', $idu);
        $sth->execute();
        //rester sur la meme page
        echo "<script> alert('utilisateur supprimer avec succes');window.location.href='admin.php' </script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
?>