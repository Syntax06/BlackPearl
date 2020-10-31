<?php

   if($_SESSION["autoriser"]!="oui"){
      header("location:index.php?page=login");
      exit();
   }

   if(date("H")) {
      $bienvenue=(date("H")+1).'h'.(date("i")).
      ", il était temps de nous rejoindre...";
   } 
   // else { 
   //    $bienvenue=(date("H")+1).'h'.(date("i"))."<br>Bonsoir et bienvenue ".
   //    $_SESSION["pseudo"]." dans votre espace personnel";
   // }

$contenu = '
<section id="pageSession" class="d-flex flex-column justify-content-center align-content-center m-5 bg-light">
      <div class="container m-5 bg-light">
      <h1>Welcome '.$_SESSION["pseudo"].' !</h1>
      <h3>'.$bienvenue.'</h3>

      <img width="50%" class="mt-5" src="assets/dpvynil.gif" />
      
      </div>
</section>
';

$texte = array ("contenu" => $contenu);