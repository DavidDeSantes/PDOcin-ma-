<?php 
    ob_start(); 
    $acteur = $requete->fetch();
?>


<p>
    Prénom : <?= $acteur["prenom"] ?> <br>
    Nom : <?= $acteur["nom"] ?> <br>
    Date de naissance : <?= $acteur["date_Acteur"];
    // Il faut faire ça pour dire à myHeidi sql que la première requete est finis avant de pouvoir passer et afficher la requete2
    $requete = null; ?>

</p>
<table>
    <thead>
        <tr>
            <th>Film</th>
            <th>Date de sortie</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
    
        <!-- On veut afficher la filmographie dans le détailActeur, c'est pourquoi on fait le forEach dans le detailActeur directement. 
         Le fetchAll va nous permettre de récupérer plusieur élements dans notre cas un film peut avoir plusieurs acteurs donc 
         fetchAll pour récupérer potentiellement tout les acteurs -->
        <?php foreach ($requete2->fetchAll() as $acteur2) { ?>
            <tr>
                <td><a href="index.php?action=detailFilm&id=<?= $acteur2["id_film"] ?>"><?= $acteur2["titre"] ?></a></td>
                <td><?= $acteur2["dateSortie"]?></td>
                <td><?= $acteur2["libelle"]?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "";
$titreSecondaire = "Détail d'un acteur";
$contenu = ob_get_clean();
require "view/template.php";