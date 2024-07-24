<?php
try{
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pweb';

$dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sth = $dbco->prepare("SELECT * FROM table_img WHERE mail=? limit 1");
$sth->setFetchMode(PDO::FETCH_ASSOC);
$sth->execute(array($_GET['mail']));
$result = $sth->fetchAll();
echo $result[0]["bin"];

}catch(PDOException $e){
echo "Erreur : " . $e->getMessage();
} 
?>