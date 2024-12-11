<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

//LE NULL MARCHE DANS LE SELECT PROBLEME BDD METTRE A NUL
//Suppression IMPOSSIBLE DUE AU PARAMETRE DE LA BDD

$requete = $bdd->prepare('SELECT *, CONCAT(auteur.prenom, " ", auteur.nom) as nom FROM livre
LEFT JOIN ecrire ON livre.id_livre=ecrire.ref_livre
LEFT JOIN auteur ON ecrire.ref_auteur=auteur.id_auteur
order by livre.titre');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();

$requete = $bdd->prepare('SELECT id_livre FROM livre;');
$requete->execute();
$listeId = $requete->fetchAll();
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
<a href="index.php">accueil</a>
<?php
if(isset($_SESSION['id_inscrit'])){
    if ($_SESSION['id_inscrit'] == 1){
        echo '<a href="listeInscrit.php">Liste des Inscrits</a>';
        echo '<a href="listeEmprunt.php">Liste des Emprunts</a>';
    }
}
?>
<a href="listeAuteur.php">Liste des auteurs</a>
<hr>

<?php
if (isset($_SESSION['id_inscrit'])){
    if($_SESSION['id_inscrit'] == 1){
        ?>
        <form action="listeLivres.php" method="post">
            <input type="submit" name="ajout" value="ajouter un livre">
        </form>
        <?php
    }
}

if (isset($_POST['ajout'])){
    ?>
    <form action="Gestion/gestionLivres.php" method="post">
        <label>Titre : </label>
    <input type="text" name="titre" required>
    <label>Année : </label>
    <input type="number" name="annee" required>
    <label>Résume : </label>
    <textarea name="resume" required></textarea>
    <label>Auteur : </label>
    <select name="auteur" required>
        <?php
        for ($i = 0;$i < count($listeAuteur);$i++){
            ?>
            <option value="<?= $listeAuteur[$i][0] ?>"><?=  $listeAuteur[$i]['nom']." ".$listeAuteur[$i]['prenom'] ?></option>
            <?php
        } ?>
        <option value="NULL">Aucun</option>
    </select>
    <input type="submit" name="ajout" value="ajouter">
    </form>
    <?php
}
if (isset($_POST['modifLivre'])){

    ?>
    <form action="Gestion/gestionLivres.php" method="post">
        <label>Titre : </label>
        <input type="text" name="titre" required value="<?= $liste[$_POST['idListe']][1] ?>">
        <label>Année : </label>
        <input type="number" name="annee" required value="<?= $liste[$_POST['idListe']][2] ?>">
        <label>Résume : </label>
        <textarea name="resume" required ><?= $liste[$_POST['idListe']][3] ?></textarea>
        <label>Auteur : </label>
        <select name="auteur" required>
            <?php
            for ($i = 0;$i < count($listeAuteur);$i++){
                ?>
                <option value="<?= $listeAuteur[$i][0] ?>"><?=  $listeAuteur[$i]['nom']." ".$listeAuteur[$i]['prenom'] ?></option>
                <?php
            } ?>
        </select>
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
        <input type="submit" name="modifLivre" value="modifier">
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
        <?php
        if (isset($_SESSION['id_inscrit'])){
            if($_SESSION['id_inscrit'] == 1){
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
                <?php
                if (isset($_SESSION['id_inscrit'])){
                    if($_SESSION['id_inscrit'] == 1){
                        ?>
                        <td>
                            <form action="listeLivres.php" method="post">
                                <input type="hidden" name="id" value="<?= $liste[$i][0] ?>">
                                <input type="hidden" name="idListe" value="<?= $listeId[$i][0]-1 ?>">
                                <input type="submit" name="modifLivre" value="Modifier">
                            </form>
                            <form action="Gestion/gestionLivres.php" method="post">
                                <input type="hidden" name="id" value="<?= $liste[$i][0] ?>">
                                <input type="submit" name="supLivre" value="Supprimer">
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