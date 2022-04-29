<?php ob_start(); ?>
<?php $film = $requete->fetch(); ?>
<form action="index.php?action=modifFilm&id=<?= $film["id_film"]?>" method="post">
        <input class="input" type="text" name="titre" value="<?= $film["titre"]?>"> 
        <input class="input" type="number" name="duree" value="<?= $film["duree"]?>"><br>
        <input class="input"  type="date" name="date_sortie" value="<?= $film["date_sortie"]?>"> <br>
        <select class="input" name="realisateur">
            <?php foreach($requete_realisateur->fetchAll() as $realisateur) { 
                $selectedR = ($realisateur["id_realisateur"] == $film["realisateur_id"]) ? "selected" : "";
                ?>
                <option <?= $selectedR ?> value="<?= $realisateur["id_realisateur"] ?>"><?= $realisateur["prenom"]. " ".$realisateur["nom"] ?></option>
            <?php } ?>    
        </select> <br>
        <select class="input" name="genre">
            <?php foreach($requete_genre->fetchAll() as $genre) { 
                $selectedG = ($genre["id_genre"] == $film["genre_id"]) ? "selected" : "";   
            ?>
                <option <?= $selectedG ?> value="<?= $genre["id_genre"] ?>"><?= $genre["libelle"]?></option>
            <?php } ?>    
        </select> <br>
        <input class="input" type="submit" value="Modifier" name="submit"> 
<?php
$titre = "";
$titreSecondaire = "Veuillez modifier le film";
$contenu = ob_get_clean();
require "view/template.php";