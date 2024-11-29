<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');


$requete = $bdd->prepare('SELECT * FROM inscrit');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();
?>
<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-LISTE DES INSCRIT</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<h1>LISTE DES INSCRITS</h1>
<hr>
<a href="index.php">accueil</a>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>
<table border="1">
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
            <td>
                <?= $liste[$i][4]?>
            </td>
            <td>
                <?= $liste[$i][5]?>
            </td>
            <td>
                <?= $liste[$i][6]?>
            </td>
            <td>
                <?= $liste[$i][7]?>
            </td>
            <td>
                <?= $liste[$i][8]?>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
