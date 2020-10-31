<?php
$contenu = "";

@$login=$_POST["login"];
@$password=$_POST["password"];
@$repass=$_POST["repass"];
@$valider=$_POST["valider"];
$erreur="";

if(isset($valider)){
    if(empty($login)) $erreur="Login laissé vide!";
    elseif(empty($password)) $erreur="Mot de passe laissé vide!";
    elseif($password!=$repass) $erreur="Mots de passe non identiques!";
    else{
        $sel=$dbh->prepare("select id from users where login=? limit 1");
        $sel->execute(array($login));
        $tab=$sel->fetchAll();
        if(count($tab)>0) {
        $erreur="Login existe déjà!";
    } else {
        $ins=$dbh->prepare("insert into users(login,password) values(?,?)");
        if($ins->execute(array($login,md5($password))))
            header("location: index.php?page=login");
        }   
    }
}

$contenu = '
<section id="pageLoginCreation" class="d-flex flex-column justify-content-center align-content-center">
    <div class="container">
        <h1>Login Creation</h1>

        <div class="erreur clignote">'.$erreur.'</div>
        <form name="fo" method="post" action="" class="mt-3">
            <input type="text" name="login" placeholder="login" class="w-50 mb-3"/><br>
            <input type="password" name="password" placeholder="Mot de passe" />
            <input type="password" name="repass" placeholder="Confirmation" /><br />
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-danger m-4" />
        </form>
    </div>
</section>
';



$texte = array ("contenu" => $contenu);