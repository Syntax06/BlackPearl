<?php
$contenu="";
$articles=$_SESSION['articles'];

$listID = array();
$i = 0;
foreach($articles as $val) {
	if (!in_array($val["id"], $listID)) {
		$listID[$i] = $val["id"];
		$num=($val["id"]);
		foreach( $dbh->query("SELECT E.id as choix, titre, pochette, E.prix, P.prix AS tarif, artiste, E.categorie, C.cat AS cat 
		FROM etagere E,prix P, categorie C, compersonnalise S WHERE $num=E.id AND E.prix=P.id AND E.categorie=C.id") as $disque){}


		
		$contenu .= " 
                    <div class='col-md-4'>
                        <img src='assets/disc/".$disque['pochette']."' alt='couverture vinyl' class='card-img stx-margint'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>".$disque['titre']."</h5>
                            <p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p><br>".$disque['artiste']." <br>".$disque['cat']." <br>".$disque['tarif']."€  </p>
                            <button class='btn btn-outline-dark'>le reserver</button>
                        </div>
                    </div>";
				}
	
	$i++;
}


$dbh= NULL;

$texte = array ("contenu" => $contenu);