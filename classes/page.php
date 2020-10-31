<?php
//Pour Masquer toutes les erreurs de php
//ini_set('display_errors', 'off');

class Page {

    private $template;
    private $perso;


    function __construct(){
        $this->template = "";
    }

    function __toString(){
        $contenu = file_get_contents($this->template."index.twig");

        foreach ($this->perso as $key => $value) {
            $contenu = str_replace("{{ $key }}", $value, $contenu);
        }
        return $contenu;
    }

    function prepare(){
        global $dbh;
        global $gens;
        global $num;

        $_SESSION["autoriser"] = isset($_SESSION["autoriser"]) ? $_SESSION["autoriser"] : NULL;
        $_SESSION["pseudo"] = isset($_SESSION["pseudo"]) ? $_SESSION["pseudo"] : NULL;
        $_SESSION["articles"] = isset($_SESSION["articles"]) ? $_SESSION["articles"] : NULL;

        $tmp = '';
        $tmp2 = '';
        $tmp3 = '
            <input type="search" name="search" class="form-control form-control-sm d-none d-lg-inline-block mr-sm-2" placeholder="Search">
            <button type="submit" name="find" class="btn btn-sm btn-outline-dark d-none d-lg-inline-block my-2 my-sm-0" >Search</button>
        ';
        
        if($_SESSION["autoriser"]!="oui"){
            $tmp .= '
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">login</a>
                </li>';
        } else {
            if  ($_SESSION["pseudo"]== "Admin") {
                $tmp .= '
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dashboard
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=administration">Administration</a>
                        <a class="dropdown-item" href="index.php?page=gestion">Gestion</a>
                    </li>
                ';
            } else {
                $tmp .= '
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=reservation">Réservations</a>
                    </li>';
                }
                $tmp2 .= $_SESSION["pseudo"].' [<a href="index.php?page=logout">logout</a>]';
        }
        

        $search = "";
        $request= "";
        $articles= "";
        if (isset($_POST['find'])) {
            $search = strtolower(trim(htmlspecialchars($_POST['search'])));
            $request = $dbh->query("SELECT id FROM etagere where titre LIKE '%$search%' OR artiste LIKE '%$search%'");
            
            $articles = $request->fetchAll();
            $_SESSION['articles']=$articles;
            header('location:index.php?page=search');
        }
        

        $x = array ("isConnect" => $tmp);
        $usr = array ("usr" => $tmp2);
        $searchin = array ("searching" => $tmp3);
        
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page= "home";
        }
        include "router/$page.php";

        $this->perso = array_merge ($texte, $usr, $searchin, $x);

    }
}

?>