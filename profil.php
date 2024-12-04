<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8','root','');
//MODIFIER REQUETE POUR PAS AVOIR MDP
$requete = $bdd->prepare('SELECT * FROM inscrit');
$requete->execute();
$info = $requete->fetch();
$requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<hr>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
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
if (isset($_POST['modifierMotDePasse'])) {
?>

    <table>
        <form action="./Gestion/modification.php" method="post">
            <tr>
                <td><label for="oldMdp"></label>Ancien Mot de Passe : </td>
                <td><input type="password" id="oldMdp" name="oldMdp" required></td>
            </tr>
            <tr>
                <td><label for="newMdp">Nouveau Mot de Passe </label></td>
                <td><input type="password" id="newMdp" name="newMdp" required></td>
            </tr>
            <tr>
                <td><label for="confirm">Confirmer le nouveau Mot de Passe</label></td>
                <td><input type="password" id="confirm" name="confirmNewMdp" required></td>
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
</body>
</html>

