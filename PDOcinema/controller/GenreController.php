<?php

namespace Controller;
use Model\Connect;

class GenreController {

    public function listGenre() {
         // Requete pour afficher la liste des genres
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
             SELECT id_genre, libelle
             FROM genre 
             ORDER BY id_genre
        ");
        require "view/listGenre.php";
    }
}