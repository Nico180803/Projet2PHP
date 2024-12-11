<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

$requete = $bdd->prepare('SELECT auteur.id_auteur, CONCAT(auteur.prenom, " ", auteur.nom) as nom, auteur.date_naissance, pays.nom_pays AS pays FROM auteur
LEFT JOIN pays ON auteur.ref_pays = pays.id_pays');
$requete->execute();
$auteur = $requete->fetchAll();
$requete->closeCursor();

$requete=$bdd->prepare('SELECT * FROM pays');
$requete->execute();
$pays = $requete->fetchAll();
$requete->closeCursor();
?>

<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-LISTE DES AUTEURS</title>
    <link href="CSS/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" rel="stylesheet">
</head>
<body>
<h1>LISTE DES AUTEURS</h1>
<hr>
<a href="index.php">accueil</a>
<?php
if(isset($_SESSION['id_inscrit'])){
    if ($_SESSION['id_inscrit'] == 1){
        echo '<a href="listeInscrit.php">Liste des Inscrits</a>';
        echo '<a href="listeEmprunt.php">Liste des Emprunts</a>';
    }
}
?>
<a href="listeLivres.php">Liste des livres</a>
<hr>
<form action="listeAuteur.php" method="post">
    <table>
        <tr>
            <td><input type="submit" name="ajout" value="Ajouter un auteur"> </td>
        </tr>
    </table>
</form>
<?php
if(isset($_POST['ajout'])){
    ?>
    <form action="Gestion/gestionAuteurs.php" method="post">
        <table>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" required></td>
            </tr>
            <tr>
                <td>Prénom :</td>
                <td><input type="text" name="prenom" required></td>
            </tr>
            <tr>
                <td>Date de naissance :</td>
                <td><input type="date" name="date" required></td>
            </tr>
            <tr>
                <td>Pays :</td>
                <td><select name="pays">
                        <?php
                        for ($i = 0;$i < count($pays);$i++){
                            ?>
                            <option value="<?= $pays[$i]['id_pays'] ?>"><?=  $pays[$i]['nom_pays'] ?></option>
                            <?php
                        } ?>
                    </select</td>
            </tr>
            <tr>
                <td><input type="submit" name="ajout" value="Confirmer"></td>
            </tr>
        </table>
    </form>
    <?php
}
if (isset($_POST['modifier'])) {
    $requete=$bdd->prepare('SELECT * FROM auteur
         INNER JOIN pays ON auteur.ref_pays = pays.id_pays
         WHERE id_auteur =:id_auteur');
    $requete->execute(array('id_auteur' => $_POST['auteur']));
    $auteurmodif = $requete->fetch();
    $requete->closeCursor();

    ?>
    <table>
        <form action="Gestion/gestionAuteurs.php" method="post">
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" value="<?= $auteurmodif['nom'] ?>"></td>
            </tr>
            <tr>
                <td>Prenom :</td>
                <td><input type="text" name="prenom" value="<?= $auteurmodif['prenom'] ?>"></td>
            </tr>
            <tr>
                <td>Date de naissance :</td>
                <td><input type="date" name="naissance" value="<?= $auteurmodif['date_naissance'] ?>"></td>
            </tr>
            <tr>
                <td>Pays :</td>
                <td><select name="pays" required>
                        <option value="<?= $auteurmodif['id_pays'] ?>"><?= $auteurmodif['nom_pays'] ?></option>
                        <?php
                        for ($i = 0;$i < count($pays);$i++){
                            ?>
                            <option value="<?= $pays[$i]['id_pays'] ?>"><?=  $pays[$i]['nom_pays'] ?></option>
                            <?php
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="auteur" value=<?= $_POST['auteur'] ?>>
                <td><input type="submit" name="modifier" value="Confirmer"> </td>
            </tr>

        </form>
    </table>
    <?php
}
?>


<table id= "example" border="1">

    <thead>
    <tr>
        <td>Auteur</td>
        <td>Date de naissance</td>
        <td>Nationalité</td>
        <?php
        if (isset($_SESSION['id_inscrit'])){
            if ($_SESSION['id_inscrit'] == 1){
                ?>
                <td>Action</td>
                <?php
            }
        }
        ?>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < count($auteur); $i++) {
        if ($i != 5){
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
                <?php
                if (isset($_SESSION['id_inscrit'])){
                    if ($_SESSION['id_inscrit'] == 1){
                        ?>
                        <td>
                            <form action="Gestion/gestionAuteurs.php" method="post">
                                <input type="submit" name="supprimer" value="Supprimer">
                                <input type="hidden" name="auteur" value=<?= $auteur[$i]['id_auteur']?>>
                            </form>
                            <form action="listeAuteur.php" method="post">
                                <input type="submit" name="modifier" value="Modifier">
                                <input type="hidden" name="auteur" value=<?= $auteur[$i]['id_auteur']?>>
                            </form>
                        </td>
                        <?php
                    }
                }
                ?>

            </tr>


            <?php
        }
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
