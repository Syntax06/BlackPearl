<?php
session_start();

$user = 'web001';
$pass = 'topsecret';
$connexion='mysql:host=localhost;dbname=disquaire';

try{
$dbh = new PDO($connexion, $user, $pass);
} catch (PDOException $e){
    if($e) {
        echo $e->getMessage();
    } else {
        header("location: erreur.html");
    }
}

$dbh->query("SET NAMES UTF8");

//Cookies Config >> REPLACE BY ADMIN
// if(isset($_POST['ok'])){
//     $gens=$_POST['gens'];
//     setcookie("gens", $gens, time()+3600);
// } elseif (!$_COOKIE['gens']){
//     $gens = 'visitor';
//     setcookie("gens", $gens, time()+3600);  /* expire dans 1 heure */
// }

?>
