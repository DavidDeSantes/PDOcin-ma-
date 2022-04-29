<!-- Le template est notre view référente , qui sera un affichage commun,similaire,  à toutes les autres vues.  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\style.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <!--  < ? = : est la façon d'ouvrir un code php en disant directement echo -->
    <title><?= $titre ?></title>
</head>
<div id="wrapper">

    <body>
        <header>
            <nav>
                <a href="index.php?action=listFilm">Liste Film</a>
                <a href="index.php?action=listGenre">Liste Genre</a>
                <a href="index.php?action=listRealisateur">Liste Realisateur</a>
                <a href="index.php?action=listActeur">Liste Acteur</a>
            </nav>
        </header>
        <main>
            <div id="contenu">
                <h1> PDO Cinéma</h1>
                <h2> <?= $titreSecondaire ?></h2>
               <div id="contenuDetail"> <?= $contenu ?> </div>
            </div>
        </main>
</div>
</body>

</html>