<?php

if($_SESSION["autoriser"]!="oui"){
    header("location:index.php?page=login");
    exit();
}
$contenu ='';
$contenu .= '
<section id="pageGestion" class="d-flex flex-column justify-content-center align-content-center">
    <div class="container ">
        <h1 class="mb-3">Inventaire & Gestion</h1>
';

$contenu .= "
<form method='POST'>
    <input type='submit' class='btn btn-outline-success' name='cmd' value='Ajouter'>
</form>";
// $contenu .= "<br><h2>Informations sur les disques</h2><br>";
$dbh->query('SET NAMES UTF8');

if(isset($_POST['cmd'])){
    
    $cmd = $_POST['cmd'];
        
    switch($cmd){

        case "Ajouter":
            $contenu .= "<form method='POST' enctype='multipart/form-data's>

                <br><input type='text' name='titre' placeholder='Titre de la chanson'>
                <input type='text' name='artiste' placeholder='Artiste'>
                <p class='mx-auto m-2'><input type='file' name='pochette' /></p>
                <br><select class='custom-select w-25 mb-2' name='categorie'>";

                foreach($dbh->query("SELECT id, cat FROM categorie") as $ligne){
                   $contenu .= "<option value=".$ligne['id'].">".$ligne['cat']."</option>";
                }

                $contenu .= "</select>
                <br><select class='custom-select w-25 mb-4' name='prix'>";

                foreach($dbh->query("SELECT id, prix FROM prix") as $ligne){
                    $contenu .= "<option value=".$ligne['id'].">".$ligne['prix']."</option>";
                }
                $contenu .= "</select>

                <br><input type='submit' class='btn btn-success' name='cmd' value='creer'>";

                $contenu .="</form>";

                

 
            // Insertion du message à l'aide d'une requête préparée

        break;

        case "creer":
          if(isset($_FILES['pochette']))
          {
               $image = ($_FILES['pochette']['name']);
               $target = "assets/"."disc/".basename($image);

               if(move_uploaded_file($_FILES['pochette']['tmp_name'], $target)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
               {
                    $contenu .= 'Upload effectué avec succès !';
               }
               else //Sinon (la fonction renvoie FALSE).
               {
                    $contenu .= 'Echec de l\'upload !';
               }
               
          }
                 
            $req = $dbh->prepare("INSERT INTO etagere (id, pochette, titre, artiste, categorie, prix) 
            VALUES(NULL, :image, :titre, :artiste, :categorie, :prix)");
            $req->BindParam(":titre", $_POST['titre']);
            $req->BindParam(":artiste", $_POST['artiste']);
            $req->BindParam(":image", $image);
            $req->BindParam(":categorie", $_POST['categorie']);
            $req->BindParam(":prix", $_POST['prix']);

            if($req->execute()){
                    $contenu .= "Le titre ".$_POST['titre']." a bien été ajouté";
                }else{
                    $contenu .= "Le titre ".$_POST['titre']." n'a pas été ajouté";
                }
        break;

        default:
        $contenu .= "<h2>Commande Inconnue</h2>";
    }
}

$contenu .= "
<form method='POST'>
                                                                                    
<table class='m-5 table table-hover table-dark w-75 mx-auto'>
    <thead>
        <tr>
            <td>
                Titre
            </td>
            <td>
                Artiste
            </td>
            <td>
                Pochette
            </td>
            <td>
               Catégorie
            </td>
            <td>
                Prix
            </td>
        </tr>
    </thead>
    <tbody>";
    if(isset($_POST["valider"])){
        $titre=$_POST["titre"];
        $artiste=$_POST["artiste"];
        $categorie=$_POST["categorie"];
        $prix=$_POST["prix"];
        $pochette=$_POST["pochette"];
        $z=$_POST["valider"];

      $dbh->query("UPDATE etagere
       SET titre='$titre', artiste='$artiste', pochette='$pochette', categorie='$categorie', prix='$prix'
       WHERE $z=id");
       $contenu .= "
       <h2 style='color:green'>Votre modification a bien été enregistrée<h2>";
    }
    



        if(isset($_POST['modifier'])){
            $z=$_POST["modifier"];
        foreach( $dbh->query("SELECT id, titre, pochette, artiste, categorie, prix FROM etagere E WHERE id='$z'") as $ligne) {
    
        $contenu .= "
         
            <tr class='table-secondary'>
                <td>
                <input type='text' name='titre' value='".$ligne['titre']."'>
                </td>
                <td>
                <input type='text' name='artiste' value='".$ligne['artiste']."'>
                    
                </td>
                <td>
                <input type='text' name='pochette' value='".$ligne['pochette']."'>
                </td>
                <td>
                <!--class='custom-select'-->

                <select name='categorie'>";

                foreach($dbh->query('SELECT id, cat FROM categorie') as $colonne){
                    if($colonne["id"]==$ligne["categorie"]){
                        $contenu .= "<option  selected value=".$colonne['id']." >".$colonne['cat']."</option>";
                    }else{
                        echo "<br>".$ligne["categorie"];
                        echo $colonne["id"];
                    
                    $contenu .= "<option value=".$colonne["id"].">".$colonne['cat']."</option>";
                }
                

                }
                $contenu .= "</select>
                </td>
                <td>
                <!--class='custom-select'-->

                <select  name='prix'>";
                foreach($dbh->query('SELECT id, prix FROM prix') as $croix){
                    if($croix["id"]==$ligne["prix"]){
                        $contenu .= "<option selected value=".$croix['id'].">".$croix['prix']."</option>";
                    }else{
                    $contenu .= "<option value=".$croix['id'].">".$croix['prix']."</option>";}
                }
                $contenu .= "</select>

                </td>
                <td>
                <button type='submit' class='btn btn-sm btn-outline-success' name='valider' value='".$z."'>valider</button>
                
                </td>
            </tr>";
    // }}
   }}

    foreach( $dbh->query("SELECT E.id as num, titre, pochette, E.prix, P.prix AS tarif, artiste, E.categorie, C.cat AS cat 
    FROM etagere E,prix P, categorie C WHERE E.prix=P.id AND E.categorie=C.id ORDER BY titre") as $ligne) {
    // $changement = "close";
    $num=$ligne["num"];

    $contenu .= "
            <tr>
                <td>
                    ".$ligne['titre']."
                    
                </td>
                <td>
                    ".$ligne['artiste']."
                </td>
                <td>
                    ".$ligne['pochette']."
                </td>
                <td>
                    ".$ligne['cat']."
                </td>
                <td>
                    ".$ligne['tarif']." €
                </td>
                
                <td>
               
                <button type='submit' class='btn btn-sm btn-outline-warning' name='modifier' value='".$num."'>modifier</button>
                </td>
            </tr>";
    }

        $contenu .= "</tbody> 
    </table>

</form>";

$contenu .= '
    </div>
</section>
';

$texte = array ("contenu" => $contenu);