<?php
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');
if (isset($_POST['inscrit'])){
    $inscrit = $_POST['inscrit'];

    $requete = $bdd->prepare('DELETE FROM inscrit WHERE id_inscrit = :inscrit ');
    $requete->execute(array(
        'inscrit' => $inscrit
    ));
    $requete->closeCursor();
    header("location:../listeInscrit.php");
}
if (isset($_POST['supLivre'])){
    $requete = $bdd->prepare('DELETE FROM livre WHERE id_livre = :livre ');
    $requete->execute(array(
        'livre' => $_POST['id']
    ));
    $requete->closeCursor();
    header("location:../listeLivres.php");
}
