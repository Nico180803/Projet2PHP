<?php
session_start();
var_dump($_SESSION);
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8','root','');
$requete = $bdd->prepare('SELECT * FROM inscrit');
$requete->execute();
$info = $requete->fetch();
$requete->closeCursor();
var_dump($info);
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
<form action="profil.php" method="post">
    <input type="submit" value="Modifier mon profil">
</form>
<form action="profil.php" method="post">
    <input type="submit" value="Modifier mon Mot de Passe">
</form>

<?php
if (isset($_POST['modifier'])) {
?>
 <table>
     <form>
         <tr>
             <td><label for=""></label>Nom : </td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">Prenom : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">email : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">Telephone Fixe : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">Telephone Portable : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">Rue : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">Code postal : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><label for="">Ville : </label></td>
             <td></td>
         </tr>
         <tr>
             <td><input type="submit" value="modifier"></td>
         </tr>
     </form>
 </table>



<?php
}
?>


</body>
</html>

