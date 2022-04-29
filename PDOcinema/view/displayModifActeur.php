<?php ob_start(); ?>
<?php $acteur = $requete->fetch(); ?>
<form action="index.php?action=modifActeur&id=<?= $acteur["id_acteur"]?>" method="post">
        <input class="input" type="text" name="prenom" value="<?= $acteur["prenom"]?>"> 
        <input class="input" type="text" name="nom" value="<?= $acteur["nom"]?>"><br>
        <input class="input"  type="text" name="sexe" value="<?= $acteur["sexe"]?>"> <br>
        <label for="date_naissance">Date de naissance<br></label><input class="input" type="date" name="date_naissance" value="<?= $acteur["date_naissance"]?>"></label><br>
        <input class="input" type="submit" value="Modifier" name="submit">
<?php
$titre = "";
$titreSecondaire = "Veuillez modifier l'acteur";
$contenu = ob_get_clean();
require "view/template.php";