<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<form action="Gestion/gestionConnexion.php" method="post">
    <table>
        <tr>
            <td>Email :</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>Mot de passe :</td>
            <td><input type="password" name="mdp" minlength="10" maxlength="30"></td>
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
