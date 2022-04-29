<?php

namespace Controller;
use Model\Connect;

class RealisateurController {

    public function listRealisateur() {
        // Requete pour afficher la liste des réalisateurs
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
             SELECT id_realisateur, prenom, nom, DATE_FORMAT(date_naissance, '%d-%m-%Y') AS date_Realisteur 
             FROM realisateur 
             ORDER BY prenom
        ");
        require "view/listRealisateur.php";
    }

    public function displayAddRealisateur() {
        require "view/displayAddRealisateur.php";
    }

    public function addRealisateur()
    {

        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($prenom && $nom && $sexe && $date_naissance) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
        INSERT INTO realisateur (prenom, nom, sexe, date_naissance)
        VALUES (:prenom, :nom, :sexe, :date_naissance)
        ");
            $requete->execute([
                'prenom' => $prenom,
                'nom' => $nom,
                'sexe' => $sexe,
                'date_naissance' => $date_naissance
            ]);
            header('Location:index.php?action=listRealisateur');
            die();
        } else {
            echo 'Service indisponible';
        }
    }

    public function displayModifRealisateur($id){
        $pdo = Connect::seConnecter(); 
        $requete = $pdo->prepare("
           SELECT id_realisateur, prenom, nom, sexe, date_naissance
           FROM realisateur 
           WHERE id_realisateur = :id 
        ");
        $requete->execute([
            "id" => $id
        ]);
        require "view/displayModifRealisateur.php";
    }

    public function modifRealisateur($id)
    {

     
        $modif_prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if ($modif_prenom && $modif_nom && $modif_sexe && $modif_date_naissance) {
           
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
        UPDATE realisateur
        SET prenom = :modif_prenom,
            nom = :modif_nom,
            sexe = :modif_sexe,
            date_naissance = :modif_date_naissance
            WHERE id_realisateur = :id
        ");
            $requete->execute([
                'modif_prenom' => $modif_prenom,
                'modif_nom' => $modif_nom,
                'modif_sexe' => $modif_sexe,
                'modif_date_naissance' => $modif_date_naissance,
                'id' => $id
            ]);
            header('Location: index.php?action=listRealisateur');
            die();
        } else {
            echo 'Service indisponible';
        }
    }

    public function supprRealisateur($id){
        $pdo = Connect::seConnecter();
          $requete1 = $pdo->prepare("
          DELETE FROM casting 
          WHERE film_id = (SELECT id_film FROM film WHERE realisateur_id = :id)
        ");
        $requete1->execute([
            'id' => $id
        ]); 
        $requete2 = $pdo->prepare("
             DELETE FROM film
             WHERE realisateur_id = :id
        ");
        $requete2->execute([
            'id' => $id
        ]);
        $requete3 = $pdo->prepare("
             DELETE FROM realisateur
             WHERE id_realisateur = :id
        ");
        $requete3->execute([
            'id' => $id
        ]);
        header('Location: index.php?action=listRealisateur');
        die();
    }
        
}