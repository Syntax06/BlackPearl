<?php
  if (isset($_POST['info'])){
    $_SESSION['info']=$_POST['info'];
    header('location:index.php?page=description');
}

 $contenu = "
 <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
 <div class='modal-dialog modal-dialog-centered'>
   <div class='modal-content bg-dark'>
     <div class='modal-header'>
       <h5 class='modal-title text-light' id='exampleModalLabel'>3 jours allongé sur une plage...</h5>
       <button type='button' class='close text-light' data-dismiss='modal' aria-label='Close'>
         <span aria-hidden='true'>&times;</span>
       </button>
     </div>
     <div class='modal-body'>

     <div class='embed-responsive embed-responsive-16by9'>
     <iframe class='embed-responsive-item' src='assets/vid/jacksparrow.mp4' allowfullscreen></iframe>
   </div>

     </div>
   </div>
 </div>
</div>



 <!-- jumbotron -->
      <div class='jumbotron jumbotron-fluid'>
        <div class='container'>
          <h1 class='display-4'>Black Pearl Musical <img class='boat' src='assets/boat.png'></h1>
          <p class='lead mt-4 mb-0'>Les musiques du monde sont à quai près chez vous.</p>
        </div>
        <a class='btn btn-outline-danger btn-lg mt-5' href='#' role='button' type='button' data-toggle='modal' data-target='#exampleModal'>Pourparlers</a>

      </div>";

     
// début des 3 dernier album

$contenu .= "  
<div class='container-fluid'>
<h2>Voici les derniers Vinyls reçus dernièrement</h2>
  <div class='row'>

"
;

foreach( $dbh->query("SELECT E.id as num, titre, pochette, E.prix, P.prix AS tarif, artiste, E.categorie, C.cat AS cat 
FROM etagere E,prix P, categorie C WHERE E.prix=P.id AND E.categorie=C.id ORDER BY num DESC LIMIT 3  ") as $disque){
 $num=$disque['num'];

 $contenu .= "
  <div class='col-sm-4 mb-5 mb-sm-3'>
    <div id='stx-cards'>
      <img class='' src='assets/disc/".$disque['pochette']."' alt='couverture vinyl'>
      <div class=''>
        <div class=''>
          <h3>".$disque['titre']."</h3>
        </div>
        <div class=''>
          <p>".$disque['artiste']." <br>".$disque['cat']." <br>".$disque['tarif']."€  </p>
        </div>

        <form method='post'> 
          <button class='btn btn-secondary' name='info' value='".$num."'>à propos</button>
        </form>
      </div>
    </div>
  </div>

  <hr>
  <hr>
  <hr>
";
}
$contenu .="
<!-- cards -->
<div class='container'>
<h2 class='text-center'> Notre boutique est reconnue par les meilleurs</h2>
<div class='card-deck mb-5 mx-0'>
  <div class='card'>
    <img src='assets/sparrow.jpg' class='card-img-top' alt='Jack Sparrow kiff ce site'>
    <div class='card-body'>
      <h5 class='card-title'>Je Recommande</h5>
      <p class='card-text'>Franchement cette boutique est géniale, très bien située au coeur de Paris, elle a un large choix de disques pour les amateurs comme pour les professionnels</p>
      <p class='card-text'><small class='text-muted'>Jack Sparrow</small></p>
    </div>
  </div>
  <div class='card'>
  <img src='assets/acbf.jpg' class='card-img-top' alt='Altair a trouvé un nouveau credo'>
  <div class='card-body'>
    <h5 class='card-title'>Sound good</h5>Repéré depuis le toit de Notre-Dame, je m'y suis rendu sans trop de conviction mais depuis j'y suis tous les week-end car ils ont les derniers arrivages</p>
    <p class='card-text'><small class='text-muted'>Edwart</small></p>
  </div>
</div>
  <div class='card'>
    <img src='assets/bbnoire.jpg' class='card-img-top' alt='Barbe Noire a du gout'>
    <div class='card-body'>
      <h5 class='card-title'>Facile à trouver</h5>
      <p class='card-text'>J'ai garé mon bateau sur les quais Branly et j'y étais en 5min à pied, je voulais y mettre le feu mais elle est tellement cool que je pense y retourner.</p>
      <p class='card-text'><small class='text-muted'>Barbe Noire</small></p>
    </div>
  </div>
</div>
</div>";
      $contenu .= "</div>
      </div>";

      $texte = array ("contenu" => $contenu);