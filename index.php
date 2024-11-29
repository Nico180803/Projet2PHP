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
<a href="">S'inscrire</a>
<a href="">Se connecter</a>
<a href="">Liste des Livres</a>
<hr>
<h1>BIENVENUE <?= $_SESSION['nom']?></h1>
<hr>
<a href="inscription.php">S'inscrire</a>
<a href="connexion.php">Se connecter</a>
<a href="listeLivres.php">Liste des Livres</a>
<hr>

</body>
