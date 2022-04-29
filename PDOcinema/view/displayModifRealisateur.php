<?php ob_start(); ?>
<?php $realisateur = $requete->fetch(); ?>
<form action="index.php?action=modifRealisateur&id=<?= $realisateur["id_realisateur"]?>" method="post">
        <input class="input" type="text" name="prenom" value="<?= $realisateur["prenom"]?>"> 
        <input class="input" type="text" name="nom" value="<?= $realisateur["nom"]?>"><br>
        <input class="input"  type="text" name="sexe" value="<?= $realisateur["sexe"]?>"> <br>
        <label for="date_naissance">Date de naissance<br></label><input class="input" type="date" name="date_naissance" value="<?= $realisateur["date_naissance"]?>"></label><br>
        <input class="input" type="submit" value="Modifier" name="submit">
<?php
$titre = "";
$titreSecondaire = "Veuillez modifier le realisateur";
$contenu = ob_get_clean();
require "view/template.php";