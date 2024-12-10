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
<hr>
<?php
if (isset($_SESSION['nom'])){
    echo '<a href="profil.php">Mon profil</a>';
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