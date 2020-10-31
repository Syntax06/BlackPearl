<?php

@$login=$_POST["login"];
@$password=md5($_POST["password"]);
@$valider=$_POST["valider"];
$erreur="";

$_SESSION["iforgot"] = isset($_SESSION["iforgot"]) ? $_SESSION["iforgot"] : NULL;


if(isset($valider)){
   $sel=$dbh->prepare("select * from users where login=? and password=? limit 1");
   $sel->execute(array($login,$password));
   $tab=$sel->fetchAll();
   if(count($tab)>0){
      $_SESSION["pseudo"]=ucfirst(strtolower($tab[0]["login"]));
      $_SESSION["autoriser"]="oui";
      header("location: index.php?page=session");
   }
   else
      $erreur="Mauvais login ou mot de passe!";
}

$contenu = '
<section id="pageLogin" class="d-flex flex-column justify-content-center align-content-center">
    <div class="container">
        <h1>Login</h1>

        <div class="erreur clignote">'.$erreur.'</div>
        <div class="iforgot">'.$_SESSION["iforgot"].'</div>
        <form name="fo" method="post" action="" class="d-flex flex-column">
            <input type="text" placeholder="login" name="login" required>
            <input type="password" placeholder="password" name="password" required>
            <input type="submit" name="valider" class="btn btn-secondary" value="Se connecter">
        </form> 
        [<a href="index.php?page=logincreation">Créer votre compte</a>]
        [<a href="index.php?page=forgot">Forgot</a>]
    </div>
</section>
';

$texte = array ("contenu" => $contenu);
