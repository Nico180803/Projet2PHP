<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');


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
<a href="index.php">accueil</a>
<a href="listeAuteur.php">Liste des auteurs</a>
<hr>
<?php
if (isset($_SESSION['id_inscrit'])){
    if($_SESSION['id_inscrit'] == 1){
        ?>
        <form action="listeLivres.php" method="post">
            <input type="submit" name="ajout">
        </form>
        <?php
    }
}

if (isset($_POST['ajout'])){
    ?>
        <form action="" method="post">
            <label>Titre : </label>
            <input type="text" name="titre" required>
            <label>Année : </label>
            <input type="number" name="annee" required>
            <label>Titre : </label>
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
                            <form action="Gestion/modification.php" method="post">
                                <input type="hidden" name="id" value="<?= $liste[$i][0] ?>">
                                <input type="submit" name="modifLivre" value="Modifier">
                            </form>
                            <form action="Gestion/supression.php" method="post">
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