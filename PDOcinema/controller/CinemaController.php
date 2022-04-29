<?php

namespace Controller;

use Model\Connect;

class CinemaController
{

    public function listFilm()
    {
         // Requete pour afficher le détail de l'acteur choisi
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
             SELECT f.id_film, f.titre, DATE_FORMAT(SEC_TO_TIME(f.duree * 60), '%H:%i') AS dureeHeures, DATE_FORMAT(f.date_sortie, '%d-%m-%Y') AS dateSortie, r.prenom, r.nom 
             FROM film f 
             INNER JOIN realisateur r ON f.realisateur_id = r.id_realisateur
             ORDER BY titre
        ");
        require "view/listFilm.php";
    }

    public function detailFilm($id)
    {
         // Requete pour afficher le détail du film choisi
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
             SELECT id_film, titre, DATE_FORMAT(SEC_TO_TIME(duree * 60), '%H:%i') AS dureeHeures, DATE_FORMAT(date_sortie, '%d-%m-%Y') AS dateSortie, libelle
             FROM film f
             INNER JOIN genre g ON f.genre_id = g.id_genre
             WHERE id_film = :id
             ORDER BY titre
        ");
        $requete->execute([
            "id" => $id
        ]);
        // requete pour afficher le casting dans le detail du film choisi
        $requete2 = $pdo->prepare("
           SELECT a.id_acteur, a.prenom, a.nom, r.libelle 
           FROM acteur a
           INNER JOIN casting c ON a.id_acteur = c.acteur_id
           INNER JOIN film f ON c.film_id = f.id_film
           INNER JOIN role r ON c.role_id = r.id_role
           where f.id_film = :id
        ");
        $requete2->execute([
            "id" => $id
        ]);
        require "view/detailFilm.php";
    }
    
    public function displayAddFilm(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
             SELECT id_realisateur, prenom, nom
             FROM realisateur 
             ORDER BY prenom
        ");
        $pdo = Connect::seConnecter();
        $requete2 = $pdo->query("
             SELECT id_genre, libelle
             FROM genre
             ORDER BY libelle
        ");
        require "view/displayAddFilm.php";
    }

    public function displayModifFilm($id){
        $pdo = Connect::seConnecter(); 
        $requete = $pdo->prepare("
           SELECT id_film, titre, duree, date_sortie, realisateur_id, genre_id
           FROM film
           WHERE id_film = :id 
        ");
        $requete_realisateur = $pdo->query("
        SELECT id_realisateur, prenom, nom
        FROM realisateur 
        ");
        $requete_genre = $pdo->query("
             SELECT id_genre, libelle
             FROM genre
        ");
        $requete->execute([
            "id" => $id
        ]);
        require "view/displayModifFilm.php";
    }

    public function addFilm() {

        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_sortie = filter_input(INPUT_POST, 'date_sortie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $realisateur_id = filter_input(INPUT_POST, 'realisateur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genre_id = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($titre && $date_sortie && $duree && $realisateur_id && $genre_id) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
        INSERT INTO film (titre, date_sortie, duree, realisateur_id, genre_id)
        VALUES (:titre, :date_sortie, :duree, :realisateur_id, :genre_id)
        ");
        $requete->execute([
            'titre' => $titre,
            'date_sortie' => $date_sortie,
            'duree' => $duree,
            'realisateur_id' => $realisateur_id,
            'genre_id' => $genre_id
        ]);
        header('Location: index.php?action=listFilm');
        die();
        } else{
            echo 'Service indisponible';
        }
    }

    public function modifFilm($id)
    {
        // var_dump($_POST);
        $modif_titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_date_sortie = filter_input(INPUT_POST, 'date_sortie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_realisateur = filter_input(INPUT_POST, 'realisateur', FILTER_SANITIZE_SPECIAL_CHARS);
        $modif_genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if ($modif_titre && $modif_duree && $modif_date_sortie && $modif_realisateur && $modif_genre){
        //    echo "ok";die;
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
               UPDATE film
               SET titre = :modif_titre,
               duree = :modif_duree,
               date_sortie = :modif_date_sortie,
               realisateur_id = :modif_realisateur
               genre_id = :modif_genre
               WHERE id_film = :id
            ");
            $requete->execute([
                'modif_titre' => $modif_titre,
                'modif_duree' => $modif_duree,
                'modif_date_sortie' => $modif_date_sortie,
                'modif_realisateur' => $modif_realisateur,
                'modif_genre' => $modif_genre,
                'id' => $id
            ]);
            header('Location: index.php?action=listFilm');
            die();
        } else {
            echo 'Service indisponible';
        }
    }

    public function supprFilm($id){
        $pdo = Connect::seConnecter(); 
        $requete = $pdo->prepare("
             DELETE FROM casting
             WHERE film_id = :id
        ");
        $requete->execute([
            'id' => $id
        ]);
        $requete2 = $pdo->prepare("
             DELETE FROM film
             WHERE id_film = :id
        ");
        $requete2->execute([
            'id' => $id
        ]);
        header('Location: index.php?action=listFilm');
    }
}
