<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Types</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($requete as $genre) { ?>
            <tr>
                <td><?= $genre["id_genre"] ?></td>
                <td><?= $genre["libelle"] ?></td>
            </tr>
        <?php }
        $requete = null;
        ?>
    </tbody>
</table>

<?php

// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "Cinéma";
$titreSecondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";
