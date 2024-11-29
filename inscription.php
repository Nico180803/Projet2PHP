<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<h1>INSCRIPTION</h1>
<hr>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>
<form action="Gestion/gestionInscrits.php" method="post">
    <table>
        <tr>
            <td>Nom : </td>
            <td><input type="text" name="nom" required></td>
        </tr>
        <tr>
            <td>Prenom : </td>
            <td><input type="text" name="prenom" required></td>
        </tr>
        <tr>
            <td>Email :</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>Tel_fixe :</td>
            <td><input type="text" name="tel_fixe" maxlength="10" required></td>
        </tr>
        <tr>
            <td>Tel_portable :</td>
            <td><input type="text" name="tel_portable" maxlength="10" required></td>
        </tr>
        <tr>
            <td>Rue :</td>
            <td><input type="text" name="rue" required><br></td>
        </tr>
        <tr>
            <td>CP :</td>
            <td><input type="text" name="cp" maxlength="5" required></td>
        </tr>
        <tr>
            <td>Ville :</td>
            <td><input type="text" name="ville" required></td>
        </tr>
        <tr>
            <td>Mot de passe :</td>
            <td><input type="password" name="mdp" minlength="10" maxlength="30" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Valider"></td>
            <td><input type="reset" value="Reset"></td>
        </tr>
    </table>
    <a href="connexion.php">Vous avez déja un compte ? connectez-vous</a>
</form>
</body>
</html>
