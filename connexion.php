<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<h1>CONNEXION</h1>
<hr>
<a href="index.php">accueil</a>
<a href="inscription.php">S'inscrire</a>
<hr>

<?php
if (isset($_GET['erreur_'])){
    echo '<p style="color:red" align="center">'.$_GET['erreur_'];
}
?>
<form action="Gestion/gestionConnexion.php" method="post">
    <table>
        <tr>
            <td>Email :</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>Mot de passe :</td>
            <td><input type="password" name="mdp" minlength="1" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Valider"></td>
            <td><input type="reset" value="Reset"></td>
        </tr>
    </table>
    <a href="inscription.php">Vous n'avez pas de compte ? inscrivez-vous</a>
</form>
</body>
</html>

