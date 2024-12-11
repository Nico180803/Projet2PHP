<?php
session_start();
var_dump($_SESSION);
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

$requete = $bdd->prepare('SELECT * FROM livre
INNER JOIN ecrire ON livre.id_livre=ecrire.ref_livre
INNER JOIN auteur ON ecrire.ref_auteur=auteur.id_auteur;');
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
<?php
if (isset($_SESSION['id_inscrit'])){
    if($_SESSION['id_inscrit'] == 1){
        ?>
        <form action="listeLivres.php" method="post">
            <input type="submit" name="ajout" value="Ajout de livre">
        </form>
<?php
    }
}
if (isset($_POST['ajout'])){
    ?>
    <form method="post" action="Gestion/gestionAjout.php">
        <label>titre : </label>
        <input type="text" name="titre" required>
        <label>année : </label>
        <input type="number" name="annee" required>
        <label>resume : </label>
        <textarea name="resume" required></textarea>
        <label>Auteur : </label>
        <select name="auteur">
            <?php
            for ($i = 0;$i < count($listeAuteur);$i++){
                ?>
                <option value="<?= $listeAuteur[$i]['id_auteur'] ?>"><?= $listeAuteur[$i]['nom']." ".$listeAuteur[$i]['prenom'] ?></option>
            <?php
            }
            ?>
            <option value="NULL">Aucun</option>
        </select>
        <input type="submit" name="ajout">
    </form>
<?php
}
?>

<table id= "example" border="1">

    <thead>
    <tr>
        <td>Titre</td>
        <td>Année</td>
        <td>Résumé</td>
        <td>Auteur</td>
        <td>Action</td>

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