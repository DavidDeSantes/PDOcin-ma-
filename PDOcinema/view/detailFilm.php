<?php
ob_start();
$film = $requete->fetch();
?>

<h3><?= $film["titre"] ?> :</h3>

<p>
    Durée : <?= $film["dureeHeures"]; ?> <br>
    Genre : <?=  $film["libelle"]; ?> 
    <?php // Il faut faire ça pour dire à myHeidi sql que la première requete est finis avant de pouvoir passer et afficher la requete2
     $requete = null; ?>
</p>
<table>
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <!-- On veut afficher le casting dans le détailFilm, c'est pourquoi on fait le forEach dans le detailFilm directement.
            Le fetchAll va nous permettre de récupérer plusieur élements dans notre cas un film peut avoir plusieurs acteurs donc 
         fetchAll pour récupérer potentiellement tout les acteurs -->
        <?php foreach ($requete2->fetchAll() as $film2) { ?>
            <tr>
                <td><a href="index.php?action=detailActeur&id=<?= $film2["id_acteur"] ?>"> <?= $film2["prenom"] ?> <?= $film2["nom"] ?></a></td>
                <td><?= $film2["libelle"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php

// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "";
$titreSecondaire = "Détail d'un film";
$contenu = ob_get_clean();
require "view/template.php";
