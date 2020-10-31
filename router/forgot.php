<?php

@$login=$_POST["login"];
@$valider=$_POST["valider"];
$erreur="";
$_SESSION["isFound"]=0;

if(isset($valider)){
   $sel=$dbh->prepare("select * from users where login=? limit 1");
   $sel->execute(array($login));
   $tab=$sel->fetchAll();
   if(count($tab)>0){
      $_SESSION["pseudo"]=ucfirst(strtolower($tab[0]["login"]));
      $_SESSION["isFound"]=1;

    //   header("location: index.php?page=login");
   }
   else
      $erreur="login inexistant!";
}

$contenu = '
<section id="pageLogin" class="d-flex flex-column vh-100 justify-content-center align-content-center mt-5">
    <div class="container">
        <h2 class="mb-3 mt-5">Mot de passe oublié</h2>
        ';
        if ($_SESSION["isFound"]===1) {
$contenu .= '<div>
                <p>Check tes mails pour valider la procédure.</a>
                <a href="index.php?page=login">revenir au login</a>
                
            </div>';
        }
$contenu .= '      
        <div class="erreur clignote">'.$erreur.'</div>
        <form name="fo" method="post" action="" class="d-flex flex-column">
            <input type="text" placeholder="login" name="login" required>
            <input type="submit" name="valider" class="btn btn-secondary w-75 mt-2 align-self-center" value="Remember">
        </form> 
        [<a href="index.php?page=logincreation">Créer votre compte</a>]
        <div class="mt-5" style="position:relative; padding-bottom:calc(81.63% + 44px)">
            <img src="./assets/forgot.gif" frameborder="0" scrolling="no" width="100%" height="100%" style="position:absolute;top:0;left:0;" allowfullscreen>
        </div>
    </div>
</section>
';

$texte = array ("contenu" => $contenu);
