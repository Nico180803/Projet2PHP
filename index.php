<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-ACCUEIL</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<hr>
<a href="index.php">accueil</a>
<a href="listeLivres.php">Liste des Livres</a>
<a href="listeAuteur.php">Liste des Auteurs</a>
<hr>
<?php
if (isset($_SESSION['nom'])){
    echo '<h1>BIENVENUE '.$_SESSION['nom'].'</h1>';
}else{
    echo '<h1>BIENVENUE</h1>';
}
?>

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
