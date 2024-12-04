<?php
var_dump($_POST);
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');


$requete = $bdd->prepare('DELETE FROM inscrit WHERE id_insrit = $_POST["$colonne"]');
$requete->execute();
$requete->closeCursor();
header("location:ListeInscrit");
