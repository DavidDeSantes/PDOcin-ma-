<?php ob_start(); ?>
<form action="index.php?action=addFilm" method="post">
        <input class="input" type="text"  placeholder="Titre" name="titre" require> <br>
        <label class="input" for="date_sortie">Date de sortie <br><input class="input" type="date" name="date_sortie"></label><br>
        <input class="input" type="number"  placeholder="Durée en minutes" name="duree"></label><br>
        <select class="input" name="realisateur">
            <?php foreach($requete->fetchAll() as $realisateur) { ?>
                <option value="<?= $realisateur["id_realisateur"] ?>"><?= $realisateur["prenom"]. " ".$realisateur["nom"] ?></option>
            <?php } ?>    
        </select> <br>
        <select class="input" name="genre">
            <?php foreach($requete2->fetchAll() as $genre) { ?>
                <option value="<?= $genre["id_genre"] ?>"><?= $genre["libelle"]?></option>
            <?php } ?>    
        </select> <br>
        
        <input class="input" type="submit" value="Envoyer" name="submit">
    </form>
<?php
$titre = "";
$titreSecondaire = "Veuillez ajouter un film";
$contenu = ob_get_clean();
require "view/template.php";