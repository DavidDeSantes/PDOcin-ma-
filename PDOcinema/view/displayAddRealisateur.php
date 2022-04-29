<?php ob_start(); ?>
<form action="index.php?action=addRealisateur" method="post">
        <input class="input" type="text" placeholder="Prenom" name="prenom"> 
        <input class="input" type="text"  placeholder="Nom" name="nom"><br>
        <input class="input"  type="text"  placeholder="Sexe" name="sexe"><br>
        <label for="date_naissance">Date de naissance<br></label><input class="input" type="date" name="date_naissance"></label><br>
        <input class="input" type="submit" value="Envoyer" name="submit">
<?php
$titre = "";
$titreSecondaire = "Veuillez ajouter un realisateur";
$contenu = ob_get_clean();
require "view/template.php";