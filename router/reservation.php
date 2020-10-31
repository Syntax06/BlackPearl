<?php
// if (isset($_SESSION['idclient'])){
//  $client=$_SESSION['idclient'];
// }else{$client="";}

$user=strtolower($_SESSION['pseudo']);
foreach( $dbh->query("SELECT id, login FROM users WHERE login='$user'") as $log){
$client=$log['id'];}

 $contenu ="";

$contenu .= "
<section id='pageReservation' class='mb-5'>
    <h1>Réservations</h1>
        <div class='container'>
        
";
   
    $contenu .= "
        <div class='row-cols d-flex flex-wrap'>";
                            foreach( $dbh->query("SELECT * FROM resa WHERE '$client'=client") as $id){
                            $produit=$id['produit'];
                            foreach( $dbh->query("SELECT E.id, titre, pochette, E.prix, P.prix AS tarif, artiste, E.categorie, C.cat AS cat 
                            FROM etagere E,prix P, categorie C, compersonnalise S WHERE $produit=E.id AND E.prix=P.id AND E.categorie=C.id") as $disque){}

                            $contenu .= " 
            <div class='card m-1 p-3 bg-light' style='max-width: 540px;'>
                <div class='row no-gutters justify-content-center'>
                    <div class='col-md-4'>
                        <img src='assets/disc/".$disque['pochette']."' alt='couverture vinyl' class='card-img stx-margint'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>".$disque['titre']."</h5>
                            <p>- ".$disque['artiste']." -<br>".$disque['cat']."</p>
                            <p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p><br>".$disque['tarif']."€  </p>
                        </div>
                    </div>
                </div>
            </div>";
                    };
                    $contenu .= "
        </div>
    </div>
</section>";
        
  
$texte = array ("contenu" => $contenu);