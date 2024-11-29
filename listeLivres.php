<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

//J'arrive pas à faire le tri et l'affichage des auteurs.

$requete = $bdd->prepare('SELECT * FROM livre');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();

$requete = $bdd->prepare('SELECT id_auteur, nom, prenom FROM auteur');
$requete->execute();
$auteur = $requete->fetchAll();
$requete->closeCursor();

$requete = $bdd->prepare('SELECT * FROM ecrire');
$requete->execute();
$ecrire = $requete->fetchAll();

var_dump($_POST);
var_dump($liste);


?>
<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-LISTE DES LIVRES</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<h1>LISTE DES LIVRES</h1>
<hr>
<a href="index.php">accueil</a>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>

<form action="listeLivres.php" method="post">
    <select>
        <?php for($i = 0; $i < count($auteur); $i++){ ?>
            <option value=<?= $auteur[$i][0]?>>
                <?= $auteur[$i][2]," ",$auteur[$i][1] ?>
            </option>
        <?php }?>
    </select>
    <input type="submit" value = confirmer>
</form>

<form action="listeLivres.php" method="post">
    <select>
        <?php for($i = 0; $i < count($liste); $i++){ ?>
            <option value=<?= $liste[$i][0]?>>
                <?= $liste[$i][1] ?>
            </option>
        <?php }?>
    </select>
    <input type="submit" value = confirmer>
</form>

<table>
    <?php
    for ($i=0; $i < count($liste); $i++) {
        ?>
        <tr>
            <td>
                <?= $liste[$i][1]?>
            </td>
            <td>
                <?= $liste[$i][2]?>
            </td>
            <td>
                <?= $liste[$i][3]?>
            </td>

        </tr>
    <?php } ?>
</table>

</body>
