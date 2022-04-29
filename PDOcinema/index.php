<?php

use Controller\ActeurController;
use Controller\CinemaController;
use Controller\GenreController;
use Controller\RealisateurController;
use LDAP\Result;

spl_autoload_register(function ($class_name){
    include $class_name.'.php'; 
});
// nous initions nos controlleur après les avoir importer avec use
$ctrlCinema = new CinemaController();
$ctrlRealisateur = new RealisateurController();
$ctrlActeur = new ActeurController();
$ctrlGenre = new GenreController();

// Et nous appliquons  avec notre switch les possibilités d'actions. 
// Par ailleurs pour accéder à notre application nous appliquons en local l'url suivante :
//http://localhost/Exercices/PDOcinema/index.php?action=listFilm
if(isset($_GET["action"])){
    switch($_GET["action"]) {

        case "listFilm": $ctrlCinema->listFilm(); break;
        case "listRealisateur": $ctrlRealisateur->listRealisateur(); break;
        case "listActeur" : $ctrlActeur->listActeur(); break;
        case "listGenre" : $ctrlGenre->listGenre(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($_GET["id"]); break;
        case "detailActeur" : $ctrlActeur->detailActeur($_GET["id"]); break;
        case "displayAddActeur" : $ctrlActeur->displayAddActeur(); break;
        case "addActeur": $ctrlActeur->addActeur(); break;
        case "displayAddFilm": $ctrlCinema->displayAddFilm(); break;
        case "addFilm": $ctrlCinema->addFilm(); break;
        case "displayAddRealisateur" : $ctrlRealisateur->displayAddRealisateur(); break;
        case "addRealisateur" : $ctrlRealisateur->addRealisateur(); break;
        case "displayModifActeur" : $ctrlActeur->displayModifActeur($_GET["id"]); break;
        case "modifActeur" : $ctrlActeur->modifActeur($_GET["id"]); break;
        case "displayModifFilm" : $ctrlCinema->displayModifFilm($_GET["id"]); break;
        case "modifFilm" : $ctrlCinema->modifFilm($_GET["id"]); break;
        case "displayModifRealisateur" : $ctrlRealisateur->displayModifRealisateur($_GET["id"]); break;
        case "modifRealisateur" : $ctrlRealisateur->modifRealisateur($_GET["id"]); break;
        case "supprFilm" : $ctrlCinema->supprFilm($_GET["id"]); break;
        case "supprRealisateur" : $ctrlRealisateur->supprRealisateur($_GET["id"]); break;
        case "supprActeur" : $ctrlActeur->supprActeur($_GET["id"]); break;          
    } 
}