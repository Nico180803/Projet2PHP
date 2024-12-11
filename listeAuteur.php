<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

$requete = $bdd->prepare('SELECT auteur.id_auteur, CONCAT(auteur.prenom, " ", auteur.nom) as nom, auteur.date_naissance, pays.nom AS pays FROM auteur
LEFT JOIN pays ON auteur.ref_pays = pays.id_pays');
$requete->execute();
$auteur = $requete->fetchAll();
$requete->closeCursor();


if (isset($_SESSION['id_auteur'])) {}
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
        <td>Auteur</td>
        <td>Date de naissance</td>
        <td>Nationalité</td>
        <td>Actions</td>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < count($auteur); $i++) {
        ?>
        <tr>
            <td>
                <?= $auteur[$i]['nom']?>
            </td>
            <td>
                <?= $auteur[$i]['date_naissance']?>
            </td>
            <td>
                <?= $auteur[$i]['pays']?>
            </td>
            <td>
                <form action="Gestion/gestionAuteurs.php" method="post">
                    <input type="submit" name="supprimer" value="Supprimer">
                    <input type="hidden" name="auteur" value=<?= $auteur[$i]['id_auteur']?>>
                </form>
                <form>
                    <input type="submit" name="modifier" value="Modifier">
                </form>

            </td>
        </tr>
        <?php
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
