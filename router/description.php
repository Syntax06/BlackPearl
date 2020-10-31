<?php
$num=$_SESSION['info'];
$erreur="";
$soongood="";
$contenu="";

if (isset($_POST['reserver'])){
    echo $num;echo $_POST['reserver'];echo $client;
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
}else{$contenu .="Tu dois être enregistré si tu veux réserver des titres</b></div>";}
}

if(isset($_POST['envoicom'])){
    if(empty( $_POST['nom'])) $erreur="Il manque un pseudo pour envoyer le commentaire";
    elseif(empty($_POST['commentaire'])) $erreur="Un commentaire, c'est mieux avec des mots !";
    elseif(empty($_POST["etoile"])) $erreur="Mets des étoiles";
    else{
    $req= $dbh->prepare("INSERT INTO compersonnalise (id, nom, commentaire, etoile, album) VALUES(NULL, :nom, :commentaire, :etoile, :album)");  //colonne dans la base
    $req->BindParam(":album", $num);
    $req->BindParam(":nom", $_POST["nom"]);
    $req->BindParam(":commentaire", $_POST["commentaire"]);
    $req->BindParam(":etoile", $_POST['etoile']);
    $req->execute();
    $soongood="Ton commentaire a bien été ajouté";
    }

}

$contenu .= " 
<section class='container'> 
<div class='stx-marginb'>
    <a href='index.php?page=catalogue' class='btn btn-outline-dark mb-3'>retour</a> 
        <p class='clignote'><b>".$erreur."</b></p>
        <p style='color:green;'><b>".$soongood."</b></p>
    </div>
    <div class='row'>
        <div class='col-6'>
            <div class='card mb-3 p-3 bg-light' style='max-width: 540px;'>
                <div class='row no-gutters'>";
                        foreach( $dbh->query("SELECT E.id, titre, pochette, E.prix, P.prix AS tarif, artiste, E.categorie, C.cat AS cat 
                        FROM etagere E,prix P, categorie C, compersonnalise S WHERE $num=E.id AND E.prix=P.id AND E.categorie=C.id") as $disque){}
                        $contenu .= " 
                    <div class='col-md-4'>
                        <img src='assets/disc/".$disque['pochette']."' alt='couverture vinyl' class='card-img stx-margint'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>".$disque['titre']."</h5>
                            <p>- ".$disque['artiste']." -<br>".$disque['cat']."</p>
                            <p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p><br>".$disque['tarif']."€  </p>
                       <!--     <button class='btn btn-dark' name='reserver' value='".$num."'>Réserver</button> -->
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <div class='col-6 card-body'>
            <form method='post' class='d-flex flex-column justify-content-center align-items-center'>
                <input type='text' class='form-control w-50' placeholder='pseudo' name='nom' value='".$_SESSION["pseudo"]."'>
                <div class='col-4 justify-content-center etoile w-100'>
                    <input type='radio' id='star5' name='etoile' value='5' />
                    <label for='star5' title='text'>5 stars</label>
                    <input type='radio' id='star4' name='etoile' value='4' />
                    <label for='star4' title='text'>4 stars</label>
                    <input type='radio' id='star3' name='etoile' value='3' />
                    <label for='star3' title='text'>3 stars</label>
                    <input type='radio' id='star2' name='etoile' value='2' />
                    <label for='star2' title='text'>2 stars</label>
                    <input type='radio' id='star1' name='etoile' value='1' />
                    <label for='star1' title='text'>1 star</label>
                </div>  


                <div class='form-group w-75 justify-content-center'>
                    <textarea class='form-control' name='commentaire' rows='4' placeholder='un commentaire sur l album...'></textarea>
                </div>

                <input class='btn btn-outline-dark w-50' type='submit' name='envoicom' value='envoyer le commentaire'></input>

            </form>
        </div>
    </div>
    <hr>
    <div class='row'>
    ";
            foreach( $dbh->query("SELECT nom as pseudo, commentaire as com, etoile, album, datecom,DATE_FORMAT(`datecom`, \"posté le %d/%m/%Y à %H:%i\") as comm
            FROM compersonnalise WHERE $num=album") as $comment){
            $contenu .= "  
            <div class='col-4'>
                <div class='card border-secondary mb-3' style='max-width: 18rem;'>
                    <div class='card-header bg-dark border-secondary stx-star mb-0'>";
                        for($i=0;$i<$comment['etoile'];$i++){
                        $contenu .=" <img src='assets/star.png' alt ='notation all stars'>";
                        }
                        $contenu .= "
                    </div>
                        <div class='card-body bg-light text-secondary'>
                            <h5 class='card-title text-danger'>".$comment['pseudo']."</h5>
                            <p class='card-text'>".$comment['com']."</p>
                        </div>
                    <div class='card-footer bg-light text-muted border-secondary'>".$comment['comm']."</div>
                </div>
            </div>"; 
            }    
            $contenu .=   "   
        </div> 
    </div>
</section>";

     $texte = array ("contenu" => $contenu);