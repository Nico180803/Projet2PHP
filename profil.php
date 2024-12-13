<?php
session_start();
if (!isset($_SESSION['nom'])){
    header("location:index.php");
}
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8','root','');

$requete = $bdd->prepare('SELECT * FROM inscrit WHERE id_inscrit = :inscrit');
$requete->execute(array(
    'inscrit' => $_SESSION['id_inscrit']
));
$info = $requete->fetch();
$requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<hr>

<a href="index.php">accueil</a>
<?php
if ($_SESSION['id_inscrit'] == 1){
    echo '<a href="listeInscrit.php">Liste des Inscrits</a>';
    echo '<a href="listeEmprunt.php">Liste des Emprunts</a>';
}
?>
<a href="listeLivres.php">Liste des Livres</a>
<a href="listeAuteur.php">Liste des Auteurs</a>
<hr>
<?php
if(!isset($_POST['modifier'])){
    ?>
    <form action="profil.php" method="post">
        <input type="submit" name = "modifier" value="Modifier mon profil">
    </form>
    <?php
}
if(!isset($_POST['modifierMotDePasse'])){
    ?>
    <form action="profil.php" method="post">
        <input type="submit" name ="modifierMotDePasse"value="Modifier mon Mot de Passe">
    </form>
    <?php
}
if (isset($_SESSION['id_inscrit'])){
    if ($_SESSION['id_inscrit'] != 1){
        ?>
        <form action="Gestion/gestionDeconnexion.php" method="post">
            <input type="hidden" name="id" value="<?= $_SESSION['id_inscrit'] ?>">
            <input type="submit" name ="supprimerMonCompte" value="Supprimer mon compte">
        </form>
        <?php
    }
}
if (isset($_POST['modifier'])) {
    ?>
    <table>
        <form action="./Gestion/modification.php" method="post">
            <tr>
                <td><label for="nom"></label>Nom : </td>
                <td><input type="text" id="nom" name="nom" value=<?=$info['nom']?>></td>
            </tr>
            <tr>
                <td><label for="">Prenom : </label></td>
                <td><input type="text" id="prenom" name="prenom" value=<?=$info['prenom']?>></td>
            </tr>
            <tr>
                <td><label for="email">email : </label></td>
                <td><input type="text" id="email" name="email" value=<?=$info['email']?>></td>
            </tr>
            <tr>
                <td><label for="tel_fixe">Telephone Fixe : </label></td>
                <td><input type="text" id="tel_fixe" name="tel_fixe" value=<?=$info['tel_fixe']?>></td>
            </tr>
            <tr>
                <td><label for="tel_port">Telephone Portable : </label></td>
                <td><input type="text" id="tel_port" name="tel_portable" value=<?=$info['tel_portable']?>></td>
            </tr>
            <tr>
                <td><label for="rue">Rue : </label></td>
                <td><input type="text" id="rue" name="rue" value=<?=$info['rue']?>></td>
            </tr>
            <tr>
                <td><label for="cp">Code postal : </label></td>
                <td><input type="text" id="cp" name="cp" value=<?=$info['cp']?>></td>
            </tr>
            <tr>
                <td><label for="ville">Ville : </label></td>
                <td><input type="text" id="ville" name="ville" value=<?=$info['ville']?>></td>
            </tr>
            <tr>
                <td><input type="submit" value="Confirmer"></td>
            </tr>
            <input type="hidden" name="modifierProfil">
        </form>
    </table>
    <?php
}
if (isset($_POST['modifierMotDePasse'])|| isset($_GET['erreur'])) {
    ?>
    <?php
    if (isset($_GET['erreur'])) {
        ?>
        <p style="color:red" align="center"><?=$_GET['erreur']?></p>
        <?php
    }
    ?>
    <table>
        <form action="./Gestion/modification.php" method="post">
            <tr>
                <td><label for="oldMdp"></label>Ancien Mot de Passe : </td>
                <td><input type="password" id="oldMdp" name="oldMdp" required minlength="10"></td>
            </tr>
            <tr>
                <td><label for="newMdp">Nouveau Mot de Passe </label></td>
                <td><input type="password" id="newMdp" name="newMdp" required minlength="10"></td>
            </tr>
            <tr>
                <td><label for="confirm">Confirmer le nouveau Mot de Passe</label></td>
                <td><input type="password" id="confirm" name="confirmNewMdp" required minlength="10"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Confirmer"></td>
            </tr>
            <input type="hidden" name="modifierMdp">
        </form>
    </table>
    <?php
}
?>
<br>
<form action="Gestion/gestionEmprunts.php" method="post">
    <input type="submit" name="ajout" value="Faire un emprunt">
</form>
<hr>
<a href="Gestion/gestionDeconnexion.php">se déconnecter</a>
<hr>
</body>
</html>

