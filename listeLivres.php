<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

//J'arrive pas à faire le tri et l'affichage des auteurs.

$requete = $bdd->prepare('SELECT * FROM livre
INNER JOIN ecrire ON livre.id_livre=ecrire.ref_livre
INNER JOIN auteur ON ecrire.ref_auteur=auteur.id_auteur;');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();

$requete = $bdd->prepare('SELECT * FROM auteur');
$requete->execute();
$auteur = $requete->fetchAll();
$requete->closeCursor();
?>
<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-LISTE DES LIVRES</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<h1>LISTE DES LIVRES</h1>
<hr>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>

<table>
    <tr>
        <td>
            <form action="listeLivres.php" method="post">
                <select name = "auteur" >
                    <?php for($i = 0; $i < count($liste); $i++){ ?>
                        <option value=<?= $auteur[$i]['id_auteur']  ?>>
                            <?= $auteur[$i]['prenom']," ",$auteur[$i]['nom'] ?>
                        </option>
                    <?php }?>
                </select>
                <input type="submit" value = confirmer>
            </form>
        </td>
        <td>

            <form action="listeLivres.php" method="post">
                <select>
                    <?php // L'IDEE EST NUL LA FAUT VRAIMENT FAIRE UNE BARRE DE RECHERCHE for($i = 0; $i < count($liste); $i++){ ?>
                        <option value=>
                            <?= $liste[$i]['titre'] ?>
                        </option>
                    <?php //}?>
                </select>
                <input type="submit" value = confirmer>
            </form>
        </td>
    </tr>
</table>


<?php
if (!isset($_POST['auteur'])) {
    ?>
    <table border="1">
        <?php
        for ($i=0; $i < count($liste); $i++) {
            ?>
            <tr>
                <td>
                    <?= $liste[$i]['titre']?>
                </td>
                <td>
                    <?= $liste[$i]['annee']?>
                </td>
                <td>
                    <?= $liste[$i]['resume']?>
                </td>
                <td>
                    <?= $liste[$i]['prenom']," ", $liste[$i]['nom']?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
if (isset($_POST['auteur'])) {
    ?>
    <table border="1">
        <?php
        for ($i=0; $i < count($liste); $i++) {
            if ($liste[$i]['ref_auteur'] == $_POST['auteur']) {
                ?>
                <tr>
                    <td>
                        <?= $liste[$i]['titre']?>
                    </td>
                    <td>
                        <?= $liste[$i]['annee']?>
                    </td>
                    <td>
                        <?= $liste[$i]['resume']?>
                    </td>
                    <td>
                        <?= $liste[$i]['prenom']," ", $liste[$i]['nom']?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>

    <?php
}
?>
</table>

</body>
