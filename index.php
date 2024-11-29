<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>BIBLIOTHEQUE-ACCUEIL</title>
</head>
<body>
<hr>
<a href="">S'inscrire</a>
<a href="">Se connecter</a>
<a href="">Liste des Livres</a>
<hr>
<h1>BIENVENUE <?= $_SESSION['nom']?></h1>
</body>
