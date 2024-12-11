<?php
if (isset($_POST['supprimerMonCompte'])){
    $inscrit = $_POST['id'];
    $bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');


    $requete = $bdd->prepare('DELETE FROM inscrit WHERE id_inscrit = :inscrit ');
    $requete->execute(array(
        'inscrit' => $inscrit
    ));
    $requete->closeCursor();
}
session_start();
session_destroy();
header("location:../index.php");
