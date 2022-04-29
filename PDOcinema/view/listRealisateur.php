<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th>prenom</th>
            <th>nom</th>
            <th>Date de naissance</th>
            <th>Modification</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        foreach($requete as $realisateur){ ?>
           <tr>
               <td><?= $realisateur["prenom"]?></td>
               <td><?= $realisateur["nom"]?></td>
               <td><?= $realisateur["date_Realisteur"]?></td>
               <div class="container">
                    <td><a href="index.php?action=displayModifRealisateur&id=<?= $realisateur["id_realisateur"] ?>"><button class="noselect"><img src="img/icons8-crayon-50.png" alt="icon Crayon"></button></a></td>
                    <td><a href="index.php?action=supprRealisateur&id=<?= $realisateur["id_realisateur"] ?>"><button class="noselect"><img src="img/icons8-supprimer-la-corbeille-50.png" alt="icon Crayon"></button></a></td>
                </div>
           </tr>
      <?php } 
      $requete = null;
      ?>
      <a href="index.php?action=displayAddRealisateur">Ajouter un realisateur</a>
    </tbody>
</table>

<?php

// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "";
$titreSecondaire = "Liste des réalisateur";
$contenu = ob_get_clean();
require "view/template.php";