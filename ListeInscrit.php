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
    <title>BIBLIOTHEQUE-LISTE DES LIVRES</title>
    <link href="CSS/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" rel="stylesheet">
</head>
<body style="display: block">
<h1>LISTE DES INSCRITS</h1>
<hr>
<a href="index.php">accueil</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>

<table style="width: 100%;" id="example">
    <thead>
    <tr>
        <td>prénom</td>
        <td>nom</td>
        <td>email</td>
        <td>tel fixe</td>
        <td>tel portable</td>
        <td>rue</td>
        <td>code postal</td>
        <td>ville</td>
        <td>action</td>
    </tr>
    </thead>
    <tbody>
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
            <td>
                <form action="Gestion/modification.php" method="post">
                    <input type="hidden" name="inscrit" value=<?= 1 ?>>
                    <input type="submit" value="modifier">
                </form>
                <form action="Gestion/supression.php" method="post">
                    <input type="hidden" name="inscrit" value="<?= $liste[$i][0] ?>">
                    <input type="submit" value="supprimer">
                </form>
            </td>

        </tr>
    <?php
    } ?>
    </tbody>
</table>
<hr>
<hr>
<?php
if (isset($_SESSION['nom'])){
    echo '<a href="Gestion/gestionDeconnexion.php">se déconnecter</a>';
} else{
    echo '<a href="inscription.php">S\'inscrire</a>';
    echo '<a href="connexion.php">Se connecter</a>';
}
?>


<hr>
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
