<?php
$username='localhost';
$servername='root';
$password='';
try{
    $pdo=new PDO("mysql:host=$username;dbname=projets",$servername,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOEXCEPTION $e){
    die("erreur". $e->getmessage());
} 
?>
