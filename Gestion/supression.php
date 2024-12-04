<?php
$inscrit = $_POST['inscrit'];
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');


$requete = $bdd->prepare('DELETE FROM inscrit WHERE id_inscrit = :inscrit ');
$requete->execute(array(
    'inscrit' => $inscrit
));
$requete->closeCursor();
header("location:../listeInscrit.php");
