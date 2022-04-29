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

        foreach ($requete as $acteur) { ?>
            <tr>
                <td><a href="index.php?action=detailActeur&id=<?= $acteur["id_acteur"] ?>"><?= $acteur["prenom"] ?></a></td>
                <td><a href="index.php?action=detailActeur&id=<?= $acteur["id_acteur"] ?>"><?= $acteur["nom"] ?></a></td>
                <td><?= $acteur["date_Acteur"] ?></td>
                <div class="container">
                    <td><a href="index.php?action=displayModifActeur&id=<?= $acteur["id_acteur"] ?>"><button class="noselect"><img src="img/icons8-crayon-50.png" alt="icon Crayon"></button></a></td>
                    <td><a href="index.php?action=supprActeur&id=<?= $acteur["id_acteur"] ?>"><button class="noselect"><img src="img/icons8-supprimer-la-corbeille-50.png" alt="icon Crayon"></button></a></td>
                </div>
            </tr>
        <?php }
        $requete = null;
        ?>
        <a href="index.php?action=displayAddActeur">Ajouter un Acteur</a>
    </tbody>
</table>

<?php

// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "";
$titreSecondaire = "Liste des Acteur";
$contenu = ob_get_clean();
require "view/template.php";
