<?php
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');
if (isset($_POST['ajout'])){
    $titre = $_POST['titre'];

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
if(isset($_POST['modifLivre'])){
    $requete = $bdd->prepare('UPDATE livre SET titre = :titre, annee = :annee, resume = :resume WHERE id_livre =:id');
    $requete->execute(array(
        'titre' => $_POST['titre'],
        'annee' => $_POST['annee'],
        'resume' => $_POST['resume'],
        'id' => $_POST['id']
    ));



    $requete->closeCursor();
    $requete = $bdd->prepare('UPDATE ecrire SET ref_livre = :livre, ref_auteur = :auteur WHERE ref_livre =:id');
    $requete->execute(array(
        'livre' => $_POST['id'],
        'auteur' => $_POST['auteur'],
        'id' => $_POST['id']
    ));

    $requete->closeCursor();

    header('Location: ../listeLivres.php');


}
if(isset($_POST['supLivre'])){
    var_dump($_POST);
    $requete = $bdd->prepare('DELETE FROM livre WHERE id_livre = :id');
    $requete->execute(array(
        'id' => $_POST['id']
    ));

    $requete->closeCursor();
    header('Location: ../listeLivres.php');
}
