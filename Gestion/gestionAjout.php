<?php
var_dump($_POST);
if (isset($_POST['ajout'])){
    $titre = $_POST['titre'];
    $bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

    $req = $bdd->prepare('INSERT INTO livre(titre,annee,resume) VALUES(:titre, :annee, :resume)');
    $req->execute(array(
        'titre' => $titre,
        'annee' => $_POST['annee'],
        'resume' => $_POST['resume'],
    ));

    $req->closeCursor();
    $req = $bdd->prepare('SELECT id_livre FROM livre WHERE titre = :titre');
    $req ->execute(array(
        'titre' => $titre
    ));
    $donnee = $req->fetch();
    var_dump($donnee);

    $req = $bdd->prepare('INSERT INTO ecrire(ref_livre, ref_auteur) VALUES(:livre, :auteur)');
    $req->execute(array(
        'livre' => $donnee[0],
        'auteur' => $_POST['auteur']
    ));

    $req->closeCursor();
    header("location:../listeLivres.php");
}
