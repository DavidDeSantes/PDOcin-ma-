<?php

namespace Controller;
// Pour se connecter à la Base de donnée notre ActeurController va avoir besoin de notre class Connect donc on l'importe avec use
use Model\Connect;

class ActeurController
{
    // C'est dans cette fonction que nous allons faire nos injection SQL pour ensuite les relier à notre view spécifique
    public function listActeur()
    {
        // Ensuite nous utilisons l'opérateur de portée :: (appelé Paamayim Nekudotayim) pour aller prendre la fonction "seConnecter"
        // Requete pour lister les acteurs
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
             SELECT id_acteur, prenom, nom, DATE_FORMAT(date_naissance, '%d-%m-%Y') AS date_Acteur
             FROM Acteur 
             ORDER BY prenom
        ");
        require "view/listActeur.php";
    }

    public function detailActeur($id)
    {
        // Requete pour afficher le détail de l'acteur choisi
        $pdo = Connect::seConnecter();
        // C'est en faisant :id dans PDO que nous relions un paramètre id, celui-ci ciblé selon ce que choisit l'utilisateur. 
        $requete = $pdo->prepare("
           SELECT id_acteur, prenom, nom, DATE_FORMAT(date_naissance, '%d-%m-%Y') AS date_Acteur
           FROM Acteur
           WHERE id_acteur = :id 
        ");
        $requete->execute([
            "id" => $id
        ]); // requete pour afficher la filmographie dans le detail de l'acteur choisi 
        $requete2 = $pdo->prepare("
           SELECT f.id_film, titre, DATE_FORMAT(date_sortie, '%d-%m-%Y') AS dateSortie, r.libelle
           FROM film f
           INNER JOIN casting c ON f.id_film = c.film_id
           INNER JOIN acteur a ON c.acteur_id = a.id_acteur
           INNER JOIN role r ON c.role_id = r.id_role
           where a.id_acteur = :id
        ");
        $requete2->execute([
            "id" => $id
        ]);
        require "view/detailActeur.php";
    }

    public function displayAddActeur(){
        require "view/displayAddActeur.php";
    }

    public function displayModifActeur($id){
        $pdo = Connect::seConnecter(); 
        $requete = $pdo->prepare("
           SELECT id_acteur, prenom, nom, sexe, date_naissance
           FROM Acteur
           WHERE id_acteur = :id 
        ");
        $requete->execute([
            "id" => $id
        ]);
        require "view/displayModifActeur.php";
    }

    public function addActeur()
    {

        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($prenom && $nom && $sexe && $date_naissance) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
        INSERT INTO acteur(prenom, nom, sexe, date_naissance)
        VALUES (:prenom, :nom, :sexe, :date_naissance)
        ");
            $requete->execute([
                'prenom' => $prenom,
                'nom' => $nom,
                'sexe' => $sexe,
                'date_naissance' => $date_naissance
            ]);
            header('Location: index.php?action=listActeur');
            die();
        } else {
            echo 'Service indisponible';
        }
    }

    public function modifActeur($id)
    {

     
        $modif_prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modif_date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if ($modif_prenom && $modif_nom && $modif_sexe && $modif_date_naissance) {
           
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
        UPDATE acteur
        SET prenom = :modif_prenom,
            nom = :modif_nom,
            sexe = :modif_sexe,
            date_naissance = :modif_date_naissance
            WHERE id_acteur = :id
        ");
            $requete->execute([
                'modif_prenom' => $modif_prenom,
                'modif_nom' => $modif_nom,
                'modif_sexe' => $modif_sexe,
                'modif_date_naissance' => $modif_date_naissance,
                'id' => $id
            ]);
            header('Location: index.php?action=listActeur');
            die();
        } else {
            echo 'Service indisponible';
        }
    }

    public function supprActeur($id){
        $pdo = Connect::seConnecter(); 
        $requete = $pdo->prepare("
             DELETE FROM casting
             WHERE acteur_id = :id
        ");
        $requete->execute([
            'id' => $id
        ]);
        $requete2 = $pdo->prepare("
             DELETE FROM acteur
             WHERE id_acteur = :id
        ");
        $requete2->execute([
            'id' => $id
        ]);
        header('Location: index.php?action=listActeur');
    }
}
