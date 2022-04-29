<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Durée</th>
            <th>Date de sortie</th>
            <th>Réalisateur</th>
            <th>Modification</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        foreach($requete as $film){ ?>
           <tr>
               <td><a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>"><?= $film["titre"]?></a></td>
               <td><?= $film["dureeHeures"]?></td>
               <td><?= $film["dateSortie"]?></td>
               <td><?= $film["prenom"]." ".$film["nom"] ?></td>
               <div class="container">
                    <td><a href="index.php?action=displayModifFilm&id=<?= $film["id_film"] ?>"><button class="noselect"><img src="img/icons8-crayon-50.png" alt="icon Crayon"></button></a></td>
                    <td><a href="index.php?action=supprFilm&id=<?= $film["id_film"] ?>"><button class="noselect"><img src="img/icons8-supprimer-la-corbeille-50.png" alt="icon Crayon"></button></a></td>
                </div>
           </tr>
      <?php }
      $requete = null;
      ?>
      <a href="index.php?action=displayAddFilm">Ajouter un film</a>
    </tbody>
</table>

<?php

// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "Cinéma";
$titreSecondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";