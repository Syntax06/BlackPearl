<?php
$contenu = "";

$contenu .=  "<form method='POST' class='d-flex flex-row justify-content-center m-5'>
<div class='mr-3'>
    <input type='submit' name='order' value='titre' class='btn btn-sm btn-secondary mx-1'>
    <input type='submit' name='order' value='artiste' class='btn btn-sm btn-secondary mx-1'>
    <input type='submit' name='order' value='categorie' class='btn btn-sm btn-secondary mx-1'>
</div>
</form>
";


if ($_SESSION["pseudo"]=='Admin'){
    $contenu .=  "<a href='index.php?page=gestion' class='btn btn-sm btn-success'>Ajouter & Editer</a>";
}
// $order='?page=catalogue?';
if (isset($_POST['order'])){
    $order =$_POST['order'];
    if($order == 'categorie') {
        $order = 'cat';
    }
    }else{
      $order ='titre';
    }
    
 if (isset($_POST['info'])){
     $_SESSION['info']=$_POST['info'];
     header('location:index.php?page=description');
}


if (isset($_POST['reserver'])){
    if ($_SESSION["autoriser"]=="oui"){

    $user=strtolower($_SESSION['pseudo']);
    foreach( $dbh->query("SELECT id, login FROM users WHERE login='$user'") as $log){
    $client=$log['id'];
    };
    $reserver=$_POST['reserver'];
      $req = $dbh->prepare("INSERT INTO resa (id, client, produit) VALUES(NULL, :client, :produit)");
      $req->BindParam(":client",$client);
      $req->BindParam(":produit", $reserver);
      if ($req->execute()){$contenu .= "<div style='color:green;'><b>Le titre a été ajouté à ta page de réservation</b></div>";
    }
}else{$contenu .="<div class='clignote'><b>Tu dois être enregistré si tu veux réserver des titres</b></div>";}

}

if (isset($_POST['delete'])){
          $req = $dbh->prepare("DELETE FROM compersonnalise WHERE album=:id");
          $req ->BindParam(':id',$_POST['delete']);
          $req->execute();
          $teq = $dbh->prepare("DELETE FROM resa WHERE produit=:id");
          $teq ->BindParam(':id',$_POST['delete']);
          $teq->execute();
          $seq = $dbh->prepare("DELETE FROM etagere WHERE id=:id");
          $seq ->BindParam(':id',$_POST['delete']);
          $seq->execute();        

          $contenu .="<div class='clignote'><br><b>le titre a bien été supprimé</b></div>";
}

$contenu .= "  
<div class='container'>
<div class='row lsh_pad'>
";

foreach( $dbh->query("SELECT E.id as num, titre, pochette, E.prix, P.prix AS tarif, artiste, E.categorie, C.cat AS cat 
FROM etagere E,prix P, categorie C WHERE E.prix=P.id AND E.categorie=C.id ORDER BY $order") as $disque){
 $num=$disque['num'];
 $contenu .= "
 <div class='col-sm-4'>
    <div id='stx-cards' >
        <img src='assets/disc/".$disque['pochette']."' alt='couverture vinyl'>
        <div class=''>
            <h3 >".$disque['titre']."</h3>
        </div>
        <div class=''>
            <p class='lead'>- ".$disque['artiste']." -</p>
            <p class=''>".$disque['cat']." <br>".$disque['tarif']."€ </p>
        </div>
        <div class='button-contact'>";
            if ($_SESSION["pseudo"]=='Admin'){
                // <button class='btn btn-warning'>modifier</button>
                $contenu .=  "
                <form method='post'> 
                <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#exampleModal' name='delete' value='".$num."'>supprimer</button>
                </form>";
            } else {
                $contenu .=  "
                <form method='post'> 
                    <button class='btn btn-dark' name='reserver' value='".$num."'>Réserver</button>
                    <button class='btn btn-secondary' name='info' value='".$num."'>à propos</button>
                </form>";
            }            
            $contenu .= " 
        </div>
    </div>
</div>";
 
     }
     $contenu .= "
</div>
</div>";


$dbh= NULL;

$texte = array ("contenu" => $contenu);