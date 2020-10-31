<?php

if($_SESSION["autoriser"]!="oui"){
    header("location:index.php?page=login");
    exit();
}

$contenu = "";

$contenu .= "
<div class='container-fluid text-center'>
    <h1>Administration</h1>
    <div class='row-cols'>

    <form method='post'>
        <input type='submit' name='addUser' value='addUser' class='btn btn-success mb-3'>
    </form>";

    if ( isset($_POST['addUser']) ) {
        $contenu = "
            <form method='post'>

                <input type='text' name='login' placeholder='login'>
                <input type='text' name='password' placeholder='password'>
                <input type='submit' name='newUser' value='newUser' class='btn btn-sm btn-success'>
            </form>
        ";
    }

    if (isset($_POST["newUser"]) ) {

        $req=$dbh->prepare("INSERT INTO users(login,password) values(:login, md5(:password))");
        
        $req->BindParam(":login",$_POST['login']);
        $req->BindParam(":password",$_POST['password']);

        if ($req->execute()) {
            
            $contenu = "Nouvel user ".$_POST['login']." ajouté";
        } else {
            $contenu = $_POST['login']." n'a pas été ajouté";
        }

    }
    
    // if (isset($_POST['delete'])){
    //     $req = $dbh->prepare("DELETE FROM users WHERE id=:id");
    //           $req ->BindParam(':id',$_POST['delete']);
    //           $req->execute();
    //           echo $_POST['login']." supprimé.";
    // }


$contenu .= "
    <form method='post'>
        <input type='submit' name='adminTab' value='Users' class='btn btn-sm btn-outline-secondary'>
        <input type='submit' name='adminTab' value='Reservations' class='btn btn-sm btn-outline-secondary'>
        <input type='submit' name='adminTab' value='Commentaires' class='btn btn-sm btn-outline-secondary'>
    </form>";


    $contenu .= "
    <form method='post' class='d-flex justify-content-center'>
    ";

if(isset($_POST['adminTab'])) {
    $adminTab = $_POST['adminTab'];

    switch ($adminTab) {
        case 'Users':
            $contenu .= "
            <table class='m-5 table table-hover table-dark w-50'>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Login</td>
                    <td>Creation</td>
                </tr>
            </thead>
            <tbody>
            ";
            foreach ($dbh->query(" SELECT id, DATE_FORMAT(`date`, \"%d/%m/%Y à %H:%i\") as date, login FROM users ORDER BY login ") as $user) {
                $contenu .= "
                <tr>
                    <td>".$user['id']."</td>
                    <td>".$user['login']."</td>
                    <td>".$user['date']."</td>
                </tr>
                "; 
            }
            break;
        case 'Reservations':
            $contenu .= "
            <table class='m-5 table table-hover table-dark w-50'>
            <thead>
                <tr>
                    <td>Client</td>
                    <td>Artiste</td>
                    <td>Album</td>

                </tr>
            </thead>
            <tbody>
            ";
            foreach ($dbh->query(" SELECT R.id,  E.id,  U.id,  R.client,  R.produit,  titre, artiste AS tube , U.login AS nom 
                                    FROM resa R, users U, etagere E
                                    WHERE R.client=U.id AND R.produit=E.id ORDER BY client ") as $reservation) {
                $contenu .= "
                <tr>
                    <td>".$reservation['nom']."</td>
                    <td>".$reservation['tube']."</td>
                    <td>".$reservation['titre']."</td>
                </tr>
                "; 
            }

            break;
        case 'Commentaires':
            $contenu .= "
            <table class='m-5 table table-hover table-dark w-75'>
            <thead>
                <tr>
                    <td>Artiste</td>
                    <td>Titre</td>
                    <td>Auteur</td>
                    <td>Commentaire</td>
                    <td>Note</td>
                    <td>Date</td>
                </tr>
            </thead>
            <tbody>
            ";
            foreach ($dbh->query(" SELECT E.id, C.album, artiste, titre, C.id, nom, commentaire, etoile, datecom,DATE_FORMAT(`datecom`, \"%d/%m/%Y à %H:%i\") as comm
                                    FROM compersonnalise C, etagere E 
                                    WHERE E.id=C.album ") as $comment) {
                $contenu .= "
                <tr>
                    <td>".$comment['artiste']."</td>
                    <td>".$comment['titre']."</td>
                    <td>".$comment['nom']."</td>
                    <td>".$comment['commentaire']."</td>
                    <td>".$comment['etoile']."</td>
                    <td>".$comment['comm']."</td>
                </tr>
                "; 
                
            }
            break;
        
        default:
            $contenu = "You're lost";
            header('location: index.php?page=home');
            break;
    }

}

$contenu .= "</tbody></table></form>
</div></div>";



$contenu .= "";

$texte = array ("contenu" => $contenu);