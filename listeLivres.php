<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

//J'arrive pas à faire le tri et l'affichage des auteurs.

$requete = $bdd->prepare('SELECT livre.titre, livre.annee, livre.resume, CONCAT(auteur.prenom, " ", auteur.nom) as nom FROM livre
LEFT JOIN ecrire ON livre.id_livre=ecrire.ref_livre
LEFT JOIN auteur ON ecrire.ref_auteur=auteur.id_auteur
order by livre.titre');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();

$requete = $bdd->prepare('SELECT * FROM auteur;');
$requete->execute();
$listeAuteur = $requete->fetchAll();
$requete->closeCursor();
?>
<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-LISTE DES LIVRES</title>
    <link href="CSS/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" rel="stylesheet">
</head>
<body>
<h1>LISTE DES LIVRES</h1>
<hr>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>


<table id= "example" border="1">

    <thead>
    <tr>
        <td>Titre</td>
        <td>Année</td>
        <td>Résumé</td>
        <td>Auteur</td>

    </tr>
    </thead>
    <tbody>
    <?php
    $j = count($liste);
    for ($i=0; $i < $j; $i++) {

        if ($liste[$i]['titre'] == $liste[$i+1]['titre']) {
            $liste[$i+1]['nom'] = $liste[$i]['nom'].", ".$liste[$i+1]['nom'];
            $j=$j-1;
        }else{
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
                    <?= $liste[$i]['nom']?>
                </td>

            <td>
                <?php
                if (isset($_SESSION['id_inscrit'])){
                    if($_SESSION['id_inscrit'] == 1){
                        ?>
                        <form action="Gestion/modification.php" method="post">
                            <input type="hidden" name="id" value="<?= $liste[$i][0] ?>">
                            <input type="submit" name="modifLivre" value="Modifier">
                        </form>
                        <form action="Gestion/supression.php" method="post">
                            <input type="hidden" name="id" value="<?= $liste[$i][0] ?>">
                            <input type="submit" name="supLivre" value="Supprimer">
                        </form>
                        <?php
                    }
                }
                ?>
            </td>
            </tr>
            <?php

        }
    }
    ?>
</table>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>