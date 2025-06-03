<?php
$servername="localhost:3302";
$username="root";
$dbname="ecommerce";
$password="";
try{
    $pdo=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
   echo "error".$e->getMessage();
}
?>
